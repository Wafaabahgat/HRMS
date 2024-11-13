<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'name' => 'Admin',
            'username' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        Admin::create([
            'name' => 'SuperAdmin',
            'username' => 'SuperAdmin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}
