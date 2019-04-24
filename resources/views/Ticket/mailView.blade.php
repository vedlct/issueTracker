
<h3>New ticket has been created.</h3>

{{-- Issue Information --}}
<span> <b>Ticket ID : </b> </span> <a href="{{route('ticket.view',['id'=>$ticketId])}}">{{ $ticketNo }}</a>
<br>
<span><b>Ticket Topic : </b></span> {{ $ticketTopic }}
<br>
<span><b>Ticket Opener Name : </b></span> {{ $ticketOpenerName }}
<br>
<span><b>Ticket Priority : </b></span> {{ $priority }}
<br>
<span><b>Ticket Details : </b></span> {!!  $details  !!}

