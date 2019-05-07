
    <div class="form-group row">
        <div class="col-12">
            <input class="form-control" type="text" value="{{ $req->company_name }}" placeholder="Name" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-12">
            <input class="form-control" type="text" value="{{ $req->company_url }}" placeholder="Company URL" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-12">
            <input class="form-control" type="email" name="email" value="{{ $req->company_email }}" placeholder="Email">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-12">
            <input class="form-control" type="tel" name="phone" value="{{ $req->company_phone }}" placeholder="Phone">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-12">
            <textarea class="form-control" rows="3" placeholder="Company Address">{{ $req->address }}</textarea>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-12">
            <textarea class="form-control"  rows="3" placeholder="Additional Information">{{ $req->additional_info }}</textarea>
        </div>
    </div>
