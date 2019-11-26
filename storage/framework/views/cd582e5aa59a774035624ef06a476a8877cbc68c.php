<?php $__env->startSection('css'); ?>
    <!-- DataTables -->


    <link href="<?php echo e(url('public/plugins/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(url('public/plugins/datatables/buttons.bootstrap4.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="<?php echo e(url('public/plugins/datatables/responsive.bootstrap4.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <!-- Modal -->
    <div class="modal fade" id="NewSmsConfigModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <b><h4 class="modal-title dark profile-title" id="myModalLabel">Create SMS Configuration</h4></b>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                </div>

                <div class="modal-body">

                    <form action="<?php echo e(route('sms.addConfig')); ?>" method="post">
                        <?php echo e(csrf_field()); ?>



                        <div class="form-group">

                            <label for="">User Name<span style="color: red">*</span></label>

                            <input class="form-control" maxlength="255" name="useName" required type="text">

                        </div>

                        <div class="form-group">

                            <label for="">Password<span style="color: red">*</span></label>

                            <input class="form-control" name="password" required type="password">

                        </div>
                        <div class="form-group">

                            <label for="">Brand Name<span style="color: red">*</span></label>

                            <input class="form-control" maxlength="11" name="brandName" required type="text">

                        </div>

                        <div class="form-group">

                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>

                    </form>

                </div>



            </div>
        </div>
    </div>



    <div class="modal" id="editModalAgreement">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Agreement Question</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div  id="editModalBodyAgreement">

                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                </div>

            </div>
        </div>
    </div>
    <div class="container-fluid">



            <div class="card">
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                    <div class="card-header">
                        <div class="row">
                        <div class="col-md-6" align="left">
                        <h4>Sms Configuration</h4>
                        </div>
                            <?php if(empty($smsConfig)): ?>
                        <div class="col-md-6" align="right">
                            <a onclick="addnewSmsConfig()" href="#"> <button class="btn btn-info">Add New</button></a>
                        </div>
                            <?php endif; ?>
                        </div>
                    </div>

                <div class="card-body">

                    <div class="table table-responsive">
                        <table id="agreementtable" class="table table-striped table-bordered" >
                            <thead>
                            <tr>


                                <th>User Name</th>
                                
                                <th>BrandName</th>
                                <th width="30%">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php if(!empty($smsConfig)): ?>
                                <tr>

                                    <td width="40%"><?php echo e($smsConfig->userName); ?></td>
                                    
                                    <td width="20"><?php echo e($smsConfig->brandName); ?></td>



                                    <td width="10%"><button class="btn btn-sm btn-success" data-panel-id="<?php echo e($smsConfig->id); ?>" onclick="editSmsConfig(this)">Edit</button>
                                    </td>

                                </tr>

                            <?php endif; ?>





                            </tbody>

                        </table>
                    </div>
                    <br>


                </div>

            </div>

    </div> <!-- end container-fluid -->



<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(url('public/assets/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/plugins/datatables/dataTables.bootstrap4.min.js')); ?>"></script>
    <!-- Buttons examples -->
    
    
    
    <script src="<?php echo e(url('public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')); ?>"></script>

    <script>
        $(function () {
            $('#agreementtable').DataTable(
                {


                }
            );
        });

        function addnewSmsConfig() {

            $('#NewSmsConfigModal').modal({show:true});

        }
        function editSmsConfig(x) {
            var id=$(x).data('panel-id');

            $.ajax({
                type: 'POST',
                url: "<?php echo route('sms.editSmsConfig'); ?>",
                cache: false,
                data: {_token: "<?php echo e(csrf_token()); ?>",'id': id},
                success: function (data) {
//                    console.log(data);
                    $('#editModalBodyAgreement').html(data);
                    $('#editModalAgreement').modal();
                }
            });


        }
    </script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mainLayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>