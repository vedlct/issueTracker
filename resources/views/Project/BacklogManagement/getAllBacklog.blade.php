<div class="row">

    <div class="col-md-3">
        <ul class="list-group">
            <li class="list-group-item bg-secondary text-light text-center">Backlog</li>
            @foreach($backlogs->where('backlog_state', "Backlog") as $backlog)
                <li class="list-group-item" data-backlog-id= {{ $backlog->backlog_id }} onclick="openItem(this)">
                    <span> <b> {{ $backlog->backlog_title }} </b>  </span>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="col-md-3">
        <ul class="list-group">
            <li class="list-group-item bg-secondary text-light text-center">Doing</li>
            @foreach($backlogs->where('backlog_state', "Doing") as $backlog)
                <li class="list-group-item" data-backlog-id= {{ $backlog->backlog_id }} onclick="openItem(this)">
                    <span> <b> {{ $backlog->backlog_title }} </b>  </span>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="col-md-3">
        <ul class="list-group">
            <li class="list-group-item bg-secondary text-light text-center">Complete</li>
            @foreach($backlogs->where('backlog_state', "Complete") as $backlog)
                <li class="list-group-item" data-backlog-id= {{ $backlog->backlog_id }} onclick="openItem(this)">
                    <span> <b> {{ $backlog->backlog_title }} </b>  </span>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="col-md-3">
        <ul class="list-group">
            <li class="list-group-item bg-secondary text-light text-center">Testing</li>
            @foreach($backlogs->where('backlog_state', "Testing") as $backlog)
                <li class="list-group-item" data-backlog-id= {{ $backlog->backlog_id }} onclick="openItem(this)">
                    <span> <b> {{ $backlog->backlog_title }} </b>  </span>
                </li>
            @endforeach
        </ul>
    </div>

</div>


<!-- Item Details Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Backlog Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="backlog_details">



            </div>
        </div>
    </div>
</div>



@section('extra_js')

    <script>
        function openItem(x){

            id = $(x).data('backlog-id');
            console.log(id);

            $.ajax({
                type: 'POST',
                url: "{!! route('backlog.edit') !!}",
                cache: false,
                data: {
                    _token: "{{csrf_token()}}",
                    'backlog_id': id
                },
                success: function (data) {
                    $('#backlog_details').html(data);
                    $('#exampleModal').modal();
                }
            });
        }
    </script>

    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>--}}

    {{--<script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>--}}

    <script>


        $(".datepicker").datepicker({
            orientation: "bottom"
        });

        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });


    </script>

@endsection