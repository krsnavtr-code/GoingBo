@extends('user.components.layout')
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
<link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
<link rel="stylesheet" href="{{ asset('css/hotel/style.css') }}" />
@endpush
@section('main')
<main>
  <section>
    <div class="container">
      <!-- cap container -->
      <figure class="cap-container">
        <i class="fa-solid fa-angle-left"></i>
        <div class="search-cap">
          <h3 class="heading">new delhi <span>(ndls)</span></h3>
          <div class="sub-heading">
            <span>16 aug</span>
            -
            <span>17 aug</span>
            •
            <span>1 room</span>
            •
            <span>1 guest</span>
          </div>
        </div>
        <i class="fa-regular fa-heart"></i>
      </figure>
      <!-- hotel search -->
      <form action="" class="hotel-search">
        <div class="destiantion">
          <label for="destiantion">destiantion</label>
          <input type="text" id="destiantion" placeholder="Enter City" />
        </div>
        <div class="check-in">
          <label for="check-in">check-in</label>
          <input type="datetime-local" id="check-in" placeholder="Enter check-in Date & Time" value="" />
        </div>
        <div class="check-out">
          <label for="check-out">check-out</label>
          <input type="datetime-local" id="check-out" placeholder="Enter check-out Date & Time" value="" />
        </div>
        <div class="rooms">
          <label for="rooms">rooms & guests</label>
          <input type="text" id="rooms" placeholder="1 room, 1 guest" value="1 room, 1 guest" />
        </div>
        <div>
          <button class="serch-button">search</button>
        </div>
      </form>
    </div>
  </section>
  <main class="main">
    <div class="container">
      <div class="row">
        <aside class="hotel-filter">
          <div class="panal">
            <div class="between filter-head">
              <h3>filters</h3>
              <span>
                <i class="fa-solid fa-filter"></i>
              </span>
            </div>
            <article>
              <h4>most popular</h4>
              <div class="between">
                <label for="cancellation">free Cancellation</label>
                <div class="flex">
                  <span>748</span>
                  <input type="checkbox" name="cancellation" id="cancellation" />
                </div>
              </div>
              <div class="between">
                <label for="breakfast">free breakfast</label>
                <div class="flex">
                  <span>413</span>
                  <input type="checkbox" name="breakfast" id="breakfast" />
                </div>
              </div>
              <div class="between">
                <label for="exceptional">free exceptional</label>
                <div class="flex">
                  <span>15</span>
                  <input type="checkbox" name="exceptional" id="exceptional" />
                </div>
              </div>
              <div class="between">
                <label for="parking">parking available</label>
                <div class="flex">
                  <span>748</span>
                  <input type="checkbox" name="parking" id="parking" />
                </div>
              </div>
            </article>
            <article>
              <h4>user rating</h4>
              <div class="between">
                <label for="exceptional">exceptional: 9+</label>
                <div class="flex">
                  <span>748</span>
                  <input type="radio" name="rating" id="exceptional" />
                </div>
              </div>
              <div class="between">
                <label for="excellent">excellent: 8+</label>
                <div class="flex">
                  <span>748</span>
                  <input type="radio" name="rating" id="excellent" />
                </div>
              </div>
              <div class="between">
                <label for="very-good">very good: 7+</label>
                <div class="flex">
                  <span>748</span>
                  <input type="radio" name="rating" id="very-good" />
                </div>
              </div>
              <div class="between">
                <label for="good">good: 6+</label>
                <div class="flex">
                  <span>748</span>
                  <input type="radio" name="rating" id="good" />
                </div>
              </div>
              <div class="between">
                <label for="pleasant">pleasant: 5+</label>
                <div class="flex">
                  <span>748</span>
                  <input type="radio" name="rating" id="pleasant" />
                </div>
              </div>
            </article>
            <article>
              <h4>facilities</h4>
              <div class="between">
                <label for="internet">internet access</label>
                <div class="flex">
                  <span>333</span>
                  <input type="checkbox" name="internet" id="internet" />
                </div>
              </div>
              <div class="between">
                <label for="room-service">room service</label>
                <div class="flex">
                  <span>310</span>
                  <input type="checkbox" name="room-service" id="room-service" />
                </div>
              </div>
              <div class="between">
                <label for="security">CCTV/security</label>
                <div class="flex">
                  <span>303</span>
                  <input type="checkbox" name="security" id="security" />
                </div>
              </div>
              <div class="between">
                <label for="non-smoking">non-smoking rooms</label>
                <div class="flex">
                  <span>275</span>
                  <input type="checkbox" name="non-smoking" id="non-smoking" />
                </div>
              </div>
              <button class="view">view more</button>
            </article>
            <article>
              <h4>star rating</h4>
              <ul class="rating-tabs">
                <li>5 stare <span>(51)</span></li>
                <li>4 stare <span>(51)</span></li>
                <li>3 stare <span>(51)</span></li>
                <li>2 stare <span>(51)</span></li>
                <li>1 stare <span>(51)</span></li>
              </ul>
            </article>
            <article>
              <h4>accommodation type</h4>
              <ul class="rating-tabs">
                <li>hostel <span>(72)</span></li>
                <li>hotel <span>(855)</span></li>
                <li>bed and breakfast <span>(51)</span></li>
                <li>motel <span>(51)</span></li>
                <li>serviced apaetment <span>(51)</span></li>
              </ul>
            </article>
            <article>
              <h4>payment mode</h4>
              <div class="between">
                <label for="prepaid">prepaid</label>
                <div class="flex">
                  <span>333</span>
                  <input type="checkbox" name="prepaid" id="prepaid" />
                </div>
              </div>
              <div class="between">
                <label for="o-payment">book with 0 payment</label>
                <div class="flex">
                  <span>333</span>
                  <input type="checkbox" name="o-payment" id="o-payment" />
                </div>
              </div>
              <div class="between">
                <label for="pay-at-hotel">pay at hotel</label>
                <div class="flex">
                  <span>333</span>
                  <input type="checkbox" name="pay-at-hotel" id="pay-at-hotel" />
                </div>
              </div>
            </article>
            <article>
              <h4>meals</h4>
              <div class="between">
                <label for="dinner">dinner included</label>
                <div class="flex">
                  <span>333</span>
                  <input type="checkbox" name="included" id="dinner" />
                </div>
              </div>
              <div class="between">
                <label for="breakfast">breakfast included</label>
                <div class="flex">
                  <span>333</span>
                  <input type="checkbox" name="included" id="breakfast" />
                </div>
              </div>
              <div class="between">
                <label for="lunch">lunch included</label>
                <div class="flex">
                  <span>333</span>
                  <input type="checkbox" name="included" id="lunch" />
                </div>
              </div>
            </article>
          </div>
        </aside>
        <!-- hotel Result -->
        <section class="hotel-result">
          <div class="between">
            <h1> Showing Properties In {{ ucfirst( session()->get('hotel_search_inputs')['hotel_city'] ?? session()->get('hotel_search_inputs')['location_city'] ?? 'Unknown') }}  </h1>
            <select name="sort" id="sort">
              <optgroup id="sort-opt">
                <option value="popularity">Popularity</option>
              </optgroup>
            </select>
          </div>
          <!-- Display Special Hotels -->
          @foreach($spacialhotels as $hotel)
          <div class="panal">
            <article class="hotel-card">
              <div class="img-box">
                <span class="fav">
                  <i class="fa-regular fa-heart"></i>
                </span>
                <div class="hotel-slider owl-carousel owl-theme">
                  @foreach(json_decode($hotel->hotel_images) as $image)
                  <div class="item">
                    {{-- "{{ url('/images/special-hotels/' . $image->type) }}"  --}}
                    <img src="{{ asset('/images/special-hotels/' . $image->type) }}"  alt="{{ $hotel->hotel_name }}" class="img-fluid logo">
                  </div>
                  @endforeach
                </div>
              </div>
              <div class="text-box">
                <article class="left">
                  <div class="headline">
                    <h2 class="title">
                        {{ $hotel->hotel_name }}</h2>
                      <div class="reviews">
                        @for ($i = 0; $i < $hotel->hotel_rating; $i++)
                        <i class="fa-solid fa-star"></i>
                        @endfor
                      </div>
                  </div>
                  <p class="address">
                    {{ $hotel->hotel_location }}<span class="dot">•</span>{{ $hotel->hotel_address }}
                  
                  </p>
                  <p>

                  </p>
                  <div class="badges">
                    <span class="rate">{{ $hotel->hotel_rating }}</span>
                    <span class="condition">good</span>
                    <span class="dot">•</span>
                    <div class="rate-count">{{ $hotel->hotel_reviews }} ratings</div>
                  </div>
                  <div class="offer">
                    <p>book with Rs.0 payment</p>
                    <p>Free Cancellation till {{ date('M d Y h:i A', strtotime($hotel->created_at)) }}</p>
                  </div>
                  <div class="services">
                    <div class="flex">
                      <img src="{{ asset('images/hotel/icons/bwol.png') }}" alt="" width="20" height="20">
                      <p>Restaurants</p>
                    </div>
                    <div class="flex">
                      <img src="{{ asset('images/hotel/icons/towel.png') }}" alt="" width="20" height="20">
                      <p>24*7 Room Service</p>
                    </div>
                  </div>
                </article>
                <article class="right">
                  <div class="off"> GBO Special Hotels </div>
                  <div class="off">5 rooms left</div>
                  <div class="price-box">
                    <del class="old-price">&#8377;3,339</del>
                    {{-- <h2 class="price">&#8377;{{ $hotel->hotel_room['roomofferprice'] }}</h2> --}}
                    <p>+302 tax & fees</p>
                    <p>per night, per room</p>
                  </div>
                  <button class="book"> <a href="{{ url('special-hotel/' . $hotel->id ) }}"> Book Now </a> </button> 
                </article>
              </div>
          </div>
          </article>
          @endforeach

          {{-- @php dd($hotels) @endphp --}}
          <!-- Display Fetched Hotels -->
          @foreach($hotels as $hotel)
          
          <div class="panal">
            <article class="hotel-card">
              <div class="img-box">
                <span class="fav">
                  <i class="fa-regular fa-heart"></i>
                </span>
                <div class="hotel-slider owl-carousel owl-theme">
                  @if(isset($hotel['Images']) && is_array($hotel['Images']) && count($hotel['Images']) > 0)
                  @foreach($hotel['Images'] as $image)
                  <div class="item">
                    <img src="{{ $image }}" alt="{{ $hotel['HotelName'] }}" class="img-fluid logo">
                  </div>
                  @endforeach
                  @endif
                </div>
              </div>
              <div class="text-box">
                <article class="left">
                  <div class="headline">
                    <h2 class="title">{{ $hotel['HotelName'] }}</h2>      
                      <div class="reviews">
                        @for ($i = 0; $i < $hotel['HotelRating']; $i++)
                        <i class="fa-solid fa-star"></i>
                        @endfor
                      </div>
                  </div>
                  <p class="address">
                    {{ $hotel['Address'] }}<span class="dot">•</span>{{ $hotel['CityName'] }},{{ $hotel['CountryName'] }} 
                    @if(isset($hotel['PhoneNumber'])  )
                     {{ $hotel['PhoneNumber'] }}
                    @endif
                  </p>
                  <div class="badges">
                    <span class="rate">{{ $hotel['HotelRating'] }}</span>
                    <span class="condition">good</span>
                    <span class="dot">•</span>
                    <div class="rate-count">Rating data not available</div>
                  </div>
                  <div class="offer">
                    <p>Additional offer details can go here</p>
                    @if(isset($hotel['CheckInTime'])  ) 
                    <p> Check-In : {{ $hotel['CheckInTime'] }} </p>
                    @endif
                    @if(isset($hotel['CheckOutTime']) )
                    <p> Check-Out : {{ $hotel['CheckOutTime'] }} </p>
                    @endif
                  </div>
                  <div class="services">
                  @if(isset($hotel['HotelFacilities']) && is_array($hotel['HotelFacilities']) && count($hotel['HotelFacilities']) > 0)
                    @foreach($hotel['HotelFacilities'] as $index => $facility)
                    <div class="flex facility {{ $index >= 5 ? 'additional-facilities' : '' }}" style="{{ $index >= 5 ? 'display: none;' : '' }}">
                        <img src="{{ asset('images/hotel/icons/towel.png') }}" alt="" width="20" height="20">
                        <p>{{ $facility }}</p>
                    </div>
                    @endforeach
                    @if(count($hotel['HotelFacilities']) > 5)
                        <span class="see-more" style="cursor: pointer; color: blue;">See More</span>
                        <span class="show-less" style="cursor: pointer; color: blue; display: none;">Show Less</span>
                    @endif
                  @endif
                  </div>
                </article>
                <article class="right">
                  <div class="off">Rooms available</div>
                  {{-- <div class="price-box">
                    <del class="old-price">Old price data</del>
                    <h2 class="price">New price data</h2>
                    <p>Additional pricing info</p>
                  </div> --}} 
                  <button class="book"> <a href="{{ url('hotel/view/' . $hotel['HotelCode'] ) }}"> Book now </a></button>
                </article>
              </div>
          </div>
          </article>
          @endforeach
      </div>
    </section>
  </div>
</main>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="{{ asset('js/hotel/main.js') }}"></script>


@endpush
