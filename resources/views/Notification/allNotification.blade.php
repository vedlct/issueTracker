@extends('layouts.mainLayout')


@section('content')

    <div class="container">
        <ul class="list-group">
            @foreach($allNotification as $notification)
                <li class="list-group-item ">
                    You are assigned to a new Task: {{ $notification->backlog_title }}.
                    <span class="pull-right">{{ $notification->assigned_time }}</span>
                </li>
            @endforeach
        </ul>
    </div>

@endsection


@section('foot-js')

@endsection