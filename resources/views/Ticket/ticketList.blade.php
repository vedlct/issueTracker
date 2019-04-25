@extends('layouts.mainLayout')

@section('css')
<style >
    .table-condensed>thead>tr>th, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>tfoot>tr>td{
        padding: 2px;
    }
</style>
@endsection

@section('content')



<div class="container-fluid row">

    {{-- view for admin --}}
    @if(Auth::user()->fk_userTypeId == 1 OR Auth::user()->fk_userTypeId == 4 OR Auth::user()->fk_userTypeId == 3)

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @if(Auth::user()->fk_userTypeId != 1)
                        <a href="{{ route('ticket.create') }}" class="btn btn-success float-right" name="button">Create Ticket</a>
                    @endif
                    {{--<a href="{{ route('ticket.create') }}" class="btn btn-success float-right" name="button">Create Ticket</a>--}}

                    {{-- Change Ticket Status --}}
                    <form class="float-right mr-2">
                        <select class="form-control" onchange="changeTicketStatus(this)" id="selectDefault">
                            <option value="">Change Ticket Status</option>
                            <option value="Open">Open</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </form>

                    <form class="float-right mr-2">
                        <select class="form-control" onchange="changeTicketAssignment(this)" id="selectDefault2">
                            <option value="">Select Assign Type</option>
                            <option value="team">Team Assign</option>
                            <option value="single">Single Assign</option>
                            <option value="none">Remove Assignment</option>
                        </select>
                    </form>


                    <ul class="nav nav-tabs" style="border-bottom: 0px;">
                        <li class="nav-item">
                            <a class="nav-link c2" onClick = "ticketTypeChange2('All Ticket');" href="#">All Ticket @if($allticket != null) <span class="badge badge-secondary"> {{ $allticket }} </span> @endif</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link c1" onClick = "ticketTypeChange1('Open');" href="#">Open @if($openticket != null) <span class="badge badge-primary"> {{ $openticket }} </span> @endif  </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link c3" onClick = "ticketTypeChange3('Overdue');" href="#">Overdue @if($overdue != null) <span class="badge badge-danger"> {{ $overdue }} </span> @endif </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link c4" onClick = "ticketTypeChange4('Close');" href="#">Closed @if($close != null) <span class="badge badge-success"> {{ $close }} </span> @endif </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link c5" onClick = "ticketTypeChange5('Pending');" href="#">Pending @if($pending != null) <span class="badge badge-info"> {{ $pending }} </span> @endif </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <table id="ticketTable" class="table-bordered table-condensed text-center table-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th> <input type="checkbox" id="selectall" onClick="selectAll(this)" /> </th>

                            <th>Number</th>
                            <th>Subject</th>
                            <th>Project</th>
                            <th>Last Updated</th>
                            <th>From</th>
                            <th>Priority</th>
                            <th>Support Agent</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    {{-- view for client personal --}}
    @else
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="float-left">Tickets</h4>
                    {{--@if(Auth::user()->fk_userTypeId != 1)--}}
                        <a href="{{ route('ticket.create') }}" class="btn btn-success float-right" name="button">Create Ticket</a>
                    {{--@endif--}}

                    {{--<button onclick="generateReport()" class="btn btn-secondary float-right mr-2" name="button">Generate Report</button>--}}

                    <ul class="nav nav-tabs justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link c2" onClick = "ticketTypeChange2('All Ticket');" href="#">All Ticket @if($allticket != null) <span class="badge badge-secondary"> {{ $allticket }} </span> @endif </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link c1" onClick = "ticketTypeChange1('Open');" href="#">Open @if($openticket != null) <span class="badge badge-primary"> {{ $openticket }} </span> @endif </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link c3" onClick = "ticketTypeChange3('Overdue');" href="#">Overdue @if($overdue != null) <span class="badge badge-danger"> {{ $overdue }} </span> @endif </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link c4" onClick = "ticketTypeChange4('Close');" href="#">Closed @if($close != null) <span class="badge badge-success"> {{ $close }} </span> @endif </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link c5" onClick = "ticketTypeChange5('Pending');" href="#">Pending @if($pending != null) <span class="badge badge-info"> {{ $pending }} </span> @endif </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <table id="ticketTable" class="table-bordered table-condensed text-center table-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th> <input type="checkbox" id="selectall" onClick="selectAll(this)" /> </th>

                            <th>Number</th>
                            <th>Subject</th>
                            <th>Project</th>
                            <th>Last Updated</th>
                            <th>From</th>
                            <th>Priority</th>
                            <th>Support Agent</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif



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

