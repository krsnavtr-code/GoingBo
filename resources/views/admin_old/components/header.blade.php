<header class="jcsb aic">
    <a href="{{url('')}}" class="brand rflex">
        <img src="{{ url('/images/logo.png') }}" alt="">
    </a>
    <i class="fa-solid fa-bars icon" onclick="show_menu()" id="menu_icon"></i>
</header>
@push('js')
    <script>
        function show_menu() {
            $(".sidebar")[0].toggleClass("active");
        }
        document.addEventListener("click", function(e) {
            if (!$(".sidebar")[0].contains(e.target) && !$("#menu_icon").contains(e.target)) {
                $(".sidebar")[0].removeClass("active");
            }
        });
    </script>
@endpush
