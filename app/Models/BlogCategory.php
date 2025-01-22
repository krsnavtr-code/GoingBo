<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BlogCategory
 * 
 * @property int $id
 * @property string $cat_title
 * @property string|null $cat_image
 * @property string|null $cat_desc
 * 
 * @property Collection|Blog[] $blogs
 *
 * @package App\Models
 */
class BlogCategory extends Model
{
	protected $table = 'blog_categories';
	public $timestamps = false;

	protected $fillable = [
		'cat_title',
		'cat_image',
		'cat_desc'
	];

	public function blogs()
	{
		return $this->hasMany(Blog::class, 'cat_id');
	}
}
