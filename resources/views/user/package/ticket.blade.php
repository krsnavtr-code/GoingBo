
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
    </style>
@endpush
@section('main')
    <main class="cflex">
        @php @endphp
        <x-ticket id="dep_ticket" :fare="['fare' => $fare, 'gst' => $gst, 'charges' => $charges, 'total' => $total]">
            <x-slot name="booking_details">
                <p>
                    <span>Booking Id:</span>
                    <span> {{date('M-Y'). '-GB01-' .  $pkg_token}}  </span>
                </p>
            </x-slot>
            <x-slot name="ticket_details">
                <table>
                    <thead>
                        <tr>
                            <th>Passenger Name</th>
                            <th>Token</th>
                            <th>Package</th>
                            <th>Checkin</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td style="text-transform: uppercase"> {{ $pkg_pass['fname'] }} {{ $pkg_pass['lname'] }} </td>
                                <td>  {{$pkg_token}}</td>
                                <td>{{$pkg['title']}} </td>
                                <td>{{ $pkg_pass['checkin'] }} </td>                                
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
