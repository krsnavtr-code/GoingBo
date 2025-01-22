<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\ApiControllers\TBOHotel;
use App\Http\Controllers\BaseControllers\HotelBase;

use App\Http\Controllers\ApiControllers\RazorPayController;
use App\Models\HotelCity;
use App\Models\HotelSpecial;
use App\Models\HotelBooking;
use Carbon\Carbon;
use Illuminate\Http\Request;

// Set the maximum execution time to 300 seconds (5 minutes)
ini_set('max_execution_time', 300);

class HotelController extends HotelBase
{
    protected $tbo = null;
    
    public function __construct(TBOHotel $tbo)
    {
        $this->tbo = $tbo;

    }

    function ui_hotels(Request $request){
        // Save all request inputs into the session
        session()->put('hotel_search_inputs', $request->all() );
        // // Uncomment if you want to verify the session data
        // dd(session()->get('hotel_search_inputs'));



       // Determine city code
       $cityCode = null;

       if ($request->filled('hotel_city')) {
           $cityCode = HotelCity::where('destination', $request->hotel_city )
               ->where('country_code', $request->CountryType)
               ->pluck('city_id')
               ->first();
        } elseif ($request->filled('location_city')) {
            $cityCode = HotelCity::where('destination',  $request->location_city )
                ->where('country_code', $request->CountryType)
                ->pluck('city_id')
                ->first();
                // dd($cityCode);
       }
        // $cityCode = "130443" ;
       if ($cityCode) {
            $params = [
                'CityCode' => $cityCode,
                'IsDetailedResponse' => 'false',
            ];

           $response = $this->tbo->fetchHotels($params);
           // Handle response and pass it to the view or return it as needed
        //    dd($response['hotels']);

        if ($request->filled('hotel_city')) {
            $hotelName = $request->input('whereinput');
            // dd($hotelName);
            $hotelMatched = null;
            $highestSimilarity = 0;

            // Find the hotel by similar name
            foreach ($response['hotels'] as $hotel) {
                $similarity = $this->calculateSimilarity($hotel['HotelName'], $hotelName);
                if ($similarity > 50 && $similarity > $highestSimilarity) {
                    $highestSimilarity = $similarity;
                    $hotelMatched = $hotel;
                }
            }
            // dd($hotelMatched);

            if ($hotelMatched) {
                // Prioritize the matched hotel
                $hotelCodes[] = $hotelMatched['HotelCode'];

                // $hotelCoords = explode('|', $hotelMatched['Map']);
                // $latitude = floatval($hotelCoords[0]);
                // $longitude = floatval($hotelCoords[1]);

                
                $latitude = floatval($hotelMatched['Latitude']);
                $longitude = floatval($hotelMatched['Longitude']);

                // Filter remaining hotels within 10 km radius
                foreach ($response['hotels'] as $hotel) {
                    if ($hotel['HotelCode'] != $hotelMatched['HotelCode']) {
                        // $hotelCoords = explode('|', $hotel['Map']);
                        $hotelLat = floatval($hotel['Latitude']);
                        $hotelLng = floatval($hotel['Longitude']);

                        if ($this->calculateDistance($latitude, $longitude, $hotelLat, $hotelLng) <= 10) {
                            $hotelCodes[] = $hotel['HotelCode'];
                            if (count($hotelCodes) >= 50) {
                                break;
                            }
                        }
                    }
                }
            }
            $data = ['spacialhotels' => HotelSpecial::where('hotel_city', $request->hotel_city)->get()];

        } elseif ($request->filled('location_city')) {
            $latitude = $request->input('latitude');
            $longitude = $request->input('longitude');
            $hotelCodes = null ;
            if ($latitude && $longitude) {
                // Filter hotels within 10 km radius from given coordinates
                foreach ($response['hotels'] as $hotel) {
                    // $hotelCoords = explode('|', $hotel['Map']);
                    $hotelLat = floatval($hotel['Latitude']);
                    $hotelLng = floatval($hotel['Longitude']);

                    if ($this->calculateDistance($latitude, $longitude, $hotelLat, $hotelLng) <= 10) {
                        $hotelCodes[] = $hotel['HotelCode'];
                        if (count($hotelCodes) >= 50) {
                            break;
                        }

                    }                   
                }
            }
            $data = ['spacialhotels' => HotelSpecial::where('hotel_city', $request->location_city)->get()];
          
        }

            // Join hotel codes into a comma-separated string
            $hotelCodesString = implode(',', $hotelCodes);
            $params = [
                'Hotelcodes' => $hotelCodesString
            ];
            // dd($params);

            // Fetch hotel details using the hotel codes
            $response2 = $this->tbo->fetchHotelDetails($params);
            // dd($response2['hotels']);

            // Process hotels to limit the number of images
            $hotels = $response2 ;
            foreach ($hotels as &$hotel) {
                if (isset($hotel['Images']) && is_array($hotel['Images'])) {
                    // Limit the number of images to 10
                    $hotel['Images'] = array_slice($hotel['Images'], 0, 10);
                }
            }
            unset($hotel); // Break the reference with the last element

            return view("user.hotels.hotels", $data , ['hotels' => $hotels ]);
       }

        // Handle case where no city code is found
        return redirect()->back()->with('error', 'No matching city found.');        

    }

