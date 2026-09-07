<?php

namespace App\Notifications;

use App\Notifications\Channels\DatabaseNotificationChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SystemNotification extends Notification {
    use Queueable;

    public function __construct(public string $title, public string $message, public string $route, public array $params = []
    ) {}

    public function via($notifiable): array {
        return [
            DatabaseNotificationChannel::class,
        ];
    }

    public function toDatabase($notifiable): array {
        return [
            'title' => $this->title,
            'message' => $this->message,
            'route' => $this->route,
            'params' => $this->params,
        ];
    }
}
/*
 * Database notification look like
 * {
    "title": "Employee Created",
    "message": "Employee John was created successfully.",
    "route": "employees.show",
    "params": {
    "employee": 10
    }
}*/
