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
            <h1 class="page_title">View Holiday Package Activites  </h1>
            <p class="page_sub_title">All Packages Activities shown by our team</p>
            
        </div>
        <section>
            <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Sr.No.</th>
                        <th> Day </th>
                        <th> Image </th>
                        <th> Type Of Transport </th>
                        <th> Duration </th>
                        <th> Hotel Name </th>
                        <th> Star </th>
                        <th> Area </th>
                        <th> Hotel Include </th>
                        <th> Activity </th>
                        <th> Activity Desc </th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($packagedays as $i => $packageday)
                        <tr >
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $packageday['day'] }}</td>
                            <td> <img src="{{ asset('images/package/'. $packageday['pck_img']) }}" alt="5 Terre" style=" height: 110px;  max-width: 160px;">
                            </td>
                            <td class="truncate">{{ $packageday['type_of_transport'] }}</td>
                            <td>{{ $packageday['duration'] }}</td>
                            
                            
                            <td>{{ $packageday['hotel_name'] }}</td>
                            
                            <td>{{ $packageday['star'] }}</td>
                            <td>{{ $packageday['area'] }}</td>
                            <td>{{ $packageday['hotel_include'] }}</td>
                            <td>{{ $packageday['activity'] }}</td>
                            <td class="truncate">{{ $packageday['activity_des'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </section>


        <div>
            <h1 class="page_title">Holiday Packages Activities Details</h1>
            <p class="page_sub_title">Let's add new holiday package activities in group</p>
        </div>
        
        <form action=""  method="post" enctype="multipart/form-data">
            <div class="hidden">@csrf</div>
            <section>
                <span class="page_title"> Package Activity Details </span>
                <div class="field_group">
                    <div class="field">
                        <label for="day"> Activity Day </label>
                        <input type="text" name="day" id="day" pattern="[A-Za-z\s]+" placeholder="Cochin Arrival" autofocus required >
                    </div>
                    <div class="field">
                        <label for="pck_img"> Activity Image </label>
                        <input type="file" name="pck_img" id="pck_img" accept="image/*"  required>
                        <small>(Maximum file size: 1MB)</small> 
                        
                    </div>
                </div>
                <div class="field_group">
                    <div class="field">
                        <label for="type_of_transport"> Activity Type of Transport </label>
                        <input type="text" name="type_of_transport" id="type_of_transport" placeholder="Sedan AC/ Swift Dzire"  required> 
                    </div>
                    <div class="field">
                        <label for="duration"> Activity Duration </label>
                        <input type="number" name="duration" id="duration" min="1" max="10" required>
                    </div>
                </div>
               
                <div class="field_group">
                    <div class="field">
                        <label for="hotel_name"> Activity Hotel Name  </label>
                        <input type="text" name="hotel_name" id="hotel_name"   required>
                    </div>
                    <div class="field">
                        <label for="star"> Activity Hotel Star </label>
                        <input type="number" name="star" id="star" min="1"  max="7" required>
                    </div>
                    
                </div>
                
            </section>
            <section>
                
                <div class="field_group">
                    <div class="field">
                        <label for="area"> Activity Hotel Area </label>
                        <input type="text" name="area" id="area"  required>
                    </div>
                    <div class="field">
                        <label for="hotel_include"> Activity Hotel include </label>
                        <input type="text" name="hotel_include" id="hotel_include" placeholder="Free Wi-Fi, Restaurant, Bar, Room service"  required>
                    </div>
                </div>
                <div class="field_group">
                    <div class="field">
                        <label for="activity"> Activity Name </label>
                        <input type="text" name="activity" id="activity" placeholder="1. Periyar National Park, 2. Chellarkovil"  required>
                    </div>
                </div>
                <div class="field_group">
                    <div class="field">
                        <label for="activity_des"> Activity Description </label>
                        <textarea type="text" name="activity_des" id="activity_des"  required>
                        </textarea>
                    </div>
                </div>
                
                        
                
            </section>

          
            
                
            <button type="submit">Submit</button>
        </form>
    </main>
@endsection
@push('js')


<script src="https://cdn.tiny.cloud/1/rcimor377yz9qes7ugd18in1cn1ie9593dr4y5ccshxqczcx/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <script>

        tinymce.init({
            selector: 'textarea',  // change this value according to your HTML
            plugins: 'link',
            link_default_target: '_blank',
            
        });

        document.getElementById('pck_img').addEventListener('change', function() {
        const file = this.files[0];
        const maxSize = 1048576; // 1MB in bytes
        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

        // Check file type
        if (!allowedTypes.includes(file.type)) {
            alert('Please select a valid image file (JPEG, PNG, GIF)');
            this.value = ''; // Clear the file input
            return false;
        }

        // Check file size
        if (file.size > maxSize) {
            alert('Maximum file size exceeded (1MB)');
            this.value = ''; // Clear the file input
            return false;
        }
        });
        
    </script>

    
@endpush
