<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\BaseControllers\HotelBase;
use Illuminate\Http\Request;
use App\Models\HotelSpecial;
use App\Models\BusinessLogin;
use Carbon\Carbon;


class HotelController extends HotelBase
{
    public function create()
    {
        return view('admin.business.hotel.add_hotel');
    }

    public function store(Request $request)
    {
        $businessLoginId = session('businessId');

        $company = BusinessLogin::find($businessLoginId);
        $companyName = $company ? $company->company_name : 'UnknownCompany';
    
        // Validate the form data
        $validated = $request->validate([
            'hotel_name' => 'required|string|max:255',
            'hotel_address' => 'required|string|max:255',
            'hotel_city' => 'required|string|max:255',
            'hotel_description' => 'required|string',
            'hotel_rating' => 'required|numeric|min:1|max:5',
            'phone_number' => 'required|string|max:255',
            'fax_number' => 'nullable|integer',
            'country_name' => 'required|string|max:255',
            'city_name' => 'required|string|max:255',
            'check_in_time' => 'required|string',
            'check_out_time' => 'required|string',
            'room_name' => 'required|array',
            'total_fare' => 'required|numeric',
            'total_tax' => 'required|numeric',
            'extra_guest_charges' => 'nullable|numeric',
            'room_description' => 'array',
            'cancellation_policies' => 'array',
            'meal_type' => 'required|string',
            'is_refundable' => 'required|boolean',
            'lat' => 'nullable|numeric',
            'lon' => 'nullable|numeric',
            'hotel_images' => 'required|array',
            'hotel_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',  // Validate each image
            'room_images' => 'required|array',
            'room_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',  // Validate each image
        ]);

        // Handle hotel images upload
        $hotelImages = [];
        if ($request->hasFile('hotel_images')) {
            foreach ($request->file('hotel_images') as $image) {
                // Generate the filename
                $timestamp = Carbon::now()->format('YmdHis');
                $extension = $image->getClientOriginalExtension();
                $filename = $companyName . '_' . $timestamp . '.' . $extension;

                // Store the image in the public/images directory
                $path = $image->move(public_path('images/special-hotels/hotel_images'), $filename);
                $hotelImages[] = 'images/special-hotels/hotel_images/' . $filename;
            }
        }

        // Handle room images upload
        $roomImages = [];
        if ($request->hasFile('room_images')) {
            foreach ($request->file('room_images') as $image) {
                // Generate the filename
                $timestamp = Carbon::now()->format('YmdHis');
                $extension = $image->getClientOriginalExtension();
                $filename = $companyName . '_' . $timestamp . '.' . $extension;

                // Store the image in the public/images directory
                $path = $image->move(public_path('images/special-hotels/room_images'), $filename);
                $roomImages[] = 'images/special-hotels/room_images/' . $filename;
            }
        }

        // Convert arrays to JSON
        $validated['room_name'] = json_encode($validated['room_name']);
        $validated['room_description'] = json_encode($validated['room_description']);
        $validated['cancellation_policies'] = json_encode($validated['cancellation_policies']);

        $validated['hotel_images'] = json_encode($hotelImages);
        $validated['room_images'] = json_encode($roomImages);   

        $validated['company_id'] = $businessLoginId;
       
        HotelSpecial::create($validated);

        return redirect('admin/business-login/hotel/add')->with('success', 'Hotel added successfully!');
    }
}
