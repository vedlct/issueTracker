<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>


    <div class="card">
        <h5 class="card-header mt-0">
            <?php echo e($project->project_name); ?>

            <a class="btn btn-primary btn-sm pull-right ml-2" href="<?php echo e(route('project.features', $project->projectId)); ?>">Dashboard</a>
            <a class="btn btn-primary btn-sm pull-right ml-2" href="<?php echo e(route('project.projectmanagement', $project_id)); ?>">ADD FEATURE (ADVANCE)</a>
            <a class="btn btn-sm btn-secondary pull-right" style="color: white" onclick="generateReport()">Generate Project Excel</a>
        </h5>

        <div class="card-body">

            <table class="table table-bordered table-sm table-condensed">
                <thead>
                    <tr>
                        <th style="text-align: center" scope="col">#</th>
                        <th scope="col">Feature Name *</th>
                        <th scope="col">Total Hour</th>
                        <th scope="col">Feature State</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Priority</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td> <button class="btn btn-sm btn-primary pull-right" onclick="addBacklog()">ADD</button> </td>
                        <td> <input type="text" class="form-control" placeholder="Feature Name" id="backlog" required> </td>
                        <td> <input type="number" class="form-control" placeholder="Expected Time" id="time"> </td>
                        <td>
                            <select class="form-control pull-right" id="backlog_state" required>
                                <option value="Planned" selected>Planned</option>
                                <option value="Ongoing">Ongoing</option>
                                <option value="Code Done">Code Done</option>
                                <option value="Testing">Testing</option>
                                <option value="Complete">Complete</option>
                            </select>
                        </td>
                        <td> <input type="text" autocomplete="off" class="form-control datepicker" placeholder="Start Date" id="startdate"> </td>
                        <td> <input type="text" autocomplete="off" class="form-control datepicker" placeholder="End Date" id="enddate"> </td>
                        <td>
                            <select class="form-control" id="priority" required>
                                <option value="">Select Priority</option>
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                            </select>
                        </td>
                    </tr>
                </tbody>

                <tbody id="table_space">

                </tbody>

            </table>
            
        </div>
    </div>




<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>

        $(document).ready(function() {
            getallData();
        });

        $(".datepicker").datepicker({
            orientation: "bottom"
        });

        function addBacklog()
        {
            var backlog_title = $('#backlog').val();
            var project_id = "<?php echo e($project_id); ?>";
            var backlog_time = $('#time').val();
            var backlog_state = $('#backlog_state').val();
            var startdate = $('#startdate').val();
            var enddate = $('#enddate').val();
            var priority = $('#priority').val();

            console.log( $('#startdate').val() );

            $.ajax({
                type: 'POST',
                url: "<?php echo route('backlog.insert'); ?>",
                cache: false,
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    'backlog_title': backlog_title,
                    'project_id': project_id,
                    'backlog_time': backlog_time,
                    'backlog_state': backlog_state,
                    'startdate': startdate,
                    'enddate': enddate,
                    'priority': priority,
                },
                success: function (data) {
                    getallData();

                    var backlog_title = $('#backlog').val("");
                    var backlog_time = $('#time').val("");
                    var backlog_state = $('#backlog_state').val("Planned");
                    var startdate = $('#startdate').val("");
                    var enddate = $('#enddate').val("");
                    var priority = $('#priority').val("");
                }
            });

        }

        function getallData(){
            $.ajax({
                type: 'POST',
                url: "<?php echo route('backlog.dashboard.getallData'); ?>",
                cache: false,
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    'edit': false,
                    'project_id': "<?php echo e($project_id); ?>",
                },
                success: function (data) {
                    $('#table_space').html(data);
                }
            });
        }

        function generateReport(){
            var id = '<?php echo e($project_id); ?>';
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

    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.mainLayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>