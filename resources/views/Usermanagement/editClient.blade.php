@extends('layouts.mainLayout')

@section('css')

@endsection

@section('content')
    <div class="container-fluid">
        {{--  Basic Information --}}
        <div class="card">
            <div class="card-header bg-dark text-white custom-2">
                <h4 class="float-left font-weight-normal">Edit Client Information</h4>
            </div>

            <div class="card-body">

                <div class="">
                    <form method="post" action="{{ route('update.client.profile') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="userId" value="{{ $client->userId }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fullname</label>
                                    <input type="text" name="fullname" class="form-control" required placeholder="Fullname" value="{{ $client->fullName }}">
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password1" class="form-control" placeholder="Password">
                                </div>

                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="password2" class="form-control" placeholder="Confirm Password">
                                </div>

                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="tel" name="phone" class="form-control" value="{{ $client->userPhoneNumber }}" required placeholder="Phone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="email" name="email" class="form-control" required placeholder="example@gmail.com" value="{{ $client->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="company">Select Company</label>
                                    <select class="form-control" id="company" name="companyId" required>
                                        <option value="">Select Company</option>
                                        @foreach($companyList as $company)
                                            <option value="{{ $company->companyId }}" @if($company->companyId == $client->companyId) selected @endif>{{ $company->companyName }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Client Status</label>
                                    <select class="form-control" name="clientStatus" required>
                                        <option value="">Select Status</option>
                                        <option value="1"  @if($client->status == 1) selected @endif> Active </option>
                                        <option value="0"  @if($client->status == 0) selected @endif> Inactive </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="file1">Select Profile Photo</label>
                                    <input type="file" name="profilePhoto" class="form-control-file" id="file1">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Client Info</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')


@endsection
