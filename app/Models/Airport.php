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
 * Class Airport
 * 
 * @property int $id
 * @property string $code
 * @property string $city
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Route[] $routes
 *
 * @package App\Models
 */
class Airport extends Model
{
	use SoftDeletes;
	protected $table = 'airports';

	protected $fillable = [
		'code',
		'city'
	];

	public function routes()
	{
		return $this->hasMany(Route::class, 'origin_airport_id');
	}
}
