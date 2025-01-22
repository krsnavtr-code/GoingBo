<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CabBooking
 * 
 * @property int $id
 * @property int $from_city
 * @property int $to_city
 * @property int $passengers
 * @property Carbon $date
 * @property Carbon $time
 * @property int $booked_cab
 * @property int|null $bid_status
 * @property string|null $bid_unique_code
 * 
 * @property Cab $cab
 * @property City $city
 * @property Collection|CabBookingBid[] $cab_booking_bids
 *
 * @package App\Models
 */
class CabBooking extends Model
{
	protected $table = 'cab_bookings';
	public $timestamps = false;

	protected $casts = [
		'from_city' => 'string',
		'to_city' => 'string',
		'user_id' => 'int',
		'passengers' => 'int',
		'date' => 'datetime',
		'time' => 'datetime',
		'booked_cab' => 'int',
		'bid_status' => 'int',
		'booking_unique_id' => 'string',
		'payment_details' => 'json',

	];

	protected $fillable = [
		'from_city',
		'to_city',
		'user_id',
		'passengers',
		'date',
		'time',
		'booked_cab',
		'bid_status',
		'bid_unique_code'
	];

	public function cab()
	{
		return $this->belongsTo(CabRoute::class, 'booked_cab');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function cab_booking_bids()
	{
		return $this->hasMany(CabBookingBid::class, 'booking_unique_id');
	}
}
