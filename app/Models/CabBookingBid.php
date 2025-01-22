<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CabBookingBid
 * 
 * @property int $id
 * @property int $cab_id
 * @property int $booking_id
 * @property int $price
 * 
 * @property CabBooking $cab_booking
 * @property Cab $cab
 *
 * @package App\Models
 */
class CabBookingBid extends Model
{
	protected $table = 'cab_booking_bids';
	public $timestamps = false;

	protected $casts = [
		'cab_id' => 'int',
		'booking_id' => 'int',
		'price' => 'int'
	];

	protected $fillable = [
		'cab_id',
		'booking_id',
		'price'
	];

	public function cab_booking()
	{
		return $this->belongsTo(CabBooking::class, 'booking_id');
	}

	public function cab()
	{
		return $this->belongsTo(Cab::class);
	}
}
