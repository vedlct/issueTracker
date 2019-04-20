@extends('layouts.mainLayout')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4>Update Project Information</h4>
        </div>

        <div class="card-body">
            <form method="post">
                {{csrf_field()}}
                <div class="row">

                    <div class="form-group col-md-4">
                        <label>Project Name</label>
                        <input type="text" class="form-control" placeholder="Project Name" value="{{ $project->project_name }}" name="projectname" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Select Company</label>
                        <select class="form-control" name="companyId">
                            @foreach($companylist as $company)
                                @if($project->fk_company_id == $company->companyId)
                                    <option value="{{ $company->companyId }}" selected>{{ $company->companyName }}</option>
                                @else
                                    <option value="{{ $company->companyId }}">{{ $company->companyName }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Project Expected Duration</label>
                        <input type="text" class="form-control" placeholder="Enter Project Expected Duration" value="{{ $project->project_duration }}" name="duration">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Project Status</label>
                        <select class="form-control" name="status" required>
                            @foreach($allStatus as $status)
                                @if($project->project_status == $status->statusId)
                                    <option value="{{ $status->statusId }}" selected>{{ $status->statusData }}</option>
                                @else
                                    <option value="{{ $status->statusId }}">{{ $status->statusData }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Project Summary</label>
                        <textarea class="form-control" placeholder="Project Summary" name="summary">{{ $project->project_summary }}</textarea>
                    </div>

                    <div class="form-group col-md-6">

                        <label>Select Client</label>
                        <select class="col-md-12 js-example-basic-multiple" name="clientList[]" multiple="multiple">
                            <option value="">Select Client</option>
                            @foreach($clients as $c)
                                <option value="{{$c->clientId}}" @if($assignedClients->where('clientId',$c->clientId)->count()>0) selected @endif>{{$c->fullName}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <button class="btn btn-success pull-right">Update Project</button>
                    </div>


                </div>
            </form>
        </div>

    </div>
</div>

@endsection
@section('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
        $(".datepicker").datepicker({
            orientation: "bottom" // <-- and add this
        });
    </script>
@endsection
