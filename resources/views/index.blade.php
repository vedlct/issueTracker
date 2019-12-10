
@extends('layouts.mainLayout')

@section('css')
    <style>
        .newCard{
            /*box-shadow: 1px 0 10px rgba(0, 0, 0, 0.20) !important;*/
        }
        .card-body{
            padding-bottom: 0px;
            margin-bottom: 15px;
        }

        .card{
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
    <style>
        @media only screen and (min-width: 338px) and (max-width: 379px){
            .top{
                margin-top: 20%;
            }

        }
        @media only screen and (max-width: 337px){
            .top1{
                margin-top: 60%;
            }

        }
    </style>

    {{-- Backlog Information --}}
    @if(Auth::user()->fk_userTypeId == 3)

        <!-- Item Details Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <div class="card mb-2 ml-2 changeMouse" onclick="openItem(this)" data-backlog-id= {{ $mybacklog->backlog_id }}>
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
                        <div class="card mb-2 ml-2 changeMouse" onclick="openItem(this)" data-backlog-id= {{ $mybacklog->backlog_id }}>
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

    <div class="container-fluid">

        <div class="row">
            <div class="col-xl-3 top top1">
                <div class="card m-b-30">
                    <div class="card-body">

                        <h4 class="mt-0 header-title">All Project Status</h4>

                        <canvas id="doughnut" height="260"></canvas>

                        <ul class="list-inline widget-chart m-t-20 m-b-15 text-center">
                            <li>
                                <h4 class=""><b id="total_project">{{ $projectCount }}</b></h4>
                                <p class="text-muted"><a href="{{ route('project.showAllProject') }}">Total</a></p>
                            </li>
                            <li>
                                <h4 class=""><b  id="total_project_complete">{{$projectCompleteCount}}</b></h4>
                                <p class="text-muted">Complete</p>
                            </li>
                            <li>
                                <h4 class=""><b>{{ $totalPartnerProject }}</b></h4>
                                <p class="text-muted"><a href="{{ route('project.partner.showAllProject') }}">Partner</a></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="card m-b-30">
                    <div class="card-body">

                        <h4 class="mt-0 header-title">Issue Monthly Status</h4>

                        <canvas id="pie" height="260"></canvas>

                        <ul class="list-inline widget-chart m-t-20 m-b-15 text-center">
                            <li>
                                <h4 class=""><b id="openticketMonth">{{ $openticketMonth }}</b></h4>
                                <p class="text-muted"><a href="{{ route('call_openticket') }}">Open</a></p>
                            </li>
                            <li>
                                <h4 class=""><b id="closeMonth">{{ $closeMonth }}</b></h4>
                                <p class="text-muted"><a href="{{ route('call_closeticket') }}">Closed</a></p>
                            </li>
                            <li>
                                <h4 class=""><b id="overdueMonth">{{ $overdueMonth }}</b></h4>
                                <p class="text-muted"><a href="{{ route('call_overdueticket') }}">Overdue</a></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> <!-- end col -->

            <div class="col-xl-3">
                <div class="card m-b-30">
                    <div class="card-body" style="overflow-y: scroll; height:435px;">

                        <h4 class="mt-0 header-title">Timesheet Summery</h4>

                        <canvas id="timesheet" height="260" style="display: none"></canvas>

                        <ol class="text-center">
                        @foreach($project_percentage as $projectName => $percentage)
                            <li class="progress m-3" style="height: 25px; color: #0a1832">
                                <span class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{$percentage}}%" aria-valuenow="{{$percentage}}" aria-valuemin="0" aria-valuemax="100"><b style="color: #0a1832; margin-left: 10px;">{{ $projectName }} : {{$percentage}}%</b></span>
                            </li>
                        @endforeach
                        </ol>
                    </div>
                </div>
            </div> <!-- end col -->
            <div class="col-xl-3">
                <div class="card m-b-30">
                    <div class="card-body">

                        <h4 class="mt-0 header-title">Milestone Status</h4>

                        <canvas id="milestone" height="260"></canvas>

                        <ul class="list-inline widget-chart m-t-20 m-b-15 text-center">
                            <li>
                                <h4 class=""><b id="monthlyBacklogCount">{{ $monthlyBacklogCount }}</b></h4>
                                <p class="text-muted">Total</p>
                            </li>
                            <li>
                                <h4 class=""><b id="monthlyBacklogCompleteCount">{{ $monthlyBacklogCompleteCount }}</b></h4>
                                <p class="text-muted">Completed</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> <!-- end row -->

        <div class="row">
            <div class="col-lg-3">
                <div class="card m-b-30">
                    <div class="card-body" style="overflow-y: scroll; height:435px;">

                        <h4 class="mt-0 header-title">Employee Backlog</h4>

                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                @if($employes)
                                @foreach($employes as $employe)
                                <tr>
                                    <th scope="row">{{$employe->fullName}}</th>
                                    <td>{{$employe->backlog_count}}</td>
                                </tr>
                                @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div> <!-- end col -->
            <div class="col-lg-3">
                <div class="card m-b-30">
                    <div class="card-body" style="overflow-y: scroll; height:435px;">

                        <h4 class="mt-0 header-title">Today Employee Task</h4>

                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                @if($employeeTicket)
                                @foreach($employeeTicket as $employeeTic)
                                    @if($employeeTic->fk_company_id == Auth::user()->fkCompanyId)
                                        <tr>
                                            <th scope="row">{{$employeeTic->fullName}}</th>

                                        @if($employeeTic->backlog_state == 'Ongoing')
                                            <td><a href="javascript:void(0)" onclick="backLogDetailsShow(this)" backlog_title="{{$employeeTic->backlog_title}}" backlog_start_date="{{\Carbon\Carbon::parse($employeeTic->backlog_start_date)->toFormattedDateString()}}" backlog_end_date="{{\Carbon\Carbon::parse($employeeTic->backlog_end_date)->toFormattedDateString()}}" project_name="{{$employeeTic->project_name}}" style="color: red;">{{$employeeTic->project_name}}</a></td>
                                        @else
                                            <td><a href="javascript:void(0)" onclick="backLogDetailsShow(this)" backlog_title="{{$employeeTic->backlog_title}}" backlog_start_date="{{\Carbon\Carbon::parse($employeeTic->backlog_start_date)->toFormattedDateString()}}" backlog_end_date="{{\Carbon\Carbon::parse($employeeTic->backlog_end_date)->toFormattedDateString()}}" project_name="{{$employeeTic->project_name}}">{{$employeeTic->project_name}}</a></td>
                                        @endif
                                        </tr>
                                    @endif
                                @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div> <!-- end col -->
            <div class="col-lg-6">
                <div class="card m-b-30">
                    <div class="card-body" style="overflow-y: scroll; height:435px;">

                        <h4 class="mt-0 header-title" style="color: red;font-size: 22px;">Overdue Backlogs</h4>

                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                @if(isset($backlogsOverdue))
                                @foreach($backlogsOverdue as $key => $backlogsOverdues)
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{$backlogsOverdues->project_name}}</td>
                                    <td>{{$backlogsOverdues->backlog_title}}</td>
                                    <td style="color: red;">{{ \Carbon\Carbon::parse($backlogsOverdues->backlog_end_date)->diffForHumans() }}</td>
                                </tr>
                                @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div><!-- container fluid -->


