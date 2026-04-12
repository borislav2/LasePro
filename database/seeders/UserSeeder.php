<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
         // Create admin user
         $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@btu.bg',
            'password' => Hash::make('123456'),
            'role' => 'admin'
        ]);

        // Create teacher user
        $teacher = User::create([
            'name' => 'Teacher',
            'email' => 'teacher@btu.bg',
            'password' => Hash::make('123456'),
            'role' => 'teacher'
        ]);
    }
}