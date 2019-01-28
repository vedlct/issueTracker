@extends('layouts.mainLayout')

@section('css')
<style >
.table-condensed>thead>tr>th, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>tbody>tr>td, .table-condensed>tfoot>tr>td{
    padding: 1px;
}
</style>
@endsection

@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4 class="float-left">Tickets</h4>
            <a href="{{ route('ticket.create') }}" class="btn btn-success float-right" name="button">Create Ticket</a>
        </div>
        <div class="card-body">
            <table id="ticketTable" class="table-bordered table-condensed text-center table-striped" style="width:100%">
                <thead>
                <tr>
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
                        <label for="company">Ticket Status</label>
                        <select class="form-control" id="ticketStatus" name="ticketStatus" required>
                            <option value="">Select Status</option>
                            <option value="Open">Open</option>
                            <option value="Close">Close</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="company">Select Team</label>
                        <select class="form-control" id="team" name="teamId" required>
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
                   },
               },
               columns: [
                   { data: 'ticketTopic', name: 'ticket.ticketTopic' },
                   { data: 'ticketStatus', name: 'ticket.ticketStatus' },
                   // { data: 'created_at', name: 'ticket.created_at' },

                   { "data": function(data){
                            return '<button class="btn btn-success btn-sm btn mr-2" data-panel-id="'+data.ticketId+'" onclick="openTicket(this)"><i class="fa fa-folder-open-o fa-lg"></i></button>' +
                                   '<button class="btn btn-info btn-sm" data-panel-id="'+data.ticketId+'" data-workedhour="'+data.workedHour+'" data-status="'+data.ticketStatus+'" data-teamid="'+data.ticketAssignTeamId+'"  onclick="openModal(this)"><i class="fa fa-pencil-square-o fa-lg"></i></button>'
                            ;},
                        "orderable": false, "searchable":false, "name":"selected_rows"
                    },
               ]
            } );
        } );

        function openModal(x) {
            var id= $(x).data('panel-id');
            var workedHour= $(x).data('workedhour');
            var status= $(x).data('status');
            var teamid= $(x).data('teamid');

            console.log(teamid);

            // $('#modalTicketId').val(id);
            // $('#modalWorkedHour').val(workedHour);

            $('#modalTicketId').attr('value', id);
            $('#modalWorkedHour').val(workedHour);
            $("#ticketStatus").val(status);
            $("#team").val(teamid);



            $('#exampleModal').modal();
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


    </script>

@endsection
