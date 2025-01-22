jQuery(function ($) {
    // toggle buttons
    $(".filter-btn").click(() => {
        $(".hotel-filter").slideToggle();
    });
    $(".search-cap").click(() => {
        $(".hotel-search").slideToggle();
    });
    $(".fa-heart").click(function () {
        $(this).toggleClass("fa-regular fa-solid");
    });
    $(".angle").parent().click(function () {
        $(this).find(".angle").toggleClass("fa-angle-up fa-angle-down");
    });
    $(".reserve").click(() => {
        $('.offcanvas').fadeIn('slow', function() {
            $('.offcanvas .text-box').addClass('show');
        });
    });

    // Hide offcanvas with slide out effect
    $(".offcanvas .x, .offcanvas .img-box").click(() => {
        $('.offcanvas .text-box').removeClass('show');
        $('.offcanvas').fadeOut('slow');
    });


    // owl-carousel
    //hotel-slider
    $('.hotel-slider').owlCarousel({
        loop: true,
        margin: 0,
        height: 200,
        // nav: false,
        center: true,
        autoplay: true,
        duration: 10,
        // dots: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    })
    // similer-slider
    $('.similer-slider').owlCarousel({
        loop: true,
        margin: 20,
        nav: false,
        center: true,
        autoplay: true,
        duration: 10,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    })

    $('.see-more').click(function() {
        $('.additional-facilities').show(); // or use .css('display', 'flex') if using flex layout
        $('.see-more').hide();
        $('.show-less').show();
    });

    $('.show-less').click(function() {
        $('.additional-facilities').hide();
        $('.see-more').show();
        $('.show-less').hide();
    });

    

    // //counter
    // const counter = () => {
    //   const counts = document.querySelectorAll(".count");

    //   counts.forEach((count) => {
    //     const initialCount = parseInt(count.getAttribute("initial-count"));
    //     count.innerText = 1;

    //     setInterval(() => {
    //       if (count.innerText < initialCount) {
    //         count.innerText++;
    //       }
    //     }, 50);
    //   });
    // };

    // counter();

    // window.addEventListener("scroll", counter);
});