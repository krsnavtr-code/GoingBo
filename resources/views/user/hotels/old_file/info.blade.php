@php 
    // dd($rooms, $hotels, $prebook); 
@endphp 
@extends('user.components.layout')
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
	<link rel="stylesheet" href="{{ asset('css/hotel/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/hotel/hotel.css') }}" />
@endpush
@section('main')

 <main class="hotel-page">
        <section>
            <div class="container">
                <div class="grid-banner">
                    @if(isset($hotels['hotels'][0]['Images']) && is_array($hotels['hotels'][0]['Images']))
                        @foreach($hotels['hotels'][0]['Images'] as $index => $image)
                            @if($index < 5)
                                <img src="{{ $image }}" alt="Hotel Image {{ $index + 1 }}">
                            @endif
                        @endforeach
                    @endif
                    <figure class="badge">
                        <img src="{{ asset('images/hotel/icons/gallary.svg') }}" alt="Gallery icon">
                        @if(isset($hotels['hotels'][0]['Images']) && is_array($hotels['hotels'][0]['Images']))
                            <p>{{ count($hotels['hotels'][0]['Images']) }}+ Photos</p>
                        @endif
                    </figure>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="between">
                    <div class="headline">
                        <h2 class="title">
                            {{ $hotels[0]['HotelName'] ?? 'Hotel Name' }}
                        </h2>
                        @if(isset($hotels[0]['HotelRating']) && is_array($hotels[0]['HotelRating']))
                            <div class="reviews">
                                @for($i = 0; $i < $hotels[0]['HotelRating']; $i++)
                                    <i class="fa-solid fa-star"></i>
                                @endfor
                                @for($i = $hotels[0]['HotelRating']; $i < 5; $i++)
                                    <i class="fa-solid fa-star" style="color: #ccc;"></i>
                                @endfor
                            </div>
                        @endif
                    </div>
                    <div class="flex">
                        <button class="save">
                            <span>save</span>
                            <i class="fa-regular fa-heart"></i>
                        </button>
                        <button class="share">
                            <span>share</span>
                            <i class="fa-solid fa-arrow-up-from-bracket"></i>
                        </button>
                    </div>
                </div>
                <div class="sub">
                    <div class="badges">
                        <span class="rate">7.4</span>
                        <div>
                            <span class="condition">good</span>
                            <div class="rate-count">326 ratings</div>
                        </div>
                    </div>
                    <div class="address">
                        <img class="pin" src="{{ asset('images/hotel/icons/pin.png') }}" alt="">
                        <div>
                            <p>{{ $hotels[0]['Address'] ?? 'Address not available' }}</p>
                            <a href="#location" id="vom">view on map</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <nav class="hotel-nav">
            <div class="container">
                <ul>
                    <li><a href="#overview">overview</a></li>
                    <li><a href="#rooms">rooms</a></li>
                    <li><a href="#location">location</a></li>
                    <li><a href="#reviews">reviews</a></li>
                    <li><a href="#facilities">facilities</a></li>
                    <li><a href="#policies">policies</a></li>
                </ul>
            </div>
        </nav>
        <section id="overview">
            <div class="container">
                <div class="row">
                    <div>
                        <h3>About</h3>
                        {!! $hotels[0]['Description'] ?? '<p>Description not available</p>' !!}
                        <button>
                            <span>read more</span>
                            <i class="fa-solid fa-angle-down angle"></i>
                        </button>

                        <h3>Popular facilities</h3>
                        @if(isset($hotels[0]['HotelFacilities']) && is_array($hotels[0]['HotelFacilities']))
                        <ul class="facilities">                        
                            @foreach($hotels[0]['HotelFacilities'] as $facility)
                                <li>
                                    <span>
                                        <i class="fa-solid fa-person-swimming"></i>
                                    </span>
                                    <p>{{ $facility }}</p>
                                </li>
                            @endforeach
                        </ul>
                        @endif
                        <button href="#facilities">
                            <span>view more</span>
                            <i class="fa-solid fa-angle-down angle"></i>
                        </button>
                    </div>
                    <div>
                        <article class="recommended">
                            <div class="head">
                                <img src="{{ $hotels[0]['Images'][0] ?? asset('images/hotel/hotal.jpg') }}" alt="Recommended Deal" height="100">
                                <div class="deal">
                                    <span>recommended deal</span>
                                    <h4>{{ $rooms[0]['Rooms'][0]['Name'][0] ?? 'Standard Room' }}</h4>
                                </div>
                            </div>
                            <div class="body">
                                <ul>
                                    <li>non-refundable</li>
                                    <li>limited golf package</li>
                                </ul>
                                <div class="flex">
                                    <del><i class="fa-solid fa-indian-rupee-sign"></i>{{ number_format($rooms[0]['Rooms'][0]['DayRates'][0][0]['BasePrice'] ?? 0, 2) }}</del>
                                    <h4><i class="fa-solid fa-indian-rupee-sign"></i>{{ number_format($rooms[0]['Rooms'][0]['TotalFare'] ?? 0, 2) }}</h4>
                                </div>
                                <p>+ {{ number_format($rooms[0]['Rooms'][0]['TotalTax'] ?? 0, 2) }} taxes & fees <br> per night for 1 room</p>
                            </div>
                            <div class="buttons">
                                <button class="reserve">reserve 1 room</button>
                                <button>view all room</button>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>
        <section id="rooms">
            <div class="container">
                <h3>select your room</h3>
                <div class="panal">
                    <button>
                        <h4>{{ count($rooms[0]['Rooms']) }} room types</h4>
                        <i class="fa-solid fa-angle-down angle"></i>
                    </button>
                    <div class="rooms">
                        @foreach($rooms[0]['Rooms'] as $room)
                        <div class="room-card">
                            <div class="img-box">
                                <span class="fav">
                                    <i class="fa-regular fa-heart"></i>
                                </span>
                                @if(isset($hotels[0]['Images']) && is_array($hotels[0]['Images']))
                                <div class="hotel-slider owl-carousel owl-theme">
                                    @foreach($hotels[0]['Images'] as $image)
                                        <div class="item">
                                            <img src="{{ $image }}" alt="{{ $room['Name'][0] ?? 'Room Image' }}" class="img-fluid logo">
                                        </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            <div class="text-box">
                                <h4>{{ $room['Name'][0] ?? 'Room Name' }}</h4>
                                <ul class="speciality">
                                    <li>
                                        <i class="fa-solid fa-users"></i>
                                        <span>sleep 2</span>
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-bed"></i>
                                        <span>1 double bed</span>
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-eye"></i>
                                        <span>lake view</span>
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-crop-simple"></i>
                                        <span>28 sq. mt.</span>
                                    </li>
                                </ul>
                                <ul class="features">
                                    <li>bathrobes</li>
                                    <li>hairdryers</li>
                                    <li>mirror</li>
                                    <li>toiletries</li>
                                    <li>towels</li>
                                    <li>wi-fi</li>
                                    <li>satellite channels</li>
                                </ul>
                            </div>
                        </div>
                        <div class="options">
                            <div class="option-card">
                                <div>
                                    @if(isset($room['Inclusion']) && !is_bool($room['Inclusion']))
                                        <h4>{{ $room['Inclusion'] }}</h4>
                                    @else
                                        <h4>No inclusions available</h4>
                                        <!-- Optional: Handle the case when there's no inclusion -->
                                    @endif
                                    <ul>
                                        <li>non-refundable</li>
                                        <li>free wifi</li>
                                        <li>breakfast</li>
                                        <li>parking</li>
                                        <li>express check-in</li>
                                    </ul>
                                    <button>view all</button>
                                </div>
                                <div class="end">
                                    <div class="badge">26% off</div>
                                    <div class="flex">
                                        @if(isset($room['DayRates'][0][0]['BasePrice']) && is_numeric($room['DayRates'][0][0]['BasePrice']))
                                            <del><i class="fa-solid fa-indian-rupee-sign"></i>{{ number_format($room['DayRates'][0][0]['BasePrice'], 2) }}</del>
                                        @else
                                            <del><i class="fa-solid fa-indian-rupee-sign"></i>Price not available</del> 
                                        @endif

                                        @if(isset($room['TotalFare']) && is_numeric($room['TotalFare']))                                        
                                            <h2><i class="fa-solid fa-indian-rupee-sign"></i>{{ number_format($room['TotalFare'], 2) }}</h2>
                                        @else
                                            <h2><i class="fa-solid fa-indian-rupee-sign"></i>Fare not available</h2>
                                        @endif

                                    </div>
                                    
                                    @if(isset($room['TotalTax']) && is_numeric($room['TotalTax']))
                                        <p>+ {{ number_format($room['TotalTax'], 2) }} taxes & fees <br> per night for 1 room</p>
                                    @else
                                        <p>+ Taxes & fees not available <br> per night for 1 room</p> 
                                    @endif
                                    
                                    <button class="reserve">reserve 1 room</button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <section id="location">
            <div class="container">
                <h3>explore the area</h3>
                <div class="between">
                    <div class="flex">
                        <img src="{{ asset('images/hotel/icons/pin.png') }}" alt="" height="30">
                        <address>{{ $hotels[0]['Address'] ?? 'Address not available' }}</address>
                    </div>
                    @if(isset($hotels[0]['Map']))
                        <a href="https://www.google.com/maps/search/?api=1&query={{ $hotels[0]['Map'] }}" target="_blank" class="map-btn">View on Google Map</a>
                    @else
                        <a href="#" class="map-btn disabled">Location not available</a> 
                    @endif
                </div>
                @if(isset($hotels[0]['Map']))
                    <iframe class="map" src="https://www.google.com/maps/embed?pb={{ urlencode($hotels[0]['Map']) }}"  height="400" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                @endif
                
            </div>
        </section>
       
        <section id="reviews">
			<div class="container">
				<div class="row">
					<div class="col-4">
						<div class="review-meta">
							<h2>8.0</h2>
							<div class="">
								<h5>Excellent</h5>
								<h6>669 ratings</h6>
							</div>
						</div>
						<figure>
							<div data-testid="progress-bar" class="progress-bar">
								<div class="progress"></div>
							</div>
							<div class="between">
								<h6>Cleanliness</h6>
								<small>7.5</small>
							</div>
						</figure>
						<figure>
							<div data-testid="progress-bar" class="progress-bar">
								<div class="progress"></div>
							</div>
							<div class="between">
								<h6>Value for Money</h6>
								<small>6.5</small>
							</div>
						</figure>
						<figure>
							<div data-testid="progress-bar" class="progress-bar">
								<div class="progress"></div>
							</div>
							<div class="between">
								<h6>
									Staff</h6>
								<small>8.0</small>
							</div>
						</figure>
						<figure>
							<div data-testid="progress-bar" class="progress-bar">
								<div class="progress"></div>
							</div>
							<div class="between">
								<h6>Location</h6>
								<small>7.2</small>
							</div>
						</figure>
					</div>
					<div class="col-8">
						<h2>716 reviews</h2>
						<ul class="tags">
							<li>all reviews (716)</li>
							<li>couple (434)</li>
							<li>group (121)</li>
						</ul>
						<div class="review-box">
							<article class="review">
								<div class="flex">
									<h4>exceptional</h4>
									<span class="badge">10</span>
								</div>
								<p>very nice</p>
								<div class="user">
									<img src="{{ asset('images/hotel/icons/in.svg') }}" alt="" width="30" height="30">
									<div>
										<span>group</span>
										<span>•</span>
										<span>India</span>
										<span>•</span>
										<span>Jul 2024</span>
									</div>
								</div>
							</article>
							<button>view all reviews</button>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section id="facilities">
			<div class="container">
				<h2>Hotel facilities</h2>
				<div class="box">
                    {{-- @foreach (json_decode($hotel['hotel_amenities'], true) as $category => $amenities)
					<article>
						<h4><i class="fa-solid fa-id-card"></i><span>{{ ucfirst($category) }}</span></h4>
						<ul>
                           
							<li>{{ $amenities['type'] }}</li>
                            
						</ul>
					</article>
                    @endforeach --}}
				</div>
			</div>
		</section>
		<section id="policies">
			<div class="container">
				<h2>Hotel policies</h2>
				<div class="box">
                    <div class="flex">
						<h4> <i class="fa-solid fa-arrow-right-to-bracket"></i><span>check-in</span> </h4>
						<p>from 14:00</p>
					</div>
					<div class="flex">
						<h4> <i class="fa-solid fa-arrow-right-from-bracket"></i><span>check-out</span> </h4>
						<p>till 11:00</p>
					</div>
                    <div class="flex">
                        <h4><i class="fa-solid fa-children"></i><span>Children and extra beds</span></h4>
                        <article class="extra">
                            <p>• All children are welcome.</p>
                            <div class="flex">
                                <h5>infant 0-3 year(s)-</h5>
                                <p>Stay for free if using existing bedding. Note, if you need a cot there may be an extra charge.</p>
                            </div>
                            <div class="flex">
                                <h5>Children 4-5 year(s)-</h5>
                                <p>Stay for free if using existing bedding. If you need an extra bed, it will incur an additional charge.</p>
                            </div>
                            <div class="flex">
                                <h5>Guests above 6 year(s)-</h5>
                                <p>Must use an extra bed which will incur an additional charge.</p>
                            </div>
                            <div class="flex">
                                <h5>other-</h5>
                                <p>Extra beds are dependent on the room you choose. Please check the individual room capacity for more details.</p>
                            </div>
                        </article>
                    </div>
					<div class="flex">
						<h4><i class="fa-solid fa-square-poll-horizontal"></i><span>Property Information</span></h4>
						<ul class="Property">
							<li>Reception open until - 00:00</li>
							<li>Reception open until - 00:00</li>
							<li>Reception open until - 00:00</li>
							<li>Reception open until - 00:00</li>
							<li>Reception open until - 00:00</li>
							<li>Reception open until - 00:00</li>
						</ul>
					</div>
					<div class="flex">
						<h4><i class="fa-solid fa-arrow-right-from-bracket"></i><span>Property Announcements</span></h4>
						<article>
							<p>• Free Wi-Fi is only available in the lobby.</p>
							<p>Please note that any changes in tax structure due to government policies will result in revised taxes, which will be applicable to all reservations and will be charged additionally during check out.</p>
						</article>
					</div>
				</div>
			</div>
		</section>
		<section id="similer">
			<div class="container">
				<h2>People also viewed</h2>
				<div class="similer-slider owl-carousel owl-theme">
					<div class="item">
						<article class="card">
							<img src="{{ asset('images/hotel/hotal.jpg') }}"  alt="image">
							<div class="head">
								<h5 class="title"><a href="hotel.html">Hotal Maharana Inn dhsadjhahbjh</a></h5>
								<div class="reviews">
									<i class="fa-solid fa-star"></i>
									<i class="fa-solid fa-star"></i>
									<i class="fa-solid fa-star"></i>
									<i class="fa-solid fa-star"></i>
									<i class="fa-solid fa-star"></i>
								</div>
							</div>
							<p class="address">Chambur<span class="dot">•</span>1.5 KM form City Squre</p>
							<div class="body">
								<div class="left">
									<div class="badges">
										<span class="rate">7.4</span>
										<span class="condition">good</span>
										<span class="dot">•</span>
										<div class="rate-count">326 ratings</div>
									</div>
									<div class="offer">
										<p>book with $0 payment</p>
										<p>Free wifi</p>
									</div>
								</div>
								<div class="end">
									<div class="flex">
										<del class="old-price">&#8377;2,851</del>
										<strong class="price">&#8377;1,999</strong>
									</div>
									<p>+253 tax & fees <br> per night, per room</p>
								</div>
							</div>
						</article>
					</div>
					<div class="item">
						<article class="card">
							<img src="{{ asset('images/hotel/hotal.jpg') }}" alt="image">
							<div class="head">
								<h5 class="title"><a href="hotel.html">Hotal Maharana Inn dhsadjhahbjh</a></h5>
								<div class="reviews">
									<i class="fa-solid fa-star"></i>
									<i class="fa-solid fa-star"></i>
									<i class="fa-solid fa-star"></i>
									<i class="fa-solid fa-star"></i>
									<i class="fa-solid fa-star"></i>
								</div>
							</div>
							<p class="address">Chambur<span class="dot">•</span>1.5 KM form City Squre</p>
							<div class="body">
								<div class="left">
									<div class="badges">
										<span class="rate">7.4</span>
										<span class="condition">good</span>
										<span class="dot">•</span>
										<div class="rate-count">326 ratings</div>
									</div>
									<div class="offer">
										<p>book with $0 payment</p>
										<p>Free wifi</p>
									</div>
								</div>
								<div class="end">
									<div class="flex">
										<del class="old-price">&#8377;2,851</del>
										<strong class="price">&#8377;1,999</strong>
									</div>
									<p>+253 tax & fees <br> per night, per room</p>
								</div>
							</div>
						</article>
					</div>
				</div>
		</section>
		<section class="offcanvas">
			<div class="img-box">
				<img  src="{{ asset('images/hotel/icons/booking.svg') }}"  alt="">
			</div>
            @include('user.hotels.bookingform')
			{{-- <form action="" class="text-box">
				<button type="reset" class="x">x</button>
				<div class="inputs">
					<select>
						<option value="mr.">mr.</option>
						<option value="ms.">ms.</option>
						<option value="mrs.">mrs.</option>
					</select>
					<input type="text" placeholder="enter your first name">
					<input type="text" placeholder="enter your middle name">
					<input type="text" placeholder="enter your last name">
					<input type="email" placeholder="enter your email address">
					<input type="phone" placeholder="enter your phone number">
					<input type="text" placeholder="enter your PAN Card number">
					<input type="number" placeholder="enter your age">
					<input type="text" placeholder="enter your passport number">
					<input type="date" placeholder="enter your passport issue date">
					<input type="date" placeholder="enter your passport exp. date">
					<input type="text" placeholder="enter your GST company name">
					<input type="number" placeholder="enter your GST company number">
					<input type="text" placeholder="enter your GST company address">
					<input type="phone" placeholder="enter your GST company contacts">
					<input type="email" placeholder="enter your GST company email">
				</div>
				<button type="submit" id="off-btn">submit</button>
			</form> --}}
		</section>
	</main>
@endsection

@push('js')
<script>
    // Assuming the entire structure is stored in a variable named rooms
    var rooms = @json($rooms);

    // Access and log the BookingCode
    if (rooms.hotels && rooms.hotels.length > 0 ) {
        console.log(rooms.hotels[0].Rooms[0].BookingCode);
    } else {
        console.log("BookingCode not found");
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="{{ asset('js/hotel/main.js') }}"></script>

@endpush