{{--    <div class="card mb-4" style="margin-left: 20px;">--}}
{{--        <div class="card-header mt-0">--}}
{{--            @if(Auth::user()->fk_userTypeId == 1)--}}
{{--                <h5 style="margin: 0">Company & Project Summary</h5>--}}
{{--            @else--}}
{{--                <h5 style="margin: 0">Project Summary</h5>--}}
{{--            @endif--}}

{{--        </div>--}}
{{--        <div class="card-body">--}}
{{--            <div class="row" >--}}

{{--                @if(Auth::user()->fk_userTypeId == 1)--}}
{{--                    --}}{{-- Company --}}
{{--                    <div class="col-lg-2 col-md-6 mb-2">--}}
{{--                        <div class="card newCard">--}}
{{--                            <div class="card-body">--}}
{{--                                <h5 class="card-title"><a href="{{ route('company.showAllCompany') }}">No. of Company</a></h5>--}}
{{--                                <div class="text-right">--}}
{{--                                    <h4 class="font-light m-b-0"> {{ $companyCount }} </h4>--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endif--}}

{{--                --}}{{-- Project --}}
{{--                <div class="col-lg-2 col-md-6 mb-2">--}}
{{--                    <div class="card newCard">--}}
{{--                        <div class="card-body">--}}
{{--                            <h5 class="card-title"><a href="{{ route('project.showAllProject') }}">No. of Project</a></h5>--}}
{{--                            <div class="text-right">--}}
{{--                                <h4 class="font-light m-b-0"> {{ $projectCount }} </h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                @if(Auth::user()->fk_userTypeId == 4)--}}

