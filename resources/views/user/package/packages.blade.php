@extends('user.components.layout')
@push('css')
<link rel="stylesheet" href="{{ url('css/user_css/packages.css') }}">
@endpush

@section('main')
<main>
    <!-- <section class="msh-search">
        <div class="container">
            <form action="" method="get" class="msh">
                @csrf
                <div>
                    <label for="pckg_categories">package type </label>
                    <select id="pckg_categories" class="" name="pckg_categories">
                        <option value="Family"> Family </option>
                        <option value="Honeymoon"> Honeymoon </option>
                        <option value="Friends/Group"> Friends/Group </option>
                        <option value="Pilgrimage"> Pilgrimage </option>
                    </select>
                </div>
                <div>
                    <label for="f_city" class="msh-triptext">city <small>(from)</small></label>
                    <div class="vu-select">
                        <div class="vu-content">
                            <input class="msh-inbox vu-input" type="text" name="going_from_city" id="f_city" class="vu-input" placeholder="city (from)">
                            <input type="hidden" name="going_from" class="city_id">
                        </div>
                        <div class="vu-suggestion cflex"></div>
                    </div>
                </div>
                <div>
                    <label for="c_date">departure date</label>
                    <div class="">
                        <input class="msh-inbox" type="date" name="c_date" id="c_date" min="{{ now()->toDateString() }}" value="">
                    </div>
                </div>
                <div class="msh-btnbox">
                    {{-- <input type="hidden" value="{{$request->going_to }}"
                    name="going_to" > --}}
                    <button class="msh-btn" type="submit">search</button>
                </div>
            </form>
        </div>
    </section> -->
    <section class="search-box">
        <div class="container">
            <!-- cap container -->
            <figure class="cap-container">
                <i class="fa-solid fa-angle-left"></i>
                <div class="search-cap">
                    <h3 class="heading">new delhi <span>(ndls)</span></h3>
                    <div class="sub-heading">
                        <span>16 aug</span>
                        <!-- -
                        <span>17 aug</span> -->
                        •
                        <span>honeymoon</span>
                    </div>
                </div>
                <i class="fa-regular fa-heart"></i>
            </figure>
            <!-- package search -->
            <form action="" class="package-search">

                <div class="type">
                    <label for="pckg_categories">package type </label>
                    <select id="pckg_categories" name="pckg_categories">
                        <option value="Family"> Family </option>
                        <option value="Honeymoon"> Honeymoon </option>
                        <option value="Friends/Group"> Friends/Group </option>
                        <option value="Pilgrimage"> Pilgrimage </option>
                    </select>
                </div>
                <div>
                    <label for="f_city">city <small>(from)</small></label>
                    <div class="vu-select">
                        <div class="vu-content">
                            <input class="vu-input" type="text" name="going_from_city" id="f_city" class="vu-input" placeholder="city (from)">
                            <input type="hidden" name="going_from" class="city_id">
                        </div>
                        <div class="vu-suggestion"></div>
                    </div>
                </div>
                <div>
                    <label for="c_date">departure date</label>
                    <input type="date" name="c_date" id="c_date" min="{{ now()->toDateString() }}" value="">
                </div>
                <div>
                    <button class="serch-button">search</button>
                </div>
            </form>
        </div>

    </section>
    <h1>Packages for Top Family Destinations</h1>
    <div class="p-card">
        @foreach($packages as $index => $package)


        <div class="package-card" style="display: {{ $index < 10 ? 'flex' : 'none' }};">
            @php
            if (!function_exists('calculatePrices')) {
            function calculatePrices($price)
            {
            $discountPercentage = rand(50, 60);
            $originalPrice = $price / (1 - $discountPercentage / 100);

            return [
            'originalPrice' => round($originalPrice),
            'discountedPrice' => $price,
            'discountPercentage' => $discountPercentage,
            ];
            }
            }

            $prices = calculatePrices($package['price']);
            @endphp
            <figure class="img-box">
                <a target="_blank" href="{{ url('packages/' . $package['slug']) }}">
                    <img src="{{ url('/images/package/' . $package['image']) }}" alt="" class="" lazyloaded>
                </a>
                <span class="discount-badge">{{ $prices['discountPercentage'] }}%
                    Off</span>
            </figure>
            <div class="text-box">
                <h2 class="title">
                    <a target="_blank" href="{{ url('packages/' . $package['slug']) }}">
                        <span class="">{{ $package['title'] }}</span>
                    </a>
                </h2>
                <div class="between">
                    <div class="left">
                        <h6>
                            <span>
                                {{ $package['night'] + 1 }} days
                                &amp;
                                {{ $package['night'] }} nights
                            </span>
                            <small class="">Customizable</small>
                        </h6>
                        <h5>
                            <small>Starting from:</small>
                            <del class="old-price">
                                <i class="fa-solid fa-indian-rupee"></i>
                                {{ $prices['originalPrice'] }}/-
                            </del>
                        </h5>
                        <h2 class="price">
                            <small>
                                <i class="fa-solid fa-indian-rupee"></i>
                            </small>
                            {{ $prices['discountedPrice'] }}/-
                        </h2>
                        <p class="note">Per Person on twin sharing.</p>
                        <div class="flex">
                            <strong>
                                <i class="fa-solid fa-package"></i>
                                Hotels:</strong>
                            <div class="package">
                                <span>4 star</span>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                        {{-- <div class="">
                            <strong>
                                <i class="fa-solid fa-location-dot"></i>
                                cities:</strong>
                            <ul class="cities">
                                <li>Maldives (5D)</li>
                                <li>Maldives (5D)</li>
                                <li>Maldives (5D)</li>
                                <li>Maldives (5D)</li>
                            </ul>
                        </div> --}}
                    </div>
                    <div class="right">
                        <button class="compare-btn">
                            <i class="fa-solid fa-plus"></i>
                            <span>add to Compare</span>
                        </button>
                        <div>
                            <h6>Activities</h6>
                            <ul class="activities">
                                <li>Scuba Diving</li>
                                <li>Adventure</li>
                                <li>Underwater World</li>
                                <li>Nature</li>
                                <li>City Tour</li>
                                <li>Hill station</li>
                                <li>Water Activities</li>
                                <li>Family</li>
                                <li>Budget</li>
                            </ul>
                        </div>
                        <p class="short_des">{{ $package['short_des'] }}</p>
                    </div>
                </div>
                <div class="buttons">
                    <a class="view-btn" href="{{ url('packages/' . $package['slug']) }}">view details</a>
                    <button class="customize-btn">Customize &amp; Get Quotes</button>
                </div>

            </div>

        </div>
        @endforeach
    </div>
    @if(count($packages) > 0)
    <button id="load-more">Load More</button>
    @endif

        <!-- <div class="package-card" style="display:{{ $index < 10 ? 'block' : 'none' }};">

            <div style="display:contents">
                <div class="clearfix container mb15 border at_packagecard_wrapper">
                    <div class="clearfix row p8 bb radius2">
                        <div class="col-md-3 p0 relative">
                            <a target="_blank" href="{{ url('packages/' . $package['slug']) }}">
                                <div class="row row- package-img at_package_image   radius2">
                                    <div class="relative wfull overflowh" style="height: 180px;">
                                        <img src="{{ url('/images/package/' . $package['image']) }}" alt="4 Nights 5 Days Maldives Family Holiday" class="imgGlobal lazyloaded">
                                    </div>
                                </div>
                            </a>
                        </div>
                        <span></span>
                        <div class="col-md-9 pr0">
                            <div class="clearfix row m0 mb5 flex">
                                <h3 class="col-md-8 pl0 fw9 m0 f16 pfc3 at_packageName">
                                    <a target="_blank" href="{{ url('packages/' . $package['slug']) }}">
                                        <span class="fw9 m0 f16 pfc3">{{ $package['title'] }}
                                            From GoingBo
                                        </span>
                                    </a>
                                </h3>
                                <div class="col-md-4 pr0 relative flexFull">
                                    <div class="_3uaYgsv" id="validationMessage6832">Please select at least
                                        one item. Only 3 are allowed.
                                    </div>
                                    <input type="checkbox" id="compare6832" class="checkbox-common addto-compare fright">
                                    <label for="compare6832" class="pfc1"> Add To Compare</label>
                                </div>
                            </div>
                            <div class="clearfix mb8">
                                <span class="f12 m0 iblock fw7 at_package_duration">
                                    <span class="iblock sfc6">{{ $package['night'] + 1 }}
                                        Days &amp;
                                        {{ $package['night'] }} Nights</span>
                                    <span class="iblock pt5 pb5 sfc6 ml5 mr5 border"></span>
                                </span>
                                <span class="pfc4 iblock">Customizable</span>
                            </div>
                            

                            <div class="clearfix row m0 mb0">
                                <div class="col-md-6 pl0 pr8">
                                    <span class="f12 fw4 m0 pb8 iblock">
                                        <span class="mr24 pfc4">Starting from:</span>
                                        <span class="clearfix iblock">
                                            <span class="f12 fw4 pt2 pb2 pl8 pr8 radius20 pbc1 sfcw at_discount_label">{{ $prices['discountPercentage'] }}%
                                                Off</span>
                                            <span class="info-icon ml5 relative  t4 at_discountinfo">
                                                <span class="info-icon-box">Exact prices may vary based on
                                                    availability.</span>
                                            </span>
                                        </span>
                                    </span>
                                    <h4 class="sfc3 m0 f24 fw9 priceVal at_newprice" itemprop="priceSpecification">
                                        <i class="fa-solid fa-indian-rupee-sign fa-xs"></i>
                                        {{ $prices['discountedPrice'] }}/-
                                        <span class="f12 pfc3 tdl ml8 at_oldprice fw4">
                                            <i class="fa-solid fa-indian-rupee-sign fa-sm"></i>{{ $prices['originalPrice'] }}/-
                                        </span>
                                    </h4>
                                    <p class="f12 m0 pfc4 fw7 at_sharinginfo">Per Person on twin sharing</p>
                                </div>
                                <div class="col-md-6 pl8 pr0 clearfix package-tag-box">
                                    <ul class="package-tags at_package_tags">
                                        <li class="ellipsis">Scuba Diving</li>
                                        <li class="ellipsis">Adventure</li>
                                        <li class="ellipsis">Underwater World</li>
                                        <li class="ellipsis">Nature</li>
                                        <li class="ellipsis">Male City Tour</li>
                                        <li class="ellipsis">Hill station</li>
                                        <li class="ellipsis">Water Activities</li>
                                        <li class="ellipsis">Family</li>
                                        <li class="ellipsis">Budget</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="clearfix row m0 pt5">
                                <div class="col-md-7 pl0 pr8">
                                    <div class="clearfix">
                                        <p class="m0 f12 pfc3 pb4 fw7">Hotel included in package: </p>
                                        <div class="flex alignCenter">
                                            <div class="iblock flex alignCenter  mr8">
                                                <input name="package_star_input_6832" type="radio" class="radio-common-circle at_packagepackage_rating" id="input_6832_6832" value="6832" checked="">
                                                <label class="pr0 pt0" for="input_6832_6832">4
                                                    Star</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                        <p class="fleft relative pfc3 fw7 f12 m0 mr4">Cities: </p>
                                        <ul class="clearfix package-cities-list at_packagecity_list">
                                            <li class="f12">Maldives (5D)</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-5 pl0 pr0">
                                    <div class="f12 pfc4 m0 fw4 at_aboutpackage_text">
                                        {{ $package['short_des'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix row p8">
                        <div class="col-md-6 p0 flex">
                            <div class="overflowh">
                                <div class="row row-">
                                    <ul class="package-incexc-list at_packageincexc-list">
                                        <li class="icon-box relative">
                                            <span class="icon-box">

                                            </span>
                                            <p class="mb0">Upto 4 Stars</p>
                                        </li>
                                        <li class="icon-box relative">
                                            <span class="icon-box"></span>
                                            <p class="mb0">Meals</p>
                                        </li>
                                        <li class="icon-box relative">
                                            <span class="icon-box">
                                            </span>
                                            <p class="mb0">Sightseeing</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tooltipCommon flex cursorP text-center sfc1 f12 alignCenter justifyCenter _2DEdEQx">
                                +2 more
                                <div class="_1IDFBSq tooltipBox z3 sbcw">
                                    <div class="m0 p0 pfc3 text-left">
                                        <span class="ellipsis f12 pt3 pb3 block _1jgRrdA">Stay
                                            Included</span>
                                        <span class="ellipsis f12 pt3 pb3 block _1jgRrdA">Transfers</span>
                                    </div>
                                    <span class="_1gJcJhF tooltipArrow 1"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 p0 pt5 flex alignCenter justifyEnd">
                            <a target="_blank" class="block fw7 p8 pl15 pr15 text-center link-pri at_packageviewdetailbtn" href="{{ url('packages/' . $package['slug']) }}">View
                                Details</a>
                            <div class="col-md-7 p0 ml15">
                                <div>
                                    <div class="block wfull">
                                        <button class="wfull ripple pl8 pr8 radius2 btn-filled-pri at_package_custom_btn">Customize
                                            &amp; Get Quotes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        
    


    <section id="destinations">
        <div class="section_head rflex jcsb aic">
            <h4 class="section_title">Recommended Package</h4>
        </div>
        <div class="row">
            @foreach($recommends as $pkg)
            <div class="desti-wrap col-12 col-s-6 col-l-3">
                <a class="wrapper destination" href="{{ url('packages/' . $pkg['slug']) }}">
                    <img loading="lazy" src="{{ url('images/package/' . $pkg['image']) }}" alt="">
                    <div class="details">
                        <div class="detail">
                            <h6 class="desti">{{ $pkg['title'] }}</h6>
                            <p class="packages">
                                <span>{{ $pkg['night'] + 1 }}</span>Days Package
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </section>
</main>
@endsection

@push('js')
<script src="{{ url('js/vu-select.js') }}"></script>
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


    document.addEventListener('DOMContentLoaded', function() {
        // Get the input element
        var c_date = document.getElementById('c_date');

        // Set the minimum date to the current date
        c_date.min = new Date().toISOString().split('T')[0];
    });

    document.addEventListener('DOMContentLoaded', function() {
        let loadMoreBtn = document.getElementById('load-more');
        let packages = document.querySelectorAll('.package-card');
        let offset = 10;

        loadMoreBtn.addEventListener('click', function() {
            let displayed = 0;
            for (let i = offset; i < packages.length && displayed < 20; i++) {
                if (packages[i].style.display === 'none') {
                    packages[i].style.display = 'flex';
                    displayed++;
                }
            }
            offset += displayed;
            if (offset >= packages.length) {
                loadMoreBtn.style.display = 'none';
            }
        });
    });
</script>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    jQuery(function($) {
        // toggle buttons
        $(".search-cap").click(() => {
            $(".package-search").slideToggle();
        });
        $(".fa-heart").click(function() {
            $(this).toggleClass("fa-regular fa-solid");
        });
    })
    // vu-suggest
    // $(document).on('click', function(event) {
    //     var $suggestionBox = $('.vu-suggestion');
    //     if (!$suggestionBox.is(event.target) && $suggestionBox.has(event.target).length === 0) {
    //         $suggestionBox.hide();
    //     }
    // });

    // $('.vu-option').on('click', function() {
    //     $('.vu-suggestion').hide();
    //     // Optionally, handle the option click here
    //     console.log('Option clicked:', $(this).text());
    // });
</script>
@endpush