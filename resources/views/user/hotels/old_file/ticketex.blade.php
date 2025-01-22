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
    {{-- @php  dd( session('response')) ; @endphp --}}

        <x-ticket id="dep_ticket" :fare="['fare' => $response['prebook']['HotelResult'][0]['Rooms'][0]['TotalFare'], 'gst' => ($response['prebook']['HotelResult'][0]['Rooms'][0]['TotalFare'] * 18/100)  , 'charges' => 0, 'total' => ($response['prebook']['HotelResult'][0]['Rooms'][0]['TotalFare'] + ($response['prebook']['HotelResult'][0]['Rooms'][0]['TotalFare'] * 18 / 100) )]">
            
            <x-slot name="booking_details">
                <p>
                    <span> Booking Id:</span>
                    <span> {{date('M-Y'). '-GB01-' .  $ticket['BookingId']}} </span> </br>
                    <span style="font-weight: 700; font-size: 1.4rem;">  Booking Ref. No:  </span>
                    <span>  {{ $ticket['BookingRefNo']}}   </span> </br>
                    <span style="font-weight: 700; font-size: 1.4rem;">  InvoiceNumber :</span>
                    <span> {{ $ticket['InvoiceNumber']}} </span>
                </p>
            </x-slot>
            <x-slot name="ticket_details">
                <table>
                    <thead>
                        <tr>
                            <th>  Name</th>
                            <th>Mobile Number</th>
                            <th> Email </th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        <tr>

                        @if (!empty($response['HotelRoomsDetails'][0]['HotelPassenger'][0]))
                
                            <td class="cab_title"> {{ $response['HotelRoomsDetails'][0]['HotelPassenger'][0]['Title'] }} {{ $response['HotelRoomsDetails'][0]['HotelPassenger'][0]['FirstName'] }} {{ $response['HotelRoomsDetails'][0]['HotelPassenger'][0]['LastName'] }}</td><br>
                            <td class="cab_title"> {{ $response['HotelRoomsDetails'][0]['HotelPassenger'][0]['Email'] }}</td><br>
                            <td class="cab_title"> {{ $response['HotelRoomsDetails'][0]['HotelPassenger'][0]['Phoneno'] }}</td><br>        
                                    
                        @endif
                               
                        </tr>
                    </tbody>
                </table>

                <table>
                    <thead>
                        <tr>                
                            <th>  Hotel Name </th>
                            <th> Hotel Address </th>
                        </tr>                        
                    </thead>

                    <tbody>
                    <tr>
                        <td> {{$response['HotelName']}} </td>
                        <td> {{$response['AddressLine1']}} </td>
                        
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