<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessLogin;


class BusinessLoginController extends Controller
{
    public function web_store(Request $request)
    {
        // dd(request()->all());

        // Generate username with company name + random 5 digit number + "_goingbo"
        $randomNumber = rand(10000, 99999);
        $username = $request->companyName . '_' . $randomNumber . '_goingbo';

        // Store data in business_login table
        $businessLogin = BusinessLogin::create([
            'company_name' => $request->companyName,
            'contact_no' => $request->contactNo,
            'email' => $request->email,
            'city' => $request->city,
            'username' => $username,
            'password' => $request->password,  
            'business_type' => $request->business_type
        ]);

        // Send email with username and password (using PHP mail function)
        $message = "Dear User,\n\nYour account has been successfully created. \nUsername: $username\nPassword: {$request->password}\n\nDon't share these credentials with anyone.\n\nYou can log in here: https://goingbo.com/admin/business-login";

        mail($request->email, 'Your Account Credentials', $message);

        return redirect()->back()->with('success', 'Registration successful! Check your email for login details.');
    }

    public function ui_login()
    {
        return view("admin.business.auth.login");
    }

    public function web_login(Request $request)
    {
        $businessLogin = BusinessLogin::where('username', $request->username)->first();

        if ($businessLogin && $request->password == $businessLogin->password) {
           // Store session and redirect based on business type
           session(['businessId' => $businessLogin->id, 'businessLogin' => $businessLogin]);
            
           return redirect('admin/business-login/dashboard');
       } else {
           return redirect('admin/business-login')->withErrors(['error' => 'Invalid login credentials.']);
       }
    }

    public function index(){

        // Check if businessLoginId exists in the session
        $businessLoginId = session('businessId');

        if (!$businessLoginId) {
            // If no ID found, redirect to the login page
            return redirect('admin/business-login');
        }

        // Fetch business login details from the database
        $businessLogin = BusinessLogin::find($businessLoginId);

        // Check if the business login details were retrieved successfully
        if (!$businessLogin) {
            // If not found, maybe redirect to login or show an error message
            return redirect('admin/business-login')->withErrors(['msg' => 'User not found.']);
        }
        $businessLogin = BusinessLogin::find($businessLoginId);

        // Pass the $businessLogin variable to the view
        return view('admin.business.dashboard', compact('businessLogin'));
    }
    
    public function logout(Request $request)
    {
        session()->flush();
        return redirect('admin/business-login');
    }
}
