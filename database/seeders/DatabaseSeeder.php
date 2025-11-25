<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Ejecutar RolesSeeder primero
        $this->call(RolesSeeder::class);

        $testPassword = 'password';

        // 1. ADMIN
        User::create([
            'name' => 'Luis Macias',
            'email' => 'admin@example.com',
            'password' => Hash::make($testPassword),
            'role_id' => 1, // Asegura que este ID exista en RolesSeeder
            'status' => true,
        ]);

        // 2. SUPERVISOR
        User::create([
            'name' => 'Supervisor Prueba',
            'email' => 'supervisor@example.com',
            'password' => Hash::make($testPassword),
            'role_id' => 3,
            'status' => true,
        ]);

        // 3. USER
        User::create([
            'name' => 'Usuario Prueba',
            'email' => 'user@example.com',
            'password' => Hash::make($testPassword),
            'role_id' => 2,
            'status' => true,
        ]);

        Log::info("Usuarios creados. Pass: 'password'");
    }
}
