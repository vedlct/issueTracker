
@extends('layouts.mainLayout')

@section('css')
    <style>
        .newCard{
            box-shadow: 1px 0 10px rgba(0, 0, 0, 0.20) !important;
        }
        .card-body{
            padding-bottom: 0px;
            margin-bottom: 15px;
        }
    </style>
@endsection

@section('content')

    {{-- Ticket Information --}}
    <div class="card mb-4">
        <div class="card-header">
            <h4>Ticket Information</h4>
        </div>
        <div class="card-body">

            <div class="row" >
                {{-- All ticket --}}
                <div class="col-lg-2 col-md-6 mb-2">
                    <div class="card newCard">
                        <div class="card-body">
                            <h4 class="card-title"><a href="{{ route('call_allticket') }}" >All Ticket</a></h4>
                            <div class="text-right">
                                <h2 class="font-light m-b-0"> {{ $allticket }} </h2>
                                {{--<span class="text-muted">This Month</span>--}}
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Open ticket --}}
                <div class="col-lg-2 col-md-6 mb-2">
                    <div class="card newCard">
                        <div class="card-body">
                            <h4 class="card-title"><a href="{{ route('call_openticket') }}">Open Ticket</a></h4>
                            <div class="text-right">
                                <h2 class="font-light m-b-0"> {{ $openticket }} </h2>

                            </div>
                        </div>
                    </div>
                </div>

                {{-- Close ticket --}}
                <div class="col-lg-2 col-md-6 mb-2">
                    <div class="card newCard">
                        <div class="card-body">
                            <h4 class="card-title"><a href="{{ route('call_closeticket') }}">Closed Ticket</a></h4>
                            <div class="text-right">
                                <h2 class="font-light m-b-0"> {{ $close }} </h2>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Overdue ticket --}}
                <div class="col-lg-2 col-md-6 mb-2">
                    <div class="card newCard">
                        <div class="card-body">
                            <h4 class="card-title"><a href="{{ route('call_overdueticket') }}">Overdue Ticket</a></h4>
                            <div class="text-right">
                                <h2 class="font-light m-b-0"> {{ $overdue }} </h2>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pending ticket --}}
                <div class="col-lg-2 col-md-6 mb-2">
                    <div class="card newCard">
                        <div class="card-body">
                            <h4 class="card-title"><a href="{{ route('call_pendingticket') }}">Pending Ticket</a></h4>
                            <div class="text-right">
                                <h2 class="font-light m-b-0"> {{ $pending }} </h2>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>




    {{-- Company & Project Information --}}
    <div class="card mb-4">
        <div class="card-header">
            @if(Auth::user()->fk_userTypeId == 1)
                <h4>Company & Project Information</h4>
            @else
                <h4>Project Information</h4>
            @endif

        </div>
        <div class="card-body">
            <div class="row" >

                @if(Auth::user()->fk_userTypeId == 1)
                    {{-- Company --}}
                    <div class="col-lg-2 col-md-6 mb-2">
                        <div class="card newCard">
                            <div class="card-body">
                                <h4 class="card-title"><a href="{{ route('company.showAllCompany') }}">No. of Company</a></h4>
                                <div class="text-right">
                                    <h2 class="font-light m-b-0"> {{ $companyCount }} </h2>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif

                {{-- Project --}}
                <div class="col-lg-2 col-md-6 mb-2">
                    <div class="card newCard">
                        <div class="card-body">
                            <h4 class="card-title"><a href="{{ route('project.showAllProject') }}">No. of Project</a></h4>
                            <div class="text-right">
                                <h2 class="font-light m-b-0"> {{ $projectCount }} </h2>

                            </div>
                        </div>
                    </div>
                </div>


            </div>


        </div>
    </div>

    {{-- Ticket Information For This Month --}}
    <div class="card" style="margin-bottom: 90px;">
        <div class="card-header">
            <h4>Ticket Information For This Month</h4>
        </div>
        <div class="card-body">

            <div class="row" >

                {{-- All ticket --}}
                <div class="col-lg-2 col-md-6 mb-2">
                    <div class="card newCard">
                        <div class="card-body">
                            <h4 class="card-title"><a href="#">All Ticket</a></h4>
                            <div class="text-right">
                                <h2 class="font-light m-b-0"> {{ $allticketMonth }} </h2>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Open ticket --}}
                <div class="col-lg-2 col-md-6 mb-2">
                    <div class="card newCard">
                        <div class="card-body">
                            <h4 class="card-title"><a href="#">Open Ticket</a></h4>
                            <div class="text-right">
                                <h2 class="font-light m-b-0"> {{ $openticketMonth }} </h2>

                            </div>
                        </div>
                    </div>
                </div>

                {{-- Close ticket --}}
                <div class="col-lg-2 col-md-6 mb-2">
                    <div class="card newCard">
                        <div class="card-body">
                            <h4 class="card-title"><a href="#">Closed Ticket</a></h4>
                            <div class="text-right">
                                <h2 class="font-light m-b-0"> {{ $closeMonth }} </h2>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Overdue ticket --}}
                <div class="col-lg-2 col-md-6 mb-2">
                    <div class="card newCard">
                        <div class="card-body">
                            <h4 class="card-title"><a href="#">Overdue Ticket</a></h4>
                            <div class="text-right">
                                <h2 class="font-light m-b-0"> {{ $overdueMonth }} </h2>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pending ticket --}}
                <div class="col-lg-2 col-md-6 mb-2">
                    <div class="card newCard">
                        <div class="card-body">
                            <h4 class="card-title"><a href="#">Pending Ticket</a></h4>
                            <div class="text-right">
                                <h2 class="font-light m-b-0"> {{ $pendingMonth }} </h2>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>





@endsection


@section('js')


@endsection