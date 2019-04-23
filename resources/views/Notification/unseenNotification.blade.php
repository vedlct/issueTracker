

        <!-- Unseen Notification-->
        {{--<span>--}}
            @foreach($myNotificationOld as $notification)
                <a href="javascript:void(0);" class="dropdown-item notify-item hover_me" style="padding-bottom: 23px;">
                    <div class="notify-icon bg-success"><i class="mdi mdi-bell-ring-outline"></i></div>

                    <p class="notify-details"> <small class="text-muted">You are assigned to Task: {{ $notification->backlog_title }}.</small> </p>

                </a>
             @endforeach
         {{--</span>--}}

