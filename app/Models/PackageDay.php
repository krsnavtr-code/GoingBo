<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PackageDay
 * 
 * @property int $id
 * @property string $day
 * @property string $pck_img
 * @property string $type_of_transport
 * @property string $duration
 * @property string $hotel_name
 * @property string $star
 * @property string $area
 * @property Carbon $date
 * @property string $hotel_include
 * @property string $activity
 * @property string $activity_des
 * @property int $package_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class PackageDay extends Model
{
	protected $table = 'package_days';

	protected $casts = [
		'date' => 'datetime',
		'package_id' => 'int'
	];

	protected $fillable = [
		'day',
		'pck_img',
		'type_of_transport',
		'duration',
		'hotel_name',
		'star',
		'area',
		'date',
		'hotel_include',
		'activity',
		'activity_des',
		'package_id'
	];
}
