<?php

namespace App\Enums;

enum TaskCategoryEnum: string {
    case DEVELOPMENT = 'development';
    case DESIGN = 'design';
    case MARKETING = 'marketing';
    case REPORTING = 'reporting';
    case DEV_OPS = 'dev_ops';
    case BACKEND = 'backend';
    case FRONTEND = 'frontend';
    case DOCUMENTATION = 'documentation';
    case OTHER = 'other';

    public function label(): string {
        return match ($this) {
            self::DEVELOPMENT => 'Development',
            self::DESIGN => 'Design',
            self::MARKETING => 'Marketing',
            self::REPORTING => 'Reporting',
            self::DEV_OPS => 'DevOps',
            self::BACKEND => 'Backend',
            self::FRONTEND => 'Frontend',
            self::DOCUMENTATION => 'Documentation',
            self::OTHER => 'Other',
        };
    }
}
