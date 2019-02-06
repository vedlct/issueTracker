
@extends('layouts.mainLayout')





@section('css')
    <style>
        .newCard{
            box-shadow: 1px 0 20px rgba(0, 0, 0, 0.07) !important;
            border: 1px solid darkgrey !important;
        }
        /*.card-header {*/
            /*background-color: rgba(0,0,0,.09) !important;*/
            /*border: 1px solid darkgrey !important;*/
        /*}*/
        /*.card-body {*/
            /*!*background-color: rgba(0,0,0,.09) !important;*!*/
            /*border: 1px solid darkgrey !important;*/
        /*}*/
    </style>
@endsection


@section('content')

    {{-- Ticket Information --}}
    <div class="card mb-4">
        <div class="card-header">
            <h3>Ticket Information</h3>
        </div>
        <div class="card-body">


            <div class="row" >

                {{-- All ticket --}}
                <div class="col-lg-2 col-md-6 mb-2">
                    <div class="card newCard">
                        <div class="card-body">
                            <h4 class="card-title"><a href="#">All Ticket</a></h4>
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
                            <h4 class="card-title"><a href="#">Open Ticket</a></h4>
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
                            <h4 class="card-title"><a href="#">Close Ticket</a></h4>
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
                            <h4 class="card-title"><a href="#">Overdue Ticket</a></h4>
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
                            <h4 class="card-title"><a href="#">Pending Ticket</a></h4>
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
    <div class="card">
        <div class="card-header">
            @if(Auth::user()->fk_userTypeId == 1)
                <h3>Company & Project Information</h3>
            @else
                <h3>Project Information</h3>
            @endif

        </div>
        <div class="card-body">


            <div class="row" >

                @if(Auth::user()->fk_userTypeId == 1)
                    {{-- Company --}}
                    <div class="col-lg-2 col-md-6 mb-2">
                        <div class="card newCard">
                            <div class="card-body">
                                <h4 class="card-title"><a href="#">Number of Company</a></h4>
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
                            <h4 class="card-title"><a href="#">Number of Project</a></h4>
                            <div class="text-right">
                                <h2 class="font-light m-b-0"> {{ $projectCount }} </h2>

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