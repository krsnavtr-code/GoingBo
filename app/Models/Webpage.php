<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Webpage
 * 
 * @property int $id
 * @property string $slug
 * @property string $page_title
 * @property string $page_desc
 * @property string $page_keywords
 * @property string|null $meta_image
 * @property string|null $canonical_url
 * @property string|null $other_meta_tags
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Collection|Blog[] $blogs
 *
 * @package App\Models
 */
class Webpage extends Model
{
	protected $table = 'webpages';

	protected $fillable = [
		'slug',
		'page_title',
		'page_desc',
		'page_keywords',
		'meta_image',
		'canonical_url',
		'other_meta_tags'
	];

	public function blogs()
	{
		return $this->hasMany(Blog::class, 'slug_id');
	}
}
