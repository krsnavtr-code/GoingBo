<?php

use App\Http\Controllers\AdminControllers\BlogController;
use App\Http\Controllers\AdminControllers\CityController;
use App\Http\Controllers\UserControllers\BusController;
use App\Http\Controllers\UserControllers\FlightController;
use App\Http\Controllers\UserControllers\HotelController;
use App\Http\Controllers\UserControllers\MembershipController;
use App\Http\Controllers\UserControllers\UserController;
use Illuminate\Support\Str;
use App\Models\HotelSpecialBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('airports')->controller(FlightController::class)->group(function () {
    Route::get('{query}', 'api_airport_search');
});
Route::controller(BlogController::class)->prefix("blog")->group(function () {
    Route::get('toggle/{blogId}', 'api_toggle_blog_status');
});
Route::controller(CityController::class)->group(function () {
    Route::get('country', 'api_get_countries');
    Route::get('state/{countryId}', 'api_get_stateByCountryId');
    Route::get('district/{stateId}', 'api_get_districtByStateId');
    Route::get('city/{query}', 'api_get_releventCity');
});

Route::controller(HotelController::class)->group(function () {
    Route::get('cities', 'api_get_cities');
});

Route::prefix('busstops')->controller(BusController::class)->group(function () {
    Route::get('{query}', 'api_busstop_search');
});


Route::post('members/add', [MemberController::class, 'addmembers'])->name('member.add');

// Route::get('users/get/{flag}', [UserController::class, 'show']);

// Route::post('user', [UserController::class, 'store']);


