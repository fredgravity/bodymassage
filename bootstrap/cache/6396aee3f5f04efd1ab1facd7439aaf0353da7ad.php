<?php $__env->startSection('title', 'Register an Account'); ?>
<?php $__env->startSection('data-page-id', 'auth'); ?>

<?php $__env->startSection('content'); ?>

<section class="auth-register" id="auth-register">
    <div class="grid-container fluid product">
        
            
        
            
        

        <section>

            <div class="grid-padding-x grid-x ">

                <div class="medium-3 cell">

                </div>

                <div class="small-12 medium-6 cell">
                    <h2 class="text-center">Register</h2>

                    
                    <?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                    <form action="/register" method="post" enctype="multipart/form-data" id="register-form">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value="<?php echo e(\App\Classes\Request::oldData('post', 'username')); ?>">

                        <label for="fullname">Full Name:</label>
                        <input type="text" id="fullname" name="fullname" value="<?php echo e(\App\Classes\Request::oldData('post', 'fullname')); ?>">

                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo e(\App\Classes\Request::oldData('post', 'email')); ?>">

                        <label for="phone">Phone Number:</label>
                        <input type="text" id="phone" name="phone" value="<?php echo e(\App\Classes\Request::oldData('post', 'phone')); ?>">

                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" value="<?php echo e(\App\Classes\Request::oldData('post', 'password')); ?>">

                        <label for="confirm-password">Confirm Password:</label>
                        <input type="password" id="confirm-password" name="confirmPassword" value="<?php echo e(\App\Classes\Request::oldData('post', 'confirmPassword')); ?>">



                        <?php if(user() && user()->role == 'admin'): ?>

                            <label for="address">Address:</label>
                            <input type="text" id="address" name="address" value="<?php echo e(\App\Classes\Request::oldData('post', 'address')); ?>">

                            <label for="region">Region:</label>
                            
                            <select name="region" id="region">
                                <option value="greater_accra_region">Greater Accra Region</option>

                            </select>

                            <label for="city">City Name:</label>
                            <input type="text" id="city" name="city" value="<?php echo e(\App\Classes\Request::oldData('post', 'city')); ?>">



                            <label for="role">Role:</label>
                            <select name="role" id="role">
                                <option value="user">User</option>
                                <option value="worker">Worker</option>
                            </select>

                            <label for="userImage" class="button">Upload Image</label>
                            <input type="file" id="userImage" class="show-for-sr" name="userImage">
                        <?php endif; ?>

                        <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::generate()); ?>">

                        <div>
                            
                            <button class="button hollow float-right" id="register-btn">Register <?php echo $__env->make('includes.spinner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></button>
                        </div>
                        <div>
                            <p>
                                Before your register please check out our <a href="/terms_and_condition">Terms and Conditions</a> as well as our
                                <a href="/privacy">Privacy Policy.</a>
                            </p>
                        </div>



                    </form>

                </div>


            </div>

        </section>

    </div>
</section>

    

    <?php $__env->stopSection(); ?>

<script src="https://www.google.com/recaptcha/api.js?render=<?php echo e(getenv('GR_SITE_KEY')); ?>"></script>








<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp7.2\htdocs\bodymassage\resources\views/auth/register.blade.php ENDPATH**/ ?>