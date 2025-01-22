<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Flightbooking
 * 
 * @property int $id
 * @property int $user_id
 * @property string|null $payment_id
 * @property string $from_airport
 * @property string $to_airport
 * @property Carbon $journey_date
 * @property string $pnr
 * @property string $bookingid
 * @property string|null $ticket
 * @property string $payment
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Flightbooking extends Model
{
	protected $table = 'flightbookings';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'journey_date' => 'datetime',
		'ticket'=>'array',
		'payment'=>'array'
	];

	protected $fillable = [
		'user_id',
		'payment_id',
		'from_airport',
		'to_airport',
		'journey_date',
		'pnr',
		'bookingid',
		'ticket',
		'payment'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
