@extends('user.components.layout')
@push('css')
    <style>
        form {
            width: 100%;
            padding: 10px;
        }

        form .fields {
            gap: 20px;
        }

        form .field {
            flex-grow: 1;
        }

        form .field input {
            padding: 8px 20px;
        }

        form button {
            padding: 9px 30px;
            border: none;
            color: white;
            background: var(--fv_prime);
            font-weight: 600;
            border-radius: 5px;
            margin-top: 20px;
        }

        .wrapper.card {
            border: 2px solid;
            border-left: 40px solid;
            border-radius: 7px;
            display: flex;
            padding: 15px;
            align-items: center;
        }

        .wrapper.card img {
            --dim: 60px;
            width: var(--dim);
            height: var(--dim);
            transform: translateX(-60%);
            border-radius: 5px;
            margin-block: auto;
            box-shadow: 0 0 10px 0 #00000033;
            margin-right: -20px;
        }

        .wrapper.card i {
            padding-inline: 10px;
        }

        .wrapper.card .card_title {
            font-size: 1.3rem;
            margin-bottom: 5px;
        }

        .wrapper.card .card_desc {
            font-size: 1rem;
        }
    </style>
@endpush
@section('main')
    @include('user.components.book_opts')
    <main>
        <div class="tab-content specialtaxi" style="padding: 20px;">
            <form action="" method="post" class="fgdgdg" style="background:var(--fv_sec);padding: 20px;">
                @csrf
                <div class="fields rflex">
                    <div class="field cflex">
                        <label for="">From</label>
                        <input type="text">
                    </div>
                    <div class="field cflex">
                        <label for="">To</label>
                        <input type="text">
                    </div>
                    <div class="field cflex">
                        <label for="">Date</label>
                        <input type="date">
                    </div>
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
        <div class="container">
            <h3 style="margin-top:20px;margin-bottom:20px;text-align:center">Goingbo Special Taxi</h3>
            <hr>
            <div class="row">
                <div class="col-s-12 col-m-6 col-l-4">
                    <div class="wrapper card" style="border-color: #3ae5e0;">
                        <img src="https://www.tripmoney.com/ext/static/PL/pl.png" class="card_img">
                        <div class="cflex card_detail">
                            <h6 class="card_title">Avail Up to Rs.2 Lakh COVID Insurance</h6>
                            <p class="card_desc">at NO extra cost,with outstation cab rides & protect yourself from sudden
                                medical expenses.</p>
                        </div>
                    </div>
                </div>
                <div class="col-s-12 col-m-6 col-l-4">
                    <div class="wrapper card" style="border-color: #f1f19a;">
                        <img src="https://www.tripmoney.com/ext/static/credit-card/cc@3x.png" class="card_img">
                        <div class="cflex card_detail">
                            <h6 class="card_title">Travel Worry-free in Sanitized Cabs!</h6>
                            <p class="card_desc">Tap to read the neccessary measures adopted to ensure your safety.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-s-12 col-m-6 col-l-4">
                    <div class="wrapper card" style="border-color: #ffcbca;">
                        <img src="https://www.tripmoney.com/ext/static/TravelLoan/travelLoan.png" class="card_img">
                        <div class="cflex">
                            <h6 class="card_title">Launched: Best Price Guarantee on Cabs!</h6>
                            <p class="card_desc">We'll pay you 5X the difference in price, if you find a cheaper cab online!
                            </p>
                        </div>

                    </div>
                </div>
            </div>
            <hr>
        </div>
        <div class="container" style="margin-top:50px;">
            <center>
                <h3 class="Taxitypee">
                    <img src="/images/hatchback.png">
                    <span>Hatchback</span>
                </h3>
                <img src="/images/big-separator.png" alt="">
            </center>
            <div class="row">
                @foreach ($spacialtaxi as $taxispeci)
                    @if ($taxispeci['cab_type'] == 'Hatchback')
                        <div class="col-12 col-s-6 col-m-4 col-l-3">
                            <a class="wrapper taxi" href="{{url("special-taxi/book/".$taxispeci['id'])}}">
                                <img src="images/Cab-booking.jpg">
                                <p class="Cabtitle">
                                    {{ $taxispeci->to_destination }} To {{ $taxispeci->from_destination }}
                                </p>
                                <p class="cabTypeIncDis">{{ $taxispeci->distance_kms }} km |
                                    {{ $taxispeci->overall_hours }} hr {{ $taxispeci->overall_minutes }} min</p>
                                <p class="cabTypeFare">Extra fare ₹{{ $taxispeci->extra_charge }}/km after
                                    {{ $taxispeci->distance_kms }} km</p>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="container" style="margin-top:50px;">
            <center>
                <h3 class="Taxitypee">
                    <img src="/images/sedancab.png">
                    <span>Sedan</span>
                </h3>
                <img src="/images/big-separator.png" alt="">
            </center>
            <div class="row">
                @foreach ($spacialtaxi as $taxispeci)
                    @if ($taxispeci['cab_type'] == 'Sedan')
                        <div class="col-12 col-s-6 col-m-4 col-l-3">
                            <a class="wrapper taxi" href="{{url("special-taxi/book/".$taxispeci['id'])}}">
                                <img src="images/Cab-booking.jpg">
                                <p class="Cabtitle">
                                    {{ $taxispeci->to_destination }} To {{ $taxispeci->from_destination }}
                                </p>
                                <p class="cabTypeIncDis">{{ $taxispeci->distance_kms }} km |
                                    {{ $taxispeci->overall_hours }} hr {{ $taxispeci->overall_minutes }} min</p>
                                <p class="cabTypeFare">Extra fare ₹{{ $taxispeci->extra_charge }}/km after
                                    {{ $taxispeci->distance_kms }} km</p>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="container" style="margin-top:50px;">
            <center>
                <h3 class="Taxitypee">
                    <img src="/images/suvcab.png">
                    <span>Suv</span>
                </h3>
                <img src="/images/big-separator.png" alt="">
            </center>
            <div class="row">
                @foreach ($spacialtaxi as $taxispeci)
                    @if ($taxispeci['cab_type'] == 'SUV')
                        <div class="col-12 col-s-6 col-m-4 col-l-3">
                            <a class="wrapper taxi" href="{{url("special-taxi/book/".$taxispeci['id'])}}">
                                <img src="images/Cab-booking.jpg">
                                <p class="Cabtitle">
                                    {{ $taxispeci->to_destination }} To {{ $taxispeci->from_destination }}
                                </p>
                                <p class="cabTypeIncDis">{{ $taxispeci->distance_kms }} km |
                                    {{ $taxispeci->overall_hours }} hr {{ $taxispeci->overall_minutes }} min</p>
                                <p class="cabTypeFare">Extra fare ₹{{ $taxispeci->extra_charge }}/km after
                                    {{ $taxispeci->distance_kms }} km</p>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div> 
    </main>
@endsection
@push('js')
    <script>
        function openPage(pageName, elmnt, color) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].style.backgroundColor = "";
            }
            document.getElementById(pageName).style.display = "block";
            elmnt.style.backgroundColor = color;
        }
        document.getElementById("defaultOpen").click();
    </script>
@endpush
