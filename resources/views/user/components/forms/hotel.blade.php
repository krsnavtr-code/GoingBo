

@inject('countries', App\Models\Country::class)
@inject('hotelcities', App\Models\HotelCityData::class )

<!-- Inject the HotelCityData model -->
@php
    $hotelCities = $hotelcities::all()->map(function ($city) {
        return [
            'name' => $city->Hotel_Name,
            'city' => $city->City
        ];
    })->toArray();
    // dd($hotelCities);
@endphp



<style>
    .suggestion-item {
        display: flex;
        align-items: center;
        padding: 5px;
    }
    
    .suggestion-item i {
        font-size: 24px;
        margin-right: 10px;
    }
    @media only screen and (max-width:768px){
        label{
            display: none;
        }
    }
</style>


<form action='/hotel/search_results' id="hotel_search_form" method="get" class="hotel_form" onsubmit="return validateForm()">


    <div class="trip_types jcsb">
        <div class="rflex ">
            <div class="trip_type">
                <input type="radio" name="CountryType" class="" value="IN" checked>
                <span class="">India</span>
            </div>

            <div class="trip_type">
                <input type="radio" name="CountryType" class="international-radio-btn">
                <span class=""> International </span>
            </div>

        </div>

        <div class="offer-box">
            <ul class="offer-window">
                <li>Join the club of happy travellers.</li>
                <li>Get 20% OFF on hotels as welcome gift.</li>
                <li>Book hotels @ ₹0 and pay later.</li>
                <li>Hassle Free Bookings.</li>
            </ul>
        </div>
    </div>

    <div class="fields rflex">
        <div class="vu-select cou-select" style="display: none;">
            <div class="vu-content cou-content">
                <label for="">Country</label>
                <input type="hidden" class="code" name="CountryCode">
                <input type="hidden" name="country_extra_2">
                <input type="text" name="country_extra_1" placeholder="Enter Country Name">
            </div>
            <div class="vu-suggestion cou-suggestion" style="display: none; background: transparent; box-shadow:none">
                @foreach($countries::all()->toArray() as $country)
                @if($country['country_name'] == 'India')
                    @continue
                @endif
                <div class="cou-option" data-value="{{ $country['country_name'] }}" data-code="{{ $country['country_code2'] }}" style="display: none;">
                    {{ $country['country_name'] }}
                </div>
                @endforeach
            </div>
        </div>
        <div class="destiantions">
            <div class="wrapper location">
                <div class="col-12">
                    <div class="vu-select from-select">
                        <div class="vu-content">
                            <label for="cityInput"> Where </label>
                            <input type="text" id="cityInput" placeholder="Enter Hotel or location" class="vu-input" autocomplete="off"  required>
                            <span id="cityname"> </span>
                            <input type="hidden" id="whereinput" name="whereinput">
                            <input type="hidden"  name="latitude">
                            <input type="hidden"  name="longitude">
                            <input type="hidden" id="hotelCityInput" name="hotel_city">
                            <input type="hidden" id="locationCityInput" name="location_city">

                        </div>
                        <div class="vu-suggestion" id="cit-suggestion"></div>
                    </div>
                </div>

            </div>
        </div>
        <div class="dates-wrap">
            <div class="wrapper dates">
                <div class="col-6">
                    <div class="vu-date">
                        <div class="vu-content">
                            <label for="dep_date"> Check-in </label>
                            <input type="date" name="dep_date" id="dep_date_1" data-fare="" required>
                            <p id="dep_day">Check-in Date</p>
                        </div>
                    </div>
                </div>
                <span id="nights_between" > </span>
                <input type="hidden" name="nights" value="">


                <div class="col-6">
                    <div class="vu-date">
                        <div class="vu-content">
                            <label for=""> Check-out </label>
                            <input type="date" name="ret_date" id="ret_date_1" required>
                            <p id="ret_day">Check-out Date</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>





        <div class="paxs col-3">
            <div class="wrapper pax  pax_1" tabindex="0">
                <div class="vu-content">
                    <label for=""> Guests & Rooms </label>
                    <div class="desc" id="pass_det_1"> 1Room, 1 Adult</div>
                    <p id="fclass_1"> </p>
                </div>
                <div class="vu-suggest">
                    <div class="counters rflex">
                        <div class="count-wrap">
                            <h6>Rooms</h6>
                            <p>( Max 6 )</p>
                            <div class=" counter_1">
                                <i class="fa-solid fa-minus"></i>
                                <input type="number" name="room" id="room_no" value="1" min="1" max="6">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                        </div>
                        <div class="count-wrap">
                            <h6>Adults</h6>
                            <p>(12+ years)</p>
                            <div class=" counter_1">
                                <i class="fa-solid fa-minus"></i>
                                <input type="number" name="adult" id="adult_pax_1" value="1" min="1">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                        </div>
                        <div class="count-wrap">
                            <h6>Children</h6>
                            <p>(0-12 years)</p>
                            <div class=" counter_1">
                                <i class="fa-solid fa-minus"></i>
                                <input type="number" name="child" id="child_pax_1" value="0" min="0">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                        </div>
                        <div id="child_age_inputs" style="display: none;">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="child_ages" name="child_ages">
