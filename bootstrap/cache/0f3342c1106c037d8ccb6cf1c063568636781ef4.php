<?php $__env->startSection('title', 'Users'); ?>


<?php $__env->startSection('content'); ?>


    <div class="grid-container fluid product">

        <h2 class="text-center">
            <?php if($role ==='user'): ?>
                Users
                <?php elseif($role === 'worker'): ?>
                Workers
            <?php endif; ?>
        </h2>
        <hr>

        <section>

            <?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="grid-x grid-padding-x">

                <div class="small-12 medium-6 cell">
                    <?php if($role ==='user'): ?>
                        <form action="/search/user" method="post" class="input-group">
                            <input type="text" placeholder="Search User" name="search" class="input-group-field">
                            <div class="input-group-button">
                                <input type='submit' class="button" value="Search">
                            </div>
                            <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::generate()); ?>">
                        </form>
                        <?php else: ?>
                        <form action="/search/worker" method="post" class="input-group">
                            <input type="text" placeholder="Search User" name="search" class="input-group-field">
                            <div class="input-group-button">
                                <input type='submit' class="button" value="Search">
                            </div>
                            <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::generate()); ?>">
                        </form>

                    <?php endif; ?>

                </div>
                or
                <div class="small-12 medium-5 cell">
                    <a href="/profile/<?php echo e(user()->username); ?>/users/register" class="button" >Create</a>
                </div>


            </div>


            <div class="grid-x grid-padding-x cell">
                <?php if($role === 'user'): ?>
                    <?php if(count($users)): ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Full Name</th>
                                    <th>Address</th>
                                    <th>Region</th>
                                    <th>City</th>
                                    <th>Phone Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                <tbody>
                                <tr>
                                    <td><?php echo e($user['username']); ?></td>
                                    <td><?php echo e($user['email']); ?></td>
                                    <td><?php echo e($user['fullname']); ?></td>
                                    <td><?php echo e($user['address']); ?></td>
                                    <td><?php echo e($user['region']); ?></td>
                                    <td><?php echo e($user['city']); ?></td>
                                    <td>+233-<?php echo e($user['phone']); ?></td>
                                    <td>
                                        <span data-tooltip class="has-tip top" tabindex="1" title="Edit User" >
                                            <a href='/profile/<?php echo e(user()->username); ?>/users/<?php echo e($user['id']); ?>/edit_user'><i class="fa fa-edit" title="Edit User"></i></a>
                                        </span>

                                        &nbsp;

                                        
                                            
                                        


                                        <span data-tooltip class="has-tip top" tabindex="1" title="Delete User">
                                            <form action='/profile/<?php echo e(user()->username); ?>/users/<?php echo e($user['id']); ?>/delete_user' method="post" class="delete-user">
                                                <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::generate()); ?>">
                                                <button type="submit"><i class="fa fa-times delete"></i></button>
                                            </form>
                                        </span>
                                    </td>
                                    </tr>

                                </tbody>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>
                    <?php endif; ?>
<?php echo $__env->make('includes.paginate_links', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        
                            
                        

                    <?php endif; ?>

                    <?php if($role === 'worker'): ?>
                        <?php if(count($workers)): ?>
                            <table>
                                <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Full Name</th>
                                    <th>Address</th>
                                    <th>Region</th>
                                    <th>City</th>
                                    <th>Phone Number</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <?php $__currentLoopData = $workers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <tbody>
                                    <tr>
                                        <td><?php echo e($user['username']); ?></td>
                                        <td><?php echo e($user['email']); ?></td>
                                        <td><?php echo e($user['fullname']); ?></td>
                                        <td><?php echo e($user['address']); ?></td>
                                        <td><?php echo e($user['region']); ?></td>
                                        <td><?php echo e($user['city']); ?></td>
                                        <td>+233-<?php echo e($user['phone']); ?></td>
                                        <td>
                                        <span data-tooltip class="has-tip top" tabindex="1" title="Edit Worker" >
                                            <a href='/profile/<?php echo e(user()->username); ?>/users/<?php echo e($user['id']); ?>/edit_worker'><i class="fa fa-edit" title="Edit Worker"></i></a>
                                        </span>

                                            &nbsp;

                                            
                                            
                                            


                                            <span data-tooltip class="has-tip top" tabindex="1" title="Delete Worker">
                                            <form action='/profile/<?php echo e(user()->username); ?>/users/<?php echo e($user['id']); ?>/delete_user' method="post" class="delete-worker">
                                                <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::generate()); ?>">
                                                <button type="submit"><i class="fa fa-times delete"></i></button>
                                            </form>
                                        </span>
                                        </td>
                                    </tr>

                                    </tbody>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </table>

                        <?php endif; ?>
<?php echo $__env->make('includes.paginate_links', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        
                            
                            

                    <?php endif; ?>
            </div>


        </section>

    </div>



    

    <?php $__env->stopSection(); ?>










<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp7.2\htdocs\bodymassage\resources\views/admin/user/index.blade.php ENDPATH**/ ?>