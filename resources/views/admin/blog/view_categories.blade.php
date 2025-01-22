@extends('admin.components.layout')
@push('css')
    <style>
        .categories {
            margin-top: 20px;
            gap: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr))
        }

        .category {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px 0 #00000033;
            background: white;
        }

        .category img {
            height: 200px;
            width: 100%;
        }

        .category_details {
            padding: 10px 20px 20px;
        }

        .category_details p {
            font-size: 1.2rem;
            color: var(--gray_600);
        }

        .img_box {
            position: relative;
        }

        .blog_count {
            position: absolute;
            bottom: 0;
            right: 0;
            padding: 3px 10px;
            background: white;
            font-size: 1.2rem;
            border-top-left-radius: 8px;
        }

        .blog_count::after {
            content: '';
            width: 8px;
            aspect-ratio: 1;
            position: absolute;
            border-radius: 10px;
            box-shadow: 4px 4px white;
            left: 0;
            bottom: 0;
            transform: translateX(-100%);
        }
    </style>
@endpush
@section('main')
    <main>
        <div>
            <h1 class="page_title">Blog Categories</h1>
            <p class="page_sub_title">Explore Blog categories</p>
        </div>
        <div class="categories">
            @foreach ($categories as $cat)
                <div class="category">
                    <div class="img_box">
                        <img src="{{ url('images/blogs/category/' . $cat['cat_image']) }}" alt="">
                        <div class="blog_count">
                            <h6><a href="{{url('admin/blog?category='.$cat['cat_title'])}}">{{ count($cat['blogs']) }} Blogs</a></h6>
                        </div>
                    </div>
                    <div class="category_details">
                        <h6>{{ $cat['cat_title'] }}</h6>
                        <p>{{ $cat['cat_desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endsection
