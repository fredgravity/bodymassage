<?php $__env->startSection('title', 'My Orders'); ?>
<?php $__env->startSection('data-page-id', 'myOrders'); ?>


<?php $__env->startSection('content'); ?>


    <div class="grid-container fluid product">

        <h2 class="text-center">My Orders</h2>
        <hr>

        <section>

            <div class="grid-x grid-padding-x">

                <?php if(count($orders)): ?>

                        <table class="hover">
                            <thead>
                                <tr>
                                    <td>Product Name</td>
                                    <td>Product Price</td>
                                    
                                    
                                    <td>Address</td>
                                    
                                    <td>Hours</td>
                                    <td>Total </td>
                                    <td>Paid Status</td>
                                    <td>Reference No.</td>
                                </tr>
                            </thead>

                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tbody>
                                <tr>
                                    <td><?php echo e($order['product']['product_name']); ?></td>
                                    <td><?php echo e($order['product']['price']); ?></td>
                                    
                                    
                                    <td><?php echo e($order['user']['address']); ?></td>
                                    
                                    <td><?php echo e($order['orderDetail']['hours']); ?></td>
                                    <td><?php echo e($order['orderDetail']['total_price']); ?></td>
                                    <td><?php echo e($order['orderDetail']['status']); ?></td>
                                    <td><?php echo e($order['orderDetail']['reference_no']); ?></td>



                                    
                                        
                                            
                                        

                                                    

                                                    
                                                    
                                                    


                                                    
                                            
                                                
                                                
                                            
                                        
                                    

                                </tr>

                            </tbody>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>



                <?php endif; ?>

            </div>




        </section>

    </div>



    

    <?php $__env->stopSection(); ?>










<?php echo $__env->make('layout.profile_base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp7.2\htdocs\bodymassage\resources\views/user/orderDetails.blade.php ENDPATH**/ ?>