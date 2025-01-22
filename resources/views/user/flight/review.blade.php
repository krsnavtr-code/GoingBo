@php
use Carbon\Carbon;

@endphp
@php
    $total = 0;
    $pax = ['Adults', 'Children', 'Infants'];
    $rt = $ret_data['fare']['FareBreakdown'] ?? [];
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
    // dd($fare, $pax);
    $adult = $fare['FareBreakdown'][0]['PassengerCount'];
    $child = $fare['FareBreakdown'][1]['PassengerCount'] ?? 0;
    $infant = $fare['FareBreakdown'][2]['PassengerCount'] ?? 0;
@endphp
@inject('countries', App\Models\Country::class)
@extends('user.components.layout')
@push('css')
    <link rel="stylesheet" href="{{ url('css/review_flight.css') }}">
    <style>
        .coupon:first-of-type {
            margin-top: 20px;
        }

        .coupon:not(:last-of-type) {
            border-bottom: 1px solid var(--gray_400);
        }

        .coupon {
            padding: 5px 0;
        }

        .coupon button {
            font-size: 0.7em;
            cursor: pointer;
            padding: 4px 10px;
        }

        .coupon .coupon_details {
            flex-grow: 1;
        }

        .coupon .coupon_code {
            color: var(--fv_prime);
            font-size: 0.9em;
        }

        .coupon .coupon_desc {
            color: var(--gray_600);
            font-size: 0.7em;
        }

        .coupon_btn.applied {
            background: rgba(var(--fv_sec_rgb), 0.3);
        }

        .coupon_btn.applied span:first-of-type {
            display: none;
        }

        .coupon_btn:not(.applied) span:last-of-type {
            display: none;
        }
    </style>
