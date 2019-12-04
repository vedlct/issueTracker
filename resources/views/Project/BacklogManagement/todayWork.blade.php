@extends('layouts.mainLayout')


@section('css')
    <style>
        .card{
            box-shadow: 0px 0 3px rgba(0, 0, 0, 0.39);
        }
        .changeMouse {
            cursor: pointer;
        }
    </style>
@endsection


@section('content')

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


    {{--<div id="backlog_panel">--}}
        {{--@foreach($mybacklogs as $mybacklog)--}}
            {{--<div class="card mb-2 ml-2 changeMouse" onclick="openItem(this)" data-backlog-id= {{ $mybacklog->backlog_id }}>--}}
                {{--<div class="card-body">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-3">--}}
                            {{--<b>Backlog : </b> {{ $mybacklog->backlog_title }}--}}
                        {{--</div>--}}
                        {{--<div class="col-md-3">--}}
                            {{--<b>Backlog State : </b> {{ $mybacklog->backlog_state }}--}}
                        {{--</div>--}}
                        {{--<div class="col-md-3">--}}
                            {{--<b>Backlog Start Date : </b> {{ $mybacklog->backlog_start_date }}--}}
                        {{--</div>--}}
                        {{--<div class="col-md-3">--}}
                            {{--<b>Backlog End Date : </b> {{ $mybacklog->backlog_end_date }}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--@endforeach--}}
    {{--</div>--}}

    <div id="backlog_panel" style="margin-left: 20px">
        <div class="card mb-3">
            <h5 class="card-header mt-0">Today's Work</h5>
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
    <div id="backlog_panel" style="margin-left: 20px">
        <div class="card">
            <h5 class="card-header mt-0">Backlog (Missed Deadline)</h5>
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

@endsection

@section('js')

    <script type="text/javascript" src="{{ url('/public/ck/ckeditor/ckeditor.js')}}"></script>

    <script>
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

