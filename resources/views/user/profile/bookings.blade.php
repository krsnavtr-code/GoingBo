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
@endphp
@extends('user.components.layout')
@push('css')
<style>
    .filter_layout {
        display: flex;
        --header: 70px;
        padding: 20px;
        gap: 20px;
    }

    .panel {
        box-shadow: 0 0 10px 0 #00000033;
        border-bottom: 6px solid #002346;
        border-radius: 6px;
        padding: 2rem;
        margin: 1rem 0;
    }

    .filter_layout .main_content {
        flex: 1;
    }

    .filterbar {
        padding: 0;
        height: max-content;
    }

    .filterbar ul {
        padding: 0;
        list-style: none;
    }

    .filter_layout li a {
        padding: 1rem;
        display: flex;
        align-items: baseline;
        gap: 1rem;
    }

    .filter_layout li:hover,
    .filter_layout a:hover {
        background-color: #f9f9f9;
        color: var(--fv_sec);
    }

    .booking-tabs li {
        padding-left: 3rem;
    }

    .booking_details {
        margin-bottom: 1rem;
        font-size: 1.2rem;
        display: flex;
        justify-content: space-between;
        gap: 1rem;
    }

    .flex {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .booking p {
        white-space: nowrap;
    }

    .booking_details :is(b, i) {
        color: var(--fv_sec);
    }

    .booking_details span {
        font-weight: 600;
        margin-left: 2px;
    }

    .booking {
        padding-bottom: 10px;
    }

    .booking .flight {
        display: flex;
        align-items: center;
    }

    .booking .flight .middle {
        flex-grow: 1;
        border: 1px dashed var(--gray_500);
        margin-inline: 20px;
        position: relative;
    }

    .booking .flight .middle::after {
        content: '';
        position: absolute;
        left: 0;
        background: var(--gray_500);
        width: 10px;
        aspect-ratio: 1;
        border-radius: 10px;
        transform: translate(-50%, -50%);
    }

    .booking .flight .middle i {
        position: absolute;
        right: 0;
        transform: translate(50%, -50%);
        color: var(--gray_500);
    }

    .booking .flight .city {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--gray_500);
        max-width: 150px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .options {
        margin-top: 10px;
    }

    .options i.icon {
        width: 32px;
        aspect-ratio: 1;
        display: inline-flex;
        justify-content: center;
        align-items: center;
    }

    a.btn {
        font-size: 1.2rem;
        margin-left: 15px;
    }

    @media only screen and (max-width:600px) {

        .filter_layout{
            flex-direction: column;
        }
        .booking_details {
            flex-direction: column-reverse;
        }


        .booking-tabs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            font-size: small;
        }

        .booking-tabs li {
            border: 1px solid #f8f8f8;
            padding-left: 1rem;
        }
    }
</style>
@endpush
@section('main')
<main>
    <div class="filter_layout">
        <nav class="filterbar panel">
            <ul class="main-ul">
                <li>
                    <a href="">
                        <i class="fa-solid fa-user"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li>
                    <a href="/user/bookings">
                        <i class="fa-solid fa-bookmark"></i>
                        <span>Bookings</span>
                    </a>
                </li>
            </ul>
            <ul class="booking-tabs">
                <li>
                    <a href="/user/bookings">
                        <i class="fa-solid fa-plane"></i>
                        <span>Flight</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="fa-solid fa-hotel"></i>
                        <span>Hotel</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="fa-solid fa-bus"></i>
                        <span>Bus</span>
                    </a>
                </li>
                <li>
                    <!--  Add a button to trigger cab data fetch -->
                    <a href="#" id="fetchCabButton">
                        <i class="fa-solid fa-taxi"></i>
                        <span>Cab</span>
                    </a>

                </li>
                <li>
                    <a href="">
                        <i class="fa-solid fa-tree"></i>
                        <span>Holiday Packages</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="fa-solid fa-person"></i>
                        <span>Membership</span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="main_content">
            @php
            // Function to compare dates for sorting
            function compareDates($a, $b) {
            $dateA = strtotime($a['ticket']['FlightItinerary']['InvoiceCreatedOn']);
            $dateB = strtotime($b['ticket']['FlightItinerary']['InvoiceCreatedOn']);
            return $dateB - $dateA; // Sort in descending order
            }

            // Sort the flight bookings array
            usort($flightBookings, 'compareDates');
            @endphp

            <div class="bookings" id="flightBookingsContainer">
                @foreach ($flightBookings as $booking)
                @php
                $segment = $booking['ticket']['FlightItinerary']['Segments'];
                @endphp
                <div class="booking panel">
                    <div class="booking_details">
                        <div class="flex">
                            <p>
                                <i class="fa-solid fa-plane"></i>
                                <span>{{ $segment[0]['Airline']['AirlineCode'] }}-{{ $segment[0]['Airline']['AirlineName'] }}</span>
                            </p>
                            <p>
                                <i class="fa-solid fa-calendar"></i>
                                <span>{{ air_get_date($booking['ticket']['FlightItinerary']['InvoiceCreatedOn']) }}</span>
                            </p>
                            <p>
                                <i class="fa-solid fa-clock"></i>
                                <span>{{ air_get_time($booking['ticket']['FlightItinerary']['InvoiceCreatedOn']) }}</span>
                            </p>
                        </div>
                        <div class="flex">
                            <p>
                                <b>PNR:</b>
                                <span>{{ $booking['pnr'] }}</span>
                            </p>
                            <p>
                                <b>Booking Id:</b>
                                <span>{{ $booking['bookingid'] }}</span>
                            </p>
                        </div>
                    </div>
                    <div class="flight">
                        <div class="from">
                            <h5>
                                {{ $segment[0]['Origin']['Airport']['AirportCode'] }}
                            </h5>
                            <p class="city">
                                {{ $segment[0]['Origin']['Airport']['AirportName'] }}
                            </p>
                        </div>
                        <div class="middle">
                            <i class="fa-solid fa-plane"></i>
                        </div>
                        <div class="to" style="text-align: right">
                            <h5>
                                {{ $segment[count($segment) - 1]['Destination']['Airport']['AirportCode'] }}
                            </h5>
                            <p class="city">
                                {{ $segment[count($segment) - 1]['Destination']['Airport']['AirportName'] }}
                            </p>
                        </div>
                    </div>
                    <div class="options rflex jcsb aic">
                        <div class="passengers" style="font-size: 2rem">
                            @foreach ($booking['ticket']['FlightItinerary']['Passenger'] as $pax)
                            @if ($pax['PaxType'] == 1)
                            <i class="fa-solid fa-person"></i>
                            @elseif($pax['PaxType'] == 2)
                            <i class="fa-solid fa-child" style="font-size: 0.7em"></i>
                            @else
                            <i class="fa-solid fa-baby" style="font-size: 0.5em"></i>
                            @endif
                            @endforeach
                        </div>
                        <div class="rflex aic">
                            <span><i class="fa-regular fa-indian-rupee-sign"></i> {{$booking['payment']['total']}}</span>
                            <a href="{{url('user/bookings/flight/'.$booking['id'])}}" class="btn">View Booking</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="cab bookings">

            </div>
        </div>
    </div>
