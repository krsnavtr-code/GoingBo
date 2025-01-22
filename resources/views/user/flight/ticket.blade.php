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
        @if ($ticket)
            <x-ticket id="dep_ticket" :fare="['fare' => $fare, 'gst' => $gst, 'charges' => $charges, 'total' => $total]">
                <x-slot name="booking_details">
                    <p>
                        <span>PNR :</span>
                        <span>{{ $ticket['dep_ticket']['PNR'] }}</span>
                    </p>
                    <p>
                        <span>Booking Id :</span>
                        <span> {{ date('M-Y'). '-GB01-' .  $ticket['dep_ticket']['BookingId'] }}</span>
                    </p>
                    <p>
                        <span>Issued Date :</span>
                        <span>{{ $ticket['dep_ticket']['FlightItinerary']['InvoiceCreatedOn'] }}</span>
                    </p>
                    <p>
                        <span>Airline TollFree No :</span>
                        <span>{{ $ticket['dep_ticket']['FlightItinerary']['AirlineTollFreeNo'] ?? '--- ---' }}</span>
                    </p>
                    @isset($ticket['dep_ticket']['FlightItinerary']['Invoice'][0])
                        <p style="margin-top: 20px;">
                            <span>Invoice No.</span>
                            <span>{{ $ticket['dep_ticket']['FlightItinerary']['Invoice'][0]['InvoiceNo'] }}</span>
                        </p>
                        <p>
                            <span>Invoice Id</span>
                            <span>{{ $ticket['dep_ticket']['FlightItinerary']['Invoice'][0]['InvoiceId'] }}</span>
                        </p>
                    @endisset
                </x-slot>
                <x-slot name="ticket_details">
                    <table>
                        <thead>
                            <tr>
                                <th>Passenger Name</th>
                                <th>Ticket Number</th>
                                <th>Frequent Flyer no</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ticket['dep_ticket']['FlightItinerary']['Passenger'] as $pax)
                                <tr>
                                    <td>{{ $pax['Title'] }} {{ $pax['FirstName'] }} {{ $pax['LastName'] }}</td>
                                    <td>{{ $pax['Ticket']['TicketId'] }}</td>
                                    <td>{{ $pax['PaxId'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <table>
                        <thead>
                            <tr>
                                <th>Departure</th>
                                <th>Departure</th>
                                <th>Arrival</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @php
                                    $airline = $ticket['dep_ticket']['FlightItinerary']['Segments'][0]['Airline'];
                                    $origin = $ticket['dep_ticket']['FlightItinerary']['Segments'][0]['Origin'];
                                    $desti = $ticket['dep_ticket']['FlightItinerary']['Segments'][count($ticket['dep_ticket']['FlightItinerary']['Segments']) - 1]['Destination'];
                                @endphp
                                <td>
                                    <p>{{ $airline['AirlineName'] }}
                                        {{ $airline['AirlineCode'] }}-{{ $airline['FlightNumber'] }}</p>
                                    <p>{{ $ticket['dep_ticket']['FlightItinerary']['Segments'][0]['Craft'] }}</p>
                                </td>
                                <td>
                                    <p><b>{{ $origin['Airport']['AirportCode'] }}</b><br>({{ $origin['Airport']['AirportName'] }})
                                    </p>
                                </td>
                                <td>
                                    <p><b>{{ $desti['Airport']['AirportCode'] }}</b><br>({{ $desti['Airport']['AirportName'] }})
                                    </p>
                                </td>
                                <td>
                                    <p>Confirmed</p>
                                    <p>
                                        @if (count($ticket['dep_ticket']['FlightItinerary']['Segments']) > 1)
                                            {{ count($ticket['dep_ticket']['FlightItinerary']['Segments']) }} Stops
                                        @else
                                            Non Stop
                                        @endif
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </x-slot>
            </x-ticket>
            <button type="submit" onclick="print_ticket('dep_ticket')">Print Ticket</button> <br>
            
            <button style="background-color: var(--fv_prime); "> <a href="{{ url('/flight/booking') }}?bookingId={{ $ticket['dep_ticket']['BookingId']  }}" >View Booking</a> </button>

            @isset($ticket['ret_ticket'])
                <x-ticket id="ret_ticket" :fare="['fare' => $fare, 'gst' => $gst, 'charges' => $charges, 'total' => $total]">
                    <x-slot name="booking_details">
                        <p>
                            <span>PNR :</span>
                            <span>{{ $ticket['ret_ticket']['PNR'] }}</span>
                        </p>
                        <p>
                            <span>Booking Id :</span>
                            <span> {{date('M-Y'). '-GB01-' .  $ticket['ret_ticket']['BookingId']}}</span>
                        </p>
                        <p>
                            <span>Issued Date :</span>
                            <span>{{ $ticket['ret_ticket']['FlightItinerary']['LastTicketDate'] }}</span>
                        </p>
                        <p>
                            <span>Airline TollFree No :</span>
                            <span>{{ $ticket['ret_ticket']['FlightItinerary']['AirlineTollFreeNo'] ?? '--- ---' }}</span>
                        </p>
                        @isset($ticket['ret_ticket']['FlightItinerary']['Invoice'][0])
                            <p style="margin-top: 20px;">
                                <span>Invoice No.</span>
                                <span>{{ $ticket['ret_ticket']['FlightItinerary']['Invoice'][0]['InvoiceNo'] }}</span>
                            </p>
                            <p>
                                <span>Invoice Id</span>
                                <span>{{ $ticket['ret_ticket']['FlightItinerary']['Invoice'][0]['InvoiceId'] }}</span>
                            </p>
                        @endisset
                    </x-slot>
                    <x-slot name="ticket_details">
                        <table>
                            <thead>
                                <tr>
                                    <th>Passenger Name</th>
                                    <th>Ticket Number</th>
                                    <th>Frequent flyer no</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ticket['ret_ticket']['FlightItinerary']['Passenger'] as $pax)
                                    <tr>
                                        <td>{{ $pax['Title'] }} {{ $pax['FirstName'] }} {{ $pax['LastName'] }}</td>
                                        <td>{{ $pax['Ticket']['TicketId'] }}</td>
                                        <td>{{ $pax['PaxId'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <table>
                            <thead>
                                <tr>
                                    <th>Departure</th>
                                    <th>Departure</th>
                                    <th>Arrival</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @php
                                        $airline = $ticket['ret_ticket']['FlightItinerary']['Segments'][0]['Airline'];
                                        $origin = $ticket['ret_ticket']['FlightItinerary']['Segments'][0]['Origin'];
                                        $desti = $ticket['ret_ticket']['FlightItinerary']['Segments'][count($ticket['ret_ticket']['FlightItinerary']['Segments']) - 1]['Destination'];
                                    @endphp
                                    <td>
                                        <p>{{ $airline['AirlineCode'] }} {{ $airline['FlightNumber'] }}
                                            {{ $airline['AirlineName'] }}</p>
                                        <p>{{ $ticket['ret_ticket']['FlightItinerary']['Segments'][0]['Craft'] }}</p>
                                    </td>
                                    <td>
                                        <p><b>{{ $origin['Airport']['AirportCode'] }}</b>({{ $origin['Airport']['AirportName'] }})
                                        </p>
                                    </td>
                                    <td>
                                        <p><b>{{ $desti['Airport']['AirportCode'] }}</b>
                                            ({{ $desti['Airport']['AirportName'] }})</p>
                                    </td>
                                    <td>
                                        <p>Confirmed</p>
                                        <p>
                                            @if (count($ticket['ret_ticket']['FlightItinerary']['Segments']) > 1)
                                                {{ count($ticket['ret_ticket']['FlightItinerary']['Segments']) }} Stops
                                            @else
                                                Non Stop
                                            @endif
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </x-slot>
                </x-ticket>
                <button type="submit" onclick="print_ticket('ret_ticket')">Print Ticket</button> <br>
               
                <button style="background-color: var(--fv_prime); "> <a href="{{ url('/flight/booking') }}?bookingId={{ $ticket['ret_ticket']['BookingId']  }}" >View Booking</a> </button>
                
                
                

            @endisset
            


        @else
        <div class="img_wrap">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 381.98">
                <defs>
                    <style>
                        .cls-1 {
                            fill: #ebebeb;
                        }

                        .cls-2 {
                            fill: #f5f5f5;
                        }

                        .cls-3 {
                            fill: #e6e6e6;
                        }

                        .cls-4 {
                            fill: #fafafa;
                        }

                        .cls-5 {
                            fill: #f0f0f0;
                        }

                        .cls-6 {
                            fill: #e0e0e0;
                        }

                        .cls-11,
                        .cls-7,
                        .cls-9 {
                            opacity: 0.4;
                        }

                        .cls-13,
                        .cls-8 {
                            fill: #407bff;
                        }

                        .cls-10,
                        .cls-12,
                        .cls-14,
                        .cls-16,
                        .cls-9 {
                            fill: #fff;
                        }

                        .cls-10,
                        .cls-13 {
                            opacity: 0.7;
                        }

                        .cls-11,
                        .cls-15 {
                            fill: #263238;
                        }

                        .cls-12,
                        .cls-18,
                        .cls-19 {
                            opacity: 0.2;
                        }

                        .cls-16 {
                            opacity: 0.5;
                        }

                        .cls-17 {
                            fill: #7f3e3b;
                        }

                        .cls-20 {
                            opacity: 0.3;
                        }

                        .cls-21 {
                            fill: #630f0f;
                        }
                    </style>
                </defs>
                <g id="Layer_2" data-name="Layer 2">
                    <g id="Gateway_Timeout" data-name="Gateway Timeout">
                        <rect class="cls-1" y="336.81" width="500" height="0.25" />
                        <path class="cls-1"
                            d="M237,292.21H43.91a5.71,5.71,0,0,1-5.7-5.7V15.07a5.71,5.71,0,0,1,5.7-5.7H237a5.71,5.71,0,0,1,5.71,5.7V286.51A5.71,5.71,0,0,1,237,292.21ZM43.91,9.62a5.46,5.46,0,0,0-5.45,5.45V286.51A5.46,5.46,0,0,0,43.91,292H237a5.46,5.46,0,0,0,5.46-5.45V15.07A5.46,5.46,0,0,0,237,9.62Z" />
                        <path class="cls-1"
                            d="M453.31,292.21H260.21a5.72,5.72,0,0,1-5.71-5.7V15.07a5.72,5.72,0,0,1,5.71-5.7h193.1a5.71,5.71,0,0,1,5.71,5.7V286.51A5.71,5.71,0,0,1,453.31,292.21ZM260.21,9.62a5.46,5.46,0,0,0-5.46,5.45V286.51a5.46,5.46,0,0,0,5.46,5.45h193.1a5.46,5.46,0,0,0,5.46-5.45V15.07a5.46,5.46,0,0,0-5.46-5.45Z" />
                        <rect class="cls-1" x="423.9" y="352.91" width="26" height="0.25" />
                        <rect class="cls-1" x="311" y="355.62" width="45.03" height="0.25" />
                        <rect class="cls-1" x="362.11" y="343.62" width="60.79" height="0.25" />
                        <rect class="cls-1" x="52.46" y="345.3" width="19.23" height="0.25" />
                        <rect class="cls-1" x="80.6" y="345.3" width="55.29" height="0.25" />
                        <rect class="cls-1" x="169.67" y="349.52" width="74.47" height="0.25" />
                        <rect class="cls-2" x="80.6" y="107.36" width="101.71" height="229.45" />
                        <rect class="cls-3" x="90.14" y="115.42" width="82.61" height="213.34" />
                        <rect class="cls-4" x="95.83" y="125.42" width="71.25" height="4.88" />
                        <rect class="cls-4" x="95.83" y="136.5" width="71.25" height="4.88" />
                        <rect class="cls-4" x="95.83" y="147.59" width="71.25" height="4.88" />
                        <rect class="cls-4" x="95.83" y="158.67" width="71.25" height="4.88" />
                        <rect class="cls-4" x="95.83" y="169.76" width="71.25" height="4.88" />
                        <rect class="cls-4" x="95.83" y="180.85" width="71.25" height="4.88" />
                        <rect class="cls-4" x="95.83" y="191.93" width="71.25" height="4.88" />
                        <rect class="cls-4" x="95.83" y="203.02" width="71.25" height="4.88" />
                        <rect class="cls-4" x="95.83" y="214.1" width="71.25" height="4.88" />
                        <rect class="cls-4" x="95.83" y="225.19" width="71.25" height="4.88" />
                        <rect class="cls-4" x="95.83" y="236.28" width="71.25" height="4.88" />
                        <rect class="cls-4" x="95.83" y="247.36" width="71.25" height="4.88" />
                        <rect class="cls-4" x="95.83" y="258.45" width="71.25" height="4.88" />
                        <rect class="cls-4" x="95.83" y="269.53" width="71.25" height="4.88" />
                        <rect class="cls-4" x="95.83" y="280.62" width="71.25" height="4.88" />
                        <rect class="cls-4" x="95.83" y="291.71" width="71.25" height="4.88" />
                        <rect class="cls-4" x="95.83" y="302.79" width="71.25" height="4.88" />
                        <rect class="cls-4" x="95.83" y="313.88" width="71.25" height="4.88" />
                        <rect class="cls-3" x="52.46" y="107.36" width="28.14" height="229.45"
                            transform="translate(133.06 444.17) rotate(180)" />
                        <rect class="cls-5" x="88.51" y="103.41" width="79.82" height="3.95" />
                        <rect class="cls-6" x="66.43" y="103.41" width="22.08" height="3.95"
                            transform="translate(154.94 210.77) rotate(180)" />
                        <ellipse class="cls-2" cx="75.55" cy="116.8" rx="3.05"
                            ry="7.44" />
                        <path class="cls-2"
                            d="M53.46,116.8c0,4.11.92,7.45,2.06,7.45s2.06-3.34,2.06-7.45-.92-7.44-2.06-7.44S53.46,112.69,53.46,116.8Z" />
                        <ellipse class="cls-2" cx="75.55" cy="327.37" rx="3.05"
                            ry="7.44" />
                        <path class="cls-2"
                            d="M53.46,327.37c0,4.11.92,7.44,2.06,7.44s2.06-3.33,2.06-7.44-.92-7.45-2.06-7.45S53.46,323.26,53.46,327.37Z" />
                        <rect class="cls-2" x="292.64" y="158.54" width="79.02" height="178.27" />
                        <rect class="cls-3" x="300.05" y="164.8" width="64.19" height="165.76" />
                        <rect class="cls-4" x="304.47" y="172.57" width="55.36" height="3.79" />
                        <rect class="cls-4" x="304.47" y="181.18" width="55.36" height="3.79" />
                        <rect class="cls-4" x="304.47" y="189.79" width="55.36" height="3.79" />
                        <rect class="cls-4" x="304.47" y="198.41" width="55.36" height="3.79" />
                        <rect class="cls-4" x="304.47" y="207.02" width="55.36" height="3.79" />
                        <rect class="cls-4" x="304.47" y="215.63" width="55.36" height="3.79" />
                        <rect class="cls-4" x="304.47" y="224.25" width="55.36" height="3.79" />
                        <rect class="cls-4" x="304.47" y="232.86" width="55.36" height="3.79" />
                        <rect class="cls-4" x="304.47" y="241.47" width="55.36" height="3.79" />
                        <rect class="cls-4" x="304.47" y="250.09" width="55.36" height="3.79" />
                        <rect class="cls-4" x="304.47" y="258.7" width="55.36" height="3.79" />
                        <rect class="cls-4" x="304.47" y="267.31" width="55.36" height="3.79" />
                        <rect class="cls-4" x="304.47" y="275.93" width="55.36" height="3.79" />
                        <rect class="cls-4" x="304.47" y="284.54" width="55.36" height="3.79" />
                        <rect class="cls-4" x="304.47" y="293.15" width="55.36" height="3.79" />
                        <rect class="cls-4" x="304.47" y="301.77" width="55.36" height="3.79" />
                        <rect class="cls-4" x="304.47" y="310.38" width="55.36" height="3.79" />
                        <rect class="cls-4" x="304.47" y="318.99" width="55.36" height="3.79" />
                        <rect class="cls-3" x="270.77" y="158.54" width="21.86" height="178.27"
                            transform="translate(563.41 495.35) rotate(180)" />
                        <rect class="cls-5" x="298.79" y="155.47" width="62.02" height="3.07" />
                        <rect class="cls-6" x="281.63" y="155.47" width="17.16" height="3.07"
                            transform="translate(580.41 314.01) rotate(180)" />
                        <path class="cls-2"
                            d="M286.35,165.88c0,3.19,1.06,5.78,2.36,5.78s2.37-2.59,2.37-5.78-1.06-5.79-2.37-5.79S286.35,162.68,286.35,165.88Z" />
                        <path class="cls-2"
                            d="M271.55,165.88c0,3.19.72,5.78,1.6,5.78s1.61-2.59,1.61-5.78-.72-5.79-1.61-5.79S271.55,162.68,271.55,165.88Z" />
                        <path class="cls-2"
                            d="M286.35,329.47c0,3.2,1.06,5.79,2.36,5.79s2.37-2.59,2.37-5.79-1.06-5.78-2.37-5.78S286.35,326.28,286.35,329.47Z" />
                        <path class="cls-2"
                            d="M271.55,329.47c0,3.2.72,5.79,1.6,5.79s1.61-2.59,1.61-5.79-.72-5.78-1.61-5.78S271.55,326.28,271.55,329.47Z" />
                        <path class="cls-6"
                            d="M288.71,166.38H242.09a11.67,11.67,0,0,1-11.66-11.66V139a10.66,10.66,0,0,0-10.65-10.65H182.3v-1h37.48A11.66,11.66,0,0,1,231.43,139v15.71a10.67,10.67,0,0,0,10.66,10.66h46.62Z" />
                        <path class="cls-6"
                            d="M273.15,330H259a11.67,11.67,0,0,1-11.65-11.66V226.79a10.67,10.67,0,0,0-10.66-10.66H182.3v-1h54.43a11.67,11.67,0,0,1,11.66,11.66v91.53A10.67,10.67,0,0,0,259,329h14.11Z" />
                        <rect class="cls-5" x="378.85" y="53.13" width="52.79" height="5.4" />
                        <rect class="cls-6" x="364.24" y="53.13" width="14.61" height="5.4"
                            transform="translate(743.09 111.65) rotate(180)" />
                        <rect class="cls-5" x="378.85" y="39.9" width="52.79" height="5.4" />
                        <rect class="cls-6" x="364.24" y="39.9" width="14.61" height="5.4"
                            transform="translate(743.09 85.2) rotate(180)" />
                        <rect class="cls-5" x="378.85" y="26.67" width="52.79" height="5.4" />
                        <rect class="cls-6" x="364.24" y="26.67" width="14.61" height="5.4"
                            transform="translate(743.09 58.75) rotate(180)" />
                        <rect class="cls-5" x="378.85" y="13.44" width="52.79" height="5.4" />
                        <rect class="cls-6" x="364.24" y="13.44" width="14.61" height="5.4"
                            transform="translate(743.09 32.29) rotate(180)" />
                        <g class="cls-7">
                            <rect class="cls-5" x="381.83" width="44.55" height="53.13" />
                            <rect class="cls-6" x="369.5" width="12.33" height="53.13"
                                transform="translate(751.33 53.13) rotate(180)" />
                        </g>
                        <rect class="cls-5" x="256.83" y="140.95" width="38.55" height="3.94" />
                        <rect class="cls-6" x="246.17" y="140.95" width="10.66" height="3.94"
                            transform="translate(503 285.85) rotate(180)" />
                        <rect class="cls-5" x="256.83" y="131.29" width="38.55" height="3.94" />
                        <rect class="cls-6" x="246.17" y="131.29" width="10.66" height="3.94"
                            transform="translate(503 266.53) rotate(180)" />
                        <rect class="cls-5" x="256.83" y="121.64" width="38.55" height="3.94" />
                        <rect class="cls-6" x="246.17" y="121.64" width="10.66" height="3.94"
                            transform="translate(503 247.22) rotate(180)" />
                        <rect class="cls-5" x="256.83" y="111.98" width="38.55" height="3.94" />
                        <rect class="cls-6" x="246.17" y="111.98" width="10.66" height="3.94"
                            transform="translate(503 227.9) rotate(180)" />
                        <g class="cls-7">
                            <rect class="cls-5" x="259.01" y="102.16" width="32.53" height="38.79" />
                            <rect class="cls-6" x="250.01" y="102.16" width="9" height="38.79"
                                transform="translate(509.02 243.11) rotate(180)" />
                        </g>
                        <rect class="cls-5" x="423.1" y="265.96" width="49.68" height="5.08" />
                        <rect class="cls-6" x="409.35" y="265.96" width="13.74" height="5.08"
                            transform="translate(832.45 537.01) rotate(180)" />
                        <rect class="cls-5" x="423.1" y="253.51" width="49.68" height="5.08" />
                        <rect class="cls-6" x="409.35" y="253.51" width="13.74" height="5.08"
                            transform="translate(832.45 512.11) rotate(180)" />
                        <rect class="cls-5" x="423.1" y="241.07" width="49.68" height="5.08" />
                        <rect class="cls-6" x="409.35" y="241.07" width="13.74" height="5.08"
                            transform="translate(832.45 487.22) rotate(180)" />
                        <rect class="cls-5" x="423.1" y="228.62" width="49.68" height="5.08" />
                        <rect class="cls-6" x="409.35" y="228.62" width="13.74" height="5.08"
                            transform="translate(832.45 462.32) rotate(180)" />
                        <g class="cls-7">
                            <rect class="cls-5" x="425.9" y="215.97" width="41.93" height="50" />
                            <rect class="cls-6" x="414.3" y="215.97" width="11.6" height="50"
                                transform="translate(840.21 481.93) rotate(180)" />
                        </g>
                        <ellipse id="_Path_" data-name="&lt;Path&gt;" class="cls-2" cx="250"
                            cy="370.65" rx="193.89" ry="11.32" />
                        <rect class="cls-8" x="318.48" y="69.69" width="108.89" height="104.44" />
                        <rect class="cls-9" x="318.48" y="69.69" width="108.89" height="104.44" />
                        <rect class="cls-10" x="353.14" y="69.69" width="74.22" height="104.44" />
                        <rect class="cls-8" x="356.85" y="75.02" width="66.8" height="12.93" />
                        <rect class="cls-8" x="356.85" y="91.19" width="66.8" height="12.93" />
                        <rect class="cls-8" x="356.85" y="107.36" width="66.8" height="12.93" />
                        <rect class="cls-8" x="356.85" y="123.53" width="66.8" height="12.93" />
                        <rect class="cls-8" x="356.85" y="139.7" width="66.8" height="12.93" />
                        <rect class="cls-8" x="356.85" y="155.87" width="66.8" height="12.93" />
                        <rect class="cls-8" x="322.37" y="75.02" width="26.89" height="12.93" />
                        <rect class="cls-8" x="322.37" y="91.19" width="26.89" height="12.93" />
                        <rect class="cls-8" x="322.37" y="107.36" width="26.89" height="12.93" />
                        <rect class="cls-8" x="322.37" y="123.53" width="26.89" height="12.93" />
                        <rect class="cls-8" x="322.37" y="139.7" width="26.89" height="12.93" />
                        <rect class="cls-8" x="322.37" y="155.87" width="26.89" height="12.93" />
                        <rect class="cls-11" x="324.85" y="77.61" width="12.62" height="7.76" />
                        <rect class="cls-11" x="324.85" y="93.78" width="12.62" height="7.76" />
                        <rect class="cls-11" x="324.85" y="109.95" width="12.62" height="7.76" />
                        <rect class="cls-11" x="324.85" y="126.12" width="12.62" height="7.76" />
                        <rect class="cls-11" x="324.85" y="142.28" width="12.62" height="7.76" />
                        <rect class="cls-11" x="324.85" y="158.45" width="12.62" height="7.76" />
                        <rect class="cls-10" x="418.82" y="76.71" width="1.56" height="9.56" />
                        <rect class="cls-10" x="415.82" y="76.71" width="1.56" height="9.56" />
                        <rect class="cls-10" x="412.82" y="76.71" width="1.56" height="9.56" />
                        <rect class="cls-10" x="409.82" y="76.71" width="1.56" height="9.56" />
                        <rect class="cls-10" x="406.82" y="76.71" width="1.56" height="9.56" />
                        <rect class="cls-10" x="418.82" y="92.88" width="1.56" height="9.56" />
                        <rect class="cls-10" x="415.82" y="92.88" width="1.56" height="9.56" />
                        <rect class="cls-10" x="412.82" y="92.88" width="1.56" height="9.56" />
                        <rect class="cls-10" x="409.82" y="92.88" width="1.56" height="9.56" />
                        <rect class="cls-10" x="406.82" y="92.88" width="1.56" height="9.56" />
                        <rect class="cls-10" x="418.82" y="109.04" width="1.56" height="9.56" />
                        <rect class="cls-10" x="415.82" y="109.04" width="1.56" height="9.56" />
                        <rect class="cls-10" x="412.82" y="109.04" width="1.56" height="9.56" />
                        <rect class="cls-10" x="409.82" y="109.04" width="1.56" height="9.56" />
                        <rect class="cls-10" x="406.82" y="109.04" width="1.56" height="9.56" />
                        <rect class="cls-10" x="418.82" y="125.21" width="1.56" height="9.57" />
                        <rect class="cls-10" x="415.82" y="125.21" width="1.56" height="9.57" />
                        <rect class="cls-10" x="412.82" y="125.21" width="1.56" height="9.57" />
                        <rect class="cls-10" x="409.82" y="125.21" width="1.56" height="9.57" />
                        <rect class="cls-10" x="406.82" y="125.21" width="1.56" height="9.57" />
                        <rect class="cls-10" x="418.82" y="141.38" width="1.56" height="9.57" />
                        <rect class="cls-10" x="415.82" y="141.38" width="1.56" height="9.57" />
                        <rect class="cls-10" x="412.82" y="141.38" width="1.56" height="9.57" />
                        <rect class="cls-10" x="409.82" y="141.38" width="1.56" height="9.57" />
                        <rect class="cls-10" x="406.82" y="141.38" width="1.56" height="9.57" />
                        <rect class="cls-10" x="418.82" y="157.55" width="1.56" height="9.56" />
                        <rect class="cls-10" x="415.82" y="157.55" width="1.56" height="9.56" />
                        <rect class="cls-10" x="412.82" y="157.55" width="1.56" height="9.56" />
                        <rect class="cls-10" x="409.82" y="157.55" width="1.56" height="9.56" />
                        <rect class="cls-10" x="406.82" y="157.55" width="1.56" height="9.56" />
                        <path class="cls-12"
                            d="M381.44,162.33a1.59,1.59,0,1,1,1.59,1.59A1.6,1.6,0,0,1,381.44,162.33Z" />
                        <path class="cls-12"
                            d="M371.44,162.33a1.59,1.59,0,1,1,1.59,1.59A1.6,1.6,0,0,1,371.44,162.33Z" />
                        <path class="cls-9"
                            d="M361.44,162.33a1.59,1.59,0,1,1,1.59,1.59A1.6,1.6,0,0,1,361.44,162.33Z" />
                        <path class="cls-9"
                            d="M381.44,146.16a1.59,1.59,0,1,1,1.59,1.59A1.59,1.59,0,0,1,381.44,146.16Z" />
                        <path class="cls-12"
                            d="M371.44,146.16a1.59,1.59,0,1,1,1.59,1.59A1.59,1.59,0,0,1,371.44,146.16Z" />
                        <path class="cls-9"
                            d="M361.44,146.16a1.59,1.59,0,1,1,1.59,1.59A1.59,1.59,0,0,1,361.44,146.16Z" />
                        <path class="cls-12"
                            d="M381.44,130a1.59,1.59,0,1,1,1.59,1.58A1.59,1.59,0,0,1,381.44,130Z" />
                        <path class="cls-9"
                            d="M371.44,130a1.59,1.59,0,1,1,1.59,1.58A1.59,1.59,0,0,1,371.44,130Z" />
                        <path class="cls-12"
                            d="M361.44,130a1.59,1.59,0,1,1,1.59,1.58A1.59,1.59,0,0,1,361.44,130Z" />
                        <path class="cls-9"
                            d="M381.44,113.83a1.59,1.59,0,1,1,1.59,1.59A1.59,1.59,0,0,1,381.44,113.83Z" />
                        <path class="cls-12"
                            d="M371.44,113.83a1.59,1.59,0,1,1,1.59,1.59A1.59,1.59,0,0,1,371.44,113.83Z" />
                        <path class="cls-12"
                            d="M361.44,113.83a1.59,1.59,0,1,1,1.59,1.59A1.59,1.59,0,0,1,361.44,113.83Z" />
                        <path class="cls-12"
                            d="M381.44,97.66A1.59,1.59,0,1,1,383,99.25,1.59,1.59,0,0,1,381.44,97.66Z" />
                        <path class="cls-9"
                            d="M371.44,97.66A1.59,1.59,0,1,1,373,99.25,1.59,1.59,0,0,1,371.44,97.66Z" />
                        <path class="cls-9"
                            d="M361.44,97.66A1.59,1.59,0,1,1,363,99.25,1.59,1.59,0,0,1,361.44,97.66Z" />
                        <path class="cls-9"
                            d="M381.44,81.49A1.59,1.59,0,1,1,383,83.08,1.59,1.59,0,0,1,381.44,81.49Z" />
                        <path class="cls-12"
                            d="M371.44,81.49A1.59,1.59,0,1,1,373,83.08,1.59,1.59,0,0,1,371.44,81.49Z" />
                        <path class="cls-9"
                            d="M361.44,81.49A1.59,1.59,0,1,1,363,83.08,1.59,1.59,0,0,1,361.44,81.49Z" />
                        <rect class="cls-8" x="117.75" y="266.21" width="108.89" height="104.44" />
                        <rect class="cls-9" x="117.75" y="266.21" width="108.89" height="104.44" />
                        <rect class="cls-10" x="152.41" y="266.21" width="74.22" height="104.44" />
                        <rect class="cls-8" x="156.12" y="271.54" width="66.8" height="12.93" />
                        <rect class="cls-8" x="156.12" y="287.71" width="66.8" height="12.93" />
                        <rect class="cls-8" x="156.12" y="303.88" width="66.8" height="12.93" />
                        <rect class="cls-8" x="156.12" y="320.05" width="66.8" height="12.93" />
                        <rect class="cls-8" x="156.12" y="336.21" width="66.8" height="12.93" />
                        <rect class="cls-8" x="156.12" y="352.38" width="66.8" height="12.93" />
                        <rect class="cls-8" x="121.64" y="271.54" width="26.89" height="12.93" />
                        <rect class="cls-8" x="121.64" y="287.71" width="26.89" height="12.93" />
                        <rect class="cls-8" x="121.64" y="303.88" width="26.89" height="12.93" />
                        <rect class="cls-8" x="121.64" y="320.05" width="26.89" height="12.93" />
                        <rect class="cls-8" x="121.64" y="336.21" width="26.89" height="12.93" />
                        <rect class="cls-8" x="121.64" y="352.38" width="26.89" height="12.93" />
                        <rect class="cls-11" x="124.12" y="274.13" width="12.62" height="7.76" />
                        <rect class="cls-11" x="124.12" y="290.3" width="12.62" height="7.76" />
                        <rect class="cls-11" x="124.12" y="306.46" width="12.62" height="7.76" />
                        <rect class="cls-11" x="124.12" y="322.63" width="12.62" height="7.76" />
                        <rect class="cls-11" x="124.12" y="338.8" width="12.62" height="7.76" />
                        <rect class="cls-11" x="124.12" y="354.97" width="12.62" height="7.76" />
                        <rect class="cls-10" x="218.09" y="273.23" width="1.56" height="9.57" />
                        <rect class="cls-10" x="215.09" y="273.23" width="1.56" height="9.57" />
                        <rect class="cls-10" x="212.09" y="273.23" width="1.56" height="9.57" />
                        <rect class="cls-10" x="209.09" y="273.23" width="1.56" height="9.57" />
                        <rect class="cls-10" x="206.09" y="273.23" width="1.56" height="9.57" />
                        <rect class="cls-10" x="218.09" y="289.39" width="1.56" height="9.56" />
                        <rect class="cls-10" x="215.09" y="289.39" width="1.56" height="9.56" />
                        <rect class="cls-10" x="212.09" y="289.39" width="1.56" height="9.56" />
                        <rect class="cls-10" x="209.09" y="289.39" width="1.56" height="9.56" />
                        <rect class="cls-10" x="206.09" y="289.39" width="1.56" height="9.56" />
                        <rect class="cls-10" x="218.09" y="305.56" width="1.56" height="9.56" />
                        <rect class="cls-10" x="215.09" y="305.56" width="1.56" height="9.56" />
                        <rect class="cls-10" x="212.09" y="305.56" width="1.56" height="9.56" />
                        <rect class="cls-10" x="209.09" y="305.56" width="1.56" height="9.56" />
                        <rect class="cls-10" x="206.09" y="305.56" width="1.56" height="9.56" />
                        <rect class="cls-10" x="218.09" y="321.73" width="1.56" height="9.57" />
                        <rect class="cls-10" x="215.09" y="321.73" width="1.56" height="9.57" />
                        <rect class="cls-10" x="212.09" y="321.73" width="1.56" height="9.57" />
                        <rect class="cls-10" x="209.09" y="321.73" width="1.56" height="9.57" />
                        <rect class="cls-10" x="206.09" y="321.73" width="1.56" height="9.57" />
                        <rect class="cls-10" x="218.09" y="337.9" width="1.56" height="9.56" />
                        <rect class="cls-10" x="215.09" y="337.9" width="1.56" height="9.56" />
                        <rect class="cls-10" x="212.09" y="337.9" width="1.56" height="9.56" />
                        <rect class="cls-10" x="209.09" y="337.9" width="1.56" height="9.56" />
                        <rect class="cls-10" x="206.09" y="337.9" width="1.56" height="9.56" />
                        <rect class="cls-10" x="218.09" y="354.07" width="1.56" height="9.57" />
                        <rect class="cls-10" x="215.09" y="354.07" width="1.56" height="9.57" />
                        <rect class="cls-10" x="212.09" y="354.07" width="1.56" height="9.57" />
                        <rect class="cls-10" x="209.09" y="354.07" width="1.56" height="9.57" />
                        <rect class="cls-10" x="206.09" y="354.07" width="1.56" height="9.57" />
                        <path class="cls-12"
                            d="M163.89,278a1.59,1.59,0,1,1-1.59-1.59A1.59,1.59,0,0,1,163.89,278Z" />
                        <path class="cls-12"
                            d="M173.89,278a1.59,1.59,0,1,1-1.59-1.59A1.59,1.59,0,0,1,173.89,278Z" />
                        <path class="cls-9"
                            d="M183.89,278a1.59,1.59,0,1,1-1.59-1.59A1.59,1.59,0,0,1,183.89,278Z" />
                        <path class="cls-9"
                            d="M163.89,294.18a1.59,1.59,0,1,1-1.59-1.59A1.59,1.59,0,0,1,163.89,294.18Z" />
                        <path class="cls-12"
                            d="M173.89,294.18a1.59,1.59,0,1,1-1.59-1.59A1.59,1.59,0,0,1,173.89,294.18Z" />
                        <path class="cls-9"
                            d="M183.89,294.18a1.59,1.59,0,1,1-1.59-1.59A1.59,1.59,0,0,1,183.89,294.18Z" />
                        <path class="cls-12"
                            d="M163.89,310.35a1.59,1.59,0,1,1-1.59-1.59A1.59,1.59,0,0,1,163.89,310.35Z" />
                        <path class="cls-9"
                            d="M173.89,310.35a1.59,1.59,0,1,1-1.59-1.59A1.59,1.59,0,0,1,173.89,310.35Z" />
                        <path class="cls-12"
                            d="M183.89,310.35a1.59,1.59,0,1,1-1.59-1.59A1.59,1.59,0,0,1,183.89,310.35Z" />
                        <path class="cls-9"
                            d="M163.89,326.51a1.59,1.59,0,1,1-1.59-1.58A1.59,1.59,0,0,1,163.89,326.51Z" />
                        <path class="cls-12"
                            d="M173.89,326.51a1.59,1.59,0,1,1-1.59-1.58A1.59,1.59,0,0,1,173.89,326.51Z" />
                        <path class="cls-12"
                            d="M183.89,326.51a1.59,1.59,0,1,1-1.59-1.58A1.59,1.59,0,0,1,183.89,326.51Z" />
                        <path class="cls-12"
                            d="M163.89,342.68a1.59,1.59,0,1,1-1.59-1.59A1.59,1.59,0,0,1,163.89,342.68Z" />
                        <path class="cls-9"
                            d="M173.89,342.68a1.59,1.59,0,1,1-1.59-1.59A1.59,1.59,0,0,1,173.89,342.68Z" />
                        <path class="cls-9"
                            d="M183.89,342.68a1.59,1.59,0,1,1-1.59-1.59A1.59,1.59,0,0,1,183.89,342.68Z" />
                        <path class="cls-9"
                            d="M163.89,358.85a1.59,1.59,0,1,1-1.59-1.59A1.59,1.59,0,0,1,163.89,358.85Z" />
                        <path class="cls-12"
                            d="M173.89,358.85a1.59,1.59,0,1,1-1.59-1.59A1.59,1.59,0,0,1,173.89,358.85Z" />
                        <path class="cls-9"
                            d="M183.89,358.85a1.59,1.59,0,1,1-1.59-1.59A1.59,1.59,0,0,1,183.89,358.85Z" />
                        <rect class="cls-8" x="384.51" y="174.13" width="2" height="91.62" />
                        <path class="cls-13"
                            d="M327.33,319.43h-11.2v-2h11.2Zm-23.2,0h-12v-2h12Zm-24,0h-12v-2h12Zm-24,0h-12v-2h12Z" />
                        <path class="cls-8"
                            d="M352.67,262.48l-14.43,70.78a4.5,4.5,0,0,0,5.84,5.17l68.51-22.89a4.5,4.5,0,0,0,1.56-7.64L360.07,260A4.51,4.51,0,0,0,352.67,262.48Z" />
                        <path class="cls-14"
                            d="M346.73,327.16l11.37-55.74a1.83,1.83,0,0,1,3-1l42.59,37.71a1.84,1.84,0,0,1-.64,3.11l-53.95,18A1.84,1.84,0,0,1,346.73,327.16Z" />
                        <path class="cls-15"
                            d="M360.49,288.08l1.57,4.71.09.22,5.34,11.21a2,2,0,0,0,2.4,1l2.09-.7a2,2,0,0,0,1.3-2.25l-2.44-12.18-.06-.24-1.58-4.71a2,2,0,0,0-2.48-1.24l-5,1.67A2,2,0,0,0,360.49,288.08Z" />
                        <path class="cls-15"
                            d="M376.36,309.88a3.54,3.54,0,1,1-4.48-2.24A3.54,3.54,0,0,1,376.36,309.88Z" />
                        <path class="cls-15"
                            d="M166.83,126.86c-5,1.44-27.86,23.11-16.24,34.33s37.86,12.72,44.37,6.06,7.58-23.13,0-37.17C190.27,121.39,166.83,117.19,166.83,126.86Z" />
                        <path class="cls-16"
                            d="M166.83,126.86c-5,1.44-27.86,23.11-16.24,34.33s37.86,12.72,44.37,6.06,7.58-23.13,0-37.17C190.27,121.39,166.83,117.19,166.83,126.86Z" />
                        <path class="cls-17"
                            d="M200.31,188.18v1.44c0,.54,0,1.1,0,1.66,0,1.13.14,2.26.28,3.39a48,48,0,0,0,1.27,6.68,40.25,40.25,0,0,0,2.27,6.32c.47,1,1,2,1.55,2.94.26.49.57.95.86,1.42.14.24.31.46.47.69l.42.61c0,.06-.11-.06-.39-.15a1.05,1.05,0,0,0-.66-.05c-.16.12.53,0,1.27-.38a24.73,24.73,0,0,0,5.12-3.93,125.82,125.82,0,0,0,10-11l.06-.08a3,3,0,0,1,5,3.15,72.32,72.32,0,0,1-3.78,7.2,66,66,0,0,1-4.65,6.84,38.9,38.9,0,0,1-2.86,3.27,23.85,23.85,0,0,1-3.64,3.13,12.7,12.7,0,0,1-6,2.3,8.94,8.94,0,0,1-4.46-.75,9.89,9.89,0,0,1-3.41-2.56l-.77-.92c-.24-.28-.49-.57-.71-.87-.45-.59-.91-1.18-1.33-1.8a36.4,36.4,0,0,1-2.36-3.8c-.73-1.3-1.36-2.64-2-4s-1.08-2.75-1.53-4.16a48.57,48.57,0,0,1-1.88-8.57c-.17-1.45-.29-2.91-.35-4.38,0-.74,0-1.48,0-2.23l0-1.15,0-.59.06-.72a6,6,0,0,1,12,.59Z" />
                        <path class="cls-17"
                            d="M238.29,194.39l-2.09-.83a5.67,5.67,0,0,0-4.32,0l-7.83,3.31-2,3.61c2.89,4.62,7.94,2.24,7.94,2.24l4.92.37a2.46,2.46,0,0,0,2.31-1.23l2.3-4A2.45,2.45,0,0,0,238.29,194.39Z" />
                        <path class="cls-15"
                            d="M196.45,178.27c3.64,2.23,7.38,18.09,7.38,18.09l-15.73,8s-6.7-17.13-3.57-21.72C187.78,177.85,191.13,175,196.45,178.27Z" />
                        <path class="cls-18"
                            d="M199.49,190.2a16.12,16.12,0,0,1-.06,8.39l-11.33,5.75s-3.91-10-4.36-16.77C187.76,183.63,197,183.12,199.49,190.2Z" />
                        <path class="cls-15"
                            d="M199,185.65c-.53,8-2.72,28.95-7.6,41.51-1.39,3.58,3.67,5.48-1.88,9l-39.44-2.19c-3.33-2.75-.37-6.47-.6-8.28-2-15.08.92-19.75-3-52.88a119.08,119.08,0,0,1,17.41-1.26,128.27,128.27,0,0,1,18.47,1.09c2.66.4,5.43.94,7.94,1.47A11.07,11.07,0,0,1,199,185.65Z" />
                        <path class="cls-18"
                            d="M148.05,188.69a15.94,15.94,0,0,1,5,6.44c1.7,4.25-2.74,12.43-4.36,15.17C148.75,204.9,148.81,198.65,148.05,188.69Z" />
                        <path class="cls-8"
                            d="M179.48,180.39s-6.72,5.5-7.31,11.36c-6.08-4.67-13.08-14.87-8.29-20.23C168.91,170.26,179.48,180.39,179.48,180.39Z" />
                        <path class="cls-8"
                            d="M180.34,182.13s5.17,4.42,5.25,9.62c3.4-4.5,3.4-15.75-3.24-19.14C177.31,171.35,180.34,182.13,180.34,182.13Z" />
                        <polygon class="cls-17"
                            points="215.55 319.6 224.11 324.11 236.47 303.4 227.91 298.89 215.55 319.6" />
                        <path class="cls-15"
                            d="M225.34,321.86l-5-10.09a.79.79,0,0,0-1-.41l-8.56,2.82a1.6,1.6,0,0,0-.88,2.23c1.81,3.49,2.86,5.08,5.06,9.52,1.36,2.73,3.19,8.7,5.06,12.47s5.71,2.12,5.26.38c-2-7.8-.58-11.78.24-15.14A2.65,2.65,0,0,0,225.34,321.86Z" />
                        <g class="cls-19">
                            <polygon
                                points="227.9 298.89 236.47 303.4 229.09 315.76 221.18 310.15 227.9 298.89" />
                        </g>
                        <path class="cls-8"
                            d="M183.53,236.08s60.33-8.48,65.78,9.35C259.55,278.91,234,312.1,234,312.1l-11.74-6.43s12.37-27.66,7.95-44.18c-11.44-3.19-67,23-67.21-18.33a3.52,3.52,0,0,1,2.69-3.75Z" />
                        <g class="cls-20">
                            <path class="cls-14"
                                d="M183.53,236.08s60.33-8.48,65.78,9.35C259.55,278.91,234,312.1,234,312.1l-11.74-6.43s12.37-27.66,7.95-44.18c-11.44-3.19-67,23-67.21-18.33a3.52,3.52,0,0,1,2.69-3.75Z" />
                        </g>
                        <polygon class="cls-8"
                            points="219.96 305.74 233.93 315.39 237.89 310.76 222.53 299.93 219.96 305.74" />
                        <path class="cls-8"
                            d="M226.51,327.15l.11.05a1.39,1.39,0,0,0,1.31-.21.8.8,0,0,0,.38-.72c0-1.28-3.16-3.13-3.51-3.34a.24.24,0,0,0-.27,0,.26.26,0,0,0-.09.25C224.74,324.45,225.39,326.6,226.51,327.15Zm-1.46-3.51c1.22.78,2.76,2,2.79,2.65a.37.37,0,0,1-.18.31.92.92,0,0,1-.87.16C226.14,326.51,225.51,325.36,225.05,323.64Z" />
                        <path class="cls-8"
                            d="M224.87,323.51c1.11.56,3.43,1,4.25.4a.83.83,0,0,0,.23-1,1.22,1.22,0,0,0-.73-.76c-1.35-.55-3.94.73-4.05.78a.22.22,0,0,0-.13.2.23.23,0,0,0,.1.21A2.45,2.45,0,0,0,224.87,323.51Zm3.64-.9a.81.81,0,0,1,.4.45c.1.29,0,.4-.08.47-.56.43-2.52.14-3.63-.38.89-.38,2.44-.9,3.24-.57Z" />
                        <path class="cls-8"
                            d="M149.63,231.52l-1.25,3.58c-.16.27.16.58.63.61l41.86,2.46c.37,0,.68-.14.72-.37l.58-3.61c0-.26-.27-.49-.67-.51l-41.19-2.43A.73.73,0,0,0,149.63,231.52Z" />
                        <path class="cls-15"
                            d="M155,236.46l-1.1-.07c-.22,0-.39-.13-.36-.27l.79-4.7c0-.14.23-.24.45-.23l1.1.07c.22,0,.38.13.36.27l-.8,4.7C155.45,236.37,155.25,236.47,155,236.46Z" />
                        <path class="cls-15"
                            d="M187.75,238.39l-1.11-.07c-.22,0-.38-.14-.35-.27l.79-4.7c0-.14.22-.24.44-.23l1.11.07c.22,0,.38.13.35.27l-.79,4.7C188.17,238.3,188,238.4,187.75,238.39Z" />
                        <path class="cls-15"
                            d="M171.46,237.43l-1.11-.07c-.22,0-.38-.14-.35-.27l.79-4.7c0-.14.22-.24.44-.23l1.11.07c.22,0,.38.13.35.27l-.79,4.7C171.87,237.34,171.68,237.44,171.46,237.43Z" />
                        <path class="cls-17"
                            d="M166.8,153.06c.82,6,1.47,14.74-2.92,18.46A56.19,56.19,0,0,1,178,184.66a1.72,1.72,0,0,0,2.81-.13c5.08-8,1.53-11.92,1.53-11.92-3.87-.86-3.4-4.31-2-8.86Z" />
                        <path class="cls-14"
                            d="M183.2,174.27c.6,1.85.8,5.26-2.38,10.26a1.72,1.72,0,0,1-2.81.13,61.28,61.28,0,0,0-10.94-10.92c4.13,1.17,9.93,6.86,12.41,9.62C181.23,182,183.26,176.88,183.2,174.27Z" />
                        <path class="cls-18"
                            d="M170.54,157.69l7.52,4.23,2.32,1.83a14.6,14.6,0,0,0-1,5.92C174.47,168.27,168.84,161.73,170.54,157.69Z" />
                        <path class="cls-17"
                            d="M167,139c-1.58,9.83-2.46,14,1.32,20,5.69,9.14,18.11,8.92,22.59-.24,4-8.24,6-22.93-2.68-28.92A13.58,13.58,0,0,0,167,139Z" />
                        <path class="cls-15"
                            d="M194.75,139.41c-1.25-5.33-.63-14.33-10.69-13.83-9.36.47-15.06-.94-15,4.44-10.34,5.06-11,10.29-3.73,15.24,5.52,1.33,6.93-5,6.3-10.2,4,2.33,11.61-1,15.18-.9C191.42,134.33,196,144.75,194.75,139.41Z" />
                        <path class="cls-16"
                            d="M194.75,139.41c-1.25-5.33-.63-14.33-10.69-13.83-9.36.47-15.06-.94-15,4.44-10.34,5.06-11,10.29-3.73,15.24,5.52,1.33,6.93-5,6.3-10.2,4,2.33,11.61-1,15.18-.9C191.42,134.33,196,144.75,194.75,139.41Z" />
                        <path class="cls-18"
                            d="M179.35,144.54a7.61,7.61,0,0,1-4.07-1.14A14.77,14.77,0,0,1,179.35,144.54Z" />
                        <path class="cls-18"
                            d="M179.59,143.85s-2.33-.32-3.27-1.65A10.51,10.51,0,0,1,179.59,143.85Z" />
                        <path class="cls-15"
                            d="M181.89,145.05c-.17.79.1,1.53.62,1.64s1.08-.43,1.25-1.22-.09-1.52-.61-1.64S182.07,144.26,181.89,145.05Z" />
                        <path class="cls-15"
                            d="M190.82,147.06c-.18.79.1,1.52.61,1.64s1.08-.44,1.26-1.23-.1-1.52-.61-1.63S191,146.27,190.82,147.06Z" />
                        <path class="cls-15" d="M191.84,145.83l2-.12S192.55,147,191.84,145.83Z" />
                        <path class="cls-21"
                            d="M187.75,147.86a21.82,21.82,0,0,0,1.68,5.67,3.47,3.47,0,0,1-2.93-.1Z" />
                        <path class="cls-15"
                            d="M182.47,154a7.16,7.16,0,0,0-1.19-.15.23.23,0,0,0-.24.23.23.23,0,0,0,.22.25,6.46,6.46,0,0,1,5.11,2.74.22.22,0,0,0,.32.09.25.25,0,0,0,.09-.33A6.68,6.68,0,0,0,182.47,154Z" />
                        <path class="cls-17"
                            d="M162.75,146.17a7.32,7.32,0,0,0,2.91,4.74c2.07,1.48,4-.16,4.13-2.57.13-2.18-.78-5.57-3.21-6.1S162.41,143.83,162.75,146.17Z" />
                        <path class="cls-15"
                            d="M181.3,138.36a.48.48,0,0,0,.56,0c1.81-1.25,4.48-.29,4.5-.28a.48.48,0,0,0,.61-.28.47.47,0,0,0-.28-.61c-.13,0-3.16-1.14-5.37.39a.48.48,0,0,0-.12.66A.52.52,0,0,0,181.3,138.36Z" />
                        <path class="cls-15"
                            d="M192.32,142.62a.48.48,0,0,0-.37.29.49.49,0,0,0,.27.62,4.74,4.74,0,0,0,4.33-.33.48.48,0,0,0,.11-.66.47.47,0,0,0-.66-.12,3.78,3.78,0,0,1-3.43.22A.43.43,0,0,0,192.32,142.62Z" />
                        <polygon class="cls-17"
                            points="229.02 352.33 238.24 349.42 232.22 326.06 222.99 328.97 229.02 352.33" />
                        <path class="cls-15"
                            d="M237.51,347l-10.7-3.53a.78.78,0,0,0-1,.39l-4,8.07a1.61,1.61,0,0,0,1,2.2c3.75,1.17,5.62,1.54,10.33,3.1,2.89.95,8.42,3.85,12.41,5.17s5.52-2.57,4-3.47c-6.94-4.08-8.78-7.87-10.6-10.82A2.64,2.64,0,0,0,237.51,347Z" />
                        <g class="cls-19">
                            <polygon
                                points="222.99 328.98 232.22 326.07 235.81 340 226.26 341.68 222.99 328.98" />
                        </g>
                        <path class="cls-8"
                            d="M169.79,235.19s55.74,3.83,56.75,22.44c1.88,35,10.1,76.34,10.1,76.34l-12.83,3.82s-16.72-42-19.72-69.18c-10.34-5.85-61,14.52-56-31.49a3.36,3.36,0,0,1,3.52-3Z" />
                        <g class="cls-7">
                            <path class="cls-14"
                                d="M169.79,235.19s55.74,3.83,56.75,22.44c1.88,35,10.1,76.34,10.1,76.34l-12.83,3.82s-16.72-42-19.72-69.18c-10.34-5.85-61,14.52-56-31.49a3.36,3.36,0,0,1,3.52-3Z" />
                        </g>
                        <polygon class="cls-8"
                            points="222.26 339.44 238.95 336.3 238.45 330.23 219.95 333.53 222.26 339.44" />
                        <path class="cls-8"
                            d="M242.09,349.85l.11,0a1.34,1.34,0,0,0,.77-1.08.78.78,0,0,0-.24-.78c-.94-.87-4.45,0-4.85.15a.21.21,0,0,0-.17.19.25.25,0,0,0,.11.24C238.92,349.21,240.91,350.26,242.09,349.85Zm-3.52-1.43c1.41-.32,3.35-.58,3.84-.12a.35.35,0,0,1,.1.35.9.9,0,0,1-.5.72C241.38,349.66,240.12,349.3,238.57,348.42Z" />
                        <path class="cls-8"
                            d="M238.35,348.46c1.18-.41,3.15-1.71,3.27-2.74a.82.82,0,0,0-.55-.88,1.24,1.24,0,0,0-1,0c-1.34.58-2.26,3.32-2.3,3.43a.24.24,0,0,0,.05.24.22.22,0,0,0,.22.07A2,2,0,0,0,238.35,348.46Zm1.92-3.23a.74.74,0,0,1,.6,0c.27.13.29.28.28.39-.08.7-1.68,1.88-2.82,2.31.35-.9,1.08-2.37,1.87-2.71Z" />
                        <path class="cls-15" d="M182.91,143.83l2-.12S183.63,145,182.91,143.83Z" />
                        <path class="cls-17"
                            d="M151.71,187.49c-1,2.93-2,6.07-2.93,9.14s-1.82,6.19-2.68,9.29-1.6,6.21-2.31,9.32-1.29,6.23-1.75,9.32a49.36,49.36,0,0,0-.29,8.9c.15,3.14.36,6.36.69,9.59.63,6.45,1.42,13,2.24,19.5v.06a3,3,0,0,1-5.79,1.33,179.64,179.64,0,0,1-5.4-19.49c-.7-3.32-1.35-6.67-1.79-10.12a52.1,52.1,0,0,1-.46-11A135.56,135.56,0,0,1,134.57,203q1.17-5,2.63-9.86c1-3.27,2-6.44,3.23-9.76a6,6,0,0,1,11.32,4Z" />
                        <path class="cls-15"
                            d="M146.47,172.78c-4.15,1-9.87,14.74-9.87,14.74l12.83,11.64s8.77-10.78,7.37-16.15C155.34,177.42,151.2,171.64,146.47,172.78Z" />
                        <path class="cls-17"
                            d="M153.59,269.81l-.05-.29a6.23,6.23,0,0,0-3.27-4.47l-6.88-3.56-4.07.76c-.76,4.1,4.26,8.13,4.26,8.13l1.1,2.32a3.46,3.46,0,0,0,4.3,1.8l2.33-.81A3.51,3.51,0,0,0,153.59,269.81Z" />
                        <path class="cls-8"
                            d="M221.31,200.62c.83.88,2.62.54,4-.75s1.81-3.07,1-4-2.62-.54-4,.76S220.47,199.74,221.31,200.62Z" />
                        <path class="cls-8"
                            d="M226.66,204.36h-.15c-.18,0-4.4-.71-3.46-7.58a1,1,0,1,1,2,.27c-.67,4.84,1.73,5.33,1.76,5.33a1,1,0,0,1,.84,1.14A1,1,0,0,1,226.66,204.36Z" />
                        <path class="cls-14"
                            d="M221.68,199.65c.49.52,1.72.17,2.73-.79s1.45-2.17,1-2.69-1.72-.17-2.73.79S221.19,199.13,221.68,199.65Z" />
                        <path class="cls-15"
                            d="M57.34,29.8h19v6.37H63.45l-.68,4.31a13.64,13.64,0,0,1,2.63-.94A11,11,0,0,1,68,39.22a9.63,9.63,0,0,1,7,2.61,8.77,8.77,0,0,1,2.68,6.57,11.19,11.19,0,0,1-1.38,5.35,9.44,9.44,0,0,1-3.92,3.92A13.78,13.78,0,0,1,65.86,59,19.2,19.2,0,0,1,61,58.48a10,10,0,0,1-3.45-1.61,9.73,9.73,0,0,1-2.3-2.42,12.42,12.42,0,0,1-1.47-3.37l8.08-.88a4.87,4.87,0,0,0,1.37,2.95,3.64,3.64,0,0,0,2.57,1,3.46,3.46,0,0,0,2.75-1.27,5.67,5.67,0,0,0,1.09-3.77,5.43,5.43,0,0,0-1.1-3.76,3.77,3.77,0,0,0-2.92-1.2,4.68,4.68,0,0,0-2.23.57,6.52,6.52,0,0,0-1.77,1.49l-6.8-1Z" />
                        <path class="cls-15"
                            d="M80.88,44q0-8.19,3-11.46t9-3.27a13.61,13.61,0,0,1,4.76.71,8.91,8.91,0,0,1,3,1.86,10.15,10.15,0,0,1,1.85,2.41,12.59,12.59,0,0,1,1.09,3,27.4,27.4,0,0,1,.8,6.71q0,7.81-2.64,11.44T92.6,59a12.74,12.74,0,0,1-5.86-1.16,9.46,9.46,0,0,1-3.67-3.39,12.89,12.89,0,0,1-1.62-4.34A30.09,30.09,0,0,1,80.88,44Zm7.91,0c0,3.65.33,6.15,1,7.49a3.06,3.06,0,0,0,2.82,2,2.92,2.92,0,0,0,2.1-.85A5.34,5.34,0,0,0,96,50a28.3,28.3,0,0,0,.42-5.74c0-3.81-.33-6.38-1-7.69a3.12,3.12,0,0,0-2.91-2,3,3,0,0,0-2.87,2C89.09,38,88.79,40.45,88.79,44.07Z" />
                        <path class="cls-15"
                            d="M121.37,53.16H106.82V46.59l14.55-17.28h6.95V47h3.61v6.19h-3.61v5.37h-6.95Zm0-6.19v-9l-7.69,9Z" />
                        <path class="cls-15"
                            d="M149.08,29.8h23.79v6.13H158V40.5h13.82v5.86H158V52H173.3v6.51H149.08Z" />
                        <path class="cls-15"
                            d="M177.63,37.71h7.47v3.41a8.16,8.16,0,0,1,2.22-3,4.67,4.67,0,0,1,2.83-.84,8.48,8.48,0,0,1,3.87,1.1L191.55,44a6.13,6.13,0,0,0-2.24-.59,2.77,2.77,0,0,0-2.43,1.29q-1.23,1.83-1.23,6.82v7h-8Z" />
                        <path class="cls-15"
                            d="M197.13,37.71h7.47v3.41a8.16,8.16,0,0,1,2.22-3,4.67,4.67,0,0,1,2.83-.84,8.48,8.48,0,0,1,3.87,1.1L211.05,44a6.13,6.13,0,0,0-2.24-.59,2.77,2.77,0,0,0-2.43,1.29q-1.23,1.83-1.23,6.82v7h-8Z" />
                        <path class="cls-15"
                            d="M214.53,48.18a10.44,10.44,0,0,1,3.22-7.85,12,12,0,0,1,8.68-3.09q6.25,0,9.45,3.63a10.5,10.5,0,0,1,2.56,7.19,10.45,10.45,0,0,1-3.18,7.87Q232.08,59,226.45,59a12.32,12.32,0,0,1-8.11-2.55A10.21,10.21,0,0,1,214.53,48.18Zm8,0a6.29,6.29,0,0,0,1.13,4.12,3.69,3.69,0,0,0,5.66,0,6.5,6.5,0,0,0,1.11-4.22,6.08,6.08,0,0,0-1.12-4,3.44,3.44,0,0,0-2.76-1.33,3.6,3.6,0,0,0-2.88,1.34A6.22,6.22,0,0,0,222.53,48.16Z" />
                        <path class="cls-15"
                            d="M242.36,37.71h7.47v3.41a8.16,8.16,0,0,1,2.22-3,4.68,4.68,0,0,1,2.84-.84,8.47,8.47,0,0,1,3.86,1.1L256.28,44a6.13,6.13,0,0,0-2.24-.59,2.77,2.77,0,0,0-2.43,1.29q-1.23,1.83-1.23,6.82v7h-8Z" />
                        <path class="cls-8"
                            d="M64.7,82.19v-2.5h9v7.89a16.2,16.2,0,0,1-4.28,2.49,12.83,12.83,0,0,1-4.53.83,12.12,12.12,0,0,1-5.69-1.34,9,9,0,0,1-3.87-3.88A12.2,12.2,0,0,1,54,80a13.14,13.14,0,0,1,1.3-5.8,8.62,8.62,0,0,1,3.73-4,11.75,11.75,0,0,1,5.62-1.31,11.14,11.14,0,0,1,4.17.75,7,7,0,0,1,2.92,2.08,9.37,9.37,0,0,1,1.61,3.48l-2.54.7a8,8,0,0,0-1.19-2.55,4.83,4.83,0,0,0-2-1.49,7.5,7.5,0,0,0-2.93-.56,8.67,8.67,0,0,0-3.34.59,6.28,6.28,0,0,0-2.27,1.54,7.47,7.47,0,0,0-1.34,2.11,11.12,11.12,0,0,0-.81,4.27,10.4,10.4,0,0,0,1,4.76,6.18,6.18,0,0,0,2.85,2.84,8.81,8.81,0,0,0,4,.93,9.42,9.42,0,0,0,3.57-.7A9.29,9.29,0,0,0,71,86.15v-4Z" />
                        <path class="cls-8"
                            d="M87.57,88.63a9.75,9.75,0,0,1-2.79,1.74,8,8,0,0,1-2.88.51A5.63,5.63,0,0,1,78,89.64a4.1,4.1,0,0,1-1.36-3.17,4.23,4.23,0,0,1,.51-2.07,4.35,4.35,0,0,1,1.35-1.5A6.46,6.46,0,0,1,80.38,82a20.43,20.43,0,0,1,2.32-.39,23.4,23.4,0,0,0,4.65-.9c0-.35,0-.58,0-.68a2.91,2.91,0,0,0-.74-2.25,4.37,4.37,0,0,0-3-.88,4.6,4.6,0,0,0-2.72.64,3.94,3.94,0,0,0-1.3,2.29l-2.55-.35a6.39,6.39,0,0,1,1.14-2.65,5,5,0,0,1,2.31-1.55A10.32,10.32,0,0,1,84,74.78a9.25,9.25,0,0,1,3.21.46,4.24,4.24,0,0,1,1.81,1.17,4,4,0,0,1,.81,1.78,14.23,14.23,0,0,1,.13,2.4v3.48a37,37,0,0,0,.17,4.61,5.78,5.78,0,0,0,.66,1.85H88.09A5.64,5.64,0,0,1,87.57,88.63Zm-.22-5.83a19.34,19.34,0,0,1-4.26,1,9.85,9.85,0,0,0-2.28.53,2.32,2.32,0,0,0-1,.84,2.27,2.27,0,0,0-.36,1.24,2.2,2.2,0,0,0,.79,1.74,3.39,3.39,0,0,0,2.32.7,5.4,5.4,0,0,0,2.68-.66,4,4,0,0,0,1.72-1.8,6.33,6.33,0,0,0,.42-2.62Z" />
                        <path class="cls-8"
                            d="M99.74,88.19l.38,2.31a10.13,10.13,0,0,1-2,.23,4.46,4.46,0,0,1-2.2-.45,2.5,2.5,0,0,1-1.1-1.18A9.16,9.16,0,0,1,94.52,86V77.16H92.6v-2h1.92V71.31l2.59-1.57v5.39h2.63v2H97.11v9a4.58,4.58,0,0,0,.14,1.44,1.11,1.11,0,0,0,.45.51,1.82,1.82,0,0,0,.89.18A8.09,8.09,0,0,0,99.74,88.19Z" />
                        <path class="cls-8"
                            d="M112.84,85.57l2.69.33a6.54,6.54,0,0,1-2.36,3.67,8,8,0,0,1-9.77-.78,8.11,8.11,0,0,1-2-5.83,8.56,8.56,0,0,1,2-6,6.79,6.79,0,0,1,5.2-2.14,6.57,6.57,0,0,1,5,2.1,8.33,8.33,0,0,1,2,5.92c0,.15,0,.38,0,.69H104.12a5.93,5.93,0,0,0,1.44,3.89,4.27,4.27,0,0,0,3.22,1.35,4,4,0,0,0,2.45-.75A5.14,5.14,0,0,0,112.84,85.57Zm-8.57-4.22h8.6a5.27,5.27,0,0,0-1-2.92,4,4,0,0,0-3.23-1.51,4.14,4.14,0,0,0-3,1.21A4.7,4.7,0,0,0,104.27,81.35Z" />
                        <path class="cls-8"
                            d="M121.66,90.53l-4.72-15.4h2.7L122.09,84l.91,3.3.8-3.17,2.45-9h2.69l2.3,8.93L132,87l.89-3,2.64-8.9h2.53l-4.81,15.4h-2.71l-2.46-9.23-.59-2.62-3.12,11.85Z" />
                        <path class="cls-8"
                            d="M150.31,88.63a9.62,9.62,0,0,1-2.79,1.74,8,8,0,0,1-2.88.51,5.63,5.63,0,0,1-3.9-1.24,4.1,4.1,0,0,1-1.36-3.17,4.23,4.23,0,0,1,.51-2.07,4.45,4.45,0,0,1,1.35-1.5,6.46,6.46,0,0,1,1.88-.86,20.85,20.85,0,0,1,2.32-.39,23.69,23.69,0,0,0,4.66-.9c0-.35,0-.58,0-.68a2.91,2.91,0,0,0-.74-2.25,4.37,4.37,0,0,0-3-.88,4.6,4.6,0,0,0-2.72.64,3.94,3.94,0,0,0-1.3,2.29l-2.55-.35A6.39,6.39,0,0,1,141,76.87a5,5,0,0,1,2.31-1.55,10.36,10.36,0,0,1,3.49-.54,9.25,9.25,0,0,1,3.21.46,4.18,4.18,0,0,1,1.81,1.17,4.13,4.13,0,0,1,.82,1.78,15.42,15.42,0,0,1,.13,2.4v3.48a37.8,37.8,0,0,0,.16,4.61,5.78,5.78,0,0,0,.66,1.85h-2.72A5.42,5.42,0,0,1,150.31,88.63Zm-.21-5.83a19.6,19.6,0,0,1-4.27,1,9.85,9.85,0,0,0-2.28.53,2.24,2.24,0,0,0-1,.84,2.2,2.2,0,0,0-.37,1.24,2.23,2.23,0,0,0,.79,1.74,3.39,3.39,0,0,0,2.32.7,5.38,5.38,0,0,0,2.68-.66,4.11,4.11,0,0,0,1.73-1.8,6.33,6.33,0,0,0,.42-2.62Z" />
                        <path class="cls-8"
                            d="M156.67,96.46,156.38,94a6,6,0,0,0,1.49.23,2.9,2.9,0,0,0,1.39-.29,2.3,2.3,0,0,0,.86-.81,13.39,13.39,0,0,0,.8-2c0-.14.12-.35.23-.63L155.3,75.13h2.82l3.2,8.91c.42,1.14.79,2.33,1.12,3.57a36.6,36.6,0,0,1,1.07-3.51l3.29-9h2.61l-5.85,15.66a29.75,29.75,0,0,1-1.47,3.49,5.14,5.14,0,0,1-1.59,1.9,3.79,3.79,0,0,1-2.15.6A5.31,5.31,0,0,1,156.67,96.46Z" />
                        <path class="cls-8"
                            d="M185.59,88.19,186,90.5a10,10,0,0,1-2,.23,4.43,4.43,0,0,1-2.2-.45,2.52,2.52,0,0,1-1.11-1.18,9.53,9.53,0,0,1-.31-3.08V77.16h-1.92v-2h1.92V71.31L183,69.74v5.39h2.63v2H183v9a4.58,4.58,0,0,0,.14,1.44,1.11,1.11,0,0,0,.45.51,1.79,1.79,0,0,0,.89.18A8.21,8.21,0,0,0,185.59,88.19Z" />
                        <path class="cls-8" d="M188.15,72.27v-3h2.61v3Zm0,18.26V75.13h2.61v15.4Z" />
                        <path class="cls-8"
                            d="M194.74,90.53V75.13h2.33v2.16A5.52,5.52,0,0,1,199,75.47a5.41,5.41,0,0,1,2.74-.69,5,5,0,0,1,2.81.71,3.75,3.75,0,0,1,1.54,2,5.54,5.54,0,0,1,4.76-2.7,4.7,4.7,0,0,1,3.53,1.27,5.4,5.4,0,0,1,1.23,3.9V90.53H213V80.82a7.13,7.13,0,0,0-.25-2.25,2.21,2.21,0,0,0-.92-1.11,2.9,2.9,0,0,0-1.57-.42,3.66,3.66,0,0,0-2.7,1.08,4.78,4.78,0,0,0-1.07,3.46v9h-2.61v-10a4.37,4.37,0,0,0-.64-2.61,2.41,2.41,0,0,0-2.09-.87,3.74,3.74,0,0,0-2,.58,3.26,3.26,0,0,0-1.36,1.7,9.52,9.52,0,0,0-.42,3.22v8Z" />
                        <path class="cls-8"
                            d="M230,85.57l2.7.33a6.54,6.54,0,0,1-2.36,3.67,8,8,0,0,1-9.77-.78,8.11,8.11,0,0,1-2-5.83,8.56,8.56,0,0,1,2-6,6.79,6.79,0,0,1,5.19-2.14,6.59,6.59,0,0,1,5,2.1,8.33,8.33,0,0,1,2,5.92c0,.15,0,.38,0,.69H221.31a5.88,5.88,0,0,0,1.43,3.89A4.28,4.28,0,0,0,226,88.73a4,4,0,0,0,2.45-.75A5,5,0,0,0,230,85.57Zm-8.57-4.22h8.6a5.19,5.19,0,0,0-1-2.92,4,4,0,0,0-3.24-1.51,4.12,4.12,0,0,0-3,1.21A4.75,4.75,0,0,0,221.45,81.35Z" />
                        <path class="cls-8"
                            d="M235,82.83q0-4.29,2.38-6.34a7.16,7.16,0,0,1,4.84-1.71,6.89,6.89,0,0,1,5.19,2.08,7.89,7.89,0,0,1,2,5.75,10.28,10.28,0,0,1-.89,4.68,6.3,6.3,0,0,1-2.6,2.64,7.54,7.54,0,0,1-3.72.95A6.9,6.9,0,0,1,237,88.8,8.26,8.26,0,0,1,235,82.83Zm2.68,0A6.56,6.56,0,0,0,239,87.26a4.31,4.31,0,0,0,6.49,0,6.73,6.73,0,0,0,1.29-4.51,6.38,6.38,0,0,0-1.3-4.33,4.32,4.32,0,0,0-6.48,0A6.55,6.55,0,0,0,237.71,82.83Z" />
                        <path class="cls-8"
                            d="M262.61,90.53V88.27a5.63,5.63,0,0,1-4.88,2.61,6.23,6.23,0,0,1-2.55-.53A4.06,4.06,0,0,1,253.43,89a4.9,4.9,0,0,1-.81-1.93,13,13,0,0,1-.16-2.44V75.13h2.61v8.54a14.79,14.79,0,0,0,.16,2.75,2.71,2.71,0,0,0,1,1.62,3.22,3.22,0,0,0,2,.59,4.28,4.28,0,0,0,2.2-.6,3.4,3.4,0,0,0,1.46-1.64,8.13,8.13,0,0,0,.43-3V75.13H265v15.4Z" />
                        <path class="cls-8"
                            d="M274.74,88.19l.38,2.31a10.13,10.13,0,0,1-2,.23,4.46,4.46,0,0,1-2.2-.45,2.5,2.5,0,0,1-1.1-1.18,9.16,9.16,0,0,1-.32-3.08V77.16H267.6v-2h1.92V71.31l2.59-1.57v5.39h2.63v2h-2.63v9a4.58,4.58,0,0,0,.14,1.44,1.11,1.11,0,0,0,.45.51,1.82,1.82,0,0,0,.89.18A8.21,8.21,0,0,0,274.74,88.19Z" />
                    </g>
                </g>
            </svg>
        </div>
        <div class="details">
            <h5> Booking Error</h5>
            <p class="desc"> Could not process your booking . Please re-fetch flights.</p>
        </div>
        <div class="actions">
            <button class="sec" onclick="window.location.href = '/'"> Go on Home-Page </button>
            <button class="prime" onclick="window.location.reload()">Re-fetch</button>
        </div>
            
        @endif
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
