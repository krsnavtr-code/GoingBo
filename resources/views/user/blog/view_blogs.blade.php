@extends('user.components.layout')
@push('css')
    <style>
        .cart_layout {
            display: flex;
            padding: 30px;
            gap: 30px;
        }

        .cart_layout .main_content {
            flex-grow: 1;
        }

        .cart_layout .side_content {
            width: 300px;
            flex-shrink: 0;
            height: 400px;
            display: flex;
            flex-direction: column;
            gap: 15px;
            top: 80px;
            position: sticky;
        }

        main .main_content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        main .main_content .blog {
            aspect-ratio: 2.5/3;
            position: relative;
            isolation: isolate;
        }

        main .main_content .blog::after {
            content: '';
            inset: 0;
            position: absolute;
            background: linear-gradient(0deg, black, transparent 70%);
            z-index: 1;
        }

        main .main_content .blog img {
            width: 100%;
            height: 100%;
        }

        main .main_content .blog_desc {
            position: absolute;
            left: 0;
            padding: 20px;
            z-index: 2;
            color: white;
            bottom: 0;
        }

        main .main_content .blog_desc p {
            font-weight: 700;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 8px;
            color: var(--gray_500);
        }

        main .main_content .blog_desc h6 {
            line-height: 1.2
        }

        .cart_layout .side_content .panel {
            background: white;
            padding: 10px;
            gap: 12px;
            display: flex;
            flex-direction: column;
            border-radius: 7px;
            box-shadow: 0 0 10px 0 #00000033;
        }

        .blog_mini {
            display: flex;
        }

        .blog_mini .blog_img {
            height: 65px;
            aspect-ratio: 1;
        }

        .blog_mini .blog_img img {
            height: 100%;
            width: 100%;
            border-radius: 5px;
        }

        .blog_mini .blog_desc {
            padding: 0 0 0 15px;
        }

        .blog_mini .blog_desc h6 {
            font-size: 1.3rem;
        }

        .blog_mini .blog_desc p {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--gray_600);
        }

        .blog.hide {
            display: none;
        }

        @media screen and (max-width:992px) {
            .cart_layout {
                flex-direction: column
            }

            .cart_layout .side_content {
                width: unset;
            }

            .cart_layout .side_content {
                flex-direction: row;
                gap: 30px;
                flex-wrap: wrap;
            }

            .cart_layout .side_content .panel {
                flex-grow: 1;
                min-width: 250px;
            }
        }

        @media screen and (max-width:700px) {
            .cart_layout {
                padding: 15px;
            }

            .blog_image {
                height: 250px;
            }
        }

        @media screen and (max-width:450px) {
            .cart_layout {
                padding: 0;
            }

            .blog_image {
                height: 180px;
            }

            .cart_layout .side_content {
                padding: 15px;
            }
        }
    </style>
@endpush
@section('main')
    <main>
        <div class="cart_layout">
            <div class="main_content">
                @foreach ($blogs as $blog)
                    <a class="blog" href="{{ url($blog['webpage']['slug']) }}"
                        data-category="{{ $blog['blog_category']['cat_title'] }}">
                        <img src="{{ url('images/blogs/' . $blog['blog_pic']) }}" alt="">
                        <div class="blog_desc">
                            <p class="blog_writer">{{ $blog['employee']['emp_name'] }}</p>
                            <h6 class="blog_title">{{ $blog['blog_title'] }}</h6>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="side_content">
                @if ($recent)
                    <div class="panel">
                        @foreach ($recent as $reb)
                            <a class="blog_mini" href="{{ url($reb['webpage']['slug']) }}">
                                <div class="blog_img"><img src="{{ url('images/blogs/' . $reb['blog_pic']) }}"
                                        alt="">
                                </div>
                                <div class="blog_desc">
                                    <h6 class="blog_title">{{ $reb['blog_title'] }}</h6>
                                    <p>{{ $reb['employee']['emp_name'] }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </main>
@endsection
@push('js')
    <script>
        let urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('category')) {
            let cat = urlParams.get('category');
            $(".main_content .blog").perform((x) => {
                x.get('data-category') == cat ? x.removeClass("hide"):x.addClass("hide");
            })
        }
    </script>
@endpush
