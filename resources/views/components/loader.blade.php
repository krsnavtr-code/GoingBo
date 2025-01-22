@prepend('js')
    <script>
            // $('a').perform((x) => {
            //     x.addEventListener('click', () => {
            //         setLoadMessage(x.get('data-msg'));
            //     })
            // });

            // function setLoadMessage(msg) {
            //     $("#loader p")[0].innerText = msg ?? '';
            // }
            // function showLoader(){
            //     $("#loader").addClass('show');
            // }
            // function hideLoader(){
            //     $("#loader").removeClass('show');
            // }
            // window.onload = hideLoader;
            // window.onbeforeunload = showLoader;
    </script>
@endprepend
<style>
    /* #loader {
        position: fixed;
        inset: 0;
        background: white;
        z-index: 99;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #loader:not(.show) {
        display: none;
    }

    .loading {
        border: 7px solid black;
        width: 60px;
        display: block;
        aspect-ratio: 1;
        animation: load 2s infinite forwards;
        border-radius: 60px;
        border-left-color: transparent;
        margin-inline: auto;
        margin-bottom: 30px;
    }

    @keyframes load {
        0% {
            rotate: 0deg;
        }

        100% {
            rotate: 360deg;
        }
    } */

    #loader {
        position: fixed;
        inset: 0;
        background: white;
        z-index: 99;
        display: flex;
        justify-content: center;
        align-items: center;
    }  

    #loader:not(.show) {
        display: none;
    }

    .loading {
        border: 7px solid black;
        width: 60px;
        display: block;
        aspect-ratio: 1;
        animation: load 2s infinite forwards;
        border-radius: 60px;
        border-left-color: transparent;
        margin-inline: auto;
        margin-bottom: 30px;
    }

    @keyframes load {
        0% {
            rotate: 0deg;
        }

        100% {
            rotate: 360deg;
        }
    }
    
    .loader_details {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transform: translateY(-20px);
        transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
    }
    
    #loader.show .loader_details {
        opacity: 1;
        transform: translateY(0);
    }
    
    .loader_details img {
        width: 100px; /* Adjust the width as needed */
        height: auto; /* Maintain aspect ratio */
        margin-bottom: 10px;
        /* Apply any additional styling you need */
        
    }
    
    
    
</style>

{{-- <div id="loader" class="show">
    <div class="loader_details">
        <img src="{{ url('images/logo.png') }}" alt="Logo" >
        <i class="loading"></i>
        @if ($msg)
            <p style="font-size: 1.2em;font-weight:600;">{{ $msg }}</p>
        @endif
    </div>
</div> --}}

