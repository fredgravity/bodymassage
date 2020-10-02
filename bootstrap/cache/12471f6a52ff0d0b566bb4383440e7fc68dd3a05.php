<?php $__env->startSection('title', 'Home Page'); ?>
<?php $__env->startSection('data-page-id', 'home'); ?>


<?php $__env->startSection('content'); ?>

<section class="home" id="home">

    <h1 class="  animate__animated animate__fadeInLeft animate__delay-1s" id="anim" >
        Feeling really stressed?
    </h1>

    <h1 class="  animate__animated animate__fadeInLeft animate__delay-2s" id="anim2" >
        <strong>Try us !</strong>
    </h1>

    <div class="button warning large animate__animated animate__bounceInDown animate__delay-3s" id="anim3">
        <a href="/bookings">Book Now!</a>
    </div>

</section>



<?php $__env->stopSection(); ?>



<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp7.2\htdocs\bodymassage\resources\views/home.blade.php ENDPATH**/ ?>