<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\BaseControllers\CabBase;
use App\Models\Cab;
use App\Models\CabRoute;
use Illuminate\Http\Request;

class CabController extends CabBase
{
    private const DRIVER_IMG = parent::IMG_PATH . "cab assets/driver/";
    private const VEHICLE_IMG = parent::IMG_PATH . "cab assets/vehicle/";

    function ui_view_cabs()
    {
        $data = ["cabs" => Cab::all()->toArray()];
        return view("admin.cab.view_cabs", $data);
    }
    function ui_add_cab()
    {
        return view("admin.cab.add_cab");
    }
    function ui_edit_cab($cabId)
    {
        $cab = Cab::find($cabId);
        // $vehicleFeatures = json_decode($cab['vehicle_features'], true);

        // var_dump($vehicleFeatures);
        // die();
        if (is_null($cab)) {
            return redirect()->to('/admin/cab');
        } else {
            return view("admin.cab.edit_cab", compact('cab'));
        }
    }

    function ui_delete_cab($cabId){
    // dd($cabId);
    /* $cab = Cab::find($cabId);
    if (!$cab) {
        session()->flash('result',["error" => "Record not found"]);
        return redirect('/admin/cab');
    }

    $cab->cab_bookings()->delete();
    $cab->cab_routes()->delete();
    $cab->cab_booking_bids()->delete();

    session()->flash('result', ["success"=> $cab->delete()]);
    return redirect()->back(); */
    }

    function ui_view_cab_routes()
    {
        $data = ["routes" => CabRoute::with(['cab', 'from_city', 'to_city'])->get()->toArray()];
        // dd($data);
        return view("admin.cab.view_cab_routes", $data);
    }
    function ui_add_cab_route($cabId)
    {
        $data = Cab::find($cabId);
        // view('admin.cab_routes', ['cabId' => $cabId]);
        return view("admin.cab.add_cab_route", ['data' => $data]);
    }
    function ui_edit_cab_route($routeId)
    {
    }

    function web_add_cab(Request $request)
    {
        $fea = [];
        $features = $request->feature;
        foreach ($features['other'] as $key => $value) {
            $fea[] = $key;
        }
        $features['other'] = $fea;
        $params = [
            "owner_name" => $request->owner_name,
            "company_name" => $request->company_name,
            "company_address" => $request->company_address,
            "gst_number" => $request->gst_number,
            "owner_contact" => $request->owner_contact,
            "owner_email" => $request->owner_email,
            "owner_upi" => $request->owner_upi,
            "driver_name" => $request->driver_name,
            "driver_license" => $request->driver_license,
            "driver_img" => $request->driver_img,
            "vehicle_number" => $request->vehicle_number,
            "vehicle_model" => $request->vehicle_model,
            "vehicle_default_location" => $request->vehicle_default_location,
            "vehicle_img" => $request->vehicle_img,
            "km_price" => $request->km_price,
            "vehicle_features" => $features,
            "yr_of_exp" => $request->yr_of_exp,
            "min_charge" => $request->min_charge,

        ];
        session()->flash('result', self::add_cab($params));
        return redirect()->back();
    }
    function web_edit_cab(Request $request, $cabId)
    {
        // $fea = [];
        // $features = $request->feature;
        // foreach ($features['other'] as $key => $value) {
        //     $fea[] = $key;
        // }
        // $features['other'] = $fea;

        $params = [
            "owner_name" => $request->owner_name,
            "company_name" => $request->company_name,
            "company_address" => $request->company_address,
            "gst_number" => $request->gst_number,
            "owner_contact" => $request->owner_contact,
            "owner_email" => $request->owner_email,
            "owner_upi" => $request->owner_upi,
            "driver_name" => $request->driver_name,
            "driver_license" => $request->driver_license,
            "driver_img" => $request->driver_img,
            "vehicle_number" => $request->vehicle_number,
            "vehicle_model" => $request->vehicle_model,
            "vehicle_default_location" => $request->vehicle_default_location,
            "vehicle_img" => $request->vehicle_img,
            "km_price" => $request->km_price,
            // "vehicle_features" => $features,
            "yr_of_exp" => $request->yr_of_exp,
            "min_charge" => $request->min_charge,
        ];
        session()->flash('result', self::edit_cab($params, $cabId));
        return redirect()->back();
    }
    function web_toggle_cab(Request $request)
    {
    }
    function web_approve_cab(Request $request)
    {
    }
    function web_add_cab_route(Request $request)
    {
        $params = [
            "from_location" => $request->from_location,
            "to_location" => $request->to_location,
            "night_halt" => $request->night_halt,
            "price" => $request->price,
            "cab_id" => $request->vehicle_number,
            "free_cancel" => $request->free_cancel,
            "coupon" => $request->coupon,
        ];
        session()->flash('result', self::add_cab_route($params));
        return redirect()->back();
    }
    function web_edit_cab_route(Request $request)
    {
    }
    function web_toggle_cab_route(Request $request)
    {
    }
    function web_approve_cab_route(Request $request)
    {
    }

