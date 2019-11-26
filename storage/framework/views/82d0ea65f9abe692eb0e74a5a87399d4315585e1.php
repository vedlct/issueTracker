<!-- content -->
<footer class="footer">© 2018 <b>TechCloud Ltd</b> </footer>
</div>
<!-- End Right content here -->
</div>
<!-- END wrapper -->
<!-- jQuery  -->
<script src="<?php echo e(url('public/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(url('public/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(url('public/js/modernizr.min.js')); ?>"></script>
<script src="<?php echo e(url('public/js/detect.js')); ?>"></script>
<script src="<?php echo e(url('public/js/fastclick.js')); ?>"></script>
<script src="<?php echo e(url('public/js/jquery.slimscroll.js')); ?>"></script>
<script src="<?php echo e(url('public/js/jquery.blockUI.js')); ?>"></script>

<script src="<?php echo e(url('public/js/jquery.nicescroll.js')); ?>"></script>
<script src="<?php echo e(url('public/js/jquery.scrollTo.min.js')); ?>"></script>
<!-- skycons -->
<script src="<?php echo e(url('public/plugins/skycons/skycons.min.js')); ?>"></script>
<!-- skycons -->
<script src="<?php echo e(url('public/plugins/peity/jquery.peity.min.js')); ?>"></script>
<!--Morris Chart-->

<script src="<?php echo e(url('public/plugins/raphael/raphael-min.js')); ?>"></script>
<!-- dashboard -->

<!-- App js -->

<script src="<?php echo e(url('public/js/template.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
<!-- Datatable JS -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>

    // $( document ).ready(function() {
    //     getMyNotification();
    // });
    //
    // function getMyNotification(){
        $.ajax({
            type: 'POST',
            url: "<?php echo route('getMyallNotification'); ?>",
            cache: false,
            data: {
                _token: "<?php echo e(csrf_token()); ?>",
            },
            success: function (data) {
                $('#mynotification').html(data);
            }
        });
    // }

    function changeToseen() {
        console.log('p');
        $.ajax({
            type: 'POST',
            url: "<?php echo route('notification.changeUnseen'); ?>",
            cache: false,
            data: {
                _token: "<?php echo e(csrf_token()); ?>",
            },
            success: function (data) {
                $('#mynotification').html(data);
                $('#noti_val').html('0');
            }
        });
    }
    function changeCompany(x) {
        var id=$(x).val();

        $.ajax({
            type: 'POST',
            url: "<?php echo route('company.change'); ?>",
            cache: false,
            data: {
                _token: "<?php echo e(csrf_token()); ?>",
                id:id
            },
            success: function (data) {
                location.reload();
            }
        });

    }

</script>

<?php if(Session::has('message')): ?>
    
    <script type="text/javascript">
        $.alert({
             animationBounce: 2,
             title: 'Success!',
             type: 'green',
             content: '<?php echo e(Session::get('message')); ?>',
         });
    </script>
<?php endif; ?>

<?php if(Session::has('error_msg')): ?>
    
    <script type="text/javascript">
        $.alert({
            animationBounce: 2,
            title: 'Errors!',
            type: 'red',
            content: '<?php echo e(Session::get('error_msg')); ?>',
        });


    </script>
<?php endif; ?>


<?php echo $__env->yieldContent('js'); ?>
</body>

</html>
