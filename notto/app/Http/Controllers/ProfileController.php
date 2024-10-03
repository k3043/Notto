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
    // public function searchUser(Request $request){
    //     $keyword = $request->input('keyword');

    //     // Tìm kiếm người dùng theo email hoặc tên
    //     $users = User::where('email', 'LIKE', "%{$keyword}%")
    //                  ->orWhere('name', 'LIKE', "%{$keyword}%")
    //                  ->get();
    
    //     // Kiểm tra xem có người dùng nào được tìm thấy không
    //     if ($users->isEmpty()) {
    //         return redirect()->back()->withErrors('User not found');
    //     }
    
    //     return redirect('/assignTask');
    // }
}