{{--                <div class="col-lg-2 col-md-6 mb-2">--}}
{{--                    <div class="card newCard">--}}
{{--                        <div class="card-body">--}}
{{--                            <h5 class="card-title"><a href="{{ route('project.partner.showAllProject') }}">partner Project</a></h5>--}}
{{--                            <div class="text-right">--}}
{{--                                <h4 class="font-light m-b-0"> {{ $totalPartnerProject }} </h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                @endif--}}

{{--            </div>--}}

{{--            <div class="card mt-2">--}}
{{--                <div class="card-body" style="padding: 5px; margin-bottom: 0;">--}}
{{--                    @foreach($project_percentage as $projectName => $percentage)--}}
{{--                        <div class="progress m-3" style="height: 25px; color: #0a1832">--}}
{{--                            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{$percentage}}%" aria-valuenow="{{$percentage}}" aria-valuemin="0" aria-valuemax="100"><b style="color: #0a1832; margin-left: 10px;">{{ $projectName }} : {{$percentage}}%</b></div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}

{{--    --}}{{-- Ticket Information --}}
{{--    <div class="card mb-4" style="margin-left: 20px;">--}}
{{--        <div class="card-header mt-0">--}}
{{--            <h5 style="margin: 0">Ticket Summary</h5>--}}
{{--        </div>--}}
{{--        <div class="card-body">--}}

{{--            <div class="row" >--}}
{{--                --}}{{-- All ticket --}}
{{--                --}}{{--<div class="col-lg-2 col-md-6 mb-2">--}}
{{--                    --}}{{--<div class="card newCard">--}}
{{--                        --}}{{--<div class="card-body">--}}
{{--                            --}}{{--<h5 class="card-title"><a href="{{ route('call_allticket') }}" >All Ticket</a></h5>--}}
{{--                            --}}{{--<div class="text-right">--}}
{{--                                --}}{{--<h4 class="font-light m-b-0"> {{ $allticket }} </h4>--}}
{{--                                --}}{{--<span class="text-muted">This Month</span>--}}
{{--                            --}}{{--</div>--}}

{{--                        --}}{{--</div>--}}
{{--                    --}}{{--</div>--}}
{{--                --}}{{--</div>--}}

{{--                --}}{{-- Open ticket --}}
{{--                <div class="col-lg-2 col-md-6 mb-2">--}}
{{--                    <div class="card newCard">--}}
{{--                        <div class="card-body">--}}
{{--                            <h5 class="card-title"><a href="{{ route('call_openticket') }}">Open Ticket</a></h5>--}}
{{--                            <div class="text-right">--}}
{{--                                <h4 class="font-light m-b-0"> {{ $openticket }} </h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                --}}{{-- Close ticket --}}
{{--                <div class="col-lg-2 col-md-6 mb-2">--}}
{{--                    <div class="card newCard">--}}
{{--                        <div class="card-body">--}}
{{--                            <h5 class="card-title"><a href="{{ route('call_closeticket') }}">Closed Ticket</a></h5>--}}
{{--                            <div class="text-right">--}}
{{--                                <h4 class="font-light m-b-0"> {{ $close }} </h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                --}}{{-- Overdue ticket --}}
{{--                <div class="col-lg-2 col-md-6 mb-2">--}}
{{--                    <div class="card newCard">--}}
{{--                        <div class="card-body">--}}
{{--                            <h5 class="card-title"><a href="{{ route('call_overdueticket') }}">Overdue Ticket</a></h5>--}}
{{--                            <div class="text-right">--}}
{{--                                <h4 class="font-light m-b-0"> {{ $overdue }} </h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                --}}{{-- Pending ticket --}}
{{--                --}}{{--<div class="col-lg-2 col-md-6 mb-2">--}}
{{--                    --}}{{--<div class="card newCard">--}}
{{--                        --}}{{--<div class="card-body">--}}
{{--                            --}}{{--<h5 class="card-title"><a href="{{ route('call_pendingticket') }}">Pending Ticket</a></h5>--}}
{{--                            --}}{{--<div class="text-right">--}}
{{--                                --}}{{--<h4 class="font-light m-b-0"> {{ $pending }} </h4>--}}
{{--                            --}}{{--</div>--}}
{{--                        --}}{{--</div>--}}
{{--                    --}}{{--</div>--}}
{{--                --}}{{--</div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}



{{--    --}}{{-- Ticket Information For This Month --}}
{{--    <div class="card" style="margin-left: 20px; margin-bottom: 90px;">--}}
{{--        <div class="card-header mt-0">--}}
{{--            <h5 style="margin: 0">Ticket Summary For This Month</h5>--}}
{{--        </div>--}}
{{--        <div class="card-body">--}}

{{--            <div class="row" >--}}

{{--                --}}{{-- All ticket --}}
{{--                --}}{{--<div class="col-lg-2 col-md-6 mb-2">--}}
{{--                    --}}{{--<div class="card newCard">--}}
{{--                        --}}{{--<div class="card-body">--}}
{{--                            --}}{{--<h5 class="card-title"><a href="#">All Ticket</a></h5>--}}
{{--                            --}}{{--<div class="text-right">--}}
{{--                                --}}{{--<h4 class="font-light m-b-0"> {{ $allticketMonth }} </h4>--}}
{{--                            --}}{{--</div>--}}

{{--                        --}}{{--</div>--}}
{{--                    --}}{{--</div>--}}
{{--                --}}{{--</div>--}}

{{--                --}}{{-- Open ticket --}}
{{--                <div class="col-lg-2 col-md-6 mb-2">--}}
{{--                    <div class="card newCard">--}}
{{--                        <div class="card-body">--}}
{{--                            <h5 class="card-title"><a href="#">Open Ticket</a></h5>--}}
{{--                            <div class="text-right">--}}
{{--                                <h4 class="font-light m-b-0"> {{ $openticketMonth }} </h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                --}}{{-- Close ticket --}}
{{--                <div class="col-lg-2 col-md-6 mb-2">--}}
{{--                    <div class="card newCard">--}}
{{--                        <div class="card-body">--}}
{{--                            <h5 class="card-title"><a href="#">Closed Ticket</a></h5>--}}
{{--                            <div class="text-right">--}}
{{--                                <h4 class="font-light m-b-0"> {{ $closeMonth }} </h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                --}}{{-- Overdue ticket --}}
{{--                <div class="col-lg-2 col-md-6 mb-2">--}}
{{--                    <div class="card newCard">--}}
{{--                        <div class="card-body">--}}
{{--                            <h5 class="card-title"><a href="#">Overdue Ticket</a></h5>--}}
{{--                            <div class="text-right">--}}
{{--                                <h4 class="font-light m-b-0"> {{ $overdueMonth }} </h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                --}}{{-- Pending ticket --}}
{{--                --}}{{--<div class="col-lg-2 col-md-6 mb-2">--}}
{{--                    --}}{{--<div class="card newCard">--}}
{{--                        --}}{{--<div class="card-body">--}}
{{--                            --}}{{--<h5 class="card-title"><a href="#">Pending Ticket</a></h5>--}}
{{--                            --}}{{--<div class="text-right">--}}
{{--                                --}}{{--<h4 class="font-light m-b-0"> {{ $pendingMonth }} </h4>--}}
{{--                            --}}{{--</div>--}}
{{--                        --}}{{--</div>--}}
{{--                    --}}{{--</div>--}}
{{--                --}}{{--</div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="modal fade" id="backLogDetailsModal" tabindex="-1" role="dialog" is="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="backLogDetailsModalTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="font-size: 30px"><strong>Backlog Tittle - </strong><span id="baclogtittle"></span> </p>
                    <p style="font-size: 30px"><strong>Backlog Start Date - </strong><span id="baclogstartdate" style="color: green"></span> </p>
                    <p style="font-size: 30px"><strong>Backlog End Date - </strong><span id="baclogenddate" style="color: red"></span> </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



@endsection


@section('js')

    <script type="text/javascript" src="{{ url('/public/ck/ckeditor/ckeditor.js')}}"></script>
    <script src="{{ url('/public/assets/plugins/chart.js/chart.min.js')}}"></script>
    <script src="{{ url('/public/assets/pages/chartjs.init.js')}}"></script>

    <script>
        function backLogDetailsShow(r) {
            $('#backLogDetailsModalTitle').text("Project - "+$(r).attr('project_name'));
            $('#baclogtittle').text($(r).attr('backlog_title'));
            $('#baclogstartdate').text($(r).attr('backlog_start_date'));
            $('#baclogenddate').text($(r).attr('backlog_end_date'));
            $('#backLogDetailsModal').modal('toggle');
        }

        function openItem(x){
            id = $(x).data('backlog-id');

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
