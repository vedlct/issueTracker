<div class="row">

    <div class="col-md-3">
        <ul class="list-group">
            <li class="list-group-item bg-primary text-light text-center">Planned</li>
            @foreach($backlogs->where('backlog_state', "Planned") as $backlog)
                <li class="list-group-item changeMouse" data-backlog-id= {{ $backlog->backlog_id }} onclick="openItem(this)">
                    <div class="row">
                        <div class="col-md-12">
                            <b>Task : </b>{{ $backlog->backlog_title }}
                        </div>

                    </div>
                    <div style="margin-bottom: 10px;">
                        <b>End Date : </b> {{$backlog->backlog_end_date}}
                    </div>

                    @foreach($backlogassignedEmp->where('fk_backlog_id', $backlog->backlog_id) as $emp)
                        @if(Auth::user()->userId == $emp->userId)
                            <div class="badge badge-success mr-1" style="color: #0a1832;font-size: 13px;font-weight: 300;">My Backlog</div>
                        @else
                            <div class="badge mr-1" style="color: #0a1832; background-color: #61BD4F; font-size: 13px;font-weight: 300;">{{ $emp->fullName }}</div>
                        @endif
                    @endforeach

                </li>
            @endforeach
        </ul>
    </div>

    <div class="col-md-3">
        <ul class="list-group">
            <li class="list-group-item bg-secondary text-light text-center">Ongoing</li>
            {{--@foreach($backlogs->where('backlog_state', "Ongoing") as $backlog)--}}
                {{--<li class="list-group-item changeMouse" data-backlog-id= {{ $backlog->backlog_id }} onclick="openItem(this)">--}}
                    {{--<span> <b> {{ $backlog->backlog_title }} </b>  </span>--}}

                    {{--@foreach($backlogassignedEmp->where('fk_backlog_id', $backlog->backlog_id) as $emp)--}}
                        {{--@if(Auth::user()->userId == $emp->userId)--}}
                            {{--<span class="badge badge-dark pull-right">My Backlog</span>--}}
                        {{--@endif--}}
                    {{--@endforeach--}}

                {{--</li>--}}
            {{--@endforeach--}}


            @foreach($backlogs->where('backlog_state', "Ongoing") as $backlog)
                <li class="list-group-item changeMouse" data-backlog-id= {{ $backlog->backlog_id }} onclick="openItem(this)">
                    <div class="row">
                        <div class="col-md-12">
                            <b>Task : </b>{{ $backlog->backlog_title }}
                        </div>

                    </div>
                    <div style="margin-bottom: 10px;">
                        <b>End Date : </b> {{$backlog->backlog_end_date}}
                    </div>

                    @foreach($backlogassignedEmp->where('fk_backlog_id', $backlog->backlog_id) as $emp)
                        @if(Auth::user()->userId == $emp->userId)
                            <div class="badge badge-success mr-1" style="color: #0a1832;font-size: 13px;font-weight: 300;">My Backlog</div>
                        @else
                            <div class="badge mr-1" style="color: #0a1832; background-color: #61BD4F; font-size: 13px;font-weight: 300;">{{ $emp->fullName }}</div>
                        @endif
                    @endforeach

                </li>
            @endforeach


        </ul>
    </div>

    <div class="col-md-2">
        <ul class="list-group">
            <li class="list-group-item bg-warning text-light text-center" style="background-color: #8e44ad !important;">Code Done</li>
            {{--@foreach($backlogs->where('backlog_state', "Code Done") as $backlog)--}}
                {{--<li class="list-group-item changeMouse" data-backlog-id= {{ $backlog->backlog_id }} onclick="openItem(this)">--}}
                    {{--<span> <b> {{ $backlog->backlog_title }} </b>  </span>--}}

                    {{--@foreach($backlogassignedEmp->where('fk_backlog_id', $backlog->backlog_id) as $emp)--}}
                        {{--@if(Auth::user()->userId == $emp->userId)--}}
                            {{--<span class="badge badge-dark pull-right">My Backlog</span>--}}
                        {{--@endif--}}
                    {{--@endforeach--}}

                {{--</li>--}}
            {{--@endforeach--}}

            @foreach($backlogs->where('backlog_state', "Code Done") as $backlog)
                <li class="list-group-item changeMouse" data-backlog-id= {{ $backlog->backlog_id }} onclick="openItem(this)">
                    <div class="row">
                        <div class="col-md-12">
                            <b>Task : </b>{{ $backlog->backlog_title }}
                        </div>

                    </div>
                    <div style="margin-bottom: 10px;">
                        <b>End Date : </b> {{$backlog->backlog_end_date}}
                    </div>

                    @foreach($backlogassignedEmp->where('fk_backlog_id', $backlog->backlog_id) as $emp)
                        @if(Auth::user()->userId == $emp->userId)
                            <div class="badge badge-success mr-1" style="color: #0a1832;font-size: 13px;font-weight: 300;">My Backlog</div>
                        @else
                            <div class="badge mr-1" style="color: #0a1832; background-color: #61BD4F; font-size: 13px;font-weight: 300;">{{ $emp->fullName }}</div>
                        @endif
                    @endforeach

                </li>
            @endforeach

        </ul>
    </div>

    <div class="col-md-2">
        <ul class="list-group">
            <li class="list-group-item bg-danger text-light text-center">Testing</li>
            {{--@foreach($backlogs->where('backlog_state', "Testing") as $backlog)--}}
                {{--<li class="list-group-item changeMouse" data-backlog-id= {{ $backlog->backlog_id }} onclick="openItem(this)">--}}
                    {{--<span> <b> {{ $backlog->backlog_title }} </b>  </span>--}}

                    {{--@foreach($backlogassignedEmp->where('fk_backlog_id', $backlog->backlog_id) as $emp)--}}
                        {{--@if(Auth::user()->userId == $emp->userId)--}}
                            {{--<span class="badge badge-dark pull-right">My Backlog</span>--}}
                        {{--@endif--}}
                    {{--@endforeach--}}

                {{--</li>--}}
            {{--@endforeach--}}

            @foreach($backlogs->where('backlog_state', "Testing") as $backlog)
                <li class="list-group-item changeMouse" data-backlog-id= {{ $backlog->backlog_id }} onclick="openItem(this)">
                    <div class="row">
                        <div class="col-md-12">
                            <b>Task : </b>{{ $backlog->backlog_title }}
                        </div>

                    </div>
                    <div style="margin-bottom: 10px;">
                        <b>End Date : </b> {{$backlog->backlog_end_date}}
                    </div>

                    @foreach($backlogassignedEmp->where('fk_backlog_id', $backlog->backlog_id) as $emp)
                        @if(Auth::user()->userId == $emp->userId)
                            <div class="badge badge-success mr-1" style="color: #0a1832;font-size: 13px;font-weight: 300;">My Backlog</div>
                        @else
                            <div class="badge mr-1" style="color: #0a1832; background-color: #61BD4F; font-size: 13px;font-weight: 300;">{{ $emp->fullName }}</div>
                        @endif
                    @endforeach

                </li>
            @endforeach
        </ul>
    </div>

    <div class="col-md-2">
        <ul class="list-group">
            <li class="list-group-item bg-success text-light text-center">Complete</li>
            {{--@foreach($backlogs->where('backlog_state', "Complete") as $backlog)--}}
                {{--<li class="list-group-item changeMouse" data-backlog-id= {{ $backlog->backlog_id }} onclick="openItem(this)">--}}
                    {{--<span> <b> {{ $backlog->backlog_title }} </b>  </span>--}}

                    {{--@foreach($backlogassignedEmp->where('fk_backlog_id', $backlog->backlog_id) as $emp)--}}
                        {{--@if(Auth::user()->userId == $emp->userId)--}}
                            {{--<span class="badge badge-dark pull-right">My Backlog</span>--}}
                        {{--@endif--}}
                    {{--@endforeach--}}

                {{--</li>--}}
            {{--@endforeach--}}
            @foreach($backlogs->where('backlog_state', "Complete") as $backlog)
                <li class="list-group-item changeMouse" data-backlog-id= {{ $backlog->backlog_id }} onclick="openItem(this)">
                    <div class="row">
                        <div class="col-md-12">
                            <b>Task : </b>{{ $backlog->backlog_title }}
                        </div>

                    </div>
                    <div style="margin-bottom: 10px;">
                        <b>End Date : </b> {{$backlog->backlog_end_date}}
                    </div>

                    @foreach($backlogassignedEmp->where('fk_backlog_id', $backlog->backlog_id) as $emp)
                        @if(Auth::user()->userId == $emp->userId)
                            <div class="badge badge-success mr-1" style="color: #0a1832;font-size: 13px;font-weight: 300;">My Backlog</div>
                        @else
                            <div class="badge mr-1" style="color: #0a1832; background-color: #61BD4F; font-size: 13px;font-weight: 300;">{{ $emp->fullName }}</div>
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