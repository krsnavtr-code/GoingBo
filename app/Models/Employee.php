<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Employee
 * 
 * @property int $id
 * @property int $job_role
 * @property string $emp_username
 * @property string $emp_name
 * @property string $emp_password
 * @property int $emp_status
 * 
 * @property Jobrole $jobrole
 * @property Collection|Blog[] $blogs
 *
 * @package App\Models
 */
class Employee extends Model
{
	protected $table = 'employees';
	public $timestamps = false;

	protected $casts = [
		'job_role' => 'int',
		'emp_status' => 'int'
	];

	protected $hidden = [
		'emp_password'
	];

	protected $fillable = [
		'job_role',
		'emp_username',
		'emp_name',
		'emp_password',
		'emp_status'
	];

	public function jobrole()
	{
		return $this->belongsTo(Jobrole::class, 'job_role');
	}

	public function blogs()
	{
		return $this->hasMany(Blog::class, 'writer_id');
	}
}
