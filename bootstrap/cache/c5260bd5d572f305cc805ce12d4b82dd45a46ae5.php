    <div class="off-canvas position-right reveal-for-large admin-nav" id="offCanvas" data-off-canvas data-transition="overlap">

    <!-- Close button -->
    <!--        <button class="close-button" aria-label="Close menu" type="button" data-close>-->
    <!--            <span aria-hidden="true">&times;</span>-->
    <!--        </button>-->

    <h3>Welcome!!</h3>

    <div class="image-holder text-center">
        <?php if(user()->image_path == ''): ?>
            <img src="/images/defaults/defaultProfile.png" alt="default_profile" style="width: 200px; height: 200px;">
        <?php else: ?>
            <img src="/<?php echo e(user()->image_path); ?>" alt="<?php echo e(user()->username); ?>" title="<?php echo e(user()->username); ?>_profile" style="width: 200px; height: 200px;">
        <?php endif; ?>

        <p><?php echo e(ucfirst(user()->username)); ?></p>
    </div>

    <!-- side bar -->
    <ul class="vertical menu">
        <li><a href="/profile/<?php echo e(user()->username); ?>"><i class="fa fa-tachometer-alt" aria-hidden="true"></i>&nbsp;Dashboard</a></li>
        <li><a href="/profile/<?php echo e(user()->username); ?>/profile"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Profile</a></li>
        <li><a href="/profile/<?php echo e(user()->username); ?>/change_password"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;Change Password</a></li>
        <li><a href="/profile/<?php echo e(user()->username); ?>/my_orders"><i class="fa fa-shuttle-van" aria-hidden="true"></i>&nbsp;Orders</a></li>
        <li><a href="/profile/<?php echo e(user()->username); ?>/my_payments"><i class="fa fa-money-bill" aria-hidden="true"></i>&nbsp;Payments</a></li>

        <li><a href="/logout"><i class="fa fa-sign-out-alt" aria-hidden="true"></i>&nbsp;Logout</a></li>

    </ul>

</div><?php /**PATH C:\xampp7.2\htdocs\bodymassage\resources\views/includes/user-sidebar.blade.php ENDPATH**/ ?>