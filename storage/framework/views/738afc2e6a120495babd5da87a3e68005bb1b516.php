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
                <?php $__currentLoopData = $MY_Companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <h5 style="margin-left:20px;font-weight: 300; text-decoration: underline;"><b><?php echo e($company->companyName); ?></b></h5>
                    <div class="card-body">
                        <?php $__currentLoopData = $mybacklogs->where('fk_company_id',$company->companyId); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mybacklog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        
        <div id="backlog_panel" style="margin-left: 20px; margin-bottom: 40px;">
            <div class="card">
                <h5 class="card-header mt-0">Past Due</h5>
                <?php $__currentLoopData = $MY_Companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <h5 style="margin-left:20px;font-weight: 300; text-decoration: underline;"><b><?php echo e($company->companyName); ?></b></h5>
                    <div class="card-body">
                        <?php $__currentLoopData = $mybacklogsMissed->where('fk_company_id',$company->companyId); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mybacklog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

    <?php endif; ?>

    
    <div class="card mb-4" style="margin-left: 20px;">
        <div class="card-header mt-0">
            <h5 style="margin: 0">Project Summary</h5>
        </div>
        <div class="card-body">

            <div class="row" >
                <?php $__currentLoopData = $MY_Companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    <div class="col-lg-2 col-md-6 mb-2">
                        <div class="card">
                            <div class="card-header p-0">
                                <h5 style="margin-left:20px;font-weight: 300;"><b><?php echo e($company->companyName); ?></b></h5>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><a href="<?php echo e(route('project.showAllProject')); ?>">No. of Project</a></h5>
                                <div class="text-right">
                                    <h4 class="font-light m-b-0"> <?php echo e($projectCount->where('fk_company_id',$company->companyId)->count()); ?> </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="card mt-2">



                <div class="card-body" style="padding: 5px; margin-bottom: 0;">
                    <?php $__currentLoopData = $project_percentage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projectName => $percentage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="progress m-3" style="height: 25px; color: #0a1832">
                            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo e($percentage); ?>%" aria-valuenow="<?php echo e($percentage); ?>" aria-valuemin="0" aria-valuemax="100"><b style="color: #0a1832; margin-left: 10px;"><?php echo e($projectName); ?> : <?php echo e($percentage); ?>%</b></div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

            </div>

        </div>
    </div>

    
    <div class="card mb-4" style="margin-left: 20px;">
        <div class="card-header mt-0">
            <h5 style="margin: 0">Ticket Summary</h5>
        </div>
        <div class="card-body">
            <?php $__currentLoopData = $MY_Companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <h5 style="margin-left:10px;font-weight: 300;"><b><?php echo e($company->companyName); ?></b></h5>
            <div class="row" >

                
                <div class="col-lg-2 col-md-6 mb-2">
                    <div class="card newCard">
                        <div class="card-body">
                            <h5 class="card-title"><a href="<?php echo e(route('call_openticket')); ?>">Open Ticket</a></h5>
                            <div class="text-right">
                                <h4 class="font-light m-b-0"> <?php echo e($openticket->where('ticketOpenerCompanyId',$company->companyId)->count()); ?> </h4>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-lg-2 col-md-6 mb-2">
                    <div class="card newCard">
                        <div class="card-body">
                            <h5 class="card-title"><a href="<?php echo e(route('call_closeticket')); ?>">Closed Ticket</a></h5>
                            <div class="text-right">
                                <h4 class="font-light m-b-0"> <?php echo e($close->where('ticketOpenerCompanyId',$company->companyId)->count()); ?> </h4>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-lg-2 col-md-6 mb-2">
                    <div class="card newCard">
                        <div class="card-body">
                            <h5 class="card-title"><a href="<?php echo e(route('call_overdueticket')); ?>">Overdue Ticket</a></h5>
                            <div class="text-right">
                                <h4 class="font-light m-b-0"> <?php echo e($overdue->where('ticketOpenerCompanyId',$company->companyId)->count()); ?> </h4>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>



    
    <div class="card" style="margin-left: 20px; margin-bottom: 90px;">
        <div class="card-header mt-0">
            <h5 style="margin: 0">Ticket Summary For This Month</h5>
        </div>
        <div class="card-body">
            <?php $__currentLoopData = $MY_Companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <h5 style="margin-left:10px; font-weight: 300;"><b><?php echo e($company->companyName); ?></b></h5>
            <div class="row" >

                <div class="col-lg-2 col-md-6 mb-2">
                    <div class="card newCard">
                        <div class="card-body">
                            <h5 class="card-title"><a href="#">Open Ticket</a></h5>
                            <div class="text-right">
                                <h4 class="font-light m-b-0"> <?php echo e($openticketMonth->where('ticketOpenerCompanyId',$company->companyId)->count()); ?> </h4>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-lg-2 col-md-6 mb-2">
                    <div class="card newCard">
                        <div class="card-body">
                            <h5 class="card-title"><a href="#">Closed Ticket</a></h5>
                            <div class="text-right">
                                <h4 class="font-light m-b-0"> <?php echo e($closeMonth->where('ticketOpenerCompanyId',$company->companyId)->count()); ?> </h4>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-lg-2 col-md-6 mb-2">
                    <div class="card newCard">
                        <div class="card-body">
                            <h5 class="card-title"><a href="#">Overdue Ticket</a></h5>
                            <div class="text-right">
                                <h4 class="font-light m-b-0"> <?php echo e($overdueMonth->where('ticketOpenerCompanyId',$company->companyId)->count()); ?> </h4>
                            </div>
                        </div>
                    </div>
                </div>

                
                
                
                
                
                
                
                
                
                
                
            </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>





<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>

    <script type="text/javascript" src="<?php echo e(url('/public/ck/ckeditor/ckeditor.js')); ?>"></script>

    <script>
        function openItem(x){
            id = $(x).data('backlog-id');
            console.log(id);

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