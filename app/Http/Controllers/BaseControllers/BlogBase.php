<?php

namespace App\Http\Controllers\BaseControllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Webpage;
use Illuminate\Http\Request;

class BlogBase extends Controller
{
    function get_categories()
    {
        return BlogCategory::all()->toArray();
    }
    function get_categories_with_blogs()
    {
        return BlogCategory::with('blogs')->get()->toArray();
    }
    function get_blogs()
    {
        return Blog::with(['webpage', 'employee:id,emp_name,emp_username', 'blog_category:id,cat_title'])->get()->toArray();
    }
    function get_blogsBySlug($slug)
    {
        $webpage = Webpage::where("slug", "blogs/$slug")->first();
        if (!$webpage) return ["success" => false];
        return ["success" => true, "blog" => Blog::with(['webpage', 'employee:id,emp_name,emp_username', 'blog_category:id,cat_title'])->where('slug_id', $webpage->id)->first()->toArray()];
    }
}
