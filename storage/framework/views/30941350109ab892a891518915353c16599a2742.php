<?php $__env->startSection('css'); ?>
    <style>
        tr{
            text-align: center;
        }
        .table>tbody>tr>td, .table>tfoot>tr>td, .table>thead>tr>td {
            padding: 5px 12px !important;
        }
        .changeMouse {
            cursor: pointer;
        }
    </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <!-- EDIT Modal -->
    <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Feature Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="edit_modal_space">

                </div>
            </div>
        </div>
    </div>

    <!-- Show Comment Modal -->
    <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">All Comments</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="allComments">

                </div>
            </div>
        </div>
    </div>

    <!-- Show Owner Modal -->
    <div class="modal fade" id="ownerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">All Owner</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="allOwners">

                </div>
            </div>
        </div>
    </div>



    <div class="card">
        <h5 class="card-header mt-0">
            <?php echo e($project->project_name); ?>

            <?php if(Auth::user()->fk_userTypeId != 2): ?>
                <a class="btn btn-primary btn-sm pull-right ml-2" href="<?php echo e(route('project.Information', $project->projectId)); ?>">ADD FEATURE</a>
                <a class="btn btn-primary btn-sm pull-right ml-2" href="<?php echo e(route('project.projectmanagement', $project->projectId)); ?>">ADD FEATURE (ADVANCE)</a>
                <a class="btn btn-sm btn-secondary pull-right" style="color: white" onclick="generateReport()">Generate Project Excel</a>
            <?php endif; ?>
        </h5>

        <div class="card-body">


            <table class="table table-bordered table-sm table-condensed" id="featurelist">
                <thead>
                <tr>
                    
                    <th scope="col">Feature</th>
                    <th scope="col">Total Hour</th>
                    <th scope="col">Status</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col">Priority</th>
                    <th scope="col">Remarks</th>
                    <th scope="col">Comments</th>
                    <th scope="col">Owner</th>
                    <?php if(Auth::user()->fk_userTypeId != 2): ?>
                        <th scope="col" class="text-center">Action</th>
                    <?php endif; ?>
                </tr>
                </thead>

                

                <tbody></tbody>

                <tr>
                    <td><b>Total Expected Hour</b></td>
                    <td><?php echo e($exp_time); ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <?php if(Auth::user()->fk_userTypeId != 2): ?>
                        <td></td>
                    <?php endif; ?>
                </tr>

            </table>

        </div>
    </div>




<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function() {
            // getallData();
        });
        $(document).ready(function() {
            dataTable=  $('#featurelist').DataTable({
//                rowReorder: {
//                    selector: 'td:nth-child(0)'
//                },
                responsive: true,
                processing: true,
                serverSide: true,
                Filter: true,
                stateSave: true,
                ordering:false,
                type:"POST",
                "ajax":{
                    "url": "<?php echo route('features.all'); ?>",
                    "type": "POST",
                    data:function (d){
                        d._token = "<?php echo e(csrf_token()); ?>";
                        d.project_id = "<?php echo e($project->projectId); ?>";
                    },
                },
                columns: [
                    { data: 'backlog_title', name: 'backlog.backlog_title' },
                    { data: 'backlog_time', name: 'backlog.backlog_time' },
                    { data: 'backlog_state', name: 'backlog.backlog_state' },
                    { data: 'backlog_start_date', name: 'backlog.backlog_start_date' },
                    { data: 'backlog_end_date', name: 'backlog.backlog_end_date' },
                    { data: 'backlog_priority', name: 'backlog.backlog_priority' },
                    { data: 'remark', name: 'backlog.remark' },
                    { "data": function(data)
                        {
//                            if(data.comments == null)
//                            {
//                                return "";
//                            }
//                            else
//                            {
//                                return '<a style="text-decoration: underline;" class="changeMouse" onclick="showComments('+data.backlog_id+')">'+(data.comments).substring(0,20)+'</a>';
//                            }
                            return "";
                        },
                        "orderable": false, "searchable":false, "name":"selected_rows"
                    },
                    { "data": function(data)
                        {
//                            return '<a style="text-decoration: underline;" class="changeMouse" onclick="showOwners('+data.backlog_id+')">Show Owner</a>';
                            return '';
                        },
                        "orderable": false, "searchable":false, "name":"selected_rows"
                    },
                        <?php if(Auth::user()->fk_userTypeId != 2): ?>
                    { "data": function(data)
                        {
                            return '<button class="btn btn-success btn-xs m-1" data-panel-id="' + data.backlog_id + '" onclick="editFeature(this)"><i class="fa fa-pencil-square"></i></button>' +
                                '<button class="btn btn-danger btn-xs m-1" data-panel-id="' + data.backlog_id + '" onclick="deleteFeature(this)"><i class="fa fa-trash-o"></i></button>';
                        },
                        "orderable": false, "searchable":false, "name":"selected_rows"
                    },
                    <?php endif; ?>
                ]
            } );
        } );
        function showComments(x){
            $.ajax({
                type: 'POST',
                url: "<?php echo route('backlog.show.getAllMyComments'); ?>",
                cache: false,
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    'backlog_id': x,
                },
                success: function (data) {
                    $('#allComments').html(data);
                    $('#commentModal').modal('show')
                }
            });
        }
        function showOwners(x){
            $.ajax({
                type: 'POST',
                url: "<?php echo route('backlog.show.owners'); ?>",
                cache: false,
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    'backlog_id': x,
                },
                success: function (data) {
                    $('#allOwners').html(data);
                    $('#ownerModal').modal('show')
                }
            });
        }
        function generateReport(){
            var id = '<?php echo e($project->projectId); ?>';
            $.ajax({
                type : 'post' ,
                url : '<?php echo e(route('backlog.generate.report')); ?>',
                data : {
                    _token: "<?php echo e(csrf_token()); ?>",
                    'project_id': id,
                } ,
                success : function(data){
                    var link = document.createElement("a");
                    link.download = "projects_backlog.xlsx";
                    var uri = '<?php echo e(url("storage/app")); ?>'+"/"+"project_backlog.xlsx";
                    link.href = uri;
                    link.click();
                }
            });
        }
        function editFeature(x) {
            id = $(x).data('panel-id');
            $.ajax({
                type: 'POST',
                url: "<?php echo route('backlog.dashboard.getEditModal'); ?>",
                cache: false,
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    'backlog_id': id,
                },
                success: function (data) {
                    $('#edit_modal_space').html(data);
                    $('#EditModal').modal('show')
                }
            });
        }
        function deleteFeature(x) {
            id = $(x).data('panel-id');
            $.confirm({
                title: 'Delete Confirmation!',
                content: 'Are you sure want to delete ?',
                buttons: {
                    confirm: function () {
                        $.ajax({
                            type: 'POST',
                            url: "<?php echo route('backlog.dashboard.delete'); ?>",
                            cache: false,
                            data: {
                                _token: "<?php echo e(csrf_token()); ?>",
                                'backlog_id': id,
                            },
                            success: function (data) {
                                dataTable.ajax.reload();
                                $.alert('Feature deleted!');
                            }
                        });
                    },
                    cancel: function () {
                    }
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mainLayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>