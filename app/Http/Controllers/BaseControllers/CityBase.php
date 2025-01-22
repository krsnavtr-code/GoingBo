<?php

namespace App\Http\Controllers\BaseControllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\State;
use Illuminate\Http\Request;

class CityBase extends Controller
{
    function api_get_stateByCountryId($CountryId)
    {
        return self::api_response(self::get_stateByCountryId($CountryId));
    }
    function api_get_districtByStateId($stateId)
    {
        return self::api_response(self::get_districtByStateId($stateId));
    }
    function api_get_releventCity($query){
        return self::api_response(self::get_releventCity($query));
    }
    function get_stateByCountryId($countryId)
    {
        return ["states" => State::where("country_id", $countryId)->get()->toArray()];
    }
    function get_districtByStateId($stateId)
    {
        return ['districts' => District::where('state_id', $stateId)->get()->toArray()];
    }
    function get_releventCity($query){
        return ['cities'=>City::where("city_name", 'like', '%' . $query . '%')->limit(8)->get()->toArray()];
    }
}
