<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Carbon\Carbon;
use PHPUnit\Event\Telemetry\System;

use function Psy\debug;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('home', compact('tasks'));
    }
    public function getAllTasksInThisWeek()
{
    $startOfWeek = Carbon::now()->startOfWeek(); // Thứ Hai
    $endOfWeek = Carbon::now()->endOfWeek(); // Chủ Nhật

    // Lấy danh sách task trong tuần hiện tại
    $tasks = Task::whereBetween('dueTime', [$startOfWeek, $endOfWeek])->get();

    return view('home', compact('tasks'));
}
}
