<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Lấy tất cả các thông báo chưa đọc cho người dùng hiện tại
    public function getUnreadNotifications()
    {
        $unreadNotifications = Auth::user()->unreadNotifications;
        return response()->json($unreadNotifications);
    }

    // Đánh dấu tất cả thông báo là đã đọc
    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return response()->json(['message' => 'All notifications marked as read']);
    }
    public function delete($id){
        Notification::find($id)->delete();
        return redirect()->back();
    }
}
