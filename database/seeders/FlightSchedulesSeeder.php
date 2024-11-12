<?php

namespace Database\Seeders;

use App\Models\FlightSchedule;
use App\Models\Route;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FlightSchedulesSeeder extends Seeder
{

    public function run()
    {
        // Obtener todas las rutas disponibles
        $routes = Route::all();

        // Los días de la semana (0 = Lunes, 6 = Domingo)
        $daysOfWeek = [0, 1, 2, 3, 4, 5, 6]; // Lunes a Domingo

        foreach ($routes as $route) {
            // Para cada ruta, asignamos horarios de vuelo para cada día de la semana
            foreach ($daysOfWeek as $day) {
                $hours = rand(5, 23);
                $minutes = str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT); // Aseguramos que los minutos tengan 2 dígitos
                $departureTime = Carbon::createFromFormat('H:i', $hours . ':' . $minutes);

                // Calculamos la hora de llegada sumando la duración del vuelo en minutos a la hora de salida
                $arrivalTime = $departureTime->copy()->addMinutes($route->duration);

                // Creamos el horario de vuelo
                FlightSchedule::create([
                    'route_id' => $route->id,
                    'weekday' => $day, // Día de la semana (0 a 6)
                    'departure_time' => $departureTime->format('H:i'), // Hora de salida en formato H:i
                    'arrival_time' => $arrivalTime->format('H:i'), // Hora de llegada en formato H:i
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
