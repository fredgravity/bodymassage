<form >
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <button type="button" class="button warning expanded" onclick="payWithPaystack()"> Pay Now! @include('includes.spinner')</button>
</form>

<script>

    function payWithPaystack(){

        $('.load-spinner').show();

        let sess = [];
        let user = [];
        let cartTotal = '';
        let token = '{{ $token }}';
        let postData = $.param({token:token});
        axios.post('/cart/get_session_info', postData).then(function(res){

            sess = res.data.res;
            user = res.data.user;
            cartTotal = res.data.total;

// console.log(res.data);

            let paystackKey = '';
            if ('{{ getenv('APP_ENV') }}' === 'local'){
                paystackKey = '{{ getenv('PAYSTACK_TEST_PUBLIC_KEY') }}';
            }else{
                paystackKey = '{{ getenv('PAYSTACK_LIVE_PUBLIC_KEY') }}'
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


{{--<form action="#">--}}
{{--<script src="https://js.paystack.co/v1/inline.js"></script>--}}
{{--<button type="button" name="pay_now" id="pay-now" title="Pay now"  onclick="saveOrderThenPayWithPaystack()">Pay now</button>--}}
{{--</form>--}}

{{--<script >--}}
{{--var orderObj = $.param({--}}
{{--email_prepared_for_paystack: '{{ user()->email }}',--}}
{{--amount: '{{ $cart['cartTotal'] }}',--}}
{{--ord_id: '{{$result['orderNumber']}}'--}}
{{--// other params you want to save--}}
{{--});--}}

{{--function saveOrderThenPayWithPaystack(){--}}
{{--// Send the data to save using post--}}
{{--var posting = axios.post( '/checkout/save_payment', orderObj ).then(function (data) {--}}
{{--// payWithPaystack(data);--}}
{{--if (data.data.redirect){--}}
{{--window.location.href='booking/cart';--}}
{{--}--}}
{{--console.log(data.data.redirect);--}}
{{--}).catch(function (err) {--}}
{{--console.log(err);--}}
{{--});--}}

{{--// posting.done(function( data ) {--}}
{{--//     /* check result from the attempt */--}}
{{--//     payWithPaystack(data);--}}
{{--// });--}}
{{--// posting.fail(function( data ) { /* and if it failed... */ });--}}
{{--}--}}

{{--function payWithPaystack(data){--}}
{{--var handler = PaystackPop.setup({--}}
{{--// This assumes you already created a constant named--}}
{{--// PAYSTACK_PUBLIC_KEY with your public key from the--}}
{{--// Paystack dashboard. You can as well just paste it--}}
{{--// instead of creating the constant--}}
{{--key: "{{ getenv('PAYSTACK_TEST_PUBLIC_KEY') }}",--}}
{{--email: '{{ user()->email }}',--}}
{{--amount: "{{ $cart['cartTotal'] }}",--}}
{{--metadata: {--}}
{{--order_id: '{{$result['orderNumber']}}',--}}
{{--custom_fields: [--}}
{{--{--}}
{{--display_name: "Paid on",--}}
{{--variable_name: "paid_on",--}}
{{--value: 'Website'--}}
{{--},--}}
{{--{--}}
{{--display_name: "Paid via",--}}
{{--variable_name: "paid_via",--}}
{{--value: 'Inline Popup'--}}
{{--}--}}
{{--]--}}
{{--},--}}
{{--callback: function(response){--}}
{{--// post to server to verify transaction before giving value--}}
{{--var verifying = $.get( '/verify.php?reference=' + response.reference);--}}
{{--verifying.done(function( data ) { /* give value saved in data */ });--}}
{{--},--}}
{{--onClose: function(){--}}
{{--alert('Click "Pay now" to retry payment.');--}}
{{--}--}}
{{--});--}}
{{--handler.openIframe();--}}
{{--}--}}
{{--</script>--}}