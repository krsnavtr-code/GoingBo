<?php

namespace App\Http\Middleware;

use App\Http\Controllers\AdminControllers\EmployeeController;
use App\Models\Adminpage;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the route starts with 'business-login' to bypass AdminAuth
        if ($request->is('admin/business-login*')) {
            return $next($request);  // Bypass admin auth for business-login routes
        }

        /** Redirecting to login if user is not logged in */
        if (!session()->has("adminId"))
            return redirect()->route("admin_login");

        /* Getting Employee data */
        $empCon = new EmployeeController;
        $admin = $empCon->get_self();

        /** Redirecting to logout if user  is disabled */
        if (!$admin['emp_status'])
            return redirect()->route('admin_logout');

        /** Path of current request */
        $path = $request->path();
        $page = ["current_slug" => "","current"=>"admin"];

        if (strpos($path, "/") !== false) {
            /** It should be admin/slug. So remove admin */
            $slug = substr($path, strpos($path, "/") + 1);

            /** Checking if last is numeric (remove if true) */
            if (is_numeric(substr($path, -1, 1))) {
                $slug = substr($slug, 0, strrpos($slug, "/"));
            }
            $page["current_slug"] = $slug;
            $page["current"] = "admin/".$slug;

            /** Getting page details */
            $pg = Adminpage::with('adminpagegroup')->where("page_url", $slug)->first()->toArray();
            $page["page_group"] = $pg['pagegroup_id'];

            /** Get Pages allowed to current user */
            $permissions = $empCon->get_permitted_pages();

            /** Checking if page is not disable Or permitted */
            if (!($pg['page_status'] && (in_array($pg['id'], $permissions) || $permissions[0] == '*'))) {
                return redirect()->route('admin_home');
            }
        }

        /** Sharing data to views */
        View::share(['admin' => $admin, "page" => $page]);
        return $next($request);
    }
}
