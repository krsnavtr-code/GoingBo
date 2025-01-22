<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Package
 * 
 * @property int $id
 * @property string|null $title
 * @property string|null $image
 * @property string|null $short_des
 * @property string|null $des
 * @property string|null $IP
 * @property string|null $status
 * @property string|null $price
 * @property string|null $slug
 * @property string|null $night
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class Package extends Model
{
	protected $table = 'packages';

	protected $fillable = [
		'title',
		'image',
		'short_des',
		'des',
		'IP',
		'status',
		'price',
		'slug',
		'night',
		'pckg_head',
		'pckg_head_2',
		'pckg_head_3',
		'pckg_head_4',
		'pckg_head_5',
		'pckg_head_6',
		'pckg_head_7',
		'pckg_tags',
		'state_name',
		'country_name',
		'pckg_categories'
	];
}
