<?php

namespace App\Enums;

enum UserRoleEnum: string {
    case ADMIN = 'admin';
    case MANAGER = 'manager';
    case EMPLOYEE = 'employee';


    public function label(): string {
        return match ($this) {
            self::ADMIN => 'Admin',
            self::MANAGER => 'Manager',
            self::EMPLOYEE => 'Employee',
        };
    }

    public function color(): string {
        return match ($this) {
            self::ADMIN => 'danger',
            self::MANAGER => 'purple',
            self::EMPLOYEE => 'success',
        };
    }

    public function badge(): string {
        return '<span class="badge rounded-pill badge-outline-' . $this->color() . ' me-1 fs-6 badge-soft-' . $this->color() . '">' . $this->label() . '</span>';
    }

}
