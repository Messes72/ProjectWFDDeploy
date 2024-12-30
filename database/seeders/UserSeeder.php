<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 1,
        ]);
        User::create([
            'email' => 'JohnDoe@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 2,
        ]);
        User::create([
            'email' => 'student@student.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 3,
        ]);
    }
}
