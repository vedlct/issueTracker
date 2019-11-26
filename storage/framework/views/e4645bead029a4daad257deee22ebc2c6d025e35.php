<?php $__env->startSection('css'); ?>
    <style >
    .table-condensed>thead>tr>th, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>tbody>tr>td, .table-condensed>tfoot>tr>td{
        padding: 1px;
    }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4 class="float-left">All Company Information</h4>
            <a href="<?php echo e(route('company.create')); ?>" class="btn btn-success float-right" name="button" style="color: #0a1832">Create Company</a>
            
        </div>
        <div class="card-body">
            <table id="companyTable" class="table-bordered table-condensed text-center table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Company Information</th>
                        <th>Email</th>
                        <th>Phone</th>
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

            dataTable=  $('#companyTable').DataTable({
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
                   "url": "<?php echo route('company.getAllCompany'); ?>",
                   "type": "POST",
                   data:function (d){
                       d._token="<?php echo e(csrf_token()); ?>";
                   },
               },
               columns: [
                   { data: 'companyName', name: 'company.companyName' },
                   { data: 'companyInfo', name: 'company.companyInfo' },
                   { data: 'companyEmail', name: 'company.companyEmail' },
                   { data: 'companyPhone1', name: 'company.companyPhone1' },

                   { "data": function(data){
                            return '<button class="btn btn-success btn-sm mr-2 m-1" data-panel-id="'+data.companyId+'" onclick="editCompany(this)"><i class="fa fa-cog"></i></button>'+
                                   '<button class="btn btn-danger btn-sm mr-2" data-panel-id="'+data.companyId+'" onclick="deleteCompany(this)"><i class="fa fa-trash"></i></button>'+
                                   '<button class="btn btn-primary btn-sm" data-panel-id="'+data.companyId+'" onclick="showClients(this)"><i class="fa fa-users"></i></button>'
                            ;},
                        "orderable": false, "searchable":false, "name":"selected_rows" },
               ]
            } );

        } );

        // call edit company
        function editCompany(x) {
            btn = $(x).data('panel-id');
            var url = '<?php echo e(route("company.edit", ":id")); ?>';
            var newUrl=url.replace(':id', btn);
            window.location.href = newUrl;
        }

        // call delete shop
        function deleteCompany(x) {
            // confirmation
            var result = confirm("Are you sure want to delete?");
            if (result) {
                btn = $(x).data('panel-id');
                $.ajax({
                     type: 'POST',
                     url: "<?php echo route('company.delete'); ?>",
                     cache: false,
                     data: {
                         _token: "<?php echo e(csrf_token()); ?>",
                         'id': btn
                     },
                     success: function (data) {
                         $.alert({
                             animationBounce: 2,
                             title: 'Success!',
                             content: 'Company Deleted',
                         });
                         dataTable.ajax.reload();
                     }
                });
            }
        }

        function showClients(x) {
            btn = $(x).data('panel-id');
            var url = '<?php echo e(route("company.show.clients", ":id")); ?>';
            var newUrl = url.replace(':id', btn);
            window.location.href = newUrl;
        }

    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mainLayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>