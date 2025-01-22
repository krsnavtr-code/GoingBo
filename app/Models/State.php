<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class State
 * 
 * @property int $id
 * @property int $country_id
 * @property string $state_name
 * @property string|null $state_capital
 * @property string|null $state_code
 * @property int $is_union_territory
 * 
 * @property Country $country
 * @property Collection|City[] $cities
 * @property Collection|District[] $districts
 *
 * @package App\Models
 */
class State extends Model
{
	protected $table = 'states';
	public $timestamps = false;

	protected $casts = [
		'country_id' => 'int',
		'is_union_territory' => 'int'
	];

	protected $fillable = [
		'country_id',
		'state_name',
		'state_capital',
		'state_code',
		'is_union_territory'
	];

	public function country()
	{
		return $this->belongsTo(Country::class);
	}

	public function cities()
	{
		return $this->hasMany(City::class);
	}

	public function districts()
	{
		return $this->hasMany(District::class);
	}
}
