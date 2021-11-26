<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="user-card shadow-lg">
            <h3 class="user-logo mb-0">
                Bike  Bikroy 
            </h3>
            <p class="mb-0 user-form-name">
                User Login
            </p>
            <?php if($errors->has('status')): ?>
                                                           
            <strong><?php echo e($errors->first('status')); ?></strong>
        
    <?php endif; ?>
<form class="login-form"   method="POST" action='<?php echo e(url("login/$url")); ?>' aria-label="<?php echo e(__('Login')); ?>">

<?php echo csrf_field(); ?>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <i class="far fa-user"></i>
                </span>
                <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email"
              value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus  placeholder="Email Address">
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="invalid-feedback">
                <small  role="alert">
                    <?php echo e($message); ?>

                  </small>
              </div>
            
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <i class="fas fa-key"></i>
                </span>
                <input id="email" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password"
                value="<?php echo e(old('password')); ?>" required autocomplete="password" autofocus  placeholder="Password">
              <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <div class="invalid-feedback">
                <small  role="alert">
                    <?php echo e($message); ?>

                  </small>
              </div>
              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
               
            </div>
            <input type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
            Remember Me  <br>
            <button class="user-btn mt-2">
                Login
            </button>
            <div class="row mt-5">
                <div class="col-md-6">
                    <a href="#">Sign Up</a>
                </div>
                <div class="col-md-6">
                    <a href="#" class="text-danger">Forgot password? </a>
                </div>
            </div>







        </div>
    </div>
    <div class="col-md-4"></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Laravel\Laravel8\Bikebikroy\resources\views/auth/login.blade.php ENDPATH**/ ?>