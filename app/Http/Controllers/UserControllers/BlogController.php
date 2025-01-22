<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\BaseControllers\BlogBase;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends BlogBase
{
    function ui_view_blogs()
    {
        $data = [
            "blogs" => Blog::with(['webpage:id,slug', 'employee:id,emp_name,emp_username', 'blog_category:id,cat_title'])->get()->toArray(),
            "recent" => Blog::with(['webpage:id,slug', 'employee:id,emp_name,emp_username', 'blog_category:id,cat_title'])->orderBy("created_on", "DESC")->limit(4)->get()->toArray(),
        ];
        return view('user.blog.view_blogs', $data);
    }
    function ui_view_blog_categories()
    {
        $data = ["cats" => BlogCategory::with(['blogs' => function ($query) {
            $query->where("blog_status", 1)->with(['webpage:id,slug', 'employee:id,emp_name,emp_username']);
        }])->get()->toArray()];
        return view('user.blog.view_blog_cats', $data);
    }
    function ui_view_blog($slug)
    {
        $blog = self::get_blogsBySlug($slug);
        if (!$blog['success']) abort(404);
        $data = [
            "blog" => $blog['blog'],
            "related" => Blog::with(['webpage:id,slug', 'employee:id,emp_name,emp_username', 'blog_category:id,cat_title'])->where("cat_id", $blog['blog']['cat_id'])->inRandomOrder()->limit(4)->get()->toArray(),
            "recent" => Blog::with(['webpage:id,slug', 'employee:id,emp_name,emp_username', 'blog_category:id,cat_title'])->orderBy("created_on", "DESC")->limit(3)->get()->toArray()
        ];
        return view('user.blog.view_blog', $data);
    }
}
