<?php $__env->startSection('css'); ?>
    <style>
        .card{
            box-shadow: 0px 0 3px rgba(0, 0, 0, 0.39);
        }
        .changeMouse {
            cursor: pointer;
        }
    </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

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
            <h5 class="card-header mt-0">Today's Work</h5>
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

    
    <div id="backlog_panel" style="margin-left: 20px">
        <div class="card">
            <h5 class="card-header mt-0">Backlog (Missed Deadline)</h5>
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