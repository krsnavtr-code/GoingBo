@push('css')
    <style>
        .trip_options {
            margin-bottom: 10px;
        }

        .trip_option {
            padding: 2px 10px;
            border-radius: 100px;
            font-size: 1.4rem;
        }

        .trip_option input[type="radio"] {
            margin-right: 5px;
        }

        .trip_option:has(input[type="radio"]:checked) {
            background: var(--fv_prime);
            color: white;
            font-weight: 600;
        }

        .form_fields {
            gap: 15px;
            margin-top: 20px;
        }

        .vu-select {
            position: relative;
            z-index: 1;
            width: 260px;
            isolation: isolate;
        }

        .vu-options {
            position: absolute;
            top: 100%;
            width: 100%;
            transform: translateY(10px);
            padding: 7px;
            border-radius: 7px;
            background: white;
            box-shadow: 0 0 10px 0 #00000022;
            z-index: 1;
        }

        .vu-options:not(.active) {
            display: none;
        }

        .vu-option {
            cursor: pointer;
            display: flex;
            align-items: center;
            border-radius: 7px;
            padding: 5px 10px;
        }

        .vu-option:hover {
            background: rgba(var(--fv_prime_rgb), 0.2);
        }

        .vu-option .city_name h6 {
            width: 180px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .vu-option .city_name p {
            font-size: 1.3rem;
        }

        .vu-option i {
            width: 40px;
            flex-shrink: 0;
        }

        .vu-option .port {
            flex-grow: 1;
        }

        .field_group,
        .vu-select.location .vu-select-box {
            position: relative;
            border: 2px solid var(--gray_400);
            border-radius: 7px;
            padding: 12px 15px;
        }

        .field_group {
            padding: 12px 10px;
        }

        .vu-select.location .vu-select-box:focus-within {
            border-color: var(--fv_sec);
        }

        .pass_box {
            height: 100%;
            width: 100%;
            padding: 10px 15px;
        }

        .pass_box p {
            font-size: 1.2rem;
        }

        .pass_box>label,
        .vu-select.location .vu-select-box label {
            position: absolute;
            top: 0;
            left: 10%;
            transform: translateY(-50%);
            background: white;
            padding: 3px 10px;
            font-weight: 600;
            font-size: 1.3rem;
        }

        .vu-select.location .vu-select-box .airport {
            font-size: 1.3rem;
            margin-top: 3px;
        }

        .vu-select.location .vu-select-box .airport span:first-of-type {
            font-weight: 600;
            margin-right: 5px;
        }

        .vu-select.location .main_input {
            font-size: 1.8rem;
            font-weight: 600;
            border: none;
            outline: none;
        }

        .field_group {
            display: flex;
            gap: 10px;
        }

        .vu-date .vu-select-box {
            position: relative;
            padding-inline: 10px;
        }

        .vu-date .vu-select-box input {
            border: none;
            background: none;
            font-size: 1.6rem;
            font-weight: 600;
            outline: none;
            margin-top: 10px;
        }

        .vu-date .vu-select-box label {
            position: absolute;
            top: 0;
            left: 10%;
            transform: translateY(calc(-100% - 4px));
            background: white;
            padding: 3px 10px;
            font-weight: 600;
            font-size: 1.3rem;
        }

        .passengers {
            flex-grow: 1;
            z-index: 2;
            position: relative;
            border-radius: 7px;
            border: 2px solid var(--gray_400);
        }

        .passengers .select_box {
            position: absolute;
            top: 100%;
            width: max-content;
            padding: 20px;
            right: 0;
            box-shadow: 0 0 10px 0 #00000022;
            border-radius: 7px;
            transform: translatey(15px);
            background: white;
        }

        .passengers .select_box:not(.active) {
            display: none;
        }

        .paxs {
            gap: 40px;
        }

        .passenger {
            align-items: center;
            margin-bottom: 10px;
        }

        .passenger h6 {
            font-size: 1.4rem;
        }

        .passenger p {
            font-size: 1.2rem;
        }

        .counter {
            display: flex;
            background: rgba(var(--fv_prime_rgb), 0.2);
            border: 2px solid rgba(var(--fv_prime_rgb), 0.2);
            border-radius: 7px;
            margin-top: 10px;
        }

        .counter input {
            border: none;
            text-align: center;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0;
        }

        .counter .dec,
        .counter .inc {
            font-size: 1.2rem;
            width: 32px;
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .fare_type {
            display: flex;
            align-items: center;
            margin-left: 10px;
        }

        .fare_type input[type="radio"]~label {
            font-size: 1.2rem;
            font-weight: 600;
            margin-left: 3px;
        }

        #pass_det {
            color: var(--fv_prime);
        }

        #pass_det span {
            color: black;
            margin-left: 2px;
        }

        #pass_det i {
            font-size: 1.1rem;
            color: var(--fv_prime);
        }
    </style>
