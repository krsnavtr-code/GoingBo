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

        .table-container{
            max-width: 100%;
            overflow-x: auto;
            padding: 20px;
            border-radius: 8px;
            background: white;
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

        .truncate {
        max-width: 200px; /* Adjust this value according to your preference */
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        }


    </style>
@endpush
@section('main')
    <main>
        @include('admin.components.response')
        <div>
            <h1 class="page_title">View Holiday Packages  </h1>
            <p class="page_sub_title">All Packages shown by our team</p>
            
        </div>
        <section>
            <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Sr.No.</th>
                        <th> Title </th>
                        <th> Image </th>
                        <th> Short Desc </th>
                        <th> Price </th>
                        <th> Slug </th>
                        <th>Night</th>
                        <th> Package head</th>
                        <th> Package head 2</th>
                        <th> Package head 3 </th>
                        <th> Package Tags </th>
                        <th> State Name </th>
                        <th> Country Name </th>
                        <th> Package Categories</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($packages as $i => $package)
                        <tr >
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $package['title'] }}</td>
                            <td> <img src="{{ asset('images/package/'. $package['image']) }}" alt="5 Terre" style="width:200px; border-radius: 50%;">
                            </td>
                            <td class="truncate">{{ $package['short_des'] }}</td>
                            <td>{{ $package['price'] }}</td>
                            
                            
                            <td>{{ $package['slug'] }}</td>
                            
                            <td>{{ $package['night'] }}</td>
                            <td class="truncate">{{ $package['pckg_head'] }}</td>
                            <td class="truncate">{{ $package['pckg_head_2'] }}</td>
                            <td class="truncate">{{ $package['pckg_head_3'] }}</td>
                            <td>{{ $package['pckg_tags'] }}</td>
                            <td>{{ $package['state_name'] }}</td>
                            <td>{{ $package['country_name'] }}</td>
                            <td>{{ $package['pckg_categories'] }}</td>
                          
                            <td>
                                
                                <a href="{{ ("holidaypackages/activities/".$package['id']) }}">  <i class="icon fa-solid fa-shuffle"> </i>  </a>
                               
                                <button class="edit"> <a href="{{"holidaypackages/edit/".$package['id']}}"> Edit  </a></button>
                                
                                {{-- <button class="delete"> <a href="{{"cab/delete/".$package['id']}}"  onclick="return confirm('Are you sure you want to delete this Package Details?');"> Delete </a> </button>  --}}
     
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </section>
    </main>
@endsection
@push('js')


    
@endpush
