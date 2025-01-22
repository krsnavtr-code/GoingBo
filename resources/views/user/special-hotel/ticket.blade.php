@extends('user.components.layout')
@push('css')
<style>
    button {
        margin-inline: auto;
        padding: 10px 30px;
        font-weight: 600;
        border-radius: 5px;
        border: none;
        background: var(--info);
        color: white;
        font-size: 1.6rem;
    }

    @media only screen and (max-width:600px) {
        * {
            font-size: small !important;
        }

    }
</style>
@endpush
@section('main')
<main class="cflex">
    @php @endphp
    <x-ticket id="dep_ticket" :fare="['fare' => $fare, 'gst' => $gst, 'charges' => $charges, 'total' => $total]">
        <x-slot name="booking_details">
            <p>
                <span>Booking Id:</span>
                <span> {{date('M-Y'). '-GB01-' . $token}} </span>
            </p>
        </x-slot>
        <x-slot name="ticket_details">
            <table>
                <thead>
                    <tr>
                        <th>Passenger Name</th>
                        <th>No. of guests</th>
                        <th>Token</th>
                    </tr>

                </thead>
                <tbody>
                    <tr>
                        <td style="text-transform: uppercase">{{ $person['fname'] }} {{ $person['lname'] }}</td>
                        <td>{{ $person['guests'] }}</td>
                        <td>{{$token}}</td>
                    </tr>
                </tbody>
            </table>
            <table>
                <thead>
                    <tr>
                        <th>Hotel</th>
                        <th>Checkin</th>
                        <th>Days to stay</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $hotel['hotel_name'] }} <span style="font-size: 0.8em">({{ $room['room_type'] }})</span>
                        </td>
                        <td>{{ $person['checkin'] }}</td>
                        <td>{{ $person['days'] }}</td>
                    </tr>
                </tbody>
            </table>
          
        </x-slot>
    </x-ticket>
    <button type="submit" onclick="print_ticket('dep_ticket')"> Print Membership Card </button>
</main>
@endsection
@push('js')
<script>
    function print_ticket(nodeName) {
        $(`#${nodeName}`).addClass("printable");
        window.print();
        $(`#${nodeName}`).removeClass("printable");
    }
</script>
@endpush