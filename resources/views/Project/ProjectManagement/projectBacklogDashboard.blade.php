@extends('layouts.mainLayout')


@section('css')
    <style>
        .card{
            box-shadow: 1px 0 20px rgba(0, 0, 0, .09);
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
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection


@section('content')

    <div class="card" style="margin-left: 20px;">
        <div class="card-header">
            Create New Backlog
        </div>
        <div class="card-body">
            {{-- Backlog add form --}}
            <form action="{{ route('backlog.insert') }}" method="post">
                @csrf
                <div class="row mb-2">
                    <input type="hidden" name="project_id" value="{{ $project->projectId }}">
                    <div class="col">
                        <label>Backlog Title</label>
                        <input type="text" class="form-control" placeholder="Backlog Title" name="backlog_title" required>
                    </div>
                    <div class="col">
                        <label>Priority</label>
                        <select class="form-control" name="priority" required>
                            <option value="">Select Priority</option>
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col">
                        <label style="display: block">Assign Employee</label>
                        <select class="js-example-basic-multiple form-control " name="assigned_employee[]" multiple="multiple" style="width: 100%;">
                            @foreach($allEmp as $emp)
                                <option value="{{ $emp->userId }}">{{ $emp->fullName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col">
                        <label>Backlog Start Date</label>
                        <input type="text" autocomplete="off" class="form-control datepicker" placeholder="Start Date" name="startdate" required>
                    </div>
                    <div class="col">
                        <label>Backlog End Date</label>
                        <input type="text" autocomplete="off" class="form-control datepicker" placeholder="End Date" name="enddate" required>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <label>Backlog Details</label>
                        <textarea name="backlogDetails" id="editor"></textarea>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col">
                        <button class="btn btn-success pull-right">Create Backlog</button>
                    </div>
                </div>
            </form>

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

                        <div class="card mb-3" data-todo-id= {{ $inCompletebacklog->backlog_id }} onclick="openItem(this)">
                            <div class="card-body pb-0">

                                <div class="row">
                                    <div class="col-md-6">
                                        <span> <b>Backlog : </b> {{ $inCompletebacklog->backlog_title }} </span>

                                        <p>
                                            <span> <b>Start Date</b> {{ $inCompletebacklog->backlog_start_date }} </span> ->
                                            <span> <b>End Date</b> {{ $inCompletebacklog->backlog_end_date }} </span>
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

                    {{--@foreach($completebacklogs as $completebacklog)--}}

                        {{--<div class="card mb-3" onclick="openItem()">--}}
                            {{--<div class="card-body">--}}
                                {{--<p>--}}
                                    {{--<span> <b>Backlog : </b> {{ $inCompletebacklog->backlog_title }} </span>--}}
                                    {{--<span class="pull-right"> <b>Assigned Person : </b> AMK Khan </span>--}}
                                {{--</p>--}}

                                {{--<p>--}}
                                    {{--<span> <b>Start Date</b> {{ $inCompletebacklog->backlog_start_date }} </span> ->--}}
                                    {{--<span> <b>End Date</b> {{ $inCompletebacklog->backlog_end_date }} </span>--}}
                                {{--</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                    {{--@endforeach--}}


                    @foreach($completebacklogs as $completebacklog)
                        <div class="card mb-3" data-todo-id= {{ $completebacklog->backlog_id }} onclick="openItem(this)">
                            <div class="card-body pb-0">

                                <div class="row">
                                    <div class="col-md-6">
                                        <span> <b>Backlog : </b> {{ $completebacklog->backlog_title }} </span>
                                        <p>
                                            <span> <b>Start Date</b> {{ $completebacklog->backlog_start_date }} </span> ->
                                            <span> <b>End Date</b> {{ $completebacklog->backlog_end_date }} </span>
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

    <script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>

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


    </script>

    {{-- CK Editor --}}
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                width = '75%';
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>

@endsection

