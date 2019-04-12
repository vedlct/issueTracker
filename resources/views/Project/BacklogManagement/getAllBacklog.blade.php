<div class="row">

    <div class="col-md-3">
        <ul class="list-group ml-3">
            <li class="list-group-item bg-secondary text-light text-center">Backlog</li>
            @foreach($backlogs->where('backlog_state', "Backlog") as $backlog)
                <li class="list-group-item" data-backlog-id= {{ $backlog->backlog_id }} onclick="openItem(this)">
                    <span> <b> {{ $backlog->backlog_title }} </b>  </span>

                    @foreach($backlogassignedEmp->where('fk_backlog_id', $backlog->backlog_id) as $emp)
                        @if(Auth::user()->userId == $emp->userId)
                            <span class="badge badge-dark pull-right">My Backlog</span>
                        @endif
                    @endforeach

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

                    @foreach($backlogassignedEmp->where('fk_backlog_id', $backlog->backlog_id) as $emp)
                        @if(Auth::user()->userId == $emp->userId)
                            <span class="badge badge-dark pull-right">My Backlog</span>
                        @endif
                    @endforeach

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

                    @foreach($backlogassignedEmp->where('fk_backlog_id', $backlog->backlog_id) as $emp)
                        @if(Auth::user()->userId == $emp->userId)
                            <span class="badge badge-dark pull-right">My Backlog</span>
                        @endif
                    @endforeach

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

                    @foreach($backlogassignedEmp->where('fk_backlog_id', $backlog->backlog_id) as $emp)
                        @if(Auth::user()->userId == $emp->userId)
                            <span class="badge badge-dark pull-right">My Backlog</span>
                        @endif
                    @endforeach

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
                {{--<h5 class="modal-title" id="exampleModalLabel">Backlog Title</h5>--}}
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


@endsection