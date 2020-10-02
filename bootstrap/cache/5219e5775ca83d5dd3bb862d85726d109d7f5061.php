<?php $__env->startSection('title', 'User Change Password'); ?>
<?php $__env->startSection('data-page-id', 'changePassword'); ?>


<?php $__env->startSection('content'); ?>

    <section>

        <div class="grid-padding-x grid-x">
            <div class="cell small-12 medium-8 float-center">

                <?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <form action="/profile/<?php echo e($user->username); ?>/<?php echo e($user->id); ?>/change_password" method="post" >
                    <fieldset class="fieldset">
                        <legend><h2>Change Password</h2></legend>
                        <div>
                            <label for="old_password">Old Password:</label>
                            <input type="password" name="old_password" placeholder="type in the old password">
                        </div>

                        <div>
                            <label for="new_password">New Password:</label>
                            <input type="password" name="new_password" placeholder="type in the new password">
                        </div>

                        <div>
                            <label for="confirm_password">Confirm Password:</label>
                            <input type="password" name="confirm_password" placeholder="confirm password">
                        </div>

                        <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::generate()); ?>">
                        <input type="submit"  value="Change" class="button warning float-right">
                    </fieldset>
                </form>

            </div>
        </div>


    </section>



    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.profile_base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp7.2\htdocs\bodymassage\resources\views//user/changePassword.blade.php ENDPATH**/ ?>