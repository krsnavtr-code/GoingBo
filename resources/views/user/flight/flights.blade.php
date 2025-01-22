
@extends('user.components.layout')
@php
    if (!function_exists('air_date')) {
        function air_date($d)
        {
            $da = explode('-', substr($d, 0, 10));
            preg_match('/T(.*):/', $d, $t);
            return '<p>' . $t[1] . '<span>' . $da[2] . '-' . $da[1] . '-' . $da[0] . '</span></p>';
        }
    }
@endphp
@push('css')
    <link rel="stylesheet" href="{{ url('css/view_flights.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>

@endpush

@section('main')
    <main>
        <div class="update_search">
            <form action="{{ Request::url() }}" method="get">
                <div class="trip_types">
                    <label for="po1" class="trip_type"><input type="radio" name="journey_type" id="po1"
                            value="1" @checked($req['journey_type'] == 1)> One Way </label>
                    <label for="po2" class="trip_type"><input type="radio" name="journey_type" id="po2"
                            value="2" @checked($req['journey_type'] == 2)> Round Trip </label>
                </div>



                <div class="update-search-bar">
                                <div class="vu-select">
                                    <div class="vu-content">
                                        <label for="">From</label>
                                        <input type="text" name="from" placeholder="Enter City " class="vu-input"
                                            value="{{ $req['origin'] }}">
                                    </div>
                                    <div class="vu-suggestion"></div>
                                </div>
                                <div class="vu-select">
                                    <div class="vu-content">
                                        <label for="">To</label>
                                        <input type="text" name="to" placeholder="Enter City " class="vu-input"
                                            value="{{ $req['destination'] }}">
                                    </div>
                                    <div class="vu-suggestion"></div>
                                </div>
                                <div class="vu-date">
                                    <div class="vu-content">
                                        <label for="">Departure</label>
                                        <input type="date" name="dep_date" id="dep_date"
                                            value="{{ $req['departure_date'] }}">
                                    </div>
                                    <div class="vu-suggestion"></div>
                                </div>
                                <div class="vu-date">
                                    <div class="vu-content">
                                        <label for="">Return</label>
                                        <input type="date" name="ret_date" id="ret_date"
                                            value="{{ $req['return_date'] }}" min="{{ $req['departure_date'] }}">
                                    </div>
                                    <div class="vu-suggestion"></div>
                                </div>
                        <div class="field pax">
                            <div class="paxs">
                                <div class="vu-content">
                                    <label for="">Travellers and class</label>
                                    <h6 id="pass_det">1 Passenger, <span>Economy</span></h6>
                                </div>
                                <div class="pax_box">
                                    <div class="counters rflex">
                                        <div class="count-wrap">
                                            <h6 class="counter_title">Adults</h6>
                                            <p class="counter_desc">(above 12 years)</p>
                                            <div class="counter">
                                                <i class="fa-solid fa-minus"></i>
                                                <input type="number" name="adult" id="adult_pax" value="1">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                        <div class="count-wrap">
                                            <h6 class="counter_title">Children</h6>
                                            <p class="counter_desc">(2-12 years)</p>
                                            <div class="counter">
                                                <i class="fa-solid fa-minus"></i>
                                                <input type="number" name="child" id="child_pax" value="0">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                        <div class="count-wrap">
                                            <h6 class="counter_title">Infants</h6>
                                            <p class="counter_desc">(0-2 years)</p>
                                            <div class="counter">
                                                <i class="fa-solid fa-minus"></i>
                                                <input type="number" name="infant" id="infant_pax" value="0">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flight_classes rflex wrap">
                                        <div class="flight_class col-6">
                                            <input type="radio" name="travelclass" value="1" id="iop0"
                                                checked>
                                            <label for="iop0">All</label>
                                        </div>
                                        <div class="flight_class col-6">
                                            <input type="radio" name="travelclass" value="2" id="iop1">
                                            <label for="iop1">Economy</label>
                                        </div>
                                        <div class="flight_class col-6">
                                            <input type="radio" name="travelclass" value="3" id="iop2">
                                            <label for="iop2">Premium Economy</label>
                                        </div>
                                        <div class="flight_class col-6">
                                            <input type="radio" name="travelclass" value="4" id="iop3">
                                            <label for="iop3">Business</label>
                                        </div>
                                        <div class="flight_class col-6">
                                            <input type="radio" name="travelclass" value="5" id="iop4">
                                            <label for="iop4">Premium Business</label>
                                        </div>
                                        <div class="flight_class col-6">
                                            <input type="radio" name="travelclass" value="6" id="iop5">
                                            <label for="iop5">First Class</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="update-btn"> UPDATE SEARCH </button>
                        </div>

                </div>



                <div class="fare_type_box rflex aic jcsb wrap">
                    <div class="aic">
                        <p>Fare Type :</p>
                        <div class="fare_types rflex wrap">
                            <div class="fare_type">
                                <input type="radio" name="fare_type" id="f1" checked value="1">
                                <label for="f1">Regular</label>
                            </div>
                            <div class="fare_type">
                                <input type="radio" name="fare_type" id="f2" value="4">
                                <label for="f2">Armed Forces</label>
                            </div>
                            <div class="fare_type">
                                <input type="radio" name="fare_type" id="f3" value="5">
                                <label for="f3">Senior Citizen</label>
                            </div>
                            <div class="fare_type">
                                <input type="radio" name="fare_type" id="f4" value="3">
                                <label for="f4">Student</label>
                            </div>
                            <div class="fare_type">
                                <input type="radio" name="fare_type" id="f5" value="2">
                                <label for="f5">Doctors & Nurses</label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @if ($success)
            <div class="results">
                
                    @php
                        // dd($flights);
                        // $segments = $flights[0][0]['Segments'];
                        // dd($segments);
                    @endphp

                    {{-- For Domestic Round Trip  --}}
                    @if (isset($flights[1]))
                    <div class="main_content round cflex">
                        <div class="scroller">
                            <button id="prev"> <i class="fa-solid fa-angle-left"></i> </button>
                            <ul class="scroll-box" id="scroll-box"></ul>
                            <button id="next"> <i class="fa-solid fa-angle-down"></i> </button>
                        </div>
                        <div class="flight_wrapper rflex" style="gap:20px;">
                            <div class="flights cflex" style="flex-grow: 1;">
                                <div class="header_bar rflex jcsb">
                                    <p class="result_count">Showing <span>{{ count($flights[0]) }}</span> results</p>
                                </div>
                                @foreach ($flights[0] as $i => $flight)
                                    @php
                                        $airline = $flight['Segments'][0][0]['Airline'];
                                        $origin = $flight['Segments'][0][0]['Origin'];
                                        $destination =
                                            $flight['Segments'][0][count($flight['Segments'][0]) - 1]['Destination'];
                                        $duration = $flight['Segments'][0][0]['Duration'];
                                    @endphp
                                    <div class="panel">
                                        <div class="flight">
                                            <div class="head">
                                                <div class="img-box">
                                                    <img class="tail" width="98" height="98"
                                                        src={{ asset('images/flight/svg/tail.svg') }}
                                                        alt="airplane-tail-fin" />
                                                    <img src="{{ asset('images/flight/AirlineLogo/' . $airline['AirlineCode'] . '.gif') }}"
                                                        alt="{{ $airline['AirlineName'] }} logo" class="airline-logo">
                                                </div>
                                                <div class="text-box">
                                                    <h4 class="line">{{ $airline['AirlineName'] }}</h4>
                                                    <h6 class="flight-number">
                                                        {{ $airline['AirlineCode'] }}-{{ $airline['FlightNumber'] }}</h6>
                                                    <p class="lcc">
                                                        @if ($flight['IsLCC'])
                                                            LCC - Ticket
                                                        @else
                                                            Non-LCC - Book
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flight_details rflex">
                                                <div class="origin location cflex">
                                                    <div class="city_code">
                                                        <h4>{{ $origin['Airport']['AirportCode'] }}</h4>
                                                        <p>{{ $origin['Airport']['CityName'] }}</p>
                                                    </div>
                                                    <div class="city">
                                                        <span>T-{{ $origin['Airport']['Terminal'] }}</span>
                                                        {{ $origin['Airport']['AirportName'] }}
                                                    </div>
                                                    <div class="time">{!! air_date($origin['DepTime']) !!}</div>
                                                </div>
                                                <div class="flight_time">
                                                    <p>{{ floor($duration / 60) }}<span>h</span>{{ $duration % 60 }}<span>m</span>
                                                    </p>
                                                    @if (count($flight['Segments'][0]) > 1)
                                                        <p class="stops">{{ count($flight['Segments'][0]) - 1 }}
                                                            <span>Stop</span>
                                                        </p>
                                                    @else
                                                        <p class="stops">
                                                            <span> Non-Stop</span>
                                                        </p>
                                                    @endif
                                                    <i class="fa-solid fa-plane" style="--i:{{ $i }}"></i>
                                                </div>
                                                <div class="destination location cflex">
                                                    <div class="city_code">
                                                        <p>{{ $destination['Airport']['CityName'] }}</p>
                                                        <h4>{{ $destination['Airport']['AirportCode'] }}</h4>
                                                    </div>
                                                    <div class="city">
                                                        <span>T-{{ $destination['Airport']['Terminal'] }}</span>
                                                        {{ $destination['Airport']['AirportName'] }}
                                                    </div>
                                                    <div class="time">{!! air_date($destination['ArrTime']) !!}</div>
                                                </div>
                                            </div>
                                            <div class="options rflex">
                                                <div class="rflex">
                                                    <div class="view_details">
                                                        <button onclick="view_details(this)">View Details <i
                                                                class="fa-solid fa-chevron-down"></i></button>
                                                    </div>
                                                    <div class="warnings cflex">
                                                        @if (!$flight['IsRefundable'] || !isset($flight['MiniFareRules']))
                                                            <div class="warning">
                                                                <i class="fa-solid fa-triangle-exclamation"></i>
                                                                @if (!$flight['IsRefundable'])
                                                                    Flight is non-refundable.
                                                                @elseif(!isset($flight['MiniFareRules']))
                                                                    No cancellation policies
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="rflex aic">
                                                    <div class="price">
                                                        <h5><i class="fa-solid fa-indian-rupee-sign"></i> <span
                                                                class="flight_price">{{ floor($flight['Fare']['PublishedFare']) }}</span>
                                                        </h5>
                                                    </div>
                                                    <button type="submit" class="select_btn dep_btn"
                                                        onclick="select_flight('dep_index','{{ $flight['ResultIndex'] }}')">Select</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flight_overview rflex">
                                            <div class="cflex overview_types">
                                                <button class="active">Flight</button>
                                                <button>Fare</button>
                                                <button>Baggage</button>
                                                @isset($flight['MiniFareRules'])
                                                    <button>Cancellation</button>
                                                @endisset
                                            </div>
                                            <div class="overview_desc">
                                                <div class="overview_flight active">
                                                    @foreach ($flight['Segments'][0] as $segment)
                                                        <div class="over_fli rflex aic">
                                                            <div class="fli_ori cflex">
                                                                <h6>{{ $segment['Origin']['Airport']['CityCode'] }}<span>{{ $segment['Origin']['Airport']['CityName'] }}</span>
                                                                </h6>
                                                                <p class="fli_port">
                                                                    {{ $segment['Origin']['Airport']['AirportName'] }}<span>{{ $segment['Origin']['Airport']['CountryName'] }}</span>
                                                                </p>
                                                                <div class="fli_time">
                                                                    {!! air_date($segment['Origin']['DepTime']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="fli_mid">
                                                                <p><span>{{ floor($segment['Duration'] / 60) }}
                                                                        h</span><span>{{ $segment['Duration'] % 60 }}
                                                                        m</span>
                                                                </p>
                                                                <i class="fa-solid fa-plane"></i>
                                                            </div>
                                                            <div class="fli_des cflex">
                                                                <h6><span>{{ $segment['Destination']['Airport']['CityName'] }}</span>{{ $segment['Destination']['Airport']['CityCode'] }}
                                                                </h6>
                                                                <p class="fli_port">
                                                                    {{ $segment['Destination']['Airport']['AirportName'] }}<span>{{ $segment['Destination']['Airport']['CountryName'] }}</span>
                                                                </p>
                                                                <div class="fli_time">
                                                                    {!! air_date($segment['Destination']['ArrTime']) !!}
                                                                </div>
                                                            </div>
                                                            @if ($segment['GroundTime'] > 0)
                                                                <p class="ground_time">Wait
                                                                    {{ floor($segment['GroundTime'] / 60) }}
                                                                    h {{ $segment['GroundTime'] % 60 }} m
                                                                </p>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="overview_fare">@php
                                                    $pax = ['Adult', 'Child', 'Infant'];
                                                    $min_fare = 0;
                                                    $min_tax = 0;
                                                @endphp
                                                    <table style="border-collapse: collapse;width:100%;"
                                                        border="1px solid">
                                                        <tr>
                                                            <td>Base Fare (
                                                                @foreach ($flight['FareBreakdown'] as $i => $fb)
                                                                    <span>
                                                                        @php
                                                                            $min_fare += $fb['BaseFare'];
                                                                            echo $fb['PassengerCount'] . 'x' . $pax[$i];
                                                                        @endphp
                                                                    </span>
                                                                @endforeach
                                                                )
                                                            </td>
                                                            <td><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                {{ $min_fare }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Taxes (@foreach ($flight['FareBreakdown'] as $i => $fb)
                                                                    <span>
                                                                        @php
                                                                            $min_tax += $fb['Tax'];
                                                                            echo $fb['PassengerCount'] . 'x' . $pax[$i];
                                                                        @endphp
                                                                    </span>
                                                                @endforeach)
                                                            </td>
                                                            <td><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                {{ $min_tax }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Total Fare</b></td>
                                                            <td><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                {{ $min_fare + $min_tax }}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="overview_baggage">
                                                    @foreach ($flight['Segments'][0] as $segment)
                                                        <div class="bag_over">
                                                            <h6>{{ $segment['Origin']['Airport']['AirportCode'] }}-{{ $segment['Destination']['Airport']['AirportCode'] }}
                                                            </h6>
                                                            <table style="width:100%;border-collapse: collapse;"
                                                                border="1px solid">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Check-In</th>
                                                                        <th>Cabin</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>{{ $segment['Baggage'] }}</td>
                                                                        <td>{{ $segment['CabinBaggage'] }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                @isset($flight['MiniFareRules'])
                                                    <div class="overview_cancellation minifare">
                                                        @php
                                                            $rules = [
                                                                'cancel' => [],
                                                                'reschedule' => [],
                                                            ];
                                                            foreach ($flight['MiniFareRules'][0] as $rule) {
                                                                if ($rule['Type'] == 'Reissue') {
                                                                    $rules['reschedule'][] = $rule;
                                                                } elseif ($rule['Type'] == 'Cancellation') {
                                                                    $rules['cancel'][] = $rule;
                                                                }
                                                            }
                                                        @endphp
                                                        @if ($rules['cancel'])
                                                            <div class="cancel">
                                                                <h6>Cancellation Charges</h6>
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <th>If Cancelled</th>
                                                                            <th>Charges</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($rules['cancel'] as $r)
                                                                            <tr>
                                                                                <td>{{ intval($r['From'] ?? 0) + 2 }}-{{ $r['To'] ? intval($r['To']) + 2 : 'more' }}
                                                                                    {{ $r['Unit'] }}</td>

                                                                                <td>{{ $r['Details'] }}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        @endif
                                                        @if ($rules['reschedule'])
                                                            <div class="reschedule">
                                                                <h6>Reschedule Charges</h6>
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <th>If Rescheduled</th>
                                                                            <th>Charges</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($rules['reschedule'] as $r)
                                                                            <tr>
                                                                                <td>{{ intval($r['From'] ?? 0) + 2 }}-{{ $r['To'] ? intval($r['To']) + 2 : 'more' }}
                                                                                    {{ $r['Unit'] }}</td>

                                                                                <td>{{ $r['Details'] }}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endisset
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="flights cflex" style="flex-grow: 1;">
                                <div class="header_bar rflex">
                                    <p class="result_count">Showing
                                        <span>{{ isset($flights[1]) ? count($flights[1]) : count($flights[0]) }}
                                        </span> results
                                    </p>
                                </div>
                                @foreach ($flights[1] as $i => $flight)
                                    @php
                                        $airline = $flight['Segments'][0][0]['Airline'];
                                        $origin = $flight['Segments'][0][0]['Origin'];
                                        $destination =
                                            $flight['Segments'][0][count($flight['Segments'][0]) - 1]['Destination'];
                                        $duration = $flight['Segments'][0][0]['Duration'];
                                    @endphp
                                    <div class="panel">
                                        <div class="flight">
                                            <div class="head">
                                                <div class="img-box">
                                                    <img class="tail" width="98" height="98"
                                                        src={{ asset('images/flight/svg/tail.svg') }}
                                                        alt="airplane-tail-fin" />
                                                    <img src="{{ asset('images/flight/AirlineLogo/' . $airline['AirlineCode'] . '.gif') }}"
                                                        alt="{{ $airline['AirlineName'] }} logo" class="airline-logo">
                                                </div>
                                                <div class="text-box">
                                                    <h4 class="line">{{ $airline['AirlineName'] }}</h4>
                                                    <h6 class="flight-number">
                                                        {{ $airline['AirlineCode'] }}-{{ $airline['FlightNumber'] }}</h6>
                                                    <p class="lcc">
                                                        @if ($flight['IsLCC'])
                                                            LCC - Ticket
                                                        @else
                                                            Non-LCC - Book
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flight_details rflex">
                                                <div class="origin location cflex">
                                                    <div class="city_code">
                                                        <h4>{{ $origin['Airport']['AirportCode'] }}</h4>
                                                        <p>{{ $origin['Airport']['CityName'] }}</p>
                                                    </div>
                                                    <div class="city">
                                                        <span>T-{{ $origin['Airport']['Terminal'] }}</span>
                                                        {{ $origin['Airport']['AirportName'] }}
                                                    </div>
                                                    <div class="time">{!! air_date($origin['DepTime']) !!}</div>
                                                </div>
                                                <div class="flight_time">
                                                    <p>{{ floor($duration / 60) }}<span>h</span>{{ $duration % 60 }}<span>m</span>
                                                    </p>
                                                    @if (count($flight['Segments'][0]) > 1)
                                                        <p class="stops">{{ count($flight['Segments'][0]) - 1 }}
                                                            <span>Stop</span>
                                                        </p>
                                                    @else
                                                        <p class="stops">
                                                            <span> Non-Stop</span>
                                                        </p>
                                                    @endif
                                                    <i class="fa-solid fa-plane" style="--i:{{ $i }}"></i>
                                                </div>
                                                <div class="destination location cflex">
                                                    <div class="city_code">
                                                        <p>{{ $destination['Airport']['CityName'] }}</p>
                                                        <h4>{{ $destination['Airport']['AirportCode'] }}</h4>
                                                    </div>
                                                    <div class="city">
                                                        <span>T-{{ $destination['Airport']['Terminal'] }}</span>
                                                        {{ $destination['Airport']['AirportName'] }}
                                                    </div>
                                                    <div class="time">{!! air_date($destination['ArrTime']) !!}</div>
                                                </div>
                                            </div>
                                            <div class="options rflex">
                                                <div class="rflex">
                                                    <div class="view_details">
                                                        <button onclick="view_details(this)">View Details <i
                                                                class="fa-solid fa-chevron-down"></i></button>
                                                    </div>
                                                    <div class="warnings cflex">
                                                        @if (!$flight['IsRefundable'] || !isset($flight['MiniFareRules']))
                                                            <div class="warning">
                                                                <i class="fa-solid fa-triangle-exclamation"></i>
                                                                @if (!$flight['IsRefundable'])
                                                                    Flight is non-refundable.
                                                                @elseif(!isset($flight['MiniFareRules']))
                                                                    No cancellation policies
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="rflex aic">
                                                    <div class="price">
                                                        <h5><i class="fa-solid fa-indian-rupee-sign"></i> <span
                                                                class="flight_price">{{ floor($flight['Fare']['PublishedFare']) }}</span>
                                                        </h5>
                                                    </div>
                                                    <button type="submit" class="select_btn ret_btn"
                                                        onclick="select_flight('ret_index','{{ $flight['ResultIndex'] }}')">Select</button>




                                                </div>
                                            </div>
                                        </div>
                                        <div class="flight_overview rflex">
                                            <div class="cflex overview_types">
                                                <button class="active">Flight</button>
                                                <button>Fare</button>
                                                <button>Baggage</button>
                                                @isset($flight['MiniFareRules'])
                                                    <button>Cancellation</button>
                                                @endisset
                                            </div>
                                            <div class="overview_desc">
                                                <div class="overview_flight active">
                                                    @foreach ($flight['Segments'][0] as $segment)
                                                        <div class="over_fli rflex aic">
                                                            <div class="fli_ori cflex">
                                                                <h6>{{ $segment['Origin']['Airport']['CityCode'] }}<span>{{ $segment['Origin']['Airport']['CityName'] }}</span>
                                                                </h6>
                                                                <p class="fli_port">
                                                                    {{ $segment['Origin']['Airport']['AirportName'] }}<span>{{ $segment['Origin']['Airport']['CountryName'] }}</span>
                                                                </p>
                                                                <div class="fli_time">
                                                                    {!! air_date($segment['Origin']['DepTime']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="fli_mid">
                                                                <p><span>{{ floor($segment['Duration'] / 60) }}
                                                                        h</span><span>{{ $segment['Duration'] % 60 }}
                                                                        m</span>
                                                                </p>
                                                                <i class="fa-solid fa-plane"></i>
                                                            </div>
                                                            <div class="fli_des cflex">
                                                                <h6><span>{{ $segment['Destination']['Airport']['CityName'] }}</span>{{ $segment['Destination']['Airport']['CityCode'] }}
                                                                </h6>
                                                                <p class="fli_port">
                                                                    {{ $segment['Destination']['Airport']['AirportName'] }}<span>{{ $segment['Destination']['Airport']['CountryName'] }}</span>
                                                                </p>
                                                                <div class="fli_time">
                                                                    {!! air_date($segment['Destination']['ArrTime']) !!}
                                                                </div>
                                                            </div>
                                                            {{-- @dd($segment); --}}
                                                            @if ($segment['GroundTime'] > 0)
                                                                <p class="ground_time">Wait
                                                                    {{ floor($segment['GroundTime'] / 60) }}
                                                                    h {{ $segment['GroundTime'] % 60 }} m
                                                                </p>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="overview_fare">@php
                                                    $pax = ['Adult', 'Child', 'Infant'];
                                                    $min_fare = 0;
                                                    $min_tax = 0;
                                                @endphp
                                                    <table style="border-collapse: collapse;width:100%;"
                                                        border="1px solid">
                                                        <tr>
                                                            <td>Base Fare (
                                                                @foreach ($flight['FareBreakdown'] as $i => $fb)
                                                                    <span>
                                                                        @php
                                                                            $min_fare += $fb['BaseFare'];
                                                                            echo $fb['PassengerCount'] . 'x' . $pax[$i];
                                                                        @endphp
                                                                    </span>
                                                                @endforeach
                                                                )
                                                            </td>
                                                            <td><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                {{ $min_fare }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Taxes (@foreach ($flight['FareBreakdown'] as $i => $fb)
                                                                    <span>
                                                                        @php
                                                                            $min_tax += $fb['Tax'];
                                                                            echo $fb['PassengerCount'] . 'x' . $pax[$i];
                                                                        @endphp
                                                                    </span>
                                                                @endforeach)
                                                            </td>
                                                            <td><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                {{ $min_tax }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Total Fare</b></td>
                                                            <td><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                {{ $min_fare + $min_tax }}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="overview_baggage">
                                                    @foreach ($flight['Segments'][0] as $segment)
                                                        <div class="bag_over">
                                                            <h6>{{ $segment['Origin']['Airport']['AirportCode'] }}-{{ $segment['Destination']['Airport']['AirportCode'] }}
                                                            </h6>
                                                            <table style="width:100%;border-collapse: collapse;"
                                                                border="1px solid">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Check-In</th>
                                                                        <th>Cabin</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>{{ $segment['Baggage'] }}</td>
                                                                        <td>{{ $segment['CabinBaggage'] }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                @isset($flight['MiniFareRules'])
                                                    <div class="overview_cancellation minifare">
                                                        @php
                                                            $rules = [
                                                                'cancel' => [],
                                                                'reschedule' => [],
                                                            ];
                                                            foreach ($flight['MiniFareRules'][0] as $rule) {
                                                                if ($rule['Type'] == 'Reissue') {
                                                                    $rules['reschedule'][] = $rule;
                                                                } elseif ($rule['Type'] == 'Cancellation') {
                                                                    $rules['cancel'][] = $rule;
                                                                }
                                                            }
                                                        @endphp
                                                        @if ($rules['cancel'])
                                                            <div class="cancel">
                                                                <h6>Cancellation Charges</h6>
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <th>If Cancelled</th>
                                                                            <th>Charges</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($rules['cancel'] as $r)
                                                                            <tr>
                                                                                <td>{{ intval($r['From'] ?? 0) + 2 }}-{{ $r['To'] ? intval($r['To']) + 2 : 'more' }}
                                                                                    {{ $r['Unit'] }}</td>

                                                                                <td>{{ $r['Details'] }}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        @endif
                                                        @if ($rules['reschedule'])
                                                            <div class="reschedule">
                                                                <h6>Reschedule Charges</h6>
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <th>If Rescheduled</th>
                                                                            <th>Charges</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($rules['reschedule'] as $r)
                                                                            <tr>
                                                                                <td>{{ intval($r['From'] ?? 0) + 2 }}-{{ $r['To'] ? intval($r['To']) + 2 : 'more' }}
                                                                                    {{ $r['Unit'] }}</td>

                                                                                <td>{{ $r['Details'] }}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endisset
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <form action="{{ url('flight/review') }}" method="get" class="multi_flight rflex"
                        id="multi_flight">
                        @csrf
                            @php
                                $ori = $flights[0][0]['Segments'][0][0]['Origin'];
                                $des =
                                    $flights[0][0]['Segments'][0][count($flights[0][0]['Segments'][0]) - 1][
                                        'Destination'
                                    ];
                            @endphp
                        <span class="select_show_btn"><i class="fa-solid fa-angle-up"></i></span>
                        <div class="multi_flight_body">

                            <div class="rflex wrapper" style="flex-grow: 1;">
                                <div class="departure_flight flits cflex">
                                    <div class="details rflex jcsb aic">
                                        <div class="ori cflex">
                                            <h6>{{ $ori['Airport']['AirportCode'] }}<span>{{ $ori['Airport']['CityName'] }}</span>
                                            </h6>
                                            <p>{{ $ori['Airport']['AirportName'] }}</p>
                                        </div>
                                        <div class="mid">
                                            <i class="fa-solid fa-plane"></i>
                                        </div>
                                        <div class="desti">
                                            <h6>{{ $des['Airport']['AirportCode'] }}<span>{{ $des['Airport']['CityName'] }}</span>
                                            </h6>
                                            <p>{{ $des['Airport']['AirportName'] }}</p>
                                        </div>
                                    </div>
                                    <span id="three_depindex"> Select Departure flight </span>
                                    <input type="hidden" readonly name="dep_index" id="dep_index">

                                </div>
                                <div class="return_flight flits cflex">
                                    <div class="details rflex jcsb aic">
                                        <div class="desti">
                                            <h6>{{ $des['Airport']['AirportCode'] }}<span>{{ $des['Airport']['CityName'] }}</span>
                                            </h6>
                                            <p>{{ $des['Airport']['AirportName'] }}</p>
                                        </div>
                                        <div class="mid">
                                            <i class="fa-solid fa-plane"></i>
                                        </div>
                                        <div class="ori cflex">
                                            <h6>{{ $ori['Airport']['AirportCode'] }}<span>{{ $ori['Airport']['CityName'] }}</span>
                                            </h6>
                                            <p>{{ $ori['Airport']['AirportName'] }}</p>
                                        </div>
                                    </div>
                                    <span id="three_retindex"> Select Return flight </span>
                                    <input type="hidden" name="ret_index" id="ret_index">
                                </div>
                            </div>
                            <input type="hidden" name="trace" value="{{ $trace }}">
                            <button type="submit">Book Ticket</button>
                        </div>

                        </form>
                    </div>

                        {{-- For International Round Trip  --}}
                    @elseif (isset($flights[0][0]['Segments']) && isset($flights[0][0]['Segments'][1]))
                    <div class="main_content int_round cflex">
                        <div class="scroller">
                            <button id="prev"><</button>
                            <ul class="scroll-box" id="scroll-box"></ul>
                            <button id="next">></button>
                        </div>
                        <div class="flight_wrapper rflex" style="gap:20px;">
                            <div class="flights cflex" style="flex-grow: 1;">
                                <div class="header_bar rflex">
                                    <h5 class="result_heading"> International Return Flights </h5>
                                     <p class="result_count">Showing <span>{{ count($flights[0]) }}
                                        </span> results</p>
                                </div>
                                @foreach ($flights[0] as $i => $flight)
                                    @php
                                        $airline = $flight['Segments'][0][0]['Airline'];
                                        $origin = $flight['Segments'][0][0]['Origin'];
                                        $destination =
                                            $flight['Segments'][0][count($flight['Segments'][0]) - 1]['Destination'];
                                        $duration = $flight['Segments'][0][0]['Duration'];
                                    @endphp
                                    <div class="panel">
                                        <article class="onward">

                                        <div class="flight">
                                            <div class="head">
                                                <div class="img-box">
                                                    <img class="tail" width="98" height="98"
                                                        src={{ asset('images/flight/svg/tail.svg') }}
                                                        alt="airplane-tail-fin" />
                                                    <img src="{{ asset('images/flight/AirlineLogo/' . $airline['AirlineCode'] . '.gif') }}"
                                                        alt="{{ $airline['AirlineName'] }} logo" class="airline-logo">
                                                </div>
                                                <div class="text-box">
                                                    <h4 class="line">{{ $airline['AirlineName'] }}</h4>
                                                    <h6 class="flight-number">
                                                        {{ $airline['AirlineCode'] }}-{{ $airline['FlightNumber'] }}
                                                    </h6>
                                                    <p class="lcc">
                                                        @if ($flight['IsLCC'])
                                                            LCC - Ticket
                                                        @else
                                                            Non-LCC - Book
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flight_details rflex" style="position: relative">
                                                <div class="origin location cflex">
                                                    <div class="city_code">
                                                        <h4>{{ $origin['Airport']['AirportCode'] }}</h4>
                                                        <p>{{ $origin['Airport']['CityName'] }}</p>

                                                    </div>
                                                    <div class="city">
                                                        <span>T-{{ $origin['Airport']['Terminal'] }}</span>
                                                        {{ $origin['Airport']['AirportName'] }}
                                                    </div>
                                                    <div class="time">{!! air_date($origin['DepTime']) !!}</div>
                                                </div>
                                                <div class="flight_time">
                                                    <p>{{ floor($duration / 60) }}<span>h</span>{{ $duration % 60 }}<span>m</span>
                                                    </p>
                                                    @if (count($flight['Segments'][0]) > 1)
                                                        <p class="stops">{{ count($flight['Segments'][0]) - 1 }}
                                                            <span>Stop</span>
                                                        </p>
                                                    @else
                                                        <p class="stops">
                                                            <span> Non-Stop</span>
                                                        </p>
                                                    @endif
                                                    <i class="fa-solid fa-plane" style="--i:{{ $i }}"></i>
                                                </div>
                                                <div class="destination location cflex">
                                                    <div class="city_code">
                                                        <p>{{ $destination['Airport']['CityName'] }}</p>
                                                        <h4>{{ $destination['Airport']['AirportCode'] }}</h4>
                                                    </div>
                                                    <div class="city">
                                                        <span>T-{{ $destination['Airport']['Terminal'] }}</span>
                                                        {{ $destination['Airport']['AirportName'] }}
                                                    </div>
                                                    <div class="time">{!! air_date($destination['ArrTime']) !!}</div>
                                                </div>
                                                
                                            </div>
                                            <div class="options rflex">
                                                <div class="rflex">
                                                    <div class="view_details">
                                                        <button onclick="view_details(this)">View Details <w_details
                                                                class="fa-solid fa-chevron-down"></i></button>
                                                    </div>
                                                    <div class="warnings cflex">
                                                        @if (!$flight['IsRefundable'] || !isset($flight['MiniFareRules']))
                                                            <div class="warning">
                                                                <i class="fa-solid fa-triangle-exclamation"></i>
                                                                @if (!$flight['IsRefundable'])
                                                                    Flight is non-refundable.
                                                                @elseif(!isset($flight['MiniFareRules']))
                                                                    No cancellation policies
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>


                                        </div>

                                        <div class="flight_overview rflex">
                                            <div class="cflex overview_types">
                                                <button class="active">Flight</button>
                                                <button>Baggage</button>
                                                @isset($flight['MiniFareRules'])
                                                    <button>Cancellation</button>
                                                @endisset
                                            </div>
                                            <div class="overview_desc">
                                                <div class="overview_flight active">
                                                    @foreach ($flight['Segments'][0] as $segment)
                                                        <div class="over_fli rflex aic">
                                                            <div class="fli_ori cflex">
                                                                <h6>{{ $segment['Origin']['Airport']['CityCode'] }}<span>{{ $segment['Origin']['Airport']['CityName'] }}</span>
                                                                </h6>
                                                                <p class="fli_port">
                                                                    {{ $segment['Origin']['Airport']['AirportName'] }}<span>{{ $segment['Origin']['Airport']['CountryName'] }}</span>
                                                                </p>
                                                                <div class="fli_time">
                                                                    {!! air_date($segment['Origin']['DepTime']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="fli_mid">
                                                                <p><span>{{ floor($segment['Duration'] / 60) }}
                                                                        h</span><span>{{ $segment['Duration'] % 60 }}
                                                                        m</span>
                                                                </p>
                                                                <i class="fa-solid fa-plane"></i>
                                                            </div>
                                                            <div class="fli_des cflex">
                                                                <h6><span>{{ $segment['Destination']['Airport']['CityName'] }}</span>{{ $segment['Destination']['Airport']['CityCode'] }}
                                                                </h6>
                                                                <p class="fli_port">
                                                                    {{ $segment['Destination']['Airport']['AirportName'] }}<span>{{ $segment['Destination']['Airport']['CountryName'] }}</span>
                                                                </p>
                                                                <div class="fli_time">
                                                                    {!! air_date($segment['Destination']['ArrTime']) !!}
                                                                </div>
                                                            </div>
                                                            @if ($segment['GroundTime'] > 0)
                                                                <p class="ground_time">Wait
                                                                    {{ floor($segment['GroundTime'] / 60) }}
                                                                    h {{ $segment['GroundTime'] % 60 }} m
                                                                </p>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="overview_baggage">
                                                    @foreach ($flight['Segments'][0] as $segment)
                                                        <div class="bag_over">
                                                            <h6>{{ $segment['Origin']['Airport']['AirportCode'] }}-{{ $segment['Destination']['Airport']['AirportCode'] }}
                                                            </h6>
                                                            <table style="width:100%;border-collapse: collapse;
                                                                border: 1px solid;">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Check-In</th>
                                                                        <th>Cabin</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>{{ $segment['Baggage'] }}</td>
                                                                        <td>{{ $segment['CabinBaggage'] }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                @isset($flight['MiniFareRules'])
                                                    <div class="overview_cancellation minifare">
                                                        @php
                                                            $rules = [
                                                                'cancel' => [],
                                                                'reschedule' => [],
                                                            ];
                                                            foreach ($flight['MiniFareRules'][0] as $rule) {
                                                                if ($rule['Type'] == 'Reissue') {
                                                                    $rules['reschedule'][] = $rule;
                                                                } elseif ($rule['Type'] == 'Cancellation') {
                                                                    $rules['cancel'][] = $rule;
                                                                }
                                                            }
                                                        @endphp
                                                        @if ($rules['cancel'])
                                                            <div class="cancel">
                                                                <h6>Cancellation Charges</h6>
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <th>If Cancelled</th>
                                                                            <th>Charges</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($rules['cancel'] as $r)
                                                                            <tr>

                                                                                <td>{{ intval($r['From'] ?? 0) + 2 }}-{{ $r['To'] ? intval($r['To']) + 2 : 'more' }}
                                                                                    {{ $r['Unit'] }}</td>

                                                                                <td>{{ $r['Details'] }}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        @endif
                                                        @if ($rules['reschedule'])
                                                            <div class="reschedule">
                                                                <h6>Reschedule Charges</h6>
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <th>If Rescheduled</th>
                                                                            <th>Charges</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($rules['reschedule'] as $r)
                                                                            <tr>
                                                                                <td>{{ intval($r['From'] ?? 0) + 2 }}-{{ $r['To'] ? intval($r['To']) + 2 : 'more' }}
                                                                                    {{ $r['Unit'] }}</td>

                                                                                <td>{{ $r['Details'] }}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endisset
                                            </div>
                                        </div>
                                        <div class= "flight_line">
                                            <i class='fas fa-exchange-alt' style='font-size:18px'></i>
                                         </div>
                                        </article>
                                    
                                     <!-- return trip flights -->
                                      @php
                                        $airline = $flight['Segments'][1][0]['Airline'];
                                        $origin = $flight['Segments'][1][0]['Origin'];
                                        $destination =
                                            $flight['Segments'][1][count($flight['Segments'][1]) - 1]['Destination'];
                                        $duration = $flight['Segments'][1][0]['Duration'];
                                    @endphp
                                    <article class="return">
                                      <div class="flight">
                                             <div class="head">
                                                <div class="img-box">
                                                    <img class="tail" width="98" height="98"
                                                        src={{ asset('images/flight/svg/tail.svg') }}
                                                        alt="airplane-tail-fin" />
                                                    <img src="{{ asset('images/flight/AirlineLogo/' . $airline['AirlineCode'] . '.gif') }}"
                                                        alt="{{ $airline['AirlineName'] }} logo" class="airline-logo">
                                                </div>
                                                <div class="text-box">
                                                    <h4 class="line">{{ $airline['AirlineName'] }}</h4>
                                                    <h6 class="flight-number">
                                                        {{ $airline['AirlineCode'] }}-{{ $airline['FlightNumber'] }}
                                                    </h6>
                                                    <p class="lcc">
                                                        @if ($flight['IsLCC'])
                                                            LCC - Ticket
                                                        @else
                                                            Non-LCC - Book
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flight_details rflex">
                                                <div class="origin location cflex">
                                                    <div class="city_code">
                                                        <h4>{{ $origin['Airport']['AirportCode'] }}</h4>
                                                        <p>{{ $origin['Airport']['CityName'] }}</p>
                                                    </div>
                                                    <div class="city">
                                                        <span>T-{{ $origin['Airport']['Terminal'] }}</span>
                                                        {{ $origin['Airport']['AirportName'] }}
                                                    </div>
                                                    <div class="time">{!! air_date($origin['DepTime']) !!}</div>
                                                </div>
                                                <div class="flight_time">
                                                    <p>{{ floor($duration / 60) }}<span>h</span>{{ $duration % 60 }}<span>m</span>
                                                    </p>
                                                    @if (count($flight['Segments'][0]) > 1)
                                                        <p class="stops">{{ count($flight['Segments'][0]) - 1 }}
                                                            <span>Stop</span>
                                                        </p>
                                                    @else
                                                        <p class="stops">
                                                            <span> Non-Stop</span>
                                                        </p>
                                                    @endif
                                                    <i class="fa-solid fa-plane" style="--i:{{ $i }}"></i>
                                                </div>
                                                <div class="destination location cflex">
                                                    <div class="city_code">
                                                        <p>{{ $destination['Airport']['CityName'] }}</p>
                                                        <h4>{{ $destination['Airport']['AirportCode'] }}</h4>
                                                    </div>
                                                    <div class="city">
                                                        <span>T-{{ $destination['Airport']['Terminal'] }}</span>
                                                        {{ $destination['Airport']['AirportName'] }}
                                                    </div>
                                                    <div class="time">{!! air_date($destination['ArrTime']) !!}</div>
                                                </div>
                                            </div>
                                            <div class="options rflex">
                                                <div class="rflex">
                                                    <div class="view_details">
                                                        <button onclick="view_details(this)">View Details <i
                                                                class="fa-solid fa-chevron-down"></i></button>
                                                    </div>
                                                    <div class="warnings cflex">
                                                        @if (!$flight['IsRefundable'] || !isset($flight['MiniFareRules']))
                                                            <div class="warning">
                                                                <i class="fa-solid fa-triangle-exclamation"></i>
                                                                @if (!$flight['IsRefundable'])
                                                                    Flight is non-refundable.
                                                                @elseif(!isset($flight['MiniFareRules']))
                                                                    No cancellation policies
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="rflex aic">
                                                    <div class="price">
                                                        <h5><i class="fa-solid fa-indian-rupee-sign"></i> <span
                                                                class="flight_price">{{ floor($flight['Fare']['PublishedFare']) }}</span>
                                                        </h5>

                                                    </div>
                                                    <form action="{{ url('flight/review') }}" method="get">
                                                        <input type="hidden" name="trace"
                                                            value="{{ $trace }}">
                                                        <input type="hidden" name="dep_index"
                                                            value="{{ $flight['ResultIndex'] }}">
                                                        <button type="submit">Book Ticket</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flight_overview rflex">
                                            <div class="cflex overview_types">
                                                <button class="active">Flight</button>
                                                <button>Fare</button>
                                                <button>Baggage</button>
                                                @isset($flight['MiniFareRules'])
                                                    <button>Cancellation</button>
                                                @endisset
                                            </div>
                                            <div class="overview_desc">
                                                <div class="overview_flight active">
                                                    @foreach ($flight['Segments'][1] as $segment)
                                                        <div class="over_fli rflex aic">
                                                            <div class="fli_ori cflex">
                                                                <h6>{{ $segment['Origin']['Airport']['CityCode'] }}<span>{{ $segment['Origin']['Airport']['CityName'] }}</span>
                                                                </h6>
                                                                <p class="fli_port">
                                                                    {{ $segment['Origin']['Airport']['AirportName'] }}<span>{{ $segment['Origin']['Airport']['CountryName'] }}</span>
                                                                </p>
                                                                <div class="fli_time">
                                                                    {!! air_date($segment['Origin']['DepTime']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="fli_mid">
                                                                <p><span>{{ floor($segment['Duration'] / 60) }}
                                                                        h</span><span>{{ $segment['Duration'] % 60 }}
                                                                        m</span>
                                                                </p>
                                                                <i class="fa-solid fa-plane"></i>
                                                            </div>
                                                            <div class="fli_des cflex">
                                                                <h6><span>{{ $segment['Destination']['Airport']['CityName'] }}</span>{{ $segment['Destination']['Airport']['CityCode'] }}
                                                                </h6>
                                                                <p class="fli_port">
                                                                    {{ $segment['Destination']['Airport']['AirportName'] }}<span>{{ $segment['Destination']['Airport']['CountryName'] }}</span>
                                                                </p>
                                                                <div class="fli_time">
                                                                    {!! air_date($segment['Destination']['ArrTime']) !!}
                                                                </div>
                                                            </div>
                                                            {{-- @dd($segment); --}}
                                                            @if ($segment['GroundTime'] > 0)
                                                                <p class="ground_time">Wait
                                                                    {{ floor($segment['GroundTime'] / 60) }}
                                                                    h {{ $segment['GroundTime'] % 60 }} m
                                                                </p>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="overview_fare">@php
                                                    $pax = ['Adult', 'Child', 'Infant'];
                                                    $min_fare = 0;
                                                    $min_tax = 0;
                                                @endphp
                                                    <table style="border-collapse:collapse;width:100%;border:1px solid;">
                                                        <tr>
                                                            <td>Base Fare (
                                                                @foreach ($flight['FareBreakdown'] as $i => $fb)
                                                                    <span>
                                                                        @php
                                                                            $min_fare += $fb['BaseFare'];
                                                                            echo $fb['PassengerCount'] . 'x' . $pax[$i];
                                                                        @endphp
                                                                    </span>
                                                                @endforeach
                                                                )
                                                            </td>
                                                            <td><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                {{ $min_fare }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Taxes (@foreach ($flight['FareBreakdown'] as $i => $fb)
                                                                    <span>
                                                                        @php
                                                                            $min_tax += $fb['Tax'];
                                                                            echo $fb['PassengerCount'] . 'x' . $pax[$i];
                                                                        @endphp
                                                                    </span>
                                                                @endforeach)
                                                            </td>
                                                            <td><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                {{ $min_tax }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Total Fare</b></td>
                                                            <td><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                {{ $min_fare + $min_tax }}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="overview_baggage">
                                                    @foreach ($flight['Segments'][1] as $segment)
                                                        <div class="bag_over">
                                                            <h6>{{ $segment['Origin']['Airport']['AirportCode'] }}-{{ $segment['Destination']['Airport']['AirportCode'] }}
                                                            </h6>
                                                            <table style="width:100%;border-collapse: collapse;"
                                                                border="1px solid">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Check-In</th>
                                                                        <th>Cabin</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>{{ $segment['Baggage'] }}</td>
                                                                        <td>{{ $segment['CabinBaggage'] }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                @isset($flight['MiniFareRules'])
                                                    <div class="overview_cancellation minifare">
                                                        @php
                                                            $rules = [
                                                                'cancel' => [],
                                                                'reschedule' => [],
                                                            ];
                                                            foreach ($flight['MiniFareRules'][0] as $rule) {
                                                                if ($rule['Type'] == 'Reissue') {
                                                                    $rules['reschedule'][] = $rule;
                                                                } elseif ($rule['Type'] == 'Cancellation') {
                                                                    $rules['cancel'][] = $rule;
                                                                }
                                                            }
                                                        @endphp
                                                        @if ($rules['cancel'])
                                                            <div class="cancel">
                                                                <h6>Cancellation Charges</h6>
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <th>If Cancelled</th>
                                                                            <th>Charges</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($rules['cancel'] as $r)
                                                                            <tr>
                                                                                <td>{{ intval($r['From'] ?? 0) + 2 }}-{{ $r['To'] ? intval($r['To']) + 2 : 'more' }}
                                                                                    {{ $r['Unit'] }}</td>

                                                                                <td>{{ $r['Details'] }}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        @endif
                                                        @if ($rules['reschedule'])
                                                            <div class="reschedule">
                                                                <h6>Reschedule Charges</h6>
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <th>If Rescheduled</th>
                                                                            <th>Charges</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($rules['reschedule'] as $r)
                                                                            <tr>

                                                                                <td>{{ intval($r['From'] ?? 0) + 2 }}-{{ $r['To'] ? intval($r['To']) + 2 : 'more' }}
                                                                                    {{ $r['Unit'] }}</td>

                                                                                <td>{{ $r['Details'] }}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endisset
                                            </div>
                                        </div>
                                    </article>

                                    </div>
                                @endforeach
                            </div>
                           
                        </div>
                    </div>



                        {{-- For Domestic & International One Way  --}}
                    @else
                    <div class="main_content one_way cflex">
                        <div class="scroller">
                            <button id="prev"><</button>
                            <ul class="scroll-box" id="scroll-box"></ul>
                            <button id="next">></button>
                        </div>
                        <div class="flights cflex" id="one-way">
                            <div class="header_bar rflex">
                                @php
                                    $airlines = [];
                                    $totalFlights = isset($flights[0]) ? count($flights[0]) : 0;
                                @endphp
                                <p class="result_count">Showing <span>{{ $totalFlights }}</span> results </p>
                                <p>Filters applied:
                                    @if (isset($req['stops']))
                                        Stops: {{ implode(', ', $req['stops']) }}
                                    @endif
                                    @if (isset($req['pricing']))
                                        Pricing: {{ $req['pricing'] }}
                                    @endif
                                    @if (isset($req['time_of_day']))
                                        Time of Day: {{ implode(', ', $req['time_of_day']) }}
                                    @endif
                                    @if (isset($req['airlines']))
                                        Airlines: {{ implode(', ', $req['airlines']) }}
                                    @endif
                                </p>
                            </div>
                            <div>
                                @foreach ($flights[0] as $i => $flight)
                                    @php
                                        $segments = $flight['Segments'][0];
                                        $airline = $segments[0]['Airline'];
                                        $origin = $segments[0]['Origin'];
                                        $destination = $segments[count($segments) - 1]['Destination'];
                                        $duration = $segments[0]['Duration'];
                                        for ($popo = 1; $popo < count($segments); $popo++) {
                                            $duration =
                                                $segments[$popo]['AccumulatedDuration'] ?? $segments[1]['Duration'];
                                        }
                                        $airlines[] = [
                                            'AirlineCode' => $airline['AirlineCode'],
                                            'AirlineName' => $airline['AirlineName'],
                                        ];
                                        // Use array_unique with array_column to remove duplicate entries
                                        $airlines = array_map(
                                            'unserialize',
                                            array_unique(array_map('serialize', $airlines)),
                                        );

                                    @endphp
                                    @if ($i < 20)
                                        <div class="panel flight-visible">
                                            <div class="flight">
                                                <div class="head">
                                                    <div class="img-box">
                                                        <img class="tail" width="98" height="98"
                                                            src={{ asset('images/flight/svg/tail.svg') }}
                                                            alt="airplane-tail-fin" />
                                                        <img src="{{ asset('images/flight/AirlineLogo/' . $airline['AirlineCode'] . '.gif') }}"
                                                            alt="{{ $airline['AirlineName'] }} logo"
                                                            class="airline-logo">
                                                    </div>
                                                    <div class="text-box">
                                                        <h4 class="line">{{ $airline['AirlineName'] }}</h4>
                                                        <h6 class="flight-number">
                                                            {{ $airline['AirlineCode'] }}-{{ $airline['FlightNumber'] }}
                                                        </h6>
                                                        <p class="lcc">
                                                            @if ($flight['IsLCC'])
                                                                LCC - Ticket
                                                            @else
                                                                Non-LCC - Book
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="flight_details rflex">
                                                    <div class="origin location cflex">
                                                        <div class="city_code">
                                                            <h4>{{ $origin['Airport']['AirportCode'] }}</h4>
                                                            <p>{{ $origin['Airport']['CityName'] }}</p>
                                                        </div>
                                                        <div class="city">
                                                            <span>T-{{ $origin['Airport']['Terminal'] }}</span>
                                                            {{ $origin['Airport']['AirportName'] }}
                                                        </div>
                                                        <div class="time">{!! air_date($origin['DepTime']) !!}</div>
                                                    </div>
                                                    <div class="flight_time">
                                                        <p>{{ floor($duration / 60) }}<span>h</span>{{ $duration % 60 }}<span>m</span>
                                                        </p>
                                                        @if (count($flight['Segments'][0]) > 1)
                                                            <p class="stops"> {{ count($flight['Segments'][0]) - 1 }}
                                                                <span>Stop</span>
                                                            </p>
                                                        @else
                                                            <p class="stops">
                                                                <span> Non-Stop</span>
                                                            </p>
                                                        @endif
                                                        <i class="fa-solid fa-plane"
                                                            style="--i:{{ $i }}"></i>
                                                    </div>
                                                    <div class="destination location cflex">
                                                        <div class="city_code">
                                                            <p>{{ $destination['Airport']['CityName'] }}</p>
                                                            <h4>{{ $destination['Airport']['AirportCode'] }}</h4>
                                                        </div>
                                                        <div class="city">
                                                            <span>T-{{ $destination['Airport']['Terminal'] }}</span>
                                                            {{ $destination['Airport']['AirportName'] }}
                                                        </div>
                                                        <div class="time">{!! air_date($destination['ArrTime']) !!}</div>
                                                    </div>
                                                </div>
                                                <div class="options rflex">
                                                    <div class="rflex">
                                                        <div class="view_details">
                                                            <button onclick="view_details(this)">View Details <i
                                                                    class="fa-solid fa-chevron-down"></i></button>
                                                        </div>
                                                        <div class="warnings cflex jcc">
                                                            @if (!$flight['IsRefundable'] || !isset($flight['MiniFareRules']))
                                                                <div class="warning">
                                                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                                                    @if (!$flight['IsRefundable'])
                                                                        Flight is non-refundable.
                                                                    @elseif(!isset($flight['MiniFareRules']))
                                                                        No cancellation policies
                                                                    @endif
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="rflex aic">
                                                        <div class="price">
                                                            <h5><i class="fa-solid fa-indian-rupee-sign"></i> <span
                                                                    class="flight_price">{{ floor($flight['Fare']['PublishedFare']) }}</span>
                                                            </h5>
                                                        </div>
                                                        <form action="{{ url('flight/review') }}" method="get">
                                                            <input type="hidden" name="trace"
                                                                value="{{ $trace }}">
                                                            <input type="hidden" name="dep_index"
                                                                value="{{ $flight['ResultIndex'] }}">
                                                            <button type="submit">Book Ticket</button>


                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flight_overview rflex">
                                                <div class="cflex overview_types">
                                                    <button class="active">Flight</button>
                                                    <button>Fare</button>
                                                    <button>Baggage</button>
                                                    @isset($flight['MiniFareRules'])
                                                        <button>Cancellation</button>
                                                    @endisset
                                                </div>
                                                <div class="overview_desc">
                                                    <div class="overview_flight active cflex">
                                                        @foreach ($segments as $segment)
                                                            <div class="over_fli rflex aic">
                                                                <div class="fli_ori cflex">
                                                                    <h6>{{ $segment['Origin']['Airport']['CityCode'] }}<span>{{ $segment['Origin']['Airport']['CityName'] }}</span>
                                                                    </h6>
                                                                    <p class="fli_port">
                                                                        {{ $segment['Origin']['Airport']['AirportName'] }}<span>{{ $segment['Origin']['Airport']['CountryName'] }}</span>
                                                                    </p>
                                                                    <div class="fli_time">
                                                                        {!! air_date($segment['Origin']['DepTime']) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="fli_mid">
                                                                    <p><span>{{ floor($segment['Duration'] / 60) }}
                                                                            h</span><span>{{ $segment['Duration'] % 60 }}
                                                                            m</span>
                                                                    </p>
                                                                    <i class="fa-solid fa-plane"></i>
                                                                </div>
                                                                <div class="fli_des cflex">
                                                                    <h6><span>{{ $segment['Destination']['Airport']['CityName'] }}</span>{{ $segment['Destination']['Airport']['CityCode'] }}
                                                                    </h6>
                                                                    <p class="fli_port">
                                                                        {{ $segment['Destination']['Airport']['AirportName'] }}<span>{{ $segment['Destination']['Airport']['CountryName'] }}</span>
                                                                    </p>
                                                                    <div class="fli_time">
                                                                        {!! air_date($segment['Destination']['ArrTime']) !!}
                                                                    </div>
                                                                </div>
                                                                @if ($segment['GroundTime'] > 0)
                                                                    <p class="ground_time">Wait
                                                                        {{ floor($segment['GroundTime'] / 60) }}
                                                                        h {{ $segment['GroundTime'] % 60 }} m
                                                                    </p>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="overview_fare rflex" style="padding: 20px;height:100%">
                                                        @php
                                                            $pax = ['Adult', 'Child', 'Infant'];
                                                            $min_fare = 0;
                                                            $min_tax = 0;
                                                        @endphp
                                                        <table
                                                            style="border-collapse: collapse;width:100%; border=1px solid;">
                                                            <tr>
                                                                <td>Base Fare (
                                                                    @foreach ($flight['FareBreakdown'] as $i => $fb)
                                                                        <span>
                                                                            @php
                                                                                $min_fare += $fb['BaseFare'];
                                                                                echo $fb['PassengerCount'] .
                                                                                    'x' .
                                                                                    $pax[$i];
                                                                            @endphp
                                                                        </span>
                                                                    @endforeach
                                                                    )
                                                                </td>
                                                                <td><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                    {{ $min_fare }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Taxes (@foreach ($flight['FareBreakdown'] as $i => $fb)
                                                                        <span>
                                                                            @php
                                                                                $min_tax += $fb['Tax'];
                                                                                echo $fb['PassengerCount'] .
                                                                                    'x' .
                                                                                    $pax[$i];
                                                                            @endphp
                                                                        </span>
                                                                    @endforeach)
                                                                </td>
                                                                <td><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                    {{ $min_tax }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Total Fare</b></td>
                                                                <td><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                    {{ $min_fare + $min_tax }}
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="overview_baggage cflex" style="padding: 20px;">
                                                        @foreach ($segments as $segment)
                                                            <div class="bag_over">
                                                                <h6>{{ $segment['Origin']['Airport']['AirportCode'] }}-{{ $segment['Destination']['Airport']['AirportCode'] }}
                                                                </h6>
                                                                <table style="width:100%;border-collapse: collapse;"
                                                                    border="1px solid">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Check-In</th>
                                                                            <th>Cabin</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>{{ $segment['Baggage'] }}</td>
                                                                            <td>{{ $segment['CabinBaggage'] }}</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    @isset($flight['MiniFareRules'])
                                                        <div class="overview_cancellation minifare">
                                                            @php
                                                                $rules = [
                                                                    'cancel' => [],
                                                                    'reschedule' => [],
                                                                ];
                                                                foreach ($flight['MiniFareRules'][0] as $rule) {
                                                                    if ($rule['Type'] == 'Reissue') {
                                                                        $rules['reschedule'][] = $rule;
                                                                    } elseif ($rule['Type'] == 'Cancellation') {
                                                                        $rules['cancel'][] = $rule;
                                                                    }
                                                                }
                                                            @endphp

                                                            @if ($rules['cancel'])
                                                                <div class="cancel">
                                                                    <h6>Cancellation Charges</h6>
                                                                    <table>
                                                                        <thead>
                                                                            <tr>
                                                                                <th>If Cancelled</th>
                                                                                <th>Charges</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($rules['cancel'] as $r)
                                                                                <tr>

                                                                                    <td>{{ intval($r['From'] ?? 0) + 2 }}-{{ $r['To'] ? intval($r['To']) + 2 : 'more' }}
                                                                                        {{ $r['Unit'] }}</td>

                                                                                    <td>{{ $r['Details'] }}</td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            @endif
                                                            @if ($rules['reschedule'])
                                                                <div class="reschedule">
                                                                    <h6>Reschedule Charges</h6>
                                                                    <table>
                                                                        <thead>
                                                                            <tr>
                                                                                <th>If Rescheduled</th>
                                                                                <th>Charges</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($rules['reschedule'] as $r)
                                                                                <tr>
                                                                                    <td>{{ intval($r['From'] ?? 0) + 2 }}-{{ $r['To'] ? intval($r['To']) + 2 : 'more' }}
                                                                                        {{ $r['Unit'] }}
                                                                                    </td>

                                                                                    <td>{{ $r['Details'] }}</td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endisset
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="panel flight-hidden" style="display: none;">
                                            <div class="flight">

                                                <div class="head">
                                                    <div class="img-box">
                                                        <img class="tail" width="98" height="98"
                                                            src={{ asset('images/flight/svg/tail.svg') }}
                                                            alt="airplane-tail-fin" />
                                                        <img src="{{ asset('images/flight/AirlineLogo/' . $airline['AirlineCode'] . '.gif') }}"
                                                            alt="{{ $airline['AirlineName'] }} logo"
                                                            class="airline-logo">
                                                    </div>
                                                    <div class="text-box">
                                                        <h4 class="line">{{ $airline['AirlineName'] }}</h4>
                                                        <h6 class="flight-number">
                                                            {{ $airline['AirlineCode'] }}-{{ $airline['FlightNumber'] }}
                                                        </h6>
                                                        <p class="lcc">
                                                            @if ($flight['IsLCC'])
                                                                LCC - Ticket
                                                            @else
                                                                Non-LCC - Book
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="flight_details rflex">
                                                    <div class="origin location cflex">
                                                        <div class="city_code">
                                                            <h4>{{ $origin['Airport']['AirportCode'] }}</h4>
                                                            <p>{{ $origin['Airport']['CityName'] }}</p>
                                                        </div>
                                                        <div class="city">
                                                            <span>T-{{ $origin['Airport']['Terminal'] }}</span>
                                                            {{ $origin['Airport']['AirportName'] }}
                                                        </div>
                                                        <div class="time">{!! air_date($origin['DepTime']) !!}</div>
                                                    </div>
                                                    <div class="flight_time">
                                                        <p>{{ floor($duration / 60) }}<span>h</span>{{ $duration % 60 }}<span>m</span>
                                                        </p>
                                                        @if (count($flight['Segments'][0]) > 1)
                                                            <p class="stops"> {{ count($flight['Segments'][0]) - 1 }}
                                                                <span>Stop</span>
                                                            </p>
                                                        @else
                                                            <p class="stops">
                                                                <span> Non-Stop</span>
                                                            </p>
                                                        @endif
                                                        <i class="fa-solid fa-plane"
                                                            style="--i:{{ $i }}"></i>
                                                    </div>
                                                    <div class="destination location cflex">
                                                        <div class="city_code">
                                                            <p>{{ $destination['Airport']['CityName'] }}</p>
                                                            <h4>{{ $destination['Airport']['AirportCode'] }}</h4>
                                                        </div>
                                                        <div class="city">
                                                            <span>T-{{ $destination['Airport']['Terminal'] }}</span>
                                                            {{ $destination['Airport']['AirportName'] }}
                                                        </div>
                                                        <div class="time">{!! air_date($destination['ArrTime']) !!}</div>
                                                    </div>
                                                </div>
                                                <div class="options rflex">
                                                    <div class="rflex">
                                                        <div class="view_details">
                                                            <button onclick="view_details(this)">View Details <i
                                                                    class="fa-solid fa-chevron-down"></i></button>
                                                        </div>
                                                        <div class="warnings cflex jcc">
                                                            @if (!$flight['IsRefundable'] || !isset($flight['MiniFareRules']))
                                                                <div class="warning">
                                                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                                                    @if (!$flight['IsRefundable'])
                                                                        Flight is non-refundable.
                                                                    @elseif(!isset($flight['MiniFareRules']))
                                                                        No cancellation policies
                                                                    @endif
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="rflex aic">
                                                        <div class="price">
                                                            <h5><i class="fa-solid fa-indian-rupee-sign"></i> <span
                                                                    class="flight_price">{{ floor($flight['Fare']['PublishedFare']) }}</span>
                                                            </h5>
                                                        </div>
                                                        <form action="{{ url('flight/review') }}" method="get">
                                                            <input type="hidden" name="trace"
                                                                value="{{ $trace }}">
                                                            <input type="hidden" name="dep_index"
                                                                value="{{ $flight['ResultIndex'] }}">
                                                            <button type="submit">Book Ticket</button>


                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flight_overview rflex">
                                                <div class="cflex overview_types">
                                                    <button class="active">Flight</button>
                                                    <button>Fare</button>
                                                    <button>Baggage</button>
                                                    @isset($flight['MiniFareRules'])
                                                        <button>Cancellation</button>
                                                    @endisset
                                                </div>
                                                <div class="overview_desc">
                                                    <div class="overview_flight active cflex">
                                                        @foreach ($segments as $segment)
                                                            <div class="over_fli rflex aic">
                                                                <div class="fli_ori cflex">
                                                                    <h6>{{ $segment['Origin']['Airport']['CityCode'] }}<span>{{ $segment['Origin']['Airport']['CityName'] }}</span>
                                                                    </h6>
                                                                    <p class="fli_port">
                                                                        {{ $segment['Origin']['Airport']['AirportName'] }}<span>{{ $segment['Origin']['Airport']['CountryName'] }}</span>
                                                                    </p>
                                                                    <div class="fli_time">
                                                                        {!! air_date($segment['Origin']['DepTime']) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="fli_mid">
                                                                    <p><span>{{ floor($segment['Duration'] / 60) }}
                                                                            h</span><span>{{ $segment['Duration'] % 60 }}
                                                                            m</span>
                                                                    </p>
                                                                    <i class="fa-solid fa-plane"></i>
                                                                </div>
                                                                <div class="fli_des cflex">
                                                                    <h6><span>{{ $segment['Destination']['Airport']['CityName'] }}</span>{{ $segment['Destination']['Airport']['CityCode'] }}
                                                                    </h6>
                                                                    <p class="fli_port">
                                                                        {{ $segment['Destination']['Airport']['AirportName'] }}<span>{{ $segment['Destination']['Airport']['CountryName'] }}</span>
                                                                    </p>
                                                                    <div class="fli_time">
                                                                        {!! air_date($segment['Destination']['ArrTime']) !!}
                                                                    </div>
                                                                </div>
                                                                @if ($segment['GroundTime'] > 0)
                                                                    <p class="ground_time">Wait
                                                                        {{ floor($segment['GroundTime'] / 60) }}
                                                                        h {{ $segment['GroundTime'] % 60 }} m
                                                                    </p>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="overview_fare rflex" style="padding: 20px;height:100%">
                                                        @php
                                                            $pax = ['Adult', 'Child', 'Infant'];
                                                            $min_fare = 0;
                                                            $min_tax = 0;
                                                        @endphp
                                                        <table
                                                            style="border-collapse: collapse;width:100%; border=1px solid;">
                                                            <tr>
                                                                <td>Base Fare (
                                                                    @foreach ($flight['FareBreakdown'] as $i => $fb)
                                                                        <span>
                                                                            @php
                                                                                $min_fare += $fb['BaseFare'];
                                                                                echo $fb['PassengerCount'] .
                                                                                    'x' .
                                                                                    $pax[$i];
                                                                            @endphp
                                                                        </span>
                                                                    @endforeach
                                                                    )
                                                                </td>
                                                                <td><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                    {{ $min_fare }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Taxes (@foreach ($flight['FareBreakdown'] as $i => $fb)
                                                                        <span>
                                                                            @php
                                                                                $min_tax += $fb['Tax'];
                                                                                echo $fb['PassengerCount'] .
                                                                                    'x' .
                                                                                    $pax[$i];
                                                                            @endphp
                                                                        </span>
                                                                    @endforeach)
                                                                </td>
                                                                <td><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                    {{ $min_tax }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Total Fare</b></td>
                                                                <td><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                    {{ $min_fare + $min_tax }}
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="overview_baggage cflex" style="padding: 20px;">
                                                        @foreach ($segments as $segment)
                                                            <div class="bag_over">
                                                                <h6>{{ $segment['Origin']['Airport']['AirportCode'] }}-{{ $segment['Destination']['Airport']['AirportCode'] }}
                                                                </h6>
                                                                <table style="width:100%;border-collapse: collapse;"
                                                                    border="1px solid">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Check-In</th>
                                                                            <th>Cabin</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>{{ $segment['Baggage'] }}</td>
                                                                            <td>{{ $segment['CabinBaggage'] }}</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    @isset($flight['MiniFareRules'])
                                                        <div class="overview_cancellation minifare">
                                                            @php
                                                                $rules = [
                                                                    'cancel' => [],
                                                                    'reschedule' => [],
                                                                ];
                                                                foreach ($flight['MiniFareRules'][0] as $rule) {
                                                                    if ($rule['Type'] == 'Reissue') {
                                                                        $rules['reschedule'][] = $rule;
                                                                    } elseif ($rule['Type'] == 'Cancellation') {
                                                                        $rules['cancel'][] = $rule;
                                                                    }
                                                                }
                                                            @endphp

                                                            @if ($rules['cancel'])
                                                                <div class="cancel">
                                                                    <h6>Cancellation Charges</h6>
                                                                    <table>
                                                                        <thead>
                                                                            <tr>
                                                                                <th>If Cancelled</th>
                                                                                <th>Charges</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($rules['cancel'] as $r)
                                                                                <tr>

                                                                                    <td>{{ intval($r['From'] ?? 0) + 2 }}-{{ $r['To'] ? intval($r['To']) + 2 : 'more' }}
                                                                                        {{ $r['Unit'] }}</td>

                                                                                    <td>{{ $r['Details'] }}</td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            @endif
                                                            @if ($rules['reschedule'])
                                                                <div class="reschedule">
                                                                    <h6>Reschedule Charges</h6>
                                                                    <table>
                                                                        <thead>
                                                                            <tr>
                                                                                <th>If Rescheduled</th>
                                                                                <th>Charges</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($rules['reschedule'] as $r)
                                                                                <tr>
                                                                                    <td>{{ intval($r['From'] ?? 0) + 2 }}-{{ $r['To'] ? intval($r['To']) + 2 : 'more' }}
                                                                                        {{ $r['Unit'] }}
                                                                                    </td>

                                                                                    <td>{{ $r['Details'] }}</td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endisset
                                                </div>
                                            </div>

                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            @if ($totalFlights > 20)
                                <button id="load_more" class="load_more">Load More</button>
                            @endif
                        </div>
                    </div>
                    @endif
                
                @if (!isset($flights[1]) && !isset($flights[0][0]['Segments'][1]))
                    <div class="sidebar">
                        <div class="panel filter">
                            <div class="head">
                                <span>Filters</span>
                                <i class="fa-solid fa-filter"></i>
                            </div>
                            <div class="filter-body">
                                <div class="stops">
                                    <h6>Stops</h6>
                                    <div class="stops-box">

                                        <label>
                                            <span>Non Stop</span>
                                            <input type="checkbox" class="stops_filter" value="0_stop">
                                        </label>
                                        <label>
                                            <span>1 Stop</span>
                                            <input type="checkbox" class="stops_filter" value="1_stop">
                                        </label>
                                        <label>
                                            <span>2+ Stop</span>
                                            <input type="checkbox" class="stops_filter" value="2_stop">
                                        </label>
                                    </div>
                                </div>
                                <div class="pricing">
                                    <h6>Pricing</h6>
                                    <div class="pricing-box">

                                        <label>
                                            <span>Low to High</span>
                                            <input type="radio" name="pricing" class="pricing_filter" value="low_to_high">
                                        </label>
                                        <label>
                                            <span>Hight to Low</span>
                                            <input type="radio" name="pricing" class="pricing_filter" value="high_to_low">
                                        </label>
                                    </div>
                                </div>
                                <div class="time_of_day">
                                    <h6>Time of Day</h6>
                                    <div class="day-box">

                                        <label for="morning">
                                            <img width="80" height="80"
                                                src={{ asset('images/flight/svg/morning.svg') }} alt="airplane-tail-fin" />
                                            <span>Morning</span>
                                            <input type="checkbox" id="morning" class="time_filter" value="morning">
                                        </label>
                                        <label for="day">
                                            <img width="80" height="80" src={{ asset('images/flight/svg/day.svg') }}
                                                alt="airplane-tail-fin" />
                                            <span>Mid Day</span>
                                            <input type="checkbox" id="morning" class="time_filter" value="afternoon">
                                        </label>
                                        <label for="evening">
                                            <img width="80" height="80"
                                                src={{ asset('images/flight/svg/evening.svg') }} alt="airplane-tail-fin" />
                                            <span>Evening</span>
                                            <input type="checkbox" id="eveing" class="time_filter" value="evening">
                                        </label>
                                        <label for="nigth">
                                            <img width="80" height="80"
                                                src={{ asset('images/flight/svg/night.svg') }} alt="airplane-tail-fin" />
                                            <span>Night</span>
                                            <input type="checkbox" id="nigth" class="time_filter" value="night">
                                        </label>
                                    </div>
                                </div>
                                <div class="airlines">
                                    <h6>Preferred Airline</h6>
                                    <div class="airline-box">

                                        @foreach ($airlines as $i => $airline)
                                            <div for="line{{ $i }}" class="line">
                                                <div class="img-box">
                                                    <img class="tail" width="80" height="80"
                                                        src={{ asset('images/flight/svg/tail.svg') }}
                                                        alt="airplane-tail-fin" />
                                                    <img src="{{ asset('images/flight/AirlineLogo/' . $airline['AirlineCode'] . '.gif') }}"
                                                        alt="{{ $airline['AirlineName'] }} logo" class="airline-logo">
                                                </div>
                                                <label for="line{{ $i }}">
                                                    {{ $airline['AirlineName'] }}
                                                </label>
                                                <input type="checkbox" class="airline_filter" id="line{{ $i }}"
                                                    value="{{ $airline['AirlineCode'] }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                @endif
            </div>
        @else
            <div class="error_box">
                @if ($code == 'NF')
                    <div class="img_wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 372.61">
                            <defs>
                                <style>
                                    .cls-1,
                                    .cls-6 {
                                        fill: #ebebeb;
                                    }

                                    .cls-2 {
                                        fill: #e6e6e6;
                                    }

                                    .cls-3 {
                                        fill: #f0f0f0;
                                    }

                                    .cls-4 {
                                        fill: #fafafa;
                                    }

                                    .cls-10,
                                    .cls-15,
                                    .cls-19,
                                    .cls-5 {
                                        fill: #fff;
                                    }

                                    .cls-6 {
                                        opacity: 0.6;
                                    }

                                    .cls-7 {
                                        fill: #f5f5f5;
                                    }

                                    .cls-8 {
                                        fill: #e0e0e0;
                                    }

                                    .cls-9 {
                                        fill: #407bff;
                                    }

                                    .cls-10 {
                                        opacity: 0.5;
                                    }

                                    .cls-11 {
                                        fill: #ffb573;
                                    }

                                    .cls-12 {
                                        fill: #263238;
                                    }

                                    .cls-13 {
                                        fill: #ff5652;
                                    }

                                    .cls-14,
                                    .cls-18 {
                                        opacity: 0.2;
                                    }

                                    .cls-15 {
                                        opacity: 0.1;
                                    }

                                    .cls-16,
                                    .cls-19 {
                                        opacity: 0.3;
                                    }

                                    .cls-17 {
                                        opacity: 0.4;
                                    }
                                </style>
                            </defs>
                            <g id="Layer_2" data-name="Layer 2">
                                <g id="Character">
                                    <rect class="cls-1" y="327.45" width="500" height="0.25" />
                                    <rect class="cls-1" x="416.78" y="343.54" width="33.12" height="0.25" />
                                    <rect class="cls-1" x="322.53" y="346.26" width="8.69" height="0.25" />
                                    <rect class="cls-1" x="396.59" y="334.26" width="19.19" height="0.25" />
                                    <rect class="cls-1" x="52.46" y="335.94" width="43.19" height="0.25" />
                                    <rect class="cls-1" x="104.56" y="335.94" width="6.33" height="0.25" />
                                    <rect class="cls-1" x="131.47" y="340.16" width="93.68" height="0.25" />
                                    <path class="cls-1"
                                        d="M237,282.85H43.91a5.71,5.71,0,0,1-5.7-5.71V5.71A5.71,5.71,0,0,1,43.91,0H237a5.71,5.71,0,0,1,5.71,5.71V277.14A5.71,5.71,0,0,1,237,282.85ZM43.91.25a5.46,5.46,0,0,0-5.45,5.46V277.14a5.46,5.46,0,0,0,5.45,5.46H237a5.47,5.47,0,0,0,5.46-5.46V5.71A5.47,5.47,0,0,0,237,.25Z" />
                                    <path class="cls-1"
                                        d="M453.31,282.85H260.21a5.72,5.72,0,0,1-5.71-5.71V5.71A5.72,5.72,0,0,1,260.21,0h193.1A5.71,5.71,0,0,1,459,5.71V277.14A5.71,5.71,0,0,1,453.31,282.85ZM260.21.25a5.47,5.47,0,0,0-5.46,5.46V277.14a5.47,5.47,0,0,0,5.46,5.46h193.1a5.47,5.47,0,0,0,5.46-5.46V5.71A5.47,5.47,0,0,0,453.31.25Z" />
                                    <rect class="cls-2" x="289.69" y="28.88" width="137.78" height="90.23"
                                        transform="translate(717.16 147.99) rotate(180)" />
                                    <rect class="cls-3" x="285.49" y="28.88" width="140.02" height="90.23"
                                        transform="translate(710.99 147.99) rotate(180)" />
                                    <rect class="cls-2" x="289.69" y="119.11" width="137.78" height="17.71"
                                        transform="translate(717.16 255.92) rotate(180)" />
                                    <rect class="cls-3" x="278.48" y="119.11" width="140.02" height="17.71"
                                        transform="translate(696.99 255.92) rotate(180)" />
                                    <rect class="cls-4" x="316.27" y="9.87" width="78.46" height="128.25"
                                        transform="translate(429.49 -281.5) rotate(90)" />
                                    <polygon class="cls-5"
                                        points="390.7 113.22 374.32 34.77 348.76 34.77 365.14 113.22 390.7 113.22" />
                                    <path class="cls-3"
                                        d="M416.9,107.36a.42.42,0,0,0,.42-.42V38.59a.42.42,0,0,0-.42-.42.42.42,0,0,0-.42.42v68.35A.42.42,0,0,0,416.9,107.36Z" />
                                    <polygon class="cls-5"
                                        points="359.65 113.22 343.27 34.77 333.3 34.77 349.69 113.22 359.65 113.22" />
                                    <rect class="cls-2" x="252.52" y="73.62" width="78.46" height="0.75"
                                        transform="translate(365.74 -217.75) rotate(90)" />
                                    <polygon class="cls-6"
                                        points="284.1 43.64 421.88 43.64 422.42 37.05 284.64 37.05 284.1 43.64" />
                                    <polygon class="cls-6"
                                        points="284.1 54.44 421.88 54.44 422.42 47.85 284.64 47.85 284.1 54.44" />
                                    <polygon class="cls-6"
                                        points="284.1 65.24 421.88 65.24 422.42 58.66 284.64 58.66 284.1 65.24" />
                                    <polygon class="cls-6"
                                        points="284.1 76.05 421.88 76.05 422.42 69.46 284.64 69.46 284.1 76.05" />
                                    <polygon class="cls-6"
                                        points="284.1 86.85 421.88 86.85 422.42 80.26 284.64 80.26 284.1 86.85" />
                                    <polygon class="cls-6"
                                        points="284.1 97.65 421.88 97.65 422.42 91.06 284.64 91.06 284.1 97.65" />
                                    <rect class="cls-2" x="378.8" y="261.83" width="28.89" height="5.7" />
                                    <rect class="cls-2" x="324.31" y="196.38" width="5.33" height="131.07"
                                        transform="translate(653.95 523.83) rotate(180)" />
                                    <rect class="cls-7" x="305.84" y="261.83" width="72.96" height="5.7"
                                        transform="translate(684.63 529.35) rotate(180)" />
                                    <rect class="cls-2" x="378.8" y="293" width="28.89" height="5.7" />
                                    <rect class="cls-7" x="305.84" y="293" width="72.96" height="5.7"
                                        transform="translate(684.63 591.69) rotate(180)" />
                                    <rect class="cls-2" x="378.8" y="199.5" width="28.89" height="5.7" />
                                    <rect class="cls-7" x="305.84" y="199.5" width="72.96" height="5.7"
                                        transform="translate(684.63 404.69) rotate(180)" />
                                    <rect class="cls-2" x="378.8" y="230.66" width="28.89" height="5.7" />
                                    <rect class="cls-7" x="305.84" y="230.66" width="72.96" height="5.7"
                                        transform="translate(684.63 467.02) rotate(180)" />
                                    <rect class="cls-2" x="397.27" y="196.38" width="5.33" height="131.07"
                                        transform="translate(799.88 523.83) rotate(180)" />
                                    <rect class="cls-7" x="373.47" y="196.38" width="5.33" height="131.07"
                                        transform="translate(752.26 523.83) rotate(180)" />
                                    <rect class="cls-7" x="305.84" y="196.38" width="5.33" height="131.07"
                                        transform="translate(617 523.83) rotate(180)" />
                                    <rect class="cls-2" x="65.37" y="221.55" width="54.58" height="105.89"
                                        transform="translate(185.33 549) rotate(180)" />
                                    <polygon class="cls-4"
                                        points="79.95 327.45 65.37 327.45 65.37 312.83 95.23 312.83 79.95 327.45" />
                                    <rect class="cls-2" x="214.18" y="221.55" width="54.58" height="105.89"
                                        transform="translate(482.94 549) rotate(180)" />
                                    <rect class="cls-4" x="65.37" y="221.55" width="161.53" height="100.86"
                                        transform="translate(292.28 543.97) rotate(180)" />
                                    <polygon class="cls-4"
                                        points="212.33 327.45 226.9 327.45 226.9 312.83 197.05 312.83 212.33 327.45" />
                                    <rect class="cls-3" x="76.68" y="259.14" width="138.92" height="25.24"
                                        transform="translate(292.28 543.52) rotate(180)" />
                                    <rect class="cls-3" x="76.68" y="289.77" width="138.92" height="25.24"
                                        transform="translate(292.28 604.79) rotate(180)" />
                                    <path class="cls-4"
                                        d="M103.08,257h86.11a4.58,4.58,0,0,1,4.58,4.58v.31a0,0,0,0,1,0,0H98.51a0,0,0,0,1,0,0v-.31A4.58,4.58,0,0,1,103.08,257Z"
                                        transform="translate(292.28 518.79) rotate(180)" />
                                    <rect class="cls-3" x="76.68" y="228.5" width="138.92" height="25.24"
                                        transform="translate(292.28 482.25) rotate(180)" />
                                    <path class="cls-4"
                                        d="M103.08,226.32h86.11a4.58,4.58,0,0,1,4.58,4.58v.31a0,0,0,0,1,0,0H98.51a0,0,0,0,1,0,0v-.31A4.58,4.58,0,0,1,103.08,226.32Z"
                                        transform="translate(292.28 457.52) rotate(180)" />
                                    <path class="cls-4"
                                        d="M103.08,287.59h86.11a4.58,4.58,0,0,1,4.58,4.58v.31a0,0,0,0,1,0,0H98.51a0,0,0,0,1,0,0v-.31A4.58,4.58,0,0,1,103.08,287.59Z"
                                        transform="translate(292.28 580.06) rotate(180)" />
                                    <rect class="cls-2" x="74.07" y="28.88" width="137.78" height="90.23"
                                        transform="translate(285.92 147.99) rotate(180)" />
                                    <rect class="cls-3" x="69.86" y="28.88" width="140.02" height="90.23"
                                        transform="translate(279.75 147.99) rotate(180)" />
                                    <rect class="cls-2" x="74.07" y="119.11" width="137.78" height="17.71"
                                        transform="translate(285.92 255.92) rotate(180)" />
                                    <rect class="cls-3" x="62.86" y="119.11" width="140.02" height="17.71"
                                        transform="translate(265.74 255.92) rotate(180)" />
                                    <rect class="cls-4" x="100.65" y="9.87" width="78.46" height="128.25"
                                        transform="translate(213.87 -65.88) rotate(90)" />
                                    <polygon class="cls-5"
                                        points="175.08 113.22 158.7 34.77 133.14 34.77 149.52 113.22 175.08 113.22" />
                                    <path class="cls-3"
                                        d="M201.27,107.36a.42.42,0,0,0,.42-.42V38.59a.42.42,0,0,0-.42-.42.42.42,0,0,0-.42.42v68.35A.42.42,0,0,0,201.27,107.36Z" />
                                    <polygon class="cls-5"
                                        points="144.03 113.22 127.65 34.77 117.68 34.77 134.06 113.22 144.03 113.22" />
                                    <rect class="cls-2" x="36.9" y="73.62" width="78.46" height="0.75"
                                        transform="translate(150.12 -2.13) rotate(90)" />
                                    <polygon class="cls-6"
                                        points="68.47 43.64 206.25 43.64 206.79 37.05 69.01 37.05 68.47 43.64" />
                                    <polygon class="cls-6"
                                        points="68.47 47.35 206.25 47.35 206.79 40.77 69.01 40.77 68.47 47.35" />
                                    <polygon class="cls-6"
                                        points="68.47 51.07 206.25 51.07 206.79 44.48 69.01 44.48 68.47 51.07" />
                                    <polygon class="cls-6"
                                        points="68.47 54.78 206.25 54.78 206.79 48.2 69.01 48.2 68.47 54.78" />
                                    <polygon class="cls-6"
                                        points="68.47 58.5 206.25 58.5 206.79 51.91 69.01 51.91 68.47 58.5" />
                                    <polygon class="cls-6"
                                        points="68.47 62.22 206.25 62.22 206.79 55.63 69.01 55.63 68.47 62.22" />
                                    <rect class="cls-7" x="96.01" y="165.23" width="4.76" height="53.09"
                                        transform="translate(196.79 383.54) rotate(180)" />
                                    <rect class="cls-4" x="96.63" y="165.19" width="1.35" height="53.09"
                                        transform="translate(194.6 383.47) rotate(180)" />
                                    <rect class="cls-4" x="98.54" y="165.19" width="0.53" height="53.09"
                                        transform="translate(197.6 383.47) rotate(180)" />
                                    <path class="cls-3"
                                        d="M80.76,217.11H116a0,0,0,0,1,0,0v0a4.44,4.44,0,0,1-4.44,4.44H85.21a4.44,4.44,0,0,1-4.44-4.44v0A0,0,0,0,1,80.76,217.11Z"
                                        transform="translate(196.79 438.67) rotate(180)" />
                                    <path class="cls-3"
                                        d="M89.84,198.19h0a1.38,1.38,0,0,0,1.37-1.37V162a1.37,1.37,0,0,0-1.37-1.37h0A1.37,1.37,0,0,0,88.46,162v34.81A1.38,1.38,0,0,0,89.84,198.19Z" />
                                    <polygon class="cls-8"
                                        points="77.07 177.85 119.72 177.85 114.81 148.05 81.98 148.05 77.07 177.85" />
                                    <ellipse id="_Path_" data-name="&lt;Path&gt;" class="cls-7" cx="250"
                                        cy="361.29" rx="193.89" ry="11.32" />
                                    <rect class="cls-9" x="103.78" y="147.42" width="1" height="18.49"
                                        transform="translate(-10.98 7.9) rotate(-4.12)" />
                                    <rect class="cls-9" x="105.38" y="175.4" width="1" height="6.96"
                                        transform="translate(-12.58 8.07) rotate(-4.12)" />
                                    <path class="cls-9"
                                        d="M337.71,260.21H123.55a9.65,9.65,0,0,1-9.44-8.81L103.59,105.27a8.1,8.1,0,0,1,8.17-8.8H325.92a9.65,9.65,0,0,1,9.44,8.8L345.88,251.4A8.11,8.11,0,0,1,337.71,260.21Z" />
                                    <path class="cls-9"
                                        d="M338.53,260.21H124.37a9.65,9.65,0,0,1-9.44-8.81L104.41,105.27a8.1,8.1,0,0,1,8.17-8.8H326.74a9.65,9.65,0,0,1,9.44,8.8L346.7,251.4A8.1,8.1,0,0,1,338.53,260.21Z" />
                                    <path class="cls-10"
                                        d="M338.53,260.21H124.37a9.65,9.65,0,0,1-9.44-8.81L104.41,105.27a8.1,8.1,0,0,1,8.17-8.8H326.74a9.65,9.65,0,0,1,9.44,8.8L346.7,251.4A8.1,8.1,0,0,1,338.53,260.21Z" />
                                    <path class="cls-9"
                                        d="M327.06,100.87H112.9q-.36,0-.72,0c-5.47.45-4.35,8.78,1.17,8.78H327.87c5.53,0,5.45-8.33-.09-8.78Q327.42,100.87,327.06,100.87Z" />
                                    <path class="cls-4"
                                        d="M118.48,105.27a1.85,1.85,0,0,1-1.88,2,2.2,2.2,0,0,1-2.16-2,1.86,1.86,0,0,1,1.87-2A2.21,2.21,0,0,1,118.48,105.27Z" />
                                    <path class="cls-4"
                                        d="M125.35,105.27a1.85,1.85,0,0,1-1.88,2,2.2,2.2,0,0,1-2.16-2,1.86,1.86,0,0,1,1.87-2A2.21,2.21,0,0,1,125.35,105.27Z" />
                                    <path class="cls-4"
                                        d="M132.21,105.27a1.85,1.85,0,0,1-1.87,2,2.19,2.19,0,0,1-2.16-2,1.85,1.85,0,0,1,1.87-2A2.21,2.21,0,0,1,132.21,105.27Z" />
                                    <path class="cls-5"
                                        d="M332.85,245.62H128a3.49,3.49,0,0,1-3.42-3.19l-8.65-120.17a2.92,2.92,0,0,1,3-3.19h204.9a3.48,3.48,0,0,1,3.42,3.19l8.66,120.17A2.94,2.94,0,0,1,332.85,245.62Z" />
                                    <polygon class="cls-5"
                                        points="246.53 199.85 243.19 153.53 233.09 147.44 205.28 147.44 209.06 199.85 246.53 199.85" />
                                    <path class="cls-9"
                                        d="M246.53,200.33H209.06a.49.49,0,0,1-.49-.45l-3.77-52.4a.5.5,0,0,1,.13-.37.47.47,0,0,1,.35-.15h27.81a.45.45,0,0,1,.25.07l10.1,6.08a.47.47,0,0,1,.24.38L247,199.81a.47.47,0,0,1-.13.37A.51.51,0,0,1,246.53,200.33Zm-37-1H246l-3.28-45.55L233,147.93H205.8Z" />
                                    <polygon class="cls-1"
                                        points="243.19 153.53 233.09 147.44 236.8 155.5 243.19 153.53" />
                                    <path class="cls-9"
                                        d="M236.8,156a.48.48,0,0,1-.44-.29l-3.71-8a.48.48,0,0,1,.69-.62l10.1,6.08a.5.5,0,0,1,.24.48.51.51,0,0,1-.34.4l-6.4,2Zm-2.61-7.32,2.87,6.24,5-1.53Z" />
                                    <path class="cls-9"
                                        d="M221,171.05a2,2,0,0,1-2,2.12,2.31,2.31,0,0,1-2.26-2.12,1.93,1.93,0,0,1,2-2.11A2.31,2.31,0,0,1,221,171.05Z" />
                                    <path class="cls-9"
                                        d="M234.7,171.05a1.94,1.94,0,0,1-2,2.12,2.32,2.32,0,0,1-2.27-2.12,1.94,1.94,0,0,1,2-2.11A2.3,2.3,0,0,1,234.7,171.05Z" />
                                    <path class="cls-9"
                                        d="M238.58,184.78a.48.48,0,0,1-.48-.45c-.25-3.4-5.59-6.17-11.9-6.17-4.19,0-7.95,1.24-9.81,3.25a3.74,3.74,0,0,0-1.14,2.85.49.49,0,0,1-1,.07,4.75,4.75,0,0,1,1.4-3.58c2-2.2,6.07-3.56,10.52-3.56,6.93,0,12.58,3.11,12.86,7.07a.48.48,0,0,1-.45.52Z" />
                                    <path class="cls-9"
                                        d="M213.17,166.76a.46.46,0,0,1-.33-.13.48.48,0,0,1,0-.68l2.13-2.29a.47.47,0,0,1,.68,0,.48.48,0,0,1,0,.68l-2.13,2.29A.47.47,0,0,1,213.17,166.76Z" />
                                    <path class="cls-9"
                                        d="M237.58,166.76a.5.5,0,0,1-.33-.13l-2.45-2.28a.48.48,0,0,1,0-.69.47.47,0,0,1,.68,0l2.45,2.29a.48.48,0,0,1,0,.68A.51.51,0,0,1,237.58,166.76Z" />
                                    <path class="cls-9"
                                        d="M202.26,210.2h2.26l3.26,4.33-.31-4.33h2.28l.56,7.83H208l-3.24-4.3.31,4.3h-2.28Z" />
                                    <path class="cls-9"
                                        d="M211.33,214.12a3.79,3.79,0,0,1,.86-3,3.72,3.72,0,0,1,2.9-1.07,4.38,4.38,0,0,1,3.09,1.05,4.32,4.32,0,0,1,1.27,2.94,4.81,4.81,0,0,1-.3,2.25,3,3,0,0,1-1.24,1.37,4.26,4.26,0,0,1-2.14.49,5.1,5.1,0,0,1-2.23-.43,3.6,3.6,0,0,1-1.5-1.33A4.66,4.66,0,0,1,211.33,214.12Zm2.43,0a2.77,2.77,0,0,0,.56,1.71,1.63,1.63,0,0,0,1.24.52,1.38,1.38,0,0,0,1.17-.51A2.75,2.75,0,0,0,217,214a2.57,2.57,0,0,0-.56-1.62,1.64,1.64,0,0,0-1.25-.51,1.38,1.38,0,0,0-1.14.52A2.48,2.48,0,0,0,213.76,214.13Z" />
                                    <path class="cls-9"
                                        d="M224.15,210.2h3.6a4.51,4.51,0,0,1,1.74.29,3.06,3.06,0,0,1,1.14.83,3.76,3.76,0,0,1,.71,1.25,6.3,6.3,0,0,1,.3,1.52,5.08,5.08,0,0,1-.15,1.95,2.8,2.8,0,0,1-.71,1.16,2.3,2.3,0,0,1-1,.62,5.56,5.56,0,0,1-1.43.21h-3.59ZM226.7,212l.31,4.28h.59a2.48,2.48,0,0,0,1.07-.16,1.08,1.08,0,0,0,.46-.59,3.56,3.56,0,0,0,.08-1.36,2.78,2.78,0,0,0-.53-1.71,1.85,1.85,0,0,0-1.38-.46Z" />
                                    <path class="cls-9"
                                        d="M237.45,216.74H234.7l-.29,1.29h-2.47l2.38-7.83H237l3.51,7.83h-2.54Zm-.63-1.69-1.06-2.82-.66,2.82Z" />
                                    <path class="cls-9"
                                        d="M239.37,210.2h7.36l.14,1.93H244.4l.42,5.9H242.4l-.42-5.9h-2.47Z" />
                                    <path class="cls-9"
                                        d="M252.37,216.74h-2.75l-.29,1.29h-2.47l2.38-7.83h2.64l3.5,7.83h-2.53Zm-.63-1.69-1.07-2.82-.65,2.82Z" />
                                    <path class="cls-11"
                                        d="M353.69,118.13c.89-.45,2-1,2.94-1.57s2-1.13,3-1.72c1.95-1.21,3.93-2.4,5.8-3.73a76.14,76.14,0,0,0,10.52-8.65c.41-.38.77-.81,1.16-1.21l.57-.61.28-.31.14-.15s0,0,0,0l0,0c-.14.27,0,.19,0-.07a5.28,5.28,0,0,0,.15-1.09,30.52,30.52,0,0,0-.73-6.32c-.89-4.49-2.24-9.1-3.57-13.62l3.88-1.7A80.94,80.94,0,0,1,383.94,91a31.57,31.57,0,0,1,1.72,7.89,12.07,12.07,0,0,1-.08,2.51,7.67,7.67,0,0,1-1.22,3.28l-.17.23-.13.17-.15.19-.31.37-.62.75c-.41.5-.81,1-1.25,1.48A71.3,71.3,0,0,1,370.35,118c-2,1.49-4.12,2.91-6.29,4.19q-1.6,1-3.27,1.89c-1.13.62-2.19,1.17-3.47,1.76Z" />
                                    <path class="cls-9"
                                        d="M344.79,353.23a10.27,10.27,0,0,0,2.22-.3.22.22,0,0,0,.15-.16.21.21,0,0,0-.09-.2c-.29-.19-2.83-1.83-3.81-1.39a.68.68,0,0,0-.39.56,1.14,1.14,0,0,0,.33,1.05A2.41,2.41,0,0,0,344.79,353.23Zm1.65-.59c-1.45.29-2.55.24-3-.14a.77.77,0,0,1-.2-.71c0-.17.1-.22.17-.25C343.94,351.31,345.41,352,346.44,352.64Z" />
                                    <path class="cls-9"
                                        d="M347,352.93a.21.21,0,0,0,.2-.2c0-.1,0-2.51-.92-3.32a1.05,1.05,0,0,0-.84-.26.69.69,0,0,0-.67.55c-.19.94,1.33,2.75,2.13,3.21Zm-1.43-3.39a.61.61,0,0,1,.44.17,4.51,4.51,0,0,1,.78,2.64c-.8-.64-1.75-2-1.63-2.57,0-.1.07-.21.32-.24Z" />
                                    <path class="cls-11"
                                        d="M346.22,93.11c-1,5-3,15,.45,18.36,0,0-1.36,5-10.59,5-10.16,0-4.85-5-4.85-5,5.54-1.32,5.39-5.44,4.43-9.3Z" />
                                    <path class="cls-12"
                                        d="M329.28,113.47c-1.59.22-.23-3.91.41-4.34,1.5-1,20.86-2.39,20.73,0-.08,1-.56,3-1.4,3.65S343.2,111.39,329.28,113.47Z" />
                                    <path class="cls-12"
                                        d="M332.44,112.08c-1.27.43-1.15-3.73-.72-4.23,1-1.16,16.67-5.19,17.13-2.91.18,1,.27,3-.27,3.71S343.44,108.15,332.44,112.08Z" />
                                    <path class="cls-12"
                                        d="M326.61,84.16a.43.43,0,0,1-.33-.15,3.18,3.18,0,0,0-2.59-1.23.39.39,0,0,1-.44-.35.41.41,0,0,1,.35-.44,4,4,0,0,1,3.29,1.52.4.4,0,0,1-.05.56A.5.5,0,0,1,326.61,84.16Z" />
                                    <path class="cls-13"
                                        d="M324.67,89.05a17.91,17.91,0,0,1-2,4.53,2.9,2.9,0,0,0,2.44.21Z" />
                                    <path class="cls-12"
                                        d="M325.16,87.83c.07.68-.24,1.26-.68,1.3s-.85-.47-.91-1.14.24-1.25.67-1.3S325.09,87.16,325.16,87.83Z" />
                                    <path class="cls-12" d="M324.44,86.71l-1.66-.3S323.73,87.59,324.44,86.71Z" />
                                    <polygon class="cls-11"
                                        points="356.7 352.73 348.32 352.73 348.98 333.33 357.36 333.33 356.7 352.73" />
                                    <path class="cls-12"
                                        d="M347.66,351.76h9.41a.67.67,0,0,1,.67.58l1.07,7.44a1.35,1.35,0,0,1-1.34,1.49c-3.28-.06-4.86-.25-9-.25-2.55,0-6.27.27-9.78.27s-3.71-3.48-2.24-3.8c6.56-1.41,7.6-3.35,9.81-5.21A2.17,2.17,0,0,1,347.66,351.76Z" />
                                    <g class="cls-14">
                                        <polygon
                                            points="357.36 333.34 348.98 333.34 348.64 343.34 357.02 343.34 357.36 333.34" />
                                    </g>
                                    <path class="cls-11"
                                        d="M323.37,123.09c-5.18-2-10.12-4.23-15.05-6.75a91.31,91.31,0,0,1-14.4-8.78,32,32,0,0,1-3.42-3.07c-.28-.3-.56-.57-.83-.92a11.32,11.32,0,0,1-.88-1.13,7.94,7.94,0,0,1-1.34-3.61,8.22,8.22,0,0,1,.49-3.62,10.9,10.9,0,0,1,1.41-2.61,18.71,18.71,0,0,1,3.39-3.52,41.33,41.33,0,0,1,7.3-4.66c1.24-.66,2.5-1.25,3.78-1.8s2.54-1.07,3.91-1.54l1.77,3.85c-4.36,2.75-8.88,5.77-12.2,9.16a13.86,13.86,0,0,0-1.95,2.49c-.48.79-.47,1.38-.39,1.33s0,0,.14.1l.4.43a7.07,7.07,0,0,0,.55.54,24.44,24.44,0,0,0,2.69,2.17,64.74,64.74,0,0,0,6.44,4c2.25,1.25,4.57,2.45,6.93,3.59,4.72,2.25,9.6,4.43,14.39,6.41Z" />
                                    <path class="cls-11"
                                        d="M312,82.2l1.38-3L307.06,77s-2,5.9.37,8.63h0A6.05,6.05,0,0,0,312,82.2Z" />
                                    <polygon class="cls-11"
                                        points="313.35 72.7 308.32 71.25 307.06 77.01 313.35 79.2 313.35 72.7" />
                                    <path class="cls-11" d="M378.35,79.49l.73-7L372.6,74s-.1,6.58,3.33,7.63Z" />
                                    <polygon class="cls-11"
                                        points="375.96 67.55 371.73 69.53 372.6 73.99 379.08 72.47 375.96 67.55" />
                                    <path class="cls-11"
                                        d="M347.54,83.3c.31,8.31.61,11.82-3.14,16.47-5.65,7-15.92,5.55-18.7-2.5-2.5-7.25-2.58-19.61,5.18-23.7A11.34,11.34,0,0,1,347.54,83.3Z" />
                                    <path class="cls-12"
                                        d="M343.92,99.75c8.16-3.52,13.52-11,11.26-22.57C353,66.06,345.51,65,342.41,67.27S331.58,66.14,326.94,70c-8,6.76-.44,14,3.52,18.37C332.82,93.27,335.92,103.21,343.92,99.75Z" />
                                    <path class="cls-9"
                                        d="M340.53,75.18a8.29,8.29,0,1,0,1.83-11.91A8.54,8.54,0,0,0,340.53,75.18Z" />
                                    <path class="cls-12"
                                        d="M342.65,68.05c-1.17-6.7,5.16-11.86,13.64-9.37s4,10,2.25,16,2.83,11.72,4.73,7.15-1.3-6-1.3-6,9,2.33.64,12.47-15.93-1-13.88-7.66C350.39,75.32,343.76,74.38,342.65,68.05Z" />
                                    <path class="cls-12"
                                        d="M334.18,70.58c-3.87-2-10.42-3.65-14.15,2.62-1.76,3-1.08,7-1.08,7l11.39.76Z" />
                                    <path class="cls-12"
                                        d="M317.61,78.22h0a.24.24,0,0,1-.24-.26c0-.17.29-4.19,2.72-6.72,5.87-6.1,12.75-1,14.71.66a.25.25,0,0,1-.32.38c-1.89-1.63-8.47-6.47-14-.69-2.3,2.39-2.58,6.36-2.58,6.4A.25.25,0,0,1,317.61,78.22Z" />
                                    <path class="cls-11"
                                        d="M331.85,88.08a6.91,6.91,0,0,1-1.65,4.28c-1.38,1.61-3,.82-3.33-1-.33-1.62,0-4.4,1.74-5.38S331.87,86.23,331.85,88.08Z" />
                                    <path class="cls-12"
                                        d="M330.05,164.17s.54,58.14,5.58,90.54c4.08,26.17,11.61,86.69,11.61,86.69h11.43s1.11-58.42-1-84.31c-5.23-65.49,8.28-77.74-2.62-92.92Z" />
                                    <path class="cls-15"
                                        d="M330.05,164.17s.54,58.14,5.58,90.54c4.08,26.17,11.61,86.69,11.61,86.69h11.43s1.11-58.42-1-84.31c-5.23-65.49,8.28-77.74-2.62-92.92Z" />
                                    <path class="cls-16"
                                        d="M336.06,190.55c4,17.55.81,45.19-1.38,57.36-2.32-18.48-3.49-42.43-4.07-60C332.68,184.57,334.64,184.35,336.06,190.55Z" />
                                    <polygon class="cls-9"
                                        points="345.68 341.63 360.23 341.63 360.99 336.52 345.6 336 345.68 341.63" />
                                    <path class="cls-9"
                                        d="M349.83,115.09c1.37-2.72,8.73-4.43,12.75-4.43l3,13.37s-8,11.89-11.34,10.63C350.31,133.17,346.9,120.92,349.83,115.09Z" />
                                    <path class="cls-17"
                                        d="M349.83,115.09c1.37-2.72,8.73-4.43,12.75-4.43l3,13.37s-8,11.89-11.34,10.63C350.31,133.17,346.9,120.92,349.83,115.09Z" />
                                    <path class="cls-9"
                                        d="M341.35,338.36a.2.2,0,0,0,0-.2.21.21,0,0,0-.21-.1c-.42.06-4.12.65-4.62,1.71a.63.63,0,0,0,0,.62,1.07,1.07,0,0,0,.86.57c1.21.13,3-1.55,3.9-2.57Zm-4.44,1.54c.34-.56,2.26-1.08,3.72-1.35-1.32,1.34-2.48,2.09-3.16,2a.73.73,0,0,1-.56-.38.25.25,0,0,1,0-.25S336.9,339.91,336.91,339.9Z" />
                                    <path class="cls-9"
                                        d="M341.35,338.36l0,0a.19.19,0,0,0,0-.19c-.06-.08-1.54-1.78-2.91-1.87a1.4,1.4,0,0,0-1.09.37.7.7,0,0,0-.27.89c.43.86,3.09,1.15,4.16.93A.18.18,0,0,0,341.35,338.36Zm-3.91-1.26a.79.79,0,0,1,.16-.18,1,1,0,0,1,.79-.27,4.65,4.65,0,0,1,2.39,1.46c-1.19.1-3.11-.26-3.37-.77A.24.24,0,0,1,337.44,337.1Z" />
                                    <polygon class="cls-11"
                                        points="350.08 334.81 342.42 338.21 339.01 331.11 334.55 321.81 334.02 320.73 341.68 317.32 342.27 318.53 346.59 327.54 350.08 334.81" />
                                    <polygon class="cls-18"
                                        points="346.59 327.54 339.01 331.11 334.55 321.81 342.27 318.53 346.59 327.54" />
                                    <path class="cls-12"
                                        d="M321.07,164.17S296.6,225,303.23,253.65c6,25.89,32.5,74.92,32.5,74.92L346,323.43s-16.39-59.19-18.16-72.05c-3.46-25,18.77-60.33,18.77-87.21Z" />
                                    <path class="cls-15"
                                        d="M321.07,164.17S296.6,225,303.23,253.65c6,25.89,32.5,74.92,32.5,74.92L346,323.43s-16.39-59.19-18.16-72.05c-3.46-25,18.77-60.33,18.77-87.21Z" />
                                    <path class="cls-12"
                                        d="M341.06,337.15l7.6-5.54a.67.67,0,0,1,.88.07l5.25,5.39a1.35,1.35,0,0,1-.21,2c-2.69,1.88-4.08,2.66-7.42,5.09-2.06,1.5-6.16,4.81-9,6.88s-5-.63-4-1.75c4.48-5,5.42-8.1,6.12-10.9A2.17,2.17,0,0,1,341.06,337.15Z" />
                                    <polygon class="cls-9"
                                        points="335.07 330.74 348.3 324.69 346.61 319.3 332.44 325.76 335.07 330.74" />
                                    <path class="cls-9"
                                        d="M327.56,114.41c-1.09-2.84-10.65-6-15.45-7L310,123.13s7.84,11.26,11.27,10.32C325.33,132.36,329.92,120.49,327.56,114.41Z" />
                                    <path class="cls-17"
                                        d="M327.56,114.41c-1.09-2.84-10.65-6-15.45-7L310,123.13s7.84,11.26,11.27,10.32C325.33,132.36,329.92,120.49,327.56,114.41Z" />
                                    <path class="cls-9"
                                        d="M317.07,113.61s-4,1.41,4,50.56h34c-.57-13.85-.59-22.38,6-50.8a100.28,100.28,0,0,0-14.45-1.9,107.4,107.4,0,0,0-15.44,0C324.59,112.07,317.07,113.61,317.07,113.61Z" />
                                    <path class="cls-17"
                                        d="M317.07,113.61s-4,1.41,4,50.56h34c-.57-13.85-.59-22.38,6-50.8a100.28,100.28,0,0,0-14.45-1.9,107.4,107.4,0,0,0-15.44,0C324.59,112.07,317.07,113.61,317.07,113.61Z" />
                                    <path class="cls-9"
                                        d="M355.6,162.17l1.53,3.05c.12.23-.16.47-.55.47H320.9c-.31,0-.56-.15-.58-.34l-.31-3c0-.21.25-.39.58-.39H355A.63.63,0,0,1,355.6,162.17Z" />
                                    <path class="cls-19"
                                        d="M355.6,162.17l1.53,3.05c.12.23-.16.47-.55.47H320.9c-.31,0-.56-.15-.58-.34l-.31-3c0-.21.25-.39.58-.39H355A.63.63,0,0,1,355.6,162.17Z" />
                                    <path class="cls-12"
                                        d="M351,166h.92c.19,0,.33-.09.31-.21l-.43-3.95c0-.12-.17-.21-.35-.21h-.93c-.18,0-.32.09-.31.21l.43,3.95C350.63,165.93,350.79,166,351,166Z" />
                                    <path class="cls-12"
                                        d="M328.61,166h.92c.18,0,.32-.09.31-.21l-.43-3.95c0-.12-.17-.21-.36-.21h-.92c-.19,0-.32.09-.31.21l.43,3.95C328.26,165.93,328.42,166,328.61,166Z" />
                                </g>
                            </g>
                        </svg>
                    </div>
                    <div class="details">
                        <h5>No Flights Found</h5>
                        <p class="desc">Sorry, It seems no flight is available at this moment. Please try again later.
                        </p>
                    </div>
                    <div class="actions">
                        <button class="sec" onclick="window.history.back()">Go Back</button>
                        <button class="prime" onclick="window.location.reload()">Re-fetch</button>
                    </div>
                @elseif($code == 'TOUT')
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
                        <p class="desc">Server has taken more time than usual. Please re-fetch flights.</p>
                    </div>
                    <div class="actions">
                        <button class="sec" onclick="window.history.back()">Go Back</button>
                        <button class="prime" onclick="window.location.reload()">Re-fetch</button>
                    </div>
                @endif
            </div>
        @endif
    </main>
@endsection

@push('js')

    <script src="{{ url('js/vu-select.js') }}"></script>
    <script>

        function filter() {
            $('.flight').perform((n) => {
                console.log(n.$(".flight_price").innerText);
            });
        }
        $(".flight_overview").perform((n) => {
            n.set('data-height', n.clientHeight + "px");
            n.addCSS("height", "0");
            n.addCSS("overflow", "hidden");
        })

        function view_details(node) {
            let panel = node.closest('.panel');
            let overview = panel.$(".flight_overview")[0];
            if (overview.hasClass('active')) {
                overview.addCSS('height', "0");
                overview.removeClass('active');
            } else {
                overview.addCSS('height', overview.get('data-height'));
                overview.addClass('active');
                setTimeout(() => {
                    overview.addCSS('height', 'unset');
                }, 400);
            }
        }
        $(".overview_types").perform((n) => {
            n.$("button").perform((x, i, xo) => {
                x.addEventListener('click', function() {
                    var over_div = x.closest('.flight_overview');
                    xo.perform((y) => {
                        if (y == x) {
                            y.addClass('active');
                            over_div.$(".overview_" + y.innerText.toLowerCase())[0]
                                .addClass('active');
                        } else {
                            y.removeClass('active');
                            over_div.$(".overview_" + y.innerText.toLowerCase())[0]
                                .removeClass('active');
                        }
                    });
                });
            })
        })



        function select_flight(node, val) {
            if (event.target.classList.contains("ret_btn")) {
                var retButtons = document.querySelectorAll(".ret_btn");
                retButtons.forEach(function(x) {
                    if (event.target === x) {
                        x.innerText = "Selected";
                        x.classList.add("selected");
                    } else {
                        x.innerText = "Select";
                        x.classList.remove("selected");
                    }
                });
                var firstThreeValues = val.slice(0, 3);
                document.getElementById(node).value = val; // Set all values in the value attribute
                document.getElementById('three_retindex').innerText = firstThreeValues;
            } else if (event.target.classList.contains("dep_btn")) {
                var depButtons = document.querySelectorAll(".dep_btn");
                depButtons.forEach(function(x) {
                    if (event.target === x) {
                        x.innerText = "Selected";
                        x.classList.add("selected");
                    } else {
                        x.innerText = "Select";
                        x.classList.remove("selected");
                    }
                });
                var firstThreeValues = val.slice(0, 3);
                document.getElementById(node).value = val; // Set all values in the value attribute
                document.getElementById('three_depindex').innerText = firstThreeValues; // Set first three values as the content of the span element
            }
        }

        let today = new Date();
        document.getElementById("dep_date").setAttribute("min",
            `${today.getFullYear()}-${String(today.getMonth()+1).padStart(2,'0')}-${String(today.getDate()).padStart(2,'0')}`
        );
        document.getElementById("ret_date").setAttribute("min",
            `${today.getFullYear()}-${String(today.getMonth()+1).padStart(2,'0')}-${String(today.getDate()).padStart(2,'0')}`
        );

        document.getElementById("po1").addEventListener('click', function() {
            document.getElementById("ret_date").value = '';
            document.getElementById("dep_date").removeAttribute('max');
        });

        document.getElementById("dep_date").addEventListener('change', function() {
            let min = this.value;
            document.getElementById("ret_date").setAttribute("min", min);
        });
        document.getElementById("ret_date").addEventListener('change', function() {
            document.getElementById("po2").checked = true;
            document.getElementById("dep_date").setAttribute('max', this.value);
        });



        const fetchOptions = (value, callback) => {
            ajax({
                url: `{{ url('api/airports') }}/${value}`,
                success: (res) => callback(JSON.parse(res)),
            });
        };

        const optionGenerator = (port) =>
            `<div class="vu-option" data-value="${port.airport_code}" data-airport_code="${port.airport_code}" data-airport_name="${port.airport_name}"><i class="fa-solid fa-plane"></i><div class="port"><h6>${port.airport_city}<span> (${port.airport_code})</span></h6><p>${port.airport_name}</p></div><p class="country">${port.airport_country_code}<img src="https://cdn.kcak11.com/CountryFlags/countries/${port.airport_country_code.toLowerCase()}.svg" style="margin-left: 2px; "> </p></div>`;

        const fromSelect = new vu_select($(".vu-select")[0], {
            optionGenerator,
            fetchOptions
        });
        const toSelect = new vu_select($(".vu-select")[1], {
            optionGenerator,
            fetchOptions
        });


        document.querySelector(".pax").addEventListener('click', function() {
            function hide_pax(event) {
                if (!document.querySelector(".pax").contains(event.target)) {
                    document.querySelector(".pax").classList.remove('active');
                    updateCount();
                    document.removeEventListener('click', hide_pax);
                }
            }
            if (!this.classList.contains('active')) {
                this.classList.add('active');
                document.addEventListener('click', hide_pax);
            }
        });

        document.querySelectorAll(".counter").forEach(function(counter) {
            let input = counter.querySelector("input");
            counter.querySelector(".fa-plus").addEventListener('click', function() {
                let x = Number(input.value) + 1;
                if (x <= 9) { // Check if the total is within the limit
                    input.value = x;
                    updateCount();
                }
            });
            counter.querySelector(".fa-minus").addEventListener('click', function() {
                let x = Number(input.value) - 1;
                if (x >= 0) { // Ensure the count doesn't go negative
                    input.value = x;
                    updateCount();
                }
            });
        });

        function updateCount() {
            var t = document.querySelector('input[name="travelclass"]:checked ~ label').innerText;
            let adultCount = +document.getElementById('adult_pax').value;
            let childCount = +document.getElementById('child_pax').value;
            let infantCount = +document.getElementById('infant_pax').value;
            let totalPassengers = adultCount + childCount + infantCount;

            // Check if the total exceeds 9
            if (totalPassengers > 9) {
                // Distribute the excess among adults, children, and infants
                while (totalPassengers > 9) {
                    if (infantCount > 0) {
                        infantCount--;
                    } else if (childCount > 0) {
                        childCount--;
                    } else {
                        adultCount--;
                    }
                    totalPassengers--;
                }
            }

            document.getElementById("adult_pax").value = adultCount;
            document.getElementById("child_pax").value = childCount;
            document.getElementById("infant_pax").value = infantCount;

            document.getElementById("pass_det").innerHTML =
                `${totalPassengers} ${totalPassengers > 1 ? "Passengers" : "Passenger"}, <span>${t}</span>`;
        }



        document.addEventListener('DOMContentLoaded', function() {
            let loadMoreButton = document.getElementById('load_more');
            // let resultCount = document.getElementById('result_count');
            let flightsVisible = 20;
            const flights = document.querySelectorAll('.flight-hidden');
            const totalFlights = {{ isset($totalFlights) ? $totalFlights : 0 }};

            loadMoreButton.addEventListener('click', function() {
                let newFlightsVisible = flightsVisible + 30;
                for (let i = flightsVisible - 20; i < newFlightsVisible - 20 && i < flights.length; i++) {
                    flights[i].style.display = 'block';
                    flights[i].classList.remove('flight-hidden');
                    flights[i].classList.add('flight-visible');
                }
                flightsVisible = newFlightsVisible;

                if (flightsVisible >= totalFlights) {
                    loadMoreButton.style.display = 'none';
                }
            });
        });
    </script>

<!-- Include jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    
    $('.filter .head').click(function(){
        $('.filter-body').slideToggle()
    })
    $('.round .select_show_btn').click(function(){
        $('.round .multi_flight_body').slideToggle()
    })

    $(document).ready(function() {
        const trace = $('input[name="trace"]').val();

        $('.stops_filter, .pricing_filter, .time_filter, .airline_filter').on('change', applyFilters);

        function applyFilters() {
            let stops = [];
            $('.stops_filter:checked').each(function() {
                stops.push($(this).val());
            });

            let pricing = '';
            $('.pricing_filter:checked').each(function() {
                pricing = $(this).val();
            });

            let time_of_day = [];
            $('.time_filter:checked').each(function() {
                time_of_day.push($(this).val());
            });

            let airlines = [];
            $('.airline_filter:checked').each(function() {
                airlines.push($(this).val());
            });

            const data = {
                stops: stops,
                pricing: pricing,
                time_of_day: time_of_day,
                airlines: airlines,
               
            };
            

            $.ajax({
                url: '/flight/filter',
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: JSON.stringify(data),
                success: function(responseData) {
                    let newData = responseData.flights[0];
                    console.log('Success:', responseData, newData);
                    reloadFlightData(newData);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }

        function reloadFlightData(flights) {
            const oneWayContainer = $('#one-way');
            if (oneWayContainer.length && flights) {
                oneWayContainer.html(renderFlights(flights));
            } else {
                console.error('Error: Unable to find the container or flights data is undefined.');
            }
        }

        function renderFlights(flights) {
            if (!flights || flights.length === 0) {
                return '<p>No flights available.</p>';
            }

            let totalFlights = flights.length;
            let filtersApplied = ''; // Customize this if you need to display applied filters

            let flightHtml = `
                <div class="header_bar rflex">
                    <p class="result_count">Showing <span>${totalFlights}</span> results</p>
                    <p>Filters applied: ${filtersApplied}</p>
                </div>
                <div>
                    ${flights.map((flight, i) => {
                        const segments = flight['Segments'][0];
                        const airline = segments[0]['Airline'];
                        const origin = segments[0]['Origin'];
                        const destination = segments[segments.length - 1]['Destination'];
                        let duration = segments[0]['Duration'];

                        for (let popo = 1; popo < segments.length; popo++) {
                            duration = segments[popo]['AccumulatedDuration'] || segments[1]['Duration'];
                        }

                        return `
                        <div class="panel">
                            <div class="flight">
                                <div class="head">
                                    <div class="img-box">
                                        <img class="tail" width="98" height="98" src="{{ asset('images/flight/svg/tail.svg') }}" alt="airplane-tail-fin"/>
                                        <img src="{{ asset('images/flight/AirlineLogo') }}/${airline['AirlineCode']}.gif" alt="${airline['AirlineName']} logo" class="airline-logo">
                                    </div>
                                    <div class="text-box">
                                        <h4 class="line">${airline['AirlineName']}</h4>
                                        <h6 class="flight-number">${airline['AirlineCode']}-${airline['FlightNumber']}</h6>
                                        <p class="lcc">${flight['IsLCC'] ? 'LCC - Ticket' : 'Non-LCC - Book'}</p>
                                    </div>
                                </div>
                                <div class="flight_details rflex">
                                    <div class="origin location cflex">
                                        <div class="city_code">
                                            <h4>${origin['Airport']['AirportCode']}</h4>
                                            <p>${origin['Airport']['CityName']}</p>
                                        </div>
                                        <div class="city">
                                            <span>T-${origin['Airport']['Terminal']}</span> ${origin['Airport']['AirportName']}
                                        </div>
                                    </div>
                                    <div class="flight_time">
                                        <p>${Math.floor(duration / 60)}<span>Hours</span>${duration % 60}<span>Minutes</span></p>
                                        ${segments.length > 1 ? `<p class="stops">${segments.length - 1}<span>Stop</span></p>` : `<p class="stops"><span>Non-Stop</span></p>`}
                                        <i class="fa-solid fa-plane" style="--i:${i}"></i>
                                    </div>
                                    <div class="destination location cflex">
                                        <div class="city_code">
                                            <p>${destination['Airport']['CityName']}</p>
                                            <h4>${destination['Airport']['AirportCode']}</h4>
                                        </div>
                                        <div class="city">
                                            <span>T-${destination['Airport']['Terminal']}</span> ${destination['Airport']['AirportName']}
                                        </div>
                                    </div>
                                </div>
                                <div class="options rflex">
                                    <div class="rflex aic">
                                        <div class="price">
                                            <h5><i class="fa-solid fa-indian-rupee-sign"></i> <span class="flight_price">${Math.floor(flight['Fare']['PublishedFare'])}</span></h5>
                                        </div>
                                        <form action="{{ url('flight/review') }}" method="get">
                                            <input type="hidden" name="trace" value="${trace}">
                                            <input type="hidden" name="dep_index" value="${flight['ResultIndex']}">
                                            <button type="submit">Book Ticket</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
                    }).join('')}
                </div>
            `;

            return flightHtml;
        }
    });
</script>

<script>
    // Function to fetch flight data from the API
    function fetchFlightData(from, to) {

    // Encode parameters for the query string
    const params = new URLSearchParams({ from: from, to: to });

    return $.ajax({
        url: `/flight/fare?${params.toString()}`,
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
        },
        dataType: 'json'
        }).then(response => {
            if (response) {
                return response.Response.SearchResults;
            } else {
                console.error('Error fetching flight data');
                return [];
            }
        }).catch(error => {
            console.error('Error:', error);
            return [];
        });
    }

    // Function to parse URL parameters
    function getURLParameter(name) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }

    const urlParams = {
        journey_type: getURLParameter('journey_type'),
        from: getURLParameter('from'),
        to: getURLParameter('to'),
        dep_date: getURLParameter('dep_date'),
        ret_date: getURLParameter('ret_date'),
        adult: getURLParameter('adult'),
        child: getURLParameter('child'),
        infant: getURLParameter('infant'),
        travelclass: getURLParameter('travelclass')
    };

    // Function to format date to "day, dd mmm" format
    function formatDate(dateString) {
        const options = { weekday: 'short', day: '2-digit', month: 'short' };
        return new Date(dateString).toLocaleDateString('en-US', options);
    }

    // Function to calculate new return date if selected dep_date > current ret_date
    function calculateNewReturnDate(depDate, retDate) {
        const dep = new Date(depDate);
        const ret = new Date(retDate);
        if (dep > ret) {
            ret.setDate(dep.getDate() + 1);
        }
        return ret.toISOString().split('T')[0];
    }

    // Main function to initialize the scroller with fetched data
    function initializeScroller() {
        fetchFlightData(urlParams.from, urlParams.to).then(searchResults => {
            const scrollBox = $('#scroll-box');

            searchResults.forEach(result => {
                const depDate = result.DepartureDate.split('T')[0];
                const formattedDate = formatDate(result.DepartureDate);
                const fare = Math.round(result.Fare);

                if (fare > 0) {
                    let newRetDate = urlParams.ret_date ? calculateNewReturnDate(depDate, urlParams.ret_date) : "";

                    // Build the URL dynamically
                    let queryParams = {
                        journey_type: urlParams.journey_type,
                        from: urlParams.from,
                        to: urlParams.to,
                        dep_date: depDate
                    };

                    if (newRetDate) queryParams.ret_date = newRetDate;
                    if (urlParams.adult) queryParams.adult = urlParams.adult;
                    if (urlParams.child) queryParams.child = urlParams.child;
                    if (urlParams.infant) queryParams.infant = urlParams.infant;
                    if (urlParams.travelclass) queryParams.travelclass = urlParams.travelclass;

                    const queryString = Object.keys(queryParams)
                        .map(key => `${key}=${queryParams[key]}`)
                        .join('&');

                    const li = $('<li>').html(`
                        <a href="/flight/search?${queryString}">
                            <h5>${formattedDate}</h5>
                            <h6 style="color:var(--fv_sec);">Rs ${fare}</h6>
                        </a>
                    `);

                    scrollBox.append(li);
                }
            });

            $('#prev').on('click', () => {
                scrollBox.animate({ scrollLeft: '-=200' }, 'smooth');
            });

            $('#next').on('click', () => {
                scrollBox.animate({ scrollLeft: '+=200' }, 'smooth');
            });
        });
    }

    // Initialize the scroller on page load
    $(window).on('load', initializeScroller);

</script>

@endpush
