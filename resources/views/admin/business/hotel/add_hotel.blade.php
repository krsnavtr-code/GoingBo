
@extends('admin.business.layouts.app')

@push('css')
<style>
/* Custom styling for the hotel form */
.hotel-form-container {
    width: 60%;
    margin: 0 auto;
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.hotel-form-container h2 {
    text-align: center;
    color: #333;
}

.hotel-form-container form fieldset {
    margin-bottom: 20px;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
}

.hotel-form-container form fieldset legend {
    font-weight: bold;
    color: #333;
}

.hotel-form-container form label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #555;
}

.hotel-form-container form input,
.hotel-form-container form textarea,
.hotel-form-container form select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.hotel-form-container form button {
    display: block;
    width: 100%;
    padding: 12px;
    background-color: #007bff;
    color: white;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.hotel-form-container form button:hover {
    background-color: #0056b3;
}

.alert {
    padding: 15px;
    background-color: #4caf50;
    color: white;
    margin-bottom: 20px;
    text-align: center;
    border-radius: 5px;
}
</style>
@endpush

@section('content')
<div class="hotel-form-container">
    <h2>Add Hotel</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ url('admin/business-login/hotel/store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Hotel Details -->
        <fieldset>
            <legend>Hotel Details</legend>

            <label for="hotel_name">Hotel Name:</label>
            <input type="text" id="hotel_name" name="hotel_name" required>

            <label for="hotel_address">Hotel Address:</label>
            <input type="text" id="hotel_address" name="hotel_address" required>

            <label for="hotel_city">Hotel City:</label>
            <input type="text" id="hotel_city" name="hotel_city" required>

            <label for="hotel_description">Hotel Description:</label>
            <textarea id="hotel_description" name="hotel_description" rows="4" required></textarea>

            <label for="hotel_rating">Hotel Rating (1-5):</label>
            <input type="number" id="hotel_rating" name="hotel_rating" min="1" max="5" required>

            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" required>

            <label for="fax_number">Fax Number:</label>
            <input type="number" id="fax_number" name="fax_number" >

            <label for="country_name">Country Name:</label>
            <input type="text" id="country_name" name="country_name" required>

            <label for="city_name">City Name:</label>
            <input type="text" id="city_name" name="city_name" required>

            <label for="check_in_time">Check-In Time:</label>
            <input type="text" id="check_in_time" name="check_in_time" required>

            <label for="check_out_time">Check-Out Time:</label>
            <input type="text" id="check_out_time" name="check_out_time" required>
        </fieldset>

        <!-- Room Details -->
        <fieldset>
            <legend>Room Details</legend>

            <label for="room_name">Room Name:</label>
            <input type="text" id="room_name" name="room_name[]" multiple required>

            <label for="total_fare">Total Fare:</label>
            <input type="text" id="total_fare" name="total_fare" required>

            <label for="total_tax">Total Tax:</label>
            <input type="text" id="total_tax" name="total_tax" required>

            <label for="extra_guest_charges">Extra Guest Charges:</label>
            <input type="text" id="extra_guest_charges" name="extra_guest_charges">

            <label for="room_description">Room Description:</label>
            <input type="text" id="room_description" name="room_description[]" required>

            <label for="cancellation_policies">Cancellation Policies:</label>
            <input type="text" id="cancellation_policies" name="cancellation_policies[]" required>

            <label for="meal_type">Meal Type:</label>
            <input type="text" id="meal_type" name="meal_type" required>

            <label for="is_refundable">Is Refundable:</label>
            <select id="is_refundable" name="is_refundable" required>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>

        </fieldset>

        <!-- Location Details -->
        <fieldset>
            <legend>Location Details</legend>

            <label for="lat">Latitude:</label>
            <input type="text" id="lat" name="lat" >

            <label for="lon">Longitude:</label>
            <input type="text" id="lon" name="lon" >
        </fieldset>

        <!-- Hotel Images -->
        <fieldset>
            <legend>Hotel Images</legend>
            <label for="hotel_images">Hotel Images:</label>
            <input type="file" id="hotel_images" name="hotel_images[]" multiple accept="image/*" required>
        </fieldset>

        <!-- Room Images -->
        <fieldset>
            <legend>Room Images</legend>
            <label for="room_images">Room Images:</label>
            <input type="file" id="room_images" name="room_images[]" multiple accept="image/*" required>
        </fieldset>

        <button type="submit">Submit</button>
    </form>
</div>
@endsection
