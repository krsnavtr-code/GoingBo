@extends('user.components.layout')
@push('css')
    <style>
        .ticket {
            border: 2px solid var(--fv_prime);
            padding: 20px;
            background: white;
            margin: 20px;
            min-width: 1000px;
        }

        table {
            border: 2px solid #e0e1ea;
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 15px;
        }

        table thead th {
            background: #f1f0f0;
            print-color-adjust: exact;
        }

        table :is(td, th) {
            padding: 5px 0 7px;
            text-align: center;
        }

        table td {
            font-weight: 500;
        }

        .ticket_header {
            margin-bottom: 20px;
        }

        .ticket_header img {
            height: 100px;
            object-fit: contain;
        }

        .ticket_header h5 {
            font-weight: 700;
        }

        .ticket_header p {
            font-size: 1.4rem;
            font-weight: 500;
            margin-top: 3px;
        }

        .ticket_header p:first-of-type {
            margin-top: 10px;
        }

        .ticket_header p span:first-of-type {
            color: var(--gray_700);
        }

        td:has(.fare) {
            padding-left: 20px;
        }

        .fare {
            text-align: left;
            flex-grow: 1;
            padding-inline: 30px;
        }

        .fare p {
            margin-bottom: 5px;
        }

        .fare :is(p, b) {
            display: flex;
            justify-content: space-between;
        }

        .ticket>p {
            margin-bottom: 20px;
            font-weight: 600;
            font-size: 1.4rem;
        }

        p.error {
            color: var(--error);
            font-weight: 700;
        }

        .ticket_footer {
            padding-top: 20px;
            border-top: 2px solid var(--fv_prime);
        }

        .ticket_footer img {
            height: 30px;
        }

        @media print {
            body {
                visibility: hidden;
                -webkit-print-color-adjust: exact;
            }

            #printable {
                visibility: visible;
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>
@endpush
@section('main')
    @include('user.components.book_opts')
    <main class="cflex aic">
        <div class="ticket">
            <div class="ticket_header rflex jcsb aic">
                <div class="company_details">
                    <h5>Goingbo Tours PVT. LTD.</h5>
                    <p><span>Regd Office: </span><span>B 93, SECTOR 64 NOIDA, Noida 201301</span></p>
                    <p><span>Email: </span><span><a href="mailto:info@goingbo.com">info@goingbo.com</a></span></p>
                    <p><span>Web: </span><span><a href="https://www.goingbo.com">https://www.goingbo.com</a></span></p>
                    <p><span>Phone: </span><span><a href="tel:+01204561642">01204561642</a></span></p>
                    <p><span>State: </span><span>Uttar Pradesh</span></p>
                </div>
                <div class="company_logo">
                    <img src="{{ url('/images/logo.png') }}" alt="">
                </div>
                <div class="booking_details">
                    <p><span>Booking Id : </span><span>{{$token}}</span></p>
                </div>
            </div>
            <div class="passenger_details">
                <table>
                    <thead>
                        <tr>
                            <th>Passenger Name</th>
                            <th>No. of guests</th>
                            <th>Token</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-transform: capitalize">{{ $person['fname'] }} {{ $person['lname'] }}</td>
                            <td>{{$token}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="flight_details">
                <table>
                    <thead>
                        <tr>
                            <th>Taxi</th>
                            <th>Travel Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $taxi['cab_type'] }} <span style="font-size: 0.8em">({{ $taxi['cab_model'] }})</span>
                            </td>
                            <td>{{ $taxi['travelldate'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="payment_details">
                <table>
                    <thead>
                        <tr>
                            <th>Payment Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="rflex aic">
                                <p>This is an Electronic ticket. Please carry a positive identification for Check in.</p>
                                <div class="cflex fare">
                                    <p><span>Fare:</span><span>‌₹ {{ $f = $taxi['total_price'] }}</span>
                                    </p>
                                    {{-- <p><span>K3/GST:</span><span>‌₹ --}}
                                            {{-- {{ $t = floor(($room['roomofferprice'] * 18) / 100) }}</span> --}}
                                    {{-- </p> --}}
                                    <p><span>Fee & Surcharge</span><span>‌₹ 0</span></p>
                                    <b><span>Total Amount:</span><span>‌₹ {{ $f }}</span></b>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <p>Carriage and other services provided by the carrier are subject to conditions of carriage which hereby
                incorporated by reference. These conditions may be obtained from the issuing carrier. If the passengers
                journey involves an ultimate destination or stop in a country other than country of departure the Warsaw
                convention may be applicable and the convention governs and in most cases limits the liability of carriers
                for death or personal injury and in respect of loss of or damage to baggage.</p>
            <p class="error">Dont Forget to purchase travel insurance for your Visit. Please Contact your travel agent to
                purchase travel
                insurance</p>
            <div class="ticket_footer rflex jcsb">
                <p>&copy; Copyright 2017 <a href="{{ url('') }}">Goingbo</a>. All rights reserved</p>
                <img src="{{ url('images/cards.png') }}" alt="">
            </div>
        </div>
        <button id="print_ticket" style="padding: 9px 30px;font-weight: 600;">Print Ticket</button>
    </main>
@endsection
@push('js')
    <script>
        $("#print_ticket").addEventListener("click",function(){
            $(".ticket")[0].set("id","printable");
            window.print();
        });
    </script>
@endpush
