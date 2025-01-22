<?php

use App\Http\Controllers\ApiControllers\RazorPayController;
use App\Http\Controllers\ApiControllers\TBOBase;
use App\Http\Controllers\UserControllers\BlogController;
use App\Http\Controllers\UserControllers\BusController;
use App\Http\Controllers\UserControllers\FlightController;
use App\Http\Controllers\UserControllers\HotelController;
use App\Http\Controllers\UserControllers\UserController;
use App\Http\Controllers\UserControllers\CabController;
use App\Http\Controllers\UserControllers\MembershipController;
use App\Http\Controllers\UserControllers\ForexController;
use App\Models\CabBooking;
use App\Models\HotelSpecial;
use App\Models\HotelSpecialBooking;
use App\Models\Package;
use App\Models\PackageBooking;
use App\Models\PackageDay;
use App\Models\TaxiSpecial;
use App\Models\TaxiSpecialBooking;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use App\Http\Controllers\ApiControllers\TBOHotel;

// About Page
Route::view("about", "user.info.about");
// Career Page
Route::view("career", "career");
// Contact Page
Route::view("contact", "user.info.contact");
// Copyright Page
Route::view("copyright", "copyright");
// Faqs Page
Route::view("faqs", "faqs");
// Gallery Page
Route::view("gallery", "gallery");
// News Page
Route::view("news", "news");
// Privacy Policy Page
Route::view("privacy", "user.info.privacy");
// Refund Page
Route::view("refund", "user.info.refundandcancellation");
// Reviews Page
Route::view("reviews", "reviews");
// Terms and Condition of uses Page
Route::view("terms", "user.info.termsandconditions");

Route::get("/", function () {

    $data = [
        "recommends" => Package::all()->random(8)->toArray(),
    ];
    // dd($data);
    return view('user.index', $data);
})->name('user.home');



Route::get('fetch-cabs', [UserController::class, 'fetchcabs']);

Route::controller(UserController::class)->prefix("user")->group(function () {
    Route::get("", '');
    Route::prefix("bookings")->group(function () {
        Route::get("", 'ui_view_flight_bookings')->name('flight_bookings');
        Route::prefix("flight")->group(function () {
            Route::post('cancel', 'web_cancel_flight_booking');
            Route::get('', fn () => redirect()->route('flight_bookings'));            
            Route::get('{Id}', 'ui_view_flight_booking');
        });
    });
    Route::prefix("cab")->group(function () {
        Route::get('download/ticket/{id}', 'ui_download_cab_ticket');
    });
    Route::prefix("login")->group(function () {
        Route::get("", 'ui_login');
        Route::post("", 'web_login');
        Route::prefix("verify")->group(function () {
            Route::get("", '');
            Route::post("", '');
        });
    });
    Route::get("logout", function () {
        session()->flush();
        return redirect()->route('user.home');
    });
});

