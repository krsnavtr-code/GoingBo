<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class District
 * 
 * @property int $id
 * @property int $country_id
 * @property int $state_id
 * @property string $district_name
 * 
 * @property Country $country
 * @property State $state
 * @property Collection|City[] $cities
 *
 * @package App\Models
 */
class District extends Model
{
	protected $table = 'districts';
	public $timestamps = false;

	protected $casts = [
		'country_id' => 'int',
		'state_id' => 'int'
	];

	protected $fillable = [
		'country_id',
		'state_id',
		'district_name'
	];

	public function country()
	{
		return $this->belongsTo(Country::class);
	}

	public function state()
	{
		return $this->belongsTo(State::class);
	}

	public function cities()
	{
		return $this->hasMany(City::class);
	}
}
