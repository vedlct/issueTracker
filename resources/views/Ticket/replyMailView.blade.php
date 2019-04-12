
<h1>New Issue reply.</h1>

{{-- Issue Information --}}
{{--Ticket Topic - {{ $ticketTopic }}--}}
{{--<br>--}}
{{--Ticket Opener - {{ $ticketOpner }}--}}
{{--<br>--}}
{{--Replier - {{ $reply_user }}--}}
{{--<br>--}}
{{--Reply - {!!  $reply  !!}--}}
{{--<br>--}}


<span> <b>Ticket ID : </b> </span> <a href="{{route('ticket.view',['id'=>$ticketId])}}">{{ $ticketNo }}</a>
<br>
<spqn><b>Ticket Topic  : </b></spqn> {{ $ticketTopic }}
<br>
<span><b>Ticket Opener : </b></span> {{ $ticketOpner }}
<br>
<span><b>Replier : </b></span> {{ $reply_user }}
<br>
<span><b>Reply : </b></span> {!!  $reply  !!}
