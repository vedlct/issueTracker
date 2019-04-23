
<ul class="list-group">
    @if(count($owners) <= 0)
        <p>No owner assigned yet.</p>
    @else
        @foreach($owners as $owner)
            <li class="list-group-item"> <b> {{ $owner->fullName }} </b> </li>
        @endforeach
    @endif
</ul>