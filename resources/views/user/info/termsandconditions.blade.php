@extends('user.components.layout')
@push('css')
    <style>
        .tnc-container {
            padding: 8rem;
            position: relative;
        }

        .tnc-container h1 {
            font-size: 3rem;
            color: #2b3e50;
            font-weight: bold;
            text-transform: uppercase;
            text-align: center;
            margin-bottom: 1rem;
        }

        .tnc-container li {
            font-size: 2rem;
            color: #000;
            margin-bottom: 1rem;
        }

        .tnc-container img {
            position: fixed;
            right: 0;
            top: 50%;
            transform: translate(0, -50%);
            z-index: -2;
            opacity: 0.6;
        }

        footer{
            background: #fff;
        }

        @media only screen and (max-width:600px) {
            .tnc-container {
                padding: 4rem;
            }
        }
    </style>
@endpush
@section('main')
    <main>
        <div class="tnc-container">
            <div class="text-box">
                <h1>Terms & Conditions Policy</h1>
                <ul>
                    <li>The itinerary is fixed and cannot be modified. Transportation shall be provided as per the itinerary
                        and will not be at disposal. For any paid activity which is non-operational due to any unforeseen
                        reason, we will process refund & same should reach the guest within 30 days of processing the
                        refund.</li>
                    <li>Also, for any activity which is complimentary and not charged to Goingbo & guest, no refund will be
                        processed.</li>
                    <li>Entrance fee, parking and guide charges are not included in the packages.</li>
                    <li>If your flights involve a combination of different airlines, you may have to collect your luggage on
                        arrival at the connecting hub and register it again while checking in for the onward journey to your
                        destination.</li>
                    <li>Booking rates are subject to change without prior notice.</li>
                    <li>Airline seats and hotel rooms are subject to availability at the time of booking.</li>
                    <li>Pricing of the booking is based on the age of the passengers. Please make sure you enter the correct
                        age of passengers at the time of booking. Passengers furnishing incorrect age details may incur
                        penalty at the time of travelling.</li>
                    <li>In case of unavailability in the listed hotels, arrangement for an alternate accommodation will be
                        made in a hotel of similar standard.</li>
                    <li>In case your package needs to be cancelled due to any natural calamity, weather conditions etc.
                        Goingbo shall strive to give you the maximum possible refund subject to the agreement made with our
                        trade partners/vendors.</li>
                    <li>Goingbo reserves the right to modify the itinerary at any point, due to reasons including but not
                        limited to: Force Majeure events, strikes, fairs, festivals, weather conditions, traffic problems,
                        overbooking of hotels / flights, cancellation / re-routing of flights, closure of /entry
                        restrictions at a place of visit, etc. While we will do our best to make suitable alternate
                        arrangements, we would not be held liable for any refunds/compensation claims arising out of this.
                    </li>
                    <li>Certain hotels may ask for a security deposit during check-in, which is refundable at check-out
                        subject to the hotel policy.</li>
                    <li>The booking price does not include: Expenses of personal nature, such as laundry, telephone calls,
                        room service, alcoholic beverages, mini bar charges, tips, portage, camera fees etc.</li>
                    <li>Any other items not mentioned under Inclusions are not included in the cost of the booking.</li>
                    <li>The package price does not include mandatory gala dinner charges levied by the hotels especially
                        during New Year and Christmas or any special occasions. Goingbo shall try to communicate the same
                        while booking the package. However Goingbo may not have this information readily available all the
                        time.</li>
                    <li>Cost of deviation and cost of extension of the validity on your ticket is not included.</li>
                    <li>For queries regarding cancellations and refunds, please refer to our Cancellation Policy.</li>
                    <li>Disputes, if any, shall be subject to the exclusive jurisdiction of the courts in New Delhi.</li>
                    <li>The cost of mentioned tours and transfer is not valid between 6 pm to 8 am.</li>
                </ul>
            </div>
            <img src="{{ asset('images/all-img/abt_vec_1.png') }}" alt="Terms and Conditions Image">

        </div>
    </main>
@endsection
