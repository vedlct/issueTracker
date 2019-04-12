<!-- content -->
<footer class="footer">© 2018 <b>TechCloud Ltd</b> </footer>
</div>
<!-- End Right content here -->
</div>
<!-- END wrapper -->
<!-- jQuery  -->
<script src="{{url('public/js/jquery.min.js')}}"></script>
<script src="{{url('public/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('public/js/modernizr.min.js')}}"></script>
<script src="{{url('public/js/detect.js')}}"></script>
<script src="{{url('public/js/fastclick.js')}}"></script>
<script src="{{url('public/js/jquery.slimscroll.js')}}"></script>
<script src="{{url('public/js/jquery.blockUI.js')}}"></script>
{{--<script src="{{url('public/js/waves.js')}}"></script>--}}
<script src="{{url('public/js/jquery.nicescroll.js')}}"></script>
<script src="{{url('public/js/jquery.scrollTo.min.js')}}"></script>
<!-- skycons -->
<script src="{{url('public/plugins/skycons/skycons.min.js')}}"></script>
<!-- skycons -->
<script src="{{url('public/plugins/peity/jquery.peity.min.js')}}"></script>
<!--Morris Chart-->
{{--<script src="{{url('public/plugins/morris/morris.min.js')}}"></script>--}}
<script src="{{url('public/plugins/raphael/raphael-min.js')}}"></script>
<!-- dashboard -->
{{--<script src="{{url('public/pages/dashboard.js')}}"></script>--}}
<!-- App js -->
{{--<script src="{{url('public/js/app.js')}}"></script>--}}
<script src="{{url('public/js/template.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
<!-- Datatable JS -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

@if(Session::has('message'))
    {{--<p class="alert alert-info">{{ Session::get('message') }}</p> --}}
    <script type="text/javascript">
        $.alert({
             animationBounce: 2,
             title: 'Success!',
             type: 'green',
             content: '{{ Session::get('message') }}',
         });
    </script>
@endif

@if(Session::has('error_msg'))
    {{--<p class="alert alert-info">{{ Session::get('message') }}</p> --}}
    <script type="text/javascript">
        $.alert({
            animationBounce: 2,
            title: 'Errors!',
            type: 'red',
            content: '{{ Session::get('error_msg') }}',
        });
    </script>
@endif


@yield('js')
</body>

</html>
