<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\Schema; // Importante: Importar Schema

class RolesSeeder extends Seeder
{
    public function run()
    {
        // Desactivamos la revisión de llaves foráneas para permitir el truncate
        Schema::disableForeignKeyConstraints();

        // Ahora sí podemos limpiar la tabla sin error 1701
        Role::truncate();

        // Volvemos a activar la revisión por seguridad
        Schema::enableForeignKeyConstraints();

        // 1: Administrador (Máximo control)
        Role::create([
            'id' => 1,
            'name' => 'Admin'
        ]);

        // 2: Usuario regular (Visualización básica)
        Role::create([
            'id' => 2,
            'name' => 'User'
        ]);

        // 3: Supervisor (Control intermedio)
        Role::create([
            'id' => 3,
            'name' => 'Supervisor'
        ]);
    }
}
