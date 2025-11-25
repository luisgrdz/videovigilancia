<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'description' => 'Administrador total del sistema'
            ],
            [
                'name' => 'user',
                'description' => 'Usuario estándar con acceso a sus cámaras'
            ],
            [
                'name' => 'supervisor',
                'description' => 'Supervisor de grupo de usuarios'
            ],
            [
                'name' => 'mantenimiento',
                'description' => 'Técnico encargado de hardware y configuración'
            ],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role['name']], $role);
        }
    }
}
