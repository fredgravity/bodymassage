<?php $__env->startSection('title', 'Contact Us Page'); ?>
<?php $__env->startSection('data-page-id', 'contact_us'); ?>


<?php $__env->startSection('content'); ?>

    <section class="contact-us" id="contact-us">

        <div class="grid-container">



            <div class="grid-padding-x grid-x">

                <div class="medium-2 cell">

                </div>

                <div class="small-12 medium-8 cell">


                    <form action="/contact_us" method="post" id="contact-us-form">

                        <h3 class="text-center contact-artisao-heading">Contact Us</h3>
                        <?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <label for="fullname">Full Name</label>
                        <input type="text" id="fullname" name="fullname" value="<?php echo e(\App\classes\Request::oldData('post', 'fullname')); ?>">

                        <?php if(isAuthenticated()): ?>
                            <label for="email">Email Address</label>
                            <input type="text" id="email" name="email" value="<?php echo e(user()->email); ?>" >
                            <?php else: ?>
                            <label for="email">Email Address</label>
                            <input type="text" id="email" name="email" value="<?php echo e(\App\classes\Request::oldData('post', 'email')); ?>">
                        <?php endif; ?>


                        <label for="phone">Phone Number (optional)</label>
                        <input type="text" id="phone" name="phone" value="<?php echo e(\App\classes\Request::oldData('post', 'phone')); ?>">

                        <label for="message">Message to Us</label>
                        <textarea id="message"  cols="10" rows="10" name="message" ><?php echo e(\App\classes\Request::oldData('post', 'message')); ?></textarea>

                        <input type="submit" class="button primary" value="Send" id="contact-us-btn">
                        <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::generate()); ?>">

                    </form>

                </div>

                <div class="medium-2 column">

                </div>

            </div>

        </div>

    </section>



<?php $__env->stopSection(); ?>

<script src="https://www.google.com/recaptcha/api.js?render=<?php echo e(getenv('GR_SITE_KEY')); ?>"></script>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp7.2\htdocs\bodymassage\resources\views//contactus.blade.php ENDPATH**/ ?>