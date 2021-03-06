@extends('layouts.mainLayout')


@section('css')
    <style>
        .card{
            box-shadow: 0px 0 3px rgba(0, 0, 0, 0.39);
        }
        .select2-container{
            display: block;
        }
        .select2-container--default.select2-container--focus .select2-selection--multiple {
             border: none;
        }
        .select2 select2-container select2-container--default select2-container--below{
            width: 100%;
        }

        .ck-rounded-corners .ck.ck-editor__main>.ck-editor__editable, .ck.ck-editor__main>.ck-editor__editable.ck-rounded-corners{
            min-height: 200px;
        }
        .changeMouse {
            cursor: pointer;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection


@section('content')
    <style>
        @media only screen and (max-width: 406px){
            .top{
                margin-top: 8%;
            }

        }
        @media only screen and (min-width: 360px) and (max-width: 540px){
            .top1{
                margin-top: 5%;
            }

        }
        @media only screen and (min-width: 540px) and (max-width: 709px){
            .top2{
                margin-top: 5%;
            }

        }
        @media only screen and (min-width: 769px) and (max-width: 948px){
            .top3{
                margin-top: 5%;
            }

        }
    </style>
    <style>
        @media only screen and (min-width: 338px) and (max-width: 379px){
            .top4{
                margin-top: 20%;
            }

        }
        @media only screen and (max-width: 337px){
            .top5{
                margin-top: 60%;
            }

        }
    </style>

    <div class="card top4 top5" style="margin-left: 20px;">
        <div class="card-header">
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <b>{{ $project->project_name }} : </b> Create New Backlog
                </div>
                <div class="col-md-9 col-sm-9">

                    <a class="btn btn-primary btn-sm pull-right ml-2" href="{{ route('project.features', $project->projectId) }}">Dashboard</a>
                    <a class="btn btn-primary btn-sm pull-right ml-2 top" href="{{ route('project.projectmanagement', $project->projectId) }}">ADD FEATURE (ADVANCE)</a>

                    <a class="btn btn-sm btn-secondary pull-right top top1 top2 top3" style="color: white" onclick="generateReport()">Generate Project Excel</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            {{-- Backlog add form --}}
            <form action="{{ route('backlog.insert') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mb-2">
                    <input type="hidden" name="project_id" value="{{ $project->projectId }}">
                    <div class="col-sm-4">
                        <label>Backlog Title *</label>
                        <input type="text" class="form-control" placeholder="Backlog Title" name="backlog_title" required>
                    </div>
                    <div class="col-sm-4">
                        <label>Priority</label>
                        <select class="form-control" name="priority" required>
                            <option value="">Select Priority</option>
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label>Backlog Time (Hour) *</label>
                        <input type="number" class="form-control" placeholder="Backlog Time" name="backlog_time" required>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-12 col-sm-4">
                        <label style="display: block">Assign Employee</label>
                        <select class="js-example-basic-multiple form-control " name="assigned_employee[]" multiple="multiple" style="width: 100%;">
                            @foreach($allEmp as $emp)
                                <option value="{{ $emp->userId }}">{{ $emp->fullName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-sm-4">
                        <label>Backlog Start Date</label>
                        <input type="text" autocomplete="off" class="form-control datepicker" placeholder="Start Date" name="startdate">
                    </div>
                    <div class="col-sm-4">
                        <label>Backlog End Date</label>
                        <input type="text" autocomplete="off" class="form-control datepicker" placeholder="End Date" name="enddate">
                    </div>
                    <div class="col-sm-4">
                        <label>Remark</label>
                        <input type="text" class="form-control" placeholder="Remark" name="remark">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12 col-sm-4">
                        <label>Backlog Details</label>
                        <textarea class="form-control ckeditor" name="backlogDetails" id="editor"></textarea>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-sm-4">
                        <button class="btn btn-success pull-right">Create Backlog</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <div class="card mt-4" style="margin-left: 20px; margin-bottom: 20px;">
        <div class="card-body">
            <table class="table table-bordered ">
                <tbody>
                <tr>
                    <th scope="row">Total Backlog</th>
                    <td>{{ $backlog_count }}</td>
                </tr>
                <tr>
                    <th scope="row">Total Hour</th>
                    <td>{{ $total_hour }}</td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>

    {{-- List --}}
    <div class="card mt-4" style="margin-left: 20px; margin-bottom: 100px;">
        <ul class="nav nav-tabs m-3" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Backlog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Completed</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Testing</a>
            </li>
        </ul>
        <div class="tab-content m-3" id="myTabContent">

            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                {{-- Backlog --}}
                <div class="">

                    @foreach($inCompletebacklogs as $inCompletebacklog)

                        <div class="card mb-3 changeMouse" data-todo-id= {{ $inCompletebacklog->backlog_id }} onclick="openItem(this)">
                            <div class="card-body pb-0">

                                <div class="row">
                                    <div class="col-md-6">
                                        <span> <b>Backlog : </b> {{ $inCompletebacklog->backlog_title }} </span>

                                        <p>
                                            <span> <b>Start Date :</b> {{ $inCompletebacklog->backlog_start_date }} </span>
                                            <span> <b>End Date :</b> {{ $inCompletebacklog->backlog_end_date }} </span>
                                            <span> <b>Expected Hour :</b> {{ $inCompletebacklog->backlog_time }} </span>
                                        </p>

                                    </div>
                                    <div class="col-md-6">
                                        <span > <b class="mr-2">Assigned Person</b>
                                            @foreach($backlogassignedEmp->where('fk_backlog_id', $inCompletebacklog->backlog_id) as $emp)
                                                <span class="badge badge-secondary" style="font-size: 78%; line-height: 2"> {{ $emp->fullName }} </span>
                                            @endforeach
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </div>

                    @endforeach

                </div>

            </div>

            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                {{-- Completed Backlog --}}
                <div class="">

                    @foreach($completebacklogs as $completebacklog)
                        <div class="card mb-3 changeMouse" data-todo-id= {{ $completebacklog->backlog_id }} onclick="openItem(this)">
                            <div class="card-body pb-0">

                                <div class="row">
                                    <div class="col-md-6">
                                        <span> <b>Backlog : </b> {{ $completebacklog->backlog_title }} </span>
                                        <p>
                                            <span> <b>Start Date :</b> {{ $completebacklog->backlog_start_date }} </span>
                                            <span> <b>End Date :</b> {{ $completebacklog->backlog_end_date }} </span>
                                            <span> <b>Expected Hour :</b> {{ $completebacklog->backlog_time }} </span>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                    <span > <b class="mr-2">Assigned Person</b>
                                        @foreach($backlogassignedEmp->where('fk_backlog_id', $completebacklog->backlog_id) as $emp)
                                            <span class="badge badge-dark" style="font-size: 78%; line-height: 2"> {{ $emp->fullName }} </span>
                                        @endforeach
                                    </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

            </div>

        </div>
    </div>


    <!-- Item Details Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Backlog Title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="editView">

                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script type="text/javascript" src="{{ url('/public/ck/ckeditor/ckeditor.js')}}"></script>

    <script>

        function openItem(x){

            id = $(x).data('todo-id');
            console.log(id);

            $.ajax({
                type: 'POST',
                url: "{!! route('backlog.edit') !!}",
                cache: false,
                data: {
                    _token: "{{csrf_token()}}",
                    'backlog_id': id
                },
                success: function (data) {
                    $('#editView').html(data);
                    $('#exampleModal').modal();
                }
            });
        }

        $(".datepicker").datepicker({
            orientation: "bottom"
        });

        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });

        function generateReport(){
            var id = '{{ $project->projectId }}';
            $.ajax({
                type : 'post' ,
                url : '{{route('backlog.generate.report')}}',
                data : {
                    _token: "{{csrf_token()}}",
                    'project_id': id,
                } ,
                success : function(data){
                    var link = document.createElement("a");
                    link.download = "projects_backlog.xlsx";
                    var uri = '{{url("storage/app")}}'+"/"+"project_backlog.xlsx";
                    link.href = uri;
                    link.click();
                }
            });
        }

    </script>

@endsection

