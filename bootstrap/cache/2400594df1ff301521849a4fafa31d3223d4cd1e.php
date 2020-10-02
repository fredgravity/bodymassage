<?php $__env->startSection('title', 'Massages Page'); ?>
<?php $__env->startSection('data-page-id', 'massages'); ?>

<?php $__env->startSection('content'); ?>

<div class="massage-wrapper">
    <section class="massages" id="massages">
            <div class="text-center">
                <p>Click on the type of massage for more details</p>
            </div>

        <div class="hero grid-x">
            <div class="hero-main-slider cell">

                <?php if($products): ?>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div  id="slider-div">
                            <div class="text-center"><h5><?php echo e($product->product_name); ?></h5></div>
                            <img class="slides" src="<?php echo e($product->image_path); ?>" alt="<?php echo e($product->product_name); ?>" data-slider-id="<?php echo e($product->id); ?>">
                        </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

            </div>

        </div>


    </section>

    <section class="massage-description">

        <div class="grid-x grid-padding-x">

            <div class="cell medium-10 float-center ">
                <hr>
                <h4 class="text-center"><span id="desc_name"></span> </h4>
            <p id="massage-description"></p>

        </div>

        </div>

    </section>

    <section>

        <div class="grid-padding-x grid-x">

                <div class=" cell medium-5 float-center animate__animated animate__bounceInDown animate__delay-3s">
                    <a href="/bookings" class="button expanded large warning" id="book-now">Book Now !</a>
                </div>



        </div>

    </section>
</div>






    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp7.2\htdocs\bodymassage\resources\views//massage.blade.php ENDPATH**/ ?>