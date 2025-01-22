@extends('user.components.layout')
@push('css')
<link rel="stylesheet" href="{{ url('css/user_css/package.css') }}">
@endpush
@section('main')
<main class="container">
    <div class="my-row">
        <section>
            <div class="heading">
                <h4>{{ $package['title'] }}</h4>
                <h6>
                    <span>{{ $package['night'] + 1 }}days</span>
                    -
                    <span>{{ $package['night'] }} nights</span>
                </h6>
            </div>
            <div class="gallery">
                @php $old_hotel='' @endphp
                @foreach ($days as $i => $day)
                @if ($day['pck_img'] && $old_hotel != $day['hotel_name'])
                @php $old_hotel=$day['hotel_name'] @endphp
                <article class="img-box">
                    <img src="{{ url('/images/package/' . $day['pck_img']) }}" alt="">
                    <div class="between">
                        <h6>Day {{ $i + 1 }} stay - {{ $day['hotel_name'] }} </h6>
                    </div>
                </article>
                @endif
                @endforeach
            </div>
            <div class="details">
                <h2>details</h2>
                <div class="panel">
                    <h4>{{ $package['pckg_head']}}</h4>
                    <p>{{ $package['pckg_head_2']}}</h>
                    <div class="additional-content">
                        <p>{!! $package['pckg_head_3'] !!}</p>
                        <p>{!! $package['pckg_head_4'] !!}</p>
                        <p>{!! $package['pckg_head_5'] !!}</p>
                        <p>{!! $package['pckg_head_6'] !!}</p>
                        <p>{!! $package['pckg_head_7'] !!}</p>
                    </div>
                    <button id="loadMoreBtn">load more</button>
                    <button id="hideAllBtn" style="display: none;">hide all</button>
                </div>
            </div>
            <div class="activities">
                <h2>activities</h2>
                <div class="panel">
                    @foreach ($days as $i => $day)
                    <article class="activity-card">
                        <div class="date">
                            <h5>{{ $i + 1 }}</h5>
                            <span>day</span>
                        </div>
                        <div>
                            <h6 class="title">{{ $day['day'] }}</h6>
                            <div class="between">
                                <div class="hotel-name">
                                    <i class="fa-solid fa-hotel"></i>
                                    <h6>{{ $day['hotel_name']}}</h6>
                                </div>
                                <div class="transport">
                                    <i class="fa-solid fa-car"></i>
                                    <h6>{{ $day['type_of_transport'] }}</h6>
                                </div>
                            </div>
                            <div class="activity">
                                <h6>Activities:</h6>
                                <p>{{ $day['activity'] }}</p>
                            </div>
                            <p class="activity-des">{!!$day['activity_des']!!}</p>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
            <div class="reviews">
                <h2>reviews</h2>
                <div class="panel">
                    <article class="review">
                        <div class="img-box">
                            <img src="/images/profiles/profile 2.png" alt="user" width="60">
                            <div class="stars">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                        <div class="text-box">
                            <h5>Buddy</h5>
                            <p class="review_desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt
                                doloribus a facere iure repellendus autem ea voluptatum sint sed totam, quis qui
                                quibusdam quidem dicta culpa, reprehenderit veritatis ipsum laborum.</p>
                        </div>
                    </article>
                    <article class="review">
                        <div class="img-box">
                            <img src="/images/profiles/profile 2.png" alt="user" width="60">
                            <div class="stars">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                        <div class="text-box">
                            <h5>Buddy</h5>
                            <p class="review_desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt
                                doloribus a facere iure repellendus autem ea voluptatum sint sed totam, quis qui
                                quibusdam quidem dicta culpa, reprehenderit veritatis ipsum laborum.</p>
                        </div>
                    </article>
                </div>
            </div>
            <div class="poicies">
                <h2>policies</h2>
                <div class="panel">
                    <div class="policy">
                        <h5>Cancellation Policies</h5>
                        <p>Cancellation Not Allowed</p>
                    </div>
                    <div class="policy">
                        <h5>Date change Policies</h5>
                        <p>Date change Not Allowed</p>
                    </div>
                </div>
            </div>
            <div class="terms">
                <h2>terms</h2>
                <div class="panel">
                    <ul>
                        <li>Standard check-in time at the hotel is normally 2:00 pm and check-out is 11:00 am. An early
                            check-in, or a late check-out is solely based on the discretion of the hotel.</li>
                        <li>A maximum of 3 adults are allowed in one room. The third occupant shall be provided a
                            mattress/rollaway bed.</li>
                        <li>The itinerary is fixed and cannot be modified. Transportation shall be provided as per the
                            itinerary and will not be at disposal. For any paid activity which is non-operational due to
                            any unforeseen reason, we will process refund & same should reach the guest within 30 days
                            of processing the refund.</li>
                        <li>Also, for any activity which is complimentary and not charged to GBO & guest, no refund will
                            be processed.</li>
                        <li>AC will not be functional anywhere in cool or hilly areas.</li>
                        <li>Entrance fee, parking and guide charges are not included in the packages.</li>
                        <li>If your flights involve a combination of different airlines, you may have to collect your
                            luggage on arrival at the connecting hub and register it again while checking in for the
                            onward journey to your destination.</li>
                        <li>Booking rates are subject to change without prior notice.</li>
                        <li>Airline seats and hotel rooms are subject to availability at the time of booking.</li>
                        <li>Pricing of the booking is based on the age of the passengers. Please make sure you enter the
                            correct age of passengers at the time of booking. Passengers furnishing incorrect age
                            details may incur penalty at the time of travelling.</li>
                        <li>In case of unavailability in the listed hotels, arrangement for an alternate accommodation
                            will be made in a hotel of similar standard.</li>
                        <li>In case your package needs to be cancelled due to any natural calamity, weather conditions
                            etc. GoingBo shall strive to give you the maximum possible refund subject to the
                            agreement made with our trade partners/vendors.</li>
                        <li>GBO reserves the right to modify the itinerary at any point, due to reasons including but
                            not limited to: Force Majeure events, strikes, fairs, festivals, weather conditions, traffic
                            problems, overbooking of hotels / flights, cancellation / re-routing of flights, closure of
                            /entry restrictions at a place of visit, etc. While we will do our best to make suitable
                            alternate arrangements, we would not be held liable for any refunds/compensation claims
                            arising out of this.</li>
                        <li>Certain hotels may ask for a security deposit during check-in, which is refundable at
                            check-out subject to the hotel policy.</li>
                        <li>The booking price does not include: Expenses of personal nature, such as laundry, telephone
                            calls, room service, alcoholic beverages, mini bar charges, tips, portage, camera fees etc.
                        </li>
                        <li>Any other items not mentioned under Inclusions are not included in the cost of the booking.
                        </li>
                        <li>The package price does not include mandatory gala dinner charges levied by the hotels
                            especially during New Year and Christmas or any special occasions. GoingBo shall try to
                            communicate the same while booking the package. However GoingBo may not have this
                            information readily available all the time.</li>
                        <li>Cost of deviation and cost of extension of the validity on your ticket is not included.</li>
                        <li>For queries regarding cancellations and refunds, please refer to our Cancellation Policy.
                        </li>
                        <li>Disputes, if any, shall be subject to the exclusive jurisdiction of the courts in New Delhi.
                        </li>
                        <li>Dudhsagar Waterfalls is closed in the monsoon (June - September).</li>
                        <li>Activities related to water sports are subject to weather and wind conditions on the ground.
                        </li>
                        <li>The cost of mentioned tours and transfer is not valid between 6 pm to 8 am.</li>
                    </ul>
                </div>
            </div>
        </section>
        <aside class="sidebar">
            <div class="side_panels">
                <div class="booking-box panel">
                    <h6 class="new_price">
                        <i class="fa-solid fa-indian-rupee-sign fa-sm"></i>
                        <span>{{ preg_replace('/\D/', '', $package['price']) }}</span>
                        <span class="price_text">Per Person</span>
                    </h6>
                    <p>*Excluding applicable taxes</p>
                    {{-- href="{{ url('packages/' . $package['slug']) }}" --}}
                    <a href="{{ url('packages/review/' . $package['id']) }}" class="btnn">Proceed to book</a>
                </div>
                <div class="query-box panel">
                    <h5>Raise A Query</h5>
                    <p>Having anything in mind, feel free to write us. We are here for you. We will connect you back as soon
                        as possible</p>
                    <button>Raise A Query</button>
                </div>
            </div>
        </aside>
    </div>
