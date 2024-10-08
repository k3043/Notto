<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule; 

Schedule::command('reminders:send')->dailyAt('9:00');

//Schedule::command('tasks:update-status')->everyMinute();

// Schedule::command('task:deadlines')->everyMinute();
