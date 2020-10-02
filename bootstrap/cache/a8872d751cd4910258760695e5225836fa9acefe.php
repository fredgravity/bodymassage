<?php $__env->startSection('title', 'Corporate Page'); ?>
<?php $__env->startSection('data-page-id', 'corporate'); ?>


<?php $__env->startSection('content'); ?>

    <section class="corporate" id="corporate">
        <h2 class="text-center">Corporate Massage</h2>
        <hr>
        <?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="grid-x grid-padding-x">


            <div class="small-12 medium-6 text-justify">
                <p>This is an offline service available to both individuals and corporations. We have two main services to choose from:</p>
                <ul>
                    <li>Regular Contracted Service (<em>where the client contract us to offer therapy at regular time periods for a specific duration at an agreed payment terms</em>) .</li>
                </ul>
                <ul>
                    <li>One-off Event Service (<em>where the clients request a one-off quote for a specific event or gathering with specific number of people to be massaged. Payment for such is made 48 hours prior to commencement of the event</em>)</li>
                </ul>
                <p>You can choose from among the following types of massage to meet your needs under corporate massage:</p>
                <ul>
                    <li>Chair massage</li>
                    <li>Reflexology</li>
                    <li>Deep tissue massage</li>
                    <li>Swedish massage</li>
                </ul>
            </div>

            <div class="small-12 medium-5 medium-offset-1">
                <form action="/corporate/quote" method="post">
                    <label for="fullname">Fullname:</label>
                    <input type="text" id="fullname" name="fullname" >

                    <label for="organisation">Organisation:</label>
                    <input type="text" id="organisation" name="organisation" >

                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" >

                    <label for="phone">Phone Number:</label>
                    <input type="text" id="phone" name="phone" >

                    <label for="needs">What are your needs?</label>
                    <textarea name="needs" id="needs" cols="30" rows="7"></textarea>

                    <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::generate()); ?>">

                    <input type="submit" class="button hollow float-right" value="Request" >
                </form>
            </div>





        </div>




    </section>



<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp7.2\htdocs\bodymassage\resources\views//corporate.blade.php ENDPATH**/ ?>