<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <title>Myject</title>
    <meta content="Admin Dashboard" name="description">
    <meta content="ThemeDesign" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="<?php echo e(url('public/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(url('public/css/icons.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(url('public/css/style.css')); ?>" rel="stylesheet" type="text/css">

</head>

<body class="fixed-left">

<div class="accountbg">
    <div class="content-center">
        <div class="content-desc-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-8">
                        <div class="card">
                            <div class="card-body">
                                
                                <h4 class="text-muted text-center font-18"><b>Sign In</b></h4>
                                <div class="p-2">
                                    <form class="form-horizontal m-t-20" action="<?php echo e(route('login')); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" placeholder="Enter mail" required autofocus>
                                                <?php if($errors->has('email')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" placeholder="Enter password" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck1" name="remember">
                                                    <?php if($errors->has('password')): ?>
                                                        <span class="invalid-feedback" role="alert">
																<strong><?php echo e($errors->first('password')); ?></strong>
															</span>
                                                    <?php endif; ?>
                                                    <label class="custom-control-label" for="customCheck1">Remember me</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group text-center row m-t-20">
                                            <div class="col-12">
                                                <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In</button>
                                            </div>
                                        </div>
                                        <div class="form-group m-t-10 mb-0 row">
                                            <div class="col-sm-7 m-t-20"><a href="<?php echo e(url('/password/reset')); ?>" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a></div>
                                            <div class="col-sm-5 m-t-20"><a href="<?php echo e(route('joinRequest')); ?>" class="text-muted"><i class="mdi mdi-account-circle"></i> Request an account </a></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
    </div>
</div>
<!-- jQuery  -->
<script src="<?php echo e(url('public/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(url('public/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(url('public/js/modernizr.min.js')); ?>"></script>
<script src="<?php echo e(url('public/js/detect.js')); ?>"></script>
<script src="<?php echo e(url('public/js/fastclick.js')); ?>"></script>
<script src="<?php echo e(url('public/js/jquery.slimscroll.js')); ?>"></script>
<script src="<?php echo e(url('public/js/jquery.blockUI.js')); ?>"></script>
<script src="<?php echo e(url('public/js/waves.js')); ?>"></script>
<script src="<?php echo e(url('public/js/jquery.nicescroll.js')); ?>"></script>
<script src="<?php echo e(url('public/js/jquery.scrollTo.min.js')); ?>"></script>
</body>
</html>