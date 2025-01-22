@extends('admin.components.layout')
@section('main')
    <main>
        @include('admin.components.response')
        <div>
            <h1 class="page_title">Cab Edit Details</h1>
            <p class="page_sub_title">Let's edit cab in group</p>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="hidden">@csrf</div>
            <section>
                <div class="field_group">
                    <div class="field">
                        <label for="owner_name"> Owner Name</label>
                        <input type="text" name="owner_name" id="owner_name" value="{{$cab['owner_name']}}" required>
                    </div>
                    <div class="field">
                        <label for="company_name"> Company Name</label>
                        <input type="text" name="company_name" id="company_name" value="{{$cab['company_name']}}" required >
                    </div>
                </div>
                <div class="field_group">
                    <div class="field">
                        <label for="company_address"> Company Address </label>
                        <input type="text" name="company_address" id="company_address" value="{{$cab['company_address']}}" required >
                    </div>
                    <div class="field">
                        <label for="gst_number"> GST Number </label>
                        <input type="text" name="gst_number" id="gst_number" value="{{$cab['gst_number']}}" required>
                    </div>
                </div>
                <div class="field_group">
                    <div class="field">
                        <label for="owner_contact">Owner Contact </label>
                        <input type="text" name="owner_contact" id="owner_contact" value="{{$cab['owner_contact']}}" required>
                    </div>
                    <div class="field">
                        <label for="owner_email">Owner Email</label>
                        <input type="email" name="owner_email" id="owner_email" value="{{$cab['owner_email']}}" required>
                    </div>
                </div>
                     
                <div class="field">
                    <label for="owner_upi">Owner UPI</label>
                    <input type="text" name="owner_upi" id="owner_upi" value="{{$cab['owner_upi']}}" required>
                </div>
            </section>

             <section>
                <span class="page_title"> Driver  Details </span>
                <div class="field_group">
                        <div class="field">
                            <label for="driver_name"> Driver Name </label>
                            <input type="text" name="driver_name" id="driver_name" value="{{$cab['driver_name']}}" required>
                        </div>
                        <div class="field">
                        <label for="driver_license"> Driver Driving License </label>
                            <input type="text" name="driver_license" id="driver_license" value="{{$cab['driver_license']}}" required>                       
                        </div>                        
                </div>
                <div class="field_group"> 
                    <div class="field">
                        <label for="yr_of_exp"> Years of Experience </label>
                        <input type="number" name="yr_of_exp" id="yr_of_exp" max="60" value="{{$cab['yr_of_exp']}}" required>
                    </div>
                    <div class="field">
                        <label for="min_charge"> Mininum Charge </label>
                        <input type="number" name="min_charge" id="min_charge" value="{{$cab['min_charge']}}" required>
                    </div>     
                </div>
                <div class="field_group">
                    <div class="field">
                        <label for="driver_img" > Driver Image: </label>
                        <input type="file" id="driver_img" name="driver_img" value="{{$cab['driver_img']}}" >
                    </div>
                </div>
                
            </section>
            
            <section>
                <span class="page_title"> Vehicle  Details </span>
                <div class="field_group">
                    <div class="field">
                        <label for="vehicle_number">Vehicle Number </label>
                        <input type="text" name="vehicle_number" id="vehicle_number" value="{{$cab['vehicle_number']}}" required>
                    </div>
                    <div class="field">
                        <label for="vehicle_model">Vehicle Model</label>
                        <input type="text" name="vehicle_model" id="vehicle_model" value="{{$cab['vehicle_model']}}" required>
                    </div>
                </div>
                <div class="field_group">
                    <div class="field">
                        <label for="vehicle_default_location">Vehicle Default Location</label>
                        <input type="text" name="vehicle_default_location" id="vehicle_default_location" list="cities"    oninput="fetchCities(this.value)" value="{{$cab['vehicle_default_location']}}" required>
                        <datalist id="cities"></datalist>
                    </div>
                    <div class="field">
                        <label for="km_price">Price Per Km</label>
                        <input type="number" name="km_price" id="km_price" value="{{$cab['km_price']}}" required>
                    </div>
                    
                </div>
                <div class="field_group">
                    <div class="field">
                        <label for="vehicle_img"> Vehicle Image: </label>
                        <input type="file" name="vehicle_img" id="vehicle_img"  >
                    </div>
                </div>
            </section>

            <section>
                <h5 class="section_title">Cab Features</h5>
                <div class="field_group">
                    <div class="field">
                        <label for="">No. of seats</label>
                        <input type="number" name="feature[Seats]" id="" value="" >
                    </div>
                    <div class="field">
                        <label for="">Baggage Capacity(KG)</label>
                        <input type="number" name="feature[Baggage]" id="" value=""> 
                    </div>
                    <div class="field">
                        <label for="">Vehicle Color</label>
                        <input type="text" name="feature[Color]" id="" value="" >
                    </div>
                </div>
                <div class="field_group">
                    <div class="field checkbox">
                        <input type="checkbox" name="feature[other][A.C.]" id="x1" value="true"  >
                        <label for="x1">A.C.</label>
                    </div>
                    <div class="field checkbox">
                        <input type="checkbox" name="feature[other][Mp3 Player]" id="x2" value="true">
                        <label for="x2">MP3 Player</label>
                    </div>
                    <div class="field checkbox">
                        <input type="checkbox" name="feature[other][Video Player]" id="x3" value="true">
                        <label for="x3">Video Player</label>
                    </div>
                    <div class="field checkbox">
                        <input type="checkbox" name="feature[other][Sunroof]" id="x4" value="true">
                        <label for="x4">Sun Roof</label>
                    </div>
                    <div class="field checkbox">
                        <input type="checkbox" name="feature[other][Mobile Charger]" id="x5" value="true">
                        <label for="x5">Mobile Charger</label>
                    </div>
                </div>
            </section>
            <button type="submit">Submit</button>
        </form>
    </main>
@endsection
@push('js')
    <script>
        const fetchCities = (value) => {
            ajax({
                url: `{{ url('api/city/') }}/${value}`,
                success: (res) => {
                    res = JSON.parse(res);
                    $('#cities').innerHTML='';
                    res['cities'].forEach(city => {
                        $('#cities').append(`<option value="${city.id}">${city.city_name}</option>`);
                    });
                },
            });
        };
    </script>
@endpush
