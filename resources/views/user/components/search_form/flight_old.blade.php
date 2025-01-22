<style>
    .suggestion_box {
        position: relative;
    }

    .suggestion_box .suggestions {
        position: absolute;
        inset-inline: 0;
        background: red;
        top: 100%;
        padding: 10px;
        background: white;
        box-shadow: 0 0 10px 0 #00000022;
        border-radius: 8px;
        font-size: 1.1rem;
        z-index: 2;
    }

    .suggestion_box .suggestions:not(.active) {
        display: none;
    }

    .suggestion_box .suggestions .icon {
        font-size: 1.8rem;
        margin-inline: 3px 10px;
        color: var(--fv_prime);
    }

    .suggestion_box .suggestions .suggestion {
        border-bottom: 1px dashed #a8a8a8;
        padding-block: 3px;
        cursor: pointer;
    }

    .suggestion_box .suggestions .suggestion:hover {
        background: #efefef;
    }

    .suggestion_box .suggestions .suggestion:first-of-type {
        padding-top: 0;
    }

    .suggestion_box .suggestions .suggestion:last-of-type {
        padding-bottom: 0;
        border-bottom: none;
    }

    .suggestion_box .suggestions .airport {
        color: #cf7229;
        font-size: 1.5rem;
    }

    .suggestion_box .suggestions .airport_name {
        color: #ababab;
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0;
    }

    .passengers {
        margin-block: 10px;
        gap: 10px;
    }

    .passenger {
        align-items: center;
    }

    .passenger .counter {
        background: #efefef;
        font-size: 1.2rem;
        border-radius: 5px;
    }

    .passenger .counter {
        display: flex;
    }

    .passenger i {
        --dim: 32px;
        height: var(--dim);
        width: var(--dim);
        display: inline-flex;
        justify-content: center;
        align-items: center;
    }

    .passenger p {
        font-size: 1.3rem;
        margin-bottom: 5px;
        font-weight: 600;
    }

    .passenger input {
        border: none;
        background: none;
        text-align: center;
        font-size: 1.6rem;
        outline: none;
        height: 100%;
    }
</style>
<form action="{{ url('flight') }}" method="post" id="flight_form" class="active">
    @csrf
    <div class="trip_options rflex">
        <div class="trip_option aic rflex">
            <select name="journey_type" id="journey_type">
                <option value="1">One Way</option>
                <option value="2">Round Trip</option>
            </select>
        </div>
        <div class="trip_option aic rflex">
            <select name="">
                <option value="">Regular</option>
                <option value="">Armed Forces</option>
                <option value="">Senior Citizen</option>
                <option value="">Student</option>
                <option value="">Doctors & Nurses</option>
            </select>
        </div>
        <div class="trip_option aic rflex">
            <select name="travelclass">
                <option value="1">Any</option>
                <option value="2">Economy</option>
                <option value="3">Premium Economy</option>
                <option value="4">Business</option>
                <option value="5">Premium Business</option>
                <option value="6">First Class</option>
            </select>
        </div>
    </div>
    <div class="form_fields rflex">
        <div class="field location">
            <div class="wrapper cflex">
                <div class="suggestion_box">
                    <input type="hidden" name="from" class="location">
                    <input class="field_main" type="text" placeholder=" " onkeyup="show_suggestions(this)">
                    <p class="field_title">From</p>
                    <div class="suggestions"></div>
                </div>
                <p class="airport_name">Select Deport Airport</p>
            </div>
        </div>
        <div class="field location">
            <div class="wrapper cflex">
                <div class="suggestion_box">
                    <input type="hidden" name="to" class="location">
                    <input class="field_main" type="text" placeholder=" " onkeyup="show_suggestions(this)">
                    <p class="field_title">To</p>
                    <div class="suggestions"></div>
                </div>
                <p class="airport_name">Select Deport Airport</p>
            </div>
        </div>
        <div class="field_group dates">
            <div class="wrapper rflex">
                <div class="field cflex">
                    <input class="field_main active" type="date" name="dep_date" id="dep_date">
                    <p class="field_title">Departure Date</p>
                </div>
                <div class="field cflex">
                    <input class="field_main active" type="date" name="ret_date" id="ret_date">
                    <p class="field_title">Return Date</p>
                </div>
            </div>
        </div>
    </div>
    <div class="passengers rflex jce">
        <div class="passenger cflex">
            <p>Adults (above 12 years)</p>
            <div class="counter">
                <i class="fa-solid fa-minus dec"></i>
                <input value="0" class="val" type="number" name="adult" id="" min="1"
                    max="9">
                <i class="fa-solid fa-plus inc"></i>
            </div>
            <div class="visual rflex"></div>
        </div>
        <div class="passenger cflex">
            <p>Children (2-12 years)</p>
            <div class="counter">
                <i class="fa-solid fa-minus dec"></i>
                <input value="0" class="val" type="number" name="child" id="" min="0"
                    max="8">
                <i class="fa-solid fa-plus inc"></i>
            </div>
            <div class="visual rflex"></div>
        </div>
        <div class="passenger cflex">
            <p>Infants (0-2 years)</p>
            <div class="counter">
                <i class="fa-solid fa-minus dec"></i>
                <input value="0" class="val" type="number" name="infant" id="" min="0"
                    max="9">
                <i class="fa-solid fa-plus inc"></i>
            </div>
            <div class="visual rflex"></div>
        </div>
    </div>
    <button type="submit" class="form_btn">
        Search Flights
        <i class="fa-regular fa-arrow-right"></i>
    </button>
