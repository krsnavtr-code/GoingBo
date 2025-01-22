@extends('admin.components.layout')
@push('css')
    <style>
        .blogs {
            margin-top: 20px;
            gap: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr))
        }

        .blog {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px 0 #00000033;
            background: white;
        }

        .blog.disabled * {
            color: var(--gray_400) !important;
        }

        .blog:not(.disabled) .fa-eye-slash {
            display: none;
        }

        .blog.disabled .fa-eye {
            display: none;
        }

        .blog .img_box {
            position: relative;
        }

        .blog img {
            height: 200px;
            width: 100%;
        }

        .blog_details {
            padding: 10px 20px 20px;
        }

        .blog_details .blog_title {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .blog_details p {
            color: var(--gray_600);
            font-size: 1.2rem;
        }

        .blog_details .blog_cat {
            font-weight: 600;
            letter-spacing: 1px;
            font-size: 1rem;
            text-transform: uppercase;
        }

        .blog_writer {
            position: absolute;
            bottom: 0;
            right: 0;
            padding: 3px 10px;
            background: white;
            cursor: pointer;
            font-weight: 600;
            font-size: 1.2rem;
            border-top-left-radius: 8px;
        }

        .blog_writer::after {
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

        .blog_desc {
            margin-top: 7px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

        .toggle_btn {
            position: absolute;
            top: 0;
            left: 0;
            border-bottom-right-radius: 8px;
            font-size: 1.2rem;
            background: white;
            cursor: pointer;
            box-shadow: 0 0 10px 0 #00000055;
        }

        .toggle_btn i {
            width: 40px;
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@endpush
@section('main')
    <main>
        <div>
            <h1 class="page_title">View Blog</h1>
            <p class="page_sub_title">All Blogs Written by our team</p>
        </div>
        <div class="blogs">
            @foreach ($blogs as $blog)
                <div @class(['blog', 'disabled' => !$blog['blog_status']])>
                    <div class="img_box">
                        <img src="{{ url('images/blogs/' . $blog['blog_pic']) }}" alt="">
                        <p class="blog_writer">
                            {{ $blog['employee']['emp_name'] }}
                        </p>
                        <div class="toggle_btn" onclick="toggle_status(this,{{ $blog['id'] }})">
                            <i class="fa-solid fa-eye"></i>
                            <i class="fa-solid fa-eye-slash"></i>
                        </div>
                    </div>
                    <div class="blog_details">
                        <p class="blog_cat">
                            {{ $blog['blog_category']['cat_title'] }}
                        </p>
                        <h6 class="blog_title">
                            {{ $blog['blog_title'] }}
                        </h6>
                        <p class="blog_desc">{{ strip_tags($blog['blog_content']) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endsection
@push('js')
    <script>
        function toggle_status(node, blogId) {
            ajax({
                url: `{{ url('api/blog/toggle') }}/${blogId}`,
                success: (res) => {
                    res = JSON.parse(res);
                    if (res['result']['success']) {
                        let blog = node.closest(".blog");
                        blog.hasClass("disabled")?blog.removeClass("disabled"):blog.addClass("disabled");
                    } else {
                        alert(res['result']['msg'] ?? "Unknown Error Occured");
                    }
                }
            })
        }
    </script>
@endpush
