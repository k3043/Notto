<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Notifications\TaskDeadlineReminder;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendNotifications extends Command
{
    protected $signature = 'task:deadlines';
    protected $description = 'Send notifications to users for tasks due in less than 2 hours.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Lấy tất cả các task có deadline trong vòng 2 tiếng tới
        $tasks = Task::where('deadline', '<=', Carbon::now()->addHours(2))
                     ->where('deadline', '>', Carbon::now())
                     ->get();

        foreach ($tasks as $task) {
            $user = $task->user;
            // Gửi notification cho user
            if ($user) { // Kiểm tra nếu người dùng không phải là null
                // Gửi notification cho user
                $user->notify(new TaskDeadlineReminder($task));
                // Gửi email cho user
                //Mail::to($user->email)->send(new DeadlineReminder($task));
                
            }

        return 0;
    }
}