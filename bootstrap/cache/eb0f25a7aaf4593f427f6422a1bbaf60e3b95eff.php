
<div class="grid-container fluid">
    <div class="grid-padding-x grid-x">

        <div class="cell">

            <?php if(isset($errors) || \App\Classes\Session::exist('error')): ?>
                <div class="callout alert" data-closable>

                    <?php if(\App\Classes\Session::exist('error')): ?>
                        <?php echo e(\App\Classes\Session::flash('error')); ?>


                    <?php else: ?>
                        <?php if(is_array($errors)): ?>
                            <?php $__currentLoopData = $errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $errorArray): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(is_array($errorArray)): ?>
                                    <?php $__currentLoopData = $errorArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $errorItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <?php echo e($errorItem); ?> <br />
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <?php echo e($errorArray); ?>

                                <?php endif; ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            
                            <?php if(!empty($errors)): ?>
                                    <?php echo e($errors); ?>

                                <?php endif; ?>


                        <?php endif; ?>

                    <?php endif; ?>


                    <button class="close-button" aria-label="Dismiss Message" type="button" data-close> <span aria-hidden="true">&times;</span> </button>
                </div>

            <?php endif; ?>

            <?php if(isset($success) || \App\Classes\Session::exist('success')): ?>
                <div class="callout success" data-closable>
                    <?php if(isset($success)): ?>
                        <?php echo e($success); ?>

                    <?php elseif(\App\Classes\Session::exist('success')): ?>
                        <?php echo e(\App\Classes\Session::flash('success')); ?>

                    <?php endif; ?>

                    <button class="close-button" aria-label="Dismiss Message" type="button" data-close> <span aria-hidden="true">&times;</span> </button>
                </div>

            <?php endif; ?>
        </div>



    </div>
</div>
<?php /**PATH C:\xampp7.2\htdocs\bodymassage\resources\views/includes/messages.blade.php ENDPATH**/ ?>