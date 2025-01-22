<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Adminpage
 * 
 * @property int $id
 * @property int $pagegroup_id
 * @property string $page_title
 * @property string $page_url
 * @property int $can_display
 * @property int $page_status
 * 
 * @property Adminpagegroup $adminpagegroup
 *
 * @package App\Models
 */
class Adminpage extends Model
{
	protected $table = 'adminpages';
	public $timestamps = false;

	protected $casts = [
		'pagegroup_id' => 'int',
		'can_display' => 'int',
		'page_status' => 'int'
	];

	protected $fillable = [
		'pagegroup_id',
		'page_title',
		'page_url',
		'can_display',
		'page_status'
	];

	public function adminpagegroup()
	{
		return $this->belongsTo(Adminpagegroup::class, 'pagegroup_id');
	}
}
