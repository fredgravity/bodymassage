
ARTISAO.home.bookings = function () {
    'use strict';


    $(document).ready(function () {
        //set session warning to login
        let session = $('.bookings').attr('data-isSession');
        // alert(session);

        if (session != true){
            setTimeout(function () {
                $.dialog({
                    title: 'No User Authenticated!',
                    content: 'We found no user authenticated. You will be redirected if you try to book without an Account. Please Login to Book a massage.',
                    useBootstrap:false,
                    containerFluid:false,
                    boxWidth:'50%',
                    type: 'red'
                });
            },1000);
        }

        // change map when city is changed
        $('#city').change(function () {
           let city =  $('#city').val();
           // alert (city);
           $('#bookingMap').attr('src', "https://www.google.com/maps/embed/v1/place?key=AIzaSyDshX8fE38Qzt03yRhE34i_Hh57tSCIkdk&q="+city+",Greater+Accra+Ghana");
        });

        // disable todays date for booking
        let today = new Date();
        let dd = String(today.getDate()).padStart(2, '0');
        let mm = String(today.getMonth() + 1).padStart(2, '0');
        let yyyy = today.getFullYear();
        today = yyyy + '-' + mm + '-' + dd;
        // alert(today);

        let disabled = [];
        flatpickr('.bookings', {
            wrap: true,
            minDate: 'today',
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
            disable: [today],
            allowInput: false,


        });

        $('.place').change(function () {
            $('.place_name').toggle();
        });

        $('#massageType').change(function () {
            let id = $('#massageType').val();
            // remove animated class
            $('#massageImg').removeClass('animate__animated animate__slideInRight');
            axios.get('/bookings/massage/'+id).then(function (res) {
                $('#massageImg').attr('src', '/'+res.data.image);
                $('#massageImg').addClass('animate__animated animate__slideInRight');
                checkoutBtn(700);
            }).catch(function (err) {
                console.log(err);
            })
        });

        function checkoutBtn(secs) {
            setInterval(function () {
                $('#checkout-btn').show();
            }, secs);
        }


        $('#checkout-btn').on('click', function (e) {
            e.preventDefault();
            // alert('hi');
            $('.load-spinner').show();

            let massageTypeId = $('#massageType').val();
            let massageHours = $('#hourSession').val();
            let massageTime = $('#timeSession').val();
            let datePicker = $('#selectDate').val();
            let token = $('#dateToken').val();
            let place = $('#place').val();
            let place_name_home = $('#place_name_home').val();
            let place_name_other = $('#place_name_other').val();
            let place_name = '';
            let gps = $('#gps').val();
            let city = $('#city').val();
            let district = $('#district').val();

            // alert(district);
            // alert(gps);
            // alert(city);

            if (place == 'home'){
                place_name = place_name_home;
            } else{
                place_name = place_name_other;
            }

            // alert(place_name);

            let postData = $.param({
                massageId: massageTypeId,
                massageHours: massageHours,
                massageTime: massageTime,
                datePicker : datePicker,
                place : place,
                place_name : place_name,
                token: token,
                gps: gps,
                city: city,
                district: district
            });

            if (datePicker == ''){
                $.dialog({
                    title: 'Booking Date Not Selected!',
                    content: 'Please choose a booking date.',
                    useBootstrap:false,
                    containerFluid:false,
                    boxWidth:'50%',
                    type: 'red'
                });
                $('.load-spinner').hide();
                return
            }


            axios.post('/bookings/massage/checkout', postData).then(function (res) {
// alert(res.data);
                if (res.data.disabled){
                    disabled = res.data.disabled;
                    // console.log(disabled);
                }


                if (res.data.redirect){
                    window.location.href = '/bookings';
                    // console.log(res.data.errors);
                    // $('#place_name_home').text(res.data.errors);
                }
                if (res.data.redirectAuth){
                    window.location.href = '/login';
                }


                if (res.data.maxReached){
                    $.dialog({
                        title: 'Booking Maximum Limit!',
                        content: 'You can make a maximum massage booking of 3 bookings for payment processing ',
                        useBootstrap:false,
                        containerFluid:false,
                        boxWidth:'50%',
                        type: 'red'
                    });
                    $('.cart-icon').show();
                    $('.load-spinner').hide();
                }


                if (res.data.redirectNotAccra){
                    $.dialog({
                        title: 'Problem with Location!',
                        content: 'You location is outside of Greater Accra Region of Ghana. Only users in this location can book for a massage. ',
                        useBootstrap:false,
                        containerFluid:false,
                        boxWidth:'50%',
                        type: 'red'
                    });
                    $('.cart-icon').show();
                    $('.load-spinner').hide();
                }


                if (res.data.redirectAdded){
                    $.dialog({
                        title: 'Booking Added!',
                        content: 'You have added Massage booking to your Cart. Click on Cart to view bookings',
                        useBootstrap:false,
                        containerFluid:false,
                        boxWidth:'50%',
                        type: 'green'
                    });
                    // console.log(res.data);
                    $('.cart-icon-span').text('('+res.data.count+')');
                    $('.load-spinner').hide();
                }

                if (res.data.redirectDateMax){
                    $.dialog({
                        title: 'Booking Dates or Session Maxed Out!',
                        content: 'This particular booking date or session has been maxed out!, Please choose a different date or sesscion time.',
                        useBootstrap:false,
                        containerFluid:false,
                        boxWidth:'50%',
                        type: 'red'
                    });
                    $('.cart-icon').show();
                    $('.load-spinner').hide();
                }

                if (res.data.redirectProfile){
                    $.dialog({
                        title: 'Incomplete Profile.!',
                        content: 'Please complete your profile information before booking a massage',
                        useBootstrap:false,
                        containerFluid:false,
                        boxWidth:'50%',
                        type: 'red'
                    });
                    $('.cart-icon').show();
                    $('.load-spinner').hide();
                }

                // console.log(res.data);

            }).catch(function (err) {
                console.log(err)
            })
        });
















    });


};