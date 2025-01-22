<div class="form_wrapper cflex">
    <div class="bg"></div>
    <div class="form_controller">
        <div class="form_types rflex">
            <button class="form_type active" data-for="flight_form">
                <i class="icon fa-solid fa-plane-engines"></i>
                <p>Flight</p>
            </button>
            <button class="form_type" data-for="hotel_form">
                <i class="icon fa-solid fa-hotel"></i>
                <p>Hotel</p>
            </button>
            {{-- <button class="form_type">
            <i class="icon fa-solid fa-bus-simple"></i>
            <p>Bus</p>
        </button>
        <button class="form_type">
            <i class="icon fa-solid fa-train"></i>
            <p>Train</p>
        </button>
        <button class="form_type">
            <i class="icon fa-solid fa-taxi"></i>
            <p>Taxi</p>
        </button>
        <button class="form_type">
            <i class="icon fa-solid fa-car"></i>
            <p>Rent a car</p>
        </button> --}}
        </div>
        @include('user.components.search_form.flight')
        @include('user.components.search_form.hotel')
    </div>
</div>
@push('js')
    <script>
        $(".form_type").perform((n, i, no) => {
            n.addEventListener("click", () => {
                no.perform(x => {
                    if (n != x) {
                        x.removeClass("active");
                        $("#" + x.get('data-for')).removeClass("active");
                    }
                });
                n.addClass("active");
                $("#" + n.get('data-for')).addClass("active");
            });
        })
    </script>
@endpush
