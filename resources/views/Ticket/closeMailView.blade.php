
<h1>Ticket Close.</h1>

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
<span><b>Ticket Topic  : </b></span> {{ $ticketTopic }}
<br>
<span><b>Personal Note  : </b></span> {{ $personal_note }}

