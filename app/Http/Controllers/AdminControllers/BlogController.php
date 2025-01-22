<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\BaseControllers\BlogBase;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends BlogBase
{
    protected const IMG_PATH = parent::IMG_PATH . "blogs/";

    function ui_view_blogs()
    {
        $data = ["blogs" => self::get_blogs()];
        return view("admin.blog.view_blogs", $data);
    }
    function ui_editor()
    {
        $data = ["categories" => self::get_categories()];
        return view("admin.blog.editor", $data);
    }
    function ui_view_categories()
    {
        $data = ["categories" => self::get_categories_with_blogs()];
        return view("admin.blog.view_categories", $data);
    }
    function ui_create_category()
    {
        return view("admin.blog.create_category");
    }
    function ui_edit_category($catId)
    {
        $cat = BlogCategory::find($catId);
        if (!$cat) abort(404);
        $data = ["cat" => $cat->toArray()];
        return view("admin.blog.edit_category", $data);
    }

    function web_editor(Request $request)
    {
        $params = [
            "webpage_params" => [
                "slug" => $request->page_slug,
                "page_title" => $request->page_title,
                "page_desc" => $request->page_desc,
                "page_keywords" => $request->page_keywords,
                "other_meta_tags" => $request->other_meta
            ],
            "blog_params" => [
                "cat_id" => $request->cat_id,
                "writer_id" => session()->get('adminId'),
                "blog_title" => $request->blog_title,
                "blog_content" => $request->blog_content,
                "blog_pic" => $request->blog_pic,
            ]
        ];
        session()->flash('result', self::editor($params));
        return redirect()->back();
    }
    function web_toggle_blog_status(Request $request)
    {
        session()->flash('result', self::toggle_blog_status($request->blogId));
        return redirect()->back();
    }
    function web_create_category(Request $request)
    {
        $params = [
            "cat_title" => $request->cat_title,
            "cat_image" => $request->cat_image,
            "cat_desc" => $request->cat_desc
        ];
        session()->flash('result', self::create_category($params));
        return redirect()->back();
    }
    function web_edit_category(Request $request)
    {
        $params = [
            "cat_title" => $request->cat_title,
            "cat_image" => $request->cat_image,
            "cat_desc" => $request->cat_desc
        ];
        session()->flash('result', self::edit_category($request->catId, $params));
        return redirect()->back();
    }

    function api_toggle_blog_status($blogId)
    {
        return self::api_response(self::toggle_blog_status($blogId));
    }
    // function api_editor(Request $request){dd($request->all());}
    // function api_create_category(Request $request){dd($request->all());}
    // function api_edit_category(Request $request){dd($request->all());}

    private function editor($params)
    {
        $webpage = new WebpageController();
        $result = $webpage->create_page($params['webpage_params']);
        if ($params['blog_params']['blog_pic']) {
            $moved = $this->move_file($params['blog_params']['blog_pic']);
            $params['blog_params']['blog_pic'] = $moved['filename'];
        }
        if ($result['success']) {
            $blog = new Blog($params['blog_params'] + ["slug_id" => $result['slugId']]);
            return ["success" => $blog->save()];
        } else {
            $blog = new Blog($params['blog_params']);
            $blog->save();
            return ["success" => false, "msg" => ($result['msg'] ?? "Web page not Created.") . " Just tell developer."];
        }
    }
    private function toggle_blog_status($blogId)
    {
        $blog = Blog::find($blogId);
        if (!$blog) return ["success" => false, "msg" => "Blog not exists"];
        $blog->blog_status = !$blog->blog_status;
        return  ["success" => $blog->save(), "msg" => $blog->blog_status ? "Blog Enabled" : "Blog Disabled"];
    }
    private function create_category($params)
    {
        if ($params['cat_image']) {
            $moved = $this->move_file($params['cat_image'], self::IMG_PATH . "category");
        }
        $cat = new BlogCategory([
            "cat_title" => $params['cat_title'],
            "cat_image" => $moved['filename'],
            "cat_desc" => $params['cat_desc']
        ]);
        return ["success" => $cat->save()];
    }
    private function edit_category($catId, $params)
    {
        if (!$params['cat_image']) unset($params['cat_image']);
        $moved = $this->move_file($params['cat_image'], self::IMG_PATH . "category");
        $params['cat_image'] = $moved['filename'];
        return ["success" => BlogCategory::find($catId)->update($params)];
    }
}
