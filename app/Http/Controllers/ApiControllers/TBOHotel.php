<?php

namespace App\Http\Controllers\ApiControllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TBOHotel extends TBOBase
{
    /** Testing Credentials */
    // protected $username = "Goingbo1";
    // protected $password = "Goingbo1@1234";

     /** Live Credentials */
     protected $username = "DELG738";
     protected $password = "Htl@DEL#38/G";

    private const HOTEL_URL = "https://affiliate.travelboutiqueonline.com/HotelAPI/";

    public function __construct()
    {
        parent::__construct();
        if (!session()->has('log_id')) {
            session()->put('log_id', "log_" . floor(microtime(true) * 1000) . ".txt");
        }
        $this->log_id = session()->get('log_id');
    }

    /** Create Flight Services URL */
    private function hotel_url($q)
    {
        return self::HOTEL_URL . $q;
    }
    /** Merge params with default params */
    private function create_params($params)
    {
        return $params + [
            "TokenId" => $this->token['TokenId'],
            "EndUserIp" => request()->ip(),
        ];
    }

    function fetchHotels($params)
    { 
        self::note_inlog_hotel("Request:- " . "https://apiwr.tboholidays.com/HotelAPI/TBOHotelCodeList" . "\n" . json_encode($params));

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('travelcategory:Tra@59334536')
        ])->timeout(0)->post('https://apiwr.tboholidays.com/HotelAPI/TBOHotelCodeList', $params);

        $jsonResponse = $response->json();

        self::note_inlog_hotel("Response:- " . "\n" . json_encode($jsonResponse));

        if ($response->successful()) {
            return ["success" => true] + ["hotels" => $jsonResponse['Hotels']];
        }

        return ["success" => false, "message" => "Failed to fetch hotels from TBO API"];
    }

    function fetchHotelDetails($params)
    {
        self::note_inlog_hotel("Request:- " . "https://apiwr.tboholidays.com/HotelAPI/Hoteldetails" . "\n" . json_encode($params));

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('travelcategory:Tra@59334536')
        ])->timeout(0)->post('https://apiwr.tboholidays.com/HotelAPI/Hoteldetails', $params);

        $jsonResponse = $response->json();

        self::note_inlog_hotel("Response:- " . "\n" . json_encode($jsonResponse));

        if ($response->successful()) {
            return  $jsonResponse['HotelDetails'] ;
        }

        return ["success" => false, "message" => "Failed to fetch hotels from TBO API"];
    }


    function search_hotels($params)
    {
        
        $totalAdults = $params['adult'];
        $totalChildren = $params['child'];
        $childrenAges = $params['childAges'];
        $numRooms = $params['rooms'];
    
        // Distribute adults and children among rooms
        $adultsPerRoom = intval($totalAdults / $numRooms);
        $childrenPerRoom = intval($totalChildren / $numRooms);
        $remainingAdults = $totalAdults % $numRooms;
        $remainingChildren = $totalChildren % $numRooms;
    
        // Distribute children's ages
        $childrenAgesPerRoom = [];
        if ($childrenPerRoom > 0) {
            $childrenAgesPerRoom = array_chunk($childrenAges, $childrenPerRoom);
        }
    
        $roomGuests = [];
        for ($i = 0; $i < $numRooms; $i++) {
            $roomGuests[] = [
                "Adults" => $adultsPerRoom + ($remainingAdults > 0 ? 1 : 0),
                "Children" => $childrenPerRoom + ($remainingChildren > 0 ? 1 : 0),
                "ChildrenAges" => isset($childrenAgesPerRoom[$i]) ? $childrenAgesPerRoom[$i] : []
            ];
    
            // Decrease the remaining counts
            $remainingAdults--;
            $remainingChildren--;
        }
    
        $params = self::create_params([
            "CheckIn" => $params['checkin'],
            "CheckOut" => $params['checkout'],
            "HotelCodes" =>  $params['hotelcodes'],
            "GuestNationality" => $params['guestCountry'] ,
            "PaxRooms" => $roomGuests,
            "ResponseTime" => 23.0,
            "IsDetailedResponse" => true,
            "Filters" => [
                "Refundable" => false,
                "NoOfRooms" => $numRooms,
                "MealType" => 0,
                "OrderBy" => 0,
                "StarRating" => 0,
                "HotelName" => null
            ],

            // "NoOfNights" => $params['night'] ,
            // "CountryCode" => $params['countryCode'] ,
            // "CityId" => $params['city'] ,              
           
        ]);
            
        self::note_inlog_hotel("Request:- " . self::hotel_url("Search") . "\n" . json_encode($params));
        $fetched = Http::withBasicAuth($this->username, $this->password)->withHeaders(['Content-Type' => 'application/json'])->timeout(0)->post(self::hotel_url("Search"), $params);     
        $json_response = $fetched->json();
        
        self::note_inlog_hotel("Response:- " . "\n" . json_encode($json_response));
        // dd($json_response);
        if($json_response['Status']['Code'] == 200 ){
        $data = ["success" => true] + $json_response;
        } else{
            $data = $json_response; 
        }
        // dd($data);


        return $data;
    }

    function fetchPreBook($params)
    {
        self::note_inlog_hotel("Request:- " . self::hotel_url("PreBook") . "\n" . json_encode($params));

        $fetched = Http::withBasicAuth($this->username, $this->password)->withHeaders(['Content-Type' => 'application/json'])->timeout(0)->post(self::hotel_url("PreBook"), $params); 
              
        $json_response = $fetched->json();
        self::note_inlog_hotel("Response:- " . "\n" . json_encode($json_response));

        if($json_response['Status']['Code'] == 200 ) {
            $data = ["success" => true] + $json_response;
        } else{
            $data =  $json_response; 
        }
            // dd($data);    
    
        return $data;
    }
    
    
    function confirm_ticket( $response){

        $params = self::create_params([
            "BookingCode" => $response['prebook']['HotelResult'][0]['Rooms'][0]['BookingCode'],
            "IsVoucherBooking" => "true",
            "GuestNationality" => "IN", 
            "TotalFare" => $response['prebook']['HotelResult'][0]['Rooms'][0]['TotalFare'],
            "TotalTax" => $response['prebook']['HotelResult'][0]['Rooms'][0]['TotalTax'],
            "NetAmount" => $response['prebook']['HotelResult'][0]['Rooms'][0]['NetAmount'],
            "NetTax" => $response['prebook']['HotelResult'][0]['Rooms'][0]['NetTax'],
            "RequestedBookingMode" => 1,
            "HotelRoomsDetails" => $response['HotelRoomsDetails'] ,
        ]);
    
        self::note_inlog_hotel("Request:- " . "https://hotelbooking.travelboutiqueonline.com/HotelAPI_V10/HotelService.svc/rest/Book" . "\n" . json_encode($params));

        $fetched = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode($this->username . ':' . $this->password)
        ])->timeout(0)->post('https://hotelbooking.travelboutiqueonline.com/HotelAPI_V10/HotelService.svc/rest/Book', $params);
        
       

        $json_response = $fetched->json();
        // dd($json_response);
        self::note_inlog_hotel("Response:- " . "\n" . json_encode($json_response));

        // Check if there's a mismatch error and print out the problematic details
        if (isset($json_response['BookResult']['Error']['ErrorCode']) && $json_response['BookResult']['Error']['ErrorCode'] == 3) {
            dd('Error in HotelPassenger count', $response['HotelRoomsDetails'] , $json_response);
        }
        return $json_response['BookResult'];
    }

    function web_book_booking($ticketid){

        $params = self::create_params([
            "BookingId" => $ticketid,
        ]);

        self::note_inlog_hotel("Request:- " . "https://hotelbooking.travelboutiqueonline.com/HotelAPI_V10/HotelService.svc/rest/GetBookingDetail" . "\n" . json_encode($params));

        $fetched = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode($this->username . ':' . $this->password)
        ])->timeout(0)->post('https://hotelbooking.travelboutiqueonline.com/HotelAPI_V10/HotelService.svc/rest/GetBookingDetail', $params);
            

        $json_response = $fetched->json();
        // dd($json_response);
        self::note_inlog_hotel("Response:- " . "\n" . json_encode($json_response));

        if ($fetched->successful()) {
            return ["success" => true] + $json_response ;
        }
    }
}
