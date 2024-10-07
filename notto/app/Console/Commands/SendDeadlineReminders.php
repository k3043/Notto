<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\DeadlineReminder;
use Illuminate\Support\Facades\Mail;
use App\Models\Task;
use Carbon\Carbon;

class SendDeadlineReminders extends Command
{
    protected $signature = 'reminders:send';
    protected $description = 'Send email reminders for tasks with upcoming deadlines';

    public function handle()
    {
        $tasks = Task::where('deadline', '<=', Carbon::now()->addHours(2))
                     ->where('deadline', '>', Carbon::now())
                     ->get(); 
        foreach ($tasks as $task) {
            Mail::to($task->user->email)->send(new DeadlineReminder($task));
        }

        $this->info('Reminder emails sent successfully.');
    }
}
