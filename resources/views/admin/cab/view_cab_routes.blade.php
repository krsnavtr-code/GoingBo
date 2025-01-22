
@extends('admin.components.layout')
@push('css')
<style>

    .table-container {
        max-width: 100%;
        overflow-x: auto;
        padding: 20px; /* Add padding for aesthetics */
        box-shadow: 0 0 10px 0 #00000033;
        border-radius: 8px;
        background: white;
    }

    table {
        width: 100%;
        white-space: nowrap;
    }

    table :is(th, td) {
        text-align: left;
        padding: 5px 10px;
    }

    table th:first-of-type {
        width: 80px;
    }

    table td.imp {
        font-weight: 600;
        color: var(--error);
        font-size: 1.4rem;
    }

    table td:has(i.icon) {
        display: flex;
        gap: 4px;
    }

    table td i.icon {
        width: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        aspect-ratio: 1;
    }
</style>
@endpush
@section('main')
    <main>
        
        <div>
            <h1 class="page_title">View Cab Routes </h1>
            <p class="page_sub_title">All Cab Routes shown by our team</p>
        </div>
        <div class="table-container">
        <section>
            <table>
                <thead>
                    <tr>
                        <th>Sr.No.</th>
                        <th> Owner Name </th>
                        <th>Owner Email</th>
                        <th>Owner Contact</th>
                        <th> Driver Name </th>
                        <th> Vehicle Number </th>                       
                        <th>From Location</th>
                        <th>To Location</th>
                        <th> Night Halt</th>
                        <th>Price</th>     
                        <th> Free Cancellation </th>
                        <th> Coupon </th>                  
                    </tr>
                </thead>
                <tbody>
                    @foreach ($routes as $i=>$route)
                        <tr>
                            <td>{{$i+1}}</td>
                            <td>{{$route['cab']['owner_name']}}</td>
                            <td>{{$route['cab']['owner_email']}}</td>
                            <td>{{$route['cab']['owner_contact']}}</td>
                            <td>{{$route['cab']['driver_name']}}</td>
                            <td>{{$route['cab']['vehicle_number']}}</td>
                            <td>{{$route['from_city']['city_name']}}</td>
                            <td>{{$route['to_city']['city_name']}}</td>
                            <td> {{ $route['night_halt'] ? "Yes" : "No"}}</td>
                            <td>{{$route['price']}}</td>
                            <td> {{$route['free_cancel'] }} </td>
                            <td> {{$route['coupon'] ? $route['coupon'] : "Null" }} </td> 
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        </div>
    </main>
@endsection