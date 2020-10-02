
    'use strict';
    $(document).foundation();

    $(document).ready(function () {

    //    PERFORM SWITCH STATEMENTS
        switch ($('body').data('page-id')){

        //    PAGE ID OF ADMIN
            case 'adminDashboard':
                ARTISAO.admin.dashboard();

                break;


            case 'graph_details':
                ARTISAO.admin.graph_details();

                break;

            case 'massages':
                ARTISAO.homeslider.massages();

                break;

            case 'userDashboard':
                ARTISAO.user.dashboard();

                break;

            case 'home':
                ARTISAO.home.animate();

                break;

            case 'bookings':
                ARTISAO.home.bookings();

                break;

            case 'cartPage':
                ARTISAO.home.cart();

                break;

            case 'auth':
                ARTISAO.home.login();
                ARTISAO.home.register();

                break;

            case 'contact_us':
                ARTISAO.home.contactus();

                break;

        }

    });




    $(window).on('load', function () {
        //REMOVE THE PRELOADER IMAGE AFTER TIME OUT
        setTimeout(function () {

            $('.preloader').css('display', 'none');
            $('#hide-div').css('display', '');

        }, 1000);
    });
