<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Jobrole;
use Illuminate\Http\Request;

define("PROFILE_PATH", public_path("images/profiles"));

class EmployeeController extends Controller
{
    function get_allemps()
    {
        return Employee::with('jobrole')->get()->toArray();
    }
    function get_empById($empId)
    {
        return Employee::with('jobrole')->find($empId)->toArray();
    }
    function get_empByUsername($empUsername)
    {
        return Employee::where('emp_username', $empUsername)->with('jobrole')->first()->toArray();
    }
    function get_self()
    {
        return self::get_empById(session()->get('adminId'));
    }
    function get_permitted_pages()
    {
        $role = self::get_self()['job_role'];
        return Jobrole::find($role)['role_permissions'];
    }

    function ui_login()
    {
        return session()->has("adminId") ? redirect()->route("admin_home") : view("admin.login");
    }
    function ui_view_emps()
    {
        $data=["employees"=>self::get_allemps()];
        return view('admin.employees.view_employees',$data);
    }
    function ui_create_emp()
    {
    }
    function ui_edit_emp()
    {
    }
    function ui_view_roles()
    {
    }
    function ui_create_role()
    {
    }
    function ui_edit_role()
    {
    }

    function web_login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'passcode' => 'required'
        ]);
        $result = self::login($request->username, $request->passcode);
        if ($result['success']) {
            session()->put("adminId", $result['empId']);
            return redirect()->route('admin_home');
        }
        session()->flash('error', $result['msg']);
        return redirect()->back();
    }
    function web_logout()
    {
        self::logout();
        return redirect()->route('admin_login');
    }
    function web_create_emp()
    {
    }
    function web_edit_emp()
    {
    }
    function web_toggle_emp_status()
    {
    }
    function web_create_role()
    {
    }
    function web_edit_role()
    {
    }

    function api_login()
    {
    }
    function api_logout()
    {
    }
    function api_create_emp()
    {
    }
    function api_edit_emp()
    {
    }
    function api_toggle_emp_status()
    {
    }
    function api_create_role()
    {
    }
    function api_edit_role()
    {
    }

    private function login($username, $password)
    {
        $ed = Employee::where('emp_username', $username)->first();
        if ($ed) {
            $employee_data = $ed->getOriginal();
            if (!$employee_data['emp_status']) {
                return ["success" => false, "msg" => "Contact HR"];
            } else if ($employee_data['emp_password'] == $password) {
                return ["success" => true, "empId" => $employee_data['id']];
            }
        }
        return ["success" => false, "msg" => "Invalid Credentials"];
    }
    private function logout()
    {
        return ['success' => session()->flush()];
    }
    private function create_emp()
    {
    }
    private function edit_emp()
    {
    }
    private function toggle_emp_status()
    {
    }
    private function create_role()
    {
    }
    private function edit_role()
    {
    }
}