Route::prefix('packages')->group(function () {
    Route::get('', function () {
        session()->forget(["package", "pkg_total", "pkg_pass"]);
        $data = ["packages" => Package::all()->toArray()];
        $data += [
            "recommends" => Package::all()->random(8)->toArray()
        ];
        return view("user.package.packages", $data);
    });

    Route::get('ex', function () {
        session()->forget(["package", "pkg_total", "pkg_pass"]);
        $data = ["packages" => Package::all()->toArray()];
        $data += [
            "recommends" => Package::all()->random(8)->toArray()
        ];
        return view("user.package.packagesex", $data);
    });
    Route::get('{query}', function ($query) {
        $data = ["package" => Package::where('slug', $query)->first()->toArray()];
        $data['days'] = PackageDay::where('package_id', $data['package']['id'])->get()->toArray();
        return view("user.package.package", $data)->render();
    });

    Route::get('review/{query}', function ($query) {
        session()->forget(["package", "pkg_total", "pkg_pass"]);
        $pkg = Package::where('id', $query)->first()->toArray();
        $data = ["package" => $pkg];
        return view('user.package.review', $data);
    });
    Route::post('checkout', function () {
        session()->forget(["package", "pkg_total", "pkg_pass"]);
        $pkg_pass = request()->all();
        $pkg = Package::find(request()->pkg_id)->toArray();
        $total = (preg_replace('/\D/', '', $pkg['price']) * 2);
        $data = ["package" => $pkg, "pkg_total" => $total, "pkg_pass" => $pkg_pass] + razorPayController::make_order(floor($total + $total * 18 / 100));
        session()->put($data);
        return view('user.package.checkout', $data);
    });
    Route::match(['get', 'post'], 'ticket', function () {
        $pkg = session()->get('package');
        $fare = session()->get('pkg_total');
        $gst = $fare * 18 / 100;
        $total = $fare + $gst;

        $pkg_pass = session()->get('pkg_pass');

        if (!session()->has('user')) {
            $user = new UserController;
            $user->quick_login(['email' => $pkg_pass['contact']['mail'], "contact" => $pkg_pass['contact']['contact']]);
        }
        if (!session()->has('pkg_token')) {
            $token = Str::random(15);
            session()->put("pkg_token", $token);
            $booking = new PackageBooking();
            $booking->package_id = $pkg_pass['pkg_id'];
            $booking->checkin = $pkg_pass['checkin'];
            $booking->username = $pkg_pass['fname'] . " " . $pkg_pass['lname'];
            $booking->contact_details = json_encode($pkg_pass['contact']);
            $booking->address_details = json_encode($pkg_pass['address']);
            $booking->gst_details = json_encode($pkg_pass['company']);
            $booking->save();
        } else $token = session()->get("pkg_token");
        $data = ["pkg" => $pkg, "fare" => $fare, "charges" => 0, "gst" => $gst, "total" => $total, "pkg_pass" => $pkg_pass, "pkg_token" => $token];
        return view('user.package.ticket', $data);
    });
});

Route::controller(FlightController::class)->prefix("flight")->group(function () {
    Route::get('/', function () {
        return view('user.flight.index')->with('activeForm', 'flight');
    });
    Route::get('search', 'ui_search_flights');
    Route::post('filter', 'ui_get_flights');
    Route::get('fare',  'ui_calender_fare');
    Route::get('review', 'ui_review_flight');
    Route::post('checkout', 'ui_checkout_flight');
    Route::post('ticket', 'web_book_ticket')->withoutMiddleware('VerifyCsrfToken');
    Route::get('ticket', 'ui_book_ticket');
    Route::get("booking", 'ui_booking_details');
});

Route::prefix('hotel')->controller(HotelController::class)->group(function () {
    Route::get('/', function () {
        return view('user.hotels.index')->with('activeForm', 'hotel');
    });
    Route::get('search_results', 'ui_hotels');
    Route::get('view/{hotelcode}', 'ui_hotels_view');
    // Route::get('view', 'ui_hotel_view');
    Route::post('bookingform', 'web_hotel_bookingform');
    Route::post('checkout', 'web_checkout_hotel');
    Route::post('ticket', 'web_book_ticket');
    Route::get('/get-coordinates/{city}', 'getCoordinatesForCity');
});




Route::prefix('special-hotel')->group(function () {
    // Route::get('', function () {
    //     $data = ['spacialhotels' => HotelSpecial::all()];
    //     return view("user.special-hotel.index", $data);
    // });
    

    Route::match(['get', 'post'], "ticket", function () {
        $hotel = session()->get("hotel");
        $room = session()->get("room");
        $person = session()->get("person");
        if (!session()->has('user')) {
            $user = new UserController;
            $user->quick_login(['email' => $person['contact']['mail'], "contact" => $person['contact']['contact']]);
        }
        if (!session()->has('token')) {
            $token = Str::random(15);
            session()->put("token", $token);
            $booking = new HotelSpecialBooking();
            $booking->hotel_id = $hotel['id'];
            $booking->room_type = $room['room_type'];
            $booking->rooms = $person['rooms'];
            $booking->checkin = $person['checkin'];
            $booking->days = $person['days'];
            $booking->user_id = session()->get('user')['userId'];
            $booking->username = $person['fname'] . " " . $person['lname'];
            $booking->contact_details = json_encode($person['contact']);
            $booking->address_details = json_encode($person['address']);
            $booking->gst_details = json_encode($person['company']);
            $booking->payment_details = json_encode([]);
            $booking->token = $token;
            $booking->save();
        }

        $data = [
            'hotel' => $hotel,
            'room' => $room,
            'person' => $person,
            "fare" => $room['roomofferprice'],
            "charges" => 0,
            "gst" => $room['roomofferprice'] * 18 / 100,
            "total" => $room['roomofferprice'] +  $room['roomofferprice'] * 18 / 100,
            "token" => session()->get("token")
        ];
        return view("user.special-hotel.ticket", $data);
    });

    Route::get("book/{hotel}", function ($hotel) {
        $data = ["hotel" => HotelSpecial::find($hotel)->toArray(), 'type' => request()->type];
        return view("user.special-hotel.book", $data);
    });
    Route::post("checkout", function () {
        $person = request()->all();
        $hotel = HotelSpecial::find(request()->hotel_id)->toArray();
        $room = [];
        $food = 0;
        $rooms = json_decode($hotel['hotel_room'], true);
        for ($i = 0; $i < count($rooms); $i++) {
            if ($rooms[$i]['room'] == $person['room_type']) {
                $room = $rooms[$i];
                break;
            }
        }
        if (request()->dinner_include) {
            $food = 350;
        }
        $total = floor($person['rooms'] * ($room['roomofferprice'] + $food) * 105 / 100);
        $data = ["hotel" => $hotel, "room" => $room, "person" => $person] + razorPayController::make_order($total);
        if (request()->dinner_include) {
            $data += ["food" => 350];
        }
        session()->put($data + ["total" => $total]);
        return view("user.special-hotel.checkout", $data);
    });
    Route::get("{hotel}", function ($hotel) {
        $data = ["hotel" => HotelSpecial::find($hotel)->toArray()];
        return view("user.special-hotel.info", $data);
    });
});