<!--         <div class="vu-select card">
            <div class="rate">
                <span onclick="gfg(1)" class="star">★
                </span>
                <span onclick="gfg(2)" class="star">★
                </span>
                <span onclick="gfg(3)" class="star">★
                </span>
                <span onclick="gfg(4)" class="star">★
                </span>
                <span onclick="gfg(5)" class="star">★
                </span>
                <input type="hidden" name="ratings" id="ratings">
            </div>

            <div id="output">
                <h6>Rating : 0/5</h6>
            </div>
        </div> -->

    </div>


    <button type="submit" id="search_btn" class="btn search_btn"><i class="fa-solid fa-magnifying-glass"></i>Search Hotels </button>


</form>

@push('js')

<script>
    $(document).ready(function() {
        // Trigger change event for default selection
        $('input[name="CountryType"][value="IN"]').change();

        $('.international-radio-btn').change(function() {
            if ($(this).is(':checked')) {
                $('.cou-select').show();
                $('.cou-suggestion').show();
            } else {
                $('.cou-select').hide();
                $('.cou-suggestion').hide();
            }
        });

        $('input[name="country_extra_1"]').on('input', function() {
            var inputValue = $(this).val().trim().toLowerCase();
            var count = 0;
            $('.cou-option').each(function() {
                var optionText = $(this).text().trim().toLowerCase();
                if (optionText.includes(inputValue) && count < 5) {
                    $(this).show();
                    count++;
                } else {
                    $(this).hide();
                }
            });
        });

        $('.cou-option').on('click', function() {
            var countryName = $(this).data('value');
            // console.log("Selected country:", countryName); // Log the countryName to the console
            var countryCode = $(this).data('code'); // Get the country code
            $('input[name="country_extra_1"], input[name="country_extra_2"]').val(countryName);
            $('input[name="CountryCode"], input[name="CountryType"]').val( countryCode); // Set the country code in the hidden input
            $('.cou-suggestion').hide();
        });
    });


    // if ($(".vu-select")[3]) {
    //     const fetchOptions = (value, callback) => {
    //         // Get the selected country value
    //         const country = $("input[name='CountryType']:checked").val();
    //         let countryCode = '';

    //         // Check if the selected country is India
    //         if (country === 'IN') {
    //             // If India is selected, set countryCode to 'IN'
    //             countryCode = 'IN';
    //         } else {
    //             // If International is selected, set countryCode to the value of the hidden input
    //             countryCode = $("input[name='CountryCode']").val();
    //         }

    //         // Append the countryCode to the URL
    //         const url =
    //             `{{ url('api/cities/') }}?city=${value}&country=${countryCode}`;

    //         ajax({
    //             url: url,
    //             success: (res) => callback(JSON.parse(res)),
    //         });
    //     };
    //     const optionGenerator = (port) =>
    //         `<div class="vu-option" data-value="${port.destination}" data-city_id="${port.city_id}">${port.destination}</div>`;

    //     const fromSelecthotel = new vu_select($(".vu-select")[3], {
    //         optionGenerator,
    //         fetchOptions
    //     });
    // }

    $(document).ready(function() {

        // Define today's date
        let today = new Date();
        // Get tomorrow's date
        let tomorrow = new Date(today);
        tomorrow.setDate(tomorrow.getDate() + 1);

        // Format dates as yyyy-mm-dd
        let todayFormatted = formatDate(today);
        let tomorrowFormatted = formatDate(tomorrow);

        // Set min attribute for check-in and check-out inputs
        $("#dep_date_1").attr("min", todayFormatted);
        $("#ret_date_1").attr("min", tomorrowFormatted);

        // Listen for changes in the check-out date input
        $("#ret_date_1").change(function() {
            let checkInDate = new Date($("#dep_date_1").val());
            let checkOutDate = new Date($(this).val());

            if (checkOutDate <= checkInDate) {
                // If check-out date is before or same as check-in date, set check-out date to next day after check-in
                checkOutDate.setDate(checkInDate.getDate() + 1);
                let checkOutFormatted = formatDate(checkOutDate);
                $(this).val(checkOutFormatted);
            }

            // Update the day of the week for the check-out date
            let dayOfWeek = getDayOfWeek(checkOutDate.getDay());
            $("#ret_day").text(`${dayOfWeek}`);

            // Update the minimum check-in date to be the selected check-out date
            $("#dep_date_1").attr("max", $(this).val());
            // Calculate the number of days between check-in and check-out dates
            calculateDaysDifference();
        });

        // Listen for changes in the check-in date input
        $("#dep_date_1").change(function() {
            let checkOutDate = new Date($("#ret_date_1").val());
            let checkInDate = new Date($(this).val());
            let dayOfWeek = getDayOfWeek(checkInDate.getDay());
            $("#dep_day").text(`${dayOfWeek}`);

            if (checkInDate >= checkOutDate) {
                // If check-in date is after or same as check-out date, set check-in date to previous day before check-out
                checkInDate.setDate(checkOutDate.getDate() - 1);
                let checkInFormatted = formatDate(checkInDate);
                $(this).val(checkInFormatted);
            }
            // Update the maximum check-out date to be the selected check-in date
            $("#ret_date_1").attr("min", $(this).val());
            // Calculate the number of days between check-in and check-out dates
            calculateDaysDifference();
        });

        // Format date as yyyy-mm-dd
        function formatDate(date) {
            let month = date.getMonth() + 1;
            let day = date.getDate();
            return `${date.getFullYear()}-${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        }

        function getDayOfWeek(dayIndex) {
            const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            return days[dayIndex];
        }

        // Calculate the number of days between check-in and check-out dates
        function calculateDaysDifference() {
            let checkInDate = new Date($("#dep_date_1").val());
            let checkOutDate = new Date($("#ret_date_1").val());
            let differenceInTime = checkOutDate.getTime() - checkInDate.getTime();
            let differenceInDays = differenceInTime / (1000 * 3600 * 24);

            // Display the number of nights between check-in and check-out dates
            let nightsSpan = $("#nights_between");
            if (differenceInDays > 0) {
                nightsSpan.text(differenceInDays + " night(s)");
                // Set the value of the hidden input field to differenceInDays
                $("input[name='nights']").val(differenceInDays);
            } else {
                nightsSpan.text("");
                // Reset the value of the hidden input field if differenceInDays is not positive
                $("input[name='nights']").val("");
            }
        }
    });





    $(".counter_1").each(function() {
        let val = $(this).find("input").eq(0);
        let maxVal = 0;
        let minVal = 0;
        // Set max and min values based on the input name
        if (val.attr('name') === 'room') {
            maxVal = 6;
            minVal = 1;
        } else if (val.attr('name') === 'adult') {
            maxVal = 48;
            minVal = 1;
        } else if (val.attr('name') === 'child') {
            maxVal = 12;
            minVal = 0;
        }

        $(this).find(".fa-plus").on('click', function() {
            let x = Number(val.val()) + 1;
            val.val(x > maxVal ? maxVal : x);
            updateCount_1();
        });
        $(this).find(".fa-minus").on('click', function() {
            let x = Number(val.val()) - 1;
            val.val(x < minVal ? minVal : x);
            updateCount_1();
        });
    });


    document.querySelector(".pax_1").addEventListener('click', function() {
        function hide_pax(event) {
            if (!document.querySelector(".pax_1").contains(event.target)) {
                document.querySelector(".pax_1").classList.remove('active');
                updateCount_1();
                document.removeEventListener('click', hide_pax);
            }
        }
        if (!this.classList.contains('active')) {
            this.classList.add('active');
            document.addEventListener('click', hide_pax);
        }
    });

    function updateCount_1() {
        var roomInput = document.getElementById('room_no');
        var adultInput = document.getElementById('adult_pax_1');
        var childInput = document.getElementById('child_pax_1');

        var totalRooms = parseInt(roomInput.value);
        var totalAdults = parseInt(adultInput.value);
        var totalChildren = parseInt(childInput.value);

        // Calculate total passengers based on the selected number of rooms
        var totalPassengers = totalAdults + totalChildren;

        // Set limits based on the maximum occupancy per room
        var maxAdultsPerRoom = 8;
        var maxChildrenPerRoom = 2;
        var maxPassengersPerRoom = maxAdultsPerRoom + maxChildrenPerRoom;
        var maxPassengers = totalRooms * maxPassengersPerRoom;
        var maxAdults = 8 * totalRooms;
        var maxChildren = 2 * totalRooms;

        // Condition: Every room must have at least one adult
        if (totalAdults < totalRooms) {
            alert(`Each room must have at least one adult. Please increase the number of adults.`);
            adultInput.value = totalRooms;
            totalAdults = totalRooms;
        }

        if (totalAdults > maxAdults || totalChildren > maxChildren) {
            alert(
                `Total number of passengers cannot exceed ${maxAdults} adults and ${maxChildren} children based on the selected number of rooms.`);
            // Reset values
            roomInput.value = 1;
            adultInput.value = 1;
            childInput.value = 0;
            totalPassengers = 1;
        }
        if (totalPassengers > maxPassengers) {
            alert(`Total number of passengers cannot exceed the maximum capacity of ${maxPassengers}.`);
            // Reset values
            roomInput.value = 1;
            adultInput.value = 1;
            childInput.value = 0;
            totalPassengers = 1;
        }

        document.getElementById("fclass_1").innerText = document.querySelector(
            'input[name="travelclass"]:checked ~ label').innerText;
        let pass = '';
        pass += `<span class="paxx">${totalRooms} <i>${(totalRooms > 1 ? "Rooms" : "Room")}</i></span>`;
        pass += `<span class="paxx">${totalAdults} <i>${(totalAdults > 1 ? "Adults" : "Adult")}</i></span>`;
        if (totalChildren > 0)
            pass +=
            `, <span class="paxx">${totalChildren} <i>${(totalChildren > 1 ? "Children" : "Child")}</i></span>`;

        document.getElementById("pass_det_1").innerHTML = pass;

        // Show child age inputs if children are selected
        var childAgeInputs = document.getElementById("child_age_inputs");
        childAgeInputs.innerHTML = ''; // Clear existing inputs

        if (totalChildren > 0) {
            for (var i = 1; i <= totalChildren; i++) {
                var childAgeInput = document.createElement('div');
                var selectOptions = '';
                for (var j = 1; j <= 12; j++) {
                    selectOptions += `<option value="${j}">${j}</option>`;
                }
                childAgeInput.innerHTML = `
                        <div class="child-age-input">
                            <label for="child${i}_age">Child ${i} Age</label>
                            <select id="child${i}_age"  onchange="updateChildAgesArray()" >
                                <option value="Select">Select</option>
                                ${selectOptions}
                            </select>

                        </div>
                    `;
                childAgeInputs.appendChild(childAgeInput);
            }
            childAgeInputs.style.display = "block";
        } else {
            childAgeInputs.style.display = "none";
        }
    }



    function updateChildAgesArray() {
        var totalChildren = parseInt(document.getElementById('child_pax_1').value);
        var childAges = [];
        for (var i = 1; i <= totalChildren; i++) {
            var selectElement = document.getElementById(`child${i}_age`);
            if (selectElement && selectElement.value !== "Select") {
                childAges.push(selectElement.value);
            }
        }
        document.getElementById('child_ages').value = childAges.join(',');
    }

    function validateForm() {


        var totalChildren = parseInt(document.getElementById('child_pax_1').value);
        var childAges = document.getElementById('child_ages').value;

        if (totalChildren > 0) {
            var agesArray = childAges.split(',');
            if (agesArray.length < totalChildren || agesArray.includes("") || agesArray.includes("Select")) {
                alert("Please select ages for all children.");
                return false;
            }
        }
        return true;
    }



/*    let stars = document.getElementsByClassName("star");
    let output = document.getElementById("output");
    let ratingsInput = document.getElementById("ratings");

    // Funtion to update rating
    function gfg(n) {
        remove();
        for (let i = 0; i < n; i++) {
            if (n == 1) cls = "one";
            else if (n == 2) cls = "two";
            else if (n == 3) cls = "three";
            else if (n == 4) cls = "four";
            else if (n == 5) cls = "five";
            stars[i].className = "star " + cls;
        }
        output.innerText = "Rating : " + n + "/5";
        ratingsInput.value = n; // Update the hidden input field value
    }

    // To remove the pre-applied styling
    function remove() {
        let i = 0;
        while (i < 5) {
            stars[i].className = "star";
            i++;
        }
    }
*/
    var cinput = document.getElementById('cityInput');
    cinput.addEventListener('click', function () {
        const cityInput = document.getElementById('cityInput');
        const whereinput = document.getElementById('whereinput');
        const countryTypeInputs = document.querySelectorAll('input[name="CountryType"]');
        // let countryType = document.querySelector('input[name="CountryCode"]').value;
        let countryType = document.querySelector('input[name="CountryType"]:checked').value;
        const suggestionBox = document.getElementById('cit-suggestion');
        const hotelCityInput = document.getElementById('hotelCityInput');
        const locationCityInput = document.getElementById('locationCityInput');

        const hotelCities = @json($hotelCities);

        countryTypeInputs.forEach(input => {
            input.addEventListener('change', function () {
                countryType = document.querySelector('input[name="CountryType"]:checked').value;
                // console.log('CountryType changed to:', countryType);
            });
        });

        cityInput.addEventListener('input', function () {
            const query = cityInput.value;
            if (query.length > 2) {
                // console.log('Fetching suggestions for query:', query);
                fetchSuggestions(query, countryType);
            }
        });



        

    function fetchSuggestions(query, countryType) {
        const apiKey = '42ecab6d4ad64005a56cfd68f0258f7e';
        if (countryType === 'IN') {
            // Fetch hotel cities and locations from OpenCage API
            const filteredHotelCities = hotelCities.filter(hotel => hotel.name.toLowerCase().includes(query.toLowerCase()));
            // console.log('Filtered hotel cities:', filteredHotelCities);

            fetch(`https://api.opencagedata.com/geocode/v1/json?q=${encodeURIComponent(query)}&key=${apiKey}&countrycode=IN&limit=5`)
            .then(response => response.json())
            .then(data => {
                // console.log('Fetched location data:', data);
                const locations = data.results
                    .map(item => {
                        const components = item.components;
                        const city = components.city || components._normalized_city || components.state_district || 'Unknown city';
                        return {
                            name: city !== 'Unknown city' ? item.formatted : null,
                            type: item.components._type || 'location',
                            city: city,
                            lat: item.geometry.lat,   // Extract latitude
                            lng: item.geometry.lng    // Extract longitude
                        };
                    })
                    .filter(location => location.city !== 'Unknown city');
                const combinedResults = combineResults(filteredHotelCities, locations);
                // console.log('Combined results:', combinedResults);
                updateSuggestions(combinedResults);
            })
            .catch(error => console.error('Error fetching locations:', error));
        } else {
            // Fetch locations from OpenCage API for other countries
            fetch(`https://api.opencagedata.com/geocode/v1/json?q=${encodeURIComponent(query)}&key=${apiKey}&countrycode=${countryType}&limit=8`)
            .then(response => response.json())
            .then(data => {
                // console.log('Fetched location data:', data);
                const locations = data.results
                    .map(item => {
                        const components = item.components;
                        const city = components.city || components._normalized_city || components.state_district || 'Unknown city';
                        return {
                            name: city !== 'Unknown city' ? item.formatted : null,
                            type: item.components._type || 'location',
                            city: city,
                            lat: item.geometry.lat,   // Extract latitude
                            lng: item.geometry.lng    // Extract longitude
                        };
                    })
                    .filter(location => location.city !== 'Unknown city');
                updateSuggestions(locations.slice(0, 8));
            })
            .catch(error => console.error('Error fetching locations:', error));
        }
    }

        function combineResults(hotelCities, locations) {
            let combined = [];
            const hotelResults = hotelCities.map(hotel => ({
                name: hotel.name,
                type: 'Hotel',
                city: hotel.city
            }));

            const maxResults = 8;
            const maxPerType = 4;

            let hotelsToShow = hotelResults.slice(0, maxPerType);
            let locationsToShow = locations.slice(0, maxPerType);

            if (hotelsToShow.length < maxPerType) {
                locationsToShow = locations.slice(0, maxResults - hotelsToShow.length);
            } else if (locationsToShow.length < maxPerType) {
                hotelsToShow = hotelResults.slice(0, maxResults - locationsToShow.length);
            }

            combined = [...hotelsToShow, ...locationsToShow];
            return combined;
        }

        function updateSuggestions(suggestions) {
            // console.log('Updating suggestions:', suggestions);
            suggestionBox.innerHTML = '';
            if (suggestions.length === 0) {
                const noResults = document.createElement('div');
                noResults.textContent = 'No results found';
                suggestionBox.appendChild(noResults);
                return;
            }
            suggestions.forEach(suggestion => {
                const suggestionItem = document.createElement('div');
                suggestionItem.classList.add('suggestion-item');
                
                const icon = document.createElement('i');
                if (suggestion.type === 'Hotel') {
                    icon.classList.add('fas', 'fa-building');
                    icon.style.color = 'var(--fv_sec)';
                } else {
                    icon.classList.add('fas', 'fa-map-marker-alt');
                    icon.style.color = 'var(--fv_prime)';
                }

                const textWrapper = document.createElement('div');
                const name = document.createElement('div');
                name.textContent = suggestion.name;
                const typeClass = document.createElement('div');
                typeClass.textContent = suggestion.city;
                typeClass.style.fontSize = 'small';

                textWrapper.appendChild(name);
                textWrapper.appendChild(typeClass);
                suggestionItem.appendChild(icon);
                suggestionItem.appendChild(textWrapper);

                suggestionItem.addEventListener('click', function () {
                    // console.log('Suggestion clicked:', suggestion);
                    cityInput.value = suggestion.name;
                    whereinput.value = suggestion.name;
                    document.getElementById('cityname').textContent = suggestion.city; 

                    if (suggestion.type === 'Hotel') {
                        // console.log('Setting hotelCityInput for hotel:', suggestion.city);
                        hotelCityInput.value = suggestion.city;
                        locationCityInput.value = '';
                    } else {
                        // console.log('Setting locationCityInput for location city:', suggestion.city);
                        locationCityInput.value = suggestion.city;
                        hotelCityInput.value = '';
                         // Save latitude and longitude to hidden inputs
                        document.querySelector('input[name="latitude"]').value = suggestion.lat;
                        document.querySelector('input[name="longitude"]').value = suggestion.lng;
                    }
                    suggestionBox.innerHTML = '';
                    suggestionBox.classList.remove('active');
                });

                

                suggestionBox.appendChild(suggestionItem);
            });
            suggestionBox.classList.add('active');
        }
    });
    
    // Clear the city name when the input is empty or whitespace
    cityInput.addEventListener('input', function () {
        // console.log(cityInput.value);
        if (cityInput.value === "") {
            cityname.textContent = '' ;
        }
    });

    

    
</script>

@endpush