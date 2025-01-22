@extends('admin.components.layout')
@push('css')
    <link rel="stylesheet" href="{{ url('css/admin/index.css') }}">
@endpush
@section('main')
    <main>
        <section class="profile_banner">
            <img src="{{ url('/images/user_bg.jpg') }}" alt="">
        </section>
        <div class="profile_panel cflex aic">
            <div class="profile_pic">
                <div class="profile_pic_wrapper">
                    <img src="{{ url('/images/profiles/' . ($admin['emp_profile'] ?? ($admin['emp_gender'] == 'male' ? 'profile 1.jpg' : 'profile 8.jpg'))) }}"
                        alt="">
                </div>
                <i class="icon fa-regular fa-camera"></i>
            </div>
            <div class="details cflex aic">
                <h3><i class="fa-regular fa-at"></i> {{ Session::get('admin_username') }}</h3>
                <h5 style="text-transform: capitalize">{{ $admin['emp_name'] }}</h5>
                <p>हंबा-हंबा, रंबा-रंबा, कांबा-कांबा, तुबां-तुबां, बंबा-बंबा</p>
            </div>
        </div>
    </main>
@endsection
