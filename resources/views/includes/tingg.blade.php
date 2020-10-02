<script src="https://developer.tingg.africa/checkout/v2/tingg-checkout.js"></script>
<script type="text/javascript" src="/js/all.js"></script>
<button class="awesome-checkout-button"></button>@include('includes.spinner')

<script>
    Tingg.renderPayButton({
        className: 'awesome-checkout-button',
        checkoutType: 'redirect'
    });

    $(document).ready(function () {


        $(".awesome-checkout-button").click(function () {
            $('.load-spinner').show();
            let token = '{{$token}}';
            let postData = $.param({token:token});

            axios.post('/bookings/cart/payload', postData).then(function (res) {
// console.log(res.data);
                Tingg.renderCheckout({
                    merchantProperties: {
                        params: res.data.params,
                        accessKey: '{{ getenv('TINGG_ACCESS_KEY') }}',
                        countryCode: '{{getenv('TINGG_COUNTRY_CODE')}}'
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


