<!--Login Form-->
<form method="post" class="bravo-form-login" action="<?php echo e(route('login')); ?>">
    <input type="hidden" name="redirect" value="<?php echo e(request()->query('redirect')); ?>">
    <?php echo csrf_field(); ?>
    <div class="form-group">
        <label><?php echo e(__('Email address')); ?></label>
        <input type="text" name="email" placeholder="<?php echo e(__('Email address')); ?>" required>
        <span class="invalid-feedback error error-email"></span>
    </div>

    <div class="form-group">
        <label><?php echo e(__('Password')); ?></label>
        <input type="password" name="password" value="" placeholder="<?php echo e(__('Password')); ?>">
        <span class="invalid-feedback error error-password"></span>
    </div>

    <div class="form-group">
        <div class="field-outer">
            <div class="input-group checkboxes square">
                <input type="checkbox" name="remember" value="1" id="remember">
                <label for="remember" class="remember"><span class="custom-checkbox"></span>
                    <?php echo e(__('Remember me')); ?></label>
            </div>
            <a href="<?php echo e(route('password.request')); ?>" class="pwd"><?php echo e(__('Forgot password?')); ?></a>
        </div>
    </div>
    <?php if(setting_item('recaptcha_enable')): ?>
        <div class="form-group">
            <?php echo e(recaptcha_field($captcha_action ?? 'login')); ?>

            <span class="invalid-feedback error error-recaptcha"></span>
        </div>
    <?php endif; ?>

    <div class="form-group">
        <button class="theme-btn btn-style-one" type="submit" name="log-in"><?php echo e(__('Log In')); ?>

            <span class="spinner-grow spinner-grow-sm icon-loading" role="status" aria-hidden="true"></span>
        </button>
    </div>
    

</form>
<?php /**PATH /Users/failamir/Sites/localhost/superio200/modules/Layout/auth/login-form.blade.php ENDPATH**/ ?>