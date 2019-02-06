@extends('layouts.mainLayout')
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
                    <div class="form-group col-md-6">
                        <label>Project Name</label>
                        <input type="text" class="form-control" placeholder="Project Name" value="{{ $project->projectName }}" name="projectname" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Select Company</label>
                        <select class="form-control" name="companyId" required>
                            @foreach($companylist as $company)
                                @if($project->fk_companyId == $company->companyId)
                                    <option value="{{ $company->companyId }}" selected>{{ $company->companyName }}</option>
                                @else
                                    <option value="{{ $company->companyId }}">{{ $company->companyName }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Project Expected Duration</label>
                        <input type="text" required value="{{ $project->projectDuration }}" class="form-control" placeholder="Enter Project Expected Duration" value="" name="duration">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Project Status</label>
                        <select class="form-control" name="status" required>
                            <!-- <option value="1" @if( $project->projectStatus == '1' ) selected @endif> Open </option>
                            <option value="2" @if( $project->projectStatus == '2' ) selected @endif> Pending </option>
                            <option value="3" @if( $project->projectStatus == '3' ) selected @endif> Running </option> -->

                            @foreach($allStatus as $status)
                                @if($project->projectStatus == $status->statusId)
                                    <option value="{{ $status->statusId }}" selected>{{ $status->statusData }}</option>
                                @else
                                    <option value="{{ $status->statusId }}">{{ $status->statusData }}</option>
                                @endif
                            @endforeach


                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Project Summary</label>
                        <textarea class="form-control" placeholder="Project Summary" name="summary" required>{{ $project->projectSummary }}</textarea>
                    </div>

                    <div class="form-group col-md-12">
                        <button class="btn btn-success">Create Project</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
