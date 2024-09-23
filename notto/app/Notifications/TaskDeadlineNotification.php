<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskDeadlineNotification extends Notification
{
    use Queueable;

    protected $task;

    public function __construct($task)
    {
        $this->task = $task;
    }

    public function via($notifiable)
    {
        // Gửi qua cả email và database (cho web notification)
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Task Deadline Notification')
                    ->line('Your task "' . $this->task->title . '" is due in less than 2 hours!')
                    ->action('View Task', url('/tasks/' . $this->task->id))
                    ->line('Please complete it on time.');
    }

    public function toDatabase($notifiable)
    {
        return [
            'task_id' => $this->task->id,
            'title' => $this->task->title,
            'deadline' => $this->task->deadline,
            'message' => 'Your task is due in less than 2 hours!',
        ];
    }
}
