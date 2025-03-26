<header>
    <div class="header_main">
        <a href="{{ url('/') }}" class="brand">
            <img src="{{ url('images/logo.png') }}" alt="logo">
            <!-- <img src="../../../../../public/images/flight/planes-runway.png" alt=""> -->

        </a>
        <nav class="prime_nav rflex active">
            <li>
                <a href="{{ url('flight') }}">
                    <img src="{{ url('images/web assets/icon-1.png') }}" style="padding: 4px;" class="web_logo " alt="logo">
                    <span style="margin: 0px 5px 0px 5px;">Flights</span>
                </a>
            </li>
            <li>
                <a href="{{ url('hotel') }}">
                    <img src="{{ url('images/web assets/icon-3.png') }}" style="padding-bottom: 5px;" class="web_logo" alt="logo">
                    <span style="margin: 0px 0px 0px 5px;">Hotels</span>
                </a>
            </li>
            <!-- <li>
                <a href="{{ url('') }}"> 
                    <img src="{{ url('images/web assets/bus-logo.png') }}" class="web_logo"  alt="logo">
                    <span>Bus</span>
                </a>
            </li>  -->
            <li>
                <a href="{{ url('cab') }}">
                    <img src="{{ url('images/web assets/icon-4.png') }}" style="padding: 0 5px 6px 0;"  class="web_logo" alt="logo">
                    <span> Cabs </span>
                </a>
            </li>


            <li>
                <a href="{{ url('packages') }}" target="_blank">
                    <img src="{{ url('images/web assets/icon-2.png') }}" class="web_logo" alt="logo">
                    <span style="margin: 0px 0px 0px 5px;">Holiday Packages</span>
                </a>
            </li>

            <!-- <li class="special_box">
                <a href="{{ url('special-hotel') }}" target="_blank">
                    <h6 class="brand">
                        <span>  Special Hotels </span>
                    </h6>
                </a>
            </li>  -->

            <li class="club_box">
                <a href="{{ url('membership') }}" target="_blank">
                    <h6 class="brand"><span>G</span><span>BO </span>
                    <span> Membership</span>
                </h6>
                </a>
                <ul class="club">
                    <h5>Be a Member</h5>
                    <p>Get travel offers, perks and rewards with each booking with great discount</p>
                    <a href="{{ url('membership') }}" class="btn" target="_blank">Explore Membership</a>
                </ul>
            </li>
            <li>
                <a href="{{ url('blogs') }}">
                    <i class="fa-solid fa-blog"></i>
                    <span>Blogs</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(url('blogs')); ?>">
                    <i class="fa-solid fa-question"></i>
                    <span>Need Help</span>
                </a>
            </li>
            
        </nav>
        <nav class="sec_nav rflex aic">
            @if (session()->has('user'))
                <li class="signed_in_box">
                    <a class="btn">Profile</a>
                    <ul class="signed_in">
                        @php $userData = session()->get('user'); @endphp
                        <h5>Hello {{$userData['userMail']}}</h5>
                        <p>Manage your bookings</p>
                        <li><a href=""><i class="fa-solid fa-user"></i>My Profile</a></li>
                        <li><a href="{{url('user/bookings')}}"><i class="fa-solid fa-bookmark"></i>My Booking</a></li>
                        <li><a href=""><i class="fa-solid fa-badge-percent"></i>Offers</a></li>
                        <li><a href="{{url('user/logout')}}" class="logout">Logout</a></li>
                    </ul>
                </li>
            @else
                <li class="sign_in_box">
                    <a href="{{url('user/login')}}" class="btn prime">Sign In</a>
                    <ul class="sign_in">
                        <h5>Hello Traveller</h5>
                        <p>Get Exclusive deals and manage your bookings</p>
                        <li><a href="{{url('user/login')}}" class="btn">Sign In/Up</a></li>
                    </ul>
                </li>
            @endif
            <i class="fa-solid fa-bars-staggered" id="sidebar_opener"></i>
        </nav>
        <div class="side_nav">
            <a href="{{ url('') }}" class="brand">
                <img src="{{ url('images/logo.png') }}" alt="logo">
            </a>
            <ul class="prime_side_nav">
            @if(!Request::is('/'))
                <li>
                    <a href="{{ url('') }}">
                        <i class="fa-solid fa-plane"></i>
                        <span>Flight</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('hotel') }}">
                        <i class="fa-solid fa-hotel"></i>
                        <span>Hotel</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ url('') }}">
                        <i class="fa-solid fa-bus"></i>
                        <span>Bus</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('') }}">
                        <i class="fa-solid fa-train"></i>
                        <span>Train</span>
                    </a>
                </li> --}}
                {{-- <li><a href="{{ url('special-hotel') }}" target="_blank"><i class="fa-solid fa-hotel"></i><span   class="brand"><span>G</span><span>BO </span>   Special Hotels</span></a></li> --}}
                <li><a href="{{ url('cab') }}" target="_blank"><i class="fa-solid fa-cab"></i><span
                            class="brand"><span>G</span><span>BO </span>
                              Special Cabs</span></a></li>
                <li><a href="{{ url('packages') }}" target="_blank"><i class="fa-solid fa-badge-percent"></i>Holiday
                        Packages</a></li>
                <li>
                    <a href="{{ url('blogs') }}">
                        <i class="fa-solid fa-blog"></i>
                        <span>Blogs</span>
                    </a>
                </li>
            @endif
                <ul class="member_box">
                    <h5 style="">Be a Member</h5>
                    <p>Get travel offers, perks and rewards with each booking with great discount</p>
                    <a href="{{ url('membership') }}" class="btn" target="_blank">Explore Membership</a>
                </ul>
            </ul>
            <ul class="sec_side_nav signed_in">
                @if (session()->has('user'))

                @php $userData = session()->get('user'); @endphp
                    <h5>Hello {{$userData['userMail']}}</h5>
                    <p>Manage your bookings</p>
                    <li><a href=""><i class="fa-solid fa-user"></i>My Profile</a></li>
                    <li><a href=""><i class="fa-solid fa-bookmark"></i>My Booking</a></li>
                    <li><a href=""><i class="fa-solid fa-badge-percent"></i>Offers</a></li>
                    <a href="{{url('user/logout')}}" class="btn logout">Logout</a>
                @else
                    <h5>Hello Traveller</h5>
                    <p>Get Exclusive deals and manage your bookings</p>
                    <a href="{{url('user/login')}}" class="btn">Sign In/Up</a>
                @endif
            </ul>
        </div>
    </div>
</header>
@push('js')
<script>
    document.addEventListener("DOMContentLoaded", function () {
    var sidebarOpener = document.getElementById("sidebar_opener");
    var sideNav = document.querySelector(".side_nav");

    sidebarOpener.addEventListener("click", function (e) {
        sideNav.classList.add("active");

        function hideSideNav(event) {
            if (!sideNav.contains(event.target) && event.target !== sidebarOpener) {
                sideNav.classList.remove("active");
                document.removeEventListener("click", hideSideNav);
            }
        }
        setTimeout(() => document.addEventListener("click", hideSideNav), 1);
    });

    document.addEventListener("scroll", function () {
        var header = document.querySelector("header");
        if (window.scrollY > 20) {
            header.classList.add("scrolled");
        } else {
            header.classList.remove("scrolled");
        }
    });
});
</script>
@endpush