</main>
@endsection

@push('js')

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const loadMoreBtn = document.getElementById("loadMoreBtn");
        const hideAllBtn = document.getElementById("hideAllBtn");
        const additionalContent = document.querySelectorAll(".additional-content");

        let visibleContentCount = 0;

        // Function to show additional content
        function showAdditionalContent() {
            const contentToShow = 3; // Change this value based on how many additional items you want to show

            for (let i = 0; i < contentToShow; i++) {
                if (additionalContent[visibleContentCount]) {
                    additionalContent[visibleContentCount].style.display = "block";
                    visibleContentCount++;
                } else {
                    // Hide the "Load More" button if there is no more content to show
                    loadMoreBtn.style.display = "none";
                    hideAllBtn.style.display = "inline-block"; // Display the "Hide All" button
                    break;
                }
            }
        }

        // Function to hide all additional content
        function hideAllContent() {
            additionalContent.forEach(content => {
                content.style.display = "none";
            });

            // Display the "Load More" button and hide the "Hide All" button
            loadMoreBtn.style.display = "inline-block";
            hideAllBtn.style.display = "none";
            visibleContentCount = 0; // Reset the counter
        }

        // Event listeners for the buttons
        loadMoreBtn.addEventListener("click", showAdditionalContent);
        hideAllBtn.addEventListener("click", hideAllContent);
    });
</script>

@endpush