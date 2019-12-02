
<ul class="list-group">
    <?php if(count($owners) <= 0): ?>
        <p>No owner assigned yet.</p>
    <?php else: ?>
        <?php $__currentLoopData = $owners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $owner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="list-group-item"> <b> <?php echo e($owner->fullName); ?> </b> </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</ul>