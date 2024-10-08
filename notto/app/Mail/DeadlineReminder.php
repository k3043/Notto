<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DeadlineReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $tasks;

    public function __construct($tasks)
    {
        $this->tasks = $tasks;
    }

    public function build()
    {
        return $this->subject('Reminder: You have tasks due today')
                    ->view('emails.deadline_reminder');
    }
}