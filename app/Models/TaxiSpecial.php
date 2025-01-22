<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TaxiSpecial
 * 
 * @property int $id
 * @property string|null $to_destination
 * @property string|null $from_destination
 * @property string|null $distance_kms
 * @property string|null $cab_type
 * @property string $cab_model
 * @property string $vehicle_no
 * @property string $vehicle_Insu
 * @property string|null $overall_hours
 * @property string|null $overall_minutes
 * @property string|null $extra_charge
 * @property string|null $total_price
 * @property string|null $cab_seat
 * @property string|null $luggage_bags
 * @property string|null $car_ac_nonac
 * @property string|null $fuel_type
 * @property string|null $travelldate
 * @property string|null $endddate
 * @property string $image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class TaxiSpecial extends Model
{
	protected $table = 'taxi_specials';

	protected $fillable = [
		'to_destination',
		'from_destination',
		'distance_kms',
		'cab_type',
		'cab_model',
		'vehicle_no',
		'vehicle_Insu',
		'overall_hours',
		'overall_minutes',
		'extra_charge',
		'total_price',
		'cab_seat',
		'luggage_bags',
		'car_ac_nonac',
		'fuel_type',
		'travelldate',
		'endddate',
		'image'
	];
}
