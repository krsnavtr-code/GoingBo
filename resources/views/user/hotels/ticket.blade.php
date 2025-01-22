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

        @media only screen and (max-width:768px){
            *{
                font-size: small;
            }
        }
    </style>
@endpush
@section('main')
    <main class="cflex">
    {{-- @php  dd( session('response')) ; @endphp --}}

        <x-ticket id="dep_ticket" :fare="['fare' => $response['prebook']['HotelResult'][0]['Rooms'][0]['TotalFare'], 'gst' => ($response['prebook']['HotelResult'][0]['Rooms'][0]['TotalFare'] * 18/100)  , 'charges' => 0, 'total' => ($response['prebook']['HotelResult'][0]['Rooms'][0]['TotalFare'] + ($response['prebook']['HotelResult'][0]['Rooms'][0]['TotalFare'] * 18 / 100) )]">
            
            <x-slot name="booking_details">
                <p>
                    <span> Booking Id:</span>
                    <span> {{date('M-Y'). '-GB01-' .  $book['BookingId']}} </span> </br>
                    <span style="font-weight: 700; font-size: 1.4rem;">  Booking Ref. No:  </span>
                    <span>  {{ $book['BookingRefNo']}}   </span> </br>
                    <span style="font-weight: 700; font-size: 1.4rem;">  InvoiceNumber :</span>
                    <span> {{ $book['InvoiceNo']}} </span>
                    <span> Booking Date:</span>
                    <span> {{$book['BookingDate']}} </span>
                </p>
            </x-slot>
            <x-slot name="ticket_details">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Mobile Number</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 1; @endphp
                        @foreach ($book['Rooms'] as $room)
                            @foreach ($room['HotelPassenger'] as $passenger)
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>{{ $passenger['Title'] . ' ' . $passenger['FirstName'] . ' ' . $passenger['LastName'] }}</td>
                                    <td>{{ isset($passenger['Phoneno']) ? $passenger['Phoneno'] : 'N/A' }}</td>
                                    <td>{{ isset($passenger['Email']) ? $passenger['Email'] : 'N/A' }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>

                <table>
                    <thead>
                        <tr>                
                            <th>  Hotel Name </th>
                            <th> Hotel Address </th>
                            <th> Check In-Out</th>
                        </tr>                        
                    </thead>

                    <tbody>
                    <tr>
                        <td> {{$book['HotelName']}} </td>
                        <td> {{$book['AddressLine1']}} </td>
                        <td> {{$book['CheckInDate']}} -- {{$book['CheckOutDate']}} </td>                        
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