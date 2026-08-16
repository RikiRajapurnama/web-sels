<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $username = env('ADMIN_USERNAME', 'admin');
        $password = env('ADMIN_PASSWORD', 'admin12345');
        $email = env('ADMIN_EMAIL', 'admin@xlsatuwifi.test');
        $name = env('ADMIN_NAME', 'Riki Raja Purnama');

        User::updateOrCreate(
            ['username' => $username],
            [
                'name' => $name,
                'email' => $email,
                'username' => $username,
                'password' => Hash::make($password),
                'role' => 'admin',
            ]
        );
    }
}
