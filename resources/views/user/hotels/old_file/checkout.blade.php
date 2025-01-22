
@extends('user.components.layout')
@push('css')
<link rel="stylesheet" href="{{ url('css/user_css/bookcab.css') }}">
<style>
    button{
        padding: 9px;
        font-weight: 600;
        font-size: 1.5rem;
        background: var(--fv_prime);
        border-radius: 6px;
        border: none;
        width: 280px;
        margin: 20px 0;
   
    }
</style>
@endpush
@section('main')
<main>

<div class="sps_pgwrapper">       
    {{-- <div class="sps_pgleft">   for left side-bar     </div> --}}
    <div class="sps_pgleft">      
        <div class="infinite_ld_container">
        <div class="ld_card">
            <div class="cab_card">
                <div class="cab_card_head">
                    <div class="cab_dth">
                    <div class="cab_dth">
                        <h4>Pay {{$total}} to confirm booking </h4>
                    </div>
                </div>
                </div>
            </div>
        
        <div class="cab_list_item">
            <div class="cab_list_items">
                <div class="cab_item_left">
                    <div class="cab_makeflex">
                        <span class="cab_title"> {{$response['HotelName']}}  </span>  
                    </div>     
                    
                </div>
                <div >
                    <span class="cab_title"> Passengers:{{ session('hotel_search_inputs.adult') + session('hotel_search_inputs.child') }} </span><br> 
                </div>
                <div >
                    <span class="cab_title"> Check-in:{{ date('d-m-y', strtotime(session('hotel_search_inputs.dep_date'))) }} || Check-out:{{ date('d-m-y', strtotime(session('hotel_search_inputs.ret_date'))) }} </span><br> 
                </div>

                @if (!empty($response['HotelRoomsDetails'][0]['HotelPassenger'][0]))
                <div>
                    <span class="cab_title">Name: {{ $response['HotelRoomsDetails'][0]['HotelPassenger'][0]['Title'] }} {{ $response['HotelRoomsDetails'][0]['HotelPassenger'][0]['FirstName'] }} {{ $response['HotelRoomsDetails'][0]['HotelPassenger'][0]['LastName'] }}</span><br>
                    <span class="cab_title">Email: {{ $response['HotelRoomsDetails'][0]['HotelPassenger'][0]['Email'] }}</span><br>
                    <span class="cab_title">Phone No: {{ $response['HotelRoomsDetails'][0]['HotelPassenger'][0]['Phoneno'] }}</span><br>
                </div>
                @endif
            </div>          
        </div>
    </div>
</div>
</div>
<div class="sps_pgright">
    <div class="panel">
        <h5>Fare Summary</h5>
        <div class="rflex jcsb" style="font-size: 0.9em;margin-top:10px;">
            <p> {{$response['HotelName']}}  </p>
            <p>{{$fare}} </p>
        </div>

        <div class="rflex jcsb" style="font-size: 0.9em;margin-top:10px;">
            <p>Gst ({{$gst}}%)</p>
            <p> {{ $fare * $gst/100 }} </p>
        </div>
        <div class="rflex jcsb" style="margin-top: 7px;padding-top:3px;border-top:1px dashed var(--gray_500)">
            <h6>Total</h6>
            <h6> {{ $total }} </h6>
        </div>
    </div>

    {{-- @php
    session(['fareSummary' => [
        'id' => $id,
        'type' => $type,
        'goingFromCity' => $request->goingFromCity,
        'goingToCity' => $request->goingToCity,
        'passengers' => $request->passengers,
        'cDate' => $request->cDate,
        'cTime' => $time24hr,
        'vehicleModel' => $cabroutes['cab']['vehicle_model'],
        'name' => $request->name,
        'email' => $request->email,
        'mobileNo' => $request->mobile_no,
        'price' => $cabroutes['price'],
        'fare' => $fare,
        'gst' => $fare * $gst/100,
        'total' => $total,
    ]]);
@endphp --}}
  
    <button type="submit" id="razorPay">Checkout</button>
    
    <div class="panel query_panel">
        <h5>Raise A Query</h5>
        <p>Having anything in mind, feel free to write us. We are here for you. We will connect you back as soon as possible</p>
        <button>Raise A Query</button>
    </div>


</div>
</div>
       

</main>    
@endsection
@push('js')
    @includeIf('user.components.razorPay', ['order' => $order, 'redirect' => url('hotel/ticket')])
@endpush

