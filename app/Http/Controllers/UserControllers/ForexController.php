<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\ForexBooking;
use Mail;

class ForexController extends Controller
{

public function showForexRates()
{
    
    $response = Http::get("https://v6.exchangerate-api.com/v6/34051d0c179883d426bbd63b/latest/INR");

    if ($response->successful() && isset($response->json()['conversion_rates'])) {
        $rates = $response->json()['conversion_rates'];
        $currencies = [
            'USD', 'GBP', 'EUR', 'AUD', 'CAD', 'SGD', 'AED', 'JPY'
        ];
        return view('user.forex.index', compact('rates', 'currencies'));
    } else {
        // Log the error for further investigation
        Log::error('API Error: ' . $response->body());

        // Return an error message to the view
        return view('user.forex.index')->withErrors('Unable to fetch currency rates. Please try again later.');
    }
}

public function bookForex(Request $request)
{
    // Save data to database
    $forexBooking = new ForexBooking();
    $forexBooking->fill($request->all());
    $forexBooking->save();

    // Send email to user
    $to_email = $request->email;
    $subject = "Booking Confirmation - Goingbo Tours Pvt Ltd";
    $message = "Goingbo Tours Pvt Ltd\nWe assure your delivery of {$request->payment_method} within 4 hrs\nThank you.";
    $headers = "From: no-reply@goingbo.com";

    mail($to_email, $subject, $message, $headers);

    // Send email to boss
    $sir_email = "anand24h@gmail.com";
    mail($sir_email, "New Forex Booking", print_r($request->all(), true), $headers);

    return redirect()->back()->with('success', 'Booking confirmed!');
}

}
