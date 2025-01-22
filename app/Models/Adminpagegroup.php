<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Adminpagegroup
 * 
 * @property int $id
 * @property string $pagegroup_title
 * @property int $pagegroup_index
 * 
 * @property Collection|Adminpage[] $adminpages
 *
 * @package App\Models
 */
class Adminpagegroup extends Model
{
	protected $table = 'adminpagegroups';
	public $timestamps = false;

	protected $casts = [
		'pagegroup_index' => 'int'
	];

	protected $fillable = [
		'pagegroup_title',
		'pagegroup_index'
	];

	public function adminpages()
	{
		return $this->hasMany(Adminpage::class, 'pagegroup_id');
	}
}
