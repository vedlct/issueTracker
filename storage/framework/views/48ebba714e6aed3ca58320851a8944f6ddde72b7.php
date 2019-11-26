<?php $__env->startSection('css'); ?>
    <style>
        .card{
            box-shadow: 1px 0 20px rgba(0, 0, 0, .09);
        }
    </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="card-header">
            Project : <?php echo e($projectName); ?>

        </div>
        <div class="card-body">

            <?php if(count($backlogs) > 0): ?>
                <div id="chart_div"></div>

            <?php else: ?>
                <p>There is no backlog yet.</p>
            <?php endif; ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['gantt']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
                  <?php $__currentLoopData = $backlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $backlog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      console.log("<?php echo e(\Carbon\Carbon::parse($backlog->backlog_start_date)->format('d')); ?>");
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            var data = new google.visualization.DataTable();

            data.addColumn('string', 'Backlog ID');
            data.addColumn('string', 'Backlog Name');
            data.addColumn('string', 'Resource');
            data.addColumn('date', 'Start Date');
            data.addColumn('date', 'End Date');
            data.addColumn('number', 'Duration');
            data.addColumn('number', 'Percent Complete');
            data.addColumn('string', 'Dependencies');

            data.addRows
            (
                [
                    <?php $__currentLoopData = $backlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $backlog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        [
                            '<?php echo e($backlog->backlog_id); ?>', '<?php echo e($backlog->backlog_title); ?>', null,
                                new Date(<?php echo e(\Carbon\Carbon::parse($backlog->backlog_start_date)->format('Y')); ?>,<?php echo e(\Carbon\Carbon::parse($backlog->backlog_start_date)->format('m') -1); ?>,<?php echo e(\Carbon\Carbon::parse($backlog->backlog_start_date)->format('d')); ?>),
                                new Date(<?php echo e(\Carbon\Carbon::parse($backlog->backlog_end_date)->format('Y')); ?>,<?php echo e(\Carbon\Carbon::parse($backlog->backlog_end_date)->format('m') -1); ?>,<?php echo e(\Carbon\Carbon::parse($backlog->backlog_end_date)->format('d')); ?>),
                            null, null, null
                        ],
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                ]
            );

            var options = {
                height: 400,
                gantt: {
                    trackHeight: 30
                }
            };



            var chart = new google.visualization.Gantt(document.getElementById('chart_div'));

            chart.draw(data, options);
        }
    </script>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.mainLayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>