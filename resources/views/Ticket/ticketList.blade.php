@extends('layouts.mainLayout')

@section('css')
<style >
    .table-condensed>thead>tr>th, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>tbody>tr>td, .table-condensed>tfoot>tr>td{
        padding: 0px;
    }
    /*.nav-link {*/
        /*display: inline !important;*/
    /*}*/
    .redClass{
        background-color: #f25f32 !important;
        color: white !important;
    }
</style>
@endsection

@section('content')

<div class="container-fluid row">

    @if(Auth::user()->fk_userTypeId == 1 OR Auth::user()->fk_userTypeId == 4)
        {{-- view for admin personal --}}
        {{--<div class="col-md-2">--}}
            {{--<div class="card">--}}
                {{--<div class="card-header">--}}
                    {{--<h4 class="float-left">Filter Ticket</h4>--}}
                {{--</div>--}}
                {{--<div class="card-body">--}}

                    {{--<div class="form-group">--}}
                        {{--<label>Start Date</label>--}}
                        {{--<input type="date" id="startDate" class="form-control" >--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--<label>End Date</label>--}}
                        {{--<input type="date" id="endDate" class="form-control" >--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<label for="company">Ticket Status</label>--}}
                        {{--<select class="form-control" id="ticketStatus2" name="ticketStatus">--}}
                            {{--<option value="">Select Status</option>--}}
                            {{--<option value="Open">Open</option>--}}
                            {{--<option value="Close">Close</option>--}}
                            {{--<option value="Pending">Pending</option>--}}
                        {{--</select>--}}
                    {{--</div>--}}
                    {{--<button onclick="applyFilter()" class="btn btn-primary">Apply Filter</button>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="float-left">Tickets</h4>
                    <a href="{{ route('ticket.create') }}" class="btn btn-success float-right" name="button">Create Ticket</a>
                    {{--<button onclick="generateReport()" class="btn btn-secondary float-right mr-2" name="button">Generate Report</button>--}}

                    <ul class="nav nav-tabs justify-content-center">
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
                            <a class="nav-link c4" onClick = "ticketTypeChange4('Closed');" href="#">Closed @if($close != null) <span class="badge badge-success"> {{ $close }} </span> @endif </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link c5" onClick = "ticketTypeChange5('Pending');" href="#">Pending @if($pending != null) <span class="badge badge-info"> {{ $pending }} </span> @endif </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <table id="ticketTable" class="table-bordered table-condensed text-center table-striped" style="width:100%">
                        <thead>
                        <tr>
                            <th> <input type="checkbox" id="selectall" onClick="selectAll(this)" /> </th>
                            <th>Ticket Topic</th>
                            <th>Last Updated</th>
                            <th>Ticket Opener</th>
                            <th>Ticket Priority</th>
                            <th>Ticket Assigned To</th>
                            <th>Ticket Status</th>
                            {{--<th>Ticket Open Date</th>--}}
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        {{-- view for client personal --}}
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="float-left">Tickets</h4>
                    <a href="{{ route('ticket.create') }}" class="btn btn-success float-right" name="button">Create Ticket</a>
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
                            <a class="nav-link c4" onClick = "ticketTypeChange4('Closed');" href="#">Closed @if($close != null) <span class="badge badge-success"> {{ $close }} </span> @endif </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link c5" onClick = "ticketTypeChange5('Pending');" href="#">Pending @if($pending != null) <span class="badge badge-info"> {{ $pending }} </span> @endif </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <table id="ticketTable" class="table-bordered table-condensed text-center table-striped" style="width:100%">
                        <thead>
                        <tr>
                            <th> <input type="checkbox" id="selectall" onClick="selectAll(this)" /> </th>
                            <th>Ticket Topic</th>
                            <th>Last Updated</th>
                            <th>Ticket Opener</th>
                            <th>Ticket Priority</th>
                            <th>Ticket Assigned To</th>
                            <th>Ticket Status</th>
                            {{--<th>Ticket Open Date</th>--}}
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
                {{--<h5 class="modal-title" id="exampleModalLabel">Edit Ticket</h5>--}}
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

@endsection

@section('js')

<script>

    var letter="";
    var dueTicket="";
    var allTicket="";
    var currentDate = Date.now();

    $(document).ready(function() {

        dataTable=  $('#ticketTable').DataTable({
           rowReorder: {
               selector: 'td:nth-child(0)'
           },
            // "createdRow": function( row, data, dataIndex){
            //
            //     var d1 = Date.parse(data.exp_end_date);
            //
            //     if(d1 <= currentDate)
            //     {
            //         $(row).addClass('redClass');
            //     }
            // },
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
                   "orderable": false, "searchable":false, "name":"selected_rows"
               },

               { "data": function(data){
                       var d1 = Date.parse(data.exp_end_date);



                       if(d1 <= currentDate)
                       {
                           return "Overdue";
                       }
                       else
                       {
                           return data.ticketStatus;
                       }
                   },
                   "orderable": false, "searchable":false, "name":"selected_rows"
               },


               { "data": function(data) {


                       if (data.fk_userTypeId == 1 || data.fk_userTypeId == 4) {
                           return '<button class="btn btn-success btn-xs m-1" data-panel-id="' + data.ticketId + '" onclick="openTicket(this)"><i class="fa fa-envelope-open-o"></i></button>' +
                               '<button class="btn btn-primary btn-xs m-1" data-panel-id="' + data.ticketId + '" onclick="editTicket(this)"><i class="fa fa-pencil-square-o"></i></button>'
                               ;
                       } else {
                           return '<button class="btn btn-success btn-xs m-1" data-panel-id="' + data.ticketId + '" onclick="openTicket(this)"><i class="fa fa-envelope-open-o"></i></button>'
                               // '<button class="btn btn-primary btn-xs m-1" data-panel-id="' + data.ticketId + '" onclick="editTicket(this)"><i class="fa fa-pencil-square-o"></i></button>'
                               ;
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
            url : '{{route('ticket.report.generate')}}',
            data : {
                _token: "{{csrf_token()}}",
                'allCheckedTicket':chkArray,
            } ,
            success : function(data){
                // console.log(data);
                // if(data == 'true'){
                //     alert('Report Generated');
                // }
               // console.log(chkArray);
               //  console.log('download');

                var link = document.createElement("a");
                link.download = "tickets.xlsx";
                {{--var uri = '{{url("storage/app")}}'+"/"+data.fileName+".xls";--}}
                var uri = '{{url("storage/app")}}'+"/"+"tickets.xlsx";
                link.href = uri;
                link.click();
            }
        });

    }


</script>

@endsection
