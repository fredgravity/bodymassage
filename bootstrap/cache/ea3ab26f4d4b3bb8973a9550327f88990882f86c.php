<?php $__env->startSection('title', 'Edit User'); ?>


<?php $__env->startSection('content'); ?>


    <div class="grid-container fluid product">

        <h2 class="text-center">Edit User - <?php echo e($user->username); ?></h2>
        <hr>

        <section>


            <?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <section>
                <div class="grid-padding-x grid-x ">

                    <div class="small-12 medium-6 cell">
                        <form action="/profile/<?php echo e($user->username); ?>/users/<?php echo e($user->id); ?>/update_user" method="post" enctype="multipart/form-data">

                            <label for="fullname">Full Name:</label>
                            <input type="text" id="fullname" name="fullname" value="<?php echo e($user->fullname); ?>">

                            <label for="address">Address:</label>
                            <input type="text" id="address" name="address" value="<?php echo e($user->address); ?>">

                            <label for="region">Region:</label>
                            <input type="text" id="region" name="region" value="<?php echo e($user->region); ?>">

                            <label for="city">City Name:</label>
                            <input type="text" id="city" name="city" value="<?php echo e($user->city); ?>">

                            <label for="phone">Phone Number:</label>
                            <input type="text" id="phone" name="phone" value="<?php echo e($user->phone); ?>">

                            <label for="gps">GhanaPost GPS Code:</label>
                            <input type="text" id="gps" name="gps" value="<?php echo e($user->gps); ?>">

                            <label for="role">Role:</label>
                            <select name="role" id="role">
                                <option value="user">User</option>
                                <option value="worker">Worker</option>
                            </select>

                            <label for="userImage" class="button">Upload Image</label>
                            <input type="file" id="userImage" class="show-for-sr" name="userImage">

                            <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::generate()); ?>">

                            <div>
                                <input type="submit" class="button expanded" value="Update">
                            </div>


                        </form>

                    </div>


                </div>

            </section>

        </section>

    </div>



    

    <?php $__env->stopSection(); ?>










<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp7.2\htdocs\bodymassage\resources\views/admin/user/editUser.blade.php ENDPATH**/ ?>