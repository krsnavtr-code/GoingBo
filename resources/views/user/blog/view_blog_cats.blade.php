@extends('user.components.layout')
@push('css')
    <style>
        main{
            padding: 40px;
        }
        main section .section_head{
            padding: 10px 0;
        }
        main section .section_head h6{
            text-transform: capitalize;
        }
        main section .section_content{
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }
        main section .section_content .blog{
            max-width: 350px;
            aspect-ratio:2.5/3;
            position: relative;
            isolation: isolate;
        }
        main section .section_content .blog::after{
            content: '';
            inset: 0;
            position: absolute;
            background: linear-gradient(0deg,black ,transparent 70%);
            z-index: 1;
        }
        main section .section_content .blog img{
            width: 100%;
            height: 100%;
        }
        main section .section_content .blog_desc{
            position: absolute;
            left:0;
            padding: 20px;
            z-index: 2;
            color: white;
            bottom: 0;
        }
        main section .section_content .blog_desc p{
            font-weight: 700;
            font-size: 1rem;text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 8px;
            color: var(--gray_500);
        }
        main section .section_content .blog_desc h6{
            line-height: 1.2
        }
    </style>
@endpush
@section('main')
    <main class="cflex" style="gap:50px;">
        @foreach ($cats as $cat)
            @if (count($cat['blogs']) > 0)
                <section>
                    <div class="section_head rflex jcsb">
                        <h6>{{ $cat['cat_title'] }}</h6>
                        <a href="{{url("blogs?category=".$cat['cat_title'])}}">View All</a>
                    </div>
                    <div class="section_content">
                        @foreach ($cat['blogs'] as $blog)
                            <a class="blog" href="{{url($blog['webpage']['slug'])}}">
                                <img src="{{url("images/blogs/".$blog['blog_pic'])}}" alt="">
                                <div class="blog_desc">
                                    <p class="blog_writer">{{$blog['employee']['emp_name']}}</p>
                                    <h6 class="blog_title">{{$blog['blog_title']}}</h6>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif
        @endforeach
    </main>
@endsection
