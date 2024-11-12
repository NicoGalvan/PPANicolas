<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('airports')->insert([
            [
                'code' => 'BOG',  // Aeropuerto El Dorado (Bogotá)
                'city' => 'Bogotá',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'MDE',  // Aeropuerto José María Córdova (Medellín)
                'city' => 'Medellín',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'BAQ',  // Aeropuerto Ernesto Cortissoz (Barranquilla)
                'city' => 'Barranquilla',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'BGA',  // Aeropuerto Palonegro (Bucaramanga)
                'city' => 'Bucaramanga',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'SMR',  // Aeropuerto Simón Bolívar (Santa Marta)
                'city' => 'Santa Marta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'CTG',  // Aeropuerto Rafael Núñez (Cartagena)
                'city' => 'Cartagena',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'CLO',  // Aeropuerto Alfonso Bonilla Aragón (Cali)
                'city' => 'Cali',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'EOH',  // Aeropuerto El Edén (Armenia)
                'city' => 'Armenia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
