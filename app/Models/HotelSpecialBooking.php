<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HotelSpecialBooking
 * 
 * @property int $id
 * @property int $hotel_id
 * @property string $room_type
 * @property int $rooms
 * @property Carbon $checkin
 * @property int $days
 * @property int $user_id
 * @property string $username
 * @property string $contact_details
 * @property string $address_details
 * @property string $gst_details
 * @property string $payment_details
 * @property string $token
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class HotelSpecialBooking extends Model
{
	protected $table = 'hotel_special_booking';
	public $timestamps = false;

	protected $casts = [
		'hotel_id' => 'int',
		'rooms' => 'int',
		'checkin' => 'datetime',
		'days' => 'int',
		'user_id' => 'int'
	];

	protected $hidden = [
		'token'
	];

	protected $fillable = [
		'hotel_id',
		'room_type',
		'rooms',
		'checkin',
		'days',
		'user_id',
		'username',
		'contact_details',
		'address_details',
		'gst_details',
		'payment_details',
		'token'
	];
}
