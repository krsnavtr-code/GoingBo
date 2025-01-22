<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\ApiControllers\RazorPayController;
use App\Http\Controllers\ApiControllers\TBOFlight;
use App\Http\Controllers\BaseControllers\CouponController;
use App\Http\Controllers\BaseControllers\FlightBase;
use App\Models\Flightbooking;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

// Set the maximum execution time to 300 seconds (5 minutes)
ini_set('max_execution_time', 300);

class FlightController extends FlightBase
{
    private $tbo = null;
    public function __construct()
    {
        $this->tbo = new TBOFlight();
    }

    function ui_calender_fare( Request $request ) {
        $searchResults = $this->tbo->index_flight($request);
        // Pass $searchResults to the route handler for "/"
        return $searchResults;
    }
    
    
    function ui_search_flights(Request $request)
    {
     
        $params = [
            'origin' => $request->from,
            'destination' => $request->to,
            'departure_date' => $request->dep_date,
            'return_date' => $request->ret_date,
            'travelclass' => $request->travelclass ?? 1,
            'journey_type' => $request->journey_type ?? 1,
            'adult' => $request->adult ?? 1,
            'child' => $request->child ?? 0,
            'infant' => $request->infant ?? 0,
            'ResultFareType' => $request->fare_type
        ];
        $data = self::search_flights($params);

        session()->put('flight_search', $data);
        // dd($data);
        // dd($data['flights']);
        // dd($data['flights'][0]['Segments']);

        // dd($data['flights'][0]['Segments'][1]);
        
        
        
        return view('user.flight.flights', ["req" => $params] + $data);
    }

       

        function ui_get_flights(Request $request){
        
            $flightSearchData = session()->get('flight_search');
            // dd($flightSearchData);
            $flights = $flightSearchData['flights'][0];
            $req = $request->all();
    
            
            // dd($flights);
            // dd($flights[0][0]['Segments']);
        
            // Ensure $flights is an array and not null
            if (!is_array($flights)) {
                return view('user.flight.flights', compact('flights', 'req'));
            }
    
    
            // Filter by stops
            if ($request->has('stops')) {
                $stops = $request->input('stops');
                $filteredFlights = [];
                foreach ($flights as $flight) {
                    if (isset($flight['Segments'][0])) {
                        // echo count($flight['Segments'][0]) ;
                        $stopCount = count($flight['Segments'][0]) - 1;
    
                        if (in_array($stopCount . '_stop', $stops)) {
                            $filteredFlights[] = $flight;
                        }
                    } else {
                        // Debug flight with missing Segments
                        // dd('Flight with missing Segments:', $flight);
                    }
                }
                // dd($filteredFlights);
                $flights = $filteredFlights;
    
            }
    
    
            // Filter by pricing
            if ($request->has('pricing')) {
                $pricing = $request->input('pricing');
                if ($pricing == 'low_to_high') {
                    usort($flights, function ($a, $b) {
                        return $a['Fare']['PublishedFare'] <=> $b['Fare']['PublishedFare'];
                    });
                } else if ($pricing == 'high_to_low') {
                    usort($flights, function ($a, $b) {
                        return $b['Fare']['PublishedFare'] <=> $a['Fare']['PublishedFare'];
                    });
                }
                // Debug after pricing filter
                // dd('After Pricing Filter:', $flights);
            }
    
            // // Filter by time of day
            // if ($request->has('time_of_day')) {
            //     $time_of_day = $request->input('time_of_day');
            //     $flights = array_filter($flights, function ($flight) use ($time_of_day) {
            //         if (isset($flight['Segments'][0][0]['DepTime'])) {
            //             $depTime = strtotime($flight['Segments'][0][0]['DepTime']);
            //             $hour = date('H', $depTime);
            //             if (in_array('morning', $time_of_day) && $hour >= 6 && $hour < 12) {
            //                 return true;
            //             }
            //             if (in_array('afternoon', $time_of_day) && $hour >= 12 && $hour < 18) {
            //                 return true;
            //             }
            //             if (in_array('evening', $time_of_day) && $hour >= 18 && $hour < 24) {
            //                 return true;
            //             }
            //             if (in_array('night', $time_of_day) && $hour >= 0 && $hour < 6) {
            //                 return true;
            //             }
            //         }
            //         return false;
            //     });
            //     // Debug after time of day filter
            //     // dd('After Time of Day Filter:', $flights);
            // }
    
            // // Filter by airline
            // if ($request->has('airlines')) {
            //     $airlines = $request->input('airlines');
            //     $flights = array_filter($flights, function ($flight) use ($airlines) {
            //         if (isset($flight['Segments'][0][0]['Airline']['AirlineCode'])) {
            //             return in_array($flight['Segments'][0][0]['Airline']['AirlineCode'], $airlines);
            //         }
            //         return false;
            //     });
            //     // Debug after airlines filter
            //     // dd('After Airlines Filter:', $flights);
            // }
    
            // Make sure to reset array keys
            $flights = [array_values($flights)];
            // dd($flights);
    
            // Final debug before returning the view
            // dd('Final Flights:', $flights);
    
    
            return response()->json(['flights' => $flights, 'req' => $req ]);
        }



