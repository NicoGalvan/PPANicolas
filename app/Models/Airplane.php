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
 * Class Airplane
 * 
 * @property int $id
 * @property string $brand
 * @property string $model
 * @property bool $status
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Route[] $routes
 *
 * @package App\Models
 */
class Airplane extends Model
{
	use SoftDeletes;
	protected $table = 'airplanes';

	protected $casts = [
		'status' => 'bool'
	];

	protected $fillable = [
		'brand',
		'model',
		'status'
	];

	public function routes()
	{
		return $this->hasMany(Route::class);
	}
}
