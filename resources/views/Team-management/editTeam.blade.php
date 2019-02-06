@extends('layouts.mainLayout')
@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4>Edit Team</h4>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="teamId" value="{{ $team->teamId }}">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Team Name</label>
                            <input type="text" class="form-control" placeholder="Team Name" value="{{ $team->teamName }}" name="teamName" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Company</label>
                            <select class="form-control" name="companyId" required>
                                <option value="">Select Company</option>
                                @foreach($companyList as $company)
                                    <option value="{{ $company->companyId }}" @if($company->companyId == $team->fk_companyId) selected @endif>{{ $company->companyName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

{{--@section('js')--}}
    {{--<script type="text/javascript" src="{{ url('/public/ck/ckeditor/ckeditor.js')}}"></script>--}}
{{--@endsection--}}
