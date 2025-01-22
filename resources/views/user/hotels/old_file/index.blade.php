@extends('user.components.layout')
@push('css')
    <link rel="stylesheet" href="css/index.css">
    <style>
        section.destinations {
            padding-inline: 50px;
        }

        section .section_head {
            padding: 20px;
        }

        section .section_head .view_all {
            color: var(--fv_sec);
            font-weight: 600;
            font-size: 1.4rem;
            border-bottom: 1.6px solid;
        }

        section .section_head .view_all i {
            margin-left: 7px;
        }

        .destination {
            position: relative;
            overflow: hidden;
            height: 200px;
            border-radius: 10px;
            box-shadow: 0 0 5px 0 #00000033;
        }

        .destination img {
            width: 100%;
            height: 100%;
            transition: all 0.3s;
        }

        .destination:hover img {
            scale: 1.1;
        }

        .destination .details {
            padding: 10px;
            inset-inline: 0;
            bottom: 0;
            position: absolute;
        }

        .destination .details .detail {
            background: #ffffff88;
            padding: 10px 20px;
            border-radius: 6px;
            backdrop-filter: blur(1px);
        }

        .destination .details .detail .country {
            padding: 3px 15px;
            width: max-content;
            border-radius: 100px;
            background: #ffffff;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 1px;
            color: var(--fv_prime);
        }

        .destination .details .detail .desti {
            margin-block: 3px 2px;
            color:  blue;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .destination .details .detail .packages {
            font-size: 1.2rem;
        }

        .destination .details .detail .packages span {
            font-weight: bold;
            font-size: 1.4rem;
            margin-right: 5px;
        }

        @media screen and (max-width: 500px) {
            section.destinations {
                padding-inline: 0px;
            }

            .desti-wrap:not(:nth-of-type(3n)) {
                width: 50%;
            }

        }

       
        .col-border-none{
            --tw-border-opacity: 1;
            border-color: rgb(var(--neutral-100)/var(--tw-border-opacity));
            border-width: 1px;
            border-radius: 10px;

        }

        .flight-link {
            color: #000; 
            text-decoration: none;
            transition: color 0.3s ease; 
        }

        .flight-link:hover {
            color: #ff5e00; /* Change text color on hover */
        }

    </style>
@endpush
@section('main')

<main>
    @include('user.components.forms.form')
    
    <section class="destinations">
        <div class="section_head rflex jcsb aic">
            <h4 class="section_title">Popular Hotels Destinations </h4>  
            
            <ul>
                
            </ul>    
        </div>   
        
    </section>
</main>
@endsection

