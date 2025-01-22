<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CabRoute
 * 
 * @property int $id
 * @property int $cab_id
 * @property int $from_location
 * @property int $to_location
 * @property int $price
 * @property string $night_halt
 * @property bool $is_reserved
 * @property Carbon|null $reserved_at
 * @property int $route_status
 * 
 * @property Cab $cab
 * @property City $city
 *
 * @package App\Models
 */
class CabRoute extends Model
{
	protected $table = 'cab_routes';
	public $timestamps = false;

	protected $casts = [
		'cab_id' => 'int',
		'from_location' => 'int',
		'to_location' => 'int',
		'price' => 'int',
		'reserved_at' => 'int',
		'route_status' => 'int',
	];

	protected $fillable = [
		'cab_id',
		'from_location',
		'to_location',
		'price',
		'night_halt',
		'free_cancel',
		'coupon',
		'is_reserved',
		'reserved_at',
		'route_status'
	];

	public function cab()
	{
		return $this->belongsTo(Cab::class);
	}

	public function from_city()
	{
		return $this->belongsTo(City::class, 'from_location');
	}
	
	public function to_city()
	{
		return $this->belongsTo(City::class, 'to_location');
	}
}
