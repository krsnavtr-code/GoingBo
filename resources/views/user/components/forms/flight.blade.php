<style>
    .dayContainer {
        gap: 1rem;
    }

    /* .flatpickr-day {
        padding: 1rem;
    } */

    .event {
        position: absolute;
        bottom: -1rem;
        left: 0;
        right: 0;
        color: green;
        line-height: 1rem;
        font-size: smaller;
    }
</style>
<form action="{{ url('flight/search') }}" method="get" class="flight_form" id="flight_form">
    <div class="trip_types jcsb">
        <div class="rflex trip_type_wrap">
            <div class="trip_type mb-5">
                <input type="radio" name="journey_type" id="x1" checked value="1">
                <label for="x1">One Way</label>
            </div>
            <div class="trip_type">
                <input type="radio" name="journey_type" id="x2" value="2">
                <label for="x2">Round Trip</label>
            </div>
        </div>

        <div class="offer-box">
            <ul class="offer-window">
                <li>Join the club of happy travellers.</li>
                <li>Get 12% OFF on flights as a welcome gift.</li>
                <li>24x7 Customer Support.</li>
                <li>Hassle Free Bookings.</li>
            </ul>
        </div>
    </div>

    <div class="fields rflex">
        <div class="col-6 destiantions">
            <div class="wrapper location">
                <div class="col-6">
    <div class="vu-select from-select">
        <div class="vu-content">
            <label for="fromInput" class="floating-label">From</label>
            <input type="text" id="fromInput" placeholder='Enter City Name' class="vu-input" autocomplete="off" required>
            <input type="hidden" class="airport_code" name="from">
            <p><span class="airport_code a_code"> </span><span class="airport_name"> </span></p>
        </div>
        <div class="vu-suggestion"></div>
    </div>
</div>
<span class="tw-icon" id="interchangeBtn"> <i class="fa-solid fa-right-left "></i> </span>
<div class="col-6">
    <div class="vu-select to-select">
        <div class="vu-content">
            <label for="">To</label>
            <input type="text" name="" id="toInput" placeholder='Enter City Name' class="vu-input" autocomplete="off" required>
            <input type="hidden" class="airport_code" name="to">
            <p><span class="airport_code a_code"> </span><span class="airport_name"> </span></p>
        </div>
        <div class="vu-suggestion vu-suggestion-to"></div>
    </div>
