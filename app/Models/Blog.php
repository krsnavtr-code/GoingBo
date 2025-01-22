<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Blog
 * 
 * @property int $id
 * @property int $cat_id
 * @property int $writer_id
 * @property int|null $slug_id
 * @property string $blog_title
 * @property string $blog_content
 * @property string $blog_pic
 * @property int $blog_status
 * @property Carbon $created_on
 * 
 * @property BlogCategory $blog_category
 * @property Webpage|null $webpage
 * @property Employee $employee
 *
 * @package App\Models
 */
class Blog extends Model
{
	protected $table = 'blogs';
	public $timestamps = false;

	protected $casts = [
		'cat_id' => 'int',
		'writer_id' => 'int',
		'slug_id' => 'int',
		'blog_status' => 'int',
		'created_on' => 'datetime'
	];

	protected $fillable = [
		'cat_id',
		'writer_id',
		'slug_id',
		'blog_title',
		'blog_content',
		'blog_pic',
		'blog_status',
		'created_on'
	];

	public function blog_category()
	{
		return $this->belongsTo(BlogCategory::class, 'cat_id');
	}

	public function webpage()
	{
		return $this->belongsTo(Webpage::class, 'slug_id');
	}

	public function employee()
	{
		return $this->belongsTo(Employee::class, 'writer_id');
	}
}
