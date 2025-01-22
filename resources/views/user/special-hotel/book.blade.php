@extends('user.components.layout')
@push('css')
    <style>
        .results {
            padding: 20px;
            gap: 20px;
            flex-wrap: wrap;
        }

        .sidebar {
            width: 280px;
            gap: 20px;
            height: fit-content;
            position: sticky;
            top: 100px;
        }

        .main_section {
            flex-grow: 1;
            gap: 30px;
        }

        .panel {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px 0 #00000033;
        }

        .fields {
            display: flex;
            gap: 10px;
            margin-top: 5px;
            flex-wrap: wrap;
        }

        .fields .field {
            display: flex;
            flex-direction: column;
        }

        .fields .field label {
            font-size: 1.3rem;
            margin-bottom: 3px;
        }

        .fields .field:has(input, select) {
            flex-grow: 1;
        }

        .fields .field :is(input, select) {
            padding: 5px 10px;
        }

        form button {
            padding: 9px;
            font-weight: 600;
            font-size: 1.5rem;
            background: var(--fv_prime);
            border-radius: 6px;
            border: none;
        }

        .query_panel button,
        .booking_panel button {
            margin-top: 15px;
            border-radius: 100px;
            width: 100%;
            padding: 8px;
            border: none;
            font-weight: 600;
            color: white;
            text-transform: capitalize;
            background: var(--fv_sec);
        }

        .query_panel h5 {
            font-size: 1.6rem;
            margin-bottom: 5px;
        }

        .query_panel p {
            font-size: 1.2rem;
            color: var(--gray_500);
        }

        .query_panel button {
            background: var(--fv_prime);
        }

        .meal {
            padding: 10px 20px;
            border-radius: 6px;
            margin: 10px 0;
            background: rgba(var(--fv_prime_rgb), 0.3);
        }

        .meal input {
            margin: 10px;
        }
        label{
            font-weight: 500;
            color: var(--fv_sec);
        }
        input{
            padding: 1rem !important;
            border-radius: 10px;
            border: 1px solid var(--fv_sec);
        }
    </style>
