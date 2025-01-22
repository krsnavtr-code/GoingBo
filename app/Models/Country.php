<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Country
 * 
 * @property int $id
 * @property string $country_name
 * @property string|null $country_code2
 * @property string|null $country_code3
 * @property int|null $country_dial_code
 * @property string|null $country_capital
 * @property string|null $country_flag
 * 
 * @property Collection|Airport[] $airports
 * @property Collection|City[] $cities
 * @property Collection|District[] $districts
 * @property Collection|State[] $states
 *
 * @package App\Models
 */
class Country extends Model
{
	protected $table = 'countries';
	public $timestamps = false;

	protected $casts = [
		'country_dial_code' => 'int'
	];

	protected $fillable = [
		'country_name',
		'country_code2',
		'country_code3',
		'country_dial_code',
		'country_capital',
		'country_flag'
	];

	public function airports()
	{
		return $this->hasMany(Airport::class);
	}

	public function cities()
	{
		return $this->hasMany(City::class);
	}

	public function districts()
	{
		return $this->hasMany(District::class);
	}

	public function states()
	{
		return $this->hasMany(State::class);
	}
}
