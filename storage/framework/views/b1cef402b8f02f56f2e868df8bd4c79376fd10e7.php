<?php $__env->startSection('css'); ?>


    <!-- DataTables -->
    <link href="<?php echo e(url('public/plugins/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(url('public/plugins/datatables/buttons.bootstrap4.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="<?php echo e(url('public/plugins/datatables/responsive.bootstrap4.min.css')); ?>" rel="stylesheet" type="text/css" />

    <style>
        .lds-facebook {
            display: inline-block;
            position: relative;
            width: 64px;
            height: 37px;
        }
        .lds-facebook div {
            display: inline-block;
            position: absolute;
            left: 6px;
            width: 13px;
            background: #99ff48;
            animation: lds-facebook 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
        }
        .lds-facebook div:nth-child(1) {
            left: 6px;
            animation-delay: -0.24s;
        }
        .lds-facebook div:nth-child(2) {
            left: 26px;
            animation-delay: -0.12s;
        }
        .lds-facebook div:nth-child(3) {
            left: 45px;
            animation-delay: 0;
        }
        @keyframes  lds-facebook {
            0% {
                top: 6px;
                height: 51px;
            }
            50%, 100% {
                top: 19px;
                height: 26px;
            }
        }

    </style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


    <div class="row">

        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title">All Bill</h4>
                    <div class="row">
                    <div class="form-group col-md-3">
                        <label>Select Month</label>
                        <input type="text" id="billMonth" class="form-control datepicker" <?php if(isset($date)): ?> value="<?php echo e($date); ?>" <?php endif; ?> name="selectMonth" onchange="changeDate(this)">
                    </div>
                    <div align="right" class="col-md-8">
                        <?php if( $json !== ""): ?>
                            <h5><span class="blinking"><i class="fa fa-circle"></i></span><?php echo e($json); ?></h5>
                        <?php endif; ?>

                    </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-3">
                            <div id="loding" class="lds-facebook"><div></div><div></div><div></div></div>
                            <button id="generateAllBill" style="display: none" class="btn-info" name="generateBill">Genarate All bill</button>
                        </div>
                        <div class="col-md-3">
                            
                            
                        </div>
                        <div class="col-md-3">
                            
                        </div>
                    </div>

                    <div class="table table-responsive">
                        <table id="manageapplication" class="table table-striped table-bordered" style="width:100%" >
                            <thead>
                            <tr>

                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone</th>
                                
                                <th>Received By</th>
                                <th>Price</th>
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
                        if ($('#billMonth').val()!=""){
                            d.billMonth=$('#billMonth').val();
                        }


                    },
                },
                columns: [


                    { data: 'clientFirstName', name: 'cable_client.clientFirstName',"orderable": false, "searchable":true },
                    { data: 'clientLastName', name: 'cable_client.clientLastName',"orderable": false, "searchable":true },
                    { data: 'phone', name: 'cable_client.phone', "orderable": false, "searchable":true },
                    // { data: 'cablepackageName', name: 'cablepackage.cablepackageName', "orderable": false, "searchable":true },
//                    { data: 'bandWide', name: 'cable_client.bandWide', "orderable": true, "searchable":true },
                    { data: 'name', name: 'user.name', "orderable": true, "searchable":true },
                    { data: 'billprice', name: 'cable_bill.price', "orderable": true, "searchable":true },



                    { "data": function(data){

                    if (data.billStatus=='np'){
                        return '<select style="background-color:red;color:white"class="form-control" id="billtype'+data.fkclientId+'" data-panel-date="<?php echo e($date); ?>" data-panel-id="'+data.fkclientId+'" data-primary-id="'+data.billId+'" onchange="changebillstatus(this)">'+
                        '<option  value="paid"  >Paid</option>'+
                        '<option value="due" selected  >Due</option>'+
                                <?php if(Auth::user()->fkusertype=='Admin'): ?>
                            '<option value="approved"  >Approved</option>'+
                                <?php endif; ?>
                        '</select>';
                    }else if (data.billStatus=='p'){
                        return '<select  style="background-color:green;color:white"class="form-control" id="billtype'+data.fkclientId+'" data-panel-date="<?php echo e($date); ?>" data-panel-id="'+data.fkclientId+'" data-primary-id="'+data.billId+'" onchange="changebillstatus(this)">'+
                            '<option  value="paid" selected  >Paid</option>'+
                            '<option value="due"   >Due</option>'+
                                <?php if(Auth::user()->fkusertype=='Admin'): ?>
                            '<option value="approved"  >Approved</option>'+
                                <?php endif; ?>
                            '</select>';
                    }
                    else if(data.billStatus=='ap'){
                        return "Approved";
                    }
                    ;},
                        "orderable": false, "searchable":false
                    },
                    { "data": function(data){
                        return '<button class="btn btn-info btn-sm" data-panel-date="<?php echo e($date); ?>" data-panel-id="'+data.fkclientId+'" onclick="generateBill(this)" ><i class="fa fa-print"></i></button>'
                            ;},
                        "orderable": false, "searchable":false
                    },


                ],
                "fnDrawCallback": function() {
                    var api = this.api()
                    var json = api.ajax.json();
                    if ('<?php echo e($cableClient); ?>'==json.total){

                        $('#generateAllBill').show();
                        $('#loding').hide();

                    }


                }
            });



        } );

        function generateBill(x) {
            var id = $(x).data('panel-id');
            var date = $(x).data('panel-date');

            let url = "<?php echo e(route('bill.Cable.invoiceByClient',[':id',':date'])); ?>";


            url = url.replace(':date', date);
            url = url.replace(':id', id);


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
                        var primaryId = $(x).data('primary-id');
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

                        else if(billtype == 'approved'){
                            $.ajax({
                                type: 'POST',
                                url: "<?php echo route('bill.Cable.approved'); ?>",
                                cache: false,
                                data: {_token: "<?php echo e(csrf_token()); ?>", 'id': id,date:date,primaryId:primaryId},
                                success: function (data) {

                                    console.log(data);


                                    $.alert({
                                        title: 'Success!',
                                        type: 'green',
                                        content: "Approved",
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






        $("#generateAllBill").click(function () {


            let url = "<?php echo e(route('bill.Cable.invoice',[':date'])); ?>";


            url = url.replace(':date', '<?php echo e($date); ?>');

            window.open(url,'_blank')

        });

        $("#sendBillToPaySms").click(function () {


            $.confirm({
                title: 'Confirm!',
                content: 'Are You Sure!',
                buttons: {
                    confirm: function () {



                        $.ajax({
                            type: 'get',
                            url: "<?php echo route('sms.cablebillToPay.send'); ?>",
                            cache: false,
                            data: {_token: "<?php echo e(csrf_token()); ?>",type:"sendBillToPaySms" },
                            success: function (data) {

                                console.log(data);

                                if (data == "404 - Wrong Username" || data=="405 - Wrong Password"){

                                    $.alert({
                                        title: 'Alert!',
                                        type: 'red',
                                        content: 'Wrong User Name or password of Sms Config',
                                        buttons: {
                                            tryAgain: {
                                                text: 'Ok',
                                                btnClass: 'btn-red',
                                                action: function () {


                                                    table.ajax.reload();




                                                }
                                            }

                                        }
                                    });

                                }
                                else if (data=="407 - Wrong Brandname Given"){

                                    $.alert({
                                        title: 'Alert!',
                                        type: 'red',
                                        content: 'Wrong Brand Name of Sms Config',
                                        buttons: {
                                            tryAgain: {
                                                text: 'Ok',
                                                btnClass: 'btn-red',
                                                action: function () {


                                                    table.ajax.reload();




                                                }
                                            }

                                        }
                                    });

                                }else if (data=="409"){

                                    $.alert({
                                        title: 'Alert!',
                                        type: 'red',
                                        content: "sms Sent cancelled for insufficient balance",
                                        buttons: {
                                            tryAgain: {
                                                text: 'Ok',
                                                btnClass: 'btn-red',
                                                action: function () {


                                                    table.ajax.reload();




                                                }
                                            }

                                        }
                                    });

                                }

                                else if (data=="400"){

                                    $.alert({
                                        title: 'Success!',
                                        type: 'green',
                                        content: 'Sms Send SuccessFully',
                                        buttons: {
                                            tryAgain: {
                                                text: 'Ok',
                                                btnClass: 'btn-blue',
                                                action: function () {


                                                    table.ajax.reload();



                                                }
                                            }

                                        }
                                    });

                                }
                                else if(data=="1") {

                                    $.alert({
                                        title: 'Alert!',
                                        type: 'red',
                                        content: 'You Allready Sent Sms once in this month',
                                        buttons: {
                                            tryAgain: {
                                                text: 'Ok',
                                                btnClass: 'btn-red',
                                                action: function () {


                                                    table.ajax.reload();




                                                }
                                            }

                                        }
                                    });

                                }



                            }
                        });

                    },
                    cancel: function () {

                        table.ajax.reload();

                    },

                }
            });


        });
        $("#sendBillSms").click(function () {


            $.confirm({
                title: 'Confirm!',
                content: 'Are You Sure!',
                buttons: {
                    confirm: function () {



                        $.ajax({
                            type: 'get',
                            url: "<?php echo route('sms.sendCableBillSms.send'); ?>",
                            cache: false,
                            data: {_token: "<?php echo e(csrf_token()); ?>",type:"sendBillSms"},
                            success: function (data) {

                                console.log(data);

                                if (data == "404 - Wrong Username" || data=="405 - Wrong Password"){

                                    $.alert({
                                        title: 'Alert!',
                                        type: 'red',
                                        content: 'Wrong User Name or password of Sms Config',
                                        buttons: {
                                            tryAgain: {
                                                text: 'Ok',
                                                btnClass: 'btn-red',
                                                action: function () {


                                                    table.ajax.reload();




                                                }
                                            }

                                        }
                                    });

                                }
                                else if (data=="407 - Wrong Brandname Given"){

                                    $.alert({
                                        title: 'Alert!',
                                        type: 'red',
                                        content: 'Wrong Brand Name of Sms Config',
                                        buttons: {
                                            tryAgain: {
                                                text: 'Ok',
                                                btnClass: 'btn-red',
                                                action: function () {


                                                    table.ajax.reload();




                                                }
                                            }

                                        }
                                    });

                                }else if (data=="409"){

                                    $.alert({
                                        title: 'Alert!',
                                        type: 'red',
                                        content: "sms Sent cancelled for insufficient balance",
                                        buttons: {
                                            tryAgain: {
                                                text: 'Ok',
                                                btnClass: 'btn-red',
                                                action: function () {


                                                    table.ajax.reload();




                                                }
                                            }

                                        }
                                    });

                                }

                                else if (data=="400"){

                                    $.alert({
                                        title: 'Success!',
                                        type: 'green',
                                        content: 'Sms Send SuccessFully',
                                        buttons: {
                                            tryAgain: {
                                                text: 'Ok',
                                                btnClass: 'btn-blue',
                                                action: function () {


                                                    table.ajax.reload();



                                                }
                                            }

                                        }
                                    });

                                }
                                else if(data=="1") {

                                    $.alert({
                                        title: 'Alert!',
                                        type: 'red',
                                        content: 'You Allready Sent Sms once in this month',
                                        buttons: {
                                            tryAgain: {
                                                text: 'Ok',
                                                btnClass: 'btn-red',
                                                action: function () {


                                                    table.ajax.reload();




                                                }
                                            }

                                        }
                                    });

                                }



                            }
                        });

                    },
                    cancel: function () {

                        table.ajax.reload();

                    },

                }
            });


        });



    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mainLayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>