<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'], // Cegah duplikat saat di-seed ulang
            [
                'name' => 'Administrator',
                'password' => Hash::make('password123'), // Ganti password ini saat production!
                'role' => 'admin',
            ]
        );
    }
}
