<?php $__env->startSection('title', 'User Profile'); ?>
<?php $__env->startSection('data-page-id', 'auth'); ?>

<?php $__env->startSection('content'); ?>

<section class="auth-register" id="auth-register">
    <div class="grid-container fluid product">
        
            
        
            
        

        <section>

            <div class="grid-padding-x grid-x ">

                <div class="medium-3 cell">

                </div>

                <div class="small-12 medium-6 cell">
                    <h2 class="text-center">Profile Details</h2>

                    
                    <?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                    <form action="/profile/<?php echo e($user->username); ?>/profile" method="post" enctype="multipart/form-data">

                        <label for="fullname">Full Name:</label>
                        <input type="text" id="fullname" name="fullname" value="<?php echo e($user->fullname); ?>">


                        <?php if(user()): ?>

                            
                            

                            <label for="region">Region:</label>
                            
                            <select name="region" id="region">
                                <option value="greater accra region">Greater Accra Region</option>

                            </select>

                            <label for="city">City Name:</label>
                            <input type="text" id="city" name="city" value="<?php echo e($user->city); ?>">

                            <label for="phone">Phone Number:</label>
                            <input type="text" id="phone" name="phone" value="<?php echo e($user->phone); ?>">

                            <label for="gps">GhanaPost GPS Code:</label>
                            <input type="text" id="gps" name="gps" value="<?php echo e($user->gps); ?>">

                            <label for="address">Address:</label>
                            <textarea name="address" id="address" cols="30" rows="5"><?php echo e($user->address); ?></textarea>

                            <label for="userImage" class="button">Upload Image</label>
                            <input type="file" id="userImage" class="show-for-sr" name="userImage">


                        <?php endif; ?>

                        <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::generate()); ?>">

                        <div>
                            <input type="submit" class="button hollow float-right" value="Create">
                        </div>


                    </form>

                </div>


            </div>

        </section>

    </div>
</section>




    

    <?php $__env->stopSection(); ?>










<?php echo $__env->make('layout.profile_base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp7.2\htdocs\bodymassage\resources\views/user/profile.blade.php ENDPATH**/ ?>