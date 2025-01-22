@inject('countries', App\Models\Country::class)
<style>
    .form_fields .field {
        flex-grow: 1;
    }
</style>
<form action="{{ url('hotel') }}" method="post" id="hotel_form">
    @csrf
    <div class="form_fields rflex">
        <div class="field cflex">
            <label for="">Check In Date</label>
            <input type="date" name="" id="">
        </div>
        <div class="field cflex">
            <label for="">Nights</label>
            <input type="number" name="" id="">
        </div>
        <div class="field cflex">
            <label for="">Country</label>
            <input type="text" name="" list="country_list" onchange="fetch_cities(this.value)">
            <datalist id="country_list">
                @foreach ($countries::all()->toArray() as $country)
                    <option value="{{ $country['country_code2'] }}">{{ $country['country_name'] }}</option>
                @endforeach
            </datalist>
        </div>
        <div class="field cflex">
            <label for="">City</label>
            <input type="text" name="" list="cities">
            <datalist id="cities"></datalist>
        </div>
        <div class="field cflex">
            <label for="">Guest Country</label>
            <input type="text" name="" list="country_list">
        </div>
    </div>
    <div class="form_fields room">
        <div class="fields">
            <label for="">Adults</label>
            <input type="text" name="" id="">
        </div>
        <div class="fields">
            <label for="">Childs</label>
            <input type="text" name="" id="">
        </div>
        <div class="fields">
            <label for="">Child Ages</label>
            <input type="text" name="" id="">
        </div>
    </div>
    <button type="submit" class="form_btn">
        Search Hotels
        <i class="fa-regular fa-arrow-right"></i>
    </button>
</form>
@push('js')
    <script>
        function fetch_cities(query) {
            if (current_request) current_request.abort();
            current_request = ajax({
                url: "{{ url('api/cities') }}/" + query,
                success: (res) => {
                    res = JSON.parse(res);
                    console.log(res);
                    $("#cities").innerHTML='';
                    res.forEach(city => {
                        $("#cities").append(`<option value="${city['DestinationId']}">${city['CityName']}, ${city['StateProvince']}</option>`);
                    });
                }
            });
        }
    </script>
@endpush
