<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Employeeteam
 * 
 * @property int $id
 * @property int $leader_id
 * @property string $team_name
 * @property string $team_desc
 * @property string $team_logo
 * @property string $team_banner
 * @property string $team_color
 * @property int $team_status
 *
 * @package App\Models
 */
class Employeeteam extends Model
{
	protected $table = 'employeeteams';
	public $timestamps = false;

	protected $casts = [
		'leader_id' => 'int',
		'team_status' => 'int'
	];

	protected $fillable = [
		'leader_id',
		'team_name',
		'team_desc',
		'team_logo',
		'team_banner',
		'team_color',
		'team_status'
	];
}
