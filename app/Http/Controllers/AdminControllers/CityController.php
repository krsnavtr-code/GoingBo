<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\BaseControllers\CityBase;
use App\Models\Country;
use Illuminate\Http\Request;

class CityController extends CityBase
{
    function ui_view_cities(){
        $data=[];
        return view("admin.city.view_cities",$data);
    }
    function ui_add_city(){
        $data=["countries"=>Country::all(['id','country_name'])->toArray()];
        return view("admin.city.add_city",$data);
    }
    function ui_edit_city(){
        $data=[];
        return view("admin.city.edit_city",$data);
    }

    function web_add_city(Request $request){}
    function web_edit_city(Request $request){}
   
    function api_add_city(Request $request){}
    function api_edit_city(Request $request){}
   
    private function add_city(){}
    private function edit_city(){}
}
