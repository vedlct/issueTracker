<?php $__env->startSection('css'); ?>
    <style >
        .table-condensed>thead>tr>th, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>tbody>tr>td, .table-condensed>tfoot>tr>td{
            padding: 3px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <style>
        @media  only screen and (min-width: 360px) and (max-width: 420px){
            .top{
                margin-top: 20%;
            }
        }
        @media  only screen and (max-width: 359px){
            .to1{
                margin-top: 50%;
            }
        }
        @media  only screen and (min-width: 768px) and (max-width: 1295px){
            .width{
                width: 50%;
            }
        }


    </style>

    <div class="container-fluid row">

        <?php if(Auth::user()->fk_userTypeId == 1 OR Auth::user()->fk_userTypeId == 4): ?>
            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="float-left">Filter Ticket</h4>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="date" id="startDate" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label>End Date</label>
                            <input type="date" id="endDate" class="form-control" >
                        </div>

                        <div class="form-group">
                            <label for="company">Ticket Status</label>
                            <select class="form-control" id="ticketStatus2" name="ticketStatus">
                                <option value="">Select Status</option>
                                <option value="Open">Open</option>
                                <option value="Close">Close</option>
                                <option value="Pending">Pending</option>
                            </select>
                        </div>
                        <button onclick="applyFilter()" class="btn btn-primary">Apply Filter</button>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="float-left">Tickets</h4>
                        <button onclick="generateReport()" class="btn btn-secondary float-right mr-2" name="button">Generate Report</button>

                        <ul class="nav nav-tabs top to1" style="border-bottom: 0px;">
                            <li class="nav-item">
                                <a class="nav-link c2" onClick = "ticketTypeChange2('All Ticket');" href="#">All Ticket <?php if($allticket != null): ?> <span class="badge badge-secondary"> <?php echo e($allticket); ?> </span> <?php endif; ?></a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link c1" onClick = "ticketTypeChange1('Open');" href="#">Open <?php if($openticket != null): ?> <span class="badge badge-primary"> <?php echo e($openticket); ?> </span> <?php endif; ?>  </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link c3" onClick = "ticketTypeChange3('Overdue');" href="#">Overdue <?php if($overdue != null): ?> <span class="badge badge-danger"> <?php echo e($overdue); ?> </span> <?php endif; ?> </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link c4" onClick = "ticketTypeChange4('Close');" href="#">Closed <?php if($close != null): ?> <span class="badge badge-success"> <?php echo e($close); ?> </span> <?php endif; ?> </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link c5" onClick = "ticketTypeChange5('Pending');" href="#">Pending <?php if($pending != null): ?> <span class="badge badge-info"> <?php echo e($pending); ?> </span> <?php endif; ?> </a>
                            </li>
                        </ul>

                    </div>
                    <div class="card-body">
                        <div class="table table-responsive">
                        <table id="ticketTable" class="table-bordered table-condensed text-center table-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th> <input type="checkbox" id="selectall" onClick="selectAll(this)" /> </th>
                                <th>Ticket Topic</th>
                                <th>Last Updated</th>
                                <th>Ticket Opener</th>
                                <th>Ticket Priority</th>
                                <th>Ticket Assigned To</th>
                                <th>Ticket Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="float-left">Tickets</h4>
                        
                        <button onclick="generateReport()" class="btn btn-secondary float-right mr-2" name="button">Generate Report</button>

                        <ul class="nav nav-tabs justify-content-center">
                            <li class="nav-item">
                                <a class="nav-link c2" onClick = "ticketTypeChange2('All Ticket');" href="#">All Ticket <?php if($allticket != null): ?> <span class="badge badge-primary"> <?php echo e($allticket); ?> </span> <?php endif; ?> </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link c1" onClick = "ticketTypeChange1('Open');" href="#">Open <?php if($openticket != null): ?> <span class="badge badge-primary"> <?php echo e($openticket); ?> </span> <?php endif; ?> </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link c3" onClick = "ticketTypeChange3('Overdue');" href="#">Overdue <?php if($overdue != null): ?> <span class="badge badge-danger"> <?php echo e($overdue); ?> </span> <?php endif; ?> </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link c4" onClick = "ticketTypeChange4('Close');" href="#">Closed <?php if($close != null): ?> <span class="badge badge-success"> <?php echo e($close); ?> </span> <?php endif; ?> </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link c5" onClick = "ticketTypeChange5('Pending');" href="#">Pending <?php if($pending != null): ?> <span class="badge badge-info"> <?php echo e($pending); ?> </span> <?php endif; ?> </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="table table-responsive">
                        <table id="ticketTable" class="table-bordered table-condensed text-center table-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th> <input type="checkbox" id="selectall" onClick="selectAll(this)" /> </th>
                                <th>Ticket Topic</th>
                                <th>Last Updated</th>
                                <th>Ticket Opener</th>
                                <th>Ticket Priority</th>
                                <th>Ticket Assigned To</th>
                                <th>Ticket Status</th>
                                
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>

    <!-- Edit Ticket Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Ticket</h5>
                    <button type="hidden" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="editTicket">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

    <script>

        var letter="";
        var dueTicket="";
        var allTicket="";
        var currentDate = Date.now();
        var currentUserType = "<?php echo e(Auth::user()->fk_userTypeId); ?>";


        $(document).ready(function() {

            dataTable=  $('#ticketTable').DataTable({
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
                    "url": "<?php echo route('ticket.getAllTicket'); ?>",
                    "type": "POST",
                    data:function (d){
                        d._token="<?php echo e(csrf_token()); ?>";
                        d.startDate =$('#startDate').val();
                        d.endDate =$('#endDate').val();
                        d.ticketStatus= $('#ticketStatus2').val();
                        d.ticketType=letter;
                        d.overDue=dueTicket;
                        d.allTicket=allTicket;
                    },
                },
                columns: [
                    { "data": function(data){
                            return '<input type="checkbox" class="checkboxvar" name="checkboxvar[]" value="'+data.ticketId+'">'
                                ;},
                        "orderable": false, "searchable":false, "name":"selected_rows"
                    },
                    { data: 'ticketTopic', name: 'ticketTopic' },
                    { data: 'lastUpdated', name: 'lastUpdated' },
                    { data: 'createdFullName', name: 'createdFullName' },
                    { data: 'ticketPriority', name: 'ticketPriority' },
                    { "data": function(data){
                            if(data.assignTeamMembers != null)
                            {
                                return data.assignTeamMembers;
                            }
                            else
                            {
                                return data.assignFullName;
                            }
                        },
                        "orderable": false, "searchable":true, "name":"selected_rows"
                    },

                    { "data": function(data){
                            var d1 = Date.parse(data.exp_end_date);

                            if(d1 <= currentDate && data.ticketStatus != 'Close' && data.ticketStatus != 'Pending')
                            {
                                return "Overdue";
                            }
                            else
                            {
                                return data.ticketStatus;
                            }
                        },
                        "orderable": false, "searchable":true, "name": "ticketStatus"
                    },

                ]
            } );
        } );


    </script>

    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker();
        });

        // Select All Checkbox
        function selectAll(source) {
            checkboxes = document.getElementsByName('checkboxvar[]');
            for(var i in checkboxes)
                checkboxes[i].checked = source.checked;
        }

        function changeType(x){
            if($(x).val() == 'single'){
                $('#assignTypeTeam').hide();
                $('#assignTypeSingle').show();
            }
            if($(x).val() == 'team'){
                $('#assignTypeSingle').hide();
                $('#assignTypeTeam').show();
            }
        }

        function setRequiredOnClose(x){
            if($(x).val() == 'Close'){
                $("#modalWorkedHour").prop('required',true);
            }
            else{
                $("#modalWorkedHour").prop('required',false);
            }
        }

        function applyFilter(){
            dataTable.ajax.reload();
        }

        // filter tab
        function ticketTypeChange1(val){
            letter=val;
            dueTicket="";
            allTicket="";

            // set active class
            $(".c1").addClass("active");

            // remove active class
            // $(".c2").removeClass("active");
            $(".c3").removeClass("active");
            $(".c4").removeClass("active");
            $(".c5").removeClass("active");
            $(".c2").removeClass("active");

            dataTable.ajax.reload();
        }

        function ticketTypeChange2(val){
            letter=val;
            dueTicket="";
            allTicket="all";

            // change active class
            $(".c2").addClass("active");
            $(".c1").removeClass("active");
            $(".c3").removeClass("active");
            $(".c4").removeClass("active");
            $(".c5").removeClass("active");

            dataTable.ajax.reload();
        }

        function ticketTypeChange3(val){
            letter=val;
            dueTicket="overdue";
            allTicket="";

            // change active class
            $(".c3").addClass("active");
            $(".c1").removeClass("active");
            $(".c2").removeClass("active");
            $(".c4").removeClass("active");
            $(".c5").removeClass("active");

            dataTable.ajax.reload();
        }
        function ticketTypeChange4(val){

            console.log(val);

            letter=val;
            dueTicket="";
            allTicket="";

            // change active class
            $(".c4").addClass("active");
            $(".c1").removeClass("active");
            $(".c2").removeClass("active");
            $(".c3").removeClass("active");
            $(".c5").removeClass("active");

            dataTable.ajax.reload();
        }

        function ticketTypeChange5(val){
            letter=val;
            dueTicket="";
            allTicket="";

            // change active class
            $(".c5").addClass("active");
            $(".c1").removeClass("active");
            $(".c2").removeClass("active");
            $(".c3").removeClass("active");
            $(".c4").removeClass("active");

            dataTable.ajax.reload();
        }
        // filter end


        function generateReport(){

            var chkArray = [];

            $('.checkboxvar:checked').each(function (i) {
                chkArray[i] = $(this).val();
            });

            // console.log(chkArray);

            $.ajax({
                type : 'post' ,
                url : '<?php echo e(route('ticket.report.generate')); ?>',
                data : {
                    _token: "<?php echo e(csrf_token()); ?>",
                    'allCheckedTicket':chkArray,
                } ,
                success : function(data){
                    var link = document.createElement("a");
                    link.download = "tickets.xlsx";
                    var uri = '<?php echo e(url("storage/app")); ?>'+"/"+"tickets.xlsx";
                    link.href = uri;
                    link.click();
                }
            });
        }


    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mainLayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>