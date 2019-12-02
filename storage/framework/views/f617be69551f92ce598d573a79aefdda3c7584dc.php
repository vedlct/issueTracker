<table id="companyTable" class="table-bordered table-condensed text-center table-striped" style="width:100%">
    <thead>
    <tr>
        <th>Name</th>
        <th>Company Information</th>
        <th>Email</th>
        <th>Address</th>
        <th>Phone 1</th>
        <th>Phone 2</th>
        
    </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($company->companyName); ?></td>
                <td><?php echo e($company->companyInfo); ?></td>
                <td><?php echo e($company->companyEmail); ?></td>
                <td><?php echo e($company->companyAddress); ?></td>
                <td><?php echo e($company->companyPhone1); ?></td>
                <td><?php echo e($company->companyPhone2); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>