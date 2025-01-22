<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Airline
 * 
 * @property int $id
 * @property string $airline_name
 * @property string $airline_code
 *
 * @package App\Models
 */
class Airline extends Model
{
	protected $table = 'airlines';
	public $timestamps = false;

	protected $fillable = [
		'airline_name',
		'airline_code'
	];
}
