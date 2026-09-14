<?php

namespace App\Enums;

enum TaskStatus: string {
    case TODO = 'to_do';
    case IN_PROGRESS = 'in_progress';
    case ON_HOLD = 'on_hold';
    case REVIEW = 'review';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public function label(): string {
        return match ($this) {
            self::TODO => 'To Do',
            self::IN_PROGRESS => 'In Progress',
            self::ON_HOLD => 'On Hold',
            self::REVIEW => 'Review',
            self::COMPLETED => 'Completed',
            self::CANCELLED => 'Cancelled',
        };
    }

    public function color(): string {
        return match ($this) {
            self::TODO => 'light',
            self::IN_PROGRESS => 'primary',
            self::ON_HOLD => 'warning',
            self::REVIEW => 'purple',
            self::COMPLETED => 'success',
            self::CANCELLED => 'danger',
        };
    }


}
