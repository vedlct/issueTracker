<form action="{{ route('backlog.update') }}" method="post">
    @csrf
    <div class="row mb-2">
        <input type="hidden" name="backlog_id" value="{{ $backlog->backlog_id }}">
        <div class="col">
            <label>Backlog Title</label>
            <input type="text" class="form-control" value="{{ $backlog->backlog_title }}" placeholder="Backlog Title" name="backlog_title" required>
        </div>
        <div class="col">
            <label>Priority</label>
            <select class="form-control" name="priority" required>
                <option value="">Select Priority</option>
                <option value="Low" @if($backlog->backlog_priority = 'Low') selected @endif>Low</option>
                <option value="Medium" @if($backlog->backlog_priority = 'Medium') selected @endif>Medium</option>
                <option value="High" @if($backlog->backlog_priority = 'High') selected @endif>High</option>
            </select>
        </div>
    </div>


    <div class="row mb-2">
        <div class="col">
            <label style="display: block">Assign Employee</label>
            <select class="js-example-basic-multiple form-control " name="assigned_employee[]" multiple="multiple" style="width: 100%;">
                @foreach($allEmp as $emp)
                    {{--@foreach($backlogAssignedEmp as $selectedEmp)--}}
                        <option value="{{ $emp->userId }}" @if( $emp->userId == $backlogAssignedEmp->where('fk_assigned_employee_user_id', $emp->userId )->first()['fk_assigned_employee_user_id']) selected @endif>{{ $emp->fullName }}</option>
                    {{--@endforeach--}}
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col">
            <label>Backlog Start Date</label>
            <input type="text" id="startDate" value="{{ $backlog->backlog_start_date }}" autocomplete="off" class="form-control datepicker" placeholder="Start Date" name="startdate">
        </div>
        <div class="col">
            <label>Backlog End Date</label>
            <input type="text" id="endDate" value="{{ $backlog->backlog_end_date }}" autocomplete="off" class="form-control datepicker" placeholder="End Date" name="enddate">
        </div>
    </div>
    <div class="row mb-2">
        <div class="col">
            <label>Backlog Details</label>
            <textarea id="editor2" rows="3" placeholder="Backlog Details" name="backlogDetails">{{ $backlog->backlog_details }}</textarea>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button class="btn btn-primary pull-right">Update Backlog</button>
        </div>
    </div>
</form>


{{--<script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>--}}

<script>

    $(".datepicker").datepicker({
        orientation: "bottom",
        format: 'yyyy/mm/dd'
    });

    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });

</script>

{{-- CK Editor --}}
<script>

    $( document ).ready(function() {

        ClassicEditor
            .create( document.querySelector( '#editor2' ) )
            .then( editor => {
                // console.log( editor );
                // width = '75%';

            } )
            .catch( error => {
                console.error( error );
            } );

    });


</script>