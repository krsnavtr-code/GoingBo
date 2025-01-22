<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForexBooking extends Model
{
    protected $table = 'forex_bookings';

    protected $fillable = [
        'customer_name',
        'mobile_no',
        'email',
        'city',
        'address',
        'currency_code',
        'amount',
        'payment_method'
    ];
}
