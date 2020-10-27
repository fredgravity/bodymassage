<header class="navigation">

    <div class="hide-for-medium">
        <div class="title-bar" data-responsive-toggle="main-menu" data-hide-for="medium">
            <div class="cell clearfix">
                <button class="menu-icon menu_icon float-left" type="button" data-toggle="responsive-menu"></button>
                <a href="/" class="float-right" ><img class="float-right" src="/images/logo.png" alt="logo" style="height: 2rem; width: 3rem;"> </a>
            </div>

        </div>


        <div class="top-bar my-top-bar menu_icon_display" id="main-menu">

            <div class="top-bar-left">
                <ul class=" menu vertical text-center">

                    <li><a href="/massages">Massages</a></li>
                    <li><a href="/bookings">Bookings</a></li>
                    <li><a href="/contact_us">Contact Us</a></li>
                    <li><a href="/about_us">About Us</a></li>
                    <li><a href="/corporate">Corporate</a></li>
                </ul>
            </div>
            <div class="top-bar-right ">
                

                    <?php if(!isAuthenticated()): ?>
                    
                <ul class="menu vertical text-center ">

                        <li><a href="/login">Login</a></li>
                        <li><a href="/register">Register</a></li>
                    <?php else: ?>

                        
                <ul class="menu text-center ">

                        <li>

                            <?php if(user()->image_path): ?>
                                <?php if(user()->role === "admin"): ?>
                                    <a href="/admin/<?php echo e(user()->username); ?>">
                                        <img src="/images/defaults/defaultProfile.png" alt="<?php echo e(user()->username); ?>" class="nav-user-image" style="width: 40px; height: 40px; border-radius: 50%;"><?php echo e(user()->username); ?>

                                    </a>
                                <?php else: ?>
                                    <a href="/profile/<?php echo e(user()->username); ?>">
                                        <img src="/<?php echo e(user()->image_path); ?>" alt="<?php echo e(user()->username); ?>" class="nav-user-image" style="width: 40px; height: 40px; border-radius: 50%;"> <?php echo e(user()->username); ?>

                                    </a>
                                <?php endif; ?>

                            <?php else: ?>
                                <?php if(user()->role === "admin"): ?>
                                    <a href="/admin/<?php echo e(user()->username); ?>">
                                        <img src="/images/defaults/defaultProfile.png" alt="<?php echo e(user()->username); ?>" class="nav-user-image" style="width: 40px; height: 40px; border-radius: 50%;"><?php echo e(user()->username); ?>

                                    </a>
                                <?php else: ?>
                                    <a href="/profile/<?php echo e(user()->username); ?>">
                                        <img src="/images/defaults/defaultProfile.png" alt="<?php echo e(user()->username); ?>" class="nav-user-image" style="width: 40px; height: 40px; border-radius: 50%;"><?php echo e(user()->username); ?>

                                    </a>
                                <?php endif; ?>

                            <?php endif; ?>

                        </li>
                        <li class="nav-logout-sc"><a href="/logout">Logout</a></li>
                        <?php if(isAuthenticated()): ?>
                            <?php if(isset($count)): ?>
                                <li id="cart-icon" class="nav-logout cart-icon" ><a href="/bookings/cart">Cart <span class="cart-icon-span">(<?php echo e($count); ?>)</span></a></li>
                            <?php else: ?>
                                <li id="cart-icon" class="nav-logout cart-icon" ><a href="/bookings/cart">Cart <span class="cart-icon-span"></span></a></li>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>


                </ul>
            </div>
        </div>
    </div>


    <div class="show-for-medium">
        <div class="top-bar my-top-bar" id="main-menu">

            <div class="top-bar-title show-for-medium">
                <a href="/" class="logo"><img src="/images/logo.png" alt="logo" style="height: 3rem; width: 4rem;"></a>
            </div>

            <div class="top-bar-left">
                <ul class="dropdown menu vertical medium-horizontal" data-dropdown-menu>

                    <li><a href="/massages">Massages</a></li>
                    <li><a href="/bookings">Bookings</a></li>
                    <li><a href="/contact_us">Contact Us</a></li>
                    <li><a href="/about_us">About Us</a></li>
                    <li><a href="/corporate">Corporate</a></li>
                </ul>
            </div>
            <div class="top-bar-right">
                <ul class="menu ">

                    <?php if(!isAuthenticated()): ?>
                        <li><a href="/login">Login</a></li>
                        <li><a href="/register">Register</a></li>
                        <?php else: ?>
                        <li>

                            <?php if(user()->image_path): ?>
                                <?php if(user()->role === "admin"): ?>
                                    <a href="/admin/<?php echo e(user()->username); ?>">
                                        <img src="/images/defaults/defaultProfile.png" alt="<?php echo e(user()->username); ?>" class="nav-user-image" style="width: 40px; height: 40px; border-radius: 50%;"><?php echo e(user()->username); ?>

                                    </a>
                                    <?php else: ?>
                                    <a href="/profile/<?php echo e(user()->username); ?>">
                                        <img src="/<?php echo e(user()->image_path); ?>" alt="<?php echo e(user()->username); ?>" class="nav-user-image" style="width: 40px; height: 40px; border-radius: 50%;"> <?php echo e(user()->username); ?>

                                    </a>
                                <?php endif; ?>

                            <?php else: ?>
                                <?php if(user()->role === "admin"): ?>
                                    <a href="/admin/<?php echo e(user()->username); ?>">
                                        <img src="/images/defaults/defaultProfile.png" alt="<?php echo e(user()->username); ?>" class="nav-user-image" style="width: 40px; height: 40px; border-radius: 50%;"><?php echo e(user()->username); ?>

                                    </a>
                                <?php else: ?>
                                    <a href="/profile/<?php echo e(user()->username); ?>">
                                        <img src="/images/defaults/defaultProfile.png" alt="<?php echo e(user()->username); ?>" class="nav-user-image" style="width: 40px; height: 40px; border-radius: 50%;"><?php echo e(user()->username); ?>

                                    </a>
                                <?php endif; ?>

                            <?php endif; ?>
                           
                        </li>
                        <li class="nav-logout"><a href="/logout" >Logout</a></li>

                        <?php if(isAuthenticated()): ?>

                            <?php if(isset($count)): ?>
                                <li id="cart-icon" class="nav-logout cart-icon" ><a href="/bookings/cart"><i class="fa fa-book"></i>Cart <span class="cart-icon-span">(<?php echo e($count); ?>)</span></a></li>
                                <?php else: ?>
                                <li id="cart-icon" class="nav-logout cart-icon" ><a href="/bookings/cart"><i class="fa fa-book"></i>Cart <span class="cart-icon-span"></span></a></li>
                                <?php endif; ?>

                        <?php endif; ?>
                    <?php endif; ?>


                </ul>
            </div>
        </div>
    </div>



</header>


































<?php /**PATH C:\xampp7.2\htdocs\bodymassage\resources\views/includes/_nav.blade.php ENDPATH**/ ?>