<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\FlightSchedule;
use App\Models\Route;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use SplPriorityQueue;

class JourneyController extends Controller
{
    public function searchFlights(Request $request)
    {
        $originAirportId = $request->input('origin');
        $destinationAirportId = $request->input('destiny');
        $date = Carbon::parse($request->input('date')); // La fecha que llega en el request

        // Obtener el día de la semana (0 = Domingo, 1 = Lunes, ..., 6 = Sábado)
        $weekday = $date->dayOfWeek;

        // Buscar vuelos con escalas (donde route_id no es NULL)
        $connectingFlights = Route::where('origin_airport_id', $originAirportId)
            ->where('destination_airport_id', $destinationAirportId)
            ->whereHas('flight_schedules', function ($query) use ($weekday) {
                $query->where('weekday', $weekday);
            })
            ->with([
                'flight_schedules' => function ($query) use ($weekday) {
                    $query->where('weekday', $weekday);
                },
                'stops' => function ($query) use ($weekday) {
                    $query->with([
                        'flight_schedules' => function ($query) use ($weekday) {
                            $query->where('weekday', $weekday); // Filtramos por el día de la semana
                        }
                    ]);
                }
            ])
            ->get();

        // Creamos un array para almacenar los vuelos por separado
        $flightsArray = [];

        // Iteramos sobre cada vuelo (Route)
        foreach ($connectingFlights as $route) {
            // Primero agregamos los flight_schedules de la ruta principal
            foreach ($route->flight_schedules as $flightSchedule) {
                $flightsArray[] = array_merge(
                    $route->toArray(), // Atributos de la ruta
                    ['flight_schedule' => $flightSchedule] // Añadimos el flight_schedule
                );
            }

            // Luego agregamos las escalas, separando cada flight_schedule de cada stop
            foreach ($route->stops as $stop) {
                foreach ($stop->flight_schedules as $flightSchedule) {
                    $flightsArray[] = array_merge(
                        $stop->toArray(), // Atributos del stop (escala)
                        ['flight_schedule' => $flightSchedule] // Añadimos el flight_schedule
                    );
                }
            }
        }

        return response()->json([
            'flights' => $flightsArray,
        ]);
    }



}
