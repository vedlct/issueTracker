<?php $__env->startSection('css'); ?>


    <!-- DataTables -->
    <link href="<?php echo e(url('public/plugins/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(url('public/plugins/datatables/buttons.bootstrap4.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="<?php echo e(url('public/plugins/datatables/responsive.bootstrap4.min.css')); ?>" rel="stylesheet" type="text/css" />

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <!-- end page title end breadcrumb -->
    <div class="modal" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Client</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form method="post" action="<?php echo e(route('internet.client.insert')); ?>" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>


                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>First Name</label>
                                <input type="text" name="clientFirstName" placeholder="First Name" class="form-control" >
                            </div>
                            <div class="form-group col-md-6">
                                <label>Last Name</label>
                                <input type="text" name="clientLastName" placeholder="Last Name" class="form-control" >
                            </div>
                            <div class="form-group col-md-6">
                                <label>email</label>
                                <input type="email" name="email" placeholder="Email" class="form-control" >
                            </div>
                            <div class="form-group col-md-6">
                                <label>phone</label>
                                <input type="text" name="phone" placeholder="phone" class="form-control" >
                            </div>
                            <div class="form-group col-md-6">
                                <label>ip</label>
                                <input type="text" name="ip" placeholder="ip" class="form-control" >
                            </div>
                            <div class="form-group col-md-6">
                                <label>Internet Package</label>
                                <select class="form-control" id="package" onchange="getpackage()" name="package">
                                    <option>Select a Package</option>
                                    <?php $__currentLoopData = $package; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($p->packageId); ?>"><?php echo e($p->packageName); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label>bandWidth</label>
                                <input type="text" name="bandwidth" id="bandwidth" placeholder="bandwidth" class="form-control" >
                            </div>
                            <div class="form-group col-md-6">
                                <label>Price</label>
                                <input type="text" name="price" id="price" placeholder="price" class="form-control" >
                            </div>

                            <div class="form-group col-md-6">
                                <label>Bandwidth Type</label>
                                <select class="form-control" name="bandwidthType" required>
                                    <option value="">Select Type</option>
                                    <?php $__currentLoopData = BANDWIDTH_TYPE; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>


                            <div class="form-group col-md-6">
                                <label>Client Id</label>
                                <input type="text" name="clientSerial"  placeholder="id" class="form-control" >
                            </div>


                            <div class="form-group col-md-6">
                                <label>Connection Date</label>
                                <input type="text" name="conDate"  placeholder="date"  class="form-control datepicker" >
                            </div>

                            <div class="form-group col-md-6">
                                <label>Cable Length</label>
                                <input type="number" name="cableLength"  placeholder="meter" class="form-control" >
                            </div>
                            <div class="form-group col-md-6">
                                <label>Connection Type</label>
                                <select class="form-control" name="connectionType" onchange="connectionTypeChange(this)" required>
                                    <option value="">Select Connection Type</option>
                                    <?php $__currentLoopData = CONNECTION_TYPE; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Status</label>
                                <select class="form-control" name="status" required>
                                    <option value="">Select Status</option>
                                    <?php $__currentLoopData = USER_STATUS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="form-group col-md-6" id="connectionTypeField">

                            </div>




                            <div class="form-group col-md-12">
                                <label>Address</label>
                                <textarea name="address"  placeholder="address" class="form-control"></textarea>
                            </div>

                            <div class="col-md-12"><hr></div>


                            <div id="TextBoxesGroup" class="col-md-12">

                            </div>

                            <div class="form-group col-md-12 pull-right">
                                <button type="button" class="btn btn-info btn-sm " onclick="addMore()">add more</button>
                                <button type="button" class="btn btn-danger btn-sm " onclick="removeField()">remove</button>
                            </div>
                            <div class="form-group col-md-12">
                                <button class="btn btn-success pull-right">submit</button>
                            </div>

                        </div>


                    </form>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">

                </div>

            </div>
        </div>
    </div>
    <!-- The Edit Modal -->
    <div class="modal" id="editModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Update Client</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" id="editModalBody">

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">

                </div>

            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="text-right mb-2 mr-2">
                        <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#myModal">
                            Add Client
                        </button>
                    </div>
                    <h4 class="mt-0 header-title">Internet Clients</h4>

                    <table id="datatable" class="table table-bordered  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>IP</th>
                            <th>Package Name</th>
                            <th>BandWide</th>
                            <th>Price</th>
                            <th>Address</th>

                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>

                    </table>

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
    <script>
        counter=0;
        $(document).ready(function() {
//            $('.empform').parsley();

            $('.datepicker').datepicker({
                format: 'yyyy/mm/dd',
                autoclose:true,


            });
        });

        function connectionTypeChange(x) {
            // alert();
            var val=$(x).val();
            if(val=='1'){
                $('#connectionTypeField').html('' +
                    ' <label>Connection</label>\n' +
                    '<select class="form-control" name="connectionValue"  required>\n' +
                    '                                    <option value="">Select Connection Type</option>\n' +
                    '                                    <?php $__currentLoopData = CONNECTION_FIBER; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>\n' +
                    '                                        <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>\n' +
                    '                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>\n' +
                    '                                </select>');
            }
            else if(val=='2'){
                $('#connectionTypeField').html('' +
                    ' <label>Connection</label>\n' +
                    '<select class="form-control" name="connectionValue"  required>\n' +
                    '                                    <option value="">Select Connection Type</option>\n' +
                    '                                    <?php $__currentLoopData = CONNECTION_UTP; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>\n' +
                    '                                        <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>\n' +
                    '                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>\n' +
                    '                                </select>');
            }
            else {
                $('#connectionTypeField').html('');
            }


        }

        function addMore(){
            // if(counter>10){
            //     alert("Only 10 textboxes allow");
            //     return false;
            // }


            // var id=document.getElementById("service"+(counter-1)).value;
            // if(id=="") {
            //     alert("Please Select a Service First!!");
            //     return false;
            //
            // }
            //


            var newTextBoxDiv = $(document.createElement('div'))
                .attr("id", 'TextBoxDiv' + counter);

            newTextBoxDiv.after().html('<div class="row"><div class="form-group col-md-6">\n' +
                '                                <label>Name</label>\n' +
                '                                <input type="text" name="clientFile[]"  placeholder="insert image" class="form-control" required>\n' +
                '                            </div>\n' +
                '                            <div class="form-group col-md-6">\n' +
                '                                <label>File</label>\n' +
                '                                <input type="file" name="clientImage[]"  placeholder="insert image" class="form-control" required>\n' +
                '                            </div></div>'
            );
            newTextBoxDiv.appendTo("#TextBoxesGroup");
            counter++;
            // ii++;

        }
        function removeField(){
            if(counter==0){
                alert(" textbox to remove");
                return false;
            }
            counter--;
            $("#TextBoxDiv" + counter).remove();

        }

        $(document).ready( function () {

            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                Filter: true,
                stateSave: true,
                type:"POST",
                "ajax":{
                    "url": "<?php echo route('internet.client.getData'); ?>",
                    "type": "POST",
                    "data":{ _token: "<?php echo e(csrf_token()); ?>"},
                },
                columns: [
                    { data: 'clientFirstName', name: 'internet_client.clientFirstName' },
                    { data: 'clientLastName', name: 'internet_client.clientLastName' },
                    { data: 'email', name: 'internet_client.email'},
                    { data: 'phone', name: 'internet_client.phone'},
                    { data: 'ip', name: 'internet_client.ip'},
                    { data: 'packageName', name: 'package.packageName'},
                    { data: 'bandWide', name: 'internet_client.bandWide'},
                    { data: 'price', name: 'internet_client.price'},
                    { data: 'address', name: 'internet_client.address'},
                    { "data": function(data){

                            return '<a class="btn btn-default btn-sm"  data-panel-id="'+data.clientId+'" onclick="editClient(this)"><i class="fa fa-edit"></i></a>'
                                ;},
                        "orderable": false, "searchable":false, "name":"selected_rows" },
                ]
            });
        } );


        function editClient(x) {
            var id=$(x).data('panel-id');

            $.ajax({
                type: 'POST',
                url: "<?php echo route('internet.client.edit'); ?>",
                cache: false,
                data: {_token: "<?php echo e(csrf_token()); ?>",'id': id},
                success: function (data) {
                    $("#editModalBody").html(data);
                    $('#editModal').modal();
                    // console.log(data);
                }
            });
        }

        function editClientById(id) {
            // var id=$(x).data('panel-id');

            $.ajax({
                type: 'POST',
                url: "<?php echo route('internet.client.edit'); ?>",
                cache: false,
                data: {_token: "<?php echo e(csrf_token()); ?>",'id': id},
                success: function (data) {
                    $("#editModalBody").html(data);
                    $('#editModal').modal();
                    // console.log(data);
                }
            });
        }




        function getpackage() {
            var id=document.getElementById('package').value;

            $.ajax({
                type: 'POST',
                url: "<?php echo route('package.getpackage'); ?>",
                cache: false,
                data: {_token: "<?php echo e(csrf_token()); ?>",'id': id},
                success: function (data) {
                    // $("#editModalBody").html(data);
                    // $('#editModal').modal();
                    // console.log(data);
                    //   $('bandwidth').val(data.bandwidth);
                    //  $('price').val(data.price);

                    document.getElementById('bandwidth').value = data.bandwidth;
                    document.getElementById('price').value = data.price;
                    document.getElementById('cablepackage').value = "Select a Package";

                }
            });
        }

        function getcablepackage() {
            var id=document.getElementById('package').value;

            $.ajax({
                type: 'POST',
                url: "<?php echo route('package.cable.getpackage'); ?>",
                cache: false,
                data: {_token: "<?php echo e(csrf_token()); ?>",'id': id},
                success: function (data) {
                    // $("#editModalBody").html(data);
                    // $('#editModal').modal();
                    // console.log(data);
                    //   $('bandwidth').val(data.bandwidth);
                    //  $('price').val(data.price);

                    var price = document.getElementById('price').value ;

                    document.getElementById('price').value =   parseFloat(price) + parseFloat(data.price);

                }
            });
        }
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mainLayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>