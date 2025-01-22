@extends('user.components.layout')
@push('css')
<style>
    .my-row {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
    }

    .sidebar {
        max-width: 300px;
    }

    .between {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
    }

    .panel {
        padding: 2rem;
        margin: 1rem 0;
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        text-align: center;
        border-radius: 10px;
        text-transform: capitalize;
        color: gray;
        font-size: small;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        justify-content: space-between;
    }

    h5,
    h4 {
        margin-bottom: 1rem;
    }

    h4 {
        background: var(--fv_sec);
        color: #fff;
    }

    h5 {
        color: var(--fv_sec);
        font-size: larger;
    }

    button {
        padding: 5px 2rem;
        background-color: var(--fv_sec);
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: medium;
        margin: 1rem 0;
    }

    .query_panel {
        background: var(--fv_prime);
        color: #fff;
    }

    .total {
        padding: 1rem 0;
        border-top: 2px dashed var(--fv_sec);
        border-bottom: 2px dashed var(--fv_sec);
        color: var(--fv_sec);
        font-weight: bold;
    }

    @media only screen and (max-width:768px) {
        .my-row {
            flex-direction: column;
            padding: 1rem;
        }
        .sidebar{
            width: 100%;
            max-width: 100%;
        }
    }
</style>
@endpush
@section('main')
<main>
    <div class="container">
        <div class="my-row">
            <div class="panel">
                <h4>Pay {{$total}} to confirm booking </h4>
                <h5>{{$response['HotelName']}}</h5>
                <div class="between">
                    <h6>
                        <i class="fa-solid fa-user"></i>
                        people:
                    </h6>
                    <p>{{ session('hotel_search_inputs.adult') + session('hotel_search_inputs.child') }}</p>
                </div>
                <div class="between">
                    <h6>
                        <i class="fa-solid fa-calendar-days"></i>
                        check-in:
                    </h6>
                    <p>{{ date('d-m-y', strtotime(session('hotel_search_inputs.dep_date'))) }}</p>
                </div>
                <div class="between">
                    <h6>
                        <i class="fa-solid fa-calendar-days"></i>
                        check-out:
                    </h6>
                    <p>{{ date('d-m-y', strtotime(session('hotel_search_inputs.ret_date'))) }}</p>
                </div>
                @if (!empty($response['HotelRoomsDetails'][0]['HotelPassenger'][0]))
                <div class="between">
                    <h6>
                        <i class="fa-solid fa-user"></i>
                        name:
                    </h6>
                    <p>{{ $response['HotelRoomsDetails'][0]['HotelPassenger'][0]['Title'] }} {{ $response['HotelRoomsDetails'][0]['HotelPassenger'][0]['FirstName'] }} {{ $response['HotelRoomsDetails'][0]['HotelPassenger'][0]['LastName'] }}</p>
                </div>
                <div class="between">
                    <h6>
                        <i class="fa-solid fa-envelope"></i>
                        email:
                    </h6>
                    <p>{{ $response['HotelRoomsDetails'][0]['HotelPassenger'][0]['Email'] }}</p>
                </div>
                <div class="between">
                    <h6>
                        <i class="fa-solid fa-phone"></i>
                        phone no:
                    </h6>
                    <p>{{ $response['HotelRoomsDetails'][0]['HotelPassenger'][0]['Phoneno'] }}</p>
                </div>
                @endif
            </div>
            <div class="sidebar">
                <article class="panel">
                    <h5>Fare Summary</h5>
                    <div class="between">
                        <h6>{{$response['HotelName']}}</h6>
                        <p>
                            <i class="fa-solid fa-indian-rupee-sign"></i>
                            {{$fare}} /-
                        </p>
                    </div>
                    <div class="between">
                        <h6>Gst ({{$gst}}%)</h6>
                        <p>
                            +
                            <i class="fa-solid fa-indian-rupee-sign"></i>
                            {{ $fare * $gst/100 }} /-
                        </p>
                    </div>
                    <div class="between total">
                        <h6>Total</h6>
                        <h6>
                            <i class="fa-solid fa-indian-rupee-sign"></i>
                            {{ $total }} /-
                        </h6>
                    </div>
                    <button type="submit" id="razorPay">Checkout</button>
                </article>
                <article class="panel query_panel">
                    <h5>Raise A Query</h5>
                    <p>Having anything in mind, feel free to write us. We are here for you. We will connect you back as soon
                        as possible</p>
                    <button>Raise A Query</button>
                </article>
            </div>
        </div>
    </div>
</main>
@endsection
@push('js')
@includeIf('user.components.razorPay', ['order' => $order, 'redirect' => url('hotel/ticket')])
@endpush