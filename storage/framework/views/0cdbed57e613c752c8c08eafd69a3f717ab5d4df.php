<?php $__env->startSection('css'); ?>
    <style>
        .newCard{
            /*box-shadow: 1px 0 10px rgba(0, 0, 0, 0.20) !important;*/
        }
        .card-body{
            padding-bottom: 0px;
            margin-bottom: 15px;
        }

        .card{
            box-shadow: 0px 0 3px rgba(0, 0, 0, 0.39);
        }
        .changeMouse {
            cursor: pointer;
        }
        .card-title {
            margin-bottom: -1.25rem !important;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <style>
        @media  only screen and (min-width: 338px) and (max-width: 379px){
            .top{
                margin-top: 20%;
            }

        }
        @media  only screen and (max-width: 337px){
            .top1{
                margin-top: 60%;
            }

        }
    </style>

    
    <?php if(Auth::user()->fk_userTypeId == 3): ?>

        <!-- Item Details Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="backlog_details"></div>
                </div>
            </div>
        </div>

        <div id="backlog_panel" style="margin-left: 20px">
            <div class="card mb-3">
                <h5 class="card-header mt-0">Today's List</h5>
                <div class="card-body">
                    <?php $__currentLoopData = $mybacklogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mybacklog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="card mb-2 ml-2 changeMouse" onclick="openItem(this)" data-backlog-id= <?php echo e($mybacklog->backlog_id); ?>>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <b>Backlog : </b> <?php echo e($mybacklog->backlog_title); ?>

                                    </div>
                                    <div class="col-md-3">
                                        <b>Project : </b> <?php echo e($mybacklog->project_name); ?>

                                    </div>
                                    <div class="col-md-2">
                                        <b>Backlog State : </b> <?php echo e($mybacklog->backlog_state); ?>

                                    </div>
                                    <div class="col-md-2">
                                        <b>Backlog Start Date : </b> <?php echo e($mybacklog->backlog_start_date); ?>

                                    </div>
                                    <div class="col-md-2">
                                        <b>Backlog End Date : </b> <?php echo e($mybacklog->backlog_end_date); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        
        <div id="backlog_panel" style="margin-left: 20px; margin-bottom: 40px;">
            <div class="card">
                <h5 class="card-header mt-0">Past Due</h5>
                <div class="card-body">
                    <?php $__currentLoopData = $mybacklogsMissed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mybacklog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="card mb-2 ml-2 changeMouse" onclick="openItem(this)" data-backlog-id= <?php echo e($mybacklog->backlog_id); ?>>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <b>Backlog : </b> <?php echo e($mybacklog->backlog_title); ?>

                                    </div>
                                    <div class="col-md-3">
                                        <b>Project : </b> <?php echo e($mybacklog->project_name); ?>

                                    </div>
                                    <div class="col-md-2">
                                        <b>Backlog State : </b> <?php echo e($mybacklog->backlog_state); ?>

                                    </div>
                                    <div class="col-md-2">
                                        <b>Backlog Start Date : </b> <?php echo e($mybacklog->backlog_start_date); ?>

                                    </div>
                                    <div class="col-md-2">
                                        <b>Backlog End Date : </b> <?php echo e($mybacklog->backlog_end_date); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    

    <div class="container-fluid">

        <div class="row">
            <div class="col-xl-3 top top1">
                <div class="card m-b-30">
                    <div class="card-body">

                        <h4 class="mt-0 header-title">All Project Status</h4>

                        <canvas id="doughnut" height="260"></canvas>

                        <ul class="list-inline widget-chart m-t-20 m-b-15 text-center">
                            <li>
                                <h4 class=""><b id="total_project"><?php echo e($projectCount); ?></b></h4>
                                <p class="text-muted"><a href="<?php echo e(route('project.showAllProject')); ?>">Total</a></p>
                            </li>
                            <li>
                                <h4 class=""><b  id="total_project_complete"><?php echo e($projectCompleteCount); ?></b></h4>
                                <p class="text-muted">Complete</p>
                            </li>
                            <li>
                                <h4 class=""><b><?php echo e($totalPartnerProject); ?></b></h4>
                                <p class="text-muted"><a href="<?php echo e(route('project.partner.showAllProject')); ?>">Partner</a></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="card m-b-30">
                    <div class="card-body">

                        <h4 class="mt-0 header-title">Issue Monthly Status</h4>

                        <canvas id="pie" height="260"></canvas>

                        <ul class="list-inline widget-chart m-t-20 m-b-15 text-center">
                            <li>
                                <h4 class=""><b id="openticketMonth"><?php echo e($openticketMonth); ?></b></h4>
                                <p class="text-muted"><a href="<?php echo e(route('call_openticket')); ?>">Open</a></p>
                            </li>
                            <li>
                                <h4 class=""><b id="closeMonth"><?php echo e($closeMonth); ?></b></h4>
                                <p class="text-muted"><a href="<?php echo e(route('call_closeticket')); ?>">Closed</a></p>
                            </li>
                            <li>
                                <h4 class=""><b id="overdueMonth"><?php echo e($overdueMonth); ?></b></h4>
                                <p class="text-muted"><a href="<?php echo e(route('call_overdueticket')); ?>">Overdue</a></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> <!-- end col -->

            <div class="col-xl-3">
                <div class="card m-b-30">
                    <div class="card-body" style="overflow-y: scroll; height:435px;">

                        <h4 class="mt-0 header-title">Timesheet Summery</h4>

                        <canvas id="timesheet" height="260" style="display: none"></canvas>

                        <ol class="text-center">
                        <?php $__currentLoopData = $project_percentage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projectName => $percentage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="progress m-3" style="height: 25px; color: #0a1832">
                                <span class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo e($percentage); ?>%" aria-valuenow="<?php echo e($percentage); ?>" aria-valuemin="0" aria-valuemax="100"><b style="color: #0a1832; margin-left: 10px;"><?php echo e($projectName); ?> : <?php echo e($percentage); ?>%</b></span>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ol>
                    </div>
                </div>
            </div> <!-- end col -->
            <div class="col-xl-3">
                <div class="card m-b-30">
                    <div class="card-body">

                        <h4 class="mt-0 header-title">Milestone Status</h4>

                        <canvas id="milestone" height="260"></canvas>

                        <ul class="list-inline widget-chart m-t-20 m-b-15 text-center">
                            <li>
                                <h4 class=""><b id="monthlyBacklogCount"><?php echo e($monthlyBacklogCount); ?></b></h4>
                                <p class="text-muted">Total</p>
                            </li>
                            <li>
                                <h4 class=""><b id="monthlyBacklogCompleteCount"><?php echo e($monthlyBacklogCompleteCount); ?></b></h4>
                                <p class="text-muted">Completed</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> <!-- end row -->

        <div class="row">
            <div class="col-lg-3">
                <div class="card m-b-30">
                    <div class="card-body" style="overflow-y: scroll; height:435px;">

                        <h4 class="mt-0 header-title">Employee Backlog</h4>

                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                <?php if($employes): ?>
                                <?php $__currentLoopData = $employes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e($employe->fullName); ?></th>
                                    <td><?php echo e($employe->backlog_count); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div> <!-- end col -->
            <div class="col-lg-3">
                <div class="card m-b-30">
                    <div class="card-body" style="overflow-y: scroll; height:435px;">

                        <h4 class="mt-0 header-title">Today Employee Task</h4>

                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                <?php if($employeeTicket): ?>
                                <?php $__currentLoopData = $employeeTicket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employeeTic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($employeeTic->fk_company_id == Auth::user()->fkCompanyId): ?>
                                        <tr>
                                            <th scope="row"><?php echo e($employeeTic->fullName); ?></th>

                                        <?php if($employeeTic->backlog_state == 'Ongoing'): ?>
                                            <td><a href="javascript:void(0)" onclick="backLogDetailsShow(this)" backlog_title="<?php echo e($employeeTic->backlog_title); ?>" backlog_start_date="<?php echo e(\Carbon\Carbon::parse($employeeTic->backlog_start_date)->toFormattedDateString()); ?>" backlog_end_date="<?php echo e(\Carbon\Carbon::parse($employeeTic->backlog_end_date)->toFormattedDateString()); ?>" project_name="<?php echo e($employeeTic->project_name); ?>" style="color: red;"><?php echo e($employeeTic->project_name); ?></a></td>
                                        <?php else: ?>
                                            <td><a href="javascript:void(0)" onclick="backLogDetailsShow(this)" backlog_title="<?php echo e($employeeTic->backlog_title); ?>" backlog_start_date="<?php echo e(\Carbon\Carbon::parse($employeeTic->backlog_start_date)->toFormattedDateString()); ?>" backlog_end_date="<?php echo e(\Carbon\Carbon::parse($employeeTic->backlog_end_date)->toFormattedDateString()); ?>" project_name="<?php echo e($employeeTic->project_name); ?>"><?php echo e($employeeTic->project_name); ?></a></td>
                                        <?php endif; ?>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div> <!-- end col -->
            <div class="col-lg-6">
                <div class="card m-b-30">
                    <div class="card-body" style="overflow-y: scroll; height:435px;">

                        <h4 class="mt-0 header-title" style="color: red;font-size: 22px;">Overdue Backlogs</h4>

                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                <?php if(isset($backlogsOverdue)): ?>
                                <?php $__currentLoopData = $backlogsOverdue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $backlogsOverdues): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e($key+1); ?></th>
                                    <td><?php echo e($backlogsOverdues->project_name); ?></td>
                                    <td><?php echo e($backlogsOverdues->backlog_title); ?></td>
                                    <td style="color: red;"><?php echo e(\Carbon\Carbon::parse($backlogsOverdues->backlog_end_date)->diffForHumans()); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div><!-- container fluid -->


























































































































































































































    <div class="modal fade" id="backLogDetailsModal" tabindex="-1" role="dialog" is="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="backLogDetailsModalTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="font-size: 30px"><strong>Tittle - </strong><span id="baclogtittle"></span> </p>
                    <p style="font-size: 30px"><strong>Start Date - </strong><span id="baclogstartdate" style="color: green"></span> </p>
                    <p style="font-size: 30px"><strong>End Date - </strong><span id="baclogenddate" style="color: red"></span> </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>

    <script type="text/javascript" src="<?php echo e(url('/public/ck/ckeditor/ckeditor.js')); ?>"></script>
    <script src="<?php echo e(url('/public/assets/plugins/chart.js/chart.min.js')); ?>"></script>
    <script src="<?php echo e(url('/public/assets/pages/chartjs.init.js')); ?>"></script>

    <script>
        function backLogDetailsShow(r) {
            $('#backLogDetailsModalTitle').text("Project - "+$(r).attr('project_name'));
            $('#baclogtittle').text($(r).attr('backlog_title'));
            $('#baclogstartdate').text($(r).attr('backlog_start_date'));
            $('#baclogenddate').text($(r).attr('backlog_end_date'));
            $('#backLogDetailsModal').modal('toggle');
        }

        function openItem(x){
            id = $(x).data('backlog-id');

            $.ajax({
                type: 'POST',
                url: "<?php echo route('backlog.open.details'); ?>",
                cache: false,
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    'backlog_id': id
                },
                success: function (data) {
                    $('#backlog_details').html(data);
                    $('#exampleModal').modal();
                }
            });
        }
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mainLayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>