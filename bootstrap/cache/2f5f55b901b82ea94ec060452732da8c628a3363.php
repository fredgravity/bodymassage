
    <form>
        <script src="https://checkout.flutterwave.com/v3.js"></script>

        <button class="button success expanded" type="button" onClick="saveToBooking()">Pay Now</button>
    </form>
    
    <script>


        function saveToBooking() {
            let r = confirm('Are you sure you want to proceed to payment?');
            if (r == true){

                $postData = $.param({token:'<?php echo e($token); ?>'});

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
            if ('<?php echo e(getenv('APP_ENV')); ?>' === 'local'){
                pk = "<?php echo e(getenv('RAVE_PUBLIC_TEST_KEY')); ?>";
            } else{
                pk = "<?php echo e(getenv('RAVE_PUBLIC_KEY')); ?>";
            }
// alert(pk);
            FlutterwaveCheckout({
                public_key: pk,
                tx_ref: "<?php echo e($cartRef); ?>",
                amount: "<?php echo e($cartTotal); ?>",
                currency: "GHS",
                payment_options: "card,mobilemoneyghana,ussd",
                customer: {
                    email:'<?php echo e(user()->email); ?>',
                    phonenumber: '+233'+'<?php echo e(user()->phone); ?>',
                    name: '<?php echo e(user()->fullname); ?>',
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
                    title: '<?php echo e(getenv("APP_NAME")); ?>',
                    description: "Payment for items in cart",
                    logo: "<?php echo e(getenv('APP_URL')); ?>/images/logo.png",
                },
            });
        }
    </script><?php /**PATH C:\xampp7.2\htdocs\bodymassage\resources\views/includes/flutterwave.blade.php ENDPATH**/ ?>