
<div class="reveal small" id="card_modal" data-reveal>
    <div class="grid-container fluid ">

        <div class="grid-padding-x grid-x ">



            <form action="" class="cell medium-8 float-center">

                <div class="cell medium-12" id="card_error">

                </div>

                <div class="cell medium-12">
                    <label for="card_no">Card Number</label>
                    <input type="number" name="card_no" id="card_no" placeholder="0000 0000 0000 0000" max="16">
                </div>

                <div class="medium-12 cell">
                    <div class="grid-padding-x grid-x">
                        <div class="cell medium-4">
                            <label for="month">Month</label>
                            <input type="number" name="month" id="month" max="2" placeholder="mm">
                        </div>

                        <div class="cell medium-4">
                            <label for="year">Year</label>
                            <input type="number" name="year" id="year" max="2" placeholder="yy">
                        </div>
                        <div class="cell medium-4">
                            <label for="cvv">CVV</label>
                            <input type="number" name="cvv" id="cvv" min="1" max="999" placeholder="123">
                        </div>
                    </div>

                </div>

                <input type="hidden" name="token" id="card_token" value="<?php echo e(\App\Classes\CSRFToken::generate()); ?>">

                <div class="medium-12 cell" >
                    <button class="button success expanded hollow" id="card_submit">Pay Now! <span><?php echo $__env->make('includes.spinner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></span></button>
                </div>

            </form>

        </div>

    </div>

    <button class="close-button" data-close aria-label="Close modal" type="button">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php /**PATH C:\xampp7.2\htdocs\bodymassage\resources\views/forms/cardPayment.blade.php ENDPATH**/ ?>