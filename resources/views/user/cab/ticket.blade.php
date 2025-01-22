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
        
        <x-ticket id="dep_ticket" :fare="['fare' => $fare, 'gst' => $gst, 'charges' => $charges, 'total' => $total]">
            <x-slot name="booking_details">
                <p>
                    <span>Booking Id:</span>
                    <span> {{date('M-Y'). '-GB01-' .  $bookingid}} </span>
                </p>
            </x-slot>
            <x-slot name="ticket_details">
                <table>
                    <thead>
                        <tr>
                            <th>Passenger Name</th>
                            <th>Mobile Number</th>
                            <th> Email </th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>{{ $name}} </td>
                                <td>{{ $mobileNo }}</td>
                                <td>{{ $email }}</td>
                            </tr>
                    </tbody>
                </table>
            </x-slot>
        </x-ticket>
        <button type="submit" onclick="print_ticket('dep_ticket')">Print Ticket</button>
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
