<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <!-- Add Sub Company Modal -->
    <div class="modal fade" id="addClientModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ADD CONTACT PERSON</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" action="<?php echo e(route('client.insert.contactPerson')); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" value="<?php echo e($client->clientId); ?>" name="clientId">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Full Name *</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" placeholder="name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="email" placeholder="mail@gmail.com">
                            </div>
                        </div>












                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Phone</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="phone" placeholder="017*****">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Profile Photo</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="profilePhoto">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary pull-right">Add Contact Person</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">CHANGE CONTACT PERSON INFORMATION</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="editModalBody">

                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="float-left" style="font-weight: 200";>Contact Persons - [<?php echo e($client->clientName); ?>] </h4>
                <button type="button" class="btn btn-success float-right" name="button" style="color: #0a1832" data-toggle="modal" data-target="#addClientModal">Add New Contact Person</button>
            </div>
            <div class="card-body">
                <table id="personTable" class="table-bordered table-condensed text-center table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Company</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

    <script>

        $(document).ready(function() {

            dataTable=  $('#personTable').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(0)'
                },
                responsive: true,
                processing: true,
                serverSide: true,
                Filter: true,
                stateSave: true,
                ordering:false,
                type:"POST",
                "ajax":{
                    "url": "<?php echo route('client.get.contactPerson'); ?>",
                    "type": "POST",
                    data:function (d){
                        d._token="<?php echo e(csrf_token()); ?>";
                        d.client_id="<?php echo e($client->clientId); ?>";
                    },
                },
                columns: [
                    { data: 'fullName', name: 'user.fullName' },
                    { data: 'email', name: 'user.email' },
                    { data: 'userPhoneNumber', name: 'user.userPhoneNumber' },
                    { data: 'companyName', name: 'company.companyName' },

                    { "data": function(data){
                            return '<button class="btn btn-success btn-sm mr-2 m-1" data-panel-id="'+data.userId+'" onclick="editContactPerson(this)"><i class="fa fa-cog"></i></button>'+
                                   '<button class="btn btn-danger btn-sm" data-panel-id="'+data.userId+'" onclick="deleteContactPerson(this)"><i class="fa fa-trash"></i></button>'
                                ;},
                        "orderable": false, "searchable":false, "name":"selected_rows" },
                ]
            } );

        } );

        
        function editContactPerson(x) {
            id = $(x).data('panel-id');

            $.ajax({
                type: 'POST',
                url: "<?php echo route('client.edit.contactPerson'); ?>",
                cache: false,
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    'person_userId': id,
                },
                success: function (data) {
                    $('#editModalBody').html(data);
                    $('#editModal').modal('show');
                }
            });
        }

        
        function deleteContactPerson(x) {
            btn = $(x).data('panel-id');
            $.confirm({
                title: 'Confirm!',
                content: 'Are you sure want to delete!',
                buttons: {
                    confirm: function () {
                        // delete
                        $.ajax({
                            type: 'POST',
                            url: "<?php echo route('client.delete.contactPerson'); ?>",
                            cache: false,
                            data: {
                                _token: "<?php echo e(csrf_token()); ?>",
                                'userId': btn
                            },
                            success: function (data) {
                                $.alert({
                                    animationBounce: 2,
                                    title: 'Success!',
                                    content: 'Contact Person Deleted',
                                });
                                dataTable.ajax.reload();
                            }
                        });

                    },
                    cancel: function () {

                    },
                }
            });
        }

    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mainLayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>