</form>
@push('js')
    <script>
        let current_request = null;
        let suggestion = (airport) =>
            `<div class="suggestion rflex aic" data-airport="${airport.airport_code}" data-airportname="${airport.airport_name+", "+airport.country}" data-city="${airport.city_name }" onclick="set_selection(this)"><i class="icon fa-solid fa-plane"></i><div class="cflex"><h5 class="airport">${airport.city_name+", "+airport.country}</h5><p class="airport_name">${airport.airport_name}</p></div></div>`;

        function show_suggestions(node) {
            let parent = node.parentElement;
            parent.$('.location')[0].value = '';
            let suggestions = parent.$(".suggestions")[0];
            if (!node.value) {
                current_request.abort();
                suggestions.removeClass("active");
                return;
            }
            fetch_flights(node.value, (airports) => {
                suggestions.innerHTML = '';
                if (airports.length == 0) {
                    suggestions.removeClass("active");
                    return;
                }
                airports.forEach(airport => {
                    suggestions.append(suggestion(airport));
                });
                suggestions.addClass("active");
            });
        }

        function fetch_flights(query, callback) {
            if (current_request) current_request.abort();
            current_request = ajax({
                url: "{{ url('api/airports') }}/" + query,
                success: (res) => callback(JSON.parse(res))
            });
        }

        function set_selection(node) {
            let parent = node.closest('.suggestions');
            let box = parent.closest('.suggestion_box');
            box.$('.location')[0].value = node.get('data-airport');
            box.$('.field_main')[0].value = node.get('data-city');
            box.nextElementSibling.innerText = node.get('data-airportname');
            hide_suggestions();
        }

        function hide_suggestions() {
            $(".suggestions").perform(n => n.removeClass('active'));
        }
        document.addEventListener('click', function() {
            hide_suggestions();
        })
        $(".counter").perform((n) => {
            let val = n.$(".val")[0];
            n.$(".inc")[0].addEventListener("click", () => val.value = Number(val.value) + 1);
            n.$(".dec")[0].addEventListener("click", () => val.value = Number(val.value) - 1);
        })
        today = new Date;
        $("#dep_date").set("min", `${today.getFullYear()}-${today.getMonth()+1}-${today.getDate()}`);
        $("#ret_date").set("min", `${today.getFullYear()}-${today.getMonth()+1}-${today.getDate()}`);
        $("#dep_date").addEventListener('change', function() {
            let min = this.value;
            $("#ret_date").set("min", min);
        });
        $("#ret_date").addEventListener('change', function() {
            $("#journey_type").value = 2;
            $("#dep_date").set('max', this.value);
        });
        // today.toISOString().substring(0,10)
    </script>
@endpush
