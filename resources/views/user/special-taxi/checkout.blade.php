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

        button {
            padding: 9px;
            font-weight: 600;
            font-size: 1.5rem;
            background: var(--fv_prime);
            border-radius: 6px;
            border: none;
        }

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
                <input type="hidden" name="taxi_id" value="{{ $taxi['id'] }}">
                <div class="panel">
                    <h5>{{ $taxi['cab_type'] }} Details ({{ $taxi['cab_model'] . '  ' . $taxi['car_ac_nonac'] }})</h5>
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
            </form>
            <div class="sidebar cflex">
                <div class="panel">
                    <h5>Fair Summary</h5>
                    <div class="rflex jcsb">
                        <h6>Total</h6>
                        <h6>{{ $total }}</h6>
                    </div>
                </div>
                <button type="submit" id="razorPay">Checkout</button>
                <div class="panel query_panel">
                    <h5>Raise A Query</h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates, vel.</p>
                    <button>Raise A Query</button>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('js')
    @includeIf('user.components.razorPay', ['order' => $order, 'redirect' => url('special-taxi/ticket')])
@endpush