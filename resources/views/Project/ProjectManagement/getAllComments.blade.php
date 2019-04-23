
@if(count($comments) > 0)
    @foreach($comments as $comment)
        <div class="card">
            <div class="card-body" style="padding-bottom: 0px;">
                <p> <b>{{ $comment->fullName }} : </b> {{ $comment->comment }} </p>
            </div>
        </div>
    @endforeach
    <p></p>
@endif