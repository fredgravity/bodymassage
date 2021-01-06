<?php $__env->startSection('title', 'User Profile'); ?>
<?php $__env->startSection('data-page-id', 'userDashboard'); ?>


<?php $__env->startSection('content'); ?>

    <div class="dashboard admin_shared grid-container full" data-equalizer data-equalizer-on="medium">
        <div class="grid-padding-x grid-x " >

            
            <div class="small-12 medium-6 cell summary" data-equalizer-watch>

                <div class="card">
                    <div class="card-section">
                        <div class="grid-x grid-padding-x">
                            <div class="small-3 cell">
                                <i class="fa fa-shopping-cart icons" aria-hidden="true"></i>
                            </div>
                            <div class="small-9 cell summary-text">
                                <p>Total Orders</p> <h4><?php echo e($orders); ?></h4>
                            </div>
                        </div>
                    </div>

                    <div class="card-divider">
                        <div class="cell text-right summary-divider">
                            <a href="/profile/<?php echo e(user()->username); ?>/my_orders">Order Details</a>
                        </div>
                    </div>
                </div>

            </div>



            
            <div class="small-12 medium-6 cell summary" data-equalizer-watch >

                <div class="card">
                    <div class="card-section">
                        <div class="grid-padding-x grid-x">
                            <div class="small-3 cell">
                                <i class="fa fa-hand-holding-usd icons" aria-hidden="true"></i>
                            </div>
                            <div class="small-9 cell summary-text">
                                <p>Orders Paid</p> <h4>GHS <?php echo e(number_format($payments, 2)); ?></h4>
                                
                            </div>
                        </div>
                    </div>

                    <div class="card-divider">
                        <div class="cell text-right summary-divider">
                            <a href="/profile/<?php echo e(user()->username); ?>/my_payments">Payment Details</a>
                        </div>
                    </div>
                </div>

            </div>



        </div>

        <div class="grid-x grid-padding-x  graph">
            <div class="small-12 medium-6 cell monthly-sales">
                <div class="card">

                    <div class="card-section">
                        <h4>Monthly Orders</h4>
                        <canvas id="monthly-order"></canvas>
                    </div>

                </div>
            </div>

            <div class="small-12 medium-6 cell monthly-revenue">
                <div class="card">

                    <div class="card-section">
                        <h4>Monthly Payment</h4>
                        <canvas id="monthly-revenue"></canvas>
                    </div>

                </div>
            </div>

        </div>


        <div class="grid-x grid-padding-x">
            <div class="small-12 medium-12 cell yearly-sales">
                <div class="card">

                    <div class="card-section">
                        <h4 class="text-center">Yearly Analysis</h4>
                        <canvas id="yearly-orders"></canvas>
                    </div>

                </div>

            </div>

        </div>


        <div class="grid-padding-x grid-x">

            <h5 class="cell text-center">Order History</h5>
            <div class="small-12 medium-12 cell">

                <table class="table-scroll hover " >
                    <thead>
                    <th>Image</th>
                    <th>Massage Type</th>
                    <th>Address</th>

                    <th>Status(payment|work)</th>
                    </thead>

                    <tbody class="overflow-y-scroll" style="height: 50px !important; overflow-y: auto; overflow-x: auto;">
                        <?php $__currentLoopData = $order_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><img src="/<?php echo e($order->product['image_path']); ?>" alt="<?php echo e($order->product['product_name']); ?>" style="width: 50px;"></td>
                                <td><?php echo e($order->product['product_name']); ?></td>
                                <td><?php echo e($order->place_name); ?></td>
                                <td><button class="button warning small" style="margin: 0;"><?php echo e($order->status); ?></button>
                                    <span><button class="button info small" style="margin: 0;">Complete</button></span>
                                </td>


                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>
                </table>

            </div>

        </div>





    </div>




<?php $__env->stopSection(); ?>



<?php echo $__env->make('layout.profile_base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp7.2\htdocs\bodymassage\resources\views/user/dashboard.blade.php ENDPATH**/ ?>