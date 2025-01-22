<?php

namespace App\Http\Controllers\ApiControllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\ApiControllers\TBOBase;
use Illuminate\Support\Str;
use Illuminate\Http\Request;



class TBOFlight extends TBOBase
{
    /** Flight Service URL */
   
    private const FLIGHT_URL_1 = "https://tboapi.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/";

    private const FLIGHT_URL_2 = "https://booking.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/";

    public function __construct()
    {
        parent::__construct();
        if (!session()->has('log_id')) {
            session()->put('log_id', "log_" . floor(microtime(true) * 1000) . ".txt");
        }
        $this->log_id = session()->get('log_id');
    }

    /** Create Flight Services URL */
    private function flight_url_1($q)
    {
        return self::FLIGHT_URL_1 . $q;
    }

    private function flight_url_2($q)
    {
        return self::FLIGHT_URL_2 . $q;
    }

    /** Merge params with default params */
    private function create_params($params)
    {
        
        return $params + [
            "TokenId" => $this->token['TokenId'],
            "EndUserIp" => request()->ip(),
        ];
        
    }

    // Logging function 
    function log_message($message, $logFilename)
    {
            
        $logFilepath = __DIR__ . "/logs/TBO/flights/" . $logFilename;
        $fileHandle = fopen($logFilepath, 'a');
        if ($fileHandle) {
            fwrite($fileHandle, $message . "\n");
            fclose($fileHandle);
        } else {
            // Handle the error if the file cannot be opened
            error_log("Unable to open log file: " . $logFilepath);
        }
    }

    function index_flight( Request $request ) {
        $from = $request->input('from');
        $to = $request->input('to');    
        $currentDate = date('Y-m-d') . 'T00:00:00';   
       
        $params = self::create_params([
            'JourneyType' => "1", // OneWay journey
            'PreferredAirlines' => null,
            'Segments' => [
                [
                    'Origin' => $from,
                    'Destination' => $to,
                    'FlightCabinClass' => '1',
                    'PreferredDepartureTime' => $currentDate,
                    // Add other segment parameters as needed
                ],
                // Add additional segments if required
            ],
            'Sources' => null

        ]);
        
        
        self::note_inlog_flight("Request:-" . self::flight_url_1("GetCalendarFare") . "\n" . json_encode($params));
        $response = Http::post(self::flight_url_1('GetCalendarFare'), $params)->json();
        self::note_inlog_flight("Response\n" . json_encode($response));
        // dd($response);
        return $response;
    }
    function search_flights($params)
    {
        $segments = [self::flight_segment(
            $params['origin'],
            $params['destination'],
            $params['travelclass'], /* 1 All | 2 Economy | 3 PremiumEconomy | 4 Business | 5 PremiumBusiness | 6 First */
            $params['departure_date'],
        )];
        /** For return flights */
        if ($params['journey_type'] == 2) {
            $segments[] = self::flight_segment(
                $params['destination'],
                $params['origin'],
                $params['travelclass'],
                $params['return_date'],
            );
        }
        $params = self::create_params([
            "AdultCount" => $params['adult'],
            "ChildCount" => $params['child'],
            "InfantCount" => $params['infant'],
            /* 1 OneWay | 2 Return | 3 Multi Stop | 4 AdvanceSearch | 5 Special  */
            "JourneyType" => $params['journey_type'],
            "Segments" => $segments,
            "DirectFlight" => "false", /* Default set by developer */
            "OneStopFlight" => "false", /* Default set by developer */
            "PreferredAirlines" => null, /* Default set by developer */
            "Sources" => null, /* Default set by developer */
            "PreferredCurrency" => "INR", /* Default set by developer */
            // "ResultFareType" => $params['ResultFareType']
        ]);
 
        self::note_inlog_flight("Request:- " . self::flight_url_1("Search") . "\n" . json_encode($params));
        try {
            $fetched = Http::timeout(0)->post(self::flight_url_1("Search"), $params);
            
            $json_response = $fetched->json();
            // dd($json_response);
            self::note_inlog_flight("Response\n" . json_encode($json_response));
            // print_r($json_response);
            // die();
        
            if ($json_response['Response']['Error']['ErrorCode'] == 0) {
                $data = ["success" => true]+$json_response['Response'];
            } else {
                $data = ["success" => false, "msg" => $json_response['Response']['Error']['ErrorMessage'], "code" => "NF"];
            }
        }
         catch (\Throwable $th) {
        }
        // dd($json_response);
        return $data ?? ["success" => false, "msg" => "Timeout Error", "code" => "TOUT"];
    }
    private function flight_segment($ori, $des, $cab, $dat)
    {
        return [
            "Origin" => $ori,
            "Destination" => $des,
            "FlightCabinClass" => $cab,
            "PreferredDepartureTime" => $dat . "T00: 00: 00",
            "PreferredArrivalTime" => $dat . "T00: 00: 00",
        ];
    }
    function fare_rules($index, $trace)
    {
        $params = self::create_params(["ResultIndex" => $index, "TraceId" => $trace]);
        self::note_inlog_flight("Request:-" . self::flight_url_1("FareRule") . "\n" . json_encode($params));
        $response = Http::post(self::flight_url_1('FareRule'), $params)->json();
        self::note_inlog_flight("Response\n" . json_encode($response));
        return $response['Response']['FareRules'];
    }
    function fare_details($index, $trace)
    {
        $params = self::create_params(["ResultIndex" => $index, "TraceId" => $trace]);
        self::note_inlog_flight("Request:-" . self::flight_url_1("FareQuote") . "\n" . json_encode($params));
        $fare = Http::post(self::flight_url_1('FareQuote'), $params)->json();      
        self::note_inlog_flight("Response\n" . json_encode($fare));
        if (isset($fare['Response']['Results'])){
             return $fare['Response']['Results'];
        }
    }
    function ssr_details($index, $trace)
    {

        $params = self::create_params(["ResultIndex" => $index, "TraceId" => $trace]);
        self::note_inlog_flight("Request:-" . self::flight_url_1("SSR") . "\n" . json_encode($params));
        $response = Http::post(self::flight_url_1('SSR'), $params)->json();
        self::note_inlog_flight("Response\n" . json_encode($response));
        return $response['Response'];
        
    }
    function book_ticket($params)
    {
        $params = self::create_params($params);
        self::note_inlog_flight("Request:-" . self::flight_url_2("Book") . "\n" . json_encode($params));
        $response = Http::timeout(0)->post(self::flight_url_2("Book"), $params);        
        $json_response = $response->json();
        self::note_inlog_flight("Response\n" . json_encode($json_response));

        return $json_response['Response'];
    }
    function confirm_ticket($params)
    {
        if (isset($params['PNR'])) {
            $params = self::create_params([
                "TraceId" => $params['trace'],
                "PNR" => $params['PNR'],
                "BookingId" => $params['BookingId'],             
            ]);
        } else {
            $params = self::create_params([
                "TraceId" => $params['trace'],
                "ResultIndex" => $params['ResultIndex'],
                "Passengers" => $params['Passengers'],
            ]);
            
        }
        // dd($params);        
        
        self::note_inlog_flight("Request:-" . self::flight_url_2("Ticket") . "\n" . json_encode($params));
        $response = Http::timeout(0)->post(self::flight_url_2("Ticket"), $params);
        
        $json_response = $response->json();
        // dd($json_response);
        self::note_inlog_flight("Response\n" . json_encode($json_response));
        if($json_response['Response'] != null){
            return $json_response['Response'];
        } else {
            return response()->json(['message' => 'Could Not process yout booking'], 500);
        }       
        
    }

