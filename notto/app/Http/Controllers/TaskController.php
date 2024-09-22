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
        $startOfWeek = $currentDate->startOfWeek();
   
        $weekdays = [];
        for ($i = 0; $i < 7; $i++) {
            $day = clone $startOfWeek;
            $day->addDays($i);
            $weekdays[] = [
                'name' => $day->format('D'), // Tên ngày viết tắt
                'date' => $day->format('j'),  // Ngày trong tháng
                'fullDate' => $day->format('Y-m-d'), 
            ];
        }

        $user = Auth::user();
        $tasks = $user->tasksInWeek($startOfWeek); 

        return view('home', compact('weekdays', 'tasks', 'currentDate'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
        ]);

        // Tạo task mới
        $task = new Task();
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->deadline = $request->input('deadline');
        $task->uid = Auth::id(); 

        $task->save();

        return redirect('/')->with('success', 'Task added successfully!');
    }
    
}
