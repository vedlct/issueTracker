<?php $__env->startSection('css'); ?>


    <!-- DataTables -->
    <link href="<?php echo e(url('public/plugins/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(url('public/plugins/datatables/buttons.bootstrap4.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="<?php echo e(url('public/plugins/datatables/responsive.bootstrap4.min.css')); ?>" rel="stylesheet" type="text/css" />

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>



    <div class="row">

        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title">All Bill</h4>


                    <div class="table table-responsive">
                        <table id="manageapplication" class="table table-striped table-bordered" style="width:100%" >
                            <thead>
                            <tr>

                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone</th>
                                <th>Package Name</th>
                                
                                <th>Price</th>
                                <th>Bill Date</th>
                                <th>Action</th>
                                <th>Invoice</th>


                            </tr>
                            </thead>
                        </table>
                    </div>


                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->



<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

    <script src="<?php echo e(url('public/assets/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/plugins/datatables/dataTables.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(url('public/plugins/datatables/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(url('public/plugins/datatables/responsive.bootstrap4.min.js')); ?>"></script>
    <!-- Buttons examples -->
    <script src="<?php echo e(url('public/assets/plugins/datatables/dataTables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/js/bootstrap-datepicker.js')); ?>"></script>

    <script>

        $(document).ready( function () {
            $('.datepicker').datepicker({
                format: 'MM-yyyy',
                autoclose:true,
                minViewMode: 1,

            });


            table = $('#manageapplication').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                "ajax":{
                    "url": "<?php echo route('bill.cable.show.withData'); ?>",
                    "type": "POST",
                    data:function (d){

                        d._token="<?php echo e(csrf_token()); ?>";
                        d.pastDue=true;
                        <?php if(isset($LastMonth)): ?>
                            d.billMonth='<?php echo e($LastMonth); ?>';
                        <?php endif; ?>



                    },
                },
                columns: [


                    { data: 'clientFirstName', name: 'cable_client.clientFirstName',"orderable": false, "searchable":true },
                    { data: 'clientLastName', name: 'cable_client.clientLastName',"orderable": false, "searchable":true },
                    { data: 'phone', name: 'cable_client.phone', "orderable": false, "searchable":true },
                    { data: 'cablepackageName', name: 'cablepackage.cablepackageName', "orderable": false, "searchable":true },
//                    { data: 'bandWide', name: 'internet_client.bandWide', "orderable": true, "searchable":true },
                    { data: 'billprice', name: 'cable_bill.price', "orderable": true, "searchable":true },
//                    { data: 'address', name: 'client.address', "orderable": true, "searchable":true },
                    { data: 'billdate', name: 'cable_bill.billdate', "orderable": true, "searchable":true },



                    { "data": function(data){

                        if (data.billStatus=='np'){

                            return '<select style="background-color:red;color:white" class="form-control" id="billtype'+data.fkclientId+'" data-panel-date="'+data.billdate+'" data-panel-id="'+data.fkclientId+'" onchange="changebillstatus(this)">'+
                                '<option  value="paid"  >Paid</option>'+
                                '<option value="due" selected  >Due</option>'+
                                '</select>';
                        }else if (data.billStatus=='p'){

                            return '<select style="background-color:green;color:white" class="form-control" id="billtype'+data.fkclientId+'" data-panel-date="'+data.billdate+'" data-panel-id="'+data.fkclientId+'" onchange="changebillstatus(this)">'+
                                '<option  value="paid" selected  >Paid</option>'+
                                '<option value="due"   >Due</option>'+
                                '</select>';
                        }
                        ;},
                        "orderable": false, "searchable":false
                    },
                    { "data": function(data){
                        return '<button class="btn btn-info btn-sm" data-panel-date="<?php echo e(date('Y-m-d')); ?>" data-panel-id="'+data.fkclientId+'" onclick="generateBill(this)" ><i class="fa fa-print"></i></button>'
                            ;},
                        "orderable": false, "searchable":false
                    },


                ],

            });

        } );

        function generateBill(x) {
            var id = $(x).data('panel-id');
            var date = $(x).data('panel-date');

//            alert(date);return false;


            let url = "<?php echo e(route('bill.Cable.invoiceByClient',[':id',':date'])); ?>";


            url = url.replace(':id', id);
            url = url.replace(':date', date);


            window.open(url,'_blank');

        }
        function changeDate(x) {
            table.ajax.reload();

        }

        function changebillstatus(x) {

            $.confirm({
                title: 'Confirm!',
                content: 'Are You Sure!',
                buttons: {
                    confirm: function () {
                        var id = $(x).data('panel-id');
                        var date = $(x).data('panel-date');

                        var billtype = document.getElementById('billtype'+id).value;

                        if (billtype == 'paid') {

                            $.ajax({
                                type: 'POST',
                                url: "<?php echo route('bill.Cable.paid'); ?>",
                                cache: false,
                                data: {_token: "<?php echo e(csrf_token()); ?>", 'id': id,date:date},
                                success: function (data) {

                                    console.log(data);

                                    $.alert({
                                        title: 'Success!',
                                        type: 'green',
                                        content: data,
                                        buttons: {
                                            tryAgain: {
                                                text: 'Ok',
                                                btnClass: 'btn-blue',
                                                action: function () {


                                                    location.reload();




                                                }
                                            }

                                        }
                                    });

                                }
                            });
                        }
                        else if (billtype == 'due') {
                            $.ajax({
                                type: 'POST',
                                url: "<?php echo route('bill.Cable.due'); ?>",
                                cache: false,
                                data: {_token: "<?php echo e(csrf_token()); ?>", 'id': id,date:date},
                                success: function (data) {



                                    $.alert({
                                        title: 'Alert!',
                                        type: 'red',
                                        content: data,
                                        buttons: {
                                            tryAgain: {
                                                text: 'Ok',
                                                btnClass: 'btn-red',
                                                action: function () {


                                                    location.reload();




                                                }
                                            }

                                        }
                                    });


                                }
                            });

                        }

                    },
                    cancel: function () {

                        location.reload();

                    },

                }
            });


        }









    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mainLayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>