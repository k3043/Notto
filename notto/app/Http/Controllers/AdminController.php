<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
class AdminController extends Controller
{
    public function index(){
        if (Auth::check()) {
            $users = User::where('role','user')->get();
            return view('admin',compact('users'));
        } else {
            return redirect('/login', compact('users')); 
        }
    }
    public function deleteUser($uid){
        $user = User::find($uid);
        if ($user) { 
            $user->delete();
            return redirect()->back()->with('success', 'User deleted successfully');
        }
        else return redirect()->back()->with('error', 'User deleted unsuccessfully');
    }
}
