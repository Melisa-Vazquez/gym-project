<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;// Importar la clase Permission

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. CREACIÓN DE ROLES
        $adminRole = Role::firstOrCreate(['name' => 'Administrador']);
        Role::firstOrCreate(['name' => 'Staff']);
        Role::firstOrCreate(['name' => 'Cliente']);

        // ------------------------------------------------------------------
        
        // 2. CREACIÓN DE PERMISOS
        // Definir todos los permisos de gestión
        $permissions = [
            'manage-users',
            'manage-roles',
            'manage-membresias',
            // Agrega aquí CUALQUIER otro permiso que uses en tu aplicación
        ];

        // Crear los permisos en la base de datos
        $allPermissions = collect($permissions)->map(function ($permission) {
            return Permission::firstOrCreate(['name' => $permission]);
        });
        
        // ------------------------------------------------------------------

        // 3. ASIGNACIÓN TOTAL DE PERMISOS AL ROL ADMINISTRADOR
        if ($adminRole) {
            // Sincroniza (asigna) todos los permisos creados al rol Administrador
            $adminRole->syncPermissions($allPermissions);
            $this->command->info('✅ Todos los permisos sincronizados con el rol Administrador.');
        }

        // Puedes añadir aquí la lógica para asignar permisos específicos a Staff o Cliente.
    }
}