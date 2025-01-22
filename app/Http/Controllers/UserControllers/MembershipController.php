<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\ApiControllers\RazorPayController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function ui_book_membership($type)
    {
        if ($type == "Silver" || $type == "Golden" || $type == "Platinum" || $type == "Diamond") {
            return view('user.membership.book', ["type" => $type]);
        } else {
            abort(404);
        }
    }

    public function web_book_membership(Request $request, $type)
    {

        if (!session()->has('user')) {
            UserController::quick_login(["contact" => $request->mobile_no, "email" => $request->email]);
        }


        // Define fare values for each card type
        $fareMapping = [
            'Silver'   => 24999,
            'Golden'   => 34999,
            'Platinum' => 44999,
            'Diamond'  => 54999,
        ];

        $fare = $fareMapping[$type];
        // dd($fare) ;
        $gst = 18;
        $total = round($fare + $fare * $gst / 100);
        
        // dd($gst);

        // dd($total);
        session()->put([
            'fareSummary' => [
                'type' => $type,
                'name' => $request->name,
                'email' => $request->email,
                'mobileNo' => $request->mobile_no,
                'agegroup' => $request->agegroup,
                'fare' => $fare,
                'gst' => round($fare * $gst/100) ,
                'total' => $total,
            ],
        ]);
        // dd(session('fareSummary'));
        return view("user.membership.checkout", ["type" => $type, "request" => $request, "gst" => $gst, "fare" => $fare, "total" => $total] + RazorPayController::make_order($total));
    }

    public function ui_ticket_membership()
    {
        // dd($request->all());
        // $verify = RazorPayController::verify_signature(
        //     $request->razorpay_order_id,
        //     $request->razorpay_payment_id,
        //     $request->razorpay_signature,
        // );
        // dd(session('fareSummary'));
        // dd($verify);
        // if ($verify['success']) {
           


        $fareSummary = session('fareSummary');
        
        // You can now use $fareSummary to access the stored values
        $bookingid = Str::random(5) . now()->timestamp;
        $type = $fareSummary['type'];
        $name = $fareSummary['name'];
        $email = $fareSummary['email'];
        $mobileNo = $fareSummary['mobileNo'];
        $agegroup = $fareSummary['agegroup'];


        $fare = $fareSummary['fare'];
        $gst = $fareSummary['gst'];
        $charges = 0;
        $total = $fareSummary['total'];

        $data = [
            'bookingid' => $bookingid,
            'type' => $type,
            'name' => $name,
            'email' => $email,
            'mobileNo' => $mobileNo,
            'fare' => $fare,
            'charges' => $charges,
            'gst' => $gst,
            'total' => $total,

        ];
        return view("user.membership.ticket", $data ?? []);
    }
}
