<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. PRIMERO: Ejecutamos el semillero de Roles para que existan los ID 1 y 2
        $this->call(RolesSeeder::class);

        // 2. DESPUÉS: Ya podemos crear el usuario, porque el rol #2 ya existe
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            // El role_id se asignará automáticamente como 2 gracias a tu migración
        ]);
    }
}