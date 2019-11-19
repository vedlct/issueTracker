

        <!-- Unseen Notification-->
        
            <?php $__currentLoopData = $myNotificationOld; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="javascript:void(0);" class="dropdown-item notify-item hover_me" style="padding-bottom: 23px;">
                    <div class="notify-icon bg-success"><i class="mdi mdi-bell-ring-outline"></i></div>

                    <p class="notify-details"> <small class="text-muted">You are assigned to Task: <?php echo e($notification->backlog_title); ?>.</small> </p>

                </a>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         

