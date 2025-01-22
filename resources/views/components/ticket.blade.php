@php
$mail = 'info@goingbo.com';
$web = 'https://www.goingbo.com';
$contact = '9990999561';
@endphp
@push('css')
<style>
    .ticket {
        border: 4px solid var(--fv_prime);
        padding: 20px;
        background: white;
        margin: 20px;
        /* min-width: 1000px; */
    }

    .ticket_header img {
        height: 100px;
        object-fit: contain;
    }

    .ticket :where(.company_details, .booking_details) p:not(:last-of-type) {
        margin-bottom: 3px;
    }

    .ticket :where(.company_details, .booking_details) p span:first-of-type {
        font-weight: 700;
        font-size: 1.4rem;
    }

    .ticket_main {
        padding-block: 30px;
    }

    .ticket_main> :not(:last-of-type) {
        margin-bottom: 30px;
    }

    .ticket_main table {
        width: 100%;
        margin-bottom: 15px;
        border-collapse: collapse;
        border: 2px solid #e0e1ea;
    }

    .ticket_main table thead {
        background: #f1f0f0;
        print-color-adjust: exact;
    }

    table :is(td, th) {
        padding: 5px 0 7px;
        text-align: center;
    }

    table .fare_box>p {
        padding: 0 20px;
    }

    table .fare_box div {
        flex-grow: 1;
        gap: 5px;
    }

    table .fare_box :is(p, h6) {
        display: flex;
        flex-grow: 1;
        padding: 0 20px;
        font-size: 1.7rem;
        justify-content: space-between;
    }

    p.error {
        color: var(--error);
        font-weight: 700;
        margin-top: 6px;
        font-size: 1.4rem;
    }

    .ticket_footer {
        padding-top: 20px;
        border-top: 2px solid var(--fv_prime);
    }

    .ticket_footer img {
        height: 30px;
    }

    .ticket~button {
        margin: 1rem auto !important;
    }

    @media only screen and (max-width:768px) {
        .ticket_main {
            font-size: small !important;
        }

        /* .ticket_main> :not(:last-of-type) {
            display: flex;
        }

        .ticket_main> :not(:last-of-type) thead,
        .ticket_main> :not(:last-of-type) tbody {
            justify-content: start;
            flex: 1;
            text-align: start;
        }

        .ticket_main> :not(:last-of-type) tr {
            display: flex;
            flex-direction: column;
        }

        .ticket_main> :not(:last-of-type) th,
        .ticket_main> :not(:last-of-type) td {
            border-bottom: 1px solid #e0e1ea;
            width: 100%;
            text-align: start;
            padding-left: 1rem;
        } */

        .ticket .fare_box {
            display: block;
        }

        .ticket_header {
            flex-direction: column;
        }

        .ticket_header :nth-child(1) {
            order: 2;
        }

        .ticket_header :nth-child(2) {
            order: 1;
        }

        .ticket_header :nth-child(3) {
            order: 3;
        }

        .ticket .company_logo {
            display: flex;
            justify-content: center;
        }
    }

    @media only screen and (max-width:475px) {
        table .fare_box {
            padding: 1rem !important;
        }

        table .fare_box :is(p, h6) {
            padding: 0;
            font-size: smaller;
        }

        .ticket :where(.company_details, .booking_details) p span:first-of-type {
            font-size: small;
        }

        .ticket {
            padding: 1rem;
            margin: 1rem;
            font-size: smaller;
        }

        .ticket_footer {
            display: block;
        }
        .fare-box{
        white-space: nowrap;
        }

    }

    @media print {
        body {
            visibility: hidden;
            -webkit-print-color-adjust: exact;
        }

        .printable {
            visibility: visible;
            position: absolute;
            left: 0;
            top: 0;
        }
    }
</style>
@endpush
<div class="ticket cflex" id="{{ $ticket_id??$id }}">
    <div class="ticket_header rflex jcsb">
        <div class="company_details">
            <h4 style="font-weight: 700">Goingbo Tours Pvt. Ltd.</h4>
            <p>
                <span>Regd Office: </span>
                <span>B 93, SECTOR 64 NOIDA, Noida 201301</span>
            </p>
            <p>
                <span>Email: </span>
                <span><a href="mailto:{{ $mail }}">{{ $mail }}</a></span>
            </p>
            <p>
                <span>Web: </span>
                <span><a href="{{ $web }}">{{ $web }}</a></span>
            </p>
            <p>
                <span>Phone: </span>
                <span><a href="tel:+{{ $contact }}">{{ $contact }}</a></span>
            </p>
            <p>
                <span>State: </span>
                <span>Uttar Pradesh</span>
            </p>
        </div>
        <div class="company_logo">
            <img src="{{ url('/images/logo.png') }}" alt="">
        </div>
        <div class="booking_details">
            {{ $booking_details }}
        </div>
    </div>
    <div class="ticket_main">
        {{ $ticket_details }}
        <table>
            <thead>
                <tr>
                    <th>Payment Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="rflex aic fare_box">
                        <p>This is an Electronic ticket. Please carry a positive identification for Check in.</p>
                        <div class="cflex">
                            <p><span>Fare:</span><span><i class="fa-light fa-indian-rupee"></i>
                                    {{ gettype($fare)=='array' ?$fare['fare']:$fare }}</span></p>
                            <p><span>K3/GST:</span><span><i class="fa-light fa-indian-rupee"></i>
                                    {{ gettype($fare)=='array' ?$fare['gst']:$gst }}</span></p>
                            <p><span>Fee & Surcharge:</span><span><i class="fa-light fa-indian-rupee"></i>
                                    {{ gettype($fare)=='array' ? floor($fare['charges']):floor($charges) }}</span></p>
                            <h6><span>Total Amount:</span><span><i class="fa-regular fa-indian-rupee"></i>
                                    {{ gettype($fare)=='array' ?$fare['total']:$total }}</span></h6>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="faqs">
            <p>Carriage and other services provided by the carrier are subject to conditions of carriage which
                hereby incorporated by reference. These conditions may be obtained from the issuing carrier. If the
                passengers journey involves an ultimate destination or stop in a country other than country of
                departure the Warsaw convention may be applicable and the convention governs and in most cases
                limits the liability of carriers for death or personal injury and in respect of loss of or damage to
                baggage.</p>
            <p class="error">Dont Forget to purchase travel insurance for your Visit. Please Contact your travel
                agent to purchase travel insurance</p>
        </div>
    </div>
    <div class="ticket_footer rflex jcsb">
        <p>&copy; Copyright 2017 <a href="{{ url('') }}">Goingbo</a>. All rights reserved</p>
        <img src="{{ url('images/cards.png') }}" alt="">
    </div>
</div>