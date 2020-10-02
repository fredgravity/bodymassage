<?php $__env->startSection('title', 'Orders'); ?>


<?php $__env->startSection('content'); ?>


    <div class="grid-container fluid product">

        <h2 class="text-center"><?php echo e($orderDetails[0]['order_number']); ?></h2>
        <hr>

        <section>

            <div class="grid-x grid-padding-x">

                <?php if(count($orderDetails)): ?>

                        <table class="hover">
                            <thead>
                                <tr>
                                    <td>Product Name</td>
                                    <td>Product Price</td>
                                    <td>Ordered By</td>
                                    <td>Email</td>
                                    <td>Address</td>
                                    <td>Phone #</td>
                                    <td>Hours</td>
                                    <td>Total </td>
                                    <td>Status</td>
                                </tr>
                            </thead>

                            <?php $__currentLoopData = $orderDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tbody>
                                <tr>
                                    <td><?php echo e($order['product']['product_name']); ?></td>
                                    <td><?php echo e($order['product']['price']); ?></td>
                                    <td><?php echo e($order['user']['username']); ?></td>
                                    <td><?php echo e($order['user']['email']); ?></td>
                                    <td><?php echo e($order['user']['address']); ?></td>
                                    <td>+233-<?php echo e($order['user']['phone']); ?></td>
                                    <td><?php echo e($order['orderDetail']['hours']); ?></td>
                                    <td><?php echo e(number_format($order['orderDetail']['total_price'],2)); ?></td>
                                    <td><?php echo e($order['orderDetail']['status']); ?></td>



                                    
                                        
                                            
                                        

                                                    

                                                    
                                                    
                                                    


                                                    
                                            
                                                
                                                
                                            
                                        
                                    

                                </tr>

                            </tbody>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>



                <?php endif; ?>

            </div>




        </section>

    </div>



    

    <?php $__env->stopSection(); ?>










<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp7.2\htdocs\bodymassage\resources\views/admin/order/indexDetails.blade.php ENDPATH**/ ?>