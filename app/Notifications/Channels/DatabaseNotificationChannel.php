<?php

namespace App\Notifications\Channels;

use App\Models\Notification;
use Illuminate\Support\Str;

class DatabaseNotificationChannel {
    public function send($notifiable, $notification) {
        $data = $this->getData($notifiable, $notification);

        return Notification::create([
            'not_id' => $notification->id ?? Str::uuid()->toString(),

            'not_type' => get_class($notification),

            'not_data' => $data,

            'not_read_at' => null,

            'not_notifiable_id' => $notifiable->getKey(),

            'not_notifiable_type' => $notifiable->getMorphClass(),
        ]);
    }

    protected function getData($notifiable, $notification): array {
        if (method_exists($notification, 'toDatabase')) {
            return $notification->toDatabase($notifiable);
        }

        if (method_exists($notification, 'toArray')) {
            return $notification->toArray($notifiable);
        }

        return [];
    }
}
