  
<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4>Open Ticket</h4>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Ticket Topic *</label>
                        <input type="text" class="form-control" placeholder="Ticket Topic" value="" name="topic" required>
                    </div>

                    <div class="form-group col-md-3">
                        <label>Ticket Create Date *</label>
                        <input type="text" autocomplete="off" class="form-control datepicker" placeholder="Select Ticket Create Date" name="create_date" required>
                    </div>

                    <div class="form-group col-md-3">
                        <label>Expected End Date *</label>
                        <input type="text" autocomplete="off" class="form-control datepicker" placeholder="Select Expected End Date" name="exp_end_date">
                    </div>

                    <div class="form-group col-md-12">
                        <label>Ticket Details *</label>
                        <textarea class="form-control ckeditor" placeholder="Ticket Details" name="details" rows="5" required></textarea>
                    </div>


                    
                        
                        
                            
                                
                            
                        
                    
                    <div class="form-group col-md-3">
                        <label>Ticket Type</label>
                        <select class="form-control" name="tickettype" required>
                            <?php $__currentLoopData = $tickettype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tickettype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($tickettype->id); ?>"><?php echo e($tickettype->typeName); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Ticket Priroty</label>
                        <select class="form-control" name="priroty" required>
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </div>



                    <div class="form-group col-md-3">

                        <label for="exampleFormControlFile1">Choose file</label>
                        <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>

                    <div class="form-group col-md-12">
                        <button class="btn btn-success">Create Ticket</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script type="text/javascript" src="<?php echo e(url('/public/ck/ckeditor/ckeditor.js')); ?>"></script>
    <script>
        $('.datepicker').datepicker();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mainLayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>