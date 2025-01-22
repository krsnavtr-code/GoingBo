<?php

namespace App\Http\Controllers\BaseControllers;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use Illuminate\Http\Request;

class FlightBase extends Controller
{
    function api_airport_search($query)
    {
        return self::airports($query);
    }
    private function airports($query)
    {
        $airports = [];
        $airports += Airport::where('airport_code', $query)->get()->toArray();
        $airports += Airport::where("airport_name", 'like', '%' . $query . '%')->orWhere("airport_city", 'like', '%' . $query . '%')->limit(5 - count($airports))->get()->toArray();
        return $airports;
    }
}
