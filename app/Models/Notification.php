<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notification as NotificationContract;

class Notification extends Model {
    protected $table = 'notifications';

    protected $primaryKey = 'not_id';

    public $incrementing = false;

    protected $keyType = 'string';

    const CREATED_AT = 'not_created_on';
    const UPDATED_AT = 'not_updated_on';

    protected $casts = [
        'not_data' => 'array',
        'not_read_at' => 'datetime',
    ];

    protected $fillable = [
        'not_id',
        'not_type',
        'not_data',
        'not_read_at',
        'not_notifiable_id',
        'not_notifiable_type',
    ];

    public function notifiable() {
        return $this->morphTo();
    }

    public function markAsRead() {
        if (is_null($this->not_read_at)) {
            $this->forceFill([
                'not_read_at' => now(),
            ])->save();
        }

        return $this;
    }

    public function markAsUnread() {
        if (!is_null($this->not_read_at)) {
            $this->forceFill([
                'not_read_at' => null,
            ])->save();
        }

        return $this;
    }

    public function read(): bool {
        return !is_null($this->not_read_at);
    }

    public function unread(): bool {
        return is_null($this->not_read_at);
    }
}
