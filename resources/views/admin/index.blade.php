@extends('admin.components.layout')
@section('main')
    <main style="margin-top: 10vh;">
        <img src="{{ asset('images/logo.png') }}" alt="logo" style="height: 20vh; object-fit: cover; margin: 0 auto; ">
        <h1 style="text-align: center; margin-top: 20px;"> GoingBo Admin Portal </h1>
        <div class="admin-user-name">
            
        </div>
    </main>
    <script src="{{ url('js/master.js') }}"></script>
@endsection