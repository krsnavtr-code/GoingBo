@extends('user.components.layout')
@push('css')
<link rel="stylesheet" href="{{ url('css/user_css/package.css') }}">
<link rel="stylesheet" href="{{ url('css/user_css/checkout.css') }}">
<style>
    .between {
        display: flex;
        justify-content: space-between;
    }

    .side_panels {
        margin: 0;
    }

    section {
        width: 100%;
    }

    .booking-box {
        display: block;
    }

    .book_opts {
        display: flex;
        justify-content: space-evenly;
    }

    .book_opts p {
        color: #fff;
    }
</style>
@endpush
@section('main')
@include('user.components.book_opts')
<main>
    <div class="my-row">
        <section>
            <form action="{{ url('packages/checkout') }}" method="post" class="main-box">
                @csrf
                <div class="panel">
                    <h5>Package Details</h5>
                    <h6 class="title">{{ $package['title'] }}</h6>
                </div>
            </form>
        </section>
        <aside class="sidebar">
            <div class="side_panels">
                <div class="booking-box panel">
                    <h5>Fair Summary</h5>
                    <div class="between">
                        <h6>2 Person</h6>
                        <p>
                            <i class="fa-solid fa-indian-rupee-sign fa-sm"></i>
                            <span>{{ $total = $pkg_total }}</span>
                        </p>
                    </div>
                    <div class="between">
                        <p>Gst (18%)</p>
                        <p>
                            <i class="fa-solid fa-indian-rupee-sign fa-sm"></i>
                            <span>{{ $gst = floor(($total * 18) / 100) }}</span>
                        </p>
                    </div>
                    <div class="total">
                        <div class="between">
                            <h5>Total</h5>
                            <h5>
                                <i class="fa-solid fa-indian-rupee-sign fa-sm"></i>
                                <span>{{ $pkg_total + $gst }}</span>
                            </h5>
                        </div>
                    </div>
                    <button type="submit" id="razorPay">Checkout</button>
                </div>
                <!-- query-box -->
                <div class="query-box panel">
                    <h5>Raise A Query</h5>
                    <p>Having anything in mind, feel free to write us. We are here for you. We will connect you back as soon
                        as possible</p>
                    <button>Raise A Query</button>
                </div>
            </div>
        </aside>
    </div>
</main>
@endsection
@push('js')
@includeIf('user.components.razorPay', ['order' => $order, 'redirect' => url('packages/ticket')])
@endpush