</main>
@endsection

@push('js')

<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


<script>
    document.addEventListener("DOMContentLoaded", function() {


        // var buttons = document.querySelectorAll(".my_btn");

        // buttons.forEach(function(button) {
        //     button.addEventListener("click", function() {
        //         var a = document.querySelector(".name").value;
        //         var b = ''; // You need to specify the value of 'b' here

        function get_time(d) {
            // Use regular expression to extract the time portion from the datetime string
            var matches = d.match(/T(\d{2}:\d{2})/);
            if (matches) {
                return matches[1]; // Return the extracted time portion
            } else {
                return ''; // Return an empty string if the format doesn't match
            }
        }

        $('#fetchCabButton').click(function() { // Step 3: Add click event to the cab button
            fetchcabs();
        });



        function fetchcabs() {
            $.ajax({
                url: "/fetch-cabs",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    // Code to handle successful response
                    console.log(response.cabs);
                    $('#flightBookingsContainer').hide(); // Step 4: Hide flight bookings container
                    $('.cab').empty(); // Clear any previous cab data

                    $.each(response.cabs, function(key, item) {

                        // Create a div element for each cab
                        var cabDiv = $('<div class=" booking panel"></div>');

                        // Convert date and time to Carbon instances
                        var date = moment(item.date).format("DD-MM-YYYY");
                        var time = get_time(item.time);

                        // Create the HTML string for passengers
                        var html = '<div class="passengers" style="font-size: 2rem">';
                        // Loop to generate <i> elements based on item.passengers
                        for (var i = 0; i < item.passengers; i++) {
                            html += '<i class="fa-solid fa-person"></i>';
                        }
                        html += '</div>';
                        // Parse payment_details JSON string into a JavaScript object
                        var paymentDetails = JSON.parse(item.payment_details);




                        // Add content to the cab div
                        cabDiv.append('<div class="booking_details">' +
                            '<div class="flex">' +
                            '<p><i class="fa-solid fa-car"></i><span> ' + item.cab.cab.driver_name + ' </span></p>' +
                            '<p><i class="fa-solid fa-car"></i><span> ' + item.cab.cab.company_name + ' </span></p>' +
                            '<p><i class="fa-solid fa-car"></i><span> ' + item.cab.cab.vehicle_number + ' </span></p>' +
                            '<p><i class="fa-solid fa-car"></i><span> ' + item.cab.cab.vehicle_model + ' </span></p>' +
                            '<p><i class="fa-solid fa-moon"></i><span> Night Halt: ' + (item.cab.night_halt === '1' ? 'Yes' : 'No') + ' </span></p>' +

                            '<p><i class="fa-solid fa-calendar"></i><span>' + date + '  </span></p>' +
                            '<p><i class="fa-solid fa-clock"></i><span> ' + time + ' </span></p>' +
                            '</div>' +
                            '<div class="flex">' +
                            '<p><b>Booking Id:</b><span>' + item.booking_unique_id + '</span></p>' +
                            '</div>' +
                            '</div>' +
                            '<div class="flight">' +
                            '<div class="from"><h5>' + item.from_city + '</h5></div>' +
                            '<div class="middle"><i class="fa-solid fa-car"></i></div>' +
                            '<div class="to" style="text-align: right"><h5>' + item.to_city + '</h5></div>' +
                            '</div>' +
                            '<div class="options rflex jcsb aic">' +
                            html +
                            '<div class="rflex aic">' +
                            '<span><i class="fa-regular fa-indian-rupee-sign"></i> ' + paymentDetails.total + '</span>' +
                            '<a href="cab/download/ticket/' + item.id + '" class="btn"> Download Ticket </a>' +
                            '</div>' +
                            '</div>');

                        // Append the cab div to the container
                        $('div.cab').append(cabDiv);
                    });
                },
                error: function(xhr, status, error) {
                    // Code to handle errors
                    console.error("Error:", error);
                }
            });
        }

    });
</script>
@endpush