<?php

namespace App\Http\Controllers;

use App\Http\Resources\AirportResource;
use App\Models\Airport;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    public function index() 
    {
        $airports = Airport::all();

        return AirportResource::collection($airports);
    }
}
