@extends('user.components.layout')
@push('css')
<style>
    .my-row,
    .flex {
        flex: 1;
        display: flex;
        gap: 1rem;
    }

    form {
        width: 90%;
        margin: 2rem auto;
        padding: 3rem 2rem;
        background: white;
        box-shadow: 0 0 10px 0 #00000033;
        position: relative;
        border-radius: 8px;
    }

    form h5 {
        margin: 0 0 2rem;
        text-transform: capitalize;
    }

    .vu-select {
        width: 100%;
        position: relative;
    }

    .vu-suggestion {
        position: absolute;
        top: calc(100% + 10px);
        box-shadow: 0 0 10px 0 #00000033;
        padding: 10px;
        background: white;
        width: 100%;
        border-radius: 6px;
        z-index: 10;
    }

    .vu-select:not(.active) .vu-suggestion {
        display: none;
    }

    .field {
        display: flex;
        flex-direction: column;
        border: 1px solid var(--gray_600);
        position: relative;
        border-radius: 3px;
        flex: 1;
    }

    .field label {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--fv_prime);
        padding: 0 10px;
        background: white;
        position: absolute;
        top: 0;
        left: 20px;
        transform: translatey(-50%);
    }

    .field input {
        width: 100%;
        padding: 10px;
        border: none;
        background: none;
    }

    form button {
        padding: 10px 30px;
        border-radius: 5px;
        font-size: 1.5rem;
        border: none;
        background: var(--fv_prime);
        color: white;
        font-weight: 600;
        /* position: absolute;
            bottom: 0;
            right: 0;
            transform: translate(-50%, 50%); */
    }

    .vu-option {
        font-weight: 600;
        padding: 8px 10px;
        border-radius: 5px;
        font-size: 1.25rem;
    }

    .vu-option:hover {
        background: rgba(var(--fv_prime_rgb), 0.4);
    }

    @media only screen and (max-width:768px) {

        form {
            padding: 2rem 1rem;
        }

        input {
            flex: 1;
        }

        .my-row {
            flex-direction: column;
        }
    }
</style>
@endpush
@section('main')

<main>
    <div class="navigation" style="font-weight:600;padding:20px 0 10px 20px;">
        <a href="{{ url('cab') }}">Special Cabs</a>
        <i class="fa-solid fa-chevron-right"></i>
        <span style="color: var(--fv_prime)">{{ $type }}</span>
    </div>
    <form action="{{ url('/cab/'. $type.'/search') }}" method="get" class="cflex">
        <div class="hidden" style="display: none">
            @csrf
        </div>
        <h5>Book your ride instantly</h5>
        <div class="my-row">
            <div class="flex">
                @if($type !== 'Daily-Rental' )
                <div class="vu-select">
                    <div class="field vu-content">
                        <label for="">Going From</label>
                        <input type="text" name="going_from_city" placeholder="Search City" class="vu-input" required autofocus>
                        <input type="hidden" name="going_from" class="city_id">
                    </div>
                    <div class="vu-suggestion cflex"></div>
                </div>                
                <div class="vu-select">
                    <div class="field vu-content">

                        <label for="">Going To</label>
                        <input type="text" name="going_to_city" placeholder="Search City" class="vu-input" required>
                        <input type="hidden" name="going_to" class="city_id">
                    </div>
                    <div class="vu-suggestion cflex"></div>
                </div>
                @elseif($type == 'Daily-Rental')
                <div class="vu-select">
                    <div class="field vu-content">
                        <label for="">Pickup Location </label>
                        <input type="text" name="going_from_city" placeholder="Search City" class="vu-input" required autofocus>
                        <input type="hidden" name="going_from" class="city_id">
                    </div>
                    <div class="vu-suggestion cflex"></div>
                </div>
                <div class="vu-select">
                    <div class="field vu-content">
                        <label for=""> Duration </label>
                        <select name="duration"   class="vu-input" style="width: 100%; padding: 10px;   border: none; background: none;">
                        <div class="vu-suggestion cflex">                            
                            <option value="1hr-10kms">1 hr 10 kms</option>
                            <option value="2hrs-20kms">2 hrs 20 kms</option>
                            <option value="3hrs-30kms">3 hrs 30 kms</option>
                            <option value="4hrs-40kms">4 hrs 40 kms</option>
                            <option value="5hrs-50kms">5 hrs 50 kms</option>
                            <option value="6hrs-60kms">6 hrs 60 kms</option>
                            <option value="7hrs-70kms">7 hrs 70 kms</option>
                            <option value="8hrs-80kms">8 hrs 80 kms</option>
                            <option value="9hrs-90kms">9 hrs 90 kms</option>
                            <option value="10hrs-100kms">10 hrs 100 kms</option>
                        </div>
                        </select>
                    </div>
                </div>
                @endif
            </div>
           
            <div class="flex">
                <div class="field">
                    <label for="c_date">Pickup Date</label>
                    <input type="date" name="c_date" id="c_date" min="{{ now()->toDateString() }}" required>
                </div>
                <div class="field">
                    <label for="c_time">Pickup Time</label>
                    <input type="text" class="timepicker" name="c_time" autocomplete="off" required>
                </div>
            </div>
            @if($type !== 'Round-Trip')
            <button type="submit">Search Cab</button>
            @endif
        </div>


        @if($type == 'Round-Trip')
        <h5 style="margin-top: 20px;">Return Journey Details</h5>
        <div class="my-row">
            <div class="flex">
                <div class="field">
                    <label for="c_date">Return Date</label>
                    <input type="date" name="r_date" id="c_date" min="{{ now()->toDateString() }}" required>
                </div>
                <div class="field">
                    <label for="r_time">Return Time</label>
                    <input type="text" class="timepicker" name="r_time" required>
                </div>
            </div>
            <button type="submit">Search Cab</button>
        </div>
        @endif
    </form>
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
    document.addEventListener('DOMContentLoaded', function() {
        $('.timepicker').timepicker({
            timeFormat: 'h:mm p',
            interval: 15,
            minTime: '05',
            maxTime: '11:45pm',
            defaultTime: 'now',
            startTime: '05:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the input element
        var c_date = document.getElementById('c_date');

        // Set the minimum date to the current date
        c_date.min = new Date().toISOString().split('T')[0];
    });
</script>

@endpush