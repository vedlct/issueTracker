
<?php if(count($comments) > 0): ?>
    <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card">
            <div class="card-body" style="padding-bottom: 0px;">
                <p> <b><?php echo e($comment->fullName); ?> : </b> <?php echo e($comment->comment); ?> </p>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <p></p>
<?php endif; ?>