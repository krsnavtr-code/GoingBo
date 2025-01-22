@extends('admin.components.layout')
@section('main')
    <main>
        @include('admin.components.response')
        <div>
            <h1 class="page_title">Edit Web Page</h1>
            <p class="page_sub_title">Remember page slug not exists</p>
        </div>
        <form action="{{ url($page['current']) }}" method="post">
            <div class="hidden">@csrf
                <input type="hidden" name="webpageId" value="{{$webpage['id']}}">
            </div>
            @include('admin.components.seo', ['page' => $webpage])
            <button type="submit">Proceed</button>
        </form>
    </main>
@endsection
