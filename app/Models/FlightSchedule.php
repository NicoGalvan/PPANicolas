<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FlightSchedule
 * 
 * @property int $id
 * @property int $route_id
 * @property int $weekday
 * @property Carbon $departure_time
 * @property Carbon $arrival_time
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Route $route
 *
 * @package App\Models
 */
class FlightSchedule extends Model
{
	use SoftDeletes;
	protected $table = 'flight_schedules';

	protected $casts = [
		'route_id' => 'int',
		'weekday' => 'int',
		'departure_time' => 'datetime',
		'arrival_time' => 'datetime'
	];

	protected $fillable = [
		'route_id',
		'weekday',
		'departure_time',
		'arrival_time'
	];

	public function route()
	{
		return $this->belongsTo(Route::class);
	}
}
