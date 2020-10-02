$(document).ready(function () {




    $('#card_no').on('keyup',function (event) {
        let cardNo = $('#card_no').val();
        // console.log(cardNo);

        let valid = /^[0-9]+$/.test(cardNo);
        // console.log(valid);

            if(cardNo.length !== '') {
                $('#card_error').text('** Card Number input cannot be left blank');
            }else{
                $('#card_error').text('');

                if (valid !== true){
                    $('#card_error').text('** Card Number input can be only numbers').css('color', 'red');
                }else{
                    $('#card_error').text('');
                }
            }

            if (cardNo.length !== 16){
                // console.log(cardNo.length < 16);
                $('#card_error').text('** Card number is not up to the require number').css('color', 'red');
            }else{
                $('#card_error').text('');
            }

    });


    $('#month').on('keyup',function (event) {
        let month = $('#month').val();
        // console.log(cardNo);

        let valid = /^[0-9]+$/.test(month);
        // console.log(valid);

        if(month.length !== '') {
            $('#card_error').text('** Card Month input cannot be left blank');
        }else{
            $('#card_error').text('');

            if (valid !== true){
                $('#card_error').text('** Card Month input can be only numbers').css('color', 'red');
            }else{
                $('#card_error').text('');
            }
        }

        if (month.length !== 2){
            // console.log(cardNo.length < 16);
            $('#card_error').text('** Card Month is not up to the require number').css('color', 'red');
        }else{
            $('#card_error').text('');
        }

    });


    $('#year').on('keyup',function (event) {
        let year = $('#year').val();
        // console.log(cardNo);

        let valid = /^[0-9]+$/.test(year);
        // console.log(valid);

        if(year.length !== '') {
            $('#card_error').text('** Card Year input cannot be left blank');
        }else{
            $('#card_error').text('');

            if (valid !== true){
                $('#card_error').text('** Card Year input can be only numbers').css('color', 'red');
            }else{
                $('#card_error').text('');
            }
        }

        if (year.length !== 2){
            // console.log(cardNo.length < 16);
            $('#card_error').text('** Card Year is not up to the require number').css('color', 'red');
        }else{
            $('#card_error').text('');
        }

    });


    $('#cvv').on('keyup',function (event) {
        let cvv = $('#cvv').val();
        // console.log(cardNo);

        let valid = /^[0-9]+$/.test(cvv);
        // console.log(valid);

        if(cvv.length !== '') {
            $('#card_error').text('** Card CVV input cannot be left blank');
        }else{
            $('#card_error').text('');

            if (valid !== true){
                $('#card_error').text('** Card CVV input can be only numbers').css('color', 'red');
            }else{
                $('#card_error').text('');
            }
        }

        if (cvv.length !== 3){
            // console.log(cardNo.length < 16);
            $('#card_error').text('** Card CVV is not up to the require number').css('color', 'red');
        }else{
            $('#card_error').text('');
        }

    });


    //CARD SUBMIT
    $('#card_submit').click(function (e) {
       e.preventDefault();

       $('.load-spinner').show();

        let cardNo = $('#card_no').val();
        let month = $('#month').val();
        let year = $('#year').val();
        let cvv = $('#cvv').val();
        let token = $('#card_token').val();

        let postData = $.param({cardNo: cardNo, month: month, year: year, cvv: cvv, token:token});

        axios.post('/checkout/card_payment', postData).then(function (res) {
            console.log(res.data);
            if (res.data.error === true){
                $('#card_error').text('**'+res.data.msg ).css('color', 'red');
                $('.load-spinner').hide();
            }
        }).catch(function (err) {
            console.log(err);
        })

    });



});