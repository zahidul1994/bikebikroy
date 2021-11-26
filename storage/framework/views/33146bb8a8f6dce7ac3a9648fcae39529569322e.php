<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title'); ?></title>
  
    <link href="<?php echo e(asset('dashboardassets/css/all.min.css')); ?>" rel="stylesheet">
   <link href="<?php echo e(asset('dashboardassets/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('dashboardassets/css/responsive.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('dashboardassets/css/style.css')); ?>" rel="stylesheet">  
</head>
<body style="background: #ddd;">
    

    <div class="main-user">
<div class="container">
      <?php echo $__env->yieldContent('content'); ?>
</div>
      



    </div>
<!--flash notification-->
<?php echo app('flasher.response_manager')->render(); ?>  

    <script src="<?php echo e(asset('dashboardassets/js/jquery-3.6.0.min.js')); ?>"></script>
    <script src="<?php echo e(asset('dashboardassets/js/popper.min.js')); ?>"></script>
   <script src="<?php echo e(asset('dashboardassets/js/bootstrap.min.js')); ?>"></script>
      <script src="<?php echo e(asset('dashboardassets/js/main.js')); ?>"></script>
</body>
</html>
<?php /**PATH C:\laragon\www\Laravel\Laravel8\Bikebikroy\resources\views/layouts/app.blade.php ENDPATH**/ ?>