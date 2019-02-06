<form method="post" enctype="multipart/form-data" action="{{ route('ticket.update.details')  }}">
    @csrf
    <input type="hidden" name="ticket_id" value="{{ $ticket->ticketId }}">
    <h3 class="float-left font-weight-normal">Ticket Details</h3>
    <button class="float-right btn btn-success btn-sm" type="submit">Update</button>
    <div class="clearfix"></div>
    <textarea class="form-control" placeholder="Ticket Details" id="ckContents" name="details" rows="5" required> {{ $ticket->ticketDetails }} </textarea>
</form>


<script>
    var textarea = document.getElementById('ckContents');

    CKEDITOR.replace(textarea);
</script>
