<form >
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <button type="button" class="button warning expanded" onclick="payWithPaystack()"> Pay Now! <?php echo $__env->make('includes.spinner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></button>
</form>

<script>

    function payWithPaystack(){

        $('.load-spinner').show();

        let sess = [];
        let user = [];
        let cartTotal = '';
        let token = '<?php echo e($token); ?>';
        let postData = $.param({token:token});
        axios.post('/cart/get_session_info', postData).then(function(res){

            sess = res.data.res;
            user = res.data.user;
            cartTotal = res.data.total;

// console.log(res.data);

            let paystackKey = '';
            if ('<?php echo e(getenv('APP_ENV')); ?>' === 'local'){
                paystackKey = '<?php echo e(getenv('PAYSTACK_TEST_PUBLIC_KEY')); ?>';
            }else{
                paystackKey = '<?php echo e(getenv('PAYSTACK_LIVE_PUBLIC_KEY')); ?>'
            }


            let handler = PaystackPop.setup({

                key: paystackKey,
                email: user.email,
                amount: cartTotal *100,
                currency: "GHS",
                ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                metadata: {
                    custom_fields: [
                        {
                            display_name: user.username,
                            variable_name: '233'+user.phone,
                            value: cartTotal
                        }
                    ]
                },
                callback: function(response){
                    // alert('success. transaction ref is ' + response.reference);
                    console.log(response);
                    let postData = $.param(response);

                    axios.post('/bookings/cart/callback', postData).then(function (response) {
                        $('.load-spinner-cart').show();
                        console.log(response.data);
                        if (response.data.redirectCart === true){
                            window.location.href = '/bookings/cart';
                        }else{
                            window.location.href = '/bookings/cart';
                        }

                    }).catch(function (err) {
                        console.log(err);
                    })
                },
                onClose: function(){
                    alert('window closed');
                    $('.load-spinner').hide();
                }
            });
            handler.openIframe();

        }).catch(function (err) {
            console.log(err);
        });



    }
</script>





































































<?php /**PATH C:\xampp7.2\htdocs\bodymassage\resources\views/includes/paystack.blade.php ENDPATH**/ ?>