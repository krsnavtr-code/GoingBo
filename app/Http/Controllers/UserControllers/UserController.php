<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\ApiControllers\TBOFlight;
use App\Http\Controllers\ApiControllers\RazorPayController;
use App\Http\Controllers\BaseControllers\UserBase;
use App\Models\Flightbooking;
use App\Models\User;
use App\Models\Cab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;


use App\Models\CabBooking;

class UserController extends UserBase
{

    // function store(Request $request){       
    //     print_r($request->all());
    // }

    // function show($flag){
    //     // flag -> 1
    //     // flag -> 0

    //     $query = User::select('email', 'contact');
    //     if($flag == 1){
    //         $query->where('password', null);
    //     } else {
    //         return response()->json(['message' => 'Invalid Flag Token'], 400);
    //     }

    //     $users = $query->get();
    //     if (count($users) > 0){
    //         $response = [
    //             'message' => count($users). ' users found',
    //             'status' => 1,
    //             'data' => $users,
    //         ];
    //         return response()->json($response, 200);
    //     }
    // }


    function fetchcabs(){
        $cabs = CabBooking::with(['cab' => function($query) {
            $query->select('id', 'cab_id', 'from_location', 'to_location', 'price', 'night_halt');
        }, 'cab.cab' => function($query) {
            $query->select('id', 'driver_name', 'company_name', 'vehicle_number', 'vehicle_model');
        }])
        ->where('user_id', session()->get('user')['userId'])
        ->get();


        // dd($cabs->toArray());
        return response()->json([
            'cabs' => $cabs,
        ]);
    }

    function ui_download_cab_ticket($id){

        $cab = CabBooking::where('id', $id)->with('user')->firstOrFail();
        // dd ($cab->toArray());

        // Decode payment_details JSON string to an array
        $paymentDetails = json_decode($cab->payment_details, true);
        
        $data = [
            'bookingid' => $cab->booking_unique_id,
            'name' => $cab->user->name, // Accessing user name
            'email' =>  $cab->user->email, // Accessing user email
            'mobileNo' => $cab->user->contact, // Accessing user mobileNo
            'price' => $paymentDetails['price'],
            'fare' => $paymentDetails['fare'],
            'charges' => $paymentDetails['charges'],
            'gst' => $paymentDetails['gst'],
            'total' => $paymentDetails['total'],
            
        ];

        return view("user.cab.ticket" , $data);
    }

    function ui_login()
    {
        return view('user.login');
    }
    function web_login(Request $request)
    {
        if (self::quick_login(['contact' => $request->contact, 'email' => $request->email])) {
            return redirect()->route('user.home');
        }
        return view('user.login');
    }
    static function quick_login($params)
    {
        $user = User::where('contact', $params['contact'])->orWhere('email', $params['email'])->first();
        if (!$user) {
            $user = new User;
            $user->contact = $params['contact'];
            $user->email = $params['email'];
            $user->save();
        }
        session()->put('user', [
            "userId" => $user->id,
            "userMail" => $user->email,
            "userContact" => $user->contact,
        ]);
        return true;
    }
    function ui_view_flight_bookings()
    {
        $data = ["flightBookings" => Flightbooking::where('user_id', session()->get('user')['userId'])->get()->toArray()];
        return view('user.profile.bookings', $data);
    }
    function ui_view_flight_booking($Id)
    {
        $data = ["flightBookings" => Flightbooking::where('user_id', session()->get('user')['userId'])->where('id', $Id)->first()->toArray()];
        return view('user.profile.flight_booking', $data);
    }
    function web_cancel_flight_booking(Request $request)
    {
        $booking = Flightbooking::where('user_id', session()->get('user')['userId'])
        ->where('bookingid', $request->bookingId)
        ->first();
        if ($booking) {
        $control = new FlightController();
        $cancelType = $request->input('cancellation_type', 1); // Default to FullCancellation
        $ticketIds = $request->input('tickets', []);
        $origin = $request->input('origin');
        $destination = $request->input('destination');

        $cancelParams = [
            "BookingId" => $booking->bookingid,
            "RequestType" => $cancelType,
            "CancellationType" => 3, // This should be dynamic based on your requirements
            "Remarks" => "Just Cancel My Booking",
        ];

        if ($cancelType == 2 && !empty($ticketIds)) { // PartialCancellation requires ticket IDs and sectors
            $cancelParams["TicketId"] = $ticketIds;
            $cancelParams["Sectors"] = [
                [
                    "Origin" => $origin,
                    "Destination" => $destination,
                ],
            ];
        }

        $cancel = $control->api_cancel_booking($cancelParams);
        // dd($cancel);

        if ($cancel['ResponseStatus'] == 1) {
            $result = ['success' => true];
            $charge = $control->api_cancel_charges($booking->bookingid);
            if (isset($charge['RefundAmount'])) {
                $result['refund'] = $charge['RefundAmount'];
            }

            // Save cancellation details in JSON format
            $bbb = Flightbooking::find($booking->id);
            $cancellationDetails = [
                'ticketcancelinfo' => $cancel,
            ];
            $bbb->cancellation_details = json_encode($cancellationDetails);
            $bbb->is_cancelled = 1;
            $bbb->refund_got = $result['refund'] ?? null;
            $bbb->save();

            // Call RazorPay refund method
            $razorPayControl = new RazorPayController();
            $refundRequest = new Request([
                'payment_id' => $booking->payment['razorpay_payment_id'],
                'amount' => $result['refund']
            ]);
            $refundResponse = $razorPayControl->refund_payment($refundRequest);

            if (!$refundResponse->getData()->success) {
                return ['success' => false, 'message' => 'Refund failed: ' . $refundResponse->getData()->message];
            }

            return $result;
        } else {
            return ['success' => false];
        }
        } else {
        return ['success' => false];
        }
    }
}
