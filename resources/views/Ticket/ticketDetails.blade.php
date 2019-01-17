@extends('layouts.mainLayout')

{{--@section('css')--}}
    {{--<style >--}}
        {{--.table-condensed>thead>tr>th, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>tbody>tr>td, .table-condensed>tfoot>tr>td{--}}
            {{--padding: 1px;--}}
        {{--}--}}
    {{--</style>--}}
{{--@endsection--}}

@section('content')

    <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h4 class="float-left">Ticket Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <th scope="col">Ticket Topic</th>
                                        <td>{{$ticket->ticketTopic}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="col">Ticket Creation Time</th>
                                        <td>{{$ticket->created_at}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="col">Assigned Person</th>
                                        <td>{{$ticket->ticketAssignPerson}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <th scope="col">Ticket Priority</th>
                                        <td>{{$ticket->ticketPriority}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="col">Last Updated</th>
                                        <td>{{$ticket->lastUpdated}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="col">Ticket Opener</th>
                                        <td>{{$user->fullName}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <th scope="col">Ticket Status</th>
                                        <td>{{$ticket->ticketStatus}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="col">Project Name</th>
                                        <td>{{$project->projectName}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="col">Worked Hour</th>
                                        <td>{{$ticket->workedHour}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>

        {{--$(document).ready(function() {--}}

            {{--dataTable=  $('#ticketTable').DataTable({--}}
                {{--rowReorder: {--}}
                    {{--selector: 'td:nth-child(0)'--}}
                {{--},--}}
                {{--responsive: true,--}}
                {{--processing: true,--}}
                {{--serverSide: true,--}}
                {{--Filter: true,--}}
                {{--stateSave: true,--}}
                {{--ordering:false,--}}
                {{--type:"POST",--}}
                {{--"ajax":{--}}
                    {{--"url": "{!! route('ticket.getAllTicket') !!}",--}}
                    {{--"type": "POST",--}}
                    {{--data:function (d){--}}
                        {{--d._token="{{csrf_token()}}";--}}
                    {{--},--}}
                {{--},--}}
                {{--columns: [--}}
                    {{--{ data: 'ticketTopic', name: 'ticket.ticketTopic' },--}}
                    {{--{ data: 'ticketStatus', name: 'ticket.ticketStatus' },--}}
                    {{--{ data: 'created_at', name: 'ticket.created_at' },--}}

                    {{--{ "data": function(data){--}}
                            {{--return '<button class="btn btn-success btn" data-panel-id="'+data.ticketId+'" onclick="openTicket(this)"><i class="fa fa-folder-open-o fa-lg"></i>View</button>'--}}
                                {{--// '<button class="btn btn-danger btn" data-panel-id="'+data.ticketId+'" onclick="deleteProject(this)"><i class="fa fa-trash fa-lg"></i></button>'--}}
                                {{--;},--}}
                        {{--"orderable": false, "searchable":false, "name":"selected_rows"--}}
                    {{--},--}}
                {{--]--}}
            {{--} );--}}

        {{--} );--}}


    </script>

@endsection
