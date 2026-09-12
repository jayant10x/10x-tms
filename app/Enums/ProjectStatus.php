<?php

namespace App\Enums;

enum ProjectStatus: string {
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case HOLD = 'hold';
    case COMPLETED = 'completed';


    public function label(): string {
        return match ($this) {
            self::ACTIVE => 'Active',
            self::INACTIVE => 'Inactive',
            self::HOLD => 'On Hold',
            self::COMPLETED => 'Completed',
        };
    }

    public function color(): string {
        return match ($this) {
            self::ACTIVE => 'success',
            self::INACTIVE => 'danger',
            self::HOLD => 'warning',
            self::COMPLETED => 'primary',
        };
    }

    public function badge(): string {
        return '<span class="badge rounded-pill badge-outline-'. $this->color().' me-1 fs-6 badge-soft-' . $this->color() . '">' . $this->label() . '</span>';
    }
}