<!-- Assign Team to ticket-->
{{--<div class="modal fade" id="teamModal" role="dialog" aria-hidden="true">--}}
    {{--<div class="modal-dialog modal-lg" role="document">--}}
        {{--<div class="modal-content ">--}}
            {{--<div class="modal-header">--}}
                {{--<h5 class="modal-title" id="exampleModalLabel">Team Assignment</h5>--}}
                {{--<button type="hidden" class="close" data-dismiss="modal" aria-label="Close">--}}
                    {{--<span aria-hidden="true">&times;</span>--}}
                {{--</button>--}}
            {{--</div>--}}
            {{--<div class="modal-body">--}}

                {{--<div class="form-group" id="assignTypeTeam">--}}
                    {{--<label for="company">Select Team</label>--}}
                    {{--<select class="form-control" id="team" name="teamId" required>--}}
                        {{--<option value="">Select Team</option>--}}
                        {{--@foreach($teams as $team)--}}
                            {{--<option value="{{ $team->teamId }}">{{ $team->teamName }}</option>--}}
                        {{--@endforeach--}}
                    {{--</select>--}}
                {{--</div>--}}

                {{--<button onclick="assignTeam()" class="btn btn-primary">Assign Team</button>--}}

            {{--</div>--}}
            {{--<div class="modal-footer">--}}
                {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
    {{--</div>--}}
{{--</div>--}}

<!-- Assign Team to ticket-->
<div class="modal fade" id="teamModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Team Assignment</h5>
                <button type="hidden" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group" id="assignTypeTeam">
                    <label for="company">Select Team</label>
                    <select class="form-control" id="team" name="teamId" required>
                        <option value="">Select Team</option>
                        @foreach($teams as $team)
                            <option value="{{ $team->teamId }}">{{ $team->teamName }}</option>
                        @endforeach
                    </select>
                </div>

                <button onclick="assignTeam()" class="btn btn-primary">Assign Team</button>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




<!-- Assign Individual to ticket-->
<div class="modal fade" id="individualModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Individual Assignment</h5>
                <button type="hidden" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group" id="assignTypeTeam">
                    <label for="company">Select Employee</label>
                    <select class="form-control" id="empId1" name="empId" required>
                        <option value="">Select Employee</option>
                        @foreach($allEmp as $emp)
                            <option value="{{ $emp->userId }}">{{ $emp->fullName }}</option>
                        @endforeach
                    </select>
                </div>

                <button onclick="assignIndividual()" class="btn btn-primary">Assign Employee</button>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

<script>

    var letter="";
    var dueTicket="";
    var allTicket="";
    var currentDate = Date.now();
    var currentUserType = "{{ Auth::user()->fk_userTypeId }}";


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
               "url": "{!! route('ticket.getAllTicket') !!}",
               "type": "POST",
               data:function (d){
                   d._token="{{csrf_token()}}";
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
               { data: 'ticket_number', name: 'ticket_number' },
               { data: 'ticketTopic', name: 'ticketTopic' },
               { data: 'project_name', name: 'project_name' },
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


               { "data": function(data) {

                       if (currentUserType == 1 || currentUserType == 4 || currentUserType == 3) {
                           return '<button class="btn btn-success btn-xs m-1" data-panel-id="' + data.ticketId + '" onclick="openTicket(this)"><i class="fa fa-envelope-open-o"></i></button>' +
                                  '<button class="btn btn-primary btn-xs m-1" data-panel-id="' + data.ticketId + '" onclick="editTicket(this)"><i class="fa fa-cog"></i></button>';
                       }
                       else
                       {
                           return '<button class="btn btn-success btn-xs m-1" data-panel-id="' + data.ticketId + '" onclick="openTicket(this)"><i class="fa fa-envelope-open-o"></i></button>';
                       }
                   },

                    "orderable": false, "searchable":false, "name":"selected_rows"
               },
           ]
        } );
    } );

    // view ticket details
    function editTicket(x) {
        btn = $(x).data('panel-id');
        var url = '{{ route("ticket.edit", ":id") }}';
        var newUrl=url.replace(':id', btn);
        window.location.href = newUrl;
    }


    // Select All Checkbox
    function selectAll(source) {
        checkboxes = document.getElementsByName('checkboxvar[]');
        for(var i in checkboxes)
            checkboxes[i].checked = source.checked;
    }

    // view ticket details
    function openTicket(x) {
        btn = $(x).data('panel-id');
        var url = '{{ route("ticket.view", ":id") }}';
        var newUrl=url.replace(':id', btn);
        window.location.href = newUrl;
    }

    // view ticket details
    function editTicket(x) {
        id = $(x).data('panel-id');

        $.ajax({
            type: 'POST',
            url: "{!! route('ticket.edit') !!}",
            cache: false,
            data: {
                _token: "{{csrf_token()}}",
                'id': id
            },
            success: function (data) {
                // console.log(data);
                $('#editTicket').html(data);
                $('#exampleModal').modal('show');

            }
        });
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
        console.log(val);
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


    // generate report
    function generateReport(){

        var chkArray = [];

        $('.checkboxvar:checked').each(function (i) {
            chkArray[i] = $(this).val();
        });

        $.ajax({
            type : 'post' ,
            url : '{{route('ticket.report.generate')}}',
            data : {
                _token: "{{csrf_token()}}",
                'allCheckedTicket':chkArray,
            } ,
            success : function(data){
                var link = document.createElement("a");
                link.download = "tickets.xlsx";
                var uri = '{{url("storage/app")}}'+"/"+"tickets.xlsx";
                link.href = uri;
                link.click();
            }
        });

    }

    // mass change ticket status
    function changeTicketStatus(val) {
        var chkArray = [];
        var ticketStatus = val.value;


        $('.checkboxvar:checked').each(function (i) {
            chkArray[i] = $(this).val();
        });

        if(chkArray.length == 0)
        {
            $.alert({
                animationBounce: 2,
                type: 'red',
                title: 'Error!',
                content: 'Please select at least one ticket.',
            });
            $('#selectDefault').val('');
            return false
        }


        // Send Request
        $.ajax({
            type : 'post' ,
            url : '{{route('ticket.massChangeTicketStatus')}}',
            data : {
                _token: "{{csrf_token()}}",
                'allCheckedTicket':chkArray,
                'ticketStatus':ticketStatus,
            } ,
            success : function(data){
                $.alert({
                    animationBounce: 2,
                    title: 'Success!',
                    type: 'green',
                    content: 'All Selected Ticket Status Type Changed',
                    buttons: {
                        ok: function () {
                            location.reload();
                        },
                    }
                });

                $('#selectDefault').val('');
            }
        });
    }


    // mass change ticket status
    function changeTicketAssignment(val) {

        var chkArray = [];
        var assignType = val.value;

        $('.checkboxvar:checked').each(function (i) {
            chkArray[i] = $(this).val();
        });

        if(chkArray.length == 0)
        {
            $.alert({
                animationBounce: 2,
                type: 'red',
                title: 'Error!',
                content: 'Please select at least one ticket.',
            });
            $('#selectDefault2').val('');
            return false
        }

        if(assignType == "team")
        {
            $('#teamModal').modal();
        }
        else if(assignType == "none")
        {
            var chkArray = [];
            $('.checkboxvar:checked').each(function (i) {
                chkArray[i] = $(this).val();
            });
            // send request
            $.ajax({
                type : 'post' ,
                url : '{{route('ticket.massAssignTicket.none')}}',
                data : {
                    _token: "{{csrf_token()}}",
                    'allCheckedTicket':chkArray,
                } ,
                success : function(data){
                    $.alert({
                        animationBounce: 2,
                        type: 'green',
                        title: 'Success!',
                        content: 'Assignment Removed.',
                    });
                    $('#selectDefault2').val('');
                    dataTable.ajax.reload();
                }
            });
        }
        else
        {
            $('#individualModal').modal();
        }
    }

    // assign team
    function assignTeam(){

        // get all checked ticket id
        var chkArray = [];
        $('.checkboxvar:checked').each(function (i) {
            chkArray[i] = $(this).val();
        });

        // get team id
        var teamid = team.value;

        // console.log(chkArray);

        // Send Request
        $.ajax({
            type : 'post' ,
            url : '{{route('ticket.massAssignTicket.team')}}',
            data : {
                _token: "{{csrf_token()}}",
                'allCheckedTicket':chkArray,
                'teamid':teamid,
            } ,
            success : function(data){
                // console.log(data);
                $.alert({
                    animationBounce: 2,
                    type: 'green',
                    title: 'Success!',
                    content: 'Selected Team Assigned.',
                });
                $('#selectDefault2').val('');
                dataTable.ajax.reload();
            }
        });
    }

    // assign individual
    function assignIndividual(){

        // get all checked ticket id
        var chkArray = [];
        $('.checkboxvar:checked').each(function (i) {
            chkArray[i] = $(this).val();
        });

        if(chkArray.length == 0)
        {
            $.alert({
                animationBounce: 2,
                type: 'red',
                title: 'Error!',
                content: 'Please select at least one ticket.',
            });
            return false
        }

        // get team id
        var empId = empId1.value;

        // Send Request
        $.ajax({
            type : 'post' ,
            url : '{{route('ticket.massAssignTicket.individual')}}',
            data : {
                _token: "{{csrf_token()}}",
                'allCheckedTicket':chkArray,
                'empId':empId,
            } ,
            success : function(data){
                $.alert({
                    animationBounce: 2,
                    title: 'Success!',
                    type: 'green',
                    content: 'Selected Team Assigned.',
                });
                $('#selectDefault2').val('');
                dataTable.ajax.reload();
            }
        });
    }

    // call from dashboard
    $(document).ready(function() {

        @if (Session::has('call_ticket_type'))

        @if( Session::get('call_ticket_type') == 'allticket')
        ticketTypeChange2('All Ticket')
        @endif


        @if( Session::get('call_ticket_type') == 'open')
        ticketTypeChange1('Open')
        @endif


        @if( Session::get('call_ticket_type') == 'close')
        ticketTypeChange4('Close')
        @endif


        @if( Session::get('call_ticket_type') == 'overdue')
        ticketTypeChange3('Overdue')
        @endif


        @if( Session::get('call_ticket_type') == 'pending')
        ticketTypeChange5('Pending')
        @endif

        @endif

    });


</script>

@endsection
