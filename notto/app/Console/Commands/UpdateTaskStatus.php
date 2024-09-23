<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use Carbon\Carbon;

class UpdateTaskStatus extends Command
{
    protected $signature = 'tasks:update-status';
    protected $description = 'Cập nhật trạng thái của task quá hạn thành overdue';

    public function handle()
    {
        $now = Carbon::now();

        Task::where('status', 'pending')
            ->where('deadline', '<', $now)
            ->update(['status' => 'overdue']);

        $this->info('Trạng thái task đã được cập nhật.');
    }
}
