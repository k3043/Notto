<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Carbon\Carbon;
use PHPUnit\Event\Telemetry\System;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use function Psy\debug;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date', now()); 
        $currentDate = new Carbon($date);
        // Tính ngày đầu tuần
        $startOfWeek = $currentDate->startOfWeek();
        
        // Tạo mảng để lưu trữ thông tin ngày trong tuần
        $weekdays = [];
        for ($i = 0; $i < 7; $i++) {
            $day = clone $startOfWeek;
            $day->addDays($i);
            $weekdays[] = [
                'name' => $day->format('D'), // Tên ngày viết tắt
                'date' => $day->format('j'),  // Ngày trong tháng
                'fullDate' => $day->format('Y-m-d'), // Ngày đầy đủ để truy vấn
            ];
        }

        // Lấy danh sách tasks trong tuần
        $user = Auth::user();
        $tasks = $user->tasksInWeek($startOfWeek); 

        return view('home', compact('weekdays', 'tasks', 'currentDate'));
    }
    
}
