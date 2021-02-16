@extends('layouts.mainLayout')

@section('css')
    <style>
        .newCard {
            /*box-shadow: 1px 0 10px rgba(0, 0, 0, 0.20) !important;*/
        }

        .card-body {
            padding-bottom: 0px;
            margin-bottom: 15px;
        }

        .card {
            box-shadow: 0px 0 3px rgba(0, 0, 0, 0.39);
        }

        .changeMouse {
            cursor: pointer;
        }

        .card-title {
            margin-bottom: -1.25rem !important;
        }
    </style>
@endsection

@section('content')

    {{-- Backlog Information --}}
    @if(Auth::user()->fk_userTypeId == 3)

        <!-- Item Details Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        {{--<h5 class="modal-title" id="exampleModalLabel">Backlog Title</h5>--}}
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="backlog_details"></div>
                </div>
            </div>
        </div>

        <div id="backlog_panel" style="margin-left: 20px">
            <div class="card mb-3">
                <h5 class="card-header mt-0">Today's List</h5>
                <div class="card-body">
                    @foreach($mybacklogs as $mybacklog)
                        <div class="card mb-2 ml-2 changeMouse" onclick="openItem(this)"
                             data-backlog-id= {{ $mybacklog->backlog_id }}>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <b>Backlog : </b> {{ $mybacklog->backlog_title }}
                                    </div>
                                    <div class="col-md-3">
                                        <b>Project : </b> {{ $mybacklog->project_name }}
                                    </div>
                                    <div class="col-md-2">
                                        <b>Backlog State : </b> {{ $mybacklog->backlog_state }}
                                    </div>
                                    <div class="col-md-2">
                                        <b>Backlog Start Date : </b> {{ $mybacklog->backlog_start_date }}
                                    </div>
                                    <div class="col-md-2">
                                        <b>Backlog End Date : </b> {{ $mybacklog->backlog_end_date }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- MISSED DEADLINE --}}
        <div id="backlog_panel" style="margin-left: 20px; margin-bottom: 40px;">
            <div class="card">
                <h5 class="card-header mt-0">Past Due</h5>
                <div class="card-body">
                    @foreach($mybacklogsMissed as $mybacklog)
                        <div class="card mb-2 ml-2 changeMouse" onclick="openItem(this)"
                             data-backlog-id= {{ $mybacklog->backlog_id }}>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <b>Backlog : </b> {{ $mybacklog->backlog_title }}
                                    </div>
                                    <div class="col-md-3">
                                        <b>Project : </b> {{ $mybacklog->project_name }}
                                    </div>
                                    <div class="col-md-2">
                                        <b>Backlog State : </b> {{ $mybacklog->backlog_state }}
                                    </div>
                                    <div class="col-md-2">
                                        <b>Backlog Start Date : </b> {{ $mybacklog->backlog_start_date }}
                                    </div>
                                    <div class="col-md-2">
                                        <b>Backlog End Date : </b> {{ $mybacklog->backlog_end_date }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    @endif

    {{-- Company & Project Information --}}
     <div class="card mb-4" style="margin-left: 20px;">
       {{-- <div class="card-header mt-0">
            @if(Auth::user()->fk_userTypeId == 1)
                <h5 style="margin: 0">Company & Project Summary</h5>
            @else
                <h5 style="margin: 0">Project Summary</h5> 
            @endif

        </div> --}}
        <div class="">
            <div class="row">

                @if(Auth::user()->fk_userTypeId == 1)
                    {{-- Company --}}
                    <div class="col-lg-2 col-md-6 mb-2">
                        <div class="card newCard">
                            <div class="card-body">
                                <h5 class="card-title"><a href="{{ route('company.showAllCompany') }}">No. of
                                        Company</a></h5>
                                <div class="text-right">
                                    <h4 class="font-light m-b-0"> {{ $companyCount }} </h4>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif
                {{-- Project --}}
               {{-- <div class="col-lg-3 col-md-8 mb-2">
                    <div class="card newCard">
                        <div class="table table-responsive">
                            <table id="projectTable2" class="table-bordered text-center table-striped"
                                   style="width:100%">
                                <thead>
                                <tr>
                                    <th>Projects</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($Clientprojects as $project)
                                    <tr>
                                        <td>
                                            {{ $project->project_name }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> --}}
				
            </div>

            {{-- <div class="card mt-2">
                 <div class="card-body" style="padding: 5px; margin-bottom: 0;">
                     @foreach($project_percentage as $projectName => $percentage)
                         <div class="progress m-3" style="height: 25px; color: #0a1832">
                             <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                                  role="progressbar" style="width: {{$percentage}}%" aria-valuenow="{{$percentage}}"
                                  aria-valuemin="0" aria-valuemax="100"><b
                                     style="color: #0a1832; margin-left: 10px;">{{ $projectName }} : {{$percentage}}%</b>
                             </div>
                         </div>
                     @endforeach
                 </div>
             </div>--}}

        </div>
    </div> 


    {{-- Ticket Information --}}
    <div class="card mb-4" style="margin-left: 20px;">
        <div class="card-header mt-0">
            <h5 style="margin: 0">Ticket Summary</h5>
        </div>
        <div class="card-body">

            <div class="row">
                {{-- All ticket --}}
                {{--<div class="col-lg-2 col-md-6 mb-2">--}}
                {{--<div class="card newCard">--}}
                {{--<div class="card-body">--}}
                {{--<h5 class="card-title"><a href="{{ route('call_allticket') }}" >All Ticket</a></h5>--}}
                {{--<div class="text-right">--}}
                {{--<h4 class="font-light m-b-0"> {{ $allticket }} </h4>--}}
                {{--<span class="text-muted">This Month</span>--}}
                {{--</div>--}}

                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{-- My tickets --}}

                {{--<div class="col-lg-2 col-md-6 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 style="padding-bottom: 10px"><a href="{{ route('ticket.create') }}">Create Ticket</a>
                            </h5>
                        </div>
                    </div>
                </div>--}}
                <div class="col-lg-2 col-md-6 mb-2">
                    <div style="background-color: blue; color: #ffffff" class="card newCard">
                        <div class="card-body">
                            <h5 class="card-title" style="display: inline-block"><a style="color: #ffffff" href="{{ route('ticket.myticket') }}">My
                                    Ticket(s)</a></h5>
                            <div class="text-right">
                                <h4 class="font-light m-b-0"> {{ $myTicket }} </h4>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Open ticket --}}
                <div class="col-lg-2 col-md-6 mb-2">
                    <div style="color: #0056B3" class="card newCard">
                        <div class="card-body">
                            <h5 class="card-title" style="display: inline-block"><a href="{{ route('call_openticket') }}">Open Ticket(s)</a></h5>
                            <div class="text-right">
                                <h4 class="font-light m-b-0"> {{ $openticket->count() }} </h4>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Close ticket --}}
                <div class="col-lg-2 col-md-6 mb-2">
                    <div style="background-color: #808080; color: #ffffff" class="card newCard">
                        <div class="card-body">
                            <h5 class="card-title" style="display: inline-block"><a style="color:#ffffff;" href="{{ route('call_closeticket') }}">Closed
                                    Ticket(s)</a></h5>
                            <div class="text-right">
                                <h4 class="font-light m-b-0"> {{ $close->count() }} </h4>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Overdue ticket --}}
                <div class="col-lg-2 col-md-6 mb-2">
                    <div style="background-color: red; color: #ffffff" class="card newCard">
                        <div class="card-body">
                            <h5 class="card-title" style="display: inline-block"><a style="color: #ffffff" href="{{ route('call_overdueticket') }}">Overdue
                                    Ticket(s)</a></h5>
                            <div class="text-right">
                                <h4 class="font-light m-b-0"> {{ $overdue->count() }} </h4>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pending ticket --}}
                <div class="col-lg-2 col-md-6 mb-2">
                    <div style="background-color: yellow; color: #0056B3" class="card newCard">
                        <div class="card-body">
                            <h5 class="card-title" style="display: inline-block"><a href="{{ route('call_pendingticket') }}">Pending Ticket(s)</a>
                            </h5>
                            <div class="text-right">
                                <h4 class="font-light m-b-0"> {{ $pending->count() }} </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{-- Ticket Information For This Month --}}
    <div class="card" style="margin-left: 20px; margin-bottom: 90px;">
        <div class="card-header mt-0">
            <h5 style="margin: 0">Ticket Summary For This Month</h5>
        </div>
        <div class="card-body">

            <div class="row">

                {{-- All ticket --}}
                {{--<div class="col-lg-2 col-md-6 mb-2">--}}
                {{--<div class="card newCard">--}}
                {{--<div class="card-body">--}}
                {{--<h5 class="card-title"><a href="#">All Ticket</a></h5>--}}
                {{--<div class="text-right">--}}
                {{--<h4 class="font-light m-b-0"> {{ $allticketMonth }} </h4>--}}
                {{--</div>--}}

                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}

                {{-- Open ticket --}}
                <div class="col-lg-2 col-md-6 mb-2">
                    <div style="color: #0056B3" class="card newCard">
                        <div class="card-body">
                            <h5 class="card-title" style="display: inline-block"><a href="#">Open Ticket(s)</a></h5>
                            <div class="text-right">
                                <h4 class="font-light m-b-0"> {{ $openticketMonth }} </h4>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Close ticket --}}
                <div class="col-lg-2 col-md-6 mb-2">
                    <div style="background-color: #808080; color: #ffffff" class="card newCard">
                        <div class="card-body">
                            <h5 class="card-title" style="display: inline-block"><a style="color:#ffffff;" href="#">Closed Ticket(s)</a></h5>
                            <div class="text-right">
                                <h4 class="font-light m-b-0"> {{ $closeMonth }} </h4>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Overdue ticket --}}
                <div class="col-lg-2 col-md-6 mb-2">
                    <div style="background-color: red; color: #ffffff" class="card newCard">
                        <div class="card-body">
                            <h5 class="card-title" style="display: inline-block"><a style="color: #ffffff" href="#">Overdue Ticket(s)</a></h5>
                            <div class="text-right">
                                <h4 class="font-light m-b-0"> {{ $overdueMonth }} </h4>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pending ticket --}}
                {{--<div class="col-lg-2 col-md-6 mb-2">--}}
                {{--<div class="card newCard">--}}
                {{--<div class="card-body">--}}
                {{--<h5 class="card-title"><a href="#">Pending Ticket</a></h5>--}}
                {{--<div class="text-right">--}}
                {{--<h4 class="font-light m-b-0"> {{ $pendingMonth }} </h4>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>





@endsection


@section('js')

    <script type="text/javascript" src="{{ url('/public/ck/ckeditor/ckeditor.js')}}"></script>

    <script>
        function openItem(x) {
            id = $(x).data('backlog-id');
            console.log(id);

            $.ajax({
                type: 'POST',
                url: "{!! route('backlog.open.details') !!}",
                cache: false,
                data: {
                    _token: "{{csrf_token()}}",
                    'backlog_id': id
                },
                success: function (data) {
                    $('#backlog_details').html(data);
                    $('#exampleModal').modal();
                }
            });
        }
    </script>

@endsection
