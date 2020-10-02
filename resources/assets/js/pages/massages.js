
ARTISAO.homeslider.massages = function () {
    // alert('hi');
    $('.hero-main-slider').slick({

        slidesToShow: 1,
        infinite:true,
        speed: 100,
        autoplay: true,
        arrows: true,
        // dots: truenp,
        // fade: true,
        autoplayHoverPause: true,
        slidesToScroll: 1,
        // adaptiveHeight: true,
        // asNavFor: '.hero-nav-slider',
        centerMode: true,
        variableWidth: true,
        focusOnSelect: true
        // // responsive: [
        //     {
        //         breakpoint: 1024,
        //         settings:{
        //             slidesToShow:3,
        //             slidesToScroll: 3,
        //             infinite: true,
        //             dots: true
        //         }
        //     },
        //     {
        //         breakpoint: 600,
        //         settings: {
        //             slidesToScroll: 2,
        //             slidesToShow: 2
        //         }
        //
        //     },
        //     {
        //         breakpoint: 400,
        //         settings: {
        //             slidesToScroll:1,
        //             slidesToShow:1
        //         }
        //     }
        // ]
    });




};