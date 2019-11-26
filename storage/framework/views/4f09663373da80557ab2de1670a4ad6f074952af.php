<?php $__env->startSection('css'); ?>
    <!-- DataTables -->


    <link href="<?php echo e(url('public/plugins/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(url('public/plugins/datatables/buttons.bootstrap4.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="<?php echo e(url('public/plugins/datatables/responsive.bootstrap4.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if(Session::has('success')): ?>
        <div class="alert alert-success">
            <?php echo e(Session::get('success')); ?>

        </div>
    <?php endif; ?>
    <div class="row m-2">

        <div class="card col-12">
            <div class="card-body">
                <div class="text-left">
                    <label for="statusFilter">
                        Expense Type
                    </label>
                    <select id="statusFilter" class="form-group">
                        <option value="">Select</option>
                        <option value="Food">Food</option>
                        <option value="Router">Router</option>
                        <option value="Accessories">Accessories</option>
                        <option value="Others">Others</option>
                    </select>


                    <label for="Start Date">Expense From</label>
                    <input class="form-group datepicker" name="fromdate" id="dataChange" type="text">
                    <label for="Start Date">To</label>
                    <input class="form-group datepicker" name="toDate" id="dataChange" type="text">
                </div>

                <div class="text-right mb-2 mr-2">
                    <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#addEmp">Add Expense</button>
                </div>
                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>Expense Type</th>
                        <th>Cause</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <!-- end col -->



    
    <!--  Modal content for the above example -->

    <div class="modal fade bs-example-modal-lg" id="addEmp" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Add Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form class="empform" action="<?php echo e(route('expense.store')); ?>" novalidate="" method="post">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group">
                            <label>Expense For</label>
                            <div>
                                <select id="statusFilter" class="form-control" name="expensefor">
                                    <option value="">Select</option>
                                    <option value="Internet">Internet</option>
                                    <option value="Cable">Cable</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Expense Type</label>
                            <div>
                                <select class="form-control" name="expenseType">
                                    <option>Select</option>
                                    <option>Food</option>
                                    <option>Router</option>
                                    <option>Accessories</option>
                                    <option>Others</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>price</label>
                            <div>
                                <input data-parsley-type="number" name="price" type="text" class="form-control" required="" placeholder="Enter Price Amount">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <div>
                                <input data-parsley-type="number" name="amount" type="text" class="form-control" required="" placeholder="Enter Quantity Amount">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Cause</label>
                            <div>
                                <textarea required="" name="cause" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Add Expense</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
    <!-- end row -->

    
    <div class="modal fade " id="editEmp" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Add Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="editEmpBody">

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
    <!-- Required datatable js -->
    <script src="<?php echo e(url('public/plugins/parsleyjs/parsley.min.js')); ?>"></script>
    <!-- Datatable init js -->
    <script>
        $(document).ready(function() {
            $('.empform').parsley();
        });
    </script>

    <script>
        $(document).ready( function () {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose:true,

            });

            datatable =  $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                Filter: true,
                stateSave: true,
                type:"POST",
                "ajax":{
                    "url": "<?php echo route('expense.getData'); ?>",
                    "type": "POST",
                    data:function (d){

                        d._token="<?php echo e(csrf_token()); ?>";

                        if ($('#statusFilter').val()!=""){
                            d.statusFilter=$('#statusFilter').val();
                        }

                    }
                },
                columns: [
                    { data: 'expenseType', name: 'expenseType'},
                    { data: 'cause', name: 'cause'},
                    { data: 'price', name: 'price' },
                    { data: 'amount', name: 'amount' },
                    { data: 'date', name: 'date'},

                    { "data": function(data){

                            return '<a class="btn btn-info btn-sm" data-panel-id="'+data.expenseId+'" onclick="editClient(this)"><i class="fa fa-edit"></i></a>' +
                                '<a class="btn btn-danger btn-sm ml-3" data-panel-id="'+data.expenseId+'" onclick="deleteExpense(this)"><i class="fa fa-trash"></i></a>'
                                ;},
                        "orderable": false, "searchable":false, "name":"selected_rows" },

                ]
            });
        } );
        $('#statusFilter').on('change', function(){

                datatable.ajax.reload();

        });
        function editClient(x) {
            var id=$(x).data('panel-id');

            $.ajax({
                type: 'POST',
                url: "<?php echo route('expense.edit'); ?>",
                cache: false,
                data: {_token: "<?php echo e(csrf_token()); ?>",'id': id},
                success: function (data) {
                    $("#editEmpBody").html(data);
                    $('#editEmp').modal();
                    // console.log(data);
                }
            });

        }
        function deleteExpense(x) {
            var id=$(x).data('panel-id');
            $.confirm({
                title: 'Confirm!',
                content: 'Simple confirm!',
                buttons: {
                    confirm: function () {
                        $.ajax({
                            type: 'POST',
                            url: "<?php echo route('expense.deleteExpense'); ?>",
                            cache: false,
                            data: {_token: "<?php echo e(csrf_token()); ?>",'expenseId': id},
                            success: function (data) {
                                $.alert('Expense Deleted Successfully');
                                datatable.ajax.reload();
                            }
                        });
                    },
                    cancel: function () {
                        $.alert('Canceled!');
                    }
                }
            });



        }

    </script>
    
    <script src="<?php echo e(url('public/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(url('public/plugins/datatables/dataTables.bootstrap4.min.js')); ?>"></script>

    <script src="<?php echo e(url('public/plugins/datatables/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(url('public/plugins/datatables/responsive.bootstrap4.min.js')); ?>"></script>

    <script src="<?php echo e(url('public/pages/datatables.init.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mainLayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>