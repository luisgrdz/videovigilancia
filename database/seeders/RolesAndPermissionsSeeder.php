<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Permisos generales
        $permissions = [
            'view_live',
            'view_recordings',
            'download_video',
            'manage_cameras',
            'manage_users',
            'view_audit_logs',
            'export_evidence',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // Roles y sus permisos
        $roles = [
            'superadmin' => $permissions, // todos
            'admin' => ['view_live', 'view_recordings', 'download_video', 'manage_cameras', 'manage_users'],
            'operator' => ['view_live', 'view_recordings'],
            'analyst' => ['view_recordings', 'export_evidence'],
            'auditor' => ['view_audit_logs'],
            'guest' => ['view_live']
        ];

        foreach ($roles as $role => $perms) {
            $r = Role::firstOrCreate(['name' => $role]);
            $r->syncPermissions($perms);
        }
    }
}
