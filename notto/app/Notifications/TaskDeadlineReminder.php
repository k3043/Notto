<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class TaskDeadlineReminder extends Notification implements ShouldQueue
{
    use Queueable;

    public $task;

    /**
     * Tạo constructor để truyền thông tin task vào thông báo.
     */
    public function __construct($task)
    {
        $this->task = $task;
    }

    /**
     * Định nghĩa kênh mà thông báo sẽ được gửi.
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Lưu thông báo vào cơ sở dữ liệu.
     */
    public function toArray($notifiable)
    {
        return [
            'title' => 'Task Deadline Reminder',
            'message' => "Task '{$this->task->title}' is due in less than 2 hours!",
            'task_id' => $this->task->id,
            'due_date' => $this->task->deadline->format('Y-m-d H:i:s'),
        ];
    }

    public function toDatabase($notifiable)
    {
        die($this->task->title);
        return [
            'title' => 'Task Deadline Reminder',
            'message' => "Task '{$this->task->title}' is due in less than 2 hours!",
            'task_id' => $this->task->id,
            'due_date' => $this->task->deadline->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * Trả về thông báo dưới dạng một broadcast message.
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'title' => 'Task Deadline Reminder',
            'message' => "Task '{$this->task->title}' is due in less than 2 hours!",
            'task_id' => $this->task->id,
            'due_date' => $this->task->deadline->format('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Cấu hình email nếu cần gửi email (tùy chọn).
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line("Your task '{$this->task->title}' is due in less than 2 hours!")
                    ->action('View Task', url('/tasks/'.$this->task->id))
                    ->line('Please make sure to complete it on time!');
    }
}
