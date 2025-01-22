@extends('user.components.layout')
@push('css')
<link rel="stylesheet" href="{{ url('css/user_css/cab.css') }}">
<link rel="stylesheet" href="{{ url('css/user_css/bookcab.css') }}">
@endpush
@section('main')
<main>
    @if($cabroutes)
    <h1>Review Your Booking</h1>
    <div class="searched-box">
        <p>{{$type}}</p>
        <p> {{$goingFromCity}} to {{ $goingToCity}}</p>
        <p>{{$cDate}} -- {{$cTime}}</p>
    </div>
    <section class="my-row">
        <!-- cab card -->
        <article class="cab-card">
            <figure class="img-box">
                <span class="rating"><i class="fa-solid fa-star"></i> 4.2</span>
                <span class="review"> 941 ratings </span>
                <img src="{{ asset('images/cab assets/vehicle/' . $cabroutes['cab']['vehicle_img']) }}" class="cab_card_img">

            </figure>
            <div class="text-box">
                <div class="card-head">
                    <h2 class="cab-name"> {{ $cabroutes['cab']['vehicle_model'] }}</h2>
                    <div class="details">
                        @php
                        $vehicleFeatures = json_decode($cabroutes['cab']['vehicle_features']);
                        @endphp
                        <h5 class="cab-type"> {{ $vehicleFeatures->Type }} </h5>
                        <ul class="cab-features">
                            @if (isset($vehicleFeatures->other))
                            @foreach ($vehicleFeatures->other as $otherFeature)
                            <li>{{ $otherFeature }}</li>
                            @endforeach
                            @endif
                            <li>{{ $vehicleFeatures->Baggage }} Kg Baggage</li>
                            <li>
                                <i class="fa-solid fa-user"></i>
                                <span> {{ $vehicleFeatures->Seats }} Seats </span>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="card-body">
                    <div class="left">
                        <h4 class="cab-title"> Economical Car </h4>
                        <ul>
                            <li>
                                <i class="fa-regular fa-circle-check"></i>
                                <p> Pickup : {{$cabroutes['from_city']['city_name']}} </p>
                            </li>
                            <li>
                                <i class="fa-regular fa-circle-check"></i>
                                <p> For any extension of the trip, a charge of <i class="fa-solid fa-indian-rupee-sign"></i> {{$cabroutes['cab']['km_price']}}/- per kilometer will be applicable.</p>
                            </li>
                            <li>
                                <i class="fa-regular fa-circle-check"></i>
                                <p>Free Cancellation until {{$cabroutes['free_cancel'] }} hours</p>
                            </li>
                        </ul>
                    </div>
                    <div class="right">
                        <p class="discount"><i class="fa-regular fa-badge-percent"></i> 16% off {{$cabroutes['coupon'] }}</p>
                        <del class="old-price">
                            <i class="fa-solid fa-indian-rupee-sign"></i>
                            <span>{{$cabroutes['price'] + rand(500, 600)}}/-</span>
                        </del>
                        <h3 class="price">
                            <i class="fa-solid fa-indian-rupee-sign"></i>
                            <span>{{$cabroutes['price']}}/-</span>
                        </h3>
                        <p class="tax">
                            <i class="fa-solid fa-indian-rupee-sign"></i>
                            <span>{{$gst = 18/100 * $cabroutes['price'] }}/- taxes & fees</span>
                        </p>
                    </div>
                </div>
            </div>
        </article>
        <!-- query -->
        <aside>
            <div class="query-box">
                <h5>Raise A Query</h5>
                <p>Having anything in mind, feel free to write us. We are here for you. We will connect you back as soon as possible</p>
                <button>Raise A Query</button>
            </div>
        </aside>
    </section>
    <!-- Traveller -->
    <section class="order-box">
        <h3> Traveller Details</h3>
        <p style="color: red">If you are not logged in these details will be used to create your account </p>
        <div class="order search-bar">
            <form method="get" action="{{ url('/cab/' . $type . '/book/' . $cabroutes['id']. '/checkout')}}">

                <input type="hidden" name="goingFromCity" value="{{$goingFromCity}}">
                <input type="hidden" name="goingToCity" value="{{$goingToCity}}">
                <input type="hidden" name="cDate" value="{{$cDate}}">
                <input type="hidden" name="cTime" value="{{$cTime}}">

                <div class="field">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender" required>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                        <option value="O">Other</option>
                    </select>
                </div>
                <div class="field">
                    <label for="name">Name</label>
                    <input id="name" name="name" type="text" placeholder="enter full name" maxlength="40" pattern="[A-Za-z\s]*" required>
                </div>
                <div class="field">
                    <label for="mobile">Mobile number</label>
                    <input id="mobile" type="tel" name="mobile_no" placeholder="enter mobile number" pattern="[0-9]{10}" maxlength="10" required>
                </div>
                <div class="field">
                    <label for="email">Email </label>
                    <input id="email" type="email" name="email" placeholder="enter email address" maxlength="40" required>
                </div>
                <div class="field">
                    <label for="passengers">Passengers</label>
                    <select name="passengers" id="passengers" required>
                        @for($i=1; $i<=$vehicleFeatures->Seats; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                            @endfor
                    </select>
                </div>
                <div class="field">
                    <button value="submit" class="ord_cab">Order Cab</button>
                </div>
            </form>
        </div>
    </section>

    @endif
</main>

@endsection