@endpush
@section('main')
    <main>
        <div id="timer" style="position: absolute; top: 65px; right: 65px; font-size: 24px; background-color: var(--fv_sec);"></div>
        <form class="results" method="POST" action="{{ url('flight/checkout') }}" id="myForm">
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
                @isset($ret_data)
                    <div class="panel_group flights">
                       
                        @foreach ($ret_data['fare']['Segments'][0] as $i => $segment)
                            @php
                                $airline = $segment['Airline'];
                                $origin = $segment['Origin'];
                                $destination = $segment['Destination'];
                            @endphp
                            @if ($i > 0)
                            @php
                            // dd($ret_data);
                            // Create Carbon instances for arrival and departure time
                            $arrivalDateTime = Carbon::parse($ret_data['fare']['Segments'][0][0]['Destination']['ArrTime']);
                            $departureDateTime = Carbon::parse( $ret_data['fare']['Segments'][0][1]['Origin']['DepTime']);
    
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
                @endisset

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
                            $arrivalDateTime = Carbon::parse($fare['Segments'][1][0]['Destination']['ArrTime']);
                            $departureDateTime = Carbon::parse( $fare['Segments'][1][1]['Origin']['DepTime']);

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
                                        {{ $fare['Segments'][1][count($fare['Segments'][1]) - 1]['Destination']['Airport']['AirportCode'] }}
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
                                                        <td>{{ intval($rule['From'] ?? 0) + 2 }}-{{ $rule['To'] ? $rule['To'] + 2 : 'More' }}
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
                <div class="panel">
                    <h5 class="panel_title">Travellers Details
                        <i class="text info">
                            <b>{{ $adult }} {{ $adult > 1 ? 'Adults' : 'Adult' }}</b>
                            @if ($child > 0)
                                , <b>{{ $child }} {{ $child > 1 ? 'Children' : 'Child' }}</b>
                            @endif
                            @if ($infant > 0)
                                , <b>{{ $infant }} {{ $infant > 1 ? 'Infants' : 'Infant' }}</b>
                            @endif
                        </i>
                    </h5>
                    <fieldset class="traveller">
                        @for ($i = 0; $i < $adult; $i++)
                            <div class="fields">
                                <div class="field_group">
                                    <input type="hidden" name="adult[{{ $i }}][PaxType]" value="1">
                                    <div class="field">
                                        <label for=""><b><i>Adult Traveller {{ $i + 1 }}</i></b></label>
                                        <div class="rflex" style="width: 100%;gap:5px;">
                                            <select style="padding-inline: 5px;width: 0;min-width: 60px;font-weight:600;"
                                                name="adult[{{ $i }}][Title]">
                                                <option value="Mr">Mr</option>
                                                <option value="Mrs">Ms</option>
                                                <option value="Mrs">Mrs</option>
                                            </select>
                                            <input type="text" name="adult[{{ $i }}][FirstName]"
                                                placeholder="First Name" style="flex-grow: 1" minlength="2" required>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label for="">Last Name</label>
                                        <input type="text" name="adult[{{ $i }}][LastName]"
                                            placeholder="Last Name" minlength="2" required>
                                    </div>
                                    <div class="field">
                                        <label for="">Date Of Birth</label>
                                        <input type="date" name="adult[{{ $i }}][DateOfBirth]"
                                            class="adultdob" required>
                                    </div>
                                </div>
                                @if ($passport)
                                    <div class="field_group passport">
                                        <div class="field">
                                            <label for="">Passport No.</label>
                                            <input type="text" name="adult[{{ $i }}][PassportNo]"
                                                placeholder="Passport number" required>
                                        </div>
                                        <div class="field">
                                            <label for="">Issue Date</label>
                                            <input type="date" name="adult[{{ $i }}][PassportIssueDate]"
                                                required>
                                        </div>
                                        <div class="field">
                                            <label for="">Expire Date</label>
                                            <input type="date" name="adult[{{ $i }}][PassportExpiry]"
                                                required>
                                        </div>
                                        <div class="field vu-select">
                                            <label for="">Issuing Country</label>
                                            <div class="vu-content">
                                                <input type="hidden" class="code"
                                                    name="adult[{{ $i }}][PassportIssueCountryCode]" required>
                                                <input type="text" name="country_extra" class="vu-input"
                                                    placeholder="Select Please" required>
                                            </div>
                                            <div class="vu-suggestion">
                                                @foreach ($countries::all()->toArray() as $country)
                                                    <div class="vu-option" data-value="{{ $country['country_name'] }}"
                                                        data-code="{{ $country['country_code2'] }}">
                                                        {{ $country['country_name'] }}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endfor
                    </fieldset>
                    @if ($child > 0)
                        <fieldset class="traveller">
                            @for ($i = 0; $i < $child; $i++)
                                <div class="fields">
                                    <div class="field_group">
                                        <input type="hidden" name="child[{{ $i }}][PaxType]" value="2">
                                        <div class="field">
                                            <label for=""><b><i>Child Traveller
                                                        {{ $i + 1 }}</i></b></label>
                                            <div class="rflex" style="width: 100%;gap:5px;">
                                                <select
                                                    style="padding-inline: 5px;width: 0;min-width: 60px;font-weight:600;"
                                                    name="child[{{ $i }}][Title]" id="">
                                                    <option value="Mstr">Mstr</option>
                                                    <option value="Miss">Miss</option>
                                                </select>
                                                <input type="text" name="child[{{ $i }}][FirstName]"
                                                    id="" placeholder="First Name" style="flex-grow: 1" required minlength="2">
                                            </div>
                                        </div>
                                        <div class="field">
                                            <label for="">Last Name</label>
                                            <input type="text" name="child[{{ $i }}][LastName]"
                                                placeholder="Last Name" required minlength="2">
                                        </div>
                                        <div class="field">
                                            <label for="">Date Of Birth</label>
                                            <input type="date" name="child[{{ $i }}][DateOfBirth]" required
                                                class="childdob">
                                        </div>
                                    </div>
                                    @if ($passport)
                                        <div class="field_group passport">
                                            <div class="field">
                                                <label for="">Passport No.</label>
                                                <input type="text" name="child[{{ $i }}][PassportNo]"
                                                    required placeholder="Passport number" />
                                            </div>
                                            <div class="field">
                                                <label for="">Issue Date</label>
                                                <input type="date"
                                                    name="child[{{ $i }}][PassportIssueDate]" required />
                                            </div>
                                            <div class="field">
                                                <label for="">Expire Date</label>
                                                <input type="date" name="child[{{ $i }}][PassportExpiry]"
                                                    required />
                                            </div>
                                            <div class="field vu-select">
                                                <label for="">Issuing Country</label>
                                                <div class="vu-content">
                                                    <input type="hidden" class="code"
                                                        name="child[{{ $i }}][PassportIssueCountryCode]"
                                                        required>
                                                    <input type="text" name="country_extra" class="vu-input"
                                                        placeholder="Select Please" required>
                                                </div>
                                                <div class="vu-suggestion">
                                                    @foreach ($countries::all()->toArray() as $country)
                                                        <div class="vu-option"
                                                            data-value="{{ $country['country_name'] }}"
                                                            data-code="{{ $country['country_code2'] }}">
                                                            {{ $country['country_name'] }}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endfor
                        </fieldset>
                    @endif
                    @if ($infant > 0)
                        <fieldset class="traveller">
                            @for ($i = 0; $i < $infant; $i++)
                                <div class="fields">
                                    <div class="field_group">
                                        <input type="hidden" name="infant[{{ $i }}][PaxType]"
                                            value="3">
                                        <div class="field">
                                            <label for=""><b><i>Infant Traveller
                                                        {{ $i + 1 }}</i></b></label>
                                            <div class="rflex" style="width: 100%;gap:5px;">
                                                <select
                                                    style="padding-inline: 5px;width: 0;min-width: 60px;font-weight:600;"
                                                    name="infant[{{ $i }}][Title]" id="">
                                                    <option value="Mstr">Mstr</option>
                                                    <option value="Miss">Miss</option>
                                                </select>
                                                <input type="text" name="infant[{{ $i }}][FirstName]"
                                                    id="" placeholder="First Name" style="flex-grow: 1"
                                                    minlength="2" required>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <label for="">Last Name</label>
                                            <input type="text" name="infant[{{ $i }}][LastName]"
                                                id="" placeholder="Last Name" minlength="2" required>
                                        </div>
                                        <div class="field">
                                            <label for="">Date Of Birth</label>
                                            <input type="date" name="infant[{{ $i }}][DateOfBirth]"
                                                class="infantdob" required>
                                        </div>
                                    </div>
                                    @if ($passport)
                                        <div class="field_group passport">
                                            <div class="field">
                                                <label for="">Passport No.</label>
                                                <input type="text" name="infant[{{ $i }}][PassportNo]"
                                                    required placeholder="Passport number" />
                                            </div>
                                            <div class="field">
                                                <label for="">Issue Date</label>
                                                <input type="date"
                                                    name="infant[{{ $i }}][PassportIssueDate]" required />
                                            </div>
                                            <div class="field">
                                                <label for="">Expire Date</label>
                                                <input type="date" name="infant[{{ $i }}][PassportExpiry]"
                                                    required />
                                            </div>
                                            <div class="field vu-select">
                                                <label for="">Issuing Country</label>
                                                <div class="vu-content">
                                                    <input type="hidden" class="code"
                                                        name="infant[{{ $i }}][PassportIssueCountryCode]"
                                                        required>
                                                    <input type="text" name="country_extra" class="vu-input"
                                                        placeholder="Select Please" required>
                                                </div>
                                                <div class="vu-suggestion">
                                                    @foreach ($countries::all()->toArray() as $country)
                                                        <div class="vu-option"
                                                            data-value="{{ $country['country_name'] }}"
                                                            data-code="{{ $country['country_code2'] }}">
                                                            {{ $country['country_name'] }}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endfor
                        </fieldset>
                    @endif
                </div>
                <div class="panel">
                    <h5 class="panel_title">Contact & Address</h5>
                    <p class="panel_desc">
                        <i class="text error">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            These Details will be used to create your profile
                        </i>
                    </p>
                    <fieldset class="contact">
                        <div class="field_group">
                            <div class="field">
                                <label for="">Contact</label>
                                <div class="rflex" style="width: 100%;gap:5px;">
                                    <input type="text" value="+91"
                                        style="padding-inline: 5px;width: 0;min-width: 50px;text-align: center;font-weight:600;">
                                    <input type="text" name="contact[contact]" id="" placeholder="Contact"
                                        style="flex-grow: 1" pattern="^[0-9]{10}$" required>
                                </div>
                            </div>
                            <div class="field">
                                <label for="">E-mail</label>
                                <input type="email" name="contact[mail]" placeholder="E-mail" maxlength="40" required>
                            </div>
                            <div class="field vu-select">
                                <label for="">Country</label>
                                <div class="vu-content">
                                    <input type="hidden" class="code" name="address[countryCode]" required>
                                    <input type="text" name="address[country]" class="vu-input"
                                        placeholder="Select Please" required>
                                </div>
                                <div class="vu-suggestion">
                                    @foreach ($countries::all()->toArray() as $country)
                                        <div class="vu-option" data-value="{{ $country['country_name'] }}"
                                            data-code="{{ $country['country_code2'] }}">
                                            {{ $country['country_name'] }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <i class="text info">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            Fill details carefully. These will be <b>used to send booking ticket and details</b>.
                        </i>
                    </fieldset>
                    <fieldset class="address">
                        <div class="field_group">
                            <div class="field">
                                <label for="">State</label>
                                <input type="text" name="address[state]" id="" placeholder="State" maxlength="20" required>
                            </div>
                            <div class="field">
                                <label for="">City</label>
                                <input type="text" name="address[city]" id="" placeholder="City" maxlength="20" required>
                            </div>
                            <div class="field">
                                <label for="">Address Line</label>
                                <input type="text" name="address[address]" id=""
                                    placeholder="Nearby location" maxlength="20" required>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="panel">
                    <h5 class="panel_title">Company Details <i class="text info">(Optional)</i></h5>
                    <i class="text info">For <b>GST</b> Purpose</i>
                    <fieldset class="company">
                        <div class="field_group">
                            <div class="field">
                                <label for="">Company Name</label>
                                <input type="text" name="company[companyName]" id=""
                                    placeholder="Company Name" pattern="[A-Za-z\s]*" maxlength="40">
                            </div>
                            <div class="field">
                                <label for="">GST Number</label>
                                <input type="text" name="company[companyGST]" id=""
                                    placeholder="GST Number" pattern="[0-9]*" maxlength="20">
                            </div>
                        </div>
                        <div class="field_group">
                            <div class="field">
                                <label for="">Company E-mail</label>
                                <input type="email" name="company[companyMail]" id=""
                                    placeholder="Company E-mail" maxlength="40">
                            </div>
                            <div class="field">
                                <label for="">Company Contact</label>
                                <input type="text" name="company[companyContact]" id=""
                                    placeholder="Company Cotact" pattern="^[0-9]{10}$" class="contact">
                            </div>
                        </div>
                        <div class="field">
                            <label for="">Company Address</label>
                            <input type="text" name="company[companyAddress]" id=""
                                placeholder="Company Address" maxlength="40">
                        </div>
                    </fieldset>
                </div>
                @if (isset($ssr['MealDynamic']) ||
                        isset($ssr['Baggage']) ||
                        isset($ssr['SeatDynamic']) ||
                        isset($ret_data['ssr']['MealDynamic']) ||
                        isset($ret_data['ssr']['Baggage']) ||
                        isset($ret_data['ssr']['SeatDynamic']))
                    <div class="panel">
                        <h5 class="panel_title">Add On <i class="text info">(Baggage, Meal, Seat)</i></h5>
                        <p class="panel_desc">
                            <i class="text info">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                                These Add-on are optional. There are for your <b>comfortable journey</b>.
                            </i>
                        </p>
                        @isset($ret_data)
                            <div class="btn_group addon_group">
                                <button type="button" class="active" data-for="dep_addon">
                                    {{ $fare['Segments'][0][0]['Origin']['Airport']['AirportCode'] }} -
                                    {{ $fare['Segments'][0][count($fare['Segments'][0]) - 1]['Destination']['Airport']['AirportCode'] }}
                                </button>
                                <button type="button" data-for="ret_addon">
                                    {{ $ret_data['fare']['Segments'][0][0]['Origin']['Airport']['AirportCode'] }} -
                                    {{ $ret_data['fare']['Segments'][0][count($ret_data['fare']['Segments'][0]) - 1]['Destination']['Airport']['AirportCode'] }}
                                </button>
                            </div>
                        @endisset
                        <div class="addon" id="dep_addon">
                            <i class="info text">{{ $fare['Segments'][0][0]['Origin']['Airport']['AirportCode'] }} -
                                {{ $fare['Segments'][0][count($fare['Segments'][0]) - 1]['Destination']['Airport']['AirportCode'] }}</i>
                            <fieldset class="traveller">
                                @for ($i = 0; $i < $adult; $i++)
                                    <div class="field_group">
                                        @isset($ssr['MealDynamic'])
                                            <div class="field">
                                                <label for=""><b><i>Adult Traveller {{ $i + 1 }}
                                                            Meal</i></b></label>
                                                <select name="adult[{{ $i }}][dep_meal]" id="">
                                                    @foreach ($ssr['MealDynamic'][0] as $j => $meal)
                                                        <option value="{{ $j }}">
                                                            <b>{{ $meal['Currency'] . ' ' . $meal['Price'] }}</b> -
                                                            {{ $meal['AirlineDescription'] ?? $meal['Description'] ?: 'No Meal' }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endisset
                                        @isset($ssr['Baggage'])
                                            <div class="field">
                                                <label for=""><b><i>Baggage</i></b></label>
                                                <select name="adult[{{ $i }}][dep_bag]" id="">
                                                    @foreach ($ssr['Baggage'][0] as $j => $bag)
                                                        <option value="{{ $j }}">{{ $bag['Weight'] }}KG -
                                                            {{ $bag['Currency'] . ' ' . $bag['Price'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endisset
                                        @isset($ssr['SeatDynamic'])
                                            <div class="rflex aic" style="gap:4px;">
                                                @foreach ($ssr['SeatDynamic'][0]['SegmentSeat'] as $j => $seg)
                                                    <div class="seat_plane dep_seat_plane" data-index="{{ $j }}">
                                                        <input type="hidden"
                                                            name="dep_seats[{{ $i }}][{{ $j }}]">
                                                    </div>
                                                @endforeach
                                                <button class="seat dep_seats" type="button">Book Seat</button>
                                            </div>
                                        @endisset
                                    </div>
                                @endfor
                            </fieldset>

                                                
                            @if ($child > 0)
                                <fieldset class="traveller">
                                    @for ($i = 0; $i < $child; $i++)
                                        <div class="field_group">
                                            @isset($ssr['MealDynamic'])
                                                <div class="field">
                                                    <label for=""><b><i>Meal</i></b></label>
                                                    <select name="child[{{ $i }}][dep_meal]" id="">
                                                        @foreach ($ssr['MealDynamic'][0] as $j => $meal)
                                                            <option value="{{ $j }}">
                                                                <b>{{ $meal['Currency'] . ' ' . $meal['Price'] }}</b> -
                                                                {{ $meal['AirlineDescription'] ?? $meal['Description'] ?: 'No Meal' }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endisset
                                            @isset($ssr['Baggage'])
                                                <div class="field">
                                                    <label for=""><b><i>Child Traveller {{ $i + 1 }}
                                                                Baggage</i></b></label>
                                                    <select name="child[{{ $i }}][dep_bag]" id="">
                                                        @foreach ($ssr['Baggage'][0] as $j => $bag)
                                                            <option value="{{ $j }}">{{ $bag['Weight'] }}KG -
                                                                {{ $bag['Currency'] . $bag['Price'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endisset
                                            @isset($ssr['SeatDynamic'])
                                                <div class="rflex aic" style="gap:4px;">
                                                    @foreach ($ssr['SeatDynamic'][0]['SegmentSeat'] as $j => $seg)
                                                        <div class="seat_plane dep_seat_plane"
                                                            data-index="{{ $j }}">
                                                            <input type="hidden"
                                                                name="dep_seats[{{ $adult + $i }}][{{ $j }}]">
                                                        </div>
                                                    @endforeach
                                                    <button class="seat dep_seats" type="button">Book Seat</button>
                                                </div>
                                            @endisset
                                        </div>
                                    @endfor
                                </fieldset>
                            @endif
                            @if ($infant > 0 && isset($ssr['MealDynamic']))
                                <fieldset class="traveller">
                                    @for ($i = 0; $i < $infant; $i++)
                                        <div class="field_group">
                                            <div class="field">
                                                <label for=""><b><i>Infant Traveller {{ $i + 1 }}
                                                            Meal</i></b></label>
                                                <select name="infant[{{ $i }}][dep_meal]" id="">
                                                    @foreach ($ssr['MealDynamic'][0] as $j => $meal)
                                                        <option value="{{ $j }}">
                                                            <b>{{ $meal['Currency'] . ' ' . $meal['Price'] }}</b> -
                                                            {{ $meal['AirlineDescription'] ?? $meal['Description'] ?: 'No Meal' }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <i class="text info">
                                            <i class="fa-solid fa-triangle-exclamation"></i>
                                            Infant can not acquire seat and carry baggage.
                                        </i>
                                    @endfor
                                </fieldset>
                            @endif
                        </div>

                        @isset($ssr['MealDynamic'][1])
                        <div class="addon" id="dep_addon">
                            <i class="info text">{{ $fare['Segments'][1][0]['Origin']['Airport']['AirportCode'] }} -
                                {{ $fare['Segments'][1][count($fare['Segments'][1]) - 1]['Destination']['Airport']['AirportCode'] }}</i>
                            <fieldset class="traveller">
                                @for ($i = 0; $i < $adult; $i++)
                                    <div class="field_group">
                                        @isset($ssr['MealDynamic'])
                                            <div class="field">
                                                <label for=""><b><i>Adult Traveller {{ $i + 1 }}
                                                            Meal</i></b></label>
                                                <select name="adult[{{ $i }}][dep_meal]" id="">
                                                    @foreach ($ssr['MealDynamic'][1] as $j => $meal)
                                                        <option value="{{ $j }}">
                                                            <b>{{ $meal['Currency'] . ' ' . $meal['Price'] }}</b> -
                                                            {{ $meal['AirlineDescription'] ?? $meal['Description'] ?: 'No Meal' }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endisset
                                        @isset($ssr['Baggage'])
                                            <div class="field">
                                                <label for=""><b><i>Baggage</i></b></label>
                                                <select name="adult[{{ $i }}][dep_bag]" id="">
                                                    @foreach ($ssr['Baggage'][0] as $j => $bag)
                                                        <option value="{{ $j }}">{{ $bag['Weight'] }}KG -
                                                            {{ $bag['Currency'] . ' ' . $bag['Price'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endisset
                                        @isset($ssr['SeatDynamic'])
                                            <div class="rflex aic" style="gap:4px;">
                                                @foreach ($ssr['SeatDynamic'][0]['SegmentSeat'] as $j => $seg)
                                                    <div class="seat_plane dep_seat_plane" data-index="{{ $j }}">
                                                        <input type="hidden"
                                                            name="dep_seats[{{ $i }}][{{ $j }}]">
                                                    </div>
                                                @endforeach
                                                <button class="seat dep_seats" type="button">Book Seat</button>
                                            </div>
                                        @endisset
                                    </div>
                                @endfor
                            </fieldset>

                                                
                            @if ($child > 0)
                                <fieldset class="traveller">
                                    @for ($i = 0; $i < $child; $i++)
                                        <div class="field_group">
                                            @isset($ssr['MealDynamic'])
                                                <div class="field">
                                                    <label for=""><b><i>Meal</i></b></label>
                                                    <select name="child[{{ $i }}][dep_meal]" id="">
                                                        @foreach ($ssr['MealDynamic'][0] as $j => $meal)
                                                            <option value="{{ $j }}">
                                                                <b>{{ $meal['Currency'] . ' ' . $meal['Price'] }}</b> -
                                                                {{ $meal['AirlineDescription'] ?? $meal['Description'] ?: 'No Meal' }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endisset
                                            @isset($ssr['Baggage'])
                                                <div class="field">
                                                    <label for=""><b><i>Child Traveller {{ $i + 1 }}
                                                                Baggage</i></b></label>
                                                    <select name="child[{{ $i }}][dep_bag]" id="">
                                                        @foreach ($ssr['Baggage'][0] as $j => $bag)
                                                            <option value="{{ $j }}">{{ $bag['Weight'] }}KG -
                                                                {{ $bag['Currency'] . $bag['Price'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endisset
                                            @isset($ssr['SeatDynamic'])
                                                <div class="rflex aic" style="gap:4px;">
                                                    @foreach ($ssr['SeatDynamic'][0]['SegmentSeat'] as $j => $seg)
                                                        <div class="seat_plane dep_seat_plane"
                                                            data-index="{{ $j }}">
                                                            <input type="hidden"
                                                                name="dep_seats[{{ $adult + $i }}][{{ $j }}]">
                                                        </div>
                                                    @endforeach
                                                    <button class="seat dep_seats" type="button">Book Seat</button>
                                                </div>
                                            @endisset
                                        </div>
                                    @endfor
                                </fieldset>
                            @endif
                            @if ($infant > 0 && isset($ssr['MealDynamic']))
                                <fieldset class="traveller">
                                    @for ($i = 0; $i < $infant; $i++)
                                        <div class="field_group">
                                            <div class="field">
                                                <label for=""><b><i>Infant Traveller {{ $i + 1 }}
                                                            Meal</i></b></label>
                                                <select name="infant[{{ $i }}][dep_meal]" id="">
                                                    @foreach ($ssr['MealDynamic'][0] as $j => $meal)
                                                        <option value="{{ $j }}">
                                                            <b>{{ $meal['Currency'] . ' ' . $meal['Price'] }}</b> -
                                                            {{ $meal['AirlineDescription'] ?? $meal['Description'] ?: 'No Meal' }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <i class="text info">
                                            <i class="fa-solid fa-triangle-exclamation"></i>
                                            Infant can not acquire seat and carry baggage.
                                        </i>
                                    @endfor
                                </fieldset>
                            @endif
                        </div>
                        @endisset
                        @isset($ret_data)
                            <div class="addon hide" id="ret_addon">
                                <i class="text info">
                                    {{ $ret_data['fare']['Segments'][0][0]['Origin']['Airport']['AirportCode'] }} -
                                    {{ $ret_data['fare']['Segments'][0][count($ret_data['fare']['Segments'][0]) - 1]['Destination']['Airport']['AirportCode'] }}</i>
                                <fieldset class="traveller">
                                    @for ($i = 0; $i < $adult; $i++)
                                        <div class="field_group">
                                            @isset($ret_data['ssr']['MealDynamic'])
                                                <div class="field">
                                                    <label for=""><b><i>Adult Traveller {{ $i + 1 }}
                                                                Meal</i></b></label>
                                                    <select name="adult[{{ $i }}][ret_meal]" id="">
                                                        @foreach ($ret_data['ssr']['MealDynamic'][0] as $j => $meal)
                                                            <option value="{{ $j }}">
                                                                <b>{{ $meal['Currency'] . ' ' . $meal['Price'] }}</b> -
                                                                {{ $meal['AirlineDescription'] ?? $meal['Description'] ?: 'No Meal' }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endisset
                                            @isset($ret_data['ssr']['Baggage'])
                                                <div class="field">
                                                    <label for=""><b><i>Baggage</i></b></label>
                                                    <select name="adult[{{ $i }}][ret_bag]" id="">
                                                        @foreach ($ret_data['ssr']['Baggage'][0] as $j => $bag)
                                                            <option value="{{ $j }}">{{ $bag['Weight'] }}KG -
                                                                {{ $bag['Currency'] . ' ' . $bag['Price'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endisset
                                            @isset($ret_data['ssr']['SeatDynamic'])
                                                <div class="rflex aic" style="gap:4px;">
                                                    @foreach ($ret_data['ssr']['SeatDynamic'][0]['SegmentSeat'] as $j => $seg)
                                                        <div class="seat_plane ret_seat_plane" data-index="{{ $j }}">
                                                            <input type="hidden"
                                                                name="ret_seats[{{ $i }}][{{ $j }}]">
                                                        </div>
                                                    @endforeach
                                                    <button class="seat ret_seats" type="button">Book Seat</button>
                                                </div>
                                            @endisset
                                        </div>
                                    @endfor
                                </fieldset>
                                @if ($child > 0)
                                    <fieldset class="traveller">
                                        @for ($i = 0; $i < $child; $i++)
                                            <div class="field_group">
                                                @isset($ssr['MealDynamic'])
                                                    <div class="field">
                                                        <label for=""><b><i>Meal</i></b></label>
                                                        <select name="child[{{ $i }}][ret_meal]" id="">
                                                            @foreach ($ssr['MealDynamic'][0] as $j => $meal)
                                                                <option value="{{ $j }}">
                                                                    <b>{{ $meal['Currency'] . ' ' . $meal['Price'] }}</b> -
                                                                    {{ $meal['AirlineDescription'] ?? $meal['Description'] ?: 'No Meal' }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endisset
                                                @isset($ssr['Baggage'])
                                                    <div class="field">
                                                        <label for=""><b><i>Child Traveller {{ $i + 1 }}
                                                                    Baggage</i></b></label>
                                                        <select name="child[{{ $i }}][ret_bag]" id="">
                                                            @foreach ($ssr['Baggage'][0] as $j => $bag)
                                                                <option value="{{ $j }}">{{ $bag['Weight'] }}KG -
                                                                    {{ $bag['Currency'] . $bag['Price'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endisset
                                                @isset($ret_data['ssr']['SeatDynamic'])
                                                    <div class="rflex aic" style="gap:4px;">
                                                        @foreach ($ret_data['ssr']['SeatDynamic'][0]['SegmentSeat'] as $j => $seg)
                                                            <div class="seat_plane ret_seat_plane"
                                                                data-index="{{ $j }}">
                                                                <input type="hidden"
                                                                    name="dep_seats[{{ $adult + $i }}][{{ $j }}]">
                                                            </div>
                                                        @endforeach
                                                        <button class="seat ret_seats" type="button">Book Seat</button>
                                                    </div>
                                                @endisset
                                            </div>
                                        @endfor
                                    </fieldset>
                                @endif
                                @if ($infant > 0 && isset($ssr['MealDynamic']))
                                    <fieldset class="traveller">
                                        @for ($i = 0; $i < $infant; $i++)
                                            <div class="field_group">
                                                <div class="field">
                                                    <label for=""><b><i>Infant Traveller {{ $i + 1 }}
                                                                Meal</i></b></label>
                                                    <select name="infant[{{ $i }}][ret_meal]" id="">
                                                        @foreach ($ssr['MealDynamic'][0] as $j => $meal)
                                                            <option value="{{ $j }}">
                                                                <b>{{ $meal['Currency'] . ' ' . $meal['Price'] }}</b> -
                                                                {{ $meal['AirlineDescription'] ?? $meal['Description'] ?: 'No Meal' }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <i class="text info">
                                                <i class="fa-solid fa-triangle-exclamation"></i>
                                                Infant can not acquire seat and carry baggage.
                                            </i>
                                        @endfor
                                    </fieldset>
                                @endif
                            </div>
                        @endisset
                    </div>
                @endif
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
                                                ({{ $ft['PassengerCount'] }}x{{ ($ft['BaseFare'] + ($rt[$i]['BaseFare'] ?? 0)) / $ft['PassengerCount'] }})
                                            </p>
                                            <p>@php
                                                $mini_total += $ft['BaseFare'] + ($rt[$i]['BaseFare'] ?? 0);
                                                echo $ft['BaseFare'] + ($rt[$i]['BaseFare'] ?? 0);
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
                                                ({{ $ft['PassengerCount'] }}x{{ ($ft['Tax'] + ($rt[$i]['Tax'] ?? 0)) / $ft['PassengerCount'] }})
                                            </p>
                                            <p>@php
                                                $mini_total = floor($ft['Tax'] + ($rt[$i]['Tax'] ?? 0));
                                                echo $mini_total;
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
                                <h6 class="fare_title">Other Flight Charges</h6>
                                <div class="fare_desc">
                                    <div class="desc">
                                        <p>Flight Fuel Charge</p>
                                        <p>{{ $fare['Fare']['OtherCharges'] }}</p>
                                    </div>
                                </div>
                                <p class="mini_total"><span>Total</span>@php
                                    $total += $fare['Fare']['OtherCharges'];
                                    echo $fare['Fare']['OtherCharges'];
                                @endphp</p>
                            </div> --}}
                            <div class="total">
                                <p>Total</p>
                                <p>{{ $total }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <h5 class="panel_title">Discount Coupons</h5>
                        <div class="coupons">
                            <input type="hidden" name="coupon_code" id="coupon_code">
                            @foreach ($coupons as $coupon)
                                <div class="coupon rflex aic">
                                    <div class="coupon_details">
                                        <h6 class="coupon_code">
                                            {{ $coupon['coupon_code'] }}
                                        </h6>
                                        <p class="coupon_desc">
                                            {{ $coupon['coupon_desc'] }}
                                        </p>
                                    </div>
                                    <button type="button" data-coupon="{{ $coupon['coupon_code'] }}"
                                        class="coupon_btn"><span>Apply</span><span>Applied</span></button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <label for="refund_box" class="rflex aic"><input type="checkbox" name="full_refund" id="refund_box"
                        value="1"><span style="margin-left: 5px;font-size:0.8em;font-weight:600;">Pay INR440 (per person) extra for
                        full refund on cancellation</span></label>
                <button type="submit">Book Ticket</button>
            </div>
        </form>
    </main>
@endsection
@push('popup')
    @isset($ssr['SeatDynamic'])
        <div id="departure_seat_layouts" class="seat_layouts">
            @php $deps=[]; @endphp
            @foreach ($ssr['SeatDynamic'][0]['SegmentSeat'] as $i => $flight)
                @php $deps[]=$flight['RowSeats'][0]['Seats'][0]['Origin']."-".$flight['RowSeats'][0]['Seats'][0]['Destination']; @endphp
                <div @class(['seat_layout', 'active' => $i == 0])>
                    <div class="seats">
                        @foreach ($flight['RowSeats'] as $j => $row)
                            @if ($j != 0 && $flight['RowSeats'][$j - 1]['Seats'][0]['Deck'] != $row['Seats'][0]['Deck'])
                                <div class="deck_gap" style="height:
                            15px"></div>
                            @endif
                            @php $seats=count($row['Seats']); @endphp
                            <div class="seat_row">
                                @foreach ($row['Seats'] as $k => $seat)
                                    @if ($k == 3 || $k == $seats - 3)
                                        <div class="gallery"></div>
                                    @endif
                                    <x-seat :seat="$seat" type="dep" :index="$i"
                                        seatCode="{{ $j }}-{{ $k }}"></x-seat>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                    <div class="info cflex">
                        <div class="design_info cflex">
                            <div class="rflex aic" style="gap:10px">
                                <div class="seat">
                                    <div class="seat_design"></div>
                                </div>
                                <p>Paid Seat</p>
                            </div>
                            <div class="rflex aic" style="gap:10px">
                                <div class="seat booked">
                                    <div class="seat_design"><i class="fa-solid fa-xmark"></i></div>
                                </div>
                                <p>Booked Seat</p>
                            </div>
                            <div class="rflex aic" style="gap:10px">
                                <div class="seat free">
                                    <div class="seat_design"><span>7F</span></div>
                                </div>
                                <p>Free Seat</p>
                            </div>
                            <div class="rflex aic" style="gap:10px">
                                <div class="seat selected">
                                    <div class="seat_design"><span>7F</span></div>
                                </div>
                                <p>Selected Seat</p>
                            </div>
                        </div>
                        <div class="selected_info">
                            <h6>{{ $deps[count($deps) - 1] }}</h6>
                            @for ($x = 0; $x < $adult + $child; $x++)
                                <div class="pax_seat rflex jcsb aic">
                                    <input type="hidden" name="dep_seats[{{ $i }}][{{ $x }}]">
                                    <p style="font-size: 0.8em;font-weight: 600;">Pax {{ $x + 1 }}</p>
                                    <p style="font-size: 0.7em;">
                                        <span class="seat_code">---</span> -
                                        <span class="seat_price">---</span>rs
                                    </p>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            @endforeach
            @if (count($deps) > 1)
                <div class="btn_group flight_layout_buttons">
                    @foreach ($deps as $i => $depp)
                        <button type="button" @class(['btn', 'active' => $i == 0])
                            data-index="{{ $i }}">{{ $depp }}</button>
                    @endforeach
                </div>
            @endif
        </div>
    @endisset
    @isset($ret_data['ssr']['SeatDynamic'])
        <div id="return_seat_layouts" class="seat_layouts">
            @php $rets=[]; @endphp
            @foreach ($ret_data['ssr']['SeatDynamic'][0]['SegmentSeat'] as $i => $flight)
                @php $rets[]=$flight['RowSeats'][0]['Seats'][0]['Origin']."-".$flight['RowSeats'][0]['Seats'][0]['Destination']; @endphp
                <div @class(['seat_layout', 'active' => $i == 0])>
                    <div class="seats">
                        @foreach ($flight['RowSeats'] as $j => $row)
                            @if ($j != 0 && $flight['RowSeats'][$j - 1]['Seats'][0]['Deck'] != $row['Seats'][0]['Deck'])
                                <div class="deck_gap" style="height:
                            15px"></div>
                            @endif
                            @php $seats=count($row['Seats']); @endphp
                            <div class="seat_row">
                                @foreach ($row['Seats'] as $k => $seat)
                                    @if ($k == 3 || $k == $seats - 3)
                                        <div class="gallery"></div>
                                    @endif
                                    <x-seat :seat="$seat" type="ret" :index="$i"
                                        seatCode="{{ $j }}-{{ $k }}"></x-seat>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                    <div class="info cflex">
                        <div class="design_info cflex">
                            <div class="rflex aic" style="gap:10px">
                                <div class="seat">
                                    <div class="seat_design"></div>
                                </div>
                                <p>Paid Seat</p>
                            </div>
                            <div class="rflex aic" style="gap:10px">
                                <div class="seat booked">
                                    <div class="seat_design"><i class="fa-solid fa-xmark"></i></div>
                                </div>
                                <p>Booked Seat</p>
                            </div>
                            <div class="rflex aic" style="gap:10px">
                                <div class="seat free">
                                    <div class="seat_design"><span>7F</span></div>
                                </div>
                                <p>Free Seat</p>
                            </div>
                            <div class="rflex aic" style="gap:10px">
                                <div class="seat selected">
                                    <div class="seat_design"><span>7F</span></div>
                                </div>
                                <p>Selected Seat</p>
                            </div>
                        </div>
                        <div class="selected_info">
                            <h6>{{ $rets[count($rets) - 1] }}</h6>
                            @for ($x = 0; $x < $adult + $child; $x++)
                                <div class="pax_seat rflex jcsb aic">
                                    <p style="font-size: 0.8em;font-weight: 600;">Pax {{ $x + 1 }}</p>
                                    <p style="font-size: 0.7em;">
                                        <span class="seat_code">---</span> -
                                        <span class="seat_price">---</span>rs
                                    </p>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            @endforeach
            @if (count($rets) > 1)
                <div class="btn_group flight_layout_buttons">
                    @foreach ($rets as $i => $depp)
                        <button type="button" @class(['btn', 'active' => $i == 0])
                            data-index="{{ $i }}">{{ $depp }}</button>
                    @endforeach
                </div>
            @endif
        </div>
    @endisset
@endpush
@push('js')
    <script src="{{ url('js/vu-select.js') }}"></script>
    <script>
        // $('#myForm').addEventListener('submit', function(e) {
        //     if (!$("#refund_box").checked) {
        //         if (!confirm("Do you really want to proceed without cancellation protection")) {
        //             e.preventDefault();
        //         }
        //     }
        // })
        let max_seats = {{ $adult + $child }};
        $(".vu-select").forEach(select => {
            new vu_select(select, {
                limit: 6
            });
        });

        function oldDate(years) {
            let today = new Date();
            today.setFullYear(today.getFullYear() - years);
            return today.toISOString().slice(0, 10);
        }
        var today = new Date();
        var infant = today;
        var infant = today;
        $('.infantdob').perform((x) => {
            x.set('max', today.toISOString().slice(0, 10));
            x.set('min', oldDate(2));
        })
        $('.childdob').perform((x) => {
            x.set('min', oldDate(12));
            x.set('max', oldDate(2));
        })
        $('.adultdob').perform((x) => {
            x.set('max', oldDate(12));
        })
        if ($(".addon_group")[0]) {
            $(".addon_group")[0].addEventListener('click', function() {
                this.$('button').perform((x) => {
                    if (x.hasClass('active')) {
                        x.removeClass('active');
                        $("#" + x.get('data-for')).addClass('hide');
                    } else {
                        x.addClass('active');
                        $("#" + x.get('data-for')).removeClass('hide');
                    }
                })
            })
        }
        if ($('#departure_seat_layouts')) {
            let dep_popup = new Popup($('#departure_seat_layouts'));
            $('.dep_seats').perform((x) => {
                x.addEventListener('click', function() {
                    dep_popup.show_popup();
                })
            })
        }
        if ($('#return_seat_layouts')) {
            let ret_popup = new Popup($('#return_seat_layouts'));
            $('.ret_seats').perform((x) => {
                x.addEventListener('click', function() {
                    ret_popup.show_popup();
                })
            })
        }

        function choose_seat(seat, code, price) {
            if (seat.hasClass('booked')) {
                alert('Seat has already been booked by other passenger');
                return;
            }
            seat.toggleClass('selected');
            let layout = seat.closest(".seat_layout");
            let paxs = layout.$('.pax_seat');
            let selected = layout.$('.seats .selected');
            if (seat.hasClass('selected')) {
                let updated = false;
                for (let j = 0; j < paxs.length; j++) {
                    let input_box = $(`.${seat.get('data-type')}_seat_plane[data-index="${seat.get('data-index')}"]`)[j];
                    let input = input_box.$('input')[0];
                    if (!input.value) {
                        input.value = seat.get('data-seatCode');
                        paxs[j].$('.seat_code')[0].innerText = code;
                        paxs[j].$('.seat_price')[0].innerText = price;
                        input_box.insert(2, `<span>${code}</span>`);
                        updated = true;
                        break;
                    }
                }
                if (!updated) {
                    let j = Number(layout.get('data-update')) % max_seats;
                    let input_box = $(`.${seat.get('data-type')}_seat_plane[data-index="${seat.get('data-index')}"]`)[j];
                    let input = input_box.$('input')[0];
                    layout.$('.seats .seat').perform((x) => {
                        if (x.get('data-seatCode') == input.value) {
                            x.removeClass('selected');
                        }
                    });
                    input.value = seat.get('data-seatCode');
                    paxs[j].$('.seat_code')[0].innerText = code;
                    paxs[j].$('.seat_price')[0].innerText = price;
                    input_box.$('span')[0].innerText = code;
                }
            } else {
                for (let j = 0; j < paxs.length; j++) {
                    let input_box = $(`.${seat.get('data-type')}_seat_plane[data-index="${seat.get('data-index')}"]`)[j];
                    let input = input_box.$('input')[0];
                    if (input.value == seat.get('data-seatCode')) {
                        input.value = '';
                        paxs[j].$('.seat_code')[0].innerText = '---';
                        paxs[j].$('.seat_price')[0].innerText = '---';
                        input_box.$('span')[0].remove();
                        break;
                    }
                }
            }
            layout.set('data-update', Number(layout.get('data-update') ?? 0) + 1)
        }
        $('.flight_layout_buttons').perform((x) => {
            x.addEventListener('click', () => {
                let layouts = x.closest('.seat_layouts').$('.seat_layout');
                x.$('button').perform((y, i) => {
                    let layout = layouts[i];
                    if (y.hasClass('active')) {
                        layout.removeClass('active');
                        y.removeClass('active');
                    } else {
                        layout.addClass('active');
                        y.addClass('active');
                    }
                })
            })
        })

        $('.coupon_btn').perform((n, i, no) => {
            n.addEventListener('click', () => {
                no.perform((x) => {
                    if (x != n) {
                        x.removeClass('applied');
                    } else {
                        x.addClass('applied');
                    }
                });
                $("#coupon_code").value = n.get('data-coupon');
            });
        });
    </script>
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
