<?php $__env->startSection('title', 'Cart Page'); ?>
<?php $__env->startSection('data-page-id', 'cartPage'); ?>


<?php $__env->startSection('content'); ?>

    <section class="cartPage" id="cartPage">
        <?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div style="display: none; font-size: 3rem;" id="load-spinner-cart" class="float-center">
            <?php echo $__env->make('includes.spinner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <?php if($item): ?>
            
            <img src="/images/empty-cart.png" alt="empty_cart" style="width: 100%; height: 500px; ">
        <?php else: ?>

            <?php $__currentLoopData = $cart['results']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 
                
                    
                <div class="grid-padding-x grid-x" style="margin-top: 1rem;">

                    <div class="small-12 medium-3 cell" style="border-right: black solid 1px;">
                        
                        <div style="font-family: Bahnschrift;">
                            <h6><?php echo e(ucfirst($result["product_name"])); ?></h6>
                        </div>
                        <div>
                            <img src="/<?php echo e($result['image']); ?>" alt="" style="width: 100%; min-height: 150px;">
                        </div>


                    </div>

                    <div class="small-12 medium-9 cell" style="background-color: #f8f8f8;">
                        <div>ORD:_________<?php echo e($result['orderNumber']); ?></div>
                        <div>Date:_________ <?php echo e($result['date']); ?></div>
                        
                        <div>Hours:_________<?php echo e($result['hours']); ?> hr(s)</div>
                        <?php if($result['session'] ==='first'): ?>
                            <div>Session:_______ 8am - 10pm </div>
                            <?php elseif($result['session'] ==='second'): ?>
                            <div>Session:_______ 11pm - 1pm </div>
                            <?php elseif($result['session'] ==='third'): ?>
                            <div>Session:_______ 2pm - 4pm </div>
                        <?php endif; ?>
                        <div>Price:_________GHS <?php echo e($result['unitPrice']); ?></div>
                        <div>Total:_________GHS <?php echo e($result['total']); ?></div>
                        <div>Ref No:________ <?php echo e($result['ref_no']); ?></div>
                        <?php if($result['place'] === 'home'): ?>
                            
                            <div>Place:_________ <?php echo e($result['place']); ?></div>
                            <div>Home Address:__ <?php echo e($result['place_name']); ?></div>
                        <?php else: ?>
                            <div>Place:_________ <?php echo e($result['place']); ?></div>
                            <div>Other Address:__ <?php echo e($result['place_name']); ?></div>
                        <?php endif; ?>
                        <div>District:________ <?php echo e(user()->district); ?></div>
                        <div class="grid-padding-x grid-x">
                            <div class="small-12 cell">
                                <form action="/bookings/cart/<?php echo e($result['index']); ?>/remove_item" method="post">
                                    <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::generate()); ?>">
                                    <input type="submit" class="button alert small" value="Remove">
                                </form>
                            </div>

                        </div>


                    </div>

                </div>

                

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php if($cart['cartTotal'] > 0): ?>
                <div class="grid-x grid-padding-x">
                    <div class="small-12 medium-3 cell medium-offset-9 float-right">
                        Grand Total: GHS <h4 id="grand-total"><?php echo e($cart['cartTotal']); ?></h4>
                    </div>

                </div>
                <div class="grid-x grid-padding-x">
                    <div class="small-12 medium-3 medium-offset-9 float-right cell">
                        
                        
                            
                        

                        <?php echo $__env->make('includes.paystack', ['token'=>\App\Classes\CSRFToken::generate()], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('includes.flutterwave', ['cartRef'=>$result['ref_no'], 'cartTotal'=>$cart['cartTotal'], 'token'=>\App\Classes\CSRFToken::generate() ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                    </div>
                </div>


            
            <section>
                
                <button class="button" data-open="card_modal">Card Payment</button>
                <?php echo $__env->make('forms.cardPayment', ['cartRef'=>$result['ref_no'], 'cartTotal'=>$cart['cartTotal'] ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </section>

            <?php endif; ?>

        <?php endif; ?>
    </section>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp7.2\htdocs\bodymassage\resources\views/cart.blade.php ENDPATH**/ ?>