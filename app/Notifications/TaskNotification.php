<?php

namespace App\Notifications;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class TaskNotification extends Notification
{
    private $task;
    private $type;

    public function __construct($task, $type)
    {
        $this->task = $task;
        $this->type = $type;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => match ($this->type) {
                'assigned' => "A new task '{$this->task->title}' has been assigned to you.",
                'status_updated' => "The task '{$this->task->title}' has been updated to {$this->task->status}.",
                'priority_updated' => "The task '{$this->task->title}' priority has been updated to {$this->task->priority}.",
            },
            'task_id' => $this->task->id,
        ];
    }
}
