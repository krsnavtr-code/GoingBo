@extends('user.components.layout')
@push('css')
    <link rel="stylesheet" href="{{ url('css/special_hotel.css') }}">
    <style>
        a.btn {
            font-weight: 600;
            color: black;
            background: var(--fv_prime);
            padding: 6px 20px;
            text-align: center;
            border-radius: 5px;
        }
    </style>
@endpush
@section('main')
    {{-- @include('user.components.book_opts') --}}
    <h2 style=" text-align:center;"> We found 'The Best Deals' for you </h2>
    <main class="rflex">
        
        <div class="filters cflex"></div>
        <div class="hotels cflex" style="gap:20px">
            @foreach ($spacialhotels as $hotel)
                <div class="hotel cflex">
                    @php
                        $images = json_decode($hotel['hotel_images'], true);
                        $desc = json_decode($hotel['hotel_overview'], true)['overview'];
                        $rooms = json_decode($hotel['hotel_room'], true);
                    @endphp
                    <div class="rflex" style="position: relative;">
                        <div class="hotel_images">
                            <img src="{{ url('images/special-hotels/' . $images[0]['type']) }}" alt=""
                                loading="lazy" class="display">
                            <div class="rflex images">
                                @foreach ($images as $image)
                                    <div class="image">
                                        <img src="{{ url('images/special-hotels/' . $image['type']) }}" alt=""
                                            loading="lazy" onclick="changeDisplay(this)">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="hotel_details">
                            <div class="rating"><b>{{ $hotel['hotel_rating'] }} <i
                                        class="fa-solid fa-star"></i></b><span>Rating</span></div>
                            <a href="{{ url('special-hotel/' . $hotel['id']) }}">
                                <h3 class="hotel_name">{{ $hotel['hotel_name'] }}</h3>
                            </a>
                            <h6 class="hotel_address"><i class="fa-solid fa-location"></i> {{ $hotel['hotel_address'] }}
                            </h6>
                            <p class="hotel_desc" title="{{ $desc }}">{{ $desc }}</p>
                            <p class="payment"><i class="fa-solid fa-wallet"></i>{{ $hotel['payment_type'] }}</p>
                            <div class="facilities rflex wrap">
                                <div class="facility"><i class="fa-solid fa-circle-parking"></i><span>Parking</span></div>
                                <div class="facility"><i class="fa-solid fa-wifi"></i><span>Wifi</span></div>
                                <div class="facility"><i class="fa-solid fa-tv"></i><span>T.V.</span></div>
                            </div>
                            <div class="facilities rflex wrap">
                                <div class="facility"><i class="fa-solid fa-person-swimming"></i><span>Pool</span></div>
                                <div class="facility"><i class="fa-solid fa-user-doctor"></i><span>Doctor</span></div>
                            </div>
                            <div class="hotel_price cflex">
                                <p>Starting from</p>
                                <h6><b>₹</b><span class="price">{{ $rooms[0]['roomofferprice'] }}</span>/-</h6>
                            </div>
                            <button class="rooms" onclick="show_rooms(this)">View Rooms <i
                                    class="fa-solid fa-chevron-down"></i></button>
                        </div>
                    </div>
                    <div class="hotel_rooms">
                        <table>
                            <thead>
                                <tr>
                                    <th>Room Type</th>
                                    <th>Bed in room</th>
                                    <th>Room Price</th>
                                    <th>Offered Price</th>
                                    <th></th>
                                </tr>
                            </thead>
                            @foreach ($rooms as $room)
                                <tr>
                                    <td>{{ $room['room'] }}</td>
                                    <td>{{ $room['Room_Bed'] ?? $room['room_bed'] }}</td>
                                    <td>₹{{ $room['roomactualprice'] }}</td>
                                    <td>₹{{ $room['roomofferprice'] }}</td>
                                    <td><a href="{{ url('special-hotel/book/' . $hotel['id']) }}?type={{ $room['room'] }}"
                                            class="btn">Book</a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endsection

@push('js')
    <script>

        function changeDisplay(node) {
            node.closest('.hotel_images').$(".display")[0].src = node.src;
        }
        $(".hotel_rooms").perform((n) => {
            n.set("data-height", n.offsetHeight + "px");
            n.addCSS("height", "0px");
        });

        function show_rooms(node) {
            let hotel_div = node.closest(".hotel");
            node = hotel_div.$(".hotel_rooms")[0];
            if (node.hasClass('active')) {
                node.removeClass("active");
                node.addCSS("height", "0");
            } else {
                node.addClass("active");
                node.addCSS("height", node.get('data-height'));
            }
        }
    </script>


@endpush