    function calculateSimilarity($str1, $str2)
    {
        $str1 = strtolower($str1);
        $str2 = strtolower($str2);

        $levenshteinDistance = levenshtein($str1, $str2);
        $maxLength = max(strlen($str1), strlen($str2));

        if ($maxLength == 0) {
            return 100; // Both strings are empty
        }

        // Calculate similarity percentage
        $similarity = (1 - $levenshteinDistance / $maxLength) * 100;

        return $similarity;
    }

    function calculateDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371; // Earth's radius in kilometers
        $latDelta = deg2rad($lat2 - $lat1);
        $lngDelta = deg2rad($lng2 - $lng1);

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($lngDelta / 2) * sin($lngDelta / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }

    function ui_hotels_view($hotelcode)
    {
        // dd(session()->get('hotel_search_inputs'));
        // Retrieve hotel search inputs from the session
        $hotelSearchInputs = session()->get('hotel_search_inputs');
        // Parse the child ages into an array of integers
        $childAges = array_map('intval', explode(',', $hotelSearchInputs['child_ages'] ));
        // dd($childAges);
        // dd($hotelSearchInputs) ;        
        
        $params = [            
            'checkin' => $hotelSearchInputs['dep_date'] ,
            'checkout' => $hotelSearchInputs['ret_date'] ,
            'hotelcodes' => $hotelcode,
            // 'guestCountry' => $hotelSearchInputs['CountryType'] ?? "IN",
            'guestCountry' =>  "IN",
            'adult' => $hotelSearchInputs['adult'] ?? 1,
            'child' => $hotelSearchInputs['child'] ?? 0,
            'childAges' => $childAges,
            'rooms'=> $hotelSearchInputs['room'] ?? 1,

            // Additional parameters if needed
            // 'night' => $hotelSearchInputs['nights'],
            // 'countryCode' => $hotelSearchInputs['CountryType'],
            // 'city' => $hotelSearchInputs['location_city'],
            // 'minrating' => $hotelSearchInputs['ratings'] ?? 0,     
           
        ];
        
        
        // dd($params);
        $data1 = self::search_hotels($params);
        // dd($data1);
     
        $params = [
            'Hotelcodes' => $hotelcode
        ];

        // Fetch hotel details using the hotel codes
        $data2 = $this->tbo->fetchHotelDetails($params);
        // dd($data2);

        $params = [
            'BookingCode' => $data1[0]['Rooms'][0]['BookingCode']
        ];

        $data3 = self::fetchPreBook($params);
        // $data3 = $this->tbo->fetchPreBook($params);
        // dd($data3) ;

        return view('user.hotels.info', [
            'rooms' => $data1,
            'hotels' => $data2,
            'prebook' => $data3,
        ]);
        
        
    }

  


