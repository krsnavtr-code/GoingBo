@extends('user.components.layout')
@section('main')
    <main>
        <form action="" method="post">
            @csrf
            <input type="date" name="date">
            <input type="text" name="to" list="to" oninput="show_suggestions(this)">
            <datalist id="to"></datalist>
            <input type="text" name="from" list="from" oninput="show_suggestions(this)">
            <datalist id="from"></datalist>
            <button type="submit">Submit</button>
        </form>
    </main>
@endsection
@push('js')
    <script>
        let currentReq = null;

        function show_suggestions(node) {
            if (currentReq) currentReq.abort();
            currentReq = ajax({
                url:"{{url('api/busstops')}}/"+node.value,
                success: (res) => {
                    res = JSON.parse(res);
                    $("#" + node.get('list')).innerHTML = '';
                    res.forEach(city => {
                        $("#" + node.get('list')).append(
                            `<option value="${city.id}">${city.cityname}</option>`);
                    });
                }
            });
        }
    </script>
@endpush
