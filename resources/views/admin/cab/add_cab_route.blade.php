@extends('admin.components.layout')
@push('css')
<style>
    .vu-suggestion:not(.active){
        display: none;
    }
</style>
@endpush
@section('main')
    <main>
        @include('admin.components.response')
        <div>
            <h1 class="page_title">Cab Route Details</h1>
            <p class="page_sub_title">Let's add new cab route  in group</p>
        </div>
        <form action="{{ url($page['current']) }}" method="post" enctype="multipart/form-data">
            <div class="hidden">
                @csrf
                <input type="hidden"  name="vehicle_number" value="{{$data['id']}}">
            </div>
            <section>
                <div class="field_group">
                    <div class="field">
                        <label for="owner_name">Owner name</label>
                        <input type="text"  id="owner_name" value="{{$data['owner_name']}}" disabled>
                    </div>
                    <div class="field">
                        <label for="driver_name"> Driver Name </label>
                        <input type="text"  id="driver_name" value="{{$data['driver_name']}}" disabled>
                    </div>
                    <div class="field">
                        <label for="vehicle_number"> Vehicle number</label>
                        <input type="text"  id="vehicle_number" value="{{$data['vehicle_number']}}" disabled>
                    </div>

                   
                </div>
               
            </section>
            <section>
                <div class="field_group">
                    <div class="field">
                        <label for="from_location">Going from</label>
                        <div class="vu-select" style="position: relative">
                            <div class="vu-content">
                                <input type="hidden" name="from_location" class="city_id" required>
                                <input type="text" id="from_location" class="vu-input">
                            </div>
                            <div class="vu-suggestion" style="position: absolute;width:100%;background:white;"></div>
                        </div>
                    </div>
                    <div class="field">
                        <label for="to_location"> Going to location</label>
                        <div class="vu-select" style="position: relative">
                            <div class="vu-content">
                                <input type="hidden" name="to_location" class="city_id" required>
                                <input type="text" id="to_location" class="vu-input">
                            </div>
                            <div class="vu-suggestion" style="position: absolute;width:100%;background:white;"></div>
                        </div>
                    </div>
                </div>
                <div class="field_group">
                    <div class="field">
                        <label for="night_halt">Night Halt:</label>
                        <select id="night_halt" name="night_halt" >
                            <option value="1">Yes</option>
                            <option value="0">No </option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="price"> Price(in rupees)</label>
                        <input type="number" name="price" id="price" required>
                    </div>
                </div>
                <div class="field_group">
                    <div class="field">
                        <label for="free_cancel"> Free Cancellation until hrs </label>
                        <input type="number" name="free_cancel" id="free_cancel" required>
                    </div>
                    <div class="field">
                        <label for="coupon"> Coupon discount('like GBO500') </label>
                        <input type="text" name="coupon" id="coupon" required>
                    </div>
                </div>
            </section>
            
            <button type="submit">Submit</button>
        </form>
    </main>
@endsection
@push('js')
<script src="{{url('js/vu-select.js')}}"></script>
    <script>
        const fetchOptions = (value, callback) => {
            ajax({
                url: `{{ url('api/city/') }}/${value}`,
                success: (res) => callback(JSON.parse(res)['cities']),
            });
        };

        const optionGenerator = (city,i) =>
            `<div class="vu-option" data-value="${city.city_name}" data-city_id="${city.id}"><span>${i}</span> ${city.city_name}</div>`;

        const fromSelect = new vu_select($(".vu-select")[0], {
            optionGenerator,
            fetchOptions
        });
        const toSelect = new vu_select($(".vu-select")[1], {
            optionGenerator,
            fetchOptions
        });
    </script>
@endpush