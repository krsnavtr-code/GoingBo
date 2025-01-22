@extends('admin.components.layout')
@push('css')
@endpush
@section('main')
    <main>
        @include('admin.components.response')
        <div>
            <h1 class="page_title">Blog Category</h1>
            <p class="page_sub_title">Let's Categories blog</p>
        </div>
        <form action="{{ url($page['current']) }}" method="post" enctype="multipart/form-data">
            <div class="hidden">@csrf</div>
            <section>
                <div class="field">
                    <label for="cat_title">Category Name</label>
                    <input type="text" name="cat_title" placeholder="Category Title" id="cat_title" required>
                </div>
                <div class="field">
                    <label for="cat_desc">Category Description <i class="text info">Optional</i></label>
                    <input type="text" name="cat_desc" placeholder="Category Description" id="cat_desc" required>
                </div>
                <div class="field">
                    <input type="file" name="cat_image" id="cat_image">
                    <label for="cat_image">
                        <div class="display">
                            <img src="" alt="">
                            <span>Upload Image to preview</span>
                        </div>
                    </label>
                </div>
            </section>
            <button type="submit">Submit</button>
        </form>
    </main>
@endsection
@push('js')
    <script>
        $("#cat_image").addEventListener("change", function() {
            let parent = this.parentElement;
            parent.$("label")[0].addClass("loaded");
            parent.$("img")[0].src = URL.createObjectURL(this.files[0]);
        });
    </script>
@endpush