@endpush
@section('main')
    <main>
        <div class="results rflex">
            <form action="{{ url('special-hotel/checkout') }}" method="post" class="main_section cflex">
                @csrf
                <div class="panel">
                    <h5>Hotel Details</h5>
                    <h6 class="hotel_name" style="color: var(--fv_prime);">{{ $hotel['hotel_name'] }}</h6>
                    <p>{{ $hotel['hotel_address'] }}</p>
                    <input type="hidden" name="hotel_id" value="{{ $hotel['id'] }}">
                    <div class="fields" style="margin-top: 30px;">
                        <div class="field">
                            <label for="">Room Type</label>
                            <input type="text" name="room_type" readonly value="{{ $type }}">
                        </div>
                        <div class="field">
                            <label for="">No. of Rooms</label>
                            <input type="number" name="rooms" required value="1" min="1">
                        </div>
                    </div>
                    <div class="fields">
                        <div class="field">
                            <label for="">No. of guests</label>
                            <input type="number" name="guests" required value="1" min="1">
                        </div>
                        <div class="field">
                            <label for="">Checkin date</label>
                            <input type="date" name="checkin" required id="dep_date"  min="{{ now()->toDateString() }}">
                        </div>
                        <div class="field">
                            <label for="">No. of days</label>
                            <input type="number" name="days" required value="1" min="1">
                        </div>
                    </div>
                </div>
                <div class="panel">
                    <h5 class="panel_title">User Details</h5>
                    <div class="" style="margin-top:10px">
                        <h6>User Details</h6>
                        <div class="fields">
                            <div class="field">
                                <label for="">First Name</label>
                                <input type="text" name="fname" maxlength="40" pattern="[A-Za-z\s]*" required>
                            </div>
                            <div class="field">
                                <label for="">Last Name</label>
                                <input type="text" name="lname" maxlength="40" pattern="[A-Za-z\s]*" required>
                            </div>
                        </div>
                    </div>
                    <div class="contact_details traveller" style="margin-top:20px">
                        <h6>Contact Details</h6>
                        <div class="fields">
                            <div class="field">
                                <label for="">Contact</label>
                                <input type="tel" name="contact[contact]" pattern="[0-9]{10}" maxlength="10"   required>
                            </div>
                            <div class="field">
                                <label for="">E-mail</label>
                                <input type="email" name="contact[mail]" maxlength="40" required>
                            </div>
                        </div>
                        <p style="font-size: 1.2rem;font-weight:600;color:var(--error);margin-top:7px;">If you are not
                            logged in these
                            details will be used to create your account</p>
                    </div>
                    <div class="address_details traveller" style="margin-top:20px">
                        <h6>Address Details</h6>
                        <div class="fields">
                            <div class="field">
                                <label for="">Address</label>
                                <input type="text" name="address[address]" maxlength="20" required>
                            </div>
                            <div class="field">
                                <label for="">City</label>
                                <input type="text" name="address[city]" maxlength="20" required>
                            </div>
                            <div class="field">
                                <label for="">State</label>
                                <input type="text" name="address[state]" maxlength="20" required>
                            </div>
                            <div class="field">
                                <label for="">Country</label>
                                <input type="text" name="address[country]" list="countries" maxlength="20" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel">
                    <h5 class="panel_title">GST Details (Optional)</h5>
                    <div class="gst_details traveller">
                        <div class="fields">
                            <div class="field">
                                <label for="">Company Name</label>
                                <input type="text" name="company[companyName]" id="" pattern="[A-Za-z\s]*" maxlength="40">
                            </div>
                            <div class="field">
                                <label for="">GST Number</label>
                                <input type="text" name="company[companyGST]" id="" pattern="[0-9]*" maxlength="40">
                            </div>
                        </div>
                        <div class="fields">
                            <div class="field">
                                <label for="">Company E-mail</label>
                                <input type="email" name="company[companyMail]" id="" maxlength="40" >
                            </div>
                            <div class="field">
                                <label for="">Company Contact</label>
                                <input type="tel" name="company[companyContact]" id="" pattern="[0-9]{10}" maxlength="10" >
                            </div>
                        </div>
                        <div class="fields">
                            <div class="field">
                                <label for="">Company Address</label>
                                <input type="text" name="company[companyAddress]" id="" maxlength="40">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel">
                    <h5 class="panel_title">Meal Selection</h5>
                    <div class="meal">
                        <input type="checkbox" name="dinner_include" value="1">
                        <label for="">Add Dinner for <b>₹350</b></label> <br>
                                <select id="foodtype" name="foodtype">
                                  <option value="Veg">Veg</option>
                                  <option value="non-veg">Non-Veg</option>
                                  <option value="jain">Jain</option>
                                </select>
                              
                                <select id="foodtime" name="foodtime">
                                  <option value="free_breakfast">Free Breakfast</option>
                                  <option value="Lunch">Breakfast & Lunch/Dinner Included</option>
                                </select>
                              
                                <select id="persons" name="persons">
                                  @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                  @endfor
                                </select>
                                <button id="calculatePriceBtn" value="submit">Calculate Price</button>                            
                            <div id="personsList">
                                <div>
                                    <p>Food Type: <span class="food_type"></span></p>
                                    <p>Food Time: <span class="food_time"></span></p>
                                    <p class="price">Price: $<span class="calculated_price"></span></p>
                                </div>
                            </div>
                    </div>
                </div>
                <button type="submit">Review Order</button>
            </form>
            <div class="sidebar cflex">
                <div class="panel query_panel">
                    <h5>Raise A Query</h5>
                    <p>Having anything in mind, feel free to write us. We are here for you. We will connect you back as soon
                        as possible</p>
                    <button>Raise A Query</button>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('js')
    {{-- <script>
        today = new Date;
        $("#dep_date").set("min", `${today.getFullYear()}-${today.getMonth()+1}-${today.getDate()}`);
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get the input element
            var dep_date = document.getElementById('dep_date');
    
            // Set the minimum date to the current date
            dep_date.min = new Date().toISOString().split('T')[0];
        });
    </script>
@endpush
