@extends('user.components.layout')
@push('css')
    <style>
        .package_details {
            margin-block: 30px 10px;
        }

        .package_name {
            margin-bottom: 10px;
        }

        .package_details::before {
            content: '';
            width: 5px;
            background: var(--fv_prime);
            border-radius: 10px;
            margin-right: 5px;
        }

        .package_details .details {
            padding: 5px;
        }

        .activity_section .wrapper {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .activity_section .detail i {
            margin-right: 10px;
            color: var(--fv_prime);
        }

        .wrapper .panel {
            padding: 20px;
            position: relative;
            border-radius: 7px;
            filter: drop-shadow(0px 0px 10px #00000022);
            z-index: 1;
            background: white;
        }

        .gallery img {
            border-radius: 7px;
            height: 210px;
            width: 100%;
        }

        p.img_caption {
            margin-top: 10px;
            font-weight: 600;
        }

        .day_activities {
            padding-block: 15px;
        }

        .day_activities:not(:last-of-type) {
            border-bottom: 1px solid var(--gray_400);
        }

        .activity_day {
            padding: 0 20px;
            font-weight: 700;
            color: var(--fv_sec);
            display: flex;
            flex-direction: column;
            margin-right: 20px;
        }

        .activity_day .day_count {
            font-size: 5rem;
        }

        .activity_day .day_count i {
            color: var(--gray_600);
            font-size: 1.2rem;
        }

        .activity_day .day_text {
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 10px;
            text-align: center;
            color: var(--gray_900);
        }

        .activities {
            gap: 10px;
        }

        .activity_title {
            text-transform: capitalize;
            margin-bottom: 3px;
        }

        .activity_desc {
            font-size: 1.4rem;
        }

        .wrapper .policy_panel,
        .wrapper .term_panel,
        .wrapper .reviews_panel,
        .wrapper .activities_panel {
            background: white;
            box-shadow: none;
            margin-top: 5rem;
            filter: drop-shadow(0 0 15px #00000022);
        }

        .panel_title {
            position: absolute;
            top: 0;
            transform: translateY(-77%);
            font-weight: bolder;
            font-size: 5rem;
            color: white;
        }

        .review {
            padding-block: 10px;
        }

        .review:not(:last-of-type) {
            border-bottom: 1px solid var(--gray_200);
        }

        .review_user_img {
            --dim: 60px;
            width: var(--dim);
            flex-shrink: 0;
        }

        .review_user_img img {
            border-radius: 100px;
        }

        .side_panels {
            height: min-content;
            position: sticky;
            top: 85px;
        }

        .review_user_img {
            margin: 0 20px;
        }

        .review_desc {
            font-size: 1.2rem;
            color: var(--gray_600);
        }

        .stars {
            font-size: 0.9rem;
            margin-top: 8px;
            color: var(--warning_dark);
        }

        .booking_panel .old_price {
            font-size: 1.2rem;
            text-decoration: line-through;
            color: var(--gray_600);
        }

        .booking_panel .new_price {
            font-size: 2.4rem;
        }

        .booking_panel .price_text {
            font-size: 1.2rem;
            text-transform: capitalize;
            color: var(--gray_600);
            display: inline-block;
            margin-left: 5px;
        }

        .booking_panel p {
            font-size: 1.2rem;
            color: var(--gray_500);
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

        .wrapper .term_panel ul {
            margin-left: 20px;
            list-style-type: circle;
        }

        .wrapper .term_panel ul li {
            font-size: 1.3rem;
        }

        .wrapper .term_panel ul li:not(:first-child) {
            margin-top: 10px;
        }

        table {
            margin-top: 7px;
        }

        td {
            padding: 4px 20px;
        }

        td:first-of-type {
            font-weight: 600;
            text-transform: capitalize;
        }

        .room {
            padding: 20px
        }

        .room:not(:last-of-type) {
            border-bottom: 2px dashed var(--fv_prime);
        }

        ul {
            columns: 2;
            margin-top: 7px;
        }

        li {
            margin-left: 40px;
            padding: 4px 0 4px 10px;
            font-size: 1.4rem;
        }
        a.btn{
            font-weight:600;
            color: black;
            background: var(--fv_prime);
            padding: 6px 20px;
            text-align: center;
            border-radius: 5px;
            display: inline-block;
        }
    </style>
@endpush
@section('main')
    @include('user.components.book_opts')
    <main class="container">
        <div class="package_details rflex">
            <div class="details cflex">
                <h4 class="package_name">{{ $hotel['hotel_name'] }}</h4>
                <h6 class="package_duration">{{ $hotel['hotel_address'] }}</h6>
            </div>
        </div>
        <div class="row gallery" style="flex-wrap: nowrap;overflow-x:auto;">
            @foreach (json_decode($hotel['hotel_images'], true) as $image)
                <div class="col-4">
                    <div class="wrapper">
                        <img src="{{ url('/images/special-hotels/' . $image['type']) }}" alt="">
                        <p class="img_caption"></p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row activity_section" style="padding: 20px 0;--gutter:15px;">
            <div class="col-8">
                <div class="wrapper">
                    <div class="panel cflex" style="margin-top:40px;">
                        @php
                            $desc = json_decode($hotel['hotel_description'], true);
                        @endphp
                        <p class="panel_title">Description</p>
                        <h6 style="color:var(--fv_sec)">Hotel was opened in {{ $desc['hotel_opened'] }}
                            @isset($desc['hotel_renovated'])
                                and renovated in {{ $desc['hotel_renovated'] }}
                            @endisset
                        </h6>
                        <p style="font-size: 1.4rem;margin-top:7px;">{{ $desc['hotel_description'] }}</p>
                        <div class="services" style="margin-top:20px;">
                            <h6 style="color:var(--fv_sec)">Services Offered By Hotel</h6>
                            <ul>
                                @foreach (json_decode($hotel['hotel_amenities'], true)['General'] as $service)
                                    <li> {{ $service['type'] }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="panel cflex" style="margin-top:40px;">
                        <p class="panel_title">Rooms</p>
                        @foreach (json_decode($hotel['hotel_room'], true) as $room)
                            <div class="room rflex jcsb">
                                <h5 class="room_type">{{ $room['room_type'] }}({{$room['room_bed'].($room['room_bed']>1?" beds":" bed")}} in roon)</h5>
                                <form action="" class="">
                                    <span><s>₹{{$room['roomactualprice']}}</s><b>₹{{$room['roomofferprice']}}</b></span>
                                    <a href="{{ url('special-hotel/book/'.$hotel['id']) }}?type={{$room['room']}}" class="btn">Book</a>
                                </form>
                                {{-- <div>
                                    <h6>Room Facilities</h6>
                                    <ul style="columns: 2;margint-top:10px">
                                        @foreach (json_decode($room['failities'], true) as $p)
                                            <li>{{ $p['facilities'] }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div>
                                    <h6>Room Policies</h6>
                                    <ul style="columns: 2;margint-top:10px">
                                        @foreach (json_decode($room['policies'], true) as $p)
                                            <li>{{ $p['poilices'] }}</li>
                                        @endforeach
                                    </ul>
                                </div> --}}
                            </div>
                        @endforeach
                    </div>
                    <div class="panel cflex" style="margin-top:40px;">
                        <p class="panel_title">Policies</p>
                        <div class="cflex">
                            <h6>Hotel Policies</h6>
                            <table style="border-collapse: collapse" border="1px solid">
                                <tbody>
                                    @foreach (json_decode($hotel['hotel_policies'], true) as $key => $value)
                                        @if (gettype($value) != 'array')
                                            <tr>
                                                <td>{{ $key }}</td>
                                                <td>{{ $value }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="cflex" style="margin-top:20px">
                            <h6>Cancellation Policies</h6>
                            <table style="border-collapse: collapse; border= 1px solid;">
                                <tbody>
                                    @foreach (json_decode($hotel['hotel_policies'], true)['cancellation'] as $key => $value)
                                        <tr>
                                            <td>{{ $key }}</td>
                                            <td>{{ $value }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 side_panels">
                <div class="wrapper">
                    {{-- <div class="panel booking_panel">
                        <p class="old_price">&#8377;4500</p>
                        <h6><span class="new_price">&#8377;2300</span><span class="price_text">Per Person</span></h6>
                        <p>*Excluding applicable taxes</p>
                        <button>Proceed to book</button>
                    </div> --}}
                    <div class="panel query_panel">
                        <h5>Raise A Query</h5>
                        <p>Having anything in mind, feel free to write us. We are here for you. We will connect you back as soon as possible</p>
                        <button>Raise A Query</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
