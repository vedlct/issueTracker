<form action="{{ route('backlog.update.details') }}" method="post">
    @csrf

    <input type="hidden" name="backlog_id" value="{{ $backlog->backlog_id }}">

    <div class="row mb-3">
        <div class="col-6">
            <label>Change Backlog State</label>
            <select class="form-control pull-right" name="backlog_state" id="backlog_state" required>
                <option value="Planned" @if($backlog->backlog_state == 'Planned') selected @endif>Planned</option>
                <option value="Ongoing" @if($backlog->backlog_state == 'Ongoing') selected @endif>Ongoing</option>
                <option value="Pause" @if($backlog->backlog_state == 'Pause') selected @endif>Pause</option>
                <option value="Code Done" @if($backlog->backlog_state == 'Code Done') selected @endif>Code Done</option>
                <option value="Testing" @if($backlog->backlog_state == 'Testing') selected @endif>Testing</option>
                <option value="Complete" @if($backlog->backlog_state == 'Complete') selected @endif>Complete</option>
            </select>
        </div>
        <div class="col-6" @if($backlog->backlog_state != 'Ongoing') style="display: none;" @endif id="changeState">
            <label>Hour</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="backLogHour">
                <div class="input-group-append">
                    <a href="JavaScript:void(0)" class="btn btn-outline-secondary" type="button" style="color: #0a1832" id="backLogContinue" backlog_id="{{ $backlog->backlog_id }}">Continue</a>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-sm table-bordered">
        <tbody>
            <tr style="line-height: .5;">
                <th scope="row">Backlog Title</th>
                <td>{{ $backlog->backlog_title }}</td>
            </tr>
            <tr style="line-height: .5;">
                <th scope="row">Select Priority</th>
                <td>{{ $backlog->backlog_priority }}</td>
            </tr>
            <tr style="line-height: .5;">
                <th scope="row">Backlog Start Date</th>
                <td>{{ $backlog->backlog_start_date }}</td>
            </tr>
            <tr style="line-height: .5;">
                <th scope="row">Backlog End Date</th>
                <td>{{ $backlog->backlog_end_date }}</td>
            </tr>
            <tr style="line-height: .5;">
                <th scope="row">Backlog Expected Time</th>
                <td>{{ $backlog->backlog_time }}</td>
            </tr>
            <tr style="line-height: .5;">
                <th scope="row">Backlog Dev Time</th>
                <td>{{ $backlog->dev_time }}</td>
            </tr>
            <tr style="line-height: .5;">
                <th scope="row">Remark</th>
                <td style="padding: 2px;"><input class="form-control" type="text" value="{{ $backlog->remark }}" placeholder="Remark" name="remark"> </td>
            </tr>
        </tbody>
    </table>

    <div class="row mb-2 mt-3">
        <div class="col">
            <label>Backlog Details</label>
            <textarea id="ckContents" rows="3" placeholder="Backlog Details" name="backlogDetails">{{ $backlog->backlog_details }}</textarea>
        </div>
    </div>

    <div class="row">
        <div class="col" style="margin-bottom: 10px;">
            <button class="btn btn-success pull-right btn-sm">Save Backlog</button>
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

    $("#backlog_state").change(function() {
        if($("#backlog_state").val() == 'Ongoing') {
            $("#changeState").show();
            $("#backLogHour").prop('disabled', false);
        }else{
            $("#changeState").hide();
            $("#backLogHour").prop('disabled', true);
        }
    });

    $("#backLogContinue").click(function () {
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
        if($("#backLogHour").val() == '' || !numberRegex.test($("#backLogHour").val())) {
            $.alert({
                title: 'Alert!',
                type: 'red',
                content: 'Please check hour',
                buttons: {
                    tryAgain: {
                        text: 'Ok',
                        btnClass: 'btn-blue'
                    }
                }
            });
        }else{
            $.ajax({
                type: 'POST',
                url: "{!! route('backlog.continue') !!}",
                cache: false,
                data: {
                    _token: "{{csrf_token()}}",
                    'backlog_id': "{{ $backlog->backlog_id }}",
                    'hour': $("#backLogHour").val()
                },
                success: function () {
                    $.alert({
                        title: 'Success',
                        type: 'green',
                        content: 'Time saved successfully.',
                        buttons: {
                            tryAgain: {
                                text: 'Ok',
                                btnClass: 'btn-blue'
                            }
                        }
                    });
                }
            });
        }
    });

    $(".datepicker").datepicker({
        orientation: "bottom",
        format: 'yyyy/mm/dd'
    });

    $(document).ready(function() {

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


    {{-- CK Editor --}}
    var textarea = document.getElementById('ckContents');

    CKEDITOR.replace(textarea);

</script>
