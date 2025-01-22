<?php

namespace App\Http\Controllers\BaseControllers;

use App\Http\Controllers\Controller;
use App\Models\HotelCity;
use Illuminate\Http\Request;

class HotelBase extends Controller
{
    function api_get_cities( Request $request )
    {
        return self::cities( $request);
    }

    private function cities( $request)
    {
       
        $city = $request->query('city');        
        $country = $request->query('country');

        $cities = [];
        
        $cities = HotelCity::where("destination", 'like', '%' . $city . '%')
            ->where("country_code", $country)
            ->limit(8)
            ->get()
            ->toArray();      

        return $cities;
    }
}
