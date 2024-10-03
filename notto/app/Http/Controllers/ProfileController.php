<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view('profile',compact('user'));
    }

    public function update(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $user = User::find(Auth::user()->id);
        $user->name = $request->input('name');
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
