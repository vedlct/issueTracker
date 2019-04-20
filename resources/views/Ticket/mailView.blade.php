
<h1>New Issue is created.</h1>

{{-- Issue Information --}}
<span> <b>Ticket ID : </b> </span> <a href="{{route('ticket.view',['id'=>$ticketId])}}">{{ $ticketNo }}</a>
<br>
<spqn><b>Ticket Opener Name : </b></spqn> {{ $ticketOpenerName }}
<br>
<span><b>Ticket Priority : </b></span> {{ $priority }}
<br>
<span><b>Ticket Details : </b></span> {!!  $details  !!}

