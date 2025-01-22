@extends('admin.components.layout')
@section('main')
    <main>
        @include('admin.components.response')
        <form action="{{ Request::get('current_page') }}" method="post">
            <div>
                @csrf
                <h4 class="form_title">Create Admin Page</h4>
                <p class="form_sub_title">Let's create new page</p>
            </div>
            <section>
                <div class="field_group">
                    <div class="field">
                        <label for="">Page Title</label>
                        <input type="text" name="page_title">
                        @error('page_title')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label for="">Page Url</label>
                        <input type="text" name="page_url">
                        @error('page_url')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="field">
                    <label for="">Page Group</label>
                    <select name="page_group" id="">
                        <option value=""> -- None -- </option>
                        @foreach ($groups as $group)
                            <option value="{{ $group['id'] }}">
                                {{ $group['pagegroup_title'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="field_group" style="margin-top:20px;">
                    <div class="field checkbox">
                        <input type="checkbox" name="can_display" id="x1" value="1">
                        <label for="x1">Can Display</label>
                    </div>
                    <div class="field checkbox">
                        <input type="checkbox" name="page_status" id="x2"  value="1" checked>
                        <label for="x2">Is page active</label>
                    </div>
                </div>
            </section>
            <button type="submit">Proceed</button>
        </form>
    </main>
@endsection
