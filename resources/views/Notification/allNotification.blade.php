@extends('layouts.mainLayout')


@section('content')

    <div class="container">
        <h3 style="font-weight: 300; margin-bottom: 20px;">Notifications</h3>
        <hr>
        <ul class="list-group">
            @if(count($allNotification) == 0)
                <p>No new message</p>
            @else
                @foreach($allNotification as $notification)
                    <li class="list-group-item ">
                        You are assigned to a new Backlog: {{ $notification->backlog_title }}.
                        <span class="pull-right">{{ $notification->assigned_time }}</span>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>

@endsection


@section('foot-js')

@endsection