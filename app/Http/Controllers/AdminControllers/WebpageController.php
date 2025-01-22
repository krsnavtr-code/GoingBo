<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Webpage;
use Illuminate\Http\Request;

class WebpageController extends Controller
{
    function check_existBySlug($slug)
    {
        $page = Webpage::where("slug", $slug)->first();
        return count($page ? $page->toArray() : []) > 0;
    }
    function create_page($params)
    {
        return self::add_webpage($params);
    }

    function ui_view_webpages()
    {
        $data = ["webpages" => Webpage::all()->toArray()];
        return view("admin.webpage.view_webpages", $data);
    }
    function ui_add_webpage()
    {
        return view("admin.webpage.add_webpage");
    }
    function ui_edit_webpage($webpageId)
    {
        $webpage = Webpage::find($webpageId);
        if (!$webpage) abort(404);
        $data = ["webpage" => $webpage->toArray()];
        return view("admin.webpage.edit_webpage", $data);
    }

    function web_add_webpage(Request $request)
    {
        $params = [
            "slug" => $request->page_slug,
            "page_title" => $request->page_title,
            "page_desc" => $request->page_desc,
            "page_keywords" => $request->page_keywords,
            "other_meta_tags" => $request->other_meta
        ];
        session()->flash('result', self::add_webpage($params));
        return redirect()->back();
    }
    function web_edit_webpage(Request $request)
    {
        $params = [
            "page_title" => $request->page_title,
            "page_desc" => $request->page_desc,
            "page_keywords" => $request->page_keywords,
            "other_meta_tags" => $request->other_meta
        ];
        // foreach ($params as $key => $value) {
        //     if(!$value) unset($params[$key]);
        // }
        session()->flash('result', self::edit_webpage($request->webpageId, $params));
        return redirect()->back();
    }

    function api_add_webpage(Request $request)
    {
    }
    function api_edit_webpage(Request $request)
    {
    }

    private function add_webpage($params)
    {
        if (self::check_existBySlug($params['slug'])) {
            return ["success" => false, "msg" => "Slug Already Exists."];
        }
        $page = new Webpage($params);
        return ["success" => $page->save(), "slugId" => $page->id];
    }
    private function edit_webpage($webpageId, $params)
    {
        return ["success" => Webpage::find($webpageId)->update($params)];
    }
}
