
<ul class="list-group">
    @foreach($comments as $comment)
        <li class="list-group-item"> <b>{{ $comment->fullName }} : </b> {{ $comment->comment }}</li>
    @endforeach
</ul>