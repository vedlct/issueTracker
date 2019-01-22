@extends('layouts.mainLayout')

@section('css')
    <style>
        .container2 {
            border: 2px solid #dedede;
            background-color: #f1f1f1;
            border-radius: 5px;
            padding: 10px;
            margin: 10px 0;
        }

        /* Darker chat container */
        .darker {
            border-color: #ccc;
            background-color: #ddd;
        }

        /* Clear floats */
        .container2::after {
            content: "";
            clear: both;
            display: table;
        }

        /* Style images */
        .container2 img {
            float: left;
            max-width: 60px;
            width: 100%;
            margin-right: 20px;
            border-radius: 50%;
        }

        /* Style the right image */
        .container2 img.right {
            float: right;
            margin-left: 20px;
            margin-right:0;
        }

        /* Style time text */
        .time-right {
            float: right;
            color: #aaa;
        }

        /* Style time text */
        .time-left {
            float: left;
            color: #999;
        }
    </style>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
@endsection

@section('content')

    <div class="container-fluid">
        {{-- Ticket Basic Information --}}
        <div class="card">
            <div class="card-header bg-dark text-white">
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

                <div class="card shadow-none p-3 mb-1 bg-light rounded">
                    <div class="card-body">
                        <h3>Ticket Details</h3>
                        {{$ticket->ticketDetails}}
                    </div>
                </div>

                {{-- Download File Link --}}
                @if($ticket->ticketFile != null)
                    <div class="mt-4">
                        <a href="{{ url('/public/files/ticketFile').'/'.$ticket->ticketFile }}" download> Download File</a>
                    </div>
                @endif
                

            </div>
        </div>

        {{-- Ticket Basic Information --}}
        <div class="card mt-4">
            <div class="card-header bg-secondary text-white">
                <h4>Ticket Discussion</h4>
            </div>
            <div class="card-body">
                {{-- Old reply --}}
                <div class="container2">
                    <img src="{{ asset('public/images/avatar/1.png') }}" alt="Avatar">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda delectus, dicta doloremque ea eligendi libero sequi similique. A accusamus architecto asperiores aspernatur dicta, eos error eum eveniet fuga ipsa ipsam iste non odit pariatur quam quidem reprehenderit, sapiente unde. At beatae culpa, dignissimos dolores exercitationem id inventore laudantium necessitatibus nostrum omnis perspiciatis possimus praesentium quae quas quibusdam quisquam sunt totam. Architecto aspernatur commodi, eos esse excepturi inventore non ratione suscipit totam voluptates. Officiis, quis voluptas!</p>
                    <span class="time-right">11:00</span>
                </div>

                <div class="container2 darker">
                    <img src="{{ asset('public/images/avatar/2.png') }}" alt="Avatar" class="right">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi at culpa distinctio exercitationem, explicabo magni minus molestias perspiciatis quae saepe. At inventore labore non. Assumenda at autem culpa cupiditate, earum eius id illo ipsam libero maiores modi nisi, nostrum officiis perspiciatis quaerat quis reprehenderit similique sint soluta vitae. Debitis, provident!</p>
                    <span class="time-left">11:01</span>
                </div>

                {{-- Post a reply --}}
                <form method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="ticketId" value="{{$ticket->ticketId}}">
                    <div class="form-group">
                        <label>Reply Type</label>
                        <select class="form-control" name="type">
                            <option value="public">Public</option>
                            <option value="internal">Internal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea id="summernote" name="replyData" class="form-control" placeholder="Enter Your reply" rows="3"></textarea>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mt-2">
                                    <label>Choose file</label>
                                    <input type="file" class="form-control-file" name="replyFile">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary float-right mt-3">Post Reply</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>

    <script>

        // $(document).ready(function() {
        //     $('#summernote').summernote({
        //         focus: false
        //     });
        // });

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
