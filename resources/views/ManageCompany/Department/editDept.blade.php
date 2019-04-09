

<form method="post" action="{{ route('dept.update') }}">
    {{csrf_field()}}
    <div class="row">
        <input type="hidden" name="id" value="{{ $department->dept_id }}">
        <div class="form-group col-md-12">
            <label>Department Name</label>
            <input type="text" class="form-control" placeholder="Department Name" value="{{ $department->dept_name }}" name="name" required>
        </div>

        <div class="form-group col-md-12">
            <label>Department Info</label>
            <textarea  class="form-control" placeholder="Department Info" name="info" required>{{ $department->dept_info }}</textarea>
        </div>
        <div class="form-group col-md-12">
            <button type="submit" class="btn btn-success">Save Changes</button>
        </div>
    </div>
</form>
