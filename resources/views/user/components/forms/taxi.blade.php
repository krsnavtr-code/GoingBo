@php
    $activeForm = $activeForm ?? 'flight';
@endphp
<form action="" method="get" class="cab_form" id="cab_form">
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
                <li>Get 20% OFF on cab routes as welcome gift.</li>
                <li>Book cabs @ ₹0 and pay later.</li>
                <li>Hassle Free Bookings.</li>
            </ul>
        </div>
    </div>

    <div class="fields rflex">
        <span> Cab Booking </span>
        <div class="col-6 destinations"> 
            <div class="wrapper location">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">From</label>
                        <input type="text" name="from" id="from" class="form-control">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">To</label>
                        <input type="text" name="to" id="to" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>