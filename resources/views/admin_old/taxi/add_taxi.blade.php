@extends('admin.components.layout')
@section('main')
    <main>
        @include('admin.components.response')
        <form action="{{ Request::get('current_page') }}" method="post" enctype="multipart/form-data">
            <div>
                @csrf
                <h4 class="form_title">Add Taxi</h4>
                <p class="form_sub_title">Add new taxi</p>
            </div>
            <section>
                <div class="field_group">
                    <div class="field">
                        <label for="">to_destination</label>
                        <input type="text" name="to_destination" id="">
                    </div>
                    <div class="field">
                        <label for="">from_destination</label>
                        <input type="text" name="from_destination" id="">
                    </div>
                    <div class="field">
                        <label for="">distance_kms</label>
                        <input type="number" name="distance_kms" id="">
                    </div>
                    <div class="field">
                        <label for="">cab_type</label>
                        <input type="text" name="cab_type" id="">
                    </div>
                    <div class="field">
                        <label for="">cab_model</label>
                        <input type="text" name="cab_model" id="">
                    </div>
                    <div class="field">
                        <label for="">vehicle_no</label>
                        <input type="text" name="vehicle_no" id="">
                    </div>
                    <div class="field">
                        <label for="">vehicle_Insu</label>
                        <input type="text" name="vehicle_Insu" id="">
                    </div>
                    <div class="field">
                        <label for="">overall_hours</label>
                        <input type="number" name="overall_hours" id="">
                    </div>
                    <div class="field">
                        <label for="">overall_minutes</label>
                        <input type="number" name="overall_minutes" id="">
                    </div>
                    <div class="field">
                        <label for="">extra_charge</label>
                        <input type="number" name="extra_charge" id="">
                    </div>
                    <div class="field">
                        <label for="">total_price</label>
                        <input type="number" name="total_price" id="">
                    </div>
                    <div class="field">
                        <label for="">cab_seat</label>
                        <input type="number" name="cab_seat" id="">
                    </div>
                    <div class="field">
                        <label for="">luggage_bags</label>
                        <input type="number" name="luggage_bags" id="">
                    </div>
                    <div class="field">
                        <label for="">car_ac_nonac</label>
                        <select name="car_ac_nonac" id="">
                            <option>NON-AC</option>
                            <option>AC</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="">fuel_type</label>
                        <select name="fuel_type" id="">
                            <option>Diesel</option>
                            <option>Petrol</option>
                            <option>CNG</option>
                            <option>LPG</option>
                            <option>Electric Vehicle</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="">travelldate</label>
                        <input type="date" name="travelldate" id="">
                    </div>
                    <div class="field">
                        <label for="">endddate</label>
                        <input type="date" name="endddate" id="">
                    </div>
                    <div class="field">
                        <label for="">image</label>
                        <input type="file" name="image" id="" style="display: block">
                    </div>
                </div>
            </section>
            <button type="submit">Proceed</button>
        </form>
    </main>
@endsection
