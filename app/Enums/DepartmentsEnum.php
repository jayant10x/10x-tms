<?php

namespace App\Enums;

enum DepartmentsEnum: string
{
    case SALES = 'sales';
    case HR = 'hr';
    case RECRUITMENT = 'recruitment';
    case DIGITAL_MARKETING = 'digital_marketing';
    case OPERATIONS = 'operations';
    case BACKEND = 'backend';
    case FINANCE = 'finance';
    case SALES_EXECUTIVE = 'sales_executive';
    case BUSINESS_DEVELOPMENT = 'business_development';
    case PERFORMANCE_MARKETING = 'performance_marketing';
    case SEO = 'seo';
    case SMM = 'smm';
    case WEB_DEVELOPMENT = 'web_development';
    case E_COMMERCE = 'e_commerce';
    case GRAPHICS_DESIGN = 'graphics_design';

    public function label(): string
    {
        return match ($this) {
            self::SALES => 'Sales',
            self::HR => 'HR',
            self::RECRUITMENT => 'Recruitment',
            self::DIGITAL_MARKETING => 'Digital Marketing',
            self::OPERATIONS => 'Operations',
            self::BACKEND => 'Backend',
            self::FINANCE => 'Finance',
            self::SALES_EXECUTIVE => 'Sales Executive',
            self::BUSINESS_DEVELOPMENT => 'Business Development',
            self::PERFORMANCE_MARKETING => 'Performance Marketing',
            self::SEO => 'SEO',
            self::SMM => 'SMM',
            self::WEB_DEVELOPMENT => 'Web Development',
            self::E_COMMERCE => 'E Commerce',
            self::GRAPHICS_DESIGN => 'Graphics Design',
        };
    }

    public static function all_departments(): array
    {
        return [
            self::SALES,
            self::HR,
            self::DIGITAL_MARKETING,
            self::OPERATIONS,
            self::BACKEND,
            self::FINANCE,
        ];
    }

    public static function sales_departments(): array
    {
        return [
            self::SALES_EXECUTIVE,
            self::BUSINESS_DEVELOPMENT,
        ];
    }

    public static function hr_departments(): array
    {
        return [
            self::RECRUITMENT,
            self::OPERATIONS,
        ];
    }

    public static function digital_marketing_departments(): array
    {
        return [
            self::PERFORMANCE_MARKETING,
            self::SEO,
            self::SMM,
            self::WEB_DEVELOPMENT,
            self::E_COMMERCE,
            self::GRAPHICS_DESIGN,
        ];
    }

    public static function get_sub_departments_by_department(self $department): array
    {
        return match ($department) {
            self::SALES => self::sales_departments(),

            self::HR => self::hr_departments(),

            self::DIGITAL_MARKETING => self::digital_marketing_departments(),

            default => [],
        };
    }

    public static function labelFrom(mixed $value): string
    {
        return self::tryFrom($value)?->label() ?? '-';
    }
}