@endpush
<form action="{{ url('flight') }}" method="post" id="flight_form" class="active">
    @csrf
    <div class="trip_options rflex">
        <div class="trip_option rflex aic">
            <input type="radio" name="journey_type"  value="1" checked>
            <label for="">One Way</label>
        </div>
        <div class="trip_option rflex aic">
            <input type="radio" name="journey_type" value="2" >
            <label for="">Round Trip</label>
        </div>
    </div>
    <div class="form_fields rflex">
        <div class="vu-select location">
            <div class="vu-select-box cflex">
                <label for="">From</label>
                <input type="hidden" class="airport_code" name="from">
                <input type="text" placeholder="Enter City or Airport" class="main_input city vu-input" />
                <p class="airport"><span class="airport_code">Select</span><span class="airport_name">an Airport</span>
                </p>
            </div>
            <div class="vu-options"></div>
        </div>
        <div class="vu-select location">
            <div class="vu-select-box cflex">
                <label for="">To</label>
                <input type="hidden" class="airport_code" name="to">
                <input type="text" placeholder="Enter City or Airport" class="main_input city vu-input" />
                <p class="airport"><span class="airport_code">Select</span><span class="airport_name">an Airport</span>
                </p>
            </div>
            <div class="vu-options"></div>
        </div>
        <div class="field_group dates">
            <div class="vu-date">
                <div class="vu-select-box">
                    <label for="">Departure</label>
                    <input type="date" id="dep_date" name="dep_date">
                </div>
                <div class="vu-date-picker"></div>
            </div>
            <div class="vu-date">
                <div class="vu-select-box">
                    <label for="">Return</label>
                    <input type="date" id="ret_date" name="ret_date">
                </div>
                <div class="vu-date-picker"></div>
            </div>
        </div>
        <div class="passengers">
            <div class="pass_box">
                <label for="">Travellers and class</label>
                <h5 id="pass_det" style="font-size: 1.8rem;"><span>1 <i>Adult</i></span></h5>
                <p id="fclass">Any Class</p>
            </div>
            <div class="select_box">
                <div class="paxs rflex">
                    <div class="passenger cflex">
                        <h6>Adults</h6>
                        <p>(above 12 years)</p>
                        <div class="counter">
                            <i class="fa-solid fa-minus dec"></i>
                            <input class="val" type="number" name="adult" id="adult_pax" min="1"
                                max="9" value="1">
                            <i class="fa-solid fa-plus inc"></i>
                        </div>
                        <div class="visual rflex"></div>
                    </div>
                    <div class="passenger cflex">
                        <h6>Children</h6>
                        <p>(2-12 years)</p>
                        <div class="counter">
                            <i class="fa-solid fa-minus dec"></i>
                            <input value="0" class="val" type="number" name="child" id="child_pax"
                                min="0" max="8">
                            <i class="fa-solid fa-plus inc"></i>
                        </div>
                        <div class="visual rflex"></div>
                    </div>
                    <div class="passenger cflex">
                        <h6>Infants</h6>
                        <p>(0-2 years)</p>
                        <div class="counter">
                            <i class="fa-solid fa-minus dec"></i>
                            <input value="0" class="val" type="number" name="infant" id="infant_pax"
                                min="0" max="9">
                            <i class="fa-solid fa-plus inc"></i>
                        </div>
                        <div class="visual rflex"></div>
                    </div>
                </div>
                <div class="flight_classes rflex wrap">
                    <div class="flight_class col-6">
                        <input type="radio" name="travelclass" value="1" id="x0" checked>
                        <label for="x0">All</label>
                    </div>
                    <div class="flight_class col-6">
                        <input type="radio" name="travelclass" value="2" id="x1">
                        <label for="x1">Economy</label>
                    </div>
                    <div class="flight_class col-6">
                        <input type="radio" name="travelclass" value="3" id="x2">
                        <label for="x2">Premium Economy</label>
                    </div>
                    <div class="flight_class col-6">
                        <input type="radio" name="travelclass" value="4" id="x3">
                        <label for="x3">Business</label>
                    </div>
                    <div class="flight_class col-6">
                        <input type="radio" name="travelclass" value="5" id="x4">
                        <label for="x4">Premium Business</label>
                    </div>
                    <div class="flight_class col-6">
                        <input type="radio" name="travelclass" value="6" id="x5">
                        <label for="x5">First Class</label>
                    </div>
                </div>
                <button id="pass">Done</button>
            </div>
        </div>
    </div>
    <div class="rflex" style="margin-block: 20px 10px;">
        <p style="font-size: 1.2rem">Select a<br /> Fair Type</p>
        <div class="fare_types rflex">
            <div class="fare_type">
                <input type="radio" name="fare_type" id="y1" checked>
                <label for="y1">Regular</label>
            </div>
            <div class="fare_type">
                <input type="radio" name="fare_type" id="y2">
                <label for="y2">Armed Forces</label>
            </div>
            <div class="fare_type">
                <input type="radio" name="fare_type" id="y3">
                <label for="y3">Senior Citizen</label>
            </div>
            <div class="fare_type">
                <input type="radio" name="fare_type" id="y4">
                <label for="y4">Student</label>
            </div>
            <div class="fare_type">
                <input type="radio" name="fare_type" id="y5">
                <label for="y5">Doctors & Nurses</label>
            </div>
        </div>
    </div>
    <button type="submit" class="form_btn">Search Flights</button>
