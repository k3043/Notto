<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            Auth::login($user);

            return redirect('/');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string',
            ], [
                'email.required' => 'Email is required.',
                'email.email' => 'Invalid email format.',
                'password.required' => 'Password is required.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if (!Auth::attempt($request->only('email', 'password'))) {
                return redirect()->back()->withErrors(['password' => 'Incorrect email or password.'])->withInput();
            }
        if (Auth::user()->role =='admin') return redirect('/admin');
            return redirect('/');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout(); 
        return redirect('/login');
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->stateless()->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Unauthorized');
        }

        // Check if the user already exists
        $user = User::where('provider', $provider)
                    ->where('provider_id', $socialUser->getId())
                    ->first();

        if ($user) {
            Auth::login($user);
            return redirect('/');
        }

        // Check if the user exists by email
        $existingUser = User::where('email', $socialUser->getEmail())->first();
        if ($existingUser && !$existingUser->provider) {
            return redirect()->route('login')->with('error', 'Email already in use');
        }

        // Create a new user if not exists
        if (!$user) {
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'password' => '', // Empty password for OAuth users
                'avatar' => $socialUser->getAvatar(), 
            ]);

            // Profile::create([
            //     'uid' => $user->id,
            //     'username' => $socialUser->getName(), 
            //     'avatar' => $socialUser->getAvatar(), 
            //     'dob' => null,
            //     'bio' => null, 
            //     'gender' => null, 
            // ]);
        }

        Auth::login($user);

        return redirect('/');
    }
}