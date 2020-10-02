<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> <?php echo e(getenv('APP_NAME')); ?> - <?php echo $__env->yieldContent('title'); ?></title>

    <link rel="stylesheet" href="/css/all.css">
</head>
<body data-page-id="<?php echo $__env->yieldContent('data-page-id'); ?>">
<?php echo $__env->make('includes.preloader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<!-- Your page content lives here -->

<div class="grid-container fluid" id="hide-div" style="display: none">
    <?php echo $__env->yieldContent('body'); ?>
</div>







<script src="/fontawesome/js/allfonts.js"></script>
<script src="/js/all.js">
    $(document).foundation();
</script>
</body>
</html><?php /**PATH C:\xampp7.2\htdocs\bodymassage\resources\views/layout/base.blade.php ENDPATH**/ ?>