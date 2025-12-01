<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role; // Importar la clase Role
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // NOTA IMPORTANTE: LA CREACIÓN DE ROLES HA SIDO ELIMINADA DE ESTE SEEDER.
        // Se asume que el archivo 'Database\Seeders\RoleSeeder' ya crea los roles.
        
        // 1. Crear un usuario de prueba y ASIGNAR el rol.
        // Utilizamos 'Administrador' ya que el error de la consola indica que este rol ya existe.
        User::factory()->create([
            'name' => 'Melisa',
            'email' => 'melisacocom590@gmail.com',
            'password' => bcrypt('12345678'),
            'id_number' => '123456789',
            'phone' => '5555555555',
            'address' => 'Calle 123, Colonia 456',
        ])->assignRole('Administrador'); // Asignando el rol 'Administrador'
        
        // Si Melisa debe ser 'Entrenador' o 'Socio', por favor verifica los nombres exactos
        // que tu 'RoleSeeder' creó y cámbialo en la línea de 'assignRole'.
    }
}