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
    <div class="row">
        <div class="col-md-2 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="float-left">Filter</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Example select</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>1</option>
                            <option>2</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Example select</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>1</option>
                            <option>2</option>
                        </select>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-10">
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
                            <th>Ticket Open Date</th>
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
                   { data: 'created_at', name: 'ticket.created_at' },

                   { "data": function(data){
                            return '<button class="btn btn-success btn-sm btn" data-panel-id="'+data.ticketId+'" onclick="openTicket(this)"><i class="fa fa-folder-open-o fa-lg"></i></button>'
                                   // '<button class="btn btn-danger btn" data-panel-id="'+data.ticketId+'" onclick="deleteProject(this)"><i class="fa fa-trash fa-lg"></i></button>'
                            ;},
                        "orderable": false, "searchable":false, "name":"selected_rows"
                    },
               ]
            } );

        } );

          // call edit project
         function openTicket(x) {
             btn = $(x).data('panel-id');
             var url = '{{ route("ticket.view", ":id") }}';
             var newUrl=url.replace(':id', btn);
             window.location.href = newUrl;
         }


    </script>

@endsection
