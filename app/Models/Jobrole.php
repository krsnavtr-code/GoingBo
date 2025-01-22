<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Jobrole
 * 
 * @property int $id
 * @property string $role_title
 * @property string $role_permissions
 * @property int $is_sensitive
 * 
 * @property Collection|Employee[] $employees
 *
 * @package App\Models
 */
class Jobrole extends Model
{
	protected $table = 'jobroles';
	public $timestamps = false;

	protected $casts = [
		'is_sensitive' => 'int',
		'role_permissions' => "array",
	];

	protected $fillable = [
		'role_title',
		'role_permissions',
		'is_sensitive'
	];

	public function employees()
	{
		return $this->hasMany(Employee::class, 'job_role');
	}
}