    function api_add_cab(Request $request)
    {
    }
    function api_edit_cab(Request $request)
    {
    }
    function api_toggle_cab($cabId)
    {
        return self::api_response(self::toggle_cab($cabId));
    }
    function api_approve_cab(Request $request)
    {
    }
    function api_add_cab_route(Request $request)
    {
    }
    function api_edit_cab_route(Request $request)
    {
    }
    function api_toggle_cab_route(Request $request)
    {
    }
    function api_approve_cab_route(Request $request)
    {
    }

    private function add_cab($params)
    {
        $driver_img = self::move_file($params['driver_img'], self::DRIVER_IMG);
        $vehicle_img = self::move_file($params['vehicle_img'], self::VEHICLE_IMG);


        $cab = new Cab([
            "owner_name" => $params['owner_name'],
            "company_name" => $params['company_name'],
            "company_address" => $params['company_address'],
            "gst_number" => $params['gst_number'],
            "owner_contact" => $params['owner_contact'],
            "owner_email" => $params['owner_email'],
            "owner_upi" => $params['owner_upi'],
            "driver_name" => $params['driver_name'],
            "driver_license" => $params['driver_license'],
            "driver_img" => $driver_img['filename'],
            "vehicle_number" => $params['vehicle_number'],
            "vehicle_model" => $params['vehicle_model'],
            "vehicle_default_location" => $params['vehicle_default_location'],
            "vehicle_img" => $vehicle_img['filename'],
            "km_price" => $params['km_price'],
            "vehicle_features" => json_encode($params['vehicle_features']),
            "yr_of_exp" => $params['yr_of_exp'],
            "min_charge" => $params['min_charge'],

        ]);
        return ["success" => $cab->save()];
    }
    private function edit_cab($params, $cabId)
    {
        $cab = Cab::find($cabId);

        // Check if the record exists
        if ($cab) {
            // Update the fields with new values
            $cab->owner_name = $params['owner_name'];
            $cab->company_name = $params['company_name'];
            $cab->company_address = $params['company_address'];
            $cab->gst_number = $params['gst_number'];
            $cab->owner_contact = $params['owner_contact'];
            $cab->owner_email = $params['owner_email'];
            $cab->owner_upi = $params['owner_upi'];
            $cab->driver_name = $params['driver_name'];
            $cab->driver_license = $params['driver_license'];
            // $cab->driver_img = $driver_img['filename'];
            $cab->vehicle_number = $params['vehicle_number'];
            $cab->vehicle_model = $params['vehicle_model'];
            $cab->vehicle_default_location = $params['vehicle_default_location'];
            // $cab->vehicle_img = $vehicle_img['filename'];
            $cab->km_price = $params['km_price'];
            // $cab->vehicle_features = json_encode($params['vehicle_features']);
            $cab->yr_of_exp = $params['yr_of_exp'];
            $cab->min_charge = $params['min_charge'];

            // Save the updated record
            $success = $cab->save();

            return ["success" => $success];
        } else {
            // Record not found
            return ["error" => "Record not found"];
        }
    }
    private function toggle_cab($cabId)
    {
        $cab = Cab::find($cabId);
        if (!$cab) return ["success" => false, "msg" => "Cab not exists"];
        $cab->cab_status = !$cab->cab_status;
        return  ["success" => $cab->save(), "msg" => $cab->cab_status ? "Cab Enabled" : "Cab Disabled"];
    }
    private function approve_cab()
    {
    }
    private function add_cab_route($params)
    {
        $cab = new CabRoute([
            "from_location" => $params['from_location'],
            "to_location" => $params['to_location'],
            "night_halt" => $params['night_halt'],
            "price" => $params['price'],
            "cab_id" => $params['cab_id'],
            "free_cancel" =>$params['free_cancel'],
            "coupon" => $params['coupon']
        ]);
        return ["success" => $cab->save()];
    }
    private function edit_cab_route()
    {
    }
    private function toggle_cab_route()
    {
    }
    private function approve_cab_route()
    {
    }
}
