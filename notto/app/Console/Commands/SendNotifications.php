<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Notifications\TaskDeadlineNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendTaskDeadlineNotifications extends Command
{
    protected $signature = 'notify:deadlines';
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
            $user->notify(new TaskDeadlineNotification($task));
        }

        return 0;
    }
}