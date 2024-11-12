<?php

namespace Database\Seeders;

use App\Models\Airplane;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AirplanesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Crear aviones de ejemplo
        Airplane::create([
            'brand' => 'Boeing',
            'model' => '737',
            'status' => 1, // activo
        ]);

        Airplane::create([
            'brand' => 'Airbus',
            'model' => 'A320',
            'status' => 1, // activo
        ]);

        Airplane::create([
            'brand' => 'Embraer',
            'model' => 'E175',
            'status' => 1, // activo
        ]);
    }
}
