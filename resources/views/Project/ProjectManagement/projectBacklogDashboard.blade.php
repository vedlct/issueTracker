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
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection


@section('content')

    <div class="card">
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
                        <select class="js-example-basic-multiple form-control" name="assigned_employee[]" multiple="multiple" style="width: 100%;">
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
                        <textarea class="form-control" rows="3" placeholder="Backlog Details" name="backlogDetails"></textarea>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col">
                        <button class="btn btn-success pull-right">Create</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    {{-- List --}}

    <div class="card mt-4">

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

                    <div class="card mb-3" onclick="openItem()">
                        <div class="card-body">
                            <p>
                                <span> <b>Backlog : </b> Auth create and Test </span>
                                <span class="pull-right"> <b>Assigned Person : </b> AMK Khan </span>
                            </p>

                            <p>
                                <span> <b>Start Date</b> 12/12/90 </span>
                                <span> <b>End Date</b> 6/4/94 </span>
                            </p>
                        </div>
                    </div>

                    <div class="card mb-3" onclick="openItem()">
                        <div class="card-body">
                            <p>
                                <span> <b>Backlog : </b> Auth create and Test </span>
                                <span class="pull-right"> <b>Assigned Person : </b> AMK Khan </span>
                            </p>

                            <p>
                                <span> <b>Start Date</b> 12/12/90 </span>
                                <span> <b>End Date</b> 6/4/94 </span>
                            </p>
                        </div>
                    </div>

                </div>

            </div>

            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                {{-- Completed Backlog --}}
                <div class="">
                    <div class="card mb-3" onclick="openItem()">
                        <div class="card-body">
                            <p>
                                <span> <b>Backlog : </b> Auth create and Test </span>
                                <span class="pull-right"> <b>Assigned Person : </b> AMK Khan </span>
                            </p>

                            <p>
                                <span> <b>Start Date</b> 12/12/90 </span>
                                <span> <b>End Date</b> 6/4/94 </span>
                            </p>
                        </div>
                    </div>
                    <div class="card mb-3" onclick="openItem()">
                        <div class="card-body">
                            <p>
                                <span> <b>Backlog : </b> Auth create and Test </span>
                                <span class="pull-right"> <b>Assigned Person : </b> AMK Khan </span>
                            </p>

                            <p>
                                <span> <b>Start Date</b> 12/12/90 </span>
                                <span> <b>End Date</b> 6/4/94 </span>
                            </p>
                        </div>
                    </div>
                    <div class="card mb-3" onclick="openItem()">
                        <div class="card-body">
                            <p>
                                <span> <b>Backlog : </b> Auth create and Test </span>
                                <span class="pull-right"> <b>Assigned Person : </b> AMK Khan </span>
                            </p>

                            <p>
                                <span> <b>Start Date</b> 12/12/90 </span>
                                <span> <b>End Date</b> 6/4/94 </span>
                            </p>
                        </div>
                    </div>
                    <div class="card mb-3" onclick="openItem()">
                        <div class="card-body">
                            <p>
                                <span> <b>Backlog : </b> Auth create and Test </span>
                                <span class="pull-right"> <b>Assigned Person : </b> AMK Khan </span>
                            </p>

                            <p>
                                <span> <b>Start Date</b> 12/12/90 </span>
                                <span> <b>End Date</b> 6/4/94 </span>
                            </p>
                        </div>
                    </div>
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
                <div class="modal-body">


                    <form>
                        <div class="row mb-2">
                            <div class="col">
                                <label>Backlog Title</label>
                                <input type="text" class="form-control" placeholder="First name">
                            </div>
                            <div class="col">
                                <label>Assign Employee</label>
                                <select class="form-control">
                                    <option>Employee 1</option>
                                    <option>Employee 2</option>
                                    <option>Employee 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label>Backlog Start Date</label>
                                <input type="text" autocomplete="off" class="form-control datepicker" placeholder="Start Date" name="" required>
                            </div>
                            <div class="col">
                                <label>Backlog End Date</label>
                                <input type="text" autocomplete="off" class="form-control datepicker" placeholder="End Date" name="" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label>Priority</label>
                                <select class="form-control">
                                    <option>Low</option>
                                    <option>Medium</option>
                                    <option>High</option>
                                </select>
                            </div>
                            <div class="col">
                                <label>Backlog Details</label>
                                <textarea class="form-control" rows="3" placeholder="Details"></textarea>
                            </div>


                        </div>
                        {{--<div class="row mb-2">--}}
                            {{--<div class="col">--}}
                                {{--<button class="btn btn-success pull-right">Create</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </form>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    {{--<!-- Add Item Modal -->--}}
    {{--<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
        {{--<div class="modal-dialog modal-dialog-centered" role="document">--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<h5 class="modal-title" id="exampleModalLabel">Item Name</h5>--}}
                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                        {{--<span aria-hidden="true">&times;</span>--}}
                    {{--</button>--}}
                {{--</div>--}}
                {{--<div class="modal-body">--}}
                    {{--<form>--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="recipient-name" class="col-form-label">Recipient:</label>--}}
                            {{--<input type="text" class="form-control" id="recipient-name">--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="message-text" class="col-form-label">Message:</label>--}}
                            {{--<textarea class="form-control" id="message-text"></textarea>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
                {{--<div class="modal-footer">--}}
                    {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                    {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}


    {{--<div class="container-fluid">--}}

        {{--<div class="row" style="margin: 0 auto; width:100%;">--}}

            {{--<div class="m-3">--}}
                {{--<div class="card" style="width: 20rem;">--}}
                    {{--<div class="card-header text-white bg-dark">--}}
                        {{--Pending--}}
                    {{--</div>--}}
                    {{--<ul class="list-group list-group-flush">--}}
                        {{--<li class="list-group-item list-group-item-action" onclick="openItem()">Cras justo odio <span class="badge badge-pill badge-success">Rumi</span>  <span class="float-right text-white badge badge-dark" style="margin-top: 4px;">12:7:99</span> </li>--}}
                        {{--<li class="list-group-item list-group-item-action" onclick="openItem()">Dapibus ac facilisis in</li>--}}
                        {{--<li class="list-group-item list-group-item-action" onclick="openItem()">Vestibulum at eros <span class="badge badge-pill badge-success">Farzad</span> <span class="float-right text-white badge badge-dark" style="margin-top: 4px;">12:7:99</span> </li>--}}
                    {{--</ul>--}}
                    {{--<button class="btn btn-sm btn-success m-3" onclick="addItem()">Add</button>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="m-3">--}}
                {{--<div class="card" style="width: 20rem;">--}}
                    {{--<div class="card-header text-white bg-dark">--}}
                        {{--Doing--}}
                    {{--</div>--}}
                    {{--<ul class="list-group list-group-flush">--}}
                        {{--<li class="list-group-item list-group-item-action" onclick="openItem()">Cras justo odio</li>--}}
                        {{--<li class="list-group-item list-group-item-action" onclick="openItem()">Dapibus ac facilisis in</li>--}}
                        {{--<li class="list-group-item list-group-item-action" onclick="openItem()">Vestibulum at eros</li>--}}
                    {{--</ul>--}}
                    {{--<button class="btn btn-sm btn-success m-3" onclick="addItem()">Add</button>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="m-3">--}}
                {{--<div class="card" style="width: 20rem;">--}}
                    {{--<div class="card-header text-white bg-dark">--}}
                        {{--Done--}}
                    {{--</div>--}}
                    {{--<ul class="list-group list-group-flush">--}}
                        {{--<li class="list-group-item list-group-item-action" onclick="openItem()">Cras justo odio <span class="badge badge-pill badge-success">Rumi</span>  <span class="float-right text-white badge badge-dark" style="margin-top: 4px;">12:7:99</span> </li>--}}
                        {{--<li class="list-group-item list-group-item-action" onclick="openItem()">Dapibus ac facilisis in</li>--}}
                        {{--<li class="list-group-item list-group-item-action" onclick="openItem()">Vestibulum at eros <span class="badge badge-pill badge-success">Farzad</span> <span class="float-right text-white badge badge-dark" style="margin-top: 4px;">12:7:99</span> </li>--}}
                    {{--</ul>--}}
                    {{--<button class="btn btn-sm btn-success m-3" onclick="addItem()">Add</button>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="m-3">--}}
                {{--<div class="card" style="width: 20rem;">--}}
                    {{--<div class="card-header text-white bg-dark">--}}
                        {{--Testing--}}
                    {{--</div>--}}
                    {{--<ul class="list-group list-group-flush">--}}
                        {{--<li class="list-group-item list-group-item-action" onclick="openItem()">Cras justo odio</li>--}}
                        {{--<li class="list-group-item list-group-item-action" onclick="openItem()">Dapibus ac facilisis in</li>--}}
                        {{--<li class="list-group-item list-group-item-action" onclick="openItem()">Vestibulum at eros</li>--}}
                    {{--</ul>--}}
                    {{--<button class="btn btn-sm btn-success m-3" onclick="addItem()">Add</button>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="m-3">--}}
                {{--<div class="card" style="width: 20rem;">--}}
                    {{--<div class="card-header text-white bg-dark">--}}
                        {{--Test Done--}}
                    {{--</div>--}}
                    {{--<ul class="list-group list-group-flush">--}}
                        {{--<li class="list-group-item list-group-item-action" onclick="openItem()">Cras justo odio</li>--}}
                        {{--<li class="list-group-item list-group-item-action" onclick="openItem()">Dapibus ac facilisis in</li>--}}
                        {{--<li class="list-group-item list-group-item-action" onclick="openItem()">Vestibulum at eros</li>--}}
                    {{--</ul>--}}
                    {{--<button class="btn btn-sm btn-success m-3" onclick="addItem()">Add</button>--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--</div>--}}

    {{--</div>--}}

    {{--<script>--}}



        {{--function addItem(){--}}
            {{--$('#exampleModal2').modal('show');--}}
        {{--}--}}

    {{--</script>--}}


@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>

        function openItem(){
            $('#exampleModal').modal('show');
        }

        $(".datepicker").datepicker({
            orientation: "bottom"
        });

        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });


    </script>

@endsection

