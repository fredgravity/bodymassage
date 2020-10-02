<?php $__env->startSection('title', 'Login to your Account'); ?>
<?php $__env->startSection('data-page-id', 'auth'); ?>


<?php $__env->startSection('content'); ?>

    <div class="auth-login " id="auth-login">

        
        
        

        


        <section class="login_form grid-container">

            <div class="grid-x grid-padding-x" style="padding-top: 30px;">

                <div class="medium-2 cell">

                </div>

                <div class="cell small-12 medium-7 ">

                    <h2 class="text-center">Login</h2>

                    
                    <?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    
                    <form action="/login" method="post" id="login-form">

                        <input type="text" name="username" placeholder="username or email" value="<?php echo e(\App\classes\Request::oldData('post', 'username')); ?>">

                        <input type="password" name="password" placeholder="password">

                        <label for="remember">
                            <input type="checkbox" name="remember_me" id="remember" value=""> Remember Me
                        </label>

                        <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::generate()); ?>">

                        
                        <input type="submit" class="button hollow float-right ">
                    </form>

                    <p>Don't have an Account? <a href="/register"> Register Here </a></p>
                    
                </div>

            </div>

        </section>



    </div>




<?php $__env->stopSection(); ?>

<script src="https://www.google.com/recaptcha/api.js?render=<?php echo e(getenv('GR_SITE_KEY')); ?>"></script>






















































<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp7.2\htdocs\bodymassage\resources\views/auth/login.blade.php ENDPATH**/ ?>