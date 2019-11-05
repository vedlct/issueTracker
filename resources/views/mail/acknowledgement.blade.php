<h3>New project proposal created.</h3><br><br>
<p>Proposal title - {{$info->projectname}}</p>
@if(!empty($info->clientname))
<p>Client name - {{$info->clientname}}</p>@endif
@if(!empty($info->duration))
<p>Duration - {{$info->duration}}</p>
@endif
@if(count($info->feature)>0)
    <p>Features - </p>
    <ul>
        @foreach($info->feature as $feature)
            @if(!empty($feature))
                <li>{{$feature}}</li>
            @endif
        @endforeach
    </ul>
@endif
