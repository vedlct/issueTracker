@extends('layouts.mainLayout')
@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4>Company Info</h4>
        </div>
        <div class="card-body">
            <form method="post">
                {{csrf_field()}}
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Company Name</label>
                        <input type="text" class="form-control" placeholder="Company Name" value="" name="companyName" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Company Email</label>
                        <input type="email" class="form-control" placeholder="Email" value="" name="companyEmail" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Phone 1</label>
                        <input type="tel" class="form-control" placeholder="Phone 1" value="" name="companyPhone1">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Phone 2</label>
                        <input type="text" class="form-control" placeholder="Phone 2" value="" name="companyPhone2">
                    </div>

                    <div class="form-group col-md-12">
                        <label>Company Summary</label>
                        <textarea  class="form-control" placeholder="Company Info" name="info" required></textarea>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Address</label>
                        <textarea  class="form-control" placeholder="Company Address" name="address" required></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <button class="btn btn-success">Create Company</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection
