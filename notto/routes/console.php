<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule; 

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Artisan::command('reminders:send', function () {
//     $this->comment('sfefffe');
// })->purpose('sent reminder email')->everyMinute();
Schedule::command('reminders:send')->dailyAt('7:00');
// Schedule::command('tasks:update-status')->everyMinute();

// Schedule::command('task:deadlines')->everyMinute();
