<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cab
 * 
 * @property int $id
 * @property string $owner_name
 * @property string $company_name
 * @property string $company_address
 * @property string $gst_number
 * @property string $owner_contact
 * @property string $owner_email
 * @property string $owner_upi
 * @property string $driver_name
 * @property string $driver_license
 * @property string $vehicle_number
 * @property string $vehicle_model
 * @property array $vehicle_features
 * @property string|null $docs
 * @property int $cab_verified
 * @property int|null $vehicle_default_location
 * @property int|null $vehicle_current_location
 * @property int $km_price
 * @property int $yr_of_exp
 * @property int $min_charge
 * @property string $driver_img
 * @property string $vehicle_img
 * @property int $cab_status
 * 
 * @property City|null $city
 * @property Collection|CabBookingBid[] $cab_booking_bids
 * @property Collection|CabBooking[] $cab_bookings
 * @property Collection|CabRoute[] $cab_routes
 *
 * @package App\Models
 */
class Cab extends Model
{
	protected $table = 'cabs';
	public $timestamps = false;

	protected $casts = [
		'cab_verified' => 'int',
		'vehicle_default_location' => 'int',
		'vehicle_current_location' => 'int',
		'km_price' => 'int',
		'yr_of_exp' => 'int',
		'min_charge' => 'int',
		'cab_status' => 'int',
		"vehicle_features" => "string",
		
	];

	protected $fillable = [
		'owner_name',
		'company_name',
		'company_address',
		'gst_number',
		'owner_contact',
		'owner_email',
		'owner_upi',
		'driver_name',
		'driver_license',
		'vehicle_number',
		'vehicle_model',
		'vehicle_features',
		'docs',
		'cab_verified',
		'vehicle_default_location',
		'vehicle_current_location',
		'km_price',
		'yr_of_exp',
		'min_charge',
		'driver_img',
		'vehicle_img',
		'cab_status'
	];

	public function city()
	{
		return $this->belongsTo(City::class, 'vehicle_default_location');
	}

	public function cab_booking_bids()
	{
		return $this->hasMany(CabBookingBid::class);
	}

	public function cab_bookings()
	{
		return $this->hasMany(CabBooking::class, 'booked_cab');
	}

	public function cab_routes()
	{
		return $this->hasMany(CabRoute::class);
	}
}
