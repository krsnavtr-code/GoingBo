@extends('admin.components.layout')
@push('css')
    <style>
        section:has(table) {
            padding: 20px;
            box-shadow: 0 0 10px 0 #00000033;
            border-radius: 8px;
            background: white;
            flex-grow: 1;
        }

        table {
            width: 100%;
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
        
        button{          
            border: none;
            padding: 0px 9px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }
        button.edit{
            background-color: #0aa3c2;
            color: white;
        }
        button.delete{
            background-color: #d32f2f;
            color: white;
        }

        

        table tr button {
            width: 100%;
            height: 100%;
            border: none;
            padding: 6px;
            font-weight: 600;
            border-radius: 5px;
        }
        table tr .disable_btn {
            display: none;
            background: rgba(var(--error_rgb), 0.5);
        }
        table tr .active_btn {
            background: rgba(var(--success_rgb), 0.5);
        }
                tr.disabled {
            color: #00000066;
        }
        tr.disabled .disable_btn {
            display: unset;
        }
        tr.disabled .active_btn {
            display: none;
        }


    </style>
@endpush
@section('main')
    <main>
        @include('admin.components.response')
        <div>
            <h1 class="page_title">View Cabs </h1>
            <p class="page_sub_title">All Cabs shown by our team</p>
            
        </div>
        <section>
            <table>
                <thead>
                    <tr>
                        <th>Sr.No.</th>
                        <th>Owner</th>
                        <th> Company </th>
                        <th> Driver </th>
                        <th>Driver Photo </th>
                        <th>Model</th>
                        <th>Vehicle</th>
                        <th> Vehicle Photo</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cabs as $i => $cab)
                        <tr @class(['cab','disabled' => !$cab['cab_status']])>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $cab['owner_name'] }}</td>
                            <td>{{ $cab['company_name'] }}</td>
                            <td>{{ $cab['driver_name'] }}</td>
                            <td> <img src="{{ asset('images/cab assets/driver/'. $cab['driver_img']) }}" alt="5 Terre" style="width:200px; border-radius: 50%;">
                            </td>
                            
                            <td>{{ $cab['vehicle_model'] }}</td>
                            
                            <td>{{ $cab['vehicle_number'] }}</td>
                            <td> <img src="{{ asset('images/cab assets/vehicle/'. $cab['vehicle_img']) }}" alt="5 Terre" style="width:200px; border-radius: 50%;">                       
                            </td>
                            <td>
                                <a href="tel:+{{ $cab['owner_contact'] }}">
                                    <i class="icon fa-solid fa-phone"></i>
                                </a>
                                <a href="mailto:{{ $cab['owner_email'] }}">
                                    <i class="icon fa-solid fa-envelope"></i>
                                </a>
                                <a href="{{url("admin/cab/route/add/".$cab['id']) }}">  <i class="icon fa-solid fa-shuffle"> </i>  </a>
                                <div class="" onclick="toggle_status(this,{{$cab['id']}})">
                                    <button class="disable_btn" title="Cab is disabled">Disabled</button>
                                    <button class="active_btn" title="Cab is active">Active</button>
                                </div>
                                
                                <button class="edit"> <a href="{{"cab/edit/".$cab['id']}}"> Edit  </a></button>
                                
                                {{-- <button class="delete"> <a href="{{"cab/delete/".$cab['id']}}"  onclick="return confirm('Are you sure you want to delete this Cab Details?');"> Delete </a> </button>  --}}
     
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>
@endsection
@push('js')


    <script>
        function toggle_status(node, cabId) {
            ajax({
                url: `{{ url('admin/cab/toggle') }}/${cabId}`,
                success: (res) => {
                    res = JSON.parse(res);
                    if (res['success']) {
                        let cab = node.closest(".cab");
                        cab.hasClass("disabled") ? cab.removeClass("disabled") : cab.addClass("disabled");
                        alert(res['msg']);
                    } else {
                        alert(res['msg'] ?? "Unknown Error Occured");
                    }
                }
            })
        }
    </script>
    
@endpush
