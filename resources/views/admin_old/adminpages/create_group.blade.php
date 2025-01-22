@extends('admin.components.layout')
@section('main')
    <main>
        @include('admin.components.response')
        <form action="{{Request::get('current_page')}}" method="post">
            <div>
                @csrf
                <h4 class="form_title">Create Admin Page Group</h4>
                <p class="form_sub_title">Let's Organize pages in group</p>
            </div>
            <section>
                <div class="field">
                    <label for="">Group Title</label>
                    <input type="text" name="group_title">
                </div>
                <div class="field">
                    <label for="">Group Index</label>
                    <input type="number" name="group_index">
                </div>
            </section>
            <button type="submit">Proceed</button>
        </form>
    </main>
@endsection
