
@extends('admin.components.layout')
@section('main')
    <main>
        @include('admin.components.response')
        <div>
            <h1 class="page_title">Edit Holiday Packages  Details</h1>
            <p class="page_sub_title">Let's edit holiday package in group</p>
        </div>
        
        <form action="" method="post" enctype="multipart/form-data">
            <div class="hidden">@csrf</div>
            <section>
                <span class="page_title"> Package Details </span>
                <div class="field_group">
                    <div class="field">
                        <label for="title"> Package Title </label>
                        <input type="text" name="title" id="title" pattern="[A-Za-z\s]+" value="{{ $package['title'] }}" autofocus required >
                    </div>
                    <div class="field">
                        <label for="image"> Package Image </label>
                        <input type="file" name="image" id="image" accept="image/*"  >
                        <small>(Maximum file size: 1MB)</small> 
                        
                    </div>
                </div>
                <div class="field_group">
                    <div class="field">
                        <label for="short_des">Package Short Description </label>
                        <input type="text" name="short_des" id="short_des"  value="{{ $package['short_des'] }}"  required> 
                        
                    </div>
                </div>
                <div class="field_group">
                    <div class="field">
                        <label for="price"> Price </label>
                        <input type="number" name="price" id="price" min="1" value="{{ $package['price'] }}" required>
                    </div>
                </div>
                <div class="field_group">
                    <div class="field">
                        <label for="slug"> Package Slug </label>
                        <input type="text" name="slug" id="slug" placeholder="fiji-honeymoon" value="{{ $package['slug'] }}" required>
                    </div>
                    <div class="field">
                        <label for="night"> Package Nights </label>
                        <input type="number" name="night" id="night" min="1" value="{{ $package['night'] }}" required>
                    </div>
                </div>
                
            </section>
            <section>
                
                <div class="field_group">
                    <div class="field">
                        <label for="pckg_head"> Package Head </label>
                        <input type="text" name="pckg_head" id="pckg_head"  value="{{ $package['pckg_head'] }}"  required>
                    </div>
                </div>
                <div class="field_group">
                    <div class="field">
                        <label for="pckg_head_2"> Package Description 2 </label>
                        <textarea type="text" name="pckg_head_2" id="pckg_head_2"    required>
                            {{ $package['pckg_head_2'] }}
                        </textarea>
                    </div>
                </div>
                <div class="field_group">
                    <div class="field">
                        <label for="pckg_head_3"> Package Description 3 </label>
                        <textarea type="text" name="pckg_head_3" id="pckg_head_3"  required>
                            {{ $package['pckg_head_3'] }}
                        </textarea>
                    </div>
                </div>
                <div class="field_group">
                    <div class="field">
                        <label for="pckg_head_4"> Package Description 4 </label>
                        <textarea type="text" name="pckg_head_4" id="pckg_head_4"  required>
                            {{ $package['pckg_head_4'] }}
                        </textarea>
                    </div>
                </div>
                <div class="field_group">
                    <div class="field">
                        <label for="pckg_head_5"> Package Description 5 </label>
                        <textarea type="text" name="pckg_head_5" id="pckg_head_5"  required>
                            {{ $package['pckg_head_5'] }}
                        </textarea>
                    </div>
                </div>
                <div class="field_group">
                    <div class="field">
                        <label for="pckg_head_6"> Package Description 6 </label>
                        <textarea type="text" name="pckg_head_6" id="pckg_head_6"  required>
                            {{ $package['pckg_head_6'] }}
                        </textarea>
                    </div>
                </div>
                <div class="field_group">
                    <div class="field">
                        <label for="pckg_head_7"> Package Description 7 </label>
                        <textarea type="text" name="pckg_head_7" id="pckg_head_7"  required>
                            {{ $package['pckg_head_7'] }}
                        </textarea>
                    </div>
                </div>
                        
                
            </section>
            <section>
                
                <div class="field_group">
                    <div class="field">
                        <label for="pckg_tags"> Package Tags </label>
                        <input type="text" name="pckg_tags" id="pckg_tags" value="{{ $package['pckg_tags'] }}" required>
                    </div>
                    <div class="field">                        
                        <label for="pckg_categories"> Package Type:</label>
                        <select id="pckg_categories" name="pckg_categories" >
                            <option value="Family"> Family </option>
                            <option value="Honeymoon"> Honeymoon </option>
                            <option value="Friends/Group"> Friends/Group </option>
                            <option value="Pilgrimage"> Pilgrimage </option>
                        </select>                       
                    </div>
                </div>

                <div class="field_group">
                    <div class="field">
                        <label for="state_name"> Package State </label>
                        <input type="text" name="state_name" id="state_name" value="{{ $package['state_name'] }}"  required>                       
                    </div>
                    <div class="field">
                        <label for="country_name"> Package Country </label>
                        <input type="text" name="country_name" id="country_name" value="{{ $package['country_name'] }}" pattern="[A-Za-z\s]+"  required>                       
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

        document.getElementById('image').addEventListener('change', function() {
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


