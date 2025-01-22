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
            height: fit-content;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            gap: 15px;
            top:110px;
            position: sticky;
        }

        .blog_image {
            height: 400px;
            border-radius: 10px;
            overflow: hidden;
        }

        .blog_image img {
            height: 100%;
            width: 100%;
        }

        .blog {
            background: white;
            padding: 30px 40px 40px;
            border-radius: 10px;
            margin-top: 30px;
            font-family: sans-serif;
            line-height: 1.6;
        }

        .blog .blog_title {
            margin-block: 0px 15px;
        }

        .blog_content :is(h1, h2, h3, h4, h5, h6) {
            margin-block: 12px 4px;
        }

        .cart_layout .side_content .panel {
            background: white;
            display: flex;
            flex-direction: column;
            gap:12px;
            padding: 10px;
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
        .blog_mini .blog_desc h6{
            font-size: 1.3rem;
        }
        .blog_mini .blog_desc p{
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--gray_600);
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

            .blog {
                margin-top: 0;
            }

            .blog,
            .blog_image {
                border-radius: 0px;
            }
        }
    </style>
@endpush
@section('main')
    <main>
        <div class="cart_layout">
            <div class="main_content">
                <div class="blog_image">
                    <img src="{{ url('images/blogs/' . $blog['blog_pic']) }}" alt="">
                </div>
                <div class="blog">
                    <h1 class="blog_title">{{ $blog['blog_title'] }}</h1>
                    <div class="blog_content">
                        {!! $blog['blog_content'] !!}
                    </div>
                </div>
            </div>
            <div class="side_content">
                @if ($related)
                    <div class="panel">
                        @foreach ($related as $reb)
                            <a class="blog_mini" href="{{url($reb['webpage']['slug'])}}">
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
                @if ($recent)
                    <div class="panel">
                        @foreach ($recent as $rcb)
                            <a class="blog_mini" href="{{url($rcb['webpage']['slug'])}}">
                                <div class="blog_img"><img src="{{ url('images/blogs/' . $rcb['blog_pic']) }}"
                                        alt="">
                                </div>
                                <div class="blog_desc">
                                    <h6 class="blog_title">{{ $rcb['blog_title'] }}</h6>
                                    <p>{{ $rcb['employee']['emp_name'] }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </main>
@endsection
