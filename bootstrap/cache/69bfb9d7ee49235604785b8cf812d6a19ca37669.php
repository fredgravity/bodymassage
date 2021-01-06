<?php $__env->startSection('title', 'Orders'); ?>


<?php $__env->startSection('content'); ?>


    <div class="grid-container fluid product">

        <h2 class="text-center">Orders</h2>
        <hr>

        <section>
            <div class="grid-x grid-padding-x">

                <div class="small-12 medium-6 cell">
                    <form action="/search/order" method="post" class="input-group">
                        <input type="text" placeholder="Search Product" name="search" class="input-group-field">
                        <div class="input-group-button">
                            <input type='submit' class="button" value="Search">
                        </div>
                        <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::generate()); ?>">
                    </form>
                </div>

            </div>

            <?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="grid-x grid-padding-x">

                <?php if(count($orders)): ?>

                        <table class="hover">
                            <thead>
                                <tr>
                                    <td>Order Number</td>
                                    <td>Reference No.</td>
                                    
                                    
                                    <td>Action</td>
                                </tr>
                            </thead>

                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tbody>
                                <tr>
                                    <td><?php echo e($order['order_number']); ?></td>
                                    <td><?php echo e($order['ref_no']); ?></td>
                                    
                                    

                                    <td>
                                        <span data-tooltip class="has-tip top" tabindex="1" title="Order Details" >
                                            <a href='/profile/<?php echo e(user()->username); ?>/orders/<?php echo e($order['id']); ?>/order_details'><i class="fa fa-arrow-alt-circle-right" title="Order Details"></i></a>
                                        </span>

                                                    &nbsp;

                                                    
                                                    
                                                    


                                                    <span data-tooltip class="has-tip top" tabindex="1" title="Delete Order">
                                            <form action='/profile/<?php echo e(user()->username); ?>/orders/<?php echo e($order['id']); ?>/delete_order' method="post" class="delete-order">
                                                <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::generate()); ?>">
                                                <button type="submit"><i class="fa fa-times delete"></i></button>
                                            </form>
                                        </span>
                                    </td>

                                </tr>

                            </tbody>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>
                        
                            
                            
<?php echo $__env->make('includes.paginate_links', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php endif; ?>

            </div>


        </section>

    </div>



    

    <?php $__env->stopSection(); ?>










<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp7.2\htdocs\bodymassage\resources\views/admin/order/index.blade.php ENDPATH**/ ?>