</div>
            </div>
        </div>

        <!-- Date Selection -->
        <div class="col-6 dates-wrap">
            <div class="wrapper dates gap-5">
                <div class="col-6">
                    <div class="vu-date">
                        <div class="vu-content">
                            <label for="dep_date">Departure</label>
                            <input readonly name="dep_date" id="dep_date" placeholder="MM/DD/YYYY" required >
                            {{-- <p>Select Date</p> --}}
                        </div>
                    </div>
                </div>
                <!-- <span class="tw-icon" id="interchangeBtn"> <i class="fa-solid fa-right-left "></i> </span> -->
                <div class="col-6 ml-1">
                    <div class="vu-date">
                        <div class="vu-content">
                            <label for="">Return</label>
                            <input readonly name="ret_date" id="ret_date" placeholder="MM/DD/YYYY">
                            {{-- <p>Select Date</p> --}}
                        </div>
                    </div>
                </div>
                <div class="vu-suggestion"></div>
            </div>
        </div>
    </div>
    
    <!-- Travellers and Class -->
    <div class="paxs mt-5 paxs-alignment">
        <div class="wrapper pax travellers-class-width " tabindex="0">
            <div class="vu-content bg-white pax-bg-color">
                <label for="">Travellers & Class</label>
                <div class="desc" id="pass_det">1 Adult</div>
                <p id="fclass">Any Class</p>
            </div>
            <div class="vu-suggest col-3">
                <div class="counters rflex">
                    <div class="count-wrap">
                        <h6>Adults</h6>
                        <p>(above 12 years)</p>
                        <div class="counter">
                            <i class="fa-solid fa-minus"></i>
                            <input type="number" name="adult" id="adult_pax" value="1">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                    </div>
                    <div class="count-wrap">
                        <h6>Children</h6>
                        <p>(2-12 years)</p>
                        <div class="counter">
                            <i class="fa-solid fa-minus"></i>
                            <input type="number" name="child" id="child_pax" value="0">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                    </div>
                    <div class="count-wrap">
                        <h6>Infants</h6>
                        <p>(0-2 years)</p>
                        <div class="counter">
                            <i class="fa-solid fa-minus"></i>
                            <input type="number" name="infant" id="infant_pax" value="0">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                    </div>
                </div>
                <div class="flight_classes rflex wrap">
                    <div class="flight_class col-6">
                        <input type="radio" name="travelclass" value="1" id="po0" checked>
                        <label for="po0">All</label>
                    </div>
                    <div class="flight_class col-6">
                        <input type="radio" name="travelclass" value="2" id="po1">
                        <label for="po1">Economy</label>
                    </div>
                    <div class="flight_class col-6">
                        <input type="radio" name="travelclass" value="3" id="po2">
                        <label for="po2">Premium Economy</label>
                    </div>
                    <div class="flight_class col-6">
                        <input type="radio" name="travelclass" value="4" id="po3">
                        <label for="po3">Business</label>
                    </div>
                    <div class="flight_class col-6">
                        <input type="radio" name="travelclass" value="5" id="po4">
                        <label for="po4">Premium Business</label>
                    </div>
                    <div class="flight_class col-6">
                        <input type="radio" name="travelclass" value="6" id="po5">
                        <label for="po5">First Class</label>
                    </div>
                </div>
            </div>
        </div>
        <!-- Spacial Fares -->
        <div class="fare_type_box col-9 pax-bg-color">
            <div class="cflex" style="gap:20px">
                <div class="rflex aic">
                    <p><b> Special Fares </b> </p>
                    <div class="fare_types rflex">
                        <div class="fare_type fare_type_left">
                            <div class="ft_ra">
                                <input type="radio" name="fare_type" id="f2" value="1">
                                <img loading="lazy" src="{{ url('images/flight/soldier.png') }}" width="25"
                                    height="25"alt="flightimage">
                                <label for="f2">Armed Forces</label>
                            </div>
                        </div>
                        <div class="fare_type fare_type_left">
                            <div class="ft_ra">
                                <input type="radio" name="fare_type" id="f3" value="2">
                                <img loading="lazy" src="{{ url('images/flight/senior.png') }}" width="25"
                                    height="25"alt="flightimage">
                                <label for="f3">Senior Citizen</label>
                            </div>
                        </div>
                        <div class="fare_type fare_type_right">
                            <div class="ft_ra">
                                <input type="radio" name="fare_type" id="f4" value="3">
                                <img loading="lazy" src="{{ url('images/flight/student.png') }}" width="25"
                                    height="25"alt="flightimage">
                                <label for="f4">Student</label>
                            </div>
                        </div>
                        <div class="fare_type fare_type_right">
                            <div class="ft_ra">
                                <input type="radio" name="fare_type" id="f5" value="4">
                                <img loading="lazy" src="{{ url('images/flight/doctor.png') }}" width="25"
                                    height="25"alt="flightimage">
                                <label for="f5">Doctors & Nurses</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn search_btn" id="btn" ><i class="fa-solid fa-magnifying-glass"></i>Search Flights</button>
</form>

