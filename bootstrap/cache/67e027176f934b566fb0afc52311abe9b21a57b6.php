<?php $__env->startSection('title', 'My Payments'); ?>
<?php $__env->startSection('data-page-id', 'myPayments'); ?>


<?php $__env->startSection('content'); ?>


    <div class="grid-container fluid product">

        <h2 class="text-center">My Payments - GHS <?php echo e(number_format($amount, 2)); ?></h2>
        <hr>

        <section>
            

                
                    
                        
                        
                            
                        
                        
                    
                

                
                    
                

            

            

            <div class="grid-x grid-padding-x">

                <?php if(count($payments)): ?>

                        <table class="hover">
                            <thead>
                                <tr>
                                    <td>Order Number</td>
                                    <td>Total Amount</td>
                                    <td>Username</td>
                                    <td>Email</td>
                                    <td>Status</td>
                                    <td>Address</td>
                                    <td>Phone</td>

                                </tr>
                            </thead>

                            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tbody>
                                <tr>
                                    <td><?php echo e($payment['order_number']); ?></td>
                                    <td><?php echo e($payment['amount']); ?></td>
                                    <td><?php echo e($payment['user']['username']); ?></td>
                                    <td><?php echo e($payment['user']['email']); ?></td>
                                    <td><?php echo e($payment['status']); ?></td>
                                    <td><?php echo e($payment['user']['address']); ?></td>
                                    <td>233-<?php echo e($payment['user']['phone']); ?></td>

                                    
                                    



                                </tr>

                            </tbody>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>



                <?php endif; ?>

            </div>


        </section>

    </div>



    

    <?php $__env->stopSection(); ?>










<?php echo $__env->make('layout.profile_base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp7.2\htdocs\bodymassage\resources\views/user/paymentDetails.blade.php ENDPATH**/ ?>