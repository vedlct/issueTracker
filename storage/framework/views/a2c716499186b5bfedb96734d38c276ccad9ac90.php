
<h1>New Issue is created.</h1>


<span> <b>Ticket ID : </b> </span> <a href="<?php echo e(route('ticket.view',['id'=>$ticketId])); ?>"><?php echo e($ticketNo); ?></a>
<br>
<spqn><b>Ticket Opener Name : </b></spqn> <?php echo e($ticketOpenerName); ?>

<br>
<span><b>Ticket Priority : </b></span> <?php echo e($priority); ?>

<br>
<span><b>Ticket Details : </b></span> <?php echo $details; ?>


