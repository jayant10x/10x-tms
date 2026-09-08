<?php

namespace App\Enums;

enum TaskPriority: string {
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';
    case URGENT = 'urgent';

    public function label(): string {
        return match ($this) {
            self::LOW => 'Low',
            self::MEDIUM => 'Medium',
            self::HIGH => 'High',
            self::URGENT => 'Urgent',
        };
    }

    public function color(): string {
        return match ($this) {
            self::LOW => 'success',
            self::MEDIUM => 'warning',
            self::HIGH => 'danger',
            self::URGENT => 'danger',
        };
    }

//    priority icon => solar:flag-2-broken

/*<span
class="badge badge-soft-{{\App\Enums\TaskPriority::LOW->color()}} rounded-pill me-1 fs-6"><iconify-icon icon="solar:flag-2-broken" class="align-middle fs-18"></iconify-icon>{!! \App\Enums\TaskPriority::LOW->label() !!}</span>*/
}
