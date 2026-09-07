<?php

namespace Database\Factories;

use App\Models\AdminUser;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class AdminUserFactory extends Factory {
    protected $model = AdminUser::class;
    protected static ?string $password;

    public function definition(): array {
        return [
            'adm_name' => 'Super Admin',
            'adm_user_name' => 'super-admin',
            'adm_role' => 'admin',
            'adm_password' => static::$password ??= 'Sample@1123',
            'adm_created_by' => 'Super_Admin~#~admin~#~127.0.0.0',
            'adm_created_on' => now(),
        ];
    }
}
