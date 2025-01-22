@extends('admin.business.layouts.app')

@section('content')
<div class="login-container">
    <h2>GoingBo Business Admin</h2>
    <form action="{{ url('admin/business-login') }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit" class="btn">Login</button>
    </form>
</div>
@endsection
