@extends('layouts.mainLayout')
@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4>Update Company Info</h4>
        </div>
        <div class="card-body">
            <form method="post">
                {{csrf_field()}}
                <div class="row">
                    <input type="hidden" name="id" value="{{ $company->companyId }}">
                    <div class="form-group col-md-6">
                        <label>Company Name</label>
                        <input type="text" class="form-control" placeholder="Company Name" value="{{ $company->companyName }}" name="companyName" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Company Email</label>
                        <input type="email" class="form-control" placeholder="Email" value="{{ $company->companyEmail }}" name="companyEmail" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Phone 1</label>
                        <input type="tel" class="form-control" placeholder="Phone 1" value="{{ $company->companyPhone1 }}" name="companyPhone1">
                    </div>

                    @if($company->companyPhone2)
                        <div class="form-group col-md-6">
                            <label>Phone 2</label>
                            <input type="text" class="form-control" placeholder="Phone 2" value="{{ $company->companyPhone2 }}" name="companyPhone2">
                        </div>
                    @else
                        <div class="form-group col-md-6">
                            <label>Phone 2</label>
                            <input type="text" class="form-control" placeholder="Phone 2" value="" name="companyPhone2">
                        </div>
                    @endif

                    <div class="form-group col-md-12">
                        <label>Company Info</label>
                        <textarea  class="form-control" placeholder="Company Info" name="info" required>{{ $company->companyInfo }}</textarea>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Address</label>
                        <textarea  class="form-control" placeholder="Company Address" name="address" required>{{ $company->companyAddress }}</textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <button class="btn btn-success">Update Company</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection
