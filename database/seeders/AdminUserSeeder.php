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

        $user = User::firstOrNew(['username' => $username]);

        // A bcrypt hash is always 60 chars. A truncated hash (e.g. stored in a
        // too-narrow column) makes Hash::check() fail on every login, so we
        // rebuild the account whenever the stored hash is missing or broken.
        $needsReset = !$user->exists
            || empty($user->password)
            || strlen($user->password) !== 60;

        if ($needsReset) {
            $user->fill([
                'name' => $name,
                'email' => $email,
                'username' => $username,
                'password' => Hash::make($password),
                'role' => 'admin',
            ])->save();

            if (strlen($user->fresh()->password) !== 60) {
                throw new \RuntimeException(
                    'AdminUserSeeder: the stored password hash is still shorter than 60 chars '
                    .'after saving. The users.password column truncates it; it must be VARCHAR(255).'
                );
            }
        } else {
            $user->fill([
                'name' => $name,
                'email' => $email,
                'role' => 'admin',
            ])->save();
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