    public function web_checkout_hotel(Request $request){
        // dd($request->all());

        $prebook = json_decode($request->input('prebook'), true);
        // dd($prebook); 
        $response['prebook'] = $prebook ;
    
        $passengers = $request->passenger;
        $hotelRoomsDetails = [];

        foreach ($passengers as $roomIndex => $room) {
            $hotelPassengers = [];

            // Process adults in the room
            if (isset($room['adult'])) {
                foreach ($room['adult'] as $adult) {
                    $hotelPassengers[] = [
                        "Title" => $adult['title'],
                        "FirstName" => $adult['first_name'],
                        "MiddleName" => $adult['middle_name'],
                        "LastName" => $adult['last_name'],
                        "PaxType" => 1, // Adult
                        "LeadPassenger" => $adult['leadpassenger'] === "true", // Convert string to boolean
                        "Age" => !empty($adult['age']) ? $adult['age'] : 0, 
                        "Phoneno" => $adult['phone'],
                        "Email" => $adult['email'],
                        "PAN" => $adult['pan'],
                        "PassportNo" => $adult['passport_no']
                    ];
                }
            }

            // Process children in the room
            if (isset($room['child'])) {
                foreach ($room['child'] as $child) {
                    $hotelPassengers[] = [
                        "Title" => $child['title'],
                        "FirstName" => $child['first_name'],
                        "MiddleName" => $child['middle_name'],
                        "LastName" => $child['last_name'],
                        "PaxType" => 2, // Child
                        "LeadPassenger" => false, // Children are never lead passengers
                        "Age" => $child['age'],
                        "Phoneno" => null, // Typically not needed for children
                        "Email" => null, // Typically not needed for children
                        "PAN" => $child['pan'],
                        "PassportNo" => $child['passport_no']
                    ];
                }
            }

            // Add the passengers to the room details
            $hotelRoomsDetails[] = [
                "HotelPassenger" => $hotelPassengers
            ];
        }

        // At this point, $hotelRoomsDetails is ready to be used for the booking request.
        // dd($hotelRoomsDetails);

        if (!session()->has('user')) {
            UserController::quick_login(["contact" => $request->input('passenger.1.adult.1.phone'), "email" => $request->input('passenger.1.adult.1.email') ]);
        }

        $response['HotelRoomsDetails'] = $hotelRoomsDetails;

        $response['HotelName'] = $request->input('hotelname') ;
        // Update the response with the modified HotelRoomsDetails and fare
       

        // Store the response data in the session
        session()->put('response', $response);

        
        // dd($response);

        $fare = round($prebook['HotelResult'][0]['Rooms'][0]['TotalFare']) ;
        // var_dump($fare);
        $gst = 18;        
        $total =  round($fare + ($fare * $gst / 100)); 
        // dd($total) ;
       

        // dd($data + ["type" => $type, "id" => $id] +RazorPayController::make_order($total));
        return view("user.hotels.checkout" , [ "gst"=> $gst, "fare"=>$fare, "total" =>$total, 'response' => $response ] +RazorPayController::make_order($total));
    }

   

    function web_book_ticket(Request $request)
    {
        // dd(session()->has("tickets"));
        if (session()->has('tickets')) {
            $tickets = session()->get('tickets');
            $response = session()->get('response');
            // dd($tickets);
            if (!is_null($tickets['HotelBookingStatus'])) {
                // dd($tickets, $response);
                // print_r($tickets);
                // die();
                $book = $this->web_book_booking($tickets['BookingId']);
                // dd($tickets, $response, $book );
                return view('user.hotels.ticket', ['ticket' => $tickets, 'response' => $response, 'book' => $book]);
            }
        } else {
            $verify = RazorPayController::verify_signature(
                $request->razorpay_order_id,
                $request->razorpay_payment_id,
                $request->razorpay_signature,
            );
            if ($verify['success']) {
                $tickets = [];               
                $response = session()->get('response');
                // dd($response) ;            

                $tickets = $this->tbo->confirm_ticket( $response ) ;

                session()->put('tickets', $tickets);
                // dd($tickets, $response);
                // print_r($tickets);
                // die();
                $book = $this->web_book_booking($tickets['BookingId']);
                $booking = $this->saveBookingData($book, $verify);
                // dd($tickets, $response, $book );
                return view('user.hotels.ticket', ['ticket' => $tickets, 'response' => $response, 'book' => $book]);
            }
            else {
                return abort(404);              
            }
        }
        
    }

