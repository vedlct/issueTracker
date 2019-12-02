
<h1>New Issue reply.</h1>












<span> <b>Ticket ID : </b> </span> <a href="<?php echo e(route('ticket.view',['id'=>$ticketId])); ?>"><?php echo e($ticketNo); ?></a>
<br>
<spqn><b>Ticket Topic  : </b></spqn> <?php echo e($ticketTopic); ?>

<br>
<span><b>Ticket Opener : </b></span> <?php echo e($ticketOpner); ?>

<br>
<span><b>Replier : </b></span> <?php echo e($reply_user); ?>

<br>
<span><b>Reply : </b></span> <?php echo $reply; ?>

