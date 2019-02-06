@extends('layouts.mainLayout')

@section('css')
    <style>
        .table-condensed>thead>tr>th, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>tbody>tr>td, .table-condensed>tfoot>tr>td{
            padding: 5px;
        }

        .table-custom-1{
            width: 100%;
        }

        .container2 {
            border: 2px solid #dedede;

            border-radius: 5px;
            padding: 10px;
            margin: 5px 0;
        }

        /* Darker chat container */
        .darker {
            border-color: #ccc;

        }

        /* Clear floats */
        .container2::after {
            content: "";
            clear: both;
            display: table;
        }

        /* Style images */
        .circle-img {
            float: none;
            max-width: 60px;
            width: 100%;
            margin-right: 20px;
            border-radius: 50%;
        }

        /* Style the right image */
        .container2 img.right {
            float: none;
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
            float: right;
            color: #999;
        }
        .custom-2{
            padding-top: 3px;
            padding-bottom: 3px;
        }

    </style>
@endsection

@section('content')

    <div class="container-fluid">
        {{-- Ticket Basic Information --}}
        <div class="card">
            <div class="card-header bg-dark text-white custom-2">
                <h4 class="float-left font-weight-normal">Ticket Information</h4>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <table class="table-condensed table-bordered table-custom-1">
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
                                @if($ticket->ticketAssignPersonUserId == null)
                                    <th scope="col">Assigned Team</th>
                                    <td>
                                        <a style="text-decoration: underline; cursor: pointer;" data-toggle="modal" data-target="#exampleModal"> {{$ticket->teamName}} </a>
                                    </td>
                                @else
                                    <th scope="col">Assigned Person</th>
                                    <td>
                                        {{$assignedPerson->fullName}}
                                    </td>
                                @endif

                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <table class="table-condensed table-bordered table-sm table-custom-1">
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
                                <td>{{$ticket->fullName}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <table class="table-condensed table-bordered table-sm table-custom-1">
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

                <div class="card mt-2 shadow-none mb-1 bg-light rounded">
                    <div class="card-body p-1">
                        <div id="ticketInformation" class="mt-2 pl-3">

                            @if (Auth::user()->fk_userTypeId == 1 || Auth::user()->fk_userTypeId == 4 || Auth::user()->userId == $ticket->fk_ticketOpenerId)
                                <button class="float-right btn btn-success mr-1" type="button" onclick="editTicket({{$ticket->ticketId}})">Edit</button>
                            @endif

                            {!!  $ticket->ticketDetails  !!}
                        </div>
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

        {{-- Ticket Reply --}}
        <div class="card mt-4">
            <div class="card-body">
                {{-- Old reply --}}
                @if($ticketReplies)
                    @foreach($ticketReplies as $reply)
                        @if($reply->fk_userId == Auth::user()->userId)
                            {{--Current User--}}
                            <div class="container2 darker" >
                                <span class="badge badge-secondary" style="color: white;"  > {{$reply->fullName}} </span>
                                <div class="in ">
                                    {!!  $reply->replyData  !!}

                                     {{--Download File Link--}}
                                    @if($reply->ticketReplyFile != null)
                                        <div class="mt-4">
                                            <a href="{{ url('/public/files/ticketReplyFile').'/'.$reply->ticketReplyFile }}" download> Download File</a>
                                        </div>
                                    @endif

                                    <span class="time-right float-right" style="font-size:15px; color: grey !important; font-weight: lighter;"> {{$reply->created_at}} </span>
                                </div>

                            </div>
                        @else
                            {{--Opposite User--}}
                            @if(Auth::user()->fk_userTypeId == 1 OR Auth::user()->fk_userTypeId == 3)
                                <div class="container2" >
                                    <span class="badge badge-secondary" style="color: white;" > {{$reply->fullName}} </span>
                                    <div class="in">
                                        {!!  $reply->replyData  !!}

                                        {{--Download File Link--}}
                                        @if($reply->ticketReplyFile != null)
                                            <div class="mt-4">
                                                <a href="{{ url('/public/files/ticketReplyFile').'/'.$reply->ticketReplyFile }}" download> Download File</a>
                                            </div>
                                        @endif

                                        <span class="time-right" style="font-size:15px; color: grey !important; font-weight: lighter;"> {{$reply->created_at}} </span>
                                    </div>
                                </div>
                            @else
                                @if($reply->ticketReplyType == 'public')
                                    <div class="container2">
                                        <span class="badge badge-secondary" style="color: white;" > {{$reply->fullName}} </span>
                                        <div class="in">
                                            {!!  $reply->replyData  !!}

                                            {{--Download File Link--}}
                                            @if($reply->ticketReplyFile != null)
                                                <div class="mt-4">
                                                    <a href="{{ url('/public/files/ticketReplyFile').'/'.$reply->ticketReplyFile }}" download> Download File</a>
                                                </div>
                                            @endif

                                            <span class="time-right " style="font-size:15px; color: grey !important; font-weight: lighter;">  {{$reply->created_at}} </span>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endif
                    @endforeach
                @endif
                {{--Old reply end --}}


                {{-- Post a reply --}}
                <form method="post" enctype="multipart/form-data" style="clear: both;">
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
                        <textarea name="replyData" class="form-control ckeditor" placeholder="Enter Your reply" rows="3"></textarea>
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

    {{-- Modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Team Members</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        @foreach($teamMembers as $member)
                            <li class="list-group-item">{{ $member->fullName }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script type="text/javascript" src="{{ url('public/ck/ckeditor/ckeditor.js')}}"></script>

    <script>
            function editTicket(id) {
                $.ajax({
                    type: 'POST',
                    url: "{!! route('ticket.ckEditorView') !!}",
                    cache: false,
                    data: {
                        _token: "{{csrf_token()}}",
                        'id': id
                    },
                    success: function (data) {
                        $('#ticketInformation').html(data);
                    }
                });
            }
    </script>

@endsection