@push('js')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_orange.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


    <script>
 // Function to update placeholder text based on screen width
    function updatePlaceholders() {
        const fromInput = document.getElementById("fromInput");
        const toInput = document.getElementById("toInput");

        if (window.innerWidth <= 1024) {
            fromInput.placeholder = "Enter City";
            toInput.placeholder = "Enter City";
        } else {
            fromInput.placeholder = "Enter City Name";
            toInput.placeholder = "Enter City Name";
        }
    }
    // Run the function on page load
    updatePlaceholders();
    // Add a resize event listener to update on window resize
    window.addEventListener("resize", updatePlaceholders);

        // Function to fetch flight data from the API
        async function fetchFlightData(from, to) {
            const params = new URLSearchParams({ from: from, to: to });

    try {
        let response = await fetch(`/flight/fare?${params.toString()}`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                
            }
        });

                if (response.ok) {
                    let result = await response.json();
                    let searchResults = result.Response.SearchResults;

                    return searchResults;
                } else {
                    console.error('Error fetching flight data:', response.statusText);
                    return [];
                }
            } catch (error) {
                console.error('Error:', error);
                return [];
            }
        }

        // Function to initialize the Flatpickr calendar with fetched data
        async function initCalendar() {
            
            // Get values from hidden inputs
            var from = document.querySelector('input[name="from"]').value;
            var to = document.querySelector('input[name="to"]').value;

            if(from !== "" && from !== null && to !== "" && to !== null){
                if(from.length >= 3 && to.length >= 3){
           

            // Fetch flight data
            var flightData = await fetchFlightData(from, to);
            var priceMap = {};

            if (flightData && Array.isArray(flightData)) {
                // Convert flight data to price map
                flightData.forEach(function(flight) {
                    var departureDate = new Date(flight.DepartureDate).toISOString().split('T')[0];
                    priceMap[departureDate] = flight.Fare;
                });

            } else {
                console.error('Invalid flight data:', flightData);
            }

            // Function to set price on the calendar
            function setPrice(dObj, dStr, fp, dayElem) {
                var dateKey = dayElem.dateObj.toISOString().split('T')[0];
                if (priceMap[dateKey]) {
                    dayElem.innerHTML += `<span class='event'>${Math.round(priceMap[dateKey])}</span>`;
                }
            }

            // // Flatpickr configuration
            // var config = {
            //     minDate: "today",
            //     enableTime: false,
            //     dateFormat: "Y-m-d",
            //     altInput: true,
            //     altFormat: "F j, Y",
            //     disableMobile: true,
            //     theme: "material_orange",
            //     onDayCreate: setPrice,
            // };

            // // Initialize Flatpickr on the input element
            // var depdate = document.querySelector("#dep_date");
            // flatpickr(depdate, config);

            // Weekday array
            const weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

            // Function to update the displayed weekday
            function updateWeekday(input, dateStr) {
                let date = new Date(dateStr);
                input.nextElementSibling.innerText = weekday[date.getDay()];
            }

            // Flatpickr configuration for departure date
            var depdateConfig = {
                minDate: "today",
                enableTime: false,
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "F j, Y",
                disableMobile: true,
                theme: "material_orange",
                onDayCreate: setPrice,
                onChange: function(selectedDates, dateStr, instance) {
                    updateWeekday(instance.input, dateStr);
                    retdate.set("minDate", dateStr);
                }
            };

            // Initialize Flatpickr on the departure date input element
            var depdate = flatpickr("#dep_date", depdateConfig);

            // Flatpickr configuration for return date
            var retdateConfig = {
                enableTime: false,
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "F j, Y",
                disableMobile: true,
                theme: "material_orange",
                onDayCreate: setPrice,
                onChange: function(selectedDates, dateStr, instance) {
                    updateWeekday(instance.input, dateStr);
                    depdate.set("maxDate", dateStr);
                    document.getElementById("x2").checked = true;
                }
            };

            // Initialize Flatpickr on the return date input element
            var retdate = flatpickr("#ret_date", retdateConfig);


            
            }
            }
        }

        // Function to handle input change
        async function handleInputChange() {
            await initCalendar();
        }

        var vusel = document.getElementsByClassName('vu-select');

        // Initialize the calendar when the document is ready
        Array.from(vusel).slice(0, 2).forEach(element => {
            element.addEventListener('click', () => {
                // Initial calendar setup
                initCalendar();
                // Add event listeners to inputs
                const fromInputacode = document.querySelector('input[name="from"]');
                const toInputacode = document.querySelector('input[name="to"]');

                fromInputacode.addEventListener('keyup', handleInputChange);
                toInputacode.addEventListener('keyup', handleInputChange);
            });
        });



        var btn = document.getElementById('btn');
        btn.addEventListener('click', function (event) {

            let x = document.getElementById('fromInput').value;
            let y = document.getElementById('toInput').value;
            let z = document.getElementById('dep_date').value;


            if (x === "" || x === null) {
                event.preventDefault();
                alert('Please enter a value for "From City ".');
                return;
            }

            if (y === "" || y === null) {
                event.preventDefault();
                alert('Please enter a value for "To City ".');
                return;
            }

            if (z === "" || z === null) {
                event.preventDefault();
                alert('Please enter a value for "Departure Date".');
                return;
            }
        });





        const fetchOptions = (value, callback) => {
            ajax({
                url: `{{ url('api/airports/') }}/${value}`,
                success: (res) => callback(JSON.parse(res)),
            });
        };

        const optionGenerator = (port) =>
            `<div class="vu-option" data-value="${port.airport_city}" data-airport_code="${port.airport_code}" data-airport_name="${port.airport_name}"><i class="fa-solid fa-plane"></i><div class="port"><h6>${port.airport_city}<span> (${port.airport_code})</span></h6><p>${port.airport_name}</p></div><p class="country">${port.airport_country_code} <img src="https://cdn.kcak11.com/CountryFlags/countries/${port.airport_country_code.toLowerCase()}.svg" style="margin-left: 2px; "> </p></div>`;

        const fromSelect = new vu_select($(".vu-select")[0], {
            optionGenerator,
            fetchOptions,
        });
        const toSelect = new vu_select($(".vu-select")[1], {
            optionGenerator,
            fetchOptions,
        });

        

        $(".counter").perform((n) => {
            let val = n.$("input")[0] ?? 0;
            n.$(".fa-plus")[0].addEventListener('click', () => {
                let x = Number(val.value) + 1;
                val.value = x > 9 ? 9 : x;
                updateCount();
            });
            n.$(".fa-minus")[0].addEventListener('click', () => {
                let x = Number(val.value) - 1;
                val.value = x < 0 ? 0 : x;
                updateCount();
            });
        })


       

        document.querySelector(".pax").addEventListener('click', function() {
            function hide_pax(event) {
                if (!document.querySelector(".pax").contains(event.target)) {
                    document.querySelector(".pax").classList.remove('active');
                    updateCount();
                    document.removeEventListener('click', hide_pax);
                }
            }
            if (!this.classList.contains('active')) {
                this.classList.add('active');
                document.addEventListener('click', hide_pax);
            }
        });

        function updateCount() {
            var adultInput = document.getElementById('adult_pax');
            var childInput = document.getElementById('child_pax');
            var infantInput = document.getElementById('infant_pax');

            var totalAdults = parseInt(adultInput.value);
            var totalChildren = parseInt(childInput.value);
            var totalInfants = parseInt(infantInput.value);
            var totalPassengers = totalAdults + totalChildren + totalInfants;

            if (totalPassengers > 9) {
                alert('Total number of passengers cannot exceed 9.');

                // Determine how many passengers need to be reduced
                var excess = totalPassengers - 9;

                // Reduce infants first
                if (totalInfants > 0) {
                    var reduceInfants = Math.min(excess, totalInfants);
                    infantInput.value -= reduceInfants;
                    excess -= reduceInfants;
                }

                // If there are still excess passengers, reduce children
                if (excess > 0 && totalChildren > 0) {
                    var reduceChildren = Math.min(excess, totalChildren);
                    childInput.value -= reduceChildren;
                    excess -= reduceChildren;
                }

                // If there are still excess passengers, reduce adults
                if (excess > 0 && totalAdults > 0) {
                    var reduceAdults = Math.min(excess, totalAdults);
                    adultInput.value -= reduceAdults;
                }
            }

            document.getElementById("fclass").innerText = document.querySelector(
                'input[name="travelclass"]:checked ~ label').innerText;
            let pass = '';
            pass += `<span class="paxx">${totalAdults} <i>${(totalAdults > 1 ? "Adults" : "Adult")}</i></span>`;
            if (totalChildren > 0)
                pass += `,<span class="paxx">${totalChildren} <i>${(totalChildren > 1 ? "Children" : "Child")}</i></span>`;
            if (totalInfants > 0)
                pass += `,<span class="paxx">${totalInfants} <i>${(totalInfants > 1 ? "Infants" : "Infant")}</i></span>`;
            document.getElementById("pass_det").innerHTML = pass;
        }

        const interchangeBtn = document.getElementById('interchangeBtn');
        const fromInput = document.getElementById('fromInput');
        const toInput = document.getElementById('toInput');
        const fromAirportCodeSpan = document.querySelector('.from-select .a_code');
        const fromAirportNameSpan = document.querySelector('.from-select .airport_name');
        const toAirportCodeSpan = document.querySelector('.to-select .a_code');
        const toAirportNameSpan = document.querySelector('.to-select .airport_name');
        const fromHiddenInput = document.querySelector('.from-select input[type="hidden"]');
        const toHiddenInput = document.querySelector('.to-select input[type="hidden"]');

        interchangeBtn.addEventListener('click', () => {
            // Swap input values
            const tempFromValue = fromInput.value;
            fromInput.value = toInput.value;
            toInput.value = tempFromValue;

            // Swap displayed airport details
            const tempFromAirportCode = fromAirportCodeSpan.textContent;
            fromAirportCodeSpan.textContent = toAirportCodeSpan.textContent;
            toAirportCodeSpan.textContent = tempFromAirportCode;

            const tempFromAirportName = fromAirportNameSpan.textContent;
            fromAirportNameSpan.textContent = toAirportNameSpan.textContent;
            toAirportNameSpan.textContent = tempFromAirportName;

            // Swap hidden input values
            const tempFromHiddenValue = fromHiddenInput.value;
            fromHiddenInput.value = toHiddenInput.value;
            toHiddenInput.value = tempFromHiddenValue;
        });
    </script>



    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <link href="//code.jquery.com/ui/1.9.2/themes/smoothness/jquery-ui.css" rel="stylesheet" />
    <script src="//code.jquery.com/ui/1.9.2/jquery-ui.min.js"></script>

    <script>
        $(document).ready(function() {
            // Bind the click event to both the radio input and its associated label
            $(".fare_types label").mousedown(function(e) {
                // Get the ID of the radio button
                var radioButtonId = $(this).attr('for');

                // Get the radio button element
                var radioButton = $('#' + radioButtonId);

                // Check if the radio button is already checked
                if (radioButton.prop("checked")) {
                    // If checked, uncheck it after a delay
                    setTimeout(function() {
                        radioButton.prop('checked', false);
                    }, 200);
                }
            });
        });


    </script>
@endpush
