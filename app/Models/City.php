<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class City
 * 
 * @property int $id
 * @property int $country_id
 * @property int|null $state_id
 * @property int|null $district_id
 * @property string $city_name
 * @property int|null $lat
 * @property int|null $lon
 * 
 * @property Country $country
 * @property District|null $district
 * @property State|null $state
 * @property Collection|CabBooking[] $cab_bookings
 * @property Collection|Cab[] $cabs
 *
 * @package App\Models
 */
class City extends Model
{
	protected $table = 'cities';
	public $timestamps = false;

	protected $casts = [
		'country_id' => 'int',
		'state_id' => 'int',
		'district_id' => 'int',
		'lat' => 'int',
		'lon' => 'int'
	];

	protected $fillable = [
		'country_id',
		'state_id',
		'district_id',
		'city_name',
		'lat',
		'lon'
	];

	public function country()
	{
		return $this->belongsTo(Country::class);
	}

	public function district()
	{
		return $this->belongsTo(District::class);
	}

	public function state()
	{
		return $this->belongsTo(State::class);
	}

	public function cab_bookings()
	{
		return $this->hasMany(CabBooking::class, 'to_city');
	}

	public function cabs()
	{
		return $this->hasMany(Cab::class, 'cab_default_location');
	}
}
