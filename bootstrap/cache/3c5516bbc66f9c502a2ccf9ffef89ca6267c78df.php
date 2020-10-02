<?php $__env->startSection('title', 'Payment Details'); ?>


<?php $__env->startSection('content'); ?>


    <div class="grid-container fluid product">

        <h2 class="text-center"><?php echo e($payments['order_number']); ?></h2>
        <hr>

        <section>
            

                
                    
                        
                        
                            
                        
                        
                    
                

                
                    
                

            

            <?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="grid-x grid-padding-x">

                <?php if($payments): ?>

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

                            
                            <tbody>
                                <tr>
                                    <td><?php echo e($payments['order_number']); ?></td>
                                    <td><?php echo e($payments['amount']); ?></td>
                                    <td><?php echo e($payments['user']['username']); ?></td>
                                    <td><?php echo e($payments['user']['email']); ?></td>
                                    <td><?php echo e($payments['status']); ?></td>
                                    <td><?php echo e($payments['user']['address']); ?></td>
                                    <td>233-<?php echo e($payments['user']['phone']); ?></td>

                                    
                                    



                                </tr>

                            </tbody>

                            
                        </table>



                <?php endif; ?>

            </div>


        </section>

    </div>



    

    <?php $__env->stopSection(); ?>










<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp7.2\htdocs\bodymassage\resources\views/admin/payment/paymentDetails.blade.php ENDPATH**/ ?>