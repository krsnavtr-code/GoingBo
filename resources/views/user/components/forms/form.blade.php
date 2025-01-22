@push('js')


    <script src="{{ url('js/vu-select.js') }}"></script>
    {{-- <script>
        $(".form_type").perform((n, i, no) => {
            n.addEventListener("click", () => {
                no.perform(x => {
                    if (n != x) {
                        x.removeClass("active");
                    }
                });
                n.addClass("active");
            });
        })
    </script> --}}


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const flightFormType = document.querySelectorAll('.form_type')[0];
            const hotelFormType = document.querySelectorAll('.form_type')[1];
            const cabFormType = document.querySelectorAll('.form_type')[2];
            const flightForm = document.querySelector('.flight_form');
            const hotelForm = document.querySelector('.hotel_form');
            const cabForm = document.querySelector('.cab_form');
    
            flightFormType.addEventListener('click', function() {
                flightFormType.classList.add('active');
                hotelFormType.classList.remove('active');
                cabFormType.classList.remove('active');
                cabForm.style.display = 'none';
                hotelForm.style.display = 'none';
                flightForm.style.display = 'block';
            });
    
            hotelFormType.addEventListener('click', function() {
                hotelFormType.classList.add('active');
                flightFormType.classList.remove('active');
                cabFormType.classList.remove('active');
                cabForm.style.display = 'none';
                flightForm.style.display = 'none';
                hotelForm.style.display = 'block';
            });

            cabFormType.addEventListener('click', function() {
                cabFormType.classList.add('active');
                flightFormType.classList.remove('active');
                hotelFormType.classList.remove('active');
                hotelForm.style.display = 'none';
                flightForm.style.display = 'none';
                cabForm.style.display = 'block';
            });
        });
    </script>



@endpush

@php
    $activeForm = $activeForm ?? 'flight';
@endphp

<div class="search_forms cflex">
    <div class="background">
        {{-- <img src="{{ url('images/backgrounds/bg7.png') }}" alt=""> --}}
    </div>
    <div class="forms_wrapper">
        <div class="form_types">
            <span class="bg"></span>
            <div class="form_type flight {{ $activeForm == 'flight' ? 'active' : '' }}">
                <i class="icon fa-solid fa-plane-engines"></i>
                <p>Flight</p>
            </div>
            <div class="form_type hotel {{ $activeForm == 'hotel' ? 'active' : '' }}">
                <i class="icon fa-solid fa-hotel"></i>
                <p>Hotel</p>
            </div>
            <!--<div class="form_type">-->
            <!--    <i class="icon fa-solid fa-bus-simple"></i>-->
            <!--    <p>Bus</p>-->
            <!--</div>-->
            <!--<div class="form_type">-->
            <!--    <i class="icon fa-solid fa-train"></i>-->
            <!--    <p>Train</p>-->
            <!--</div>--> 
            <a class="form_type cab{{ $activeForm == 'cab' ? 'active' : '' }}" >
                <i class="icon fa-solid fa-taxi"></i>
                <p>Taxi</p>
            </a>
        </div>
        
        <div class="flight_form" style="{{ $activeForm == 'flight' ? 'display: block;' : 'display: none;' }}">
            @include('user.components.forms.flight')
        </div>
        <div class="hotel_form" style="{{ $activeForm == 'hotel' ? 'display: block;' : 'display: none;' }}">
            @include('user.components.forms.hotel')
        </div>
        <div class="cab_form" style="{{ $activeForm == 'cab' ? 'display: block;' : 'display: none;' }}">
            @include('user.components.forms.taxi')
        </div>
        
    </div>
</div>