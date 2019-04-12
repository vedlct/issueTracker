@extends('layouts.mainLayout')

@section('css')

@endsection


@section('content')

    <div class="card">
        <div class="card-header">
            Profile Information
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>FullName</label>
                            <input type="text" class="form-control" name="fullname" placeholder="Fullname" value="{{ Auth::user()->fullName }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ Auth::user()->email }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password1" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="password2" class="form-control" placeholder="Confirm Password">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="tel" name="phone" class="form-control" placeholder="Phone" value="{{ Auth::user()->userPhoneNumber }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>profile Image</label>
                            <input type="file" name="profileImage" class="form-control">
                        </div>
                    </div>
                </div>


                <button type="submit" class="btn btn-success float-right">Update</button>
            </form>
        </div>
    </div>

@endsection




@section('js')

@endsection
