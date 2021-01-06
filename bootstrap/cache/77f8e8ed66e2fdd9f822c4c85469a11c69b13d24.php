<?php $__env->startSection('title', 'Payment'); ?>


<?php $__env->startSection('content'); ?>


    <div class="grid-container fluid product">

        <h2 class="text-center">
            GHS <?php echo e(number_format($revenue, 2)); ?>

        </h2>
        <hr>

        <section>
            <div class="grid-x grid-padding-x">

                <div class="small-12 medium-6 cell">
                    <form action="/search/payment" method="post" class="input-group">
                        <input type="text" placeholder="Search Product" name="search" class="input-group-field">
                        <div class="input-group-button">
                            <input type='submit' class="button" value="Search">
                        </div>
                        <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::generate()); ?>">
                    </form>
                </div>

                <div>
                    <a href="/profile/<?php echo e(user()->username); ?>/payments/graph" class="button">Payment Graph</a>
                </div>

            </div>

            <?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="grid-x grid-padding-x">

                <?php if(count($payments)): ?>

                        <table class="hover">
                            <thead>
                                <tr>
                                    <td>Order Number</td>
                                    <td>Total Amount</td>
                                    <td>Status</td>
                                    <td>Action</td>
                                </tr>
                            </thead>

                            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tbody>
                                <tr>
                                    <td><?php echo e($payment['order_number']); ?></td>
                                    <td><?php echo e($payment['amount']); ?></td>
                                    <td><?php echo e($payment['status']); ?></td>

                                    <td>
                                        <span data-tooltip class="has-tip top" tabindex="1" title="Payment Details" >
                                            <a href='/profile/<?php echo e(user()->username); ?>/payments/<?php echo e($payment['id']); ?>/payment_details'><i class="fa fa-arrow-alt-circle-right" title="Payment Details"></i></a>
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










<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp7.2\htdocs\bodymassage\resources\views//admin/payment/index.blade.php ENDPATH**/ ?>