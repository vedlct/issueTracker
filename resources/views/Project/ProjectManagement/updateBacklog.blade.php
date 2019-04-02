<form action="{{ route('backlog.update') }}" method="post">
    @csrf

    <div class="row">
        <div class="col">
            <button class="btn btn-success pull-right btn-sm">Update Backlog</button>
        </div>
    </div>

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
                <option value="Low" @if($backlog->backlog_priority == 'Low') selected @endif>Low</option>
                <option value="Medium" @if($backlog->backlog_priority == 'Medium') selected @endif>Medium</option>
                <option value="High" @if($backlog->backlog_priority == 'High') selected @endif>High</option>
            </select>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col">
            <label style="display: block">Assign Employee</label>
            <select class="js-example-basic-multiple form-control " name="assigned_employee[]" multiple="multiple" style="width: 100%;">
                @foreach($allEmp as $emp)
                     <option value="{{ $emp->userId }}" @if( $emp->userId == $backlogAssignedEmp->where('fk_assigned_employee_user_id', $emp->userId )->first()['fk_assigned_employee_user_id']) selected @endif>{{ $emp->fullName }}</option>
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

</form>


{{-- Comments --}}
<div id="comment">

</div>


{{-- Backlog Comment Form --}}
<div class="card mt-4">
    <div class="card-body" style="padding-bottom: 0px;">
        <div class="form-row">
            <div class="form-group col-md-10">
                <input type="text" id="commentData" class="form-control" placeholder="Your Comment...">
            </div>
            <div class="form-group col-md-2">
                <button onclick="post_comment()" class="btn btn-outline-success btn-block">Comment</button>
            </div>
        </div>
    </div>
</div>


<script>

    $(".datepicker").datepicker({
        orientation: "bottom",
        format: 'yyyy/mm/dd'
    });

    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();

        // Send request to load data
        $.ajax({
            type: 'POST',
            url: "{!! route('backlog.comment.get') !!}",
            cache: false,
            data: {
                _token: "{{csrf_token()}}",
                'backlog_id': "{{ $backlog->backlog_id }}"
            },
            success: function (data) {
                $('#comment').html(data);
            }
        });

    });

    function loadComments(){
        $.ajax({
            type: 'POST',
            url: "{!! route('backlog.comment.get') !!}",
            cache: false,
            data: {
                _token: "{{csrf_token()}}",
                'backlog_id': "{{ $backlog->backlog_id }}"
            },
            success: function (data) {
                $('#comment').html(data);
            }
        });
    }

    // Send request to post a comment
    function post_comment(){
        var comment = $("#commentData").val();

        $.ajax({
            type: 'POST',
            url: "{!! route('backlog.comment.post') !!}",
            cache: false,
            data: {
                _token: "{{csrf_token()}}",
                'comment' : comment,
                'backlog_id': "{{ $backlog->backlog_id }}",
                'user_id' : "{{ Auth::user()->userId }}",
            },
            success: function (data) {
                $('#commentData').val('');
                // load comment after request
                loadComments();
            }
        });
    }

    var wage = document.getElementById("commentData");
    wage.addEventListener("keydown", function (e) {
        if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
            post_comment();
        }
    });

</script>


{{-- CK Editor --}}
<script>
    $( document ).ready(function() {

        ClassicEditor
            .create( document.querySelector( '#editor2' ) )
            .then( editor => {

            } )
            .catch( error => {
                console.error( error );
            } );
    });
</script>