<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel - <?php echo $__env->yieldContent('title'); ?></title>

    <link rel="stylesheet" href="/css/all.css">
</head>
<body data-page-id="<?php echo $__env->yieldContent('data-page-id'); ?>">

    
    <?php echo $__env->make('includes.admin-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <div class="off-canvas-content" data-off-canvas-content>
        <!-- Your page content lives here -->

        
        <div class="title-bar admin-title-bar">
            <div class="title-bar-left">
                <button class="menu-icon hide-for-large" type="button" data-open="offCanvas"></button>
                <span class="title-bar-title"> <a href="/"><?php echo e(getenv('APP_NAME')); ?></a> </span>
            </div>
        </div>



        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <script src="/fontawesome/js/allfonts.js"></script>
    <script src="/js/all.js">
        $(document).foundation();
    </script>

</body>
</html><?php /**PATH C:\xampp7.2\htdocs\bodymassage\resources\views/admin/layout/base.blade.php ENDPATH**/ ?>