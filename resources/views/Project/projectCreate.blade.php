@extends('layouts.mainLayout')
@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4>Create Project </h4>
            <h5><small>Project Information</small></h5>

        </div>
        <div class="card-body">
            <form method="post">
                {{csrf_field()}}
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Project Name</label>
                        <input type="text" class="form-control" placeholder="Project Name" value="" name="projectname" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Select Company</label>
                        <select class="form-control" name="companyId" required>
                            @foreach($companylist as $company)
                                <option value="{{ $company->companyId }}">{{ $company->companyName }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Project Start Date</label>
                        <input type="text" autocomplete="off" class="form-control datepicker" placeholder="Start Date" name="projectStartDate">
                    </div>


                    <div class="form-group col-md-4">
                        <label>Project Expected Duration</label>
                        <input type="text" class="form-control" placeholder="Enter Project Expected Duration" value="" name="duration">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Project Status</label>
                        <select class="form-control" name="status" required>
                            @foreach($statusAll as $status)
                                <option value="{{ $status->statusId }}">{{ $status->statusData }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Project Summary</label>
                        <textarea class="form-control" placeholder="Project Summary" name="summary"></textarea>
                    </div>

                    <div class="form-group col-md-12">
                        <button class="btn btn-success pull-right">Create Project</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection

@section('js')
    <script>
        $(".datepicker").datepicker({
            orientation: "bottom" // <-- and add this
        });
    </script>
@endsection
