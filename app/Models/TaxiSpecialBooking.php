<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TaxiSpecialBooking
 * 
 * @property int $id
 * @property string $to_desti
 * @property string $from_desti
 * @property string $username
 * @property string $contact_details
 * @property string $address_details
 * @property string $gst_details
 * @property int $taxi_id
 * @property string $pickup_date
 * @property string $pickup_time
 * @property string $token
 *
 * @package App\Models
 */
class TaxiSpecialBooking extends Model
{
	protected $table = 'taxi_special_booking';
	public $timestamps = false;

	protected $casts = [
		'taxi_id' => 'int'
	];

	protected $hidden = [
		'token'
	];

	protected $fillable = [
		'to_desti',
		'from_desti',
		'username',
		'contact_details',
		'address_details',
		'gst_details',
		'taxi_id',
		'pickup_date',
		'pickup_time',
		'token'
	];
}
