
<style>
    .login-with-facebook a{
    padding: 5px 10px;
    background: #3b5999;
    color: #fff;
    display: block;
    border-radius: 4px;
}
.login-with-facebook{
    padding: 0 0 20px 0;
}
.login-with-facebook a li{
    font-weight: 700;
}
.login-with-facebook a li i{
    margin-right: 10px;
}

.login-with-google a{
    padding: 5px 10px;
    background: transparant;
    color: #000;
    display: block;
    border-radius: 4px;
    border: 1px solid #ddd;
}
.login-with-google{
    padding: 0 0 20px 0;
}
.login-with-google a li{
    font-weight: 700;
}
.login-with-google a li i{
    margin-right: 10px;
}
</style>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="user-card shadow-lg">
            <h3 class="user-logo mb-0">
                Bike  Bikroy 
            </h3>
            <div class="login-with-facebook">
                <a href="<?php echo e(url('login/facebook')); ?>">
                     <ul>
                     <li><i class="fab fa-facebook-square"></i> Continue with Facebook</li>
                 </ul>
                </a>
             </div>
                   <div class="login-with-google">
                <a href="<?php echo e(url('login/google')); ?>">
                     <ul>
                     <li><i class="fab fa-google"></i> Continue with Google</li>
                 </ul>
                </a>
             </div>
        
<form class="login-form"   method="POST" action='<?php echo e(url("login")); ?>' aria-label="<?php echo e(__('Login')); ?>">

<?php echo csrf_field(); ?>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <i class="far fa-user"></i>
                </span> 
                <input id="email" type="text" class="form-control <?php $__errorArgs = ['phoneemail'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="phoneemail"
              value="<?php echo e(old('phoneemail')); ?>" required autocomplete="email" autofocus  placeholder="Email Or Phone">
            <?php $__errorArgs = ['phoneemail'];
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
            <h3 class="text-danger">  <?php if($errors->has('status')): ?>
                                                           
                <strong><?php echo e($errors->first('status')); ?></strong>
            
        <?php endif; ?></h3> 
            <input type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
            Remember Me  <br>
            
            <button class="user-btn mt-2" type="submit">
                Login
            </button>
            <div class="row mt-5">
                <div class="col-md-6">
                    <a href="<?php echo e(url('register')); ?>">Sign Up</a>
                </div>
                <div class="col-md-6">
                    <a href="#" class="text-danger">Forgot password? </a>
                </div>
            </div>

</form>





        </div>
    </div>
    <div class="col-md-4"></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Laravel\Laravel8\Bikebikroy\resources\views/auth/frontendlogin.blade.php ENDPATH**/ ?>