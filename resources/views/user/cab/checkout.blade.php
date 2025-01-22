@extends('user.components.layout')
@push('css')
<link rel="stylesheet" href="{{ url('css/user_css/cab.css') }}">
<link rel="stylesheet" href="{{ url('css/user_css/bookcab.css') }}">
<link rel="stylesheet" href="{{ url('css/user_css/checkout.css') }}">

@endpush
@section('main')
<main>
    <section class="my-row">
        <article class="checkout-card">
            <h2 class="title">
                Please confirm your cab booking by paying
                <i class="fa-solid fa-indian-rupee-sign"></i>
                <span>{{$total}}.</span>
            </h2>
            <div class="locations between">
                <h6 class="from">
                    <i class="fa-solid fa-car"></i>
                    <span>{{$request->goingFromCity}}</span>
                </h6>
                <p>
                    @if($type === 'Round-Trip')
                    <i class="fa-solid fa-right-left"></i>
                    @else
                    <i class="fa-solid fa-right-long"></i>
                    @endif
                </p>
                <h6 class="to">
                    <i class="fa-solid fa-car"></i>
                    <span>{{$request->goingToCity}}</span>
                </h6>
            </div>
            <div class="passenger between">
                <h6>
                    <i class="fa-solid fa-user"></i>
                    <span>passengers:</span>
                </h6>
                <span>{{$request->passengers}}</span>
            </div>
            <div class="pickup">
                <div class="between">
                    <h6>
                        <i class="fa-solid fa-clock"></i>
                        <span>pickup time in</span>
                        <span>{{$request->goingFromCity}}:</span>
                    </h6>
                    <p>{{$request->cDate}}</p>
                    <h5>{{$request->cTime}}</h5>
                </div>
            </div>

            <h4 class="cab-name"> {{$cabroutes['cab']['vehicle_model']}}</h4>
            <div class="traveler between">
                <h6>{{$request->name}}</h6>
                <h6>{{$request->email}}</h6>
                <h6>{{$request->mobile_no}}</h6>
            </div>
            <div class="fare">
                <h5>Fare Summary</h5>
                <div class="between">
                    <h6>{{$type}} cab ({{$cabroutes['price']}} x {{$request->passengers}})</h6>
                    <p>
                        <i class="fa-solid fa-indian-rupee-sign"></i>
                        <span>{{ $fare }}/-</span>
                    </p>
                </div>
                <div class="between">
                    <h6>Gst ({{$gst}}%)</h6>
                    <p class="tax">
                        <i class="fa-solid fa-plus"></i>
                        <i class="fa-solid fa-indian-rupee-sign"></i>
                        <span>{{ $fare * $gst/100 }}/-</span>
                    </p>
                </div>
                <div class="total between">
                    <h5>Total</h5>
                    <h5>
                        <i class="fa-solid fa-indian-rupee-sign"></i>
                        <span>{{ $total }}/-</span>
                    </h5>
                </div>
            </div>

            @php
    session(['fareSummary' => [
        'id' => $id,
        'type' => $type,
        'goingFromCity' => $request->goingFromCity,
        'goingToCity' => $request->goingToCity,
        'passengers' => $request->passengers,
        'cDate' => $request->cDate,
        'cTime' => $time24hr,
        'rDate' => $request->rDate,
        'rTime' => $time24hr,
        'vehicleModel' => $cabroutes['cab']['vehicle_model'],
        'name' => $request->name,
        'email' => $request->email,
        'mobileNo' => $request->mobile_no,
        'price' => $cabroutes['price'],
        'fare' => $fare,
        'gst' => $fare * $gst/100,
        'total' => $total,
    ]]);
@endphp

            <button type="submit" class="select-btn" id="razorPay">Checkout</button>
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
</main>
@endsection
@push('js')
@includeIf('user.components.razorPay', ['order' => $order, 'redirect' => url('cab/ticket')])
@endpush