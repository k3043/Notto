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
        $tasks = $user->tasksInWeek($startOfWeek)->groupBy(function($task) {
            return Carbon::parse($task->deadline)->format('Y-m-d'); // Group tasks by date
        });
    
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
    public function showEditPage($id){
        $task = Task::find($id);
        return view('editTask',compact('task'));
    }
    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
            'status' => 'required|string|in:pending,completed', // Ví dụ status có 2 trạng thái
        ]);

        // Tìm task theo ID
        $task = Task::findOrFail($id);

        // Cập nhật dữ liệu task
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->deadline = $request->input('deadline');
        $task->status = $request->input('status');

        $task->save();

        return redirect()->back()->with('success', 'Task updated successfully');
    }
    public function delete($id){
        $task = Task::find($id);
        $task->delete();
        return redirect()->back()->with('success', 'Task delete successfully');
    }

    public function showList(){
        $user = Auth::user();
        $tasks = $user->tasks;
        $completedTasks = $user->completedTasks();
        $incompletedTasks = $user->incompletedTasks();
        $overdueTasks = $user->overDueTasks();
        return view('tasks', compact('tasks','completedTasks','incompletedTasks','overdueTasks'));
    }
    public function markAsDone($id){
        $task = Task::find($id);
        if ($task->markAsDone()) {
            return redirect()->back()->with('success', 'Task marked as done successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to mark task as done.');
        }
    }
    public function markAsUnfinished($id){
        $task = Task::find($id);
        if ($task->markAsUnfinished()) {
            return redirect()->back()->with('success', 'Task marked as unfinished successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to mark task as unfinished.');
        }
    } 
}
