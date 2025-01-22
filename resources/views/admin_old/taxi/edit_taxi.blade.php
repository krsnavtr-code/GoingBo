@extends('admin.components.layout')
@section('main')
    <main>
        @include('admin.components.response')
        <form action="{{ Request::get('current_page') }}" method="post">
            <div>
                @csrf
                <input type="hidden" name="Id" value="{{}}">
                <h4 class="form_title">Edit Admin Page</h4>
                <p class="form_sub_title">Edit existing admin page</p>
            </div>
            <section></section>
            <button type="submit">Proceed</button>
        </form>
    </main>
@endsection
