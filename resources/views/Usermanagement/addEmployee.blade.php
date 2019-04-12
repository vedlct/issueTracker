@extends('layouts.mainLayout')

@section('css')

@endsection

@section('content')
    <div class="container-fluid">
        {{--  Basic Information --}}
        <div class="card">
            <div class="card-header bg-dark text-white custom-2">
                <h4 class="float-left font-weight-normal">Add New Employee</h4>
            </div>

            <div class="card-body">

                <div class="">
                    <form method="post" action="{{ route('employee.insert') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fullname</label>
                                    <input type="text" name="fullname" class="form-control" required placeholder="Fullname">
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password1" class="form-control" required placeholder="Password">
                                </div>

                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="password2" class="form-control" required placeholder="Confirm Password">
                                </div>

                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="tel" name="phone" class="form-control" placeholder="Phone">
                                </div>

                                <div class="form-group">
                                    <label for="file1">Select Profile Photo</label>
                                    <input type="file" name="profilePhoto" class="form-control-file" id="file1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="email" name="email" class="form-control" required placeholder="example@gmail.com">
                                </div>
                                <div class="form-group">
                                    <label for="company">Select Company</label>
                                    <select class="form-control" id="company" name="companyId" required>
                                        <option value="">Select Company</option>
                                        @foreach($companyList as $company)
                                            <option value="{{ $company->companyId }}">{{ $company->companyName }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="company">Select Designation</label>
                                    <select class="form-control" id="desg" name="designation">
                                        <option value="">Select Designation</option>
                                        @foreach($designations as $designation)
                                            <option value="{{ $designation->designation_id }}">{{ $designation->designation_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="company">Select Department</label>
                                    <select class="form-control" id="" name="dept">
                                        <option value="">Select Department</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->dept_id }}">{{ $department->dept_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Employee</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')


@endsection
