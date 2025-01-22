<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Airport
 * 
 * @property int $id
 * @property string $destination_code
 * @property string $airport_name
 * @property string $airport_code
 * @property string $airport_city
 * @property string $airport_city_code
 * @property int|null $country_id
 * @property string|null $airport_country
 * @property string|null $airport_country_code
 * 
 * @property Country|null $country
 *
 * @package App\Models
 */
class Airport extends Model
{
	protected $table = 'airports';
	public $timestamps = false;

	protected $casts = [
		'country_id' => 'int'
	];

	protected $fillable = [
		'destination_code',
		'airport_name',
		'airport_code',
		'airport_city',
		'airport_city_code',
		'country_id',
		'airport_country',
		'airport_country_code'
	];

	public function country()
	{
		return $this->belongsTo(Country::class);
	}
}
