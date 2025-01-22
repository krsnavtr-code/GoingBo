@extends('admin.components.layout')
@section('main')
    <main>
        @include('admin.components.response')
        <div>
            <h1 class="page_title">Add Web Page</h1>
            <p class="page_sub_title">Remember page slug not exists</p>
        </div>
        <form action="{{ url($page['current']) }}" method="post">
            <div class="hidden">@csrf</div>
            @include('admin.components.seo')
            <button type="submit">Add Webpage</button>
        </form>
    </main>
@endsection
