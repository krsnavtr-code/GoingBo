<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Adminpage;
use App\Models\Adminpagegroup;
use Illuminate\Http\Request;

class AdminPagesController extends Controller
{
    static function get_pages()
    {
        return Adminpage::all()->toArray();
    }
    static function get_allowed_pages()
    {
        $allowed = [];
        $empController = new EmployeeController;
        $permission = $empController->get_permitted_pages();
        if ($permission[0] == "*") return self::get_pages();
        foreach (self::get_pages() as $page) {
            if (in_array($page['id'], $permission)) $allowed[] = $page;
        }
        return $allowed;
    }
    static function get_display_pages()
    {
        $allowed = [];
        foreach (self::get_allowed_pages() as $page) {
            if ($page['page_status'] && $page['can_display'])
                $allowed[] = $page;
        }
        return $allowed;
    }
    static function get_pagegroups()
    {
        return Adminpagegroup::orderBy('pagegroup_index', 'asc')->get()->toArray();
    }
    static function get_pages_in_group()
    {
        $groups = [];
        foreach (Adminpagegroup::with('adminpages')->get()->toArray() as $group)
            if ($group['adminpages']) $groups[] = $group;
        return $groups;
    }
    static function get_allowed_pages_in_group()
    {
        $groups = [];
        $empController = new EmployeeController;
        $permission = $empController->get_permitted_pages();
        $tmp_groups = self::get_pages_in_group();
        if ($permission[0] == "*") return $tmp_groups;
        for ($i = 0; $i < count($tmp_groups); $i++) {
            $allowed = [];
            foreach ($tmp_groups[$i]['adminpages'] as $page) {
                if (in_array($page['id'], $permission))
                    $allowed[] = $page;
            }
            if ($allowed) {
                $tmp_groups[$i]['adminpages'] = $allowed;
                $groups[] = $tmp_groups[$i];
            }
        }
        return $groups;
    }
    static function get_display_pages_in_group()
    {
        $groups = [];
        $tmp_groups = self::get_allowed_pages_in_group();
        for ($i = 0; $i < count($tmp_groups); $i++) {
            $allowed = [];
            foreach ($tmp_groups[$i]['adminpages'] as $page) {
                if ($page['page_status'] && $page['can_display'])
                    $allowed[] = $page;
            }
            if ($allowed) {
                $tmp_groups[$i]['adminpages'] = $allowed;
                $groups[] = $tmp_groups[$i];
            }
        }
        return $groups;
    }

    function ui_view_pages()
    {
        $data = ["pages" => Adminpage::with('adminpagegroup')->get()->toArray()];
        return view("admin.adminpage.view_pages", $data);
    }
    function ui_create_page()
    {
        $data = ["groups" => self::get_pagegroups()];
        return view("admin.adminpage.create_page", $data);
    }
    function ui_edit_page($pageId)
    {
        $data = ["page" => Adminpage::with('adminpagegroup')->find($pageId)->toArray()];
        return view("admin.adminpage.edit_page", $data);
    }
    function ui_view_pagegroups()
    {
        $data = ["groups" => self::get_pages_in_group()];
        return view("admin.adminpage.view_pagegroups", $data);
    }
    function ui_create_pagegroup()
    {
        $data = ["pages" => self::get_pages()];
        return view("admin.adminpage.create_pagegroup", $data);
    }
    function ui_edit_pagegroup($groupId)
    {
        $data = ["group" => Adminpagegroup::with('adminpages')->find($groupId)->toArray()];
        return view("admin.adminpage.edit_pagegroup", $data);
    }

    function web_create_page(Request $request)
    {
        $request->validate([
            "page_title" => "required",
            "page_url" => "required",
        ]);
        $params = [
            "admin_page_title" => $request->page_title,
            "admin_page_url" => $request->page_url,
            "admin_page_group" => $request->page_group ?? 0,
            "can_display" => $request->can_display ?? 0,
            "admin_page_status" => $request->page_status ?? 0,
        ];
        session()->flash('result', self::create_page($params));
        return redirect()->back();
    }
    function web_edit_page(Request $request)
    {
        $params = [];
        session()->flash('result', self::edit_page($request->pageId, $params));
        return redirect()->back();
    }
    function web_create_pagegroup(Request $request)
    {
        $request->validate([
            "group_title" => "required",
            "group_index" => "required",
        ]);
        $params = [
            "pagegroup_title" => $request->group_title,
            "pagegroup_index" => $request->group_index
        ];
        session()->flash('result', self::create_pagegroup($params));
        return redirect()->back();
    }
    function web_edit_pagegroup(Request $request)
    {
        $params = [];
        session()->flash('result', self::edit_pagegroup($request->groupId, $params));
        return redirect()->back();
    }
    function web_toggle_page_status(Request $request)
    {
        session()->flash('result', self::toggle_page_status($request->pageId));
        return redirect()->back();
    }

    function api_create_page()
    {
    }
    function api_edit_page()
    {
    }
    function api_create_pagegroup()
    {
    }
    function api_edit_pagegroup()
    {
    }
    function api_toggle_page_status()
    {
    }

    private function create_page($params)
    {
        $page = new Adminpage([
            "admin_page_title" => $params['admin_page_title'],
            "admin_page_url" => $params['admin_page_url'],
            "admin_page_group" => $params['admin_page_group'],
            "can_display" => $params['can_display'],
            "admin_page_status" => $params['admin_page_status']
        ]);
        return ["success" => $page->save()];
    }
    private function edit_page($pageId, $params)
    {
        return ["success" => Adminpage::find($pageId)->update($params)];
    }
    private function create_pagegroup($params)
    {
        $group = new Adminpagegroup([
            "pagegroup_title" => $params['pagegroup_title'],
            "pagegroup_index" => $params['pagegroup_index']
        ]);
        return ["success" => $group->save()];
    }
    private function edit_pagegroup($groupId, $params)
    {
        return ["success" => Adminpagegroup::find($groupId)->update($params)];
    }
    private function toggle_page_status($pageId)
    {
        $page = Adminpage::find($pageId);
        $page->admin_page_status = !$page->admin_page_status;
        return  ["success" => $page->save()];
    }
}
