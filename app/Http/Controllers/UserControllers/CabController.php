<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\ApiControllers\RazorPayController;
use App\Http\Controllers\BaseControllers\CabBase;
use Illuminate\Http\Request;
use App\Models\CabRoute;
use Carbon\Carbon;

class CabController extends CabBase
{
    function ui_index()
    {
        return view("user.cab.index");
    }
    function ui_search_type($type)
    {
        return view("user.cab.search", ["type" => $type]);
    }
    function ui_search_cabs(Request $request, $type)
    {
        // dd($request->all());

        
        // dd(now()->timestamp+10*60);
        $data = [
            "cabroutes" => CabRoute::with(['cab', 'from_city', 'to_city'])
                ->where('from_location', $request->going_from)
                ->where('to_location', $request->going_to)
                ->Where('reserved_at', '<', now()->timestamp+10*60)
                ->get()
                ->toArray()
        ];
        // dd($data);

        // dd( $data+["type" => $type]+["request" => $request]);

        return view('user.cab.cabs',  $data + ["type" => $type, "request" => $request]);
    }

    function ui_book_cab(Request $request, $type, $id)
    {
        //  dd($request, $type, $id);
        // $data = ["cabroutes" =>CabRoute::with(['cab', 'from_city', 'to_city'])->find($id)->toArray()];
        $cabRoute = CabRoute::with(['cab', 'from_city', 'to_city'])->find($id);
        // dd(now()->timestamp);
        $cabRoute->update([
            'reserved_at' => now()->timestamp,
        ]);

        $data = ["cabroutes" => $cabRoute->toArray()];

        $dtParameter = $request->dt;

        $dtValues = explode(',', $dtParameter);

        $goingFromCity = $dtValues[0];
        $goingToCity = $dtValues[1];
        $cDate = $dtValues[2];
        $cTime =  $dtValues[3];
        // dd($data, $type, $id,  $goingFromCity, $cDate, $cTime );
        return view("user.cab.book", $data + ["type" => $type,"id" => $id,"goingFromCity" => $goingFromCity,"goingToCity" => $goingToCity,"cDate" => $cDate,"cTime" => $cTime]);
    }
    function ui_checkout(Request $request, $type, $id)
    {
        // $total = 500;
        // $data=["cab_data"=>""]+RazorPayController::make_order($total);
        //  dd($request->mobile_no, $request->email);
        
        $data = ["cabroutes" => CabRoute::with(['cab', 'from_city', 'to_city'])->find($id)->toArray()];
        // dd($data['cabroutes']['price']);
        $gst = 18;
        $fare = $data['cabroutes']['price'] * $request->passengers;
        $total = $fare + $fare * $gst/100  ;
        
        // Parse the time using Carbon and convert it to 24-hour format
        $time24hr = Carbon::createFromFormat('h:i A', $request->cTime)->format('H:i');
        // dd($time24hr);

        // dd($data + ["type" => $type, "id" => $id] +RazorPayController::make_order($total));
        return view("user.cab.checkout",$data + ["type" => $type, "id" => $id, "request" => $request, "time24hr" => $time24hr, "gst"=> $gst, "fare"=>$fare, "total" =>$total] +RazorPayController::make_order($total));
    }
}
