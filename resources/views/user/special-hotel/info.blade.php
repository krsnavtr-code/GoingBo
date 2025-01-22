@extends('user.components.layout')
@push('css')


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
<link rel="stylesheet" href="{{ asset('css/hotel/style.css') }}" />
<link rel="stylesheet" href="{{ asset('css/hotel/special_hotel.css') }}" />
<style>
	.hidden {
		background: red;
		display: none !important;
	}
</style>


@endpush
@php
//dd($hotel);
@endphp
@section('main')

<main class="hotel-page">
	<section>
		<div class="container">
			<div class="grid-banner">
				@php
				$imagesToShow = array_slice(json_decode($hotel['hotel_images'], true), 0, 5);
				@endphp
				@foreach($imagesToShow as $image)
				<img src="{{ url('/images/special-hotels/' . $image['type']) }}" alt="Hotel Image">
				@endforeach

				<figure class="badge">
					<i class="fa-regular fa-images"></i>
					<p class="">{{ count(json_decode($hotel['hotel_images'], true)) }}+ Photos</p>
				</figure>
			</div>
		</div>
	</section>
	<section>
		<div class="container">
			<div class="between">
				<div class="headline">
					<h2 class="title">
						<a href="hotel.html">
							{{ $hotel['hotel_name'] }}
						</a>
					</h2>
					<div class="reviews">
						<i class="fa-solid fa-star"></i>
						<i class="fa-solid fa-star"></i>
						<i class="fa-solid fa-star"></i>
						<i class="fa-solid fa-star"></i>
						<i class="fa-solid fa-star"></i>
					</div>
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
					<span class="rate">{{ $hotel['hotel_rating'] }}</span>
					<div>
						<span class="condition">good</span>
						<div class="rate-count flex">{{ $hotel['hotel_reviews'] }}<span>Ratings</span></div>
					</div>
				</div>
				<div class="address">
					<img class="pin" src="\images\hotel\img\icons\pin.png" alt="">
					<div>
						<p>
							{{ $hotel['hotel_address'] }}
							<span class="dot">•</span>
							{{ $hotel['hotel_location'] }}
						</p>
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
	@php
	$hotelData = json_decode($hotel['hotel_description'], true);
	$icons = json_decode($hotel['hotel_amenities'], true)['General'];
	$rooms = json_decode($hotel['hotel_room'], true);
	@endphp
	<section id="overview" class="container">
		<article>
			<div>
				<h2>About</h2>
				<p>{{ $hotelData['hotel_description'] }}</p>
			</div>
			<div>
				<h3>Popular facilities</h3>
				<ul class="facilities">
					@foreach ($icons as $index => $icon)
					<li class="{{ $index >= 9 ? 'conditional hidden' : '' }}">
						<span><i class="fa-solid fa-person-swimming"></i></span>
						<p>{{ $icon['type'] }}</p>
					</li>
					@endforeach
				</ul>
				<button class="toggle-facilities-btn">
					<span>view {{ count($icons) - 9 }}+ more</span>
					<i class="fa-solid fa-angle-down angle"></i>
				</button>
		</article>
		<article class="recommended">
			@php
			$room = $rooms[0];
			@endphp
			<img src="{{ url('/images/special-hotels/' . $image['type']) }}" alt="{{ $room['room_type'] }}">
			<span class="deal">recommended deal</span>
			<div class="text-box">
				<h4>{{ $room['room_type'] }}</h4>
				<ul>
					<li>non-refundable</li>
					<li>limited golf package</li>
				</ul>
				<div class="flex">
					<span>price:</span>
					<del>
						<i class="fa-solid fa-indian-rupee-sign"></i>
						{{ $room['roomactualprice'] }}
					</del>
					<h4>
						<i class="fa-solid fa-indian-rupee-sign"></i>
						{{ $room['roomofferprice'] }}
					</h4>
				</div>
				<p>+ 285 taxes & fees <br> per night for 1 room</p>
				<a
					class="reserve"
					href="{{ url('special-hotel/book/'.$hotel['id']) }}?type={{$room['room']}}">
					reserve 1 room </a>
			</div>
		</article>
	</section>
	<section id="rooms" class="container">
		<h3>select your room</h3>
		<div class="panal">
			<button>
				<h4>{{ count(json_decode($hotel['hotel_room'], true)) }} rooms type</h4>
				<i class="fa-solid fa-angle-down angle"></i>
			</button>
			<div class="rooms">
				@foreach (json_decode($hotel['hotel_room'], true) as $room)
				<div class="room-card">
					<div class="img-box">
						<span class="fav">
							<i class="fa-regular fa-heart"></i>
						</span>
						<div class="hotel-slider room-slider owl-carousel">
							@foreach (json_decode($hotel['hotel_images'], true) as $image)
							<div class="item">
								<img src="{{ url('/images/special-hotels/' . $image['type']) }}" alt="hotel name" class="img-fluid logo">
							</div>
							@endforeach
						</div>
					</div>
					<div class="card-box">
						<div class="text-box">
							<h4>{{ $room['room_type'] }}</h4>
							<article class="flex">
								<h6>Specialty: </h6>
								<ul class="specialty">
									<li><i class="fa-solid fa-users"></i><span>sleep 2</span></li>
									<li><i class="fa-solid fa-bed"></i><span>{{$room['Room_Bed']}} bed</span></li>
									<li><i class="fa-solid fa-eye"></i><span>lake view</span></li>
									<li><i class="fa-solid fa-crop-simple"></i>
										<span>{{$room['room_dimention']}} sq. mt.</span>
									</li>
								</ul>
							</article>
							<hr>
							<article class="flex">
								@php
								$facilities = json_decode($room['failities'], true)
								@endphp
								<h6>Facilities:</h6>
								<ul class="facilities features">
									@foreach ($facilities as $index => $facility)
									<li class="{{ $index >= 10 ? 'conditional hidden' : '' }}">
										<p>{{ $facility['facilities'] }}</p>
									</li>
									@endforeach
								</ul>
							</article>
							<!-- <ul>
							<h5>Policies:</h5>
							@foreach (json_decode($room['policies'], true) as $policy)
							<li>{{ $policy['poilices'] }}</li>
							@endforeach
						</ul> -->
							<button class="toggle-facilities-btn">
								<span>view {{ count($facilities) - 10 }}+ more</span>
								<i class="fa-solid fa-angle-down angle"></i>
							</button>
						</div>
						<div class="end">
							<span class="off-badge">{{ $room['room_discount'] }}% off</span>
							<div>
								<del>
									<i class="fa-solid fa-indian-rupee-sign"></i>
									{{ $room['roomactualprice'] }}
								</del>
								<h4>
									<i class="fa-solid fa-indian-rupee-sign"></i>
									{{ $room['roomofferprice'] }}
								</h4>
								<p>{{ $room['roomtax'] }} taxes & fees <br> per night for 1 room</p>
							</div>
							<a class="reserve" href="{{ url('special-hotel/book/'.$hotel['id']) }}?type={{$room['room']}}"> reserve room </a>
						</div>
					</div>
				</div>
				@endforeach
			</div>

		</div>
	</section>
	<section id="location">
		<div class="container">
			<h3>explore the area</h3>
			<div class="between">
				<div class="flex">
					<img src="/images/hotel/img/icons/pin.png" alt="image" width="30">
					<address>{{ $hotel['hotel_address'] }}</address>
				</div>
				<a href="https://www.google.com/maps" target="_blank" class="map-btn">view on google map</a>
			</div>
			<iframe class="map"
				src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3844.720729137091!2d73.82812147512396!3d15.499446885100507!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMTXCsDI5JzU4LjAiTiA3M8KwNDknNTAuNSJF!5e0!3m2!1sen!2sin!4v1721819442049!5m2!1sen!2sin"
				height="400" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div>
	</section>
	<section id="reviews" class="container">
		<div class="col-4">
			<div class="review-meta">
				<h2>8.0</h2>
				<div class="">
					<h5>good</h5>
					<h6>{{ $hotel['hotel_rating'] }} <span>Ratings</span></h6>
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
			<h2>{{ $hotel['hotel_reviews'] }}reviews</h2>
			<ul class="tags">
				<li>all reviews ({{ $hotel['hotel_reviews'] }})</li>
				<li>couple (2)</li>
				<li>group (0)</li>
			</ul>
			<div class="review-box">
				<article class="review">
					<div class="flex">
						<h4>exceptional</h4>
						<span class="badge">10</span>
					</div>
					<p>very nice</p>
					<div class="user">
						<img src="/images/hotel/img/icons/in.svg" alt="" width="30" height="30">
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
	</section>

	<section id="policies">
		<div class="container">
			<h2>Hotel policies</h2>
			<div class="box">
				@foreach (json_decode($hotel['hotel_policies'], true) as $policyName => $policyValue)
				@if (gettype($policyValue) != 'array')
				<div class="flex">
					<h4><i class="fa-solid fa-arrow-right-to-bracket"></i>
						<span>{{ ucfirst(str_replace('_', ' ', $policyName)) }}</span>
					</h4>
					<p>{{ $policyValue }}</p>
				</div>
				@endif
				@endforeach
				<div class="flex">
					<h4>
						<i class="fa-solid fa-arrow-right-to-bracket"></i>
						Opened:
					</h4>
					<p>{{ $hotelData['hotel_opened'] }}</p>
				</div>
				<div class="flex">
					<h4>
						<i class="fa-solid fa-arrow-right-to-bracket"></i>
						Renovated:
					</h4>
					<p>{{ $hotelData['hotel_renovated'] }}</p>
				</div>
				<div class="flex">
					<h4>
						<i class="fa-solid fa-arrow-right-to-bracket"></i>
						Number of Rooms:
					</h4>
					<p>{{ $hotelData['hotel_number0froom'] }}</p>
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
						<img src="/images/hotel/img/hotal.jpg" alt="image">
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
						<img src="/images/hotel/img/hotal.jpg" alt="image">
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
	<!-- <section class="offcanvas">
		<div class="img-box">
			<img src="./img/icons/booking.svg" alt="">
		</div>
		<form action="" class="text-box">
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
		</form>
	</section> -->
</main>
@endsection

@push('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="{{ asset('js/hotel/main.js') }}"></script>
<script>
	$('.toggle-facilities-btn').on('click', function() {
		$('.conditional').toggleClass('hidden');
	});
</script>

@endpush