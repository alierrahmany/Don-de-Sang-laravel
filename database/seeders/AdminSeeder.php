<?php
// database/seeders/AdminSeeder.php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Administrateur',
            'email' => 'admin@dondesang.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);
    }
}