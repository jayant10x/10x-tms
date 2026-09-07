<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        AdminUser::factory()->create([
            'adm_user_name' => 'super-admin',
            'adm_name' => 'Super Admin',
            'adm_role' => 'admin',
            'adm_password' => 'Sample@1123',
        ]);
    }
}
