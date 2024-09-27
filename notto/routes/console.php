<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('reminders:send', function () {
    $this->comment('sfefffe');
})->purpose('sent reminder email')->everyMinute();


