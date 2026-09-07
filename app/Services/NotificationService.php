<?php

namespace App\Services;

use App\Models\AdminUser;
use App\Notifications\SystemNotification;

class NotificationService {
    public function send(AdminUser $user, string $title, string $message, string $route, array $params = []): void {
        $user->notify(new SystemNotification(title: $title, message: $message, route: $route, params: $params)
        );
    }

    public function sendToCurrentUser(string $title, string $message, string $route, array $params = []): void {
        if (!auth()->check()) {
            return;
        }

        $this->send(user: auth()->user(), title: $title, message: $message, route: $route, params: $params);
    }

    public function sendToUsers(iterable $users, string $title, string $message, string $route, array $params = []): void {
        foreach ($users as $user) {
            $this->send(user: $user, title: $title, message: $message, route: $route, params: $params);
        }
    }
}
