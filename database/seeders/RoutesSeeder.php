<?php

namespace Database\Seeders;

use App\Models\Airplane;
use App\Models\Airport;
use App\Models\Route;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoutesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Obtener todos los aviones y aeropuertos
        $airplanes = Airplane::all();
        $airports = Airport::all();

        // Rutas directas (Ejemplo de 5 rutas directas)
        Route::create([
            'airplane_id' => $airplanes[0]->id, // Boeing 737
            'origin_airport_id' => $airports->where('code', 'BOG')->first()->id, // BOG
            'destination_airport_id' => $airports->where('code', 'MDE')->first()->id, // MDE
            'direct' => 1, // Directo
            'duration' => 45, // Duración de vuelo en minutos
        ]);

        Route::create([
            'airplane_id' => $airplanes[1]->id, // Airbus A320
            'origin_airport_id' => $airports->where('code', 'BAQ')->first()->id, // BAQ
            'destination_airport_id' => $airports->where('code', 'SMR')->first()->id, // SMR
            'direct' => 1, // Directo
            'duration' => 40, // Duración de vuelo en minutos
        ]);

        Route::create([
            'airplane_id' => $airplanes[2]->id, // Embraer E175
            'origin_airport_id' => $airports->where('code', 'CTG')->first()->id, // CTG
            'destination_airport_id' => $airports->where('code', 'CLO')->first()->id, // CLO
            'direct' => 1, // Directo
            'duration' => 60, // Duración de vuelo en minutos
        ]);

        $parent = Route::create([
            'airplane_id' => $airplanes[2]->id, // Embraer E175
            'origin_airport_id' => $airports->where('code', 'CTG')->first()->id, // CTG
            'destination_airport_id' => $airports->where('code', 'CLO')->first()->id, // CLO
            'direct' => 0, // Directo
            'duration' => 120, // Duración de vuelo en minutos
        ]);

        Route::create([
            'airplane_id' => $airplanes[2]->id, // Embraer E175
            'origin_airport_id' => $airports->where('code', 'CTG')->first()->id, // CTG
            'destination_airport_id' => $airports->where('code', 'MDE')->first()->id, // CLO
            'direct' => 1, // Directo
            'route_id' => $parent->id, // Directo
            'duration' => 60, // Duración de vuelo en minutos
        ]);

        Route::create([
            'airplane_id' => $airplanes[2]->id, // Embraer E175
            'origin_airport_id' => $airports->where('code', 'MDE')->first()->id, // CTG
            'destination_airport_id' => $airports->where('code', 'CLO')->first()->id, // CLO
            'direct' => 1, // Directo
            'route_id' => $parent->id, // Directo
            'duration' => 60, // Duración de vuelo en minutos
        ]);


        Route::create([
            'airplane_id' => $airplanes[0]->id, // Boeing 737
            'origin_airport_id' => $airports->where('code', 'BOG')->first()->id, // BOG
            'destination_airport_id' => $airports->where('code', 'BAQ')->first()->id, // BAQ
            'direct' => 1, // Directo
            'duration' => 90, // Duración de vuelo en minutos
        ]);

        $parent2 = Route::create([
            'airplane_id' => $airplanes[0]->id, // Boeing 737
            'origin_airport_id' => $airports->where('code', 'BOG')->first()->id, // BOG
            'destination_airport_id' => $airports->where('code', 'BAQ')->first()->id, // BAQ
            'direct' => 0, // Directo
            'duration' => 120, // Duración de vuelo en minutos
        ]);

        Route::create([
            'airplane_id' => $airplanes[0]->id, // Boeing 737
            'origin_airport_id' => $airports->where('code', 'BOG')->first()->id, // BOG
            'destination_airport_id' => $airports->where('code', 'BGA')->first()->id, // BAQ
            'direct' => 1, // Directo
            'route_id' => $parent2->id, // Directo
            'duration' => 30, // Duración de vuelo en minutos
        ]);

        Route::create([
            'airplane_id' => $airplanes[0]->id, // Boeing 737
            'origin_airport_id' => $airports->where('code', 'BGA')->first()->id, // BOG
            'destination_airport_id' => $airports->where('code', 'BAQ')->first()->id, // BAQ
            'direct' => 1, // Directo
            'route_id' => $parent2->id, // Directo
            'duration' => 90, // Duración de vuelo en minutos
        ]);


        Route::create([
            'airplane_id' => $airplanes[1]->id, // Airbus A320
            'origin_airport_id' => $airports->where('code', 'MDE')->first()->id, // MDE
            'destination_airport_id' => $airports->where('code', 'EOH')->first()->id, // EOH
            'direct' => 1, // Directo
            'duration' => 75, // Duración de vuelo en minutos
        ]);

        // Rutas con escalas (Ejemplo de 5 rutas con escalas)
        $parent3 = Route::create([
            'airplane_id' => $airplanes[2]->id, // Embraer E175
            'origin_airport_id' => $airports->where('code', 'BOG')->first()->id, // BOG
            'destination_airport_id' => $airports->where('code', 'CTG')->first()->id, // CTG
            'direct' => 0, // Con escalas
            'duration' => 180, // Duración de vuelo en minutos (con escalas)
        ]);

        Route::create([
            'airplane_id' => $airplanes[2]->id, // Embraer E175
            'origin_airport_id' => $airports->where('code', 'BOG')->first()->id, // BOG
            'destination_airport_id' => $airports->where('code', 'MDE')->first()->id, // CTG
            'direct' => 1, // Con escalas
            'route_id' => $parent3->id, // Directo
            'duration' => 60, // Duración de vuelo en minutos (con escalas)
        ]);

        Route::create([
            'airplane_id' => $airplanes[2]->id, // Embraer E175
            'origin_airport_id' => $airports->where('code', 'MDE')->first()->id, // BOG
            'destination_airport_id' => $airports->where('code', 'CTG')->first()->id, // CTG
            'direct' => 1, // Con escalas
            'route_id' => $parent3->id, // Directo
            'duration' => 120, // Duración de vuelo en minutos (con escalas)
        ]);

        Route::create([
            'airplane_id' => $airplanes[0]->id, // Boeing 737
            'origin_airport_id' => $airports->where('code', 'BAQ')->first()->id, // BAQ
            'destination_airport_id' => $airports->where('code', 'EOH')->first()->id, // EOH
            'direct' => 1, // Con escalas
            'duration' => 240, // Duración de vuelo en minutos (con escalas)
        ]);

        Route::create([
            'airplane_id' => $airplanes[1]->id, // Airbus A320
            'origin_airport_id' => $airports->where('code', 'SMR')->first()->id, // SMR
            'destination_airport_id' => $airports->where('code', 'CLO')->first()->id, // CLO
            'direct' => 1, // Con escalas
            'duration' => 150, // Duración de vuelo en minutos (con escalas)
        ]);

        Route::create([
            'airplane_id' => $airplanes[0]->id, // Boeing 737
            'origin_airport_id' => $airports->where('code', 'BOG')->first()->id, // BOG
            'destination_airport_id' => $airports->where('code', 'SMR')->first()->id, // SMR
            'direct' => 1, // Con escalas
            'duration' => 210, // Duración de vuelo en minutos (con escalas)
        ]);

        Route::create([
            'airplane_id' => $airplanes[2]->id, // Embraer E175
            'origin_airport_id' => $airports->where('code', 'MDE')->first()->id, // MDE
            'destination_airport_id' => $airports->where('code', 'BAQ')->first()->id, // BAQ
            'direct' => 1, // Con escalas
            'duration' => 180, // Duración de vuelo en minutos (con escalas)
        ]);
    }
}
