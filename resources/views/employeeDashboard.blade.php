
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
                @foreach($MY_Companies as $company)
                    <h5 style="margin-left:20px;font-weight: 300; text-decoration: underline;""><b>{{$company->companyName}}</b></h5>
                    <div class="card-body">
                        @foreach($mybacklogs->where('fk_company_id',$company->companyId) as $mybacklog)
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
                @endforeach
            </div>
        </div>

        {{-- MISSED DEADLINE --}}
        <div id="backlog_panel" style="margin-left: 20px; margin-bottom: 40px;">
            <div class="card">
                <h5 class="card-header mt-0">Past Due</h5>
                @foreach($MY_Companies as $company)
                    <h5 style="margin-left:20px;font-weight: 300; text-decoration: underline;"><b>{{$company->companyName}}</b></h5>
                    <div class="card-body">
                        @foreach($mybacklogsMissed->where('fk_company_id',$company->companyId) as $mybacklog)
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

                @endforeach
            </div>
        </div>

    @endif

    {{-- Company & Project Information --}}
    <div class="card mb-4" style="margin-left: 20px;">
        <div class="card-header mt-0">
            <h5 style="margin: 0">Project Summary</h5>
        </div>
        <div class="card-body">

            <div class="row" >
                @foreach($MY_Companies as $company)
                    {{-- Project --}}
                    <div class="col-lg-2 col-md-6 mb-2">
                        <div class="card">
                            <div class="card-header p-0">
                                <h5 style="margin-left:20px;font-weight: 300;"><b>{{$company->companyName}}</b></h5>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><a href="{{ route('project.showAllProject') }}">No. of Project</a></h5>
                                <div class="text-right">
                                    <h4 class="font-light m-b-0"> {{ $projectCount->where('fk_company_id',$company->companyId)->count() }} </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="card mt-2">

{{--                @foreach($MY_Companies as $company)--}}
{{--                    <h5 style="margin-left:10px"><b>{{$company->companyName}}</b></h5>--}}
                <div class="card-body" style="padding: 5px; margin-bottom: 0;">
                    @foreach($project_percentage as $projectName => $percentage)
                        <div class="progress m-3" style="height: 25px; color: #0a1832">
                            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{$percentage}}%" aria-valuenow="{{$percentage}}" aria-valuemin="0" aria-valuemax="100"><b style="color: #0a1832; margin-left: 10px;">{{ $projectName }} : {{$percentage}}%</b></div>
                        </div>
                    @endforeach
                </div>
{{--                @endforeach--}}
            </div>

        </div>
    </div>

    {{-- Ticket Information --}}
    <div class="card mb-4" style="margin-left: 20px;">
        <div class="card-header mt-0">
            <h5 style="margin: 0">Ticket Summary</h5>
        </div>
        <div class="card-body">
            @foreach($MY_Companies as $company)
                <h5 style="margin-left:10px;font-weight: 300;"><b>{{$company->companyName}}</b></h5>
            <div class="row" >

                {{-- Open ticket --}}
                <div class="col-lg-2 col-md-6 mb-2">
                    <div class="card newCard">
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{ route('call_openticket') }}">Open Ticket</a></h5>
                            <div class="text-right">
                                <h4 class="font-light m-b-0"> {{ $openticket->where('ticketOpenerCompanyId',$company->companyId)->count() }} </h4>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Close ticket --}}
                <div class="col-lg-2 col-md-6 mb-2">
                    <div class="card newCard">
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{ route('call_closeticket') }}">Closed Ticket</a></h5>
                            <div class="text-right">
                                <h4 class="font-light m-b-0"> {{ $close->where('ticketOpenerCompanyId',$company->companyId)->count()  }} </h4>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Overdue ticket --}}
                <div class="col-lg-2 col-md-6 mb-2">
                    <div class="card newCard">
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{ route('call_overdueticket') }}">Overdue Ticket</a></h5>
                            <div class="text-right">
                                <h4 class="font-light m-b-0"> {{ $overdue->where('ticketOpenerCompanyId',$company->companyId)->count() }} </h4>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

             @endforeach
        </div>
    </div>



    {{-- Ticket Information For This Month --}}
    <div class="card" style="margin-left: 20px; margin-bottom: 90px;">
        <div class="card-header mt-0">
            <h5 style="margin: 0">Ticket Summary For This Month</h5>
        </div>
        <div class="card-body">
            @foreach($MY_Companies as $company)
                <h5 style="margin-left:10px; font-weight: 300;"><b>{{$company->companyName}}</b></h5>
            <div class="row" >

                <div class="col-lg-2 col-md-6 mb-2">
                    <div class="card newCard">
                        <div class="card-body">
                            <h5 class="card-title"><a href="#">Open Ticket</a></h5>
                            <div class="text-right">
                                <h4 class="font-light m-b-0"> {{ $openticketMonth->where('ticketOpenerCompanyId',$company->companyId)->count() }} </h4>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Close ticket --}}
                <div class="col-lg-2 col-md-6 mb-2">
                    <div class="card newCard">
                        <div class="card-body">
                            <h5 class="card-title"><a href="#">Closed Ticket</a></h5>
                            <div class="text-right">
                                <h4 class="font-light m-b-0"> {{ $closeMonth->where('ticketOpenerCompanyId',$company->companyId)->count() }} </h4>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Overdue ticket --}}
                <div class="col-lg-2 col-md-6 mb-2">
                    <div class="card newCard">
                        <div class="card-body">
                            <h5 class="card-title"><a href="#">Overdue Ticket</a></h5>
                            <div class="text-right">
                                <h4 class="font-light m-b-0"> {{ $overdueMonth->where('ticketOpenerCompanyId',$company->companyId)->count() }} </h4>
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

            @endforeach
        </div>
    </div>





@endsection


@section('js')

    <script type="text/javascript" src="{{ url('/public/ck/ckeditor/ckeditor.js')}}"></script>

    <script>
        function openItem(x){
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