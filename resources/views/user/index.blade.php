@extends('user.components.layout')
@push('css')
    <link rel="stylesheet" href="css/index.css">
    <style>
       

        section.aboutus {
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


        .aboutus .details {
            font-size: 1.4rem;
            color: var(--gray_600);
            padding-inline: 20px;
            text-align: justify;
        }

        .a-line {
            text-decoration: none;
            color: var(--fv_prime);
        }

        .a-line:hover {
            text-decoration: underline;
        }

       
    </style>
@endpush

@section('main')
    <main>


        <menu class="tabs">
            <ul class="top-tabs">
                <li>
                    <a href="{{ url('flight') }}" >
                        <img src="{{ url('images/web assets/home-icons/gif/airplane.gif') }}" alt="logo">
                        <span>Flights</span>

                    </a>
                </li>
                <li>
                    <a href="{{ url('hotel') }}">
                        <img src="{{ url('images/web assets/home-icons/gif/hotel.gif') }}" alt="logo">
                        <span> Hotels</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('cab') }}">
                        <img src="{{ url('images/web assets/home-icons/gif/car.gif') }}" alt="logo">
                        <span> Cabs</span>

                    </a>
                </li>
                <li>
                    <a href="{{ url('packages') }}">
                        <img src="{{ url('images/web assets/home-icons/gif/sun-lounger.gif') }}" alt="logo">
                        <span> Holiday </span>
                    </a>
                </li>         
            </ul>
            <ul class="second-tabs">
                <li>
                    <a href="{{ url('membership') }}">
                        <img src="{{ url('images/web assets/home-icons/gif/verified.gif') }}" alt="logo">
                        <span>GBO Membership</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('cab/Airport-Transfer') }}">
                        <img src="{{ url('images/web assets/home-icons/gif/car-insurance.gif') }}" alt="logo">
                        <span>Airport Cabs</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('hotel') }}">
                        <img src="{{ url('images/web assets/home-icons/gif/building.gif') }}" alt="logo">
                        <span>Homestays & Villas</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('cab/Round-Trip') }}">
                        <img src="{{ url('images/web assets/home-icons/gif/taxi.gif') }}" alt="logo">
                        <span>Outstation Cabs</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('packages#destinations') }}">
                        <img src="{{ url('images/web assets/home-icons/gif/price-tag.gif') }}" alt="logo">
                        <span>Recommended Packages</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('blogs') }}">
                        <img src="{{ url('images/web assets/home-icons/gif/photo-gallery.gif') }}" alt="logo">
                        <span>Blogs</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('flight#popularFlights') }}" >
                        <img src="{{ url('images/web assets/home-icons/gif/signposts.gif') }}" alt="logo">
                        <span>Popular Flights </span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('hotel') }}">
                        <img src="{{ url('images/web assets/home-icons/gif/hotel (1).gif') }}" alt="logo">
                        <span>Popular Hotels</span>
                    </a>
                </li>

            </ul>

        </menu>

        <div class="offcanvas" id="offcanvas">
            <form class="text-box">
                <div class="between">
                    <h6>Login/Signup to</h6>
                    <span class="x">x</span>
                </div>
                <div class="offer-box">
                    <ul class="offer-window">
                        <li>Join the club of 10cr+ happy travellers.</li>
                        <li>Get 12% OFF on flights as a welcome gift.</li>
                        <li>Get 20% OFF on hotels as welcome gift.</li>
                        <li>Book hotels @ ₹0 and pay later.</li>
                    </ul>
                </div>
                <input type="tel" placeholder="Enter mobile number" pattern="[0-9]{10}" maxlength="10" minlength="10"
                    title="Please enter a 10-digit mobile number">

                <button class="">continue</button>
                <div>
                    <small>by proceeding, you agree to GoingBo's
                        <a href="#"  rel="noopener noreferrer">
                            Privacy Policy, User Agreement
                        </a>
                        and
                        <a href="#"  rel="noopener noreferrer">
                            T&Cs.
                        </a>
                    </small>
                </div>
            </form>
        </div>

        <article class="res-display">
            @include('user.components.forms.form')
        </article>

       

        <section class="aboutus">
            <div class="section_head rflex jcsb aic">
                <h4 class="section_title"> Search Flights, Hotels, Cab and Holiday Packages </h4>

            </div>
            <p class="details">
                In the Indian travel market, Goingbo is a reputable name and one of the biggest online travel platforms
                in
                the country. We provide "end-to-end" travel options, such as airline tickets, hotel reservations, taxi
                and
                bus reservations, rail tickets, and vacation packages. We also provide value-added supplementary
                services.
                We have made the process simpler for you to find the ideal travel bargains that meet your preferences
                because we know that organizing a vacation may be stressful. Our website is easy to use and offers a lot
                of
                different possibilities. With our extensive travel packages, we can accommodate any kind of
                traveller—whether they are travelling for business, a solo excursion, or a family holiday. From vacation
                packages to vacation rentals, hotels to flights. We provide all you require to ensure the success of
                your
                trip. In all of our interactions, we strive for honesty and openness. Our prices are always reasonable,
                and
                we don't impose any additional costs. You may be confident that Goingbo will provide you with the
                greatest
                travel offers available. Go no further than Goingbo for a hassle-free and reasonably priced travel
                planning
                solution. We pledge to make your trip an unforgettable one. We provide multi-destination packages such
                as <a href="/packages/goa-honeymoon" class="a-line">Goa Honeymoon Packages,</a> <a
                    href="/packages/shimla-manali-honeymoon" class="a-line">Shimla Kullu Manali Honeymoon Packages,</a>
                <a href="/packages/dalhousie-and-dharmashala-tour" class="a-line">Dharamshala Dalhousie Honeymoon
                    Packages,</a> <a href="/packages/kerala-honeymoon" class="a-line">Kerala Honeymoon Packages,</a> <a
                    href="/packages/Uttarakhand-tour" class="a-line">Uttarakhand Honeymoon Packages,</a> <a
                    href="/packages/north-east-tour" class="a-line">North East Honeymoon Packages,</a> <a
                    href="/packages/kashmir-tour" class="a-line">Kashmir Honeymoon Packages,</a> <a
                    href="/packages/gujarat-tour" class="a-line">Gujarat Honeymoon Packages,</a> <a
                    href="/packages/assam-tour" class="a-line">Assam Honeymoon Packages,</a> <a href="/packages/ooty-tour"
                    class="a-line">Ooty Honeymoon Packages,</a> <a href="/packages/himachal-pradesh-tour"
                    class="a-line">Himachal Pradesh Honeymoon Packages,</a> in
                India among others.
            </p>
        </section>

    </main>
    
@endsection

@push('js')
<script>
    var offCanvas = document.getElementById("offcanvas")
    var closeButton = offCanvas.querySelector(".x");

    const closeCanvas = () => {
        offCanvas.style.display = "none"
    }

    closeButton.addEventListener("click", closeCanvas)


</script>

@endpush
