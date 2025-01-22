<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\BaseControllers\PackageBase;
use App\Models\Package;
use App\Models\PackageDay;
use Illuminate\Http\Request;

class PackageController extends PackageBase
{
    private const PACKAGE_IMG = parent::IMG_PATH . "package/";

    public function ui_view_package(){
        $data = ["packages" => Package::all()->toArray()];
        return view("admin.holidaypackages.view_packages", $data);
    }

    public function ui_add_package(){
        return view("admin.holidaypackages.add_packages");
    }

    public function ui_edit_package($packageId){
        $package = Package::find($packageId);
        // $vehicleFeatures = json_decode($package['vehicle_features'], true);

        // var_dump($vehicleFeatures);
        // die();package
        if (is_null($package)) {
            return redirect()->to('/admin/holidaypackages');
        } else {
            return view("admin.holidaypackages.edit_packages", compact('package'));
        }
    }

    public function ui_view_activity($packageId){
        
        $packagedays = PackageDay::where('package_id', $packageId)->get();
        // dd($packagedays);

        if (is_null($packagedays)) {
            return redirect()->to('/admin/holidaypackages');
        } else {
            return view("admin.holidaypackages.view_activities", compact('packagedays'));
        }
    }

    public function web_add_package(Request $request){
       
        $params = [
            "title" => $request->title,
            "image" => $request->image,
            "short_des" => $request->short_des,
            "price" => $request->price,
            "slug" => $request->slug,
            "night" => $request->night,
            "pckg_head" => $request->pckg_head,
            "pckg_head_2" => $request->pckg_head_2,
            "pckg_head_3" => $request->pckg_head_3,
            "pckg_head_4" => $request->pckg_head_4,
            "pckg_head_5" => $request->pckg_head_5,
            "pckg_head_6" => $request->pckg_head_6,
            "pckg_head_7" => $request->pckg_head_7,
            "pckg_tags" => $request->pckg_tags,
            "pckg_categories" => $request->pckg_categories,
            "state_name" => $request->state_name,
            "country_name" => $request->country_name,

        ];
        session()->flash('result', self::add_package($params));
        return redirect()->back();
    }

    public function web_edit_package(Request $request, $packageId)
    {
        // dd($request->toArray());

        $params = [
            "title" => $request->title,
            "image" => $request->image,
            "short_des" => $request->short_des,
            "price" => $request->price,
            "slug" => $request->slug,
            "night" => $request->night,
            "pckg_head" => $request->pckg_head,
            "pckg_head_2" => $request->pckg_head_2,
            "pckg_head_3" => $request->pckg_head_3,
            "pckg_head_4" => $request->pckg_head_4,
            "pckg_head_5" => $request->pckg_head_5,
            "pckg_head_6" => $request->pckg_head_6,
            "pckg_head_7" => $request->pckg_head_7,
            "pckg_tags" => $request->pckg_tags,
            "pckg_categories" => $request->pckg_categories,
            "state_name" => $request->state_name,
            "country_name" => $request->country_name,
        ];
        session()->flash('result', self::edit_package($params, $packageId));
        return redirect()->back();
    }

    public function web_add_activity(Request $request, $packageId){

        $params = [
            "day" => $request->day,
            "pck_img" => $request->pck_img,
            "type_of_transport" => $request->type_of_transport,
            "duration" => $request->duration,
            "hotel_name" => $request->hotel_name,
            "star" => $request->star,
            "area" => $request->area,
            "hotel_include" => $request->hotel_include,
            "activity" => $request->activity,
            "activity_des" => $request->activity_des,
            "package_id" => $packageId,
        ];
        session()->flash('result', self::add_activity($params));
        return redirect()->back();
    }

    private function add_package($params)
    {
        $image = self::move_file($params['image'], self::PACKAGE_IMG);
        
        $package = new Package([
            "title" => $params['title'],
            "image" => $image['filename'],
            "short_des" => $params['short_des'],
            "price" => $params['price'],
            "slug" => $params['slug'],
            "night" => $params['night'],
            "pckg_head" => $params['pckg_head'],
            "pckg_head_2" => $params['pckg_head_2'],
            "pckg_head_3" => $params['pckg_head_3'],
            "pckg_head_4" => $params['pckg_head_4'],
            "pckg_head_5" => $params['pckg_head_5'],
            "pckg_head_6" => $params['pckg_head_6'],
            "pckg_head_7" => $params['pckg_head_7'],
            "pckg_tags" => $params['pckg_tags'],
            "pckg_categories" => $params['pckg_categories'],
            "state_name" => $params['state_name'],
            "country_name" => $params['country_name'],

        ]);
        return ["success" => $package->save()];
    }

    private function edit_package($params, $packageId)
    {
        $package = Package::find($packageId);
 
        
        // Check if the record exists
        if ($package) {

            if ($params['image'] !== null && $params['image'] !== '') {
                $image = self::move_file($params['image'], self::PACKAGE_IMG);
                $package->image = $image['filename'];
            }
            
            // Update the fields with new values
            $package->title = $params['title'];           
            $package->short_des = $params['short_des'];
            $package->price = $params['price'];
            $package->slug = $params['slug'];
            $package->night = $params['night'];
            $package->pckg_head = $params['pckg_head'];
            $package->pckg_head_2 = $params['pckg_head_2'];
            $package->pckg_head_3 = $params['pckg_head_3'];
            $package->pckg_head_4 = $params['pckg_head_4'];
            $package->pckg_head_5 = $params['pckg_head_5'];
            $package->pckg_head_6 = $params['pckg_head_6'];
            $package->pckg_head_7 = $params['pckg_head_7'];
            $package->pckg_tags = $params['pckg_tags'];
            $package->pckg_categories = $params['pckg_categories'];
            $package->state_name = $params['state_name'];
            $package->country_name = $params['country_name'];


            // Save the updated record
            $success = $package->save();

            return ["success" => $success];
        } else {
            // Record not found
            return ["error" => "Record not found"];
        }
    }

    private function add_activity($params){
        $image = self::move_file($params['pck_img'], self::PACKAGE_IMG);
        

        $package = new PackageDay([
            "day" => $params['day'],
            "pck_img" => $image['filename'],
            "type_of_transport" => $params['type_of_transport'],
            "duration" => $params['duration'],
            "hotel_name" => $params['hotel_name'],
            "star" => $params['star'],
            "area" => $params['area'],
            "hotel_include" => $params['hotel_include'],
            "activity" => $params['activity'],
            "activity_des" => $params['activity_des'],
            "package_id" => $params['package_id'],
            
        ]);
        return ["success" => $package->save()];
    }
    
}
