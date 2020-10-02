<script src="https://developer.tingg.africa/checkout/v2/tingg-checkout.js"></script>
<script type="text/javascript" src="/js/all.js"></script>
<button class="awesome-checkout-button"></button><?php echo $__env->make('includes.spinner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
    Tingg.renderPayButton({
        className: 'awesome-checkout-button',
        checkoutType: 'redirect'
    });

    $(document).ready(function () {


        $(".awesome-checkout-button").click(function () {
            $('.load-spinner').show();
            let token = '<?php echo e($token); ?>';
            let postData = $.param({token:token});

            axios.post('/bookings/cart/payload', postData).then(function (res) {
// console.log(res.data);
                Tingg.renderCheckout({
                    merchantProperties: {
                        params: res.data.params,
                        accessKey: '<?php echo e(getenv('TINGG_ACCESS_KEY')); ?>',
                        countryCode: '<?php echo e(getenv('TINGG_COUNTRY_CODE')); ?>'
                    },
                    checkoutType: 'modal' // or ‘redirect’
                });

            }).catch(function (err) {
                console.log(err);
            });

            // console.log(token);

        });

    });
</script>


<?php /**PATH C:\xampp7.2\htdocs\bodymassage\resources\views/includes/tingg.blade.php ENDPATH**/ ?>