    function ui_review_flight(Request $request)
    {      
        if (session()->has('trace') && session()->get('trace') == $request->trace && session()->get('index') == $request->dep_index && session()->get('ret_index') == $request->ret_index) {
            $data = [
                'rules' => session()->get('rules'),
                'fare' => session()->get('fare'),
                'ssr' => session()->get('ssr')
            ];
            $ret_data = ["ret_data" => session()->get('ret_data')] ?? [];
        } else {
            session()->forget('ret_data');
            $data = self::review_flight($request->dep_index, $request->trace);
            $ret_data = ($request->ret_index) ? ["ret_data" => self::review_flight($request->ret_index, $request->trace)] : [];
            session()->put($data + $ret_data + ["trace" => $request->trace, "index" => $request->dep_index, "ret_index" => $request->ret_index]);
        }
        $coupons = CouponController::myCoupons('FLIGHT');

        // print_r($data);
        // die();

       
        
        // try{
        //     // Define the file path
        //     $log_file_path = 'C:\Users\Admin\Desktop\gbo\app\Http\Controllers\ApiControllers\logs\TBO\ex2.json';
        //     $ret_data = [];
            
        //     $coupons = CouponController::myCoupons('FLIGHT');
        //     // echo $log_file_path ;
    
        //     // Check if the file exists
        //     if (is_file($log_file_path)) {
        //         // Read the content of the file
        //         $logged_data = file_get_contents($log_file_path);
    
        //         // Decode the JSON data into an array
        //         $dummy_response = json_decode($logged_data, true);
        //         // dd($dummy_response);
        //         $json_response = $dummy_response;
        //         // print_r($json_response);
        //         // die();
            
        //        $data = $json_response ; 
        //     }
        //  } catch (\Throwable $th) {
        //     }
        //   // dd($json_response);
           
        return view('user.flight.review', $data + $ret_data + ["coupons" => $coupons]);
    }
    function ui_checkout_flight(Request $request)
    {
        $seat_price = 0;
        $dep_seats = [];
        if (isset(session()->get('ssr')['SeatDynamic'])) {
            foreach ($request->dep_seats as $i => $dep_seat) {
                $temp_seats = [];
                foreach ($dep_seat as $j => $ds) {
                    if ($ds) {
                        $temp_seat = self::findSeat($j, $ds, session()->get('ssr'));
                        $seat_price += $temp_seat['Price'];
                        $temp_seats[] = $temp_seat;
                    }
                }
                $dep_seats[] = $temp_seats;
            }
        }
        if (!session()->has('user')) {
            UserController::quick_login(["contact" => $request->contact['contact'], "email" => $request->contact['mail']]);
        }
        $fare = session()->get('fare');
        $fare_det = [
            'fare' => 0,
            'gst' => 0,
            'charges' => 0,
            'total' => 0,
        ];
        $gst = [
            "GSTCompanyName" => $request->company['companyName'],
            "GSTNumber" => $request->company['companyGST'],
            "GSTCompanyEmail" => $request->company['companyMail'],
            "GSTCompanyContactNumber" => $request->company['companyContact'],
            "GSTCompanyAddress" => $request->company['companyAddress'],
        ];
        $con = [
            "CellCountryCode" => "+91",
            "ContactNo" => $request->contact['contact'],
            "Email" => $request->contact['mail'],
            "AddressLine1" => $request->address['address'],
            "City" => $request->address['city'],
            "CountryCode" => $request->address['countryCode'],
            "CountryName" => $request->address['country'],
            "Nationality" => $request->address['countryCode'],
            
        ];
        // dd($con);
        $passengers = array_merge(
            self::create_passenger($request->adult, $con, $gst, null, array_splice($dep_seats, 0, count($request->adult))),
            self::create_passenger($request->child, $con, $gst, null, $dep_seats),
            self::create_passenger($request->infant, $con, $gst)
        );
        if ($fare['IsLCC']) {
            session()->put("passengers", $passengers);
        } else {
            if (session()->has('booking')) $book = session()->get('booking');
            if (!isset($book) || !isset($book['TraceId']) || $book['TraceId'] != session()->get('trace')) {
                $result = $this->tbo->book_ticket(["Passengers" => $passengers, "TraceId" => session()->get('trace'), "ResultIndex" => session()->get('index')]);
                if ($result['Error']['ErrorCode'] != 0) {
                    return redirect()->back();
                }
                session()->put("booking", $result);
            }
        }
        $fare_det['fare'] += $fare['Fare']['BaseFare'];
        $fare_det['gst'] += $fare['Fare']['Tax'];
        $fare_det['charges'] += $fare['Fare']['TdsOnCommission'] + $fare['Fare']['TdsOnPLB'] + $fare['Fare']['TdsOnIncentive'] + $fare['Fare']['ServiceFee'] + $fare['Fare']['OtherCharges'];
        $total = $fare['Fare']['PublishedFare'] +
            $fare['Fare']['TdsOnCommission'] + $fare['Fare']['TdsOnPLB'] +
            $fare['Fare']['TdsOnIncentive'] + $fare['Fare']['ServiceFee'];
        $meal_price = 0;
        $bag_price = 0;
        foreach ($passengers as $pax) {
            if (isset($pax['MealDynamic']))
                $meal_price += $pax['MealDynamic'][0]['Price'];
            if (isset($pax['Baggage']))
                $bag_price += $pax['Baggage'][0]['Price'];
        }
        if (session()->has('ret_data')) {
            $ret_data = session()->get('ret_data');
            $ret_seats = [];

            if (isset($ret_data['ssr']['SeatDynamic'])) {
                foreach ($request->ret_seats as $i => $ret_seat) {
                    $temp_seats = [];
                    foreach ($ret_seat as $j => $ds) {
                        if ($ds) {
                            $temp_seat = self::findSeat($j, $ds, session()->get('ret_data')['ssr']);
                            $seat_price += $temp_seat['Price'];
                            $temp_seats[] = $temp_seat;
                        }
                    }
                    $ret_seats[] = $temp_seats;
                }
            }

            $ret_passengers = array_merge(
                self::create_passenger($request->adult, $con, $gst, 'ret', array_splice($ret_seats, 0, count($request->adult))),
                self::create_passenger($request->child, $con, $gst, 'ret', $ret_seats),
                self::create_passenger($request->infant, $con, $gst, 'ret')
            );
            if ($ret_data['fare']['IsLCC']) {
                session()->put("ret_passengers", $ret_passengers);
            } else {
                if (session()->has('ret_booking')) {
                    $ret_book = session()->get('ret_booking');
                }
                if (!isset($ret_book) || !isset($ret_book['TraceId']) || $ret_book['TraceId'] != session()->get('trace')) {
                    $result = $this->tbo->book_ticket(["Passengers" => $ret_passengers, "TraceId" => session()->get('trace'), "ResultIndex" => session()->get('ret_index')]);
                    if ($result['Error']['ErrorCode'] != 0) {
                        return redirect()->back();
                    }
                    session()->put("ret_booking", $result);
                }
            }
            $total += $ret_data['fare']['Fare']['PublishedFare'] +
                $ret_data['fare']['Fare']['TdsOnCommission'] + $ret_data['fare']['Fare']['TdsOnPLB'] + $ret_data['fare']['Fare']['TdsOnIncentive'] + $ret_data['fare']['Fare']['ServiceFee'] + $ret_data['fare']['Fare']['OtherCharges'];
            foreach ($ret_passengers as $pax) {
                if (isset($pax['MealDynamic']))
                    $meal_price += $pax['MealDynamic'][0]['Price'];
                if (isset($pax['Baggage']))
                    $bag_price += $pax['Baggage'][0]['Price'];
            }
            $fare_det['fare'] += $ret_data['fare']['Fare']['BaseFare'];
            $fare_det['gst'] += $ret_data['fare']['Fare']['Tax'];
            $fare_det['charges'] += $ret_data['fare']['Fare']['TdsOnCommission'] + $ret_data['fare']['Fare']['TdsOnPLB'] + $ret_data['fare']['Fare']['TdsOnIncentive'] + $ret_data['fare']['Fare']['ServiceFee'];
            $ret=["ret_data" => $ret_data];
        }

        if ($request->coupon_code) {
            $old = session()->get('fare_det');
            if (!isset($old['coupon']) || $old['coupon'] != $request->coupon_code) {
                $discount = CouponController::getDiscount($request->coupon_code);
                $fare_det['coupon'] = $request->coupon_code;
                $fare_det['discount'] = $discount;
            } else {
                $discount = $old['discount'];
                $fare_det['discount'] = $old['discount'];
            }
            $total -= $discount;
        }
        if ($request->full_refund) {
            $full_cancelation = 440*(count($passengers)+count($ret_passengers??[]));
            $total += $full_cancelation;
        }
        $total += $meal_price + $bag_price + $seat_price;
        $nT = floor($total * 100 / 98);
        $fare_det['charges'] += $meal_price + $bag_price + $seat_price + $nT - $total;
        $total = $nT;
        $fare_det['total'] += $total;
        session()->put("fare_det", $fare_det);
        $data = ["fare" => $fare, "meal" => $meal_price, "bag" => $bag_price, "seat" => $seat_price,"rules"=> session()->get('rules'), "discount" => $discount ?? 0, "full_cancelation" => $full_cancelation ?? 0]+($ret??[]) + RazorPayController::make_order($total);
        // dd($data);
        return view('user.flight.checkout', $data);
    }
    function web_book_ticket(Request $request)
    {
        if (session()->has('tickets')) {
            $tickets = session()->get('tickets');
        }
        if (!isset($tickets) || !isset($tickets['dep_ticket']['trace']) || $tickets['dep_ticket']['trace'] != session()->get('trace')) {
            $verify = RazorPayController::verify_signature(
                $request->razorpay_order_id,
                $request->razorpay_payment_id,
                $request->razorpay_signature,
            );
            if ($verify['success']) {
                $tickets = [];
                if (session()->get('fare')['IsLCC']) {
                    $params = ["Passengers" => session()->get('passengers'), "trace" => session()->get('trace'), "ResultIndex" => session()->get('index')];
                } else {
                    $booking = session()->get("booking")['Response'];
                    $params = [
                        "trace" => session()->get("trace"),
                        "PNR" => $booking['PNR'],
                        "BookingId" => $booking['BookingId'],                       
                    ];
                }
                $fareDetails = session()->get('fare');
                $cancellationDetails = "";

                if (isset($fareDetails['MiniFareRules'])) {
                    $cancellationDetails = json_encode(["MiniFareRules" => $fareDetails['MiniFareRules']]);
                }
                
                $tickets['dep_ticket'] = $this->tbo->confirm_ticket($params)['Response'] + ['trace' => session()->get('trace')];
                self::save_ticket($tickets['dep_ticket'], $verify, $cancellationDetails);
                if (session()->has('ret_data')) {
                    if (session()->get('ret_data')['fare']['IsLCC']) {
                        $params = ["Passengers" => session()->get('ret_passengers'), "trace" => session()->get('trace'), "ResultIndex" => session()->get('ret_index')];
                    } else {
                        $booking = session()->get("ret_booking")['Response'];
                        $params = [
                            "trace" => session()->get("trace"),
                            "PNR" => $booking['PNR'],
                            "BookingId" => $booking['BookingId'],
                        ];
                    }
                    $fareDetails = session()->get('ret_data')['fare'];
                    $cancellationDetails = "";

                    if (isset($fareDetails['MiniFareRules'])) {
                        $cancellationDetails = json_encode($fareDetails['MiniFareRules']);
                    }
                    $tickets['ret_ticket'] = $this->tbo->confirm_ticket($params)['Response'] + ['trace' => session()->get('trace')];
                    self::save_ticket($tickets['ret_ticket'], $verify, $cancellationDetails);
                }
                session()->put("tickets", $tickets);
            } else $tickets = null;
        }
        // dd($tickets);
        // print_r($tickets);
        // die();
        session()->forget('remainingTime');
        return view('user.flight.ticket', ["ticket" => $tickets] + session()->get('fare_det'));
    }
    function ui_book_ticket()
    {
        $tickets = session()->get('tickets');
        if (!isset($tickets) || !isset($tickets['dep_ticket']['trace']) || $tickets['dep_ticket']['trace'] != session()->get('trace')) {
            $tickets = null;
        }
        return view('user.flight.ticket', ["ticket" => $tickets] + session()->get('fare_det'));
    }
    function ui_booking_details(Request $request)
    {
        $params = [];
        if ($request->bookingId) {
            $params = ['BookingId' => $request->bookingId];
        } else if ($request->pnr) {
            $params = ['PNR' => $request->pnr];
        }
        if ($params) {
            $booking = $this->tbo->booking_details($params);
            // dd($booking);
            return view('user.flight.booking', ['flightBookings' => $booking]);
            
        } else {
            dd("BookingId or PNR not provided");
        }
    }
    function api_cancel_charges($bookingId, $type = null)
    {
        $result = $this->tbo->cancel_charges([
            "FullCancellation" => $type ?? 1,
            "BookingId" => $bookingId,
        ]);
        return $result;
    }
    function api_cancel_booking($params)
    {
        $result = $this->tbo->cancel_booking($params);
        return $result;
    }

    
    private function search_flights($params)
    {
       
        $raw = $this->tbo->search_flights($params);
        if ($raw['success']) {
            return ["success" => true, "flights" => $raw['Results'], "trace" => $raw['TraceId']];
        } else {
            return $raw;
        }
    }
    private function review_flight($index, $trace)
    {
        return [
            'rules' => $this->tbo->fare_rules($index, $trace),
            'fare' => $this->tbo->fare_details($index, $trace),
            'ssr' => $this->tbo->ssr_details($index, $trace)
        ];
    }
    private function create_passenger($pass, $con, $gst, $type = null, $seat = null)
    {
        if (!$pass) return [];
        $p = [];
        if ($type == 'ret') {
            $x = session()->get('ret_data');
            $f = $x['fare']['FareBreakdown'][$pass[0]['PaxType'] - 1];
            $ssr = $x['ssr'];
        } else {
            $f = session()->get('fare')['FareBreakdown'][$pass[0]['PaxType'] - 1];
            $ssr = session()->get('ssr');
        }
        $fare = [
            "Fare" => [
                "BaseFare" => $f['BaseFare'] / $f['PassengerCount'],
                "Tax" => $f['Tax'] / $f['PassengerCount'],
                "TransactionFee" => 0,
                "YQTax" => $f['YQTax'] / $f['PassengerCount'],
                "AdditionalTxnFeeOfrd" => $f['AdditionalTxnFeeOfrd'],
                "AdditionalTxnFeePub" => $f['AdditionalTxnFeePub'],
                "AirTransFee" => 0,
            ]
        ];
        // dd($pass);
        if ($pass) {
            foreach ($pass as $i => $pas) {
                if ($seat && isset($seat[$i])) {
                    $t = [];
                    foreach ($seat[0] as $mko => $s) {
                        if ($s)
                            $t["SeatDynamic"][0]["SegmentSeat"][$mko] = ["RowSeats" => [["Seats" => [$s]]]];
                    }
                }
                $meal = [];
                $bag = [];
                if ($type == 'ret') {
                    if (isset($ssr['MealDynamic'])) {
                        $meal = ['MealDynamic' => [$ssr['MealDynamic'][0][$pas['ret_meal'] ?? 0]]];
                    } else if (isset($ssr['meal'])) {
                        $meal = ["Meal" => $ssr['Meal'][$pas['ret_meal'] ?? 0]];
                    }
                    if (isset($ssr['Baggage'])) {
                        $bag = ["Baggage" => [$ssr['Baggage'][0][$pas['ret_bag'] ?? 0]]];
                    }
                } else {
                    if (isset($ssr['MealDynamic'])) {
                        $meal = ['MealDynamic' => [$ssr['MealDynamic'][0][$pas['dep_meal'] ?? 0]]];
                    } else if (isset($ssr['meal'])) {
                        $meal = ["Meal" => $ssr['Meal'][$pas['dep_meal'] ?? 0]];
                    }
                    if (isset($ssr['Baggage'])) {
                        $bag = ["Baggage" => [$ssr['Baggage'][0][$pas['dep_bag'] ?? 0]]];
                    }
                }
                $pas['Gender'] = ($pas['Title'] == "Mr" || $pas['Title'] == "Mstr") ? 1 : 2;
                
                if ($i == 0 && $pas['PaxType'] == 1){
                     $pas['IsLeadPax'] = true;
                } else{
                    $pas['IsLeadPax'] = false;
                }
                $pas['DateOfBirth'] .= "T00:00:00";
                // var_dump ($pas);
                $p[] = $pas + $con + $gst + $meal + $bag + ($fare ?? []) + ($t ?? []);
            }
            // die();
            
        }
        return $p;
    }
    function save_ticket($ticket, $payment, $cancellationDetails)
    {
        unset($payment['success']);
        $flightBooking = new Flightbooking([
            "user_id" => session()->get('user')['userId'],
            "from_airport" => $ticket['FlightItinerary']['Origin'],
            "to_airport" => $ticket['FlightItinerary']['Destination'],
            "journey_date" => $ticket['FlightItinerary']['InvoiceCreatedOn'],
            "pnr" => $ticket['PNR'],
            "bookingid" => $ticket['BookingId'],
            "ticket" => $ticket,
            "payment" => $payment + session()->get('fare_det'),
            "cancellation_details" => $cancellationDetails
        ]);
        $flightBooking->save();
    }
    function findSeat($i, $seat, $ssr)
    {
        $seatDec = explode('-', $seat);
        $seatNew = $ssr['SeatDynamic'][0]['SegmentSeat'][$i]['RowSeats'][$seatDec[0]]['Seats'][$seatDec[1]];
        return $seatNew;
    }
}