Route::prefix('bus')->controller(BusController::class)->group(function () {
    Route::get('', 'ui_search');
    Route::post('', 'web_search');
});


Route::controller(BlogController::class)->prefix("blogs")->group(function () {
    Route::get("", 'ui_view_blogs');
    Route::get("category", 'ui_view_blog_categories');
    Route::get("{slug}", 'ui_view_blog');
});



Route::controller(CabController::class)->prefix("cab")->group(function () {
    Route::get("", 'ui_index');

    Route::match(['get', 'post'], "ticket", function () {
        $fareSummary = session('fareSummary');
        // dd($fareSummary);

        if (!session()->has('user')) {
            $user = new UserController;
            $user->quick_login(['email' => $fareSummary['email'], "contact" => $fareSummary['mobileNo']]);
        }

        // You can now use $fareSummary to access the stored values
        $userData = session()->get('user');
        $bookingid = Str::random(5) . now()->timestamp;

        $booking = new CabBooking();
        $booking->user_id =   $userData['userId'];
        $booking->from_city = $fareSummary['goingFromCity'];
        $booking->to_city = $fareSummary['goingToCity'];
        $booking->passengers = $fareSummary['passengers'];
        $booking->date = $fareSummary['cDate'];
        $booking->time = $fareSummary['cTime'];
        $booking->booked_cab = $fareSummary['id'];
        $booking->booking_unique_id = $bookingid;
        $booking->payment_details = json_encode(['price' => $fareSummary['price'], 'fare' => $fareSummary['fare'], 'charges' => 0, 'gst' => $fareSummary['gst'], 'total' => $fareSummary['total']]);
        $booking->save();

        $data = [
            'bookingid' => $bookingid,
            'name' => $fareSummary['name'],
            'email' =>  $fareSummary['email'],
            'mobileNo' => $fareSummary['mobileNo'],
            'price' => $fareSummary['price'],
            'fare' => $fareSummary['fare'],
            'charges' => 0,
            'gst' => $fareSummary['gst'],
            'total' => $fareSummary['total'],

        ];

        return view("user.cab.ticket", $data);
    });

    Route::get("{type}", 'ui_search_type');
    Route::get("{type}/search", 'ui_search_cabs');
    Route::get("{type}/book/{id}", 'ui_book_cab');
    Route::get("{type}/book/{id}/checkout", 'ui_checkout');
});

Route::controller(MembershipController::class)->prefix("membership")->group(function () {
    Route::get('', function () {
        return view('user.membership.index');
    });
    Route::match(['get', 'post'], 'ticket', 'ui_ticket_membership');

    Route::get('{type}', 'ui_book_membership');
    Route::post('{type}/book', 'web_book_membership');
});

Route::controller(ForexController::class)->prefix("forex")->group(function(){
    Route::get('',  'showForexRates') ;
    Route::post('book', 'bookForex') ;
});

