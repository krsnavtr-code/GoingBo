@extends('user.components.layout')
@push('css')
<link rel="stylesheet" href="{{ url('css/user_css/package.css') }}">
<link rel="stylesheet" href="{{ url('css/user_css/review.css') }}">

@endpush
@section('main')
<main>
    <div class="my-row">
        <form action="{{ url('packages/checkout') }}" method="post" class="review-form">
            @csrf
            <h2>Package Details</h2>
            <div class="panel">
                <div class="between">
                    <div>
                        <h6 class="hotel_name">{{ $package['title'] }}</h6>
                        <p>
                            <span>{{ $package['night'] + 1 }}days</span>
                            - <span>{{ $package['night'] }} nights</span>
                        </p>
                    </div>
                    <div class="date-box">
                        <p for="dep_date">Date to start</p>
                        <input type="date" name="checkin" required id="dep_date" min="{{ now()->toDateString() }} " style="width: 150px;">
                        <input type="hidden" name="pkg_id" value="{{ $package['id'] }}">
                    </div>
                </div>
            </div>
            <h2>User Details</h2>
            <div class="panel">
                <div class="fields">
                    <input type="text" name="fname" maxlength="40" placeholder="First Name" pattern="[A-Za-z\s]*" required>
                    <input type="text" name="lname" maxlength="40" placeholder="last Name" pattern="[A-Za-z\s]*" required>
                </div>
            </div>
            <h2>Contact Details</h2>
            <div class="panel">
                <div class="fields">
                    <input type="tel " name="contact[contact]" pattern="[0-9]{10}" maxlength="10" placeholder="enter phone no." required>
                    <input type="email" name="contact[mail]" maxlength="40" placeholder="enter email address" required>
                </div>
                <p>If you are not logged in these details will be used to create your account</p>
            </div>
            <h2>Address Details</h2>
            <div class="panel fields">
                <input type="text" name="address[address]" maxlength="20" placeholder="enter address" required>
                <input type="text" name="address[city]" maxlength="20" placeholder="enter city" required>
                <input type="text" name="address[state]" maxlength="20" placeholder="enter state" required>
                <input type="text" name="address[country]" list="countries" placeholder="enter country" maxlength="20" required>
            </div>
            <h2>GST Details (Optional)</h2>
            <div class="panel fields">
                <input type="text" name="company[companyName]" pattern="[A-Za-z\s]*" placeholder="company name" maxlength="40">
                <input type="text" name="company[companyGST]" pattern="[0-9]*" placeholder="enter GST number" maxlength="40">
                <input type="email" name="company[companyMail]" placeholder="company email" maxlength="40">
                <input type="tel " pattern="[0-9]{10}" name="company[companyContact]" placeholder="enter company contact" maxlength="10">
                <input type="text" name="company[companyAddress]" placeholder="enter company address" maxlength="40">
            </div>
            <button type="submit" class="review-btn">Review Order</button>
        </form>
        <aside class="sidebar">
            <div class="side_panels">
                <div class="panel query-box">
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
{{-- <script>
        today = new Date;
        $("#dep_date").set("min", `${today.getFullYear()}-${today.getMonth()+1}-${today.getDate()}`);
    </script> --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the input element
        var dep_date = document.getElementById('dep_date');

        // Set the minimum date to the current date
        dep_date.min = new Date().toISOString().split('T')[0];
    });
</script>
@endpush