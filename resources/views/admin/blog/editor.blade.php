@extends('admin.components.layout')
@push('css')
@endpush
@section('main')
    <main>
        @include('admin.components.response')
        <div>
            <h1 class="page_title">Editor</h1>
            <p class="page_sub_title">Let's Create a new blog</p>
        </div>
        <form action="{{ url($page['current']) }}" method="post" enctype="multipart/form-data">
            <div class="hidden">@csrf</div>
            <section>
                <div class="field_group">
                    <div class="field">
                        <label for="">What's in your mind</label>
                        <input type="text" name="blog_title" placeholder="Blog Title"  required>
                    </div>
                    <div class="field">
                        <label for="">Category</label>
                        <select name="cat_id" id="" required>
                            <option disabled selected>---- Select Category ----</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat['id'] }}">{{ $cat['cat_title'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="field">
                    <input type="file" name="blog_pic" id="blog_pic"  required>
                    <label for="blog_pic">
                        <div class="display">
                            <img src="" alt="">
                            <span>Upload Image to preview</span>
                        </div>
                    </label>
                </div>
            </section>
            @include('admin.components.seo')
            <section>
                <textarea id="blog_editor" name="blog_content" style="height: 400px" pattern="[A-Za-z\s]+"></textarea>
            </section>
            <button type="submit">Submit</button>
        </form>
    </main>
@endsection

@push('js')
    <script src="https://cdn.tiny.cloud/1/000nwap7tgu75ovbp0gu5js87gbqjnsayryehvmack7qizyt/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        $("#blog_pic").addEventListener("change", function() {
            let parent = this.parentElement;
            parent.$("label")[0].addClass("loaded");
            parent.$("img")[0].src = URL.createObjectURL(this.files[0]);
        });

        tinymce.init({
            selector: '#blog_editor',
            plugins: 'link',
            link_default_target: '_blank'
        });

        document.getElementById('blog_pic').addEventListener('change', function() {
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
