
    <form>
        <script src="https://checkout.flutterwave.com/v3.js"></script>

        <button class="button success expanded" type="button" onClick="saveToBooking()">Pay Now</button>
    </form>
    {{--{{ pnd($cartRef) }}--}}
    <script>


        function saveToBooking() {
            let r = confirm('Are you sure you want to proceed to payment?');
            if (r == true){

                $postData = $.param({token:'{{$token}}'});

                axios.post('/checkout/save_payment', $postData).then(function (res) {
                    // console.log(res.data.result);
                    if (res.data.result == true){

                        makePayment();
                    }else {
                        $.dialog({
                            title: 'Unable to process Payment!',
                            content: 'Unable to reach endpoint for payment processing. Please try again later!',
                            useBootstrap:false,
                            containerFluid:false,
                            boxWidth:'50%',
                            type: 'red'
                        });
                    }
                }).catch(function (err) {
                    console.log(err);
                });
            }

        }


        function makePayment() {
            let pk = '';
            if ('{{ getenv('APP_ENV') }}' === 'local'){
                pk = "{{ getenv('RAVE_PUBLIC_TEST_KEY') }}";
            } else{
                pk = "{{ getenv('RAVE_PUBLIC_KEY') }}";
            }
// alert(pk);
            FlutterwaveCheckout({
                public_key: pk,
                tx_ref: "{{$cartRef}}",
                amount: "{{$cartTotal}}",
                currency: "GHS",
                payment_options: "card,mobilemoneyghana,ussd",
                customer: {
                    email:'{{ user()->email }}',
                    phonenumber: '+233'+'{{ user()->phone }}',
                    name: '{{user()->fullname}}',
                },

                callback: function (data) { // specified callback function
                    console.log(data);
                    let postData = $.param(data);
// alert('hi');
                    axios.post('/checkout/verify_payment', postData).then(function (res) {
                        console.log(res.data);
                        if (res.data.redirect == true) {
                            window.location.href = '/bookings/cart'
                        }else{
                            $.dialog({
                                title: 'Unable to process Payment!',
                                content: 'Unable to reach endpoint for payment processing. Please try again later!',
                                useBootstrap:false,
                                containerFluid:false,
                                boxWidth:'50%',
                                type: 'red'
                            });
                            // window.location.href = '/bookings/cart'
                        }
                    }).catch(function (err) {
                        
                        console.log(err);
                    });
                },
                customizations: {
                    title: '{{getenv("APP_NAME")}}',
                    description: "Payment for items in cart",
                    logo: "{{getenv('APP_URL')}}/images/logo.png",
                },
            });
        }
    </script>