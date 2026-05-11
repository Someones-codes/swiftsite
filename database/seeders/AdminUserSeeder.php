<?php
// database/seeders/AdminUserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Create the admin role
        $adminRole = Role::create(['name' => 'admin']);

        // Create your admin user account
        $admin = User::create([
            'name'     => 'Prince Chishanga',
            'email'    => 'pchishanga2020@gmail.com', // CHANGE THIS
            'password' => bcrypt('adminPrince1'), // CHANGE THIS
        ]);

        // Assign the admin role
        $admin->assignRole($adminRole);
    }
}