    function booking_details($params)
    {
        self::note_inlog_flight("Request:-" . self::flight_url_2("GetBookingDetails") . "\n" . json_encode(self::create_params($params)));
        $response = Http::timeout(0)->post(self::flight_url_2("GetBookingDetails"), self::create_params($params));
        $json_response = $response->json();
        self::note_inlog_flight("Response\n" .json_encode($json_response));
        return $json_response['Response'];
    }
    /** Used to release booking in case of non-lcc flights */
    function releasr_pnr($params)
    {
        // $params=["BookingId"=>,"Source"=>]
        $response = Http::post(self::flight_url_2("ReleasePNRRequest"), self::create_params($params));
        $json_response = $response->json();
        return $json_response['Response'];
    }
    function cancel_charges($params)
    {
        // Generate a unique filename based on the current timestamp
        $logFilename = 'log_'. floor(microtime(true) * 1000) . '.txt'; 

        $requestLogMessage = "Request:-" . self::flight_url("GetCancellationCharges") . "\n" . json_encode(self::create_params($params));
        self::log_message($requestLogMessage, $logFilename);

        $response = Http::post(self::flight_url("GetCancellationCharges"), self::create_params($params));
        $json_response = $response->json();
        // Log the response
        $responseLogMessage = "Response\n" . json_encode($json_response);
        self::log_message($responseLogMessage, $logFilename);
        return $json_response['Response'];
    }

    function cancel_booking($params)
    {  
        // dd($params);
        // Generate a unique filename based on the current timestamp
        $logFilename = 'log_'. floor(microtime(true) * 1000) . '.txt';       
        $requestLogMessage = "Request:-" . self::flight_url("SendChangeRequest") . "\n" . json_encode(self::create_params($params));
        self::log_message($requestLogMessage, $logFilename);

        $response = Http::post(self::flight_url("SendChangeRequest"), self::create_params($params));
        $json_response = $response->json();

        // Log the response
        $responseLogMessage = "Response\n" . json_encode($json_response);
        self::log_message($responseLogMessage, $logFilename);
        return $json_response['Response'];
    }
    function cancel_status($params)
    {
        $response = Http::post(self::flight_url_2("GetChangeRequestStatus"), self::create_params($params));
        $json_response = $response->json();
        return $json_response['Response'];
    }
}
