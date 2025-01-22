@extends('user.components.layout')
@push('css')
<link rel="stylesheet" href="{{ url('css/user_css/cab.css') }}">
@endpush
@section('main')
<main>

    <!-- searchbar -->
    @if($request)
    <div class="search-bar">
        <form action="{{ url('/cab/'. $type.'/search') }}" method="get">
            @csrf
            <div class="field">
                <label for="type">Trip Type</label>
                <input type="text" id="type" disabled value={{$type}}>
            </div>
            <div class="vu-select field">
                <div class="vu-content">
                    <label for="">Going From</label>
                    <input type="text" name="going_from_city" placeholder="Search City" class="vu-input" required autofocus>
                    <input type="hidden" name="going_from" class="city_id">
                </div>
                <div class="vu-suggestion"></div>
            </div>
            <div class="field">
                <label for="c_date">Pickup Date</label>
                <input type="date" name="c_date" id="c_date" min="{{ now()->toDateString() }}" value="{{$request->c_date}}">
            </div>
            <div class="field">
                <label for="c_time">Pickup Time</label>
                <input type="text" name="c_time" id="c_time" value="{{$request->c_time}}" autocomplete="off">
            </div>
            <div class="field">
                <input type="hidden" value="{{$request->going_to}}" name="going_to">
                <button class="search-btn" type="submit"> UPDATE SEARCH </button>
            </div>
        </form>
    </div>
    @if($cabroutes)
    <div class="my-row">
        <aside class="filter-box"> {{-- for left side-bar  --}}</aside>
        <section class="card-box">
            @foreach ( $cabroutes as $cabroute)

            <article class="cab-card">
                <figure class="img-box">
                    <span class="rating"><i class="fa-solid fa-star"></i> 4.2</span>
                    <span class="review"> 941 ratings </span>
                    
                    <img src="{{ asset('images/cab assets/vehicle/' . $cabroute['cab']['vehicle_img']) }}" class="cab_card_img">
                    
                </figure>
                <div class="text-box">
                    <div class="card-head">
                        <h2 class="cab-name"> {{ $cabroute['cab']['vehicle_model'] }}</h2>
                        <div class="details">
                            @php
                            $vehicleFeatures = json_decode($cabroute['cab']['vehicle_features']);
                            @endphp
                            <h5 class="cab-type"> {{ $vehicleFeatures->Type }} </h5>
                            <ul class="cab-features">
                                @if (isset($vehicleFeatures->other))
                                @foreach ($vehicleFeatures->other as $otherFeature)
                                <li>{{ $otherFeature }}</li>
                                @endforeach
                                @endif
                                <li>{{ $vehicleFeatures->Baggage }} Kg Baggage</li>
                                <li>
                                    <i class="fa-solid fa-user"></i>
                                    <span> {{ $vehicleFeatures->Seats }} Seats </span>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="left">
                            <h4 class="cab-title"> Economical Car </h4>
                            <ul>
                                <li>
                                    <i class="fa-regular fa-circle-check"></i>
                                    <p> Pickup : {{$cabroute['from_city']['city_name']}} </p>
                                </li>
                                <li>
                                    <i class="fa-regular fa-circle-check"></i>
                                    <p> For any extension of the trip, a charge of <i class="fa-solid fa-indian-rupee-sign"></i> {{$cabroute['cab']['km_price']}}/- per kilometer will be applicable.</p>
                                </li>
                                <li>
                                    <i class="fa-regular fa-circle-check"></i>
                                    <p>Free Cancellation until {{$cabroute['free_cancel'] }} hours</p>
                                </li>
                            </ul>
                        </div>
                        <div class="right">
                            <p class="discount"><i class="fa-regular fa-badge-percent"></i> 16% off {{$cabroute['coupon'] }}</p>
                            <del class="old-price">
                                <i class="fa-solid fa-indian-rupee-sign"></i>
                                <span>{{$cabroute['price'] + rand(500, 600)}}/-</span>
                            </del>
                            <h3 class="price">
                                <i class="fa-solid fa-indian-rupee-sign"></i>
                                <span>{{$cabroute['price']}}/-</span>
                            </h3>
                            <p class="tax">
                                <i class="fa-solid fa-indian-rupee-sign"></i>
                                <span>{{$gst = 18/100 * $cabroute['price'] }}/- taxes & fees</span>
                            </p>
                            <a href="{{ url('/cab/' . $type . '/book/' . $cabroute['id']) }}?dt={{ implode(',', [$request->going_from_city, $request->going_to_city, $request->c_date, $request->c_time]) }}" class="select-btn"> select</a>
                        </div>
                    </div>
                </div>
            </article>

            @endforeach
        </section>
    </div>
    @else
    <div class="nocars_found">
        <img src="https://gos3.ibcdn.com/dead_end-1577780193.png" style="width: 261px;">
        <h4>Cab is not available at the moment</h4>
    </div>
    @endif
    @endif



</main>
@endsection


@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ url('js/vu-select.js') }}"> </script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script>
        const fetchOptions = (value, callback) => {
            ajax({
                url: `{{ url('api/city/') }}/${value}`,
                success: (res) => callback(JSON.parse(res)['cities']),
            });
        };

        const optionGenerator = (port) =>
            `<div class="vu-option" data-value="${port.city_name}" data-city_id="${port.id}">${port.city_name}</div>`;

        const fromSelect = new vu_select($(".vu-select")[0], {
            optionGenerator,
            fetchOptions
        });
        const toSelect = new vu_select($(".vu-select")[1], {
            optionGenerator,
            fetchOptions
        });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#c_time').timepicker({
            timeFormat: 'h:mm p',
            interval: 15,
            minTime: '04',
            maxTime: '11:45pm',
            startTime: '04:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    });
</script>
<script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get the input element
            var c_date = document.getElementById('c_date');
    
            // Set the minimum date to the current date
            c_date.min = new Date().toISOString().split('T')[0];
        });
</script>
@endpush
