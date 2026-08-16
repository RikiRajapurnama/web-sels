<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $this->ensurePasswordColumnIsWideEnough();

        $username = env('ADMIN_USERNAME', 'admin');
        $password = env('ADMIN_PASSWORD', 'AdminXL2026!');
        $email = env('ADMIN_EMAIL', 'admin@xlsatuwifi.com');
        $name = env('ADMIN_NAME', 'Riki Raja Purnama');

        $data = [
            'name' => $name,
            'email' => $email,
            'username' => $username,
            'role' => 'admin',
            'password' => Hash::make($password),
        ];

        $user = User::firstWhere('username', $username) ?? User::firstWhere('email', $email);

        if ($user) {
            $user->update($data);
        } else {
            User::create($data);
        }

        // A bcrypt hash is always 60 chars. A truncated hash (e.g. stored in a
        // too-narrow column) makes Hash::check() fail on every login, so fail
        // loudly instead of leaving the admin locked out.
        if (strlen($user->fresh()->password) !== 60) {
            throw new \RuntimeException(
                'AdminUserSeeder: the stored password hash is shorter than 60 chars '
                .'after saving. The users.password column truncates it; it must be VARCHAR(255).'
            );
        }
    }

    private function ensurePasswordColumnIsWideEnough(): void
    {
        $driver = DB::connection()->getDriverName();

        try {
            if ($driver === 'mysql') {
                DB::statement('ALTER TABLE users MODIFY password VARCHAR(255) NOT NULL');
            } elseif ($driver === 'pgsql') {
                DB::statement('ALTER TABLE users ALTER COLUMN password TYPE VARCHAR(255)');
            }
        } catch (\Throwable $e) {
            error_log('[AdminUserSeeder] Could not widen users.password column: '.$e->getMessage());
        }
    }
}
