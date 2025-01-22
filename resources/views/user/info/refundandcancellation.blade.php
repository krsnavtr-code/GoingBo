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
                transform: translate(0,-50%);
                z-index: -2;
                opacity: 0.6;
        }

        @media only screen and (max-width:600px) {
            .tnc-container{
                padding: 4rem;
            }
        }
    </style>
@endpush
@section('main')
    <main>
        <div class="tnc-container">
            <div class="text-box">
                <h1>Refund and Cancellation Policy</h1>
                <ul>
                    <li>Payment due to Domestic/International Tickets for the weekly credit to be made within 6 days of the
                        closing of the week (starting from 1st to 7th of the month) or as per the Collection period notified
                        by Goingbo from time to time.</li>
                    <li>(a) Voiding would be as per the airline norms plus Rs.100/ - per ticket as a Goingbo RAF Charges.
                    </li>
                    <li>(b) Refund charges would be as per the airline norms plus Rs.200/ - per ticket as a Goingbo RAF
                        Charges.</li>
                    <li>Service charges levied are to be collected from the customers on our behalf.</li>
                    <li>(a) Any voidation/cancellation of the ticket will be entertained only till 1800 Hrs.</li>
                    <li>(b) If the payment is not made on time Goingbo can anytime cancel all the PNR’s/Tickets without any
                        prior notice.</li>
                    <li>Any kind of Misuse of Airline/GDS PNR will solely be the responsibility of the agent and the amount
                        will be recovered from the agent as an when received the debit note by the Airline or by the GDS.
                    </li>
                    <li>There will no adjusting of the refund in the payment schedule. The refund will be given back to the
                        agent whenever we have received it from the airline.</li>
                    <li>TDS will be deducted as per the law. TDS will be deducted on all commissions/incentives. The TDS
                        certificate will be issued in the next Financial Year.</li>
                    <li>Responsibility for Taxes. Travel Agent acknowledges that, regardless of any action taken by Goingbo,
                        the ultimate responsibility for Tax Collected at Source (‘TCS’) under section 206C(1G) or any other
                        taxes as may be legally applicable and filing requirements in connection with the same thereof
                        (hereinafter collectively referred to as ‘Tax Obligations’), is and shall remain his (or her)
                        responsibility.</li>
                    <li>The credit limit will be on a weekly basis depending upon the certain guarantees.</li>
                    <li>Any advance amount paid by the agent will be non-interest bearing and should be utilized within 360
                        days from the date of payment. If such advance is not utilized within this period of 360 days, the
                        unutilized portion shall be held in trust, for the benefit of the agent, by Goingbo for a period of
                        2 years from the date of payment of such advance after which the same shall be deemed as forfeited.
                    </li>
                    <li>The User shall request Goingbo for any refunds against the unutilized or 'no show' air or hotel
                        booking for any reasons within 90 days from the date of departure for the air ticket and/or the date
                        of check-in for the hotel booking. Any applicable refunds would accordingly be processed as per the
                        defined policies of Airlines, hotels and Goingbo as the case may be. No refund would be payable for
                        any requests made after the expiry of 90 days as above and all unclaimed amounts for such unutilized
                        or no show air or hotel booking shall be deemed to have been forfeited.</li>
                    <li>Any other refunds or unadjusted credits received from suppliers (including hotels, airlines etc.)
                        and not claimed or pursued by travel agents or suppliers within 2 years of receipt of such amounts
                        by Company, shall be deemed to have been forfeited.</li>
                    <li>Agents will be responsible for maintaining all related documents including confirmation from the
                        travellers that the amount paid by them for travel outside of India is in within the annual limits
                        for resident individuals as prescribed by the Reserve Bank of India from time to time.</li>
                    <li>That our Client shall grant a limited and non-transferable right to you, the Noticees, to use the
                        website of our Client - www.Goingbo.com for conducting online booking of the various travel services
                        as made available by our Client to you.</li>
                    <li>That you, the Noticees, shall make payment for the services availed by cash/cheque/demand
                        draft/credit card, and in case of non-payment within 7 days of the due date you, the Noticees, shall
                        be liable to pay interest at the rate of 0.1% per day till the date of payment of the full amount.
                    </li>
                    <li>That you agree to indemnify us from and against any and all losses, liabilities, claims, damages,
                        costs and expenses asserted against or incurred by us that arise out of any breach or
                        non-performance of any covenant or agreement made or obligations to be performed by you;</li>
                    <li>Obvious errors and mistakes (including misprints, typographical errors and errors in calculating
                        currency conversion, errors in pricing in general, etc.) are not binding. In the event of a tariff
                        error affecting the price of a confirmed Booking, Goingbo is expressly entitled to modify the
                        affected Booking to reflect the correct tariff giving notice to the Client. If Goingbo offers the
                        Client the option to cancel the Booking and Client does not cancel the same within the given time,
                        it shall implicate the acceptance of the corrected rate and any accepted discount that at its sole
                        discretion and as a mere gesture of goodwill, Goingbo may have decided to apply (if any).
                        Notwithstanding the above, Goingbo or the Supplier reserve the right to cancel the Booking and in
                        the event of such cancellation, without incurring any liability to the Client, Goingbo will refund
                        monies paid by the Client in relation to such Booking(s) (if applicable).</li>
                </ul>
            </div>
                <img src="{{ asset('images/all-img/work-img-2.png') }}" alt="Refund and Cancellation Policy Image"
                >

        </div>
    </main>
@endsection
