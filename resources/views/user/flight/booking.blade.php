@php
    if (!function_exists('air_get_date')) {
        function air_get_date($d)
        {
            $da = explode('-', substr($d, 0, 10));
            return $da[2] . '-' . $da[1] . '-' . $da[0];
        }
    }
    if (!function_exists('air_get_time')) {
        function air_get_time($d)
        {
            preg_match('/T(.*):/', $d, $t);
            return $t[1];
        }
    }
    if (!function_exists('air_date')) {
        function air_date($d)
        {
            $da = explode('-', substr($d, 0, 10));
            preg_match('/T(.*):/', $d, $t);
            return '<p class="time">
' .
                $t[1] .
                '<span>' .
                $da[2] .
                '-' .
                $da[1] .
                '-' .
                $da[0] .
                '</span></p>';
        }
    }
@endphp
@extends('user.components.layout')
@push('css')
    <style>
        .main_content .panel_group {
            box-shadow: 0 0 20px 0 #00000033;
            border-radius: 6px;
            overflow: hidden;
        }

        .main_content .panel_group .panel {
            box-shadow: none;
            border-radius: 0;
            border-bottom: none;
        }

        .main_content .panel_group .panel:not(:first-of-type):last-of-type {
            border-bottom: none;
        }

        .main_content .panel_group .panel:first-of-type:last-of-type {
            border-bottom: 6px solid #002346;
        }

        .main_content .extra_info {
            display: flex;
            justify-content: space-between;
            padding: 10px 20px;
            border-radius: 7px;
            margin-top: 10px;
            background: rgba(var(--fv_sec_rgb), 0.2);
        }

        .main_content .extra_info .info {
            display: flex;
            gap: 20px;
        }

        .main_content .extra_info .info p {
            display: flex;
            align-items: center;
        }

        .main_content .extra_info .info p span {
            margin-left: 5px;
            font-size: 0.8em;
            font-weight: 600;
            color: var(--fv_sec);
        }

        .main_content .ground {
            padding: 10px;
            color: white;
            background: #002346;
            font-weight: 600;
            font-size: 1.4rem;
            text-align: center;
        }

        .main_content .airline {
            display: flex;
            justify-content: space-between;
        }

        .main_content .airline h6 {
            color: var(--fv_sec);
            font-size: 0.8em;
        }

        .main_content .airline p {
            font-size: 0.8em;
            font-weight: 600;
            font-style: italic;
        }

        .main_content .airline h6 span {
            color: var(--gray_700);
            font-size: 0.7em;
        }

        .main_content .location {
            display: flex;
            flex-direction: column;
        }

        .main_content .destination {
            text-align: right;
            align-items: right;
        }

        .main_content .flight_details {
            display: flex;
        }

        .main_content .flight_details .flight_time {
            flex-grow: 1;
        }

        .main_content .flight_details .city_code {
            color: var(--fv_prime);
        }

        .main_content .flight_details .city_code span {
            font-size: 0.7em;
            color: var(--gray_700);
        }

        .main_content .flight_details .city {
            font-size: 1.2rem;
            margin-top: -3px;
        }

        .main_content .flight_details .city span {
            font-weight: 600;
        }

        .main_content .flight_details .time {
            font-size: 1.7rem;
            margin-top: 5px;
        }

        .main_content .flight_details .time span {
            font-size: 0.6em;
            margin-left: 5px;
        }

        .main_content .flight_details .flight_time {
            border: 1px dashed;
            margin-block: auto;
            height: 0px;
            margin-inline: 20px;
            position: relative;
        }

        .main_content .flight_details .flight_time i {
            position: absolute;
            left: 0%;
            transform: translate(-50%, -50%);
            background: white;
            padding-inline: 5px;
            opacity: 0;
            animation: move_flight 6s linear infinite forwards;
        }

        i.text {
            font-size: 0.7em;
        }

        i.text.info {
            color: var(--info_dark);
        }

        i.text.error {
            font-size: 0.8em;
            color: var(--error_dark);
            font-weight: 600;
        }

        .rules {
            display: flex;
            flex-wrap: wrap;
            margin-top: 15px;
            gap: 10px;
        }

        .rules .rule {
            flex-grow: 1;
            min-width: 250px;
            border-radius: 5px;
            overflow: hidden;
            background: rgba(var(--fv_prime_rgb), 0.2);
        }

        .rules .rule table {
            width: 100%;
            border-collapse: collapse;
        }

        .rules .rule table thead {
            background: rgba(var(--fv_prime_rgb), 0.2);
        }

        .rules .rule table :is(th, td) {
            text-align: left;
            padding: 6px 20px;
        }

        .filter_layout {
            display: flex;
            --header: 70px;
            padding: 20px;
            gap: 20px;
        }

        .filter_layout :is(.filterbar, .main_content) {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .filter_layout .filterbar {
            width: 310px;
            height: max-content;
            position: sticky;
            flex-shrink: 0;
            top: calc(var(--header) + var(--buff, 20px));
        }

        .filter_layout .main_content {
            flex-grow: 1;
        }

        .panel {
            box-shadow: 0 0 10px 0 #00000033;
            border-bottom: 6px solid #002346;
            border-radius: 6px;
            padding: 20px;
        }

        .filter_layout .filterbar nav,
        .filter_layout .filterbar nav ul {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .filter_layout .filterbar nav ul {
            padding-left: 25px;
        }

        .filter_layout .filterbar nav li {
            list-style-type: none;
        }

        .filter_layout .filterbar nav a {
            display: block;
            padding: 8px 15px;
            font-size: 1.4rem;
        }

        .filter_layout .filterbar nav a i {
            margin-right: 10px;
        }

        .filter_layout .filterbar nav a:where(.active, :hover) {
            color: var(--fv_sec);
            font-weight: 600;
        }

        .options {
            gap: 10px;
        }

        .options button {
            border: none;
        }

        .options button.sec {
            color: var(--error_dark);
        }

        .options button.prime {
            background: rgba(var(--fv_sec_rgb), 0.8);
            color: white;
        }

        .options button.primary {
            background: var(--prime);
            color: white;
        }

        button.ticket_btn {
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
        <div class="filter_layout">
            <div class="filterbar">
                <nav>
                    <li>
                        <a href=""><i class="fa-solid fa-user"></i>Profile</a>
                    </li>
                    <li>
                        <a href="/user/bookings">
                            <i class="fa-solid fa-bookmark"></i>Bookings
                        </a>
                        <ul>
                            <li>
                                <a href="/user/bookings"><i class="fa-solid fa-plane"></i>Flight</a>
                            </li>
                            <li>
                                <a href=""><i class="fa-solid fa-taxi"></i>Cab</a>
                            </li>
                            <li>
                                <a href=""><i class="fa-solid fa-hotel"></i>Hotel</a>
                            </li>
                            <li>
                                <a href=""><i class="fa-solid fa-bus"></i>Bus</a>
                            </li>
                        </ul>
                    </li>
                </nav>
            </div>
            <div class="main_content">
                @foreach ($flightBookings['FlightItinerary']['Segments'] as $i => $segment)
                    @php
                        $airline = $segment['Airline'];
                        $origin = $segment['Origin'];
                        $destination = $segment['Destination'];
                    @endphp
                    @if ($i > 0)
                        <div class="ground">{{ floor(($segment['GroundTime'] ?? 0) / 60) }} Hours
                            {{ ($segment['GroundTime'] ?? 0) % 60 }} Minutes</div>
                    @endif
                    <div class="panel flight">
                        <div class="airline">
                            <h6>
                                {{ $airline['AirlineName'] }}
                                <span>{{ $airline['AirlineCode'] }}-{{ $airline['FlightNumber'] }}</span>
                            </h6>
                        </div>
                        <div class="flight_details">
                            <div class="origin location">
                                <h4 class="city_code">
                                    {{ $origin['Airport']['AirportCode'] }}
                                    <span>{{ $origin['Airport']['CityName'] }}</span>
                                </h4>
                                <p class="city">
                                    @if ($origin['Airport']['Terminal'] != '')
                                        <span>T-{{ $origin['Airport']['Terminal'] }}</span>
                                    @endif
                                    {{ $origin['Airport']['AirportName'] }}
                                </p>
                                {!! air_date($origin['DepTime']) !!}
                            </div>
                            <div class="flight_time">
                                <i class="fa-solid fa-plane"></i>
                            </div>
                            <div class="destination location">
                                <h4 class="city_code">
                                    <span>{{ $destination['Airport']['CityName'] }}</span>
                                    {{ $destination['Airport']['AirportCode'] }}
                                </h4>
                                <p class="city">
                                    @if ($destination['Airport']['Terminal'] != '')
                                        <span>T-{{ $destination['Airport']['Terminal'] }}</span>
                                    @endif
                                    {{ $destination['Airport']['AirportName'] }}
                                </p>
                                {!! air_date($destination['ArrTime']) !!}
                            </div>
                        </div>
                        <div class="extra_info">
                            <div class="info">
                                <p><i class="fa-solid fa-clock"></i><span>{{ floor($segment['Duration'] / 60) }}
                                        Hours
                                        {{ $segment['Duration'] % 60 }} Minutes</span></p>
                            </div>
                            <div class="info">
                                <p><i class="fa-solid fa-backpack"></i><span>{{ $segment['CabinBaggage'] }}
                                        Cabin</span></p>
                                <p><i class="fa-solid fa-suitcase"></i><span>{{ $segment['Baggage'] }}</span></p>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="panel">
                    <table style="width: 100%;text-align:left;">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>PaxId</th>
                                <th>Name</th>
                                <th>Ticket</th>
                                <th>Add on</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($flightBookings['FlightItinerary']['Passenger'] as $pax)
                                <tr>
                                    <td>
                                        @if ($pax['PaxType'] == 1)
                                            <i class="fa-solid fa-person"></i>
                                        @elseif($pax['PaxType'] == 2)
                                            <i class="fa-solid fa-child" style="font-size: 0.8em"></i>
                                        @else
                                            <i class="fa-solid fa-baby" style="font-size: 0.8em"></i>
                                        @endif
                                    </td>
                                    <td>{{ $pax['PaxId'] }}</td>
                                    <td>{{ $pax['Title'] }} {{ $pax['FirstName'] }} {{ $pax['LastName'] }}</td>
                                    <td>{{ $pax['Ticket']['TicketId'] }}</td>
                                    <td>
                                        @if ($pax['Fare']['TotalBaggageCharges'] > 0 && ($iii = 1))
                                            <i class="fa-solid fa-backpack"></i>
                                        @endif
                                        @if ($pax['Fare']['TotalMealCharges'] > 0 && ($iii = 1))
                                            <i class="fa-solid fa-fork-knife"></i>
                                        @endif
                                        @if ($pax['Fare']['TotalSeatCharges'] > 0 && ($iii = 1))
                                            <i class="fa-solid fa-person-seat"></i>
                                        @endif
                                        @isset($iii)
                                        @else
                                            --- ---
                                        @endisset
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if (isset($flightBookings['FlightItinerary']['MiniFareRules']))
                    <div class="panel">
                        <h5 class="panel_title">Cancellation & Re-Issue <i
                                class="text info">{{ $flightBookings['FlightItinerary']['MiniFareRules'][0]['JourneyPoints'] }}</i>
                        </h5>
                        <div class="rules">
                            <div class="rule">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>If Rescheduled</th>
                                            <th>Charges</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($flightBookings['FlightItinerary']['MiniFareRules'] as $rule)
                                            @if ($rule['Type'] == 'Reissue')
                                                <tr>
                                                    <td>{{ ($rule['From'] ?? 0) + 2 }}-{{ $rule['To'] ? $rule['To'] + 2 : 'More' }}
                                                        {{ $rule['Unit'] }}</td>
                                                    <td>{{ $rule['Details'] }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="rule">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>If Cancelled</th>
                                            <th>Charges</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($flightBookings['FlightItinerary']['MiniFareRules'] as $rule)
                                            @if ($rule['Type'] == 'Cancellation')
                                                <tr>
                                                    <td>{{ ($rule['From'] ?? 0) + 2 }}-{{ $rule['To'] ? $rule['To'] + 2 : 'More' }}
                                                        {{ $rule['Unit'] }}</td>
                                                    <td>{{ $rule['Details'] }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif 
                 <div class="options rflex jcc">
                    @if (!$flightBookings['is_cancelled'])
                        <button class="btn sec" onclick="init_cancel()" id="cancel_Booking_btn">Cancel Booking</button>
                        <button class="btn prime" id="show_ticket">View Ticket</button>
                    @else
                        <i class="prime text">Booking Has been cancelled</i>
                    @endif
                </div>
            </div>
        </div>
        
    </main>
@endsection

@push('js')
    <script>
        $("#show_ticket").addEventListener('click', function() {
            if (this.hasClass('active')) {
                this.addClass('active');
                $("#ticket_box").addCSS("display", "flex");
            } else {
                this.removeClass('active');
                $("#ticket_box").addCSS("display", "none");
            }
        });

        function print_ticket(nodeName) {
            $(`#${nodeName}`).addClass("printable");
            window.print();
            $(`#${nodeName}`).removeClass("printable");
        }
        let cancel_popup = new Popup($('#cancel_ticket_popup'), true);
        let success_popup = new Popup($('#success_popup'), true);
        let error_popup = new Popup($('#error_popup'), true);

        function init_cancel() {
            cancel_popup.show_popup();
        }
        $('#cancel_form').ajaxSubmit({
            beforeupload: () => {
                cancel_popup.hide_popup();
                showLoader();
            },
            success: (res) => {
                res = JSON.parse(res);
                hideLoader();
                let p = $('#success_popup .refund')[0];
                if (res.refund) {
                    p.innerText = `You got a refund of ${res.refund}`;
                    p.addCSS('display', 'unset')
                } else {
                    p.addCSS('display', 'none')
                }
                success_popup.show_popup();
                setTimeout(() => {
                    location.reload();
                }, 3000);
            },
            error: () => {
                hideLoader();
                error_popup.show_popup();
            }
        });
    </script>
@endpush
