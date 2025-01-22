@extends('user.components.layout')
@push('css')
<link rel="stylesheet" href="css/index.css">
<style>
    section.destinations {
        padding-inline: 50px;
    }

    section .section_head {
        padding: 20px;
    }

    section .section_head .view_all {
        color: var(--fv_sec);
        font-weight: 600;
        font-size: 1.4rem;
        border-bottom: 1.6px solid;
    }

    section .section_head .view_all i {
        margin-left: 7px;
    }

    .destination {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 0 5px 0 #00000033;
    }

    .destination .img-box {
        width: 100%;
        overflow: hidden;
        height: 200px;
    }

    .destination .img-box img {
        width: 100%;
        height: 100%;
        transition: all 2s ease-in-out;
    }

    .destination .img-box:hover img {
        transform: scale(1.2);
    }

    .destination .text-box {
        padding: 1rem;
    }

    .destination .heading {
        color: #000;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }


    .destination .heading span {
    color: var(--fv_sec);
    }

    .destination .details .detail .country {
        padding: 3px 15px;
        width: max-content;
        border-radius: 100px;
        background: #ffffff;
        font-weight: 600;
        font-size: 1rem;
        letter-spacing: 1px;
        color: var(--fv_prime);
    }



    .destination .packages {
        padding-left: 2rem;
        display: grid;
        grid-template-columns: 1fr 1fr;
        justify-content: space-between;
        font-weight: 600;
        font-size: 1.4rem;
    }
    .destination li a {
        font-size: 1.4rem;
        color: var(--fv_prime);
    }
    .destination li:hover a {
        color: var(--fv_sec);
    }

    @media screen and (max-width: 768px) {
        section.destinations {
            padding: 1rem;
        }

        

        .desti-wrap:not(:nth-of-type(3n)) {
            width: 50%;
        }

    }

    .col-border-none {
        --tw-border-opacity: 1;
        border-color: rgb(var(--neutral-100)/var(--tw-border-opacity));
        border-width: 1px;
        border-radius: 10px;

    }

    .flight-link {
        color: #000;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .flight-link:hover {
        color: #ff5e00;
        /* Change text color on hover */
    }

    @media only screen and (max-width:600px) {
   
        section.destinations {
            padding: 0;
        }
        .desti-wrap:not(:nth-of-type(3n)) 
        .destination .packages {
            display: block;
        }
    }

    @media only screen and (max-width:360px) {
        .destination .details {
            padding: 0;
        }

        .flight-link {
            padding: 0;
            font-size: 10px;
            line-height: 18px;
        }
    }
</style>
@endpush
@section('main')
@php
$city = array(
"Mumbai" => array("name" => "Mumbai", "code" => "BOM"),
"Delhi" => array("name" => "Delhi", "code" => "DEL"),
"Kolkata" => array("name" => "Kolkata", "code" => "CCU"),
"Chennai" => array("name" => "Chennai", "code" => "MAA"),
"Hyderabad" => array("name" => "Hyderabad", "code" => "HYD"),
"Ahmedabad" => array("name" => "Ahmedabad", "code" => "AMD"),
"Bangalore" => array("name" => "Bangalore", "code" => "BLR"),
"Patna" => array("name" => "Patna", "code" => "PAT")
);
$flight = array(
"Mumbai" => array(
array("city" => "Goa", "code" => "GOI"),
array("city" => "Delhi", "code" => "DEL"),
array("city" => "Bangalore", "code" => "BLR"),
array("city" => "Ahmedabad", "code" => "AMD")
),
"Delhi" => array(
array("city" => "Mumbai", "code" => "BOM"),
array("city" => "Goa", "code" => "GOI"),
array("city" => "Bangalore", "code" => "BLR"),
array("city" => "Pune", "code" => "PNQ")
),
"Kolkata" => array(
array("city" => "Mumbai", "code" => "BOM"),
array("city" => "Delhi", "code" => "DEL"),
array("city" => "Bangalore", "code" => "BLR"),
array("city" => "Bagdogra", "code" => "IXB")
),
"Chennai" => array(
array("city" => "Mumbai", "code" => "BOM"),
array("city" => "Delhi", "code" => "DEL"),
array("city" => "Madurai", "code" => "IXM"),
array("city" => "Coimbatore", "code" => "CJB")
),
"Hyderabad" => array(
array("city" => "Mumbai", "code" => "BOM"),
array("city" => "Goa", "code" => "GOI"),
array("city" => "Bangalore", "code" => "BLR"),
array("city" => "Delhi", "code" => "DEL")
),
"Ahmedabad" => array(
array("city" => "Mumbai", "code" => "BOM"),
array("city" => "Delhi", "code" => "DEL"),
array("city" => "Bangalore", "code" => "BLR"),
array("city" => "Goa", "code" => "GOI")
),
"Bangalore" => array(
array("city" => "Mumbai", "code" => "BOM"),
array("city" => "Delhi", "code" => "DEL"),
array("city" => "Goa", "code" => "GOI"),
array("city" => "Hyderabad", "code" => "HYD")
),
"Patna" => array(
array("city" => "Delhi", "code" => "DEL"),
array("city" => "Mumbai", "code" => "BOM"),
array("city" => "Bangalore", "code" => "BLR"),
array("city" => "Kolkata", "code" => "CCU")
)
);
@endphp
<main>
    @include('user.components.forms.form')

    <section id="popularFlights" class="destinations">
        <div class="section_head rflex jcsb aic">
            <h4 class="section_title">Popular Flight Routes</h4>
        </div>
        <div class="row">
            @foreach ($city as $origin)
            <div class="desti-wrap col-12 col-s-6 col-l-3">
                <div class="wrapper destination">
                    <div class="img-box">
                        <img loading="lazy" src="{{ url('images/flight/cities/'.$origin['name']. '.jpg' ) }}" alt="flightimage">
                    </div>
                    <div class="text-box">
                        <h6 class="heading">Flights <span>{{$origin['name']}}</span> To </h6>
                        <div class="detail">
                            <ul class="packages">
                                @foreach ($flight[$origin['name']] as $destination)
                                <li>
                                    <a href="{{url('flight/search?journey_type=1&from='.$origin['code'].'&to='.$destination['code'].'&dep_date=' . date("Y-m-d"))}}" data-msg="Getting Available Flights..." target="blank" class="flight-link">{{$destination['city']}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</main>
@endsection

@push('js')
<script>

</script>

@endpush