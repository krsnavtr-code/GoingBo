<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Coupon
 * 
 * @property int $id
 * @property string $coupon_code
 * @property string $coupon_desc
 * @property string $coupon_terms
 * @property int $coupon_min_discount
 * @property int $coupon_max_discount
 * @property string $allowed_for
 * @property string $applicable_for
 * @property string|null $used_by
 * @property int|null $valid_till
 * @property Carbon $created_on
 *
 * @package App\Models
 */
class Coupon extends Model
{
	protected $table = 'coupons';
	public $timestamps = false;

	protected $casts = [
		'coupon_min_discount' => 'int',
		'coupon_max_discount' => 'int',
		'valid_till' => 'int',
		'created_on' => 'datetime',
		'allowed_for' => 'array',
		'used_by' => 'array',
		'applicable_for' => 'array',
	];

	protected $fillable = [
		'coupon_code',
		'coupon_desc',
		'coupon_terms',
		'coupon_min_discount',
		'coupon_max_discount',
		'allowed_for',
		'applicable_for',
		'used_by',
		'valid_till',
		'created_on'
	];
}