</form>
@push('js')
    <script src="{{ url('js/select.js') }}"></script>
    <script>
        $("#flight_form").addEventListener("submit",function(e){
            if(this.from.value=='' || this.to.value==''){
                alert('Please Refill details');
                e.preventDefault();
            }
        });
        // Example usage
        const fetchOptions = (value, callback) => {
            ajax({
                url: "{{ url('api/airports') }}/" + value,
                success: (res) => callback(JSON.parse(res)),
            });
        };

        const optGenerator = (port) =>
            `<div class="vu-option" data-value="${port.city_name}" data-airport_code="${port.airport_code}" data-airport_name="${port.airport_name}"><i class="fa-solid fa-plane"></i><div class="port"><div class="city_name"><h6>${port.city_name},${port.country}<span>(${port.airport_code})</span></h6><p>${port.airport_name}</p></div></div><p class="country">${port.country_code}</p></div>`;

        const fromSelect = new vu_select($(".vu-select")[0], fetchOptions, optGenerator);
        const toSelect = new vu_select($(".vu-select")[1], fetchOptions, optGenerator);

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

        // Temp
        $(".pass_box")[0].addEventListener('click', function() {
            console.log("here");
            let par = this.parentElement;
            par.$('.select_box')[0].addClass('active');
            setTimeout(() => {
                document.addEventListener('click', hide_pass_box);
            }, 1);
        });

        function hide_pass_box() {
            if ($(".pass_box")[0].parentElement.contains(event.target)) return;
            $(".pass_box")[0].parentElement.$('.select_box')[0].removeClass('active');
            document.removeEventListener('click', hide_pass_box);
        }
        $('#pass').addEventListener('click', function(e) {
            e.preventDefault();
            $("#fclass").innerText = $('input[name="travelclass"]:checked ~ label')[0].innerText;
            let pass = '';
            let a = $('#adult_pax').value;
            pass += `<span class="pax">${a} <i>${(a > 1 ? "Adults" : "Adult")}</i></span>`;
            let b = $('#child_pax').value;
            if (b > 0)
                pass += `,<span class="pax">${b} <i>${(b > 1 ? "Children" : "Child")}</i></span>`;
            let c = $('#infant_pax').value;
            if (c > 0)
                pass += `,<span class="pax">${c} <i>${(c > 1 ? "Infants" : "Infant")}</i></span>`;
            $("#pass_det").innerHTML = pass;
            $(".pass_box")[0].parentElement.$('.select_box')[0].removeClass('active');
        })
    </script>
@endpush
