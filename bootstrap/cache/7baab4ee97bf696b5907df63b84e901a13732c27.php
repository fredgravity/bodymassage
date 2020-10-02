 



 <?php $__env->startSection('body'); ?>

     <?php echo $__env->make('includes._nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

     
     <div class="site_wrapper">
         <?php echo $__env->yieldContent('content'); ?>



         <div class="notify text-center">

         </div>

     </div>






 <?php $__env->stopSection(); ?>















<?php echo $__env->make('layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp7.2\htdocs\bodymassage\resources\views/layout/app.blade.php ENDPATH**/ ?>