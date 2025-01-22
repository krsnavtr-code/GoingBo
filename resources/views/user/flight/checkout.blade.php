@php
use Carbon\Carbon;

@endphp

@php
    $total = 0;
    $pax = ['Adults', 'Children', 'Infants'];
    $rt = $ret_data['fare'] ?? [];
    $destination = $fare['Segments'][0][count($fare['Segments'][0]) - 1]['Destination'];
    $passport = $fare['IsPassportRequiredAtBook'] || $fare['IsPassportRequiredAtTicket'] || ($ret_data['fare']['IsPassportRequiredAtBook'] ?? false) || ($ret_data['fare']['IsPassportRequiredAtTicket'] ?? false);
    if (!function_exists('air_date')) {
        function air_date($d)
        {
            $da = explode('-', substr($d, 0, 10));
            preg_match('/T(.*):/', $d, $t);
            return '<p class="time">' . $t[1] . '<span>' . $da[2] . '-' . $da[1] . '-' . $da[0] . '</span></p>';
        }
    }
    $adult = $fare['FareBreakdown'][0]['PassengerCount'];
    $child = $fare['FareBreakdown'][1]['PassengerCount'] ?? 0;
    $infant = $fare['FareBreakdown'][2]['PassengerCount'] ?? 0;
@endphp
@inject('countries', App\Models\Country::class)
@extends('user.components.layout')
@push('css')
    <link rel="stylesheet" href="{{ url('css/review_flight.css') }}">
@endpush
@section('main')
    <main>
        <div id="timer" style="position: absolute; top: 70px; right: 60px; font-size: 24px; background-color: var(--fv_sec);"></div>
        <form class="results">
            @csrf
            <div class="main_content">
                <div class="panel_group flights">
                    @foreach ($fare['Segments'][0] as $i => $segment)
                        @php
                            $airline = $segment['Airline'];
                            $origin = $segment['Origin'];
                            $destination = $segment['Destination'];
                        @endphp

                        @if ($i > 0)
                        @php
                        // dd($segment);
                        // Create Carbon instances for arrival and departure time
                        $arrivalDateTime = Carbon::parse($fare['Segments'][0][0]['Destination']['ArrTime']);
                        $departureDateTime = Carbon::parse( $fare['Segments'][0][1]['Origin']['DepTime']);

                        // Calculate the time difference
                        $timeDifference = $arrivalDateTime->diff($departureDateTime);

                        // Format the time difference
                        $timeDifferenceFormatted = $timeDifference->format('%h Hours %i Minutes');

                        @endphp
                            <div class="ground"> {{ $timeDifferenceFormatted }} 
                                {{-- {{ floor(($segment['GroundTime'] ?? 0) / 60) }} 
                                {{ ($segment['GroundTime'] ?? 0) % 60 }} --}}
                            </div>
                        @endif

                        <div class="panel flight">
                            <div class="airline">
                                <h6>
                                    {{ $airline['AirlineName'] }}
                                    <span>{{ $airline['AirlineCode'] }}-{{ $airline['FlightNumber'] }}</span>
                                </h6>
                                <p>{{ $fare['Segments'][0][0]['Origin']['Airport']['AirportCode'] }} -
                                    {{ $fare['Segments'][0][count($fare['Segments'][0]) - 1]['Destination']['Airport']['AirportCode'] }}
                                </p>
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
                </div>

                @isset($fare['Segments'][1])
                    <div class="panel_group flights">
                        @foreach ($fare['Segments'][1] as $i => $segment)
                            @php
                                $airline = $segment['Airline'];
                                $origin = $segment['Origin'];
                                $destination = $segment['Destination'];
                            @endphp

                            @if ($i > 0)
                                @php
                                // dd($segment);
                                // Create Carbon instances for arrival and departure time
                                $arrivalDateTime = Carbon::parse($fare['Segments'][0][0]['Destination']['ArrTime']);
                                $departureDateTime = Carbon::parse( $fare['Segments'][0][1]['Origin']['DepTime']);

                                // Calculate the time difference
                                $timeDifference = $arrivalDateTime->diff($departureDateTime);

                                // Format the time difference
                                $timeDifferenceFormatted = $timeDifference->format('%h Hours %i Minutes');

                                @endphp
                                    <div class="ground"> {{ $timeDifferenceFormatted }} 
                                        {{-- {{ floor(($segment['GroundTime'] ?? 0) / 60) }} 
                                        {{ ($segment['GroundTime'] ?? 0) % 60 }} --}}
                                    </div>
                            @endif
                            <div class="panel flight">
                                <div class="airline">
                                    <h6>
                                        {{ $airline['AirlineName'] }}
                                        <span>{{ $airline['AirlineCode'] }}-{{ $airline['FlightNumber'] }}</span>
                                    </h6>
                                    <p>{{ $fare['Segments'][1][0]['Origin']['Airport']['AirportCode'] }} -
                                        {{ $fare['Segments'][1][count($fare['Segments'][0]) - 1]['Destination']['Airport']['AirportCode'] }}
                                    </p>
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
                    </div>
                @endisset

                @if (isset($ret_data) && isset($ret_data['fare']))
                    <div class="panel_group flights">
                        @foreach ($ret_data['fare']['Segments'][0] as $i => $segment)
                            @php
                                $airline = $segment['Airline'];
                                $origin = $segment['Origin'];
                                $destination = $segment['Destination'];
                            @endphp

                            @if ($i > 0)
                                @php
                                // dd($segment);
                                // Create Carbon instances for arrival and departure time
                                $arrivalDateTime = Carbon::parse($fare['Segments'][0][0]['Destination']['ArrTime']);
                                $departureDateTime = Carbon::parse( $fare['Segments'][0][1]['Origin']['DepTime']);
        
                                // Calculate the time difference
                                $timeDifference = $arrivalDateTime->diff($departureDateTime);
        
                                // Format the time difference
                                $timeDifferenceFormatted = $timeDifference->format('%h Hours %i Minutes');
        
                                @endphp
                                    <div class="ground"> {{ $timeDifferenceFormatted }} 
                                        {{-- {{ floor(($segment['GroundTime'] ?? 0) / 60) }} 
                                        {{ ($segment['GroundTime'] ?? 0) % 60 }} --}}
                                    </div>
                            @endif

                            <div class="panel flight">
                                <div class="airline">
                                    <h6>
                                        {{ $airline['AirlineName'] }}
                                        <span>{{ $airline['AirlineCode'] }}-{{ $airline['FlightNumber'] }}</span>
                                    </h6>
                                    <p>{{ $ret_data['fare']['Segments'][0][0]['Origin']['Airport']['AirportCode'] }} -
                                        {{ $ret_data['fare']['Segments'][0][count($ret_data['fare']['Segments'][0]) - 1]['Destination']['Airport']['AirportCode'] }}
                                    </p>
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
                    </div>
                @endif
                                <div class="panel_group rules_panel">
                    <div class="panel">
                        <h5 class="panel_title rflex aie">Cancellation & Re-Issue <i style="margin:2px 5px"
                                class="text info">{{ $fare['MiniFareRules'][0][0]['JourneyPoints'] ?? $rules[0]['Origin'] . '-' . $rules[count($rules) - 1]['Destination'] }}</i><span
                                onclick="this.closest('.panel').toggleClass('active')"
                                style="color: var(--gray_500);margin-left:auto;font-size:0.7em;cursor:pointer;">View
                                Charges</span></h5>
                        @isset($fare['MiniFareRules'])
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
                                            @foreach ($fare['MiniFareRules'][0] as $rule)
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
                                            @foreach ($fare['MiniFareRules'][0] as $rule)
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
                        @else
                            <div class="rules">
                                {!! $rules[0]['FareRuleDetail'] !!}
                            </div>
                        @endisset
                    </div>
                    @isset($ret_data)
                        <div class="panel">
                            <h5 class="panel_title rflex aie">Cancellation & Re-Issue <i style="margin:2px 5px" class="text info">{{ $ret_data['fare']['MiniFareRules'][0][0]['JourneyPoints'] ?? $ret_data['rules'][0]['Origin'] . '-' . $ret_data['rules'][count($ret_data['rules']) - 1]['Destination'] }}</i><span onclick="this.closest('.panel').toggleClass('active')" style="color: var(--gray_500);margin-left:auto;font-size:0.7em;cursor:pointer;">View Charges</span>
                            </h5>
                            @isset($ret_data['fare']['MiniFareRules'])
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
                                                @foreach ($ret_data['fare']['MiniFareRules'][0] as $rule)
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
                                                @foreach ($ret_data['fare']['MiniFareRules'][0] as $rule)
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
                            @else
                                <div class="rules">
                                    {!! $ret_data['rules'][0]['FareRuleDetail'] !!}
                                </div>
                            @endisset
                        </div>
                    @endisset
                </div>
            </div>
            <div class="sidebar">
                <div class="panels">
                    <div class="panel">
                        <h5 class="panel_title">Fare Summary</h5>
                        <div class="fares">
                            <div class="fare">
                                @php $mini_total=0; @endphp
                                <h6 class="fare_title">Base Fare</h6>
                                <div class="fare_desc">
                                    @foreach ($fare['FareBreakdown'] as $i => $ft)
                                        <div class="desc">
                                            <p>{{ $pax[$ft['PassengerType'] - 1] }}
                                                ({{ $ft['PassengerCount'] }}x{{ ($ft['BaseFare'] + ($rt['FareBreakdown'][$i]['BaseFare'] ?? 0)) / $ft['PassengerCount'] }})
                                            </p>
                                            <p>@php
                                                $mini_total += $ft['BaseFare'] + ($rt['FareBreakdown'][$i]['BaseFare'] ?? 0);
                                                echo $ft['BaseFare'] + ($rt['FareBreakdown'][$i]['BaseFare'] ?? 0);
                                            @endphp</p>
                                        </div>
                                    @endforeach
                                </div>
                                <p class="mini_total"><span>Total</span>@php
                                    $total += $mini_total;
                                    echo $mini_total;
                                @endphp</p>
                            </div>
                            <div class="fare">
                                @php $mini_total=0; @endphp
                                <h6 class="fare_title">Tax</h6>
                                <div class="fare_desc">
                                    @foreach ($fare['FareBreakdown'] as $i => $ft)
                                        <div class="desc">
                                            <p>{{ $pax[$ft['PassengerType'] - 1] }}
                                                ({{ $ft['PassengerCount'] }}x{{ ($ft['Tax'] + ($rt['FareBreakdown'][$i]['Tax'] ?? 0)) / $ft['PassengerCount'] }})
                                            </p>
                                            <p>@php
                                                $mini_total += floor($ft['Tax'] + ($rt['FareBreakdown'][$i]['Tax'] ?? 0));
                                                echo floor($ft['Tax'] + ($rt['FareBreakdown'][$i]['Tax'] ?? 0));
                                            @endphp</p>
                                        </div>
                                    @endforeach
                                </div>
                                <p class="mini_total"><span>Total</span>@php
                                    $total += $mini_total;
                                    echo $mini_total;
                                @endphp</p>
                            </div>
                            {{-- <div class="fare">
                                @php $mini_total=0; @endphp
                                <h6 class="fare_title">Other Flight Charges</h6>
                                <div class="fare_desc">
                                    <div class="desc">
                                        <p>Flight Fuel Charge</p>
                                        <p>@php
                                            $mini_total = $fare['Fare']['OtherCharges'] + ($rt['Fare']['OtherCharges'] ?? 0);
                                            echo $mini_total;
                                        @endphp</p>
                                    </div>
                                </div>
                                <p class="mini_total"><span>Total</span>@php
                                    $total += $mini_total;
                                    echo $mini_total;
                                @endphp</p>
                            </div> --}}
                            <div class="fare">
                                <h6 class="fare_title">Meal Charges</h6>
                                <div class="fare_desc">
                                    <div class="desc">
                                        <p>Meal</p>
                                        <p>{{ $meal ?? 0 }}</p>
                                    </div>
                                </div>
                                <p class="mini_total"><span>Total</span>@php
                                    $total += $meal ?? 0;
                                    echo $meal ?? 0;
                                @endphp</p>
                            </div>
                            <div class="fare">
                                <h6 class="fare_title">Baggage</h6>
                                <div class="fare_desc">
                                    <div class="desc">
                                        <p>Bag</p>
                                        <p>{{ $bag ?? 0 }}</p>
                                    </div>
                                </div>
                                <p class="mini_total"><span>Total</span>@php
                                    $total += $bag ?? 0;
                                    echo $bag ?? 0;
                                @endphp</p>
                            </div>
                            <div class="fare">
                                <h6 class="fare_title">Seat Charges</h6>
                                <div class="fare_desc">
                                    <div class="desc">
                                        <p>Seat</p>
                                        <p>{{ $seat ?? 0 }}</p>
                                    </div>
                                </div>
                                <p class="mini_total"><span>Total</span>@php
                                    $total += $seat ?? 0;
                                    echo $seat ?? 0;
                                @endphp</p>
                            </div>
                            @if ($full_cancelation>0)
                                <div class="fare">
                                    <h6 class="fare_title">Cancellation Protection</h6>
                                    <div class="fare_desc">
                                        <div class="desc">
                                            <p>Full refund on cancellation</p>
                                            <p>{{ $full_cancelation }}</p>
                                        </div>
                                    </div>
                                    <p class="mini_total"><span>Total</span>@php
                                        $total += $full_cancelation;
                                        echo $full_cancelation;
                                    @endphp</p>
                                </div>
                            @endif
                            <div class="fare">
                                @php $mini_total=0; @endphp
                                <h6 class="fare_title">Service Charges</h6>
                                <div class="fare_desc">
                                    <div class="desc">
                                        <p>Other Charges</p>
                                        <p>
                                            @php
                                                $mini_total = floor(($fare['Fare']['TdsOnCommission'] ?? 0) + ($fare['Fare']['TdsOnPLB'] ?? 0) + ($fare['Fare']['TdsOnIncentive'] ?? 0) + ($rt['Fare']['TdsOnCommission'] ?? 0) + ($rt['Fare']['TdsOnPLB'] ?? 0) + ($rt['Fare']['TdsOnIncentive'] ?? 0) + $fare['Fare']['OtherCharges'] + ($rt['Fare']['OtherCharges'] ?? 0));
                                                $total += $mini_total;
                                                echo $mini_total;
                                            @endphp
                                        </p>
                                    </div>
                                    <div class="desc">
                                        <p>Payment Gateway</p>
                                        <p>@php
                                            $nT = floor(($total * 100) / 98);
                                            echo floor($nT - $total);
                                        @endphp</p>
                                    </div>
                                </div>
                                <p class="mini_total"><span>Total</span>@php
                                    echo $nT - $total + $mini_total;
                                    $total = $nT;
                                @endphp</p>
                            </div>
                            @if (isset($discount) && $discount > 0)
                                <div class="fare">
                                    <h6 class="fare_title">Coupon Discount</h6>
                                    <div class="fare_desc">
                                        <div class="desc">
                                            <p>Discount</p>
                                            <p>-{{ $discount }}</p>
                                        </div>
                                    </div>
                                    <p class="mini_total"><span>Total</span>@php
                                        $total -= $discount;
                                        echo $discount * -1;
                                    @endphp</p>
                                </div>
                            @endif
                            <div class="total">
                                <p>Total</p>
                                <p><i class="fa-solid fa-indian-rupee" style="font-size: 0.8em"></i> {{ $total }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" id="razorPay">Checkout</button>
            </div>
        </form>
    </main>
@endsection
@push('js')
    @includeIf('user.components.razorPay', ['order' => $order, 'redirect' => url('flight/ticket')])
    <script>
        let timer;
        let remainingTime = sessionStorage.getItem('remainingTime') || 900; // 15 minutes = 900 seconds
    
        function startTimer() {
            timer = setInterval(() => {
                if (remainingTime > 0) {
                    remainingTime--;
                    displayTimer();
                    sessionStorage.setItem('remainingTime', remainingTime);
    
                    // Show alert at 5 minutes left
                    if (remainingTime === 300) {
                        alert("5 minutes left. Please complete your booking.");
                    }
    
                    // Show alert at 2 minutes left
                    if (remainingTime === 120) {
                        alert("2 minutes left. Please complete your booking.");
                    }
    
                } else {
                    clearInterval(timer);
                    showTimeoutMessage();
                }
            }, 1000);
        }
    
        function displayTimer() {
            const minutes = Math.floor(remainingTime / 60);
            const seconds = remainingTime % 60;
            document.getElementById('timer').textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        }
    
        function showTimeoutMessage() {
            const timeoutMessage = document.createElement('div');
            timeoutMessage.id = 'timeoutMessage';
            timeoutMessage.style.position = 'fixed';
            timeoutMessage.style.top = '50%';
            timeoutMessage.style.left = '50%';
            timeoutMessage.style.transform = 'translate(-50%, -50%)';
            timeoutMessage.style.padding = '20px';
            timeoutMessage.style.backgroundColor = 'white';
            timeoutMessage.style.border = '1px solid black';
            timeoutMessage.style.zIndex = '1000';
            timeoutMessage.innerHTML = 'Booking time is over. Please make another booking.';
    
            document.body.appendChild(timeoutMessage);
    
            setTimeout(() => {
                window.location.href = '/flight';
            }, 10000); // Redirect after 10 seconds
        }
    
        window.onload = () => {
            displayTimer();
            startTimer();
        };
    </script>
@endpush
