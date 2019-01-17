@extends('layouts.mainLayout')
@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4>Open Ticket</h4>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Ticket Topic</label>
                        <input type="text" class="form-control" placeholder="Ticket Topic" value="" name="topic" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Ticket Priroty</label>
                        <select class="form-control" name="priroty" required>
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Ticket Details</label>
                        <textarea class="form-control" placeholder="Ticket Details" name="details" rows="5" required></textarea>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Select Project</label>
                        <select class="form-control" name="project" required>
                            @foreach($projectlist as $project)
                                <option value="{{ $project->projectId }}">{{ $project->projectName }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleFormControlFile1">Choose file</label>
                        <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">

                        {{--<label>Choose File</label>--}}
                        {{--<div class="input-group mb-3">--}}
                          {{--<div class="input-group-prepend">--}}
                            {{--<span class="input-group-text">Upload</span>--}}
                          {{--</div>--}}
                          {{--<div class="custom-file">--}}
                            {{--<input type="file" name="file" class="custom-file-input" id="inputGroupFile01">--}}
                            {{--<label class="custom-file-label" for="inputGroupFile01">Choose file</label>--}}
                          {{--</div>--}}
                        {{--</div>--}}

                    </div>

                    <div class="form-group col-md-12">
                        <button class="btn btn-success">Create Ticket</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection
