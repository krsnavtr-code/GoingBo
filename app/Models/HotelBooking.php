<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelBooking extends Model
{

    protected $table = 'hotel_booking';
    public $timestamps = false;

    // Define the fillable fields that can be mass-assigned
    protected $fillable = [
        'user_id',  
        'payment',  
        'HotelBookingStatus',
        'ConfirmationNo',
        'BookingRefNo',
        'BookingId',
        'IsPriceChanged',
        'IsCancellationPolicyChanged',
        'NetAmount',
        'NetTax',
        'VoucherStatus',
        'InvoiceAmount',
        'InvoiceCreatedOn',
        'InvoiceNo',
        'LastCancellationDeadline',
        'HotelCode',
        'HotelId',
        'HotelName',
        'TBOHotelCode',
        'AddressLine1',
        'City',
        'CityId',
        'CheckInDate',
        'CheckOutDate',
        'NoOfRooms',
        'Rooms',
        'RateConditions',
    ];

    // Cast the JSON columns to arrays when retrieving from the database
    protected $casts = [
        'Rooms' => 'array',
        'RateConditions' => 'array',
        'IsPriceChanged' => 'boolean',
        'IsCancellationPolicyChanged' => 'boolean',
        'VoucherStatus' => 'boolean',
        'InvoiceCreatedOn' => 'datetime',
        'LastCancellationDeadline' => 'datetime',
        'CheckInDate' => 'datetime',
        'CheckOutDate' => 'datetime',
        'payment' => 'array',
    ];
}
