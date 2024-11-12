<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Route
 * 
 * @property int $id
 * @property int $airplane_id
 * @property int $origin_airport_id
 * @property int $destination_airport_id
 * @property bool $direct
 * @property int $duration
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Airplane $airplane
 * @property Airport $airport
 * @property Collection|FlightSchedule[] $flight_schedules
 *
 * @package App\Models
 */
class Route extends Model
{
	use SoftDeletes;
	protected $table = 'routes';

	public $stops = [];

	protected $casts = [
		'airplane_id' => 'int',
		'origin_airport_id' => 'int',
		'destination_airport_id' => 'int',
		'direct' => 'bool',
		'duration' => 'int'
	];

	protected $fillable = [
		'airplane_id',
		'origin_airport_id',
		'destination_airport_id',
		'direct',
		'duration'
	];

	public function airplane()
	{
		return $this->belongsTo(Airplane::class);
	}

	public function airport()
	{
		return $this->belongsTo(Airport::class, 'origin_airport_id');
	}

	public function flight_schedules()
	{
		return $this->hasMany(FlightSchedule::class);
	}

	public function route()
    {
        return $this->belongsTo(Route::class, 'route_id'); // Relación con la ruta de la escala
    }

    // Relación para obtener todos los vuelos de escalas asociados a una ruta
    public function stops()
    {
        return $this->hasMany(Route::class, 'route_id'); // Vuelos con la misma route_id
    }

}
