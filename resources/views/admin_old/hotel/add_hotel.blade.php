@extends('admin.components.layout')
@section('main')
    <main>
        @include('admin.components.response')
        <form action="{{ Request::get('current_page') }}" method="post" enctype="multipart/form-data">
            <div>
                @csrf
                <h4 class="form_title">Add Special Hotel</h4>
                <p class="form_sub_title">Fill details of hotel to add</p>
            </div>
            <section>
                <h6 class="section_title">Hotel Basic Details</h6>
                <div class="field_group">
                    <div class="field">
                        <label>Hotel Name</label>
                        <input type="text" name="hotel_name">
                    </div>
                    <div class="field">
                        <label>Hotel Address</label>
                        <input type="text" name="hotel_address">
                    </div>
                </div>
                <div class="field_group">
                    <div class="field">
                        <label>Hotel Location</label>
                        <input type="text" name="hotel_location">
                    </div>
                    <div class="field">
                        <label>Hotel Reviews</label>
                        <input type="number" name="hotel_reviews">
                    </div>
                    <div class="field">
                        <label>Hotel Rating</label>
                        <input type="text" name="hotel_rating">
                    </div>
                </div>
                <div class="field_group">
                    <div class="field">
                        <label>Hotel Opened</label>
                        <input type="text" name="hotel_opened">
                    </div>
                    <div class="field">
                        <label>Hotel No. of Rooms</label>
                        <input type="number" name="hotel_rooms">
                    </div>
                    <div class="field">
                        <label>Hotel Renovated</label>
                        <input type="text" name="hotel_renovated">
                    </div>
                </div>
            </section>
            <section>
                <h5 class="section_title">Hotel Amenities</h5>
                <div class="field_group">
                    <div class="field checkbox col-3">
                        <input type="checkbox" name="hotel_amenities[]" multiple id="q1" value="Parking">
                        <label for="q1">Parking</label>
                    </div>
                    <div class="field checkbox col-3">
                        <input type="checkbox" name="hotel_amenities[]" multiple id="q2" value="Free Wifi">
                        <label for="q2">Free Wifi</label>
                    </div>
                    <div class="field checkbox col-3">
                        <input type="checkbox" name="hotel_amenities[]" multiple id="q3" value="Swimming Pool">
                        <label for="q3">Swimming Pool</label>
                    </div>
                    <div class="field checkbox col-3">
                        <input type="checkbox" name="hotel_amenities[]" multiple id="q4" value="Air Conditioning">
                        <label for="q4">Air Conditioning</label>
                    </div>
                    <div class="field checkbox col-3">
                        <input type="checkbox" name="hotel_amenities[]" multiple id="q5" value="Doctor On Call">
                        <label for="q5">Doctor On Call</label>
                    </div>
                    <div class="field checkbox col-3">
                        <input type="checkbox" name="hotel_amenities[]" multiple id="q6" value="Restaurant">
                        <label for="q6">Restaurant</label>
                    </div>
                    <div class="field checkbox col-3">
                        <input type="checkbox" name="hotel_amenities[]" multiple id="q7" value="CCTV Cameras">
                        <label for="q7">CCTV Cameras</label>
                    </div>
                    <div class="field checkbox col-3">
                        <input type="checkbox" name="hotel_amenities[]" multiple id="q8" value="Power Backup">
                        <label for="q8">Power Backup</label>
                    </div>
                    <div class="field checkbox col-3">
                        <input type="checkbox" name="hotel_amenities[]" multiple id="q9" value="Ironing Service">
                        <label for="q9">Ironing Service</label>
                    </div>
                    <div class="field checkbox col-3">
                        <input type="checkbox" name="hotel_amenities[]" multiple id="q10" value="Room Service">
                        <label for="q10">Room Service</label>
                    </div>
                </div>
                <h5 class="section_title" style="margin-top: 20px">Payment Methods</h5>
                <div class="field_group">
                    <div class="field checkbox col-3">
                        <input type="checkbox" name="payment_methods[]" multiple id="w1" value="Cash Payment">
                        <label for="w1">Cash Payment</label>
                    </div>
                    <div class="field checkbox col-3">
                        <input type="checkbox" name="payment_methods[]" multiple id="w1" value="Cards (Debit/Credit)">
                        <label for="w1">Cards (Debit/Credit)</label>
                    </div>
                    <div class="field checkbox col-3">
                        <input type="checkbox" name="payment_methods[]" multiple id="w1" value="UPI Transfer">
                        <label for="w1">UPI Transfer</label>
                    </div>
                    <div class="field checkbox col-3">
                        <input type="checkbox" name="payment_methods[]" multiple id="w1" value="Cheque">
                        <label for="w1">Cheque</label>
                    </div>
                    <div class="field checkbox col-3">
                        <input type="checkbox" name="payment_methods[]" multiple id="w1" value="Bank Transfer">
                        <label for="w1">Bank Transfer</label>
                    </div>
                    <div class="field checkbox col-3">
                        <input type="checkbox" name="payment_methods[]" multiple id="w1" value="Wallet Transfer">
                        <label for="w1">Wallet Transfer</label>
                    </div>
                </div>
            </section>
            <section>
                <div class="field">
                    <label for="">Hotel Overview</label>
                    <textarea name="hotel_overview" id=""></textarea>
                </div>
                <div class="field">
                    <label for="">Hotel Images</label>
                    <input type="file" name="hotel_images[]" multiple id="" style="display: block;">
                </div>
                <div class="field_group">
                    <div class="field">
                        <label for="">checkintime</label>
                        <input type="time" name="hotel_policies[checkintime]">
                    </div>
                    <div class="field">
                        <label for="">checkouttime</label>
                        <input type="time" name="hotel_policies[checkouttime]">
                    </div>
                    <div class="field">
                        <label for="">childrenpolicies</label>
                        <input type="text" name="hotel_policies[childrenpolicies]">
                    </div>
                </div>
                <div class="field_group">
                    <div class="field">
                        <label for="">diningtime</label>
                        <input type="time" name="hotel_policies[diningtime]">
                    </div>
                    <div class="field">
                        <label for="">diningprice</label>
                        <input type="number" name="hotel_policies[diningprice]">
                    </div>
                    <div class="field">
                        <label for="">typeofdinner</label>
                        <input type="text" name="hotel_policies[typeofdinner]">
                    </div>
                </div>
            </section>
            <section style="background: var(--fv_prime)">
                <div class="field_group">
                    <div class="field">
                        <label for="">Room Type</label>
                        <input type="text" name="room[0][room_type]" id="">
                    </div>
                    <div class="field">
                        <label for="">Total Rooms</label>
                        <input type="text" name="room[0][total_rooms]" id="">
                    </div>
                    <div class="field">
                        <label for="">Total Bed</label>
                        <input type="text" name="room[0][total_bed]" id="">
                    </div>
                </div>
                <div class="field_group">
                    <div class="field">
                        <label for="">Room Dimention</label>
                        <input type="text" name="room[0][room_dim]" id="">
                    </div>
                    <div class="field">
                        <label for="">Floors</label>
                        <input type="text" name="room[0][floors]" id="">
                    </div>
                </div>
                <div class="field_group">
                    <div class="field">
                        <label for="">Room Actual Price</label>
                        <input type="text" name="room[0][price]" id="">
                    </div>
                    <div class="field">
                        <label for="">Room Offer Price</label>
                        <input type="text" name="room[0][offered_price]" id="">
                    </div>
                </div>
            </section>
            <button type="submit">Proceed</button>
        </form>
    </main>
@endsection