    public function saveBookingData($book, $verify) {
    
        // dd($book, $verify);
        unset($verify['success']);
        $hotelBooking = new HotelBooking([
            "user_id" => session()->get('user')['userId'],
            'payment' => $verify ,
            'HotelBookingStatus' => $book['HotelBookingStatus'],
            'ConfirmationNo' => $book['ConfirmationNo'],
            'BookingRefNo' => $book['BookingRefNo'],
            'BookingId' => $book['BookingId'],
            'IsPriceChanged' => $book['IsPriceChanged'],
            'IsCancellationPolicyChanged' => $book['IsCancellationPolicyChanged'],
            'NetAmount' => $book['NetAmount'],
            'NetTax' => $book['NetTax'],
            'VoucherStatus' => $book['VoucherStatus'],
            'InvoiceAmount' => $book['InvoiceAmount'],
            'InvoiceCreatedOn' => $book['InvoiceCreatedOn'],
            'InvoiceNo' => $book['InvoiceNo'],
            'LastCancellationDeadline' => $book['LastCancellationDeadline'],
            'HotelCode' => $book['HotelCode'],
            'HotelId' => $book['HotelId'],
            'HotelName' => $book['HotelName'],
            'TBOHotelCode' => $book['TBOHotelCode'],
            'AddressLine1' => $book['AddressLine1'],
            'City' => $book['City'],
            'CityId' => $book['CityId'],
            'CheckInDate' => $book['CheckInDate'],
            'CheckOutDate' => $book['CheckOutDate'],
            'NoOfRooms' => $book['NoOfRooms'],
            'Rooms' => json_encode($book['Rooms']),  // Encoding Rooms array to JSON
            'RateConditions' => json_encode($book['RateConditions']),  // Encoding RateConditions array to JSON
        ]);
        $hotelBooking->save();
    
        // Proceed to return the view
        return "success";
    }


    private function search_hotels($params)
    {       
        $raw = $this->tbo->search_hotels($params);
        if (isset($raw['success']) ) {
            return $raw['HotelResult'];
            // return $raw;
        } else {
            echo '<img src="/images/error codes/404 Error plug-cuate.png" alt="404 Error"  style="width: 500px; height: 475px; display: block; margin: auto;" />';
            echo '<br>' . '<p style="text-align: center; font-size: 2rem;">' .$raw['Status']['Description'] .'<p>';
            die();
        }

    }  
    
    private function fetchPreBook($params)
    {       
        $raw = $this->tbo->fetchPreBook($params);
        if (isset($raw['success']) ) {
            return $raw;
        } else {
            echo '<img src="/images/error codes/404 Error plug-cuate.png" alt="404 Error"  style="width: 500px; height: 475px; display: block; margin: auto;" />';
            echo '<br>' . '<p style="text-align: center; font-size: 2rem;">' .$raw['Status']['Description'] .'<p>';
            die();
        }

    }  

    private function web_book_booking($ticketid)
    {
        $raw = $this->tbo->web_book_booking($ticketid);
        if (isset($raw['success'])) {
            return $raw['GetBookingDetailResult']; // Return the raw data to be used in the ticket view
        } else {
            echo '<img src="/images/error codes/404 error amico.png" alt="404 Error" style="width: 500px; height: 475px; display: block; margin: auto;" />';
            echo '<br>' . '<p style="text-align: center; font-size: 2rem;">' .$raw['Status']['Description'] .'<p>';
            die();
        }
    }

    
}
