@extends('layouts.mainLayout')

@section('css')
<style >
.table-condensed>thead>tr>th, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>tbody>tr>td, .table-condensed>tfoot>tr>td{
    padding: 1px;
}
</style>
@endsection

@section('content')

<div class="container-fluid row">

    <div class="col-md-2">
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

    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <h4 class="float-left">Tickets</h4>
                <a href="{{ route('ticket.create') }}" class="btn btn-secondary float-right" name="button">Create Ticket</a>
                <button onclick="generateReport()" class="btn btn-secondary float-right mr-2" name="button">Generate Report</button>
            </div>
            <div class="card-body">
                <table id="ticketTable" class="table-bordered table-condensed text-center table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th> <input type="checkbox" id="selectall" onClick="selectAll(this)" /> </th>
                        <th>Ticket Topic</th>
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
</div>

<!-- Edit Ticket -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Ticket</h5>
                <button type="hidden" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('ticket.main.update') }}">
                    @csrf
                    <input type="hidden" name="ticketId" id="modalTicketId" value="">

                    <div class="form-group">
                        <label for="teamname">Worked Hour</label>
                        <input type="text" name="workedHour" id="modalWorkedHour" value="" class="form-control" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="ticketStatus">Ticket Status</label>
                        <select class="form-control" id="ticketStatus" name="ticketStatus" required onchange="setRequiredOnClose(this)">
                            <option value="">Select Status</option>
                            <option value="Open">Open</option>
                            <option value="Close">Close</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="company">Assign Type</label>
                        <select class="form-control" id="assignType" name="assignType" onchange="changeType(this)">
                            <option value="">Select Type</option>
                            <option value="single">Assign Single Person</option>
                            <option value="team">Assign Team</option>
                        </select>
                    </div>

                    <div class="form-group" id="assignTypeSingle">
                        <label for="company">Select Employee</label>
                        <select class="form-control" id="assignPerson" name="assignPersonId">
                            <option value="">Select Any Employee</option>
                            @foreach($employeeList as $employee)
                                <option value="{{ $employee->userId }}">{{ $employee->fullName }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" id="assignTypeTeam">
                        <label for="company">Select Team</label>
                        <select class="form-control" id="team" name="teamId">
                            <option value="">Select Team</option>
                            @foreach($teams as $team)
                                <option value="{{ $team->teamId }}">{{ $team->teamName }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
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
                   },
               },
               columns: [
                   { "data": function(data){
                           return '<input type="checkbox" class="checkboxvar" name="checkboxvar[]" value="'+data.ticketId+'">'
                           ;},
                       "orderable": false, "searchable":false, "name":"selected_rows"
                   },

                   { data: 'ticketTopic', name: 'ticket.ticketTopic' },
                   { data: 'ticketStatus', name: 'ticket.ticketStatus' },

                   { "data": function(data){
                            return '<button class="btn btn-success btn-sm m-1" data-panel-id="'+data.ticketId+'" onclick="openTicket(this)"><i class="fa fa-folder-open-o fa-lg"></i></button>' +
                                    '<button class="btn btn-primary btn-sm m-1" data-panel-id="'+data.ticketId+'" onclick="editTicket(this)"><i class="fa fa-pencil-square-o fa-lg"></i></button>'
                            ;},
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
            btn = $(x).data('panel-id');
            var url = '{{ route("ticket.edit", ":id") }}';
            var newUrl=url.replace(':id', btn);
            window.location.href = newUrl;
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
