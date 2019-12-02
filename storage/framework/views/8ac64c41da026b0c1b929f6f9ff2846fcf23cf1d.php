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
                <div class="text-left mb-2 mr-2">
                    <label for="datepicket">From</label>
                    <input class="form-group datepicker" id="dateFilterFrom" name="dateFilterFrom" type="text"> &nbsp;
                    <label for="datepicket">To</label>
                    <input class="form-group datepicker" id="dateFilterTo" name="dateFilterTo" type="text">
                    <input class="btn btn-sm btn-info" id="Submit" name="Submit" value="Submit" onclick="getCreditData()" type="button">

                    <div class="text-left mb-2 mr-2">
                        <div id="totalSumDiv" style="font-weight: bold">Total Sum : &nbsp;&nbsp;<span id="totalSum" style="color: red"><?php echo e($totalOFCurrentMonth); ?></span></div>
                    </div>

                </div>


                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                    <tr>
                        <th style="text-align:right">Total:</th>
                        <th colspan="2"><span id="pageTotal"></span></th>

                    </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>
    <!-- end col -->

<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>



    <!-- Required datatable js -->
    <script src="<?php echo e(url('public/plugins/parsleyjs/parsley.min.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    
    <!-- Datatable init js -->
    <script>
        $(document).ready(function() {
//            $('.empform').parsley();

            $('.datepicker').datepicker({
                format: 'yyyy/mm/dd',
                autoclose:true,


            });
        });
    </script>

    <script>




        $(document).ready( function () {

            datatable =  $('#datatable').DataTable({

                drawCallback: function () {
                    var api = this.api();
                    $('#pageTotal').html(api.column( 1, {page:'current'}).data().sum());

                },

                processing: true,
                serverSide: true,
                Filter: true,
                stateSave: true,
                type:"POST",
                "ajax":{
                    "url": "<?php echo route('report.getCreditData'); ?>",
                    "type": "POST",


                    data:function (d){

                        d._token="<?php echo e(csrf_token()); ?>";

                        if ($('#dateFilterTo').val()!=""){
                            d.dateFilterTo=$('#dateFilterTo').val();
                        }
                        if ($('#dateFilterFrom').val()!=""){
                            d.dateFilterFrom=$('#dateFilterFrom').val();
                        }
                        if($('#dateFilterTo').val()== '' && $('#dateFilterFrom').val() == ''){
                            d.currentMonth=true;
                        }

                    }
                },
                columns: [
                    { data: 'date', name: 'date' },
                    { data: 'price', name: 'price' },

                    { "data": function(data){

                        return '<a class="btn btn-info btn-sm" data-panel-id="'+data.reportId+'" onclick="showDetails(this)"><i class="fa fa-edit"></i></a>'
                            ;},
                        "orderable": false, "searchable":false, "name":"selected_rows" },

                ]
            });




        } );
        function showDetails(x) {
            var id = $(x).data('panel-id');

            $.ajax({
                type: 'POST',
                url: "<?php echo route('report.Details'); ?>",
                cache: false,
                data: {_token: "<?php echo e(csrf_token()); ?>", 'id': id},
                success: function (data) {

                    $('.modal-body').html(data);
                    $('#myModalLabel').html("Details-Report");
                    $('#myModal').modal();

                }
            });
        }



        function getCreditData() {
            datatable.ajax.reload();  //just reload table
            $.ajax({
                type: 'POST',
                url: "<?php echo route('report.getTotalCredit'); ?>",
                cache: false,
                data: {_token: "<?php echo e(csrf_token()); ?>",'dateFilterTo':$('#dateFilterTo').val(),'dateFilterFrom':$('#dateFilterFrom').val()},
                success: function (data) {
                    $("#totalSum").html(data);
//                        console.log(data);
                }
            });
        }

    </script>

    
    <script src="<?php echo e(url('public/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(url('public/plugins/datatables/dataTables.bootstrap4.min.js')); ?>"></script>

    <script src="<?php echo e(url('public/plugins/datatables/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(url('public/plugins/datatables/responsive.bootstrap4.min.js')); ?>"></script>

    <script src="<?php echo e(url('public/pages/datatables.init.js')); ?>"></script>

    <script>
        jQuery.fn.dataTable.Api.register( 'sum()', function ( ) {
            return this.flatten().reduce( function ( a, b ) {
                if ( typeof a === 'string' ) {
                    a = a.replace(/[^\d.-]/g, '') * 1;
                }
                if ( typeof b === 'string' ) {
                    b = b.replace(/[^\d.-]/g, '') * 1;
                }

                return a + b;
            }, 0 );
        } );
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mainLayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>