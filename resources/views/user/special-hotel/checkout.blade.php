@php
$room = [];
$rooms = json_decode($hotel['hotel_room'], true);
for ($i = 0; $i < count($rooms); $i++) {
    if ($rooms[$i]['room']==$person['room_type']) {
    $room=$rooms[$i];
    break;
    }
    }
    @endphp
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

    button {
    padding: 9px;
    font-weight: 600;
    font-size: 1.5rem;
    background: var(--fv_prime);
    border-radius: 6px;
    border: none;
    }

    .query_panel button {
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
    @media only screen and (max-width:600px){
    .sidebar {
    width: 100%;
    }
    }
    </style>
    @endpush
    @section('main')
    @include('user.components.book_opts')
    <main>
        <div class="results rflex">
            <form action="{{ url('special-hotel/checkout') }}" method="post" class="main_section cflex">
                @csrf
                <div class="panel">
                    <h5>Hotel Details</h5>
                    <h6 class="hotel_name" style="color: var(--fv_prime);">{{ $hotel['hotel_name'] }}</h6>
                    <p>{{ $hotel['hotel_address'] }}</p>
                </div>
            </form>
            <div class="sidebar cflex">
                <div class="panel">
                    <h5>Fair Summary</h5>
                    <div class="rflex jcsb" style="font-size: 0.9em;margin-top:10px;">
                        <p>{{ $person['room_type'] }}({{ $person['rooms'] }}x{{ $room['roomofferprice'] }})</p>
                        <p>{{ $total = $person['rooms'] * $room['roomofferprice'] }}</p>
                    </div>
                    @isset($food)
                    <div class="rflex jcsb" style="font-size: 0.9em;margin-top:10px;">
                        <p>Food Charges</p>
                        <p>{{ $food }}</p>
                    </div>
                    @endisset
                    <div class="rflex jcsb" style="font-size: 0.9em;margin-top:10px;">
                        <p>Gst (5%)</p>
                        <p>{{ $gst = floor((($total + ($food ?? 0)) * 5) / 100) }}</p>
                    </div>
                    <div class="rflex jcsb" style="margin-top: 7px;padding-top:3px;border-top:1px dashed var(--gray_500)">
                        <h6>Total</h6>
                        <h6>{{ $total + $gst + ($food ?? 0) }}</h6>
                    </div>
                </div>
                <button type="submit" id="razorPay">Checkout</button>
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
    @includeIf('user.components.razorPay', ['order' => $order, 'redirect' => url('special-hotel/ticket')])
    @endpush