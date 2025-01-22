<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PackageBooking
 * 
 * @property int $id
 * @property int $package_id
 * @property string $username
 * @property string|null $contact_details
 * @property string|null $address_details
 * @property string|null $gst_details
 * @property Carbon $checkin
 *
 * @package App\Models
 */
class PackageBooking extends Model
{
	protected $table = 'package_booking';
	public $timestamps = false;

	protected $casts = [
		'package_id' => 'int',
		'checkin' => 'datetime'
	];

	protected $fillable = [
		'package_id',
		'username',
		'contact_details',
		'address_details',
		'gst_details',
		'checkin'
	];
}
