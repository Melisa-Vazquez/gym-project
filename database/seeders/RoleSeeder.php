<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Definir roles
         // 1. Roles del Gimnasio
        $roles = [
            'Administrador',    // Administración total del sistema
            'Staff', 
            'Cliente'           
        ];

        // Crear roles
        foreach ($roles as $role) {
            Role::create([
                'name' => $role,
            ]);
        }
    }
}