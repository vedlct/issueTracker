<!DOCTYPE html>
<html lang="en">

<head>

    <title>TicketPro</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="<?php echo e(url('public/plugins/morris/morris.css')); ?>">
    <link href="<?php echo e(url('public/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(url('public/css/icons.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(url('public/css/style.css')); ?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.standalone.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    <style>
        .hover_me:hover{
            background-color: #d6d9db;
            color: #d6d9db;
        }
    </style>

    <?php echo $__env->yieldContent('css'); ?>
</head>

<body class="fixed-left">
<!-- Loader -->

    
        
    

<!-- Begin page -->




<div id="wrapper">
    <!-- ========== Left Sidebar Start ========== -->
    <?php echo $__env->make('include.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <!-- Left Sidebar End -->
    <!-- Start right Content here -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <!-- Top Bar Start -->
            <div class="topbar">
                <div class="topbar-left	d-none d-lg-block">
                    <div class="text-center">
                       <h2 style="color: white; margin-top: 16px;">TicketPro</h2>
                        
                    </div>
                </div>
                <nav class="navbar-custom">



                    <ul class="list-inline float-right mb-0">

                        <?php if(Auth::user()->fk_userTypeId==3): ?>

                        <li class="list-inline-item dropdown notification-list" >
                            <select class="form-control" id="myCompany" onchange="changeCompany(this)">
                                <option value="">Select Company</option>
                                <?php $__currentLoopData = $MY_Companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($company->companyId); ?>" <?php if($company->companyId == Auth::user()->fkCompanyId): ?> selected <?php endif; ?>><?php echo e($company->companyName); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </li>
                        <?php endif; ?>
                        
                        <li class="list-inline-item dropdown notification-list" >

                            <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" onclick="changeToseen()" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="mdi mdi-bell-outline noti-icon"></i>
                                <span class="badge badge-danger noti-icon-badge" id="noti_val"><?php echo e($myNotification); ?></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg">

                                <!-- Count-->
                                
                                    
                                


                                <span id="mynotification"></span>

                                <!-- All-->
                                <a href="<?php echo e(route('show.allNotification')); ?>" class="dropdown-item notify-item">
                                    View All
                                </a>

                            </div>
                        </li>

                        <li class="list-inline-item dropdown notification-list">
                            <?php if(Auth::user()->profilePhoto != null): ?>
                                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"><img src="<?php echo e(url('public/files/profileImage/'.Auth::user()->profilePhoto)); ?>" alt="user" class="rounded-circle"></a>
                            <?php else: ?>
                                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"><img src="<?php echo e(url('public/files/profileImage/default.png')); ?>" alt="user" class="rounded-circle"></a>
                            <?php endif; ?>

                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
                                <a class="dropdown-item" href="<?php echo e(route('user.profile')); ?>"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
                                <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="mdi mdi-lock-open-outline m-r-5 text-muted"></i> <?php echo e(__('Logout')); ?>

                                </a>

                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                    <?php echo csrf_field(); ?>
                                </form>
                            </div>
                        </li>

                    </ul>
                    <ul class="list-inline menu-left mb-0">
                        <li class="list-inline-item">
                            <button type="button" class="button-menu-mobile open-left waves-effect"><i class="ion-navicon"></i></button>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </nav>
            </div>
            <!-- Top Bar End -->

            <div class="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="float-right page-breadcrumb">

                            </div>
                            <h5 class="page-title"></h5></div>
                    </div>
                </div>
            </div>
             <!-- end row -->

            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

<?php echo $__env->yieldContent('content'); ?>
