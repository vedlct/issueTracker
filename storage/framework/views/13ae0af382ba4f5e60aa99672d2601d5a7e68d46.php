<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4>Company Info</h4>
        </div>
        <div class="card-body">
            <form method="post" action="<?php echo e(route('company.edit',['id'=>$company->id])); ?>">
                <?php echo e(csrf_field()); ?>

            <div class="row">

                <div class="form-group col-md-6">
                    <label>Company Name</label>
                    <input type="text" class="form-control" placeholder="company name" value="<?php echo e($company->companyTitle); ?>" name="companyTitle" required>
                </div>

                <div class="form-group col-md-6">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="email" value="<?php echo e($company->companyEmail); ?>" name="companyEmail">
                </div>


                <div class="form-group col-md-6">
                    <label>Phone 1</label>
                    <input type="text" class="form-control" placeholder="phone 1" value="<?php echo e($company->companyPhone1); ?>" name="companyPhone1">
                </div>

                <div class="form-group col-md-6">
                    <label>Phone 2</label>
                    <input type="text" class="form-control" placeholder="phone 2" value="<?php echo e($company->companyPhone2); ?>" name="companyPhone2">
                </div>

                <div class="form-group col-md-12">
                    <label>Address</label>
                    <textarea  class="form-control" placeholder="address" name="companyAddress"><?php echo e($company->companyAddress); ?></textarea>
                </div>
                <div class="form-group col-md-12">
                    <button class="btn btn-success">Update</button>
                </div>







            </div>
            </form>
        </div>
    </div>
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mainLayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>