<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Membresia; 

class MembresiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Definir los planes de membresía completos con precio y descripción
        $membresia = [
    [
        'name' => 'Plan Básico Mensual',
        'price' => 29.99,
        'description' => 'Acceso ilimitado a las instalaciones por un mes. Sin clases especiales.',
        'duration_months' => 1,
        'status' => 'active'
    ],
    [
        'name' => 'Plan Trimestral Plus',
        'price' => 79.99,
        'description' => 'Acceso completo por 3 meses. Incluye acceso a todas las clases grupales.',
        'duration_months' => 3,
        'status' => 'active'
    ],
    [
        'name' => 'Plan Anual VIP',
        'price' => 299.99,
        'description' => 'Acceso total por 1 año. Incluye clases, sauna y taquilla personal.',
        'duration_months' => 12,
        'status' => 'active'
    ],
    [
        'name' => 'Pase Semanal',
        'price' => 10.00,
        'description' => 'Acceso a todas las instalaciones por 7 días consecutivos.',
        'duration_months' => 1,
        'status' => 'inactive' // si quieres
    ],
];


        // 2. Crear las membresías usando el modelo Membresia
        // El método create($data) funciona porque los campos están en $fillable
        foreach ($membresia as $data) {
            Membresia::create($data);
        }
    }
}