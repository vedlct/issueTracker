
<a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
    <i class="mdi mdi-bell-outline noti-icon"></i>
    <span class="badge badge-danger noti-icon-badge">{{ count($myNotification) }}</span>
</a>

<div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg">

        <!-- Count-->
        <div class="dropdown-item noti-title">
            <h5>Notification ({{ count($myNotification) }})</h5>
        </div>

        <!-- Unseen Notification-->
        <span>
            @foreach($myNotification as $notification)
                <a href="javascript:void(0);" class="dropdown-item notify-item hover_me" style="padding-bottom: 23px;">
                    <div class="notify-icon bg-success"><i class="mdi mdi-bell-ring-outline"></i></div>

                    <p class="notify-details"> <small class="text-muted">You are assigned to Task: {{ $notification->backlog_title }}.</small> </p>

                </a>
             @endforeach
         </span>

        <!-- All-->
        <a href="{{ route('show.allNotification') }}" class="dropdown-item notify-item">
            View All
        </a>

</div>