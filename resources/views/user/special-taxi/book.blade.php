@extends('user.components.layout')
@push('css')
    <style>
        .results {
            padding: 20px;
            gap: 20px;
        }

        .sidebar {
            width: 280px;
            gap: 20px;
            height: fit-content;
            position: sticky;
            top: 100px;
        }

        .main_section {
            flex-grow: 1;
            gap: 30px;
        }

        .panel {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px 0 #00000033;
        }

        .fields {
            display: flex;
            gap: 10px;
            margin-top: 5px;
        }

        .fields .field {
            display: flex;
            flex-direction: column;
        }

        .fields .field label {
            font-size: 1.3rem;
            margin-bottom: 3px;
        }

        .fields .field:has(input, select) {
            flex-grow: 1;
        }

        .fields .field :is(input, select) {
            padding: 5px 10px;
        }

        form button {
            padding: 9px;
            font-weight: 600;
            font-size: 1.5rem;
            background: var(--fv_prime);
            border-radius: 6px;
            border: none;
        }

        .query_panel button,
        .booking_panel button {
            margin-top: 15px;
            border-radius: 100px;
            width: 100%;
            padding: 8px;
            border: none;
            font-weight: 600;
            color: white;
            text-transform: capitalize;
            background: var(--fv_sec);
        }

        .query_panel h5 {
            font-size: 1.6rem;
            margin-bottom: 5px;
        }

        .query_panel p {
            font-size: 1.2rem;
            color: var(--gray_500);
        }

        .query_panel button {
            background: var(--fv_prime);
        }

        .taxi .mid {
            flex-grow: 1;
            border: 1px dashed;
            position: relative;
            margin: 20px;
        }

        .taxi .mid i {
            position: absolute;
            top: 0;
            left: 0;
            transform: translate(0%, -100%);
            animation: move 50s linear 1;
        }

        .taxi .mid p {
            position: absolute;
            bottom: -20px;
            left: 50%;
            transform: translate(-50%, 10px);
        }

        @keyframes move {
            to {
                left: 100%;
            }
        }
    </style>
@endpush
@section('main')
    @include('user.components.book_opts')
    <main>
        <div class="results rflex">
            <form action="{{ url('special-taxi/checkout') }}" method="post" class="main_section cflex">
                @csrf
                <input type="hidden" name="taxi_id" value="{{$taxi['id']}}">
                <div class="panel">
                    <h5>{{$taxi['cab_type']}} Details ({{$taxi['cab_model'] ."  " .$taxi['car_ac_nonac']}})</h5>
                    <div class="rflex taxi aic" style="padding:20px;">
                        <div class="from">{{ $taxi['from_destination'] }}</div>
                        <div class="mid">
                            <p><span>{{ $taxi['overall_hours'] }}</span>Hours
                                <span>{{ $taxi['overall_minutes'] }}</span>
                            </p>
                            <i class="fa-solid fa-car-side"></i>
                        </div>
                        <div class="to">{{ $taxi['to_destination'] }}</div>
                    </div>
                </div>
                <div class="panel">
                    <h5 class="panel_title">User Details</h5>
                    <div class="" style="margin-top:10px">
                        <h6>User Details</h6>
                        <div class="fields">
                            <div class="field">
                                <label for="">First Name</label>
                                <input type="text" name="fname" required>
                            </div>
                            <div class="field">
                                <label for="">Last Name</label>
                                <input type="text" name="lname" required>
                            </div>
                        </div>
                    </div>
                    <div class="contact_details traveller" style="margin-top:20px">
                        <h6>Contact Details</h6>
                        <div class="fields">
                            <div class="field">
                                <label for="">Contact</label>
                                <input type="text" name="contact[contact]" required>
                            </div>
                            <div class="field">
                                <label for="">E-mail</label>
                                <input type="email" name="contact[mail]" required>
                            </div>
                        </div>
                        <p style="font-size: 1.2rem;font-weight:600;color:var(--error);margin-top:7px;">If you are not
                            logged in these
                            details will be used to create your account</p>
                    </div>
                    <div class="address_details traveller" style="margin-top:20px">
                        <h6>Address Details</h6>
                        <div class="fields">
                            <div class="field">
                                <label for="">Address</label>
                                <input type="text" name="address[address]" required>
                            </div>
                            <div class="field">
                                <label for="">City</label>
                                <input type="text" name="address[city]" required>
                            </div>
                            <div class="field">
                                <label for="">State</label>
                                <input type="text" name="address[state]" required>
                            </div>
                            <div class="field">
                                <label for="">Country</label>
                                <input type="text" name="address[country]" list="countries" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel">
                    <h5 class="panel_title">GST Details (Optional)</h5>
                    <div class="gst_details traveller">
                        <div class="fields">
                            <div class="field">
                                <label for="">Company Name</label>
                                <input type="text" name="company[companyName]" id="">
                            </div>
                            <div class="field">
                                <label for="">GST Number</label>
                                <input type="text" name="company[companyGST]" id="">
                            </div>
                        </div>
                        <div class="fields">
                            <div class="field">
                                <label for="">Company E-mail</label>
                                <input type="text" name="company[companyMail]" id="">
                            </div>
                            <div class="field">
                                <label for="">Company Cotact</label>
                                <input type="text" name="company[companyContact]" id="">
                            </div>
                        </div>
                        <div class="fields">
                            <div class="field">
                                <label for="">Company Address</label>
                                <input type="text" name="company[companyAddress]" id="">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit">Review Order</button>
            </form>
            <div class="sidebar cflex">
                <div class="panel query_panel">
                    <h5>Raise A Query</h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates, vel.</p>
                    <button>Raise A Query</button>
                </div>
            </div>
        </div>
    </main>
@endsection
