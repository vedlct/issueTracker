
<form method="post" action="{{ route('designation.update') }}">
    {{csrf_field()}}
    <div class="row">
        <input type="hidden" name="id" value="{{ $desg->designation_id }}">
        <div class="form-group col-md-12">
            <label>Department Name</label>
            <input type="text" class="form-control" placeholder="Department Name" value="{{ $desg->designation_name }}" name="name" required>
        </div>

        <div class="form-group col-md-12">
            <button type="submit" class="btn btn-success pull-right">Save Changes</button>
        </div>
    </div>
</form>
