<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\DeadlineReminder;
use Illuminate\Support\Facades\Mail;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;

class SendDeadlineReminders extends Command
{
    protected $signature = 'reminders:send';
    protected $description = 'Send email reminders for tasks with upcoming deadlines';

    public function handle()
    {
        // $tasks = Task::where('deadline', '<=', Carbon::now()->endOfDay())
        //      ->where('status', 'pending')
        //      ->get();
        // foreach ($tasks as $task) {
        //     Mail::to($task->user->email)->send(new DeadlineReminder($task));
        // }
        $users = User::all();  // Lấy tất cả các user

foreach ($users as $user) {
    // Lấy tất cả các task của user và lọc task có trạng thái "pending" trong ngày
    $tasks = $user->tasks()
                //   ->orWhere('assignee', $user->email)
                  ->where('status', 'pending')
                  ->whereDate('deadline', Carbon::today()) 
                  ->get();
    // Nếu user có task pending, thì gửi thông báo
    if ($tasks->isNotEmpty()) {
        // Tạo nội dung email với danh sách các task
        Mail::to($user->email)->send(new DeadlineReminder($tasks));
    }}
        $this->info('Reminder emails sent successfully.');
    }
}
