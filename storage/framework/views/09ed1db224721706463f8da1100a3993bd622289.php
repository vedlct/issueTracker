<?php $__env->startSection('css'); ?>
    <style>
        .card{
            box-shadow: 1px 0 20px rgba(0, 0, 0, .09);
        }
        .changeMouse {
            cursor: pointer;
        }
    </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="card-header bg-dark text-center" style="color: white">
            <?php echo e($project->project_name); ?>

        </div>
        <div class="card-body p-1 mt-2 mb-3">
            <div id="backlog_panel"></div>
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

        function getallBacklog(){
            $.ajax({
                type: 'POST',
                url: "<?php echo route('backlog.dashboard.getAllBacklog'); ?>",
                cache: false,
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    'project_id': "<?php echo e($project_id); ?>",
                },
                success: function (data) {
                    $('#backlog_panel').html(data);
                }
            });
        }

        $(document).ready(function() {
            getallBacklog();
        });

    </script>

    <?php echo $__env->yieldContent('extra_js'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.mainLayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>