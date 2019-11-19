
<form method="post" action="{{ route('client.update.contactPerson') }}">
    @csrf
    <input type="hidden" value="{{ $user->userId }}" name="userId">
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Full Name *</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="name" value="{{ $user->fullName }}" placeholder="name" required>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Email</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="email" value="{{ $user->email }}" placeholder="mail@gmail.com">
        </div>
    </div>
{{--    <div class="form-group row">--}}
{{--        <label class="col-sm-3 col-form-label">Password</label>--}}
{{--        <div class="col-sm-9">--}}
{{--            <input type="password" class="form-control" name="Password" placeholder="password" >--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="form-group row">--}}
{{--        <label class="col-sm-3 col-form-label">Confirm Password</label>--}}
{{--        <div class="col-sm-9">--}}
{{--            <input type="password" class="form-control" name="Confirm_Password" placeholder="confirm password">--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Phone</label>
        <div class="col-sm-9">
            <input type="number" class="form-control" name="phone" value="{{ $user->userPhoneNumber }}" placeholder="017*****">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Profile Photo</label>
        <div class="col-sm-9">
            <input type="file" class="form-control" name="profilePhoto">
        </div>
    </div>

    {{--<img src="{{url('public/files/profileImage/' . $user->profilePhoto }}" alt="user" class="rounded-circle">--}}

    <div class="form-group row">
        <div class="col-sm-12">
            <button type="submit" class="btn btn-primary pull-right">Update Contact Person</button>
        </div>
    </div>
</form>
