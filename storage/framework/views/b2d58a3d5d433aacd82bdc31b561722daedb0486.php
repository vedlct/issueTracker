<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4>Team Assignment</h4>
            </div>
            <div class="card-body">
                <table id="freeEmployee" class="table-bordered table-condensed text-center table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th> <input type="checkbox" id="selectall" onClick="selectAll(this)" /> </th>
                        <th>User ID</th>
                        <th>FullName</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $allEmployee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><input type='checkbox' class="checkboxvar" name="checkboxvar[]" value="<?php echo e($employee->userId); ?>"></td>
                                <td> <?php echo e($employee->userId); ?> </td>
                                <td> <?php echo e($employee->fullName); ?> </td>
                                <td> <?php echo e($employee->email); ?> </td>
                                <td> <?php echo e($employee->userPhoneNumber); ?> </td>
                                
                                    
                                    
                                
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="row">
                <div class="form-group col-md-4 ml-3">
                    <label>Select Team</label>
                    <select class="form-control" required name="assignTo" id="otherCatches">
                        <option value=""> Select Team</option>
                        <?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($team->teamId); ?>"><?php echo e($team->teamName); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>


        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>

        $(document).ready(function() {
            $('#freeEmployee').DataTable({
                "ordering": false
            });
        } );

        // Select All Checkbox
        function selectAll(source) {
            checkboxes = document.getElementsByName('checkboxvar[]');
            for(var i in checkboxes)
                checkboxes[i].checked = source.checked;
        }

        // assign team
        $("#otherCatches").change(function() {
            var chkArray = [];
            var teamId=$(this).val();



            $('.checkboxvar:checked').each(function (i) {
                chkArray[i] = $(this).val();
            });

            // console.log(chkArray);

            // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            jQuery('input:checkbox:checked').parents("tr").remove();
            $(this).prop('selectedIndex',0);

            $.ajax({
                type : 'post' ,
                url : '<?php echo e(route('team.employee.insert')); ?>',
                data : {
                    _token: "<?php echo e(csrf_token()); ?>",
                    'userId':chkArray,
                    'teamId':teamId
                } ,
                success : function(data){
                    if(data == 'true'){

                        alert('Successfully Employee Assigned');


                        location.reload();
                        $('#freeEmployee').load(document.URL +  ' #freeEmployee');


                        // $.alert({
                        //     animationBounce: 2,
                        //     title: 'Success!',
                        //     content: 'Employee Assigned',
                        // });

                        $('#alert').html(' <strong>Success!</strong> Assigned');
                        $('#alert').show();






                    }
                }
            });
        });




    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mainLayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>