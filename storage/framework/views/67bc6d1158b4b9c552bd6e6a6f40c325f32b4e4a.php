<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 style="font-weight: 300;">Company Settings</h4>
            </div>
            <div class="card-body">

                <form method="post" action="<?php echo e(route('company.update', ['id' => $company->companyId])); ?>">
                    <?php echo e(csrf_field()); ?>

                    <div class="row">
                        <input type="hidden" name="id" value="<?php echo e($company->companyId); ?>">
                        <div class="form-group col-md-6">
                            <label>Company Name</label>
                            <input type="text" class="form-control" placeholder="Company Name" value="<?php echo e($company->companyName); ?>" name="companyName" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Company Email</label>
                            <input type="email" class="form-control" placeholder="Email" value="<?php echo e($company->companyEmail); ?>" name="companyEmail" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Phone 1</label>
                            <input type="tel" class="form-control" placeholder="Phone 1" value="<?php echo e($company->companyPhone1); ?>" name="companyPhone1">
                        </div>

                        <?php if($company->companyPhone2): ?>
                            <div class="form-group col-md-6">
                                <label>Phone 2</label>
                                <input type="text" class="form-control" placeholder="Phone 2" value="<?php echo e($company->companyPhone2); ?>" name="companyPhone2">
                            </div>
                        <?php else: ?>
                            <div class="form-group col-md-6">
                                <label>Phone 2</label>
                                <input type="text" class="form-control" placeholder="Phone 2" value="" name="companyPhone2">
                            </div>
                        <?php endif; ?>

                        <div class="form-group col-md-12">
                            <label>Company Info</label>
                            <textarea  class="form-control" placeholder="Company Info" name="info"><?php echo e($company->companyInfo); ?></textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <label>Address</label>
                            <textarea  class="form-control" placeholder="Company Address" name="address"><?php echo e($company->companyAddress); ?></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <button class="btn btn-success">Update Company</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mainLayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>