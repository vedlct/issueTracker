@extends('layouts.mainLayout')


@section('css')
    <style>
        .card{
            box-shadow: 1px 0 20px rgba(0, 0, 0, .09);
        }
    </style>
@endsection


@section('content')

    <div class="row">
        @foreach($projects as $project)

            <div class="card m-4" style="width: 16rem;">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $project->project_name }}</h5>

                    @foreach($allStatus as $status)
                        @if($project->project_status == $status->statusId)
                            <h6 class="card-subtitle mb-2 text-muted">Project Status : {{ $status->statusData }}</h6>
                        @endif
                    @endforeach

                    <div class="mt-4" style="margin-right: 11px;">
                        <a href="{{ route('project.projectmanagement', $project->projectId) }}" class="card-link">Dashboard</a>
                        <a href="{{ route('backlog.dashboard', $project->projectId) }}" class="card-link">My Backlog</a>
                    </div>

                </div>
            </div>

        @endforeach
    </div>

@endsection

@section('js')
    <script>

        {{--// Open Project--}}
        {{--function openProject(){--}}

            {{--// get all checked ticket id--}}
            {{--var chkArray = [];--}}
            {{--$('.checkboxvar:checked').each(function (i) {--}}
                {{--chkArray[i] = $(this).val();--}}
            {{--});--}}

            {{--// get team id--}}
            {{--var teamid = team.value;--}}

            {{--// console.log(chkArray);--}}

            {{--// Send Request--}}
            {{--$.ajax({--}}
                {{--type : 'post' ,--}}
                {{--url : '{{route('ticket.massAssignTicket.team')}}',--}}
                {{--data : {--}}
                    {{--_token: "{{csrf_token()}}",--}}
                    {{--'allCheckedTicket':chkArray,--}}
                    {{--'teamid':teamid,--}}
                {{--} ,--}}
                {{--success : function(data){--}}
                    {{--// console.log(data);--}}
                    {{--$.alert({--}}
                        {{--animationBounce: 2,--}}
                        {{--type: 'green',--}}
                        {{--title: 'Success!',--}}
                        {{--content: 'Selected Team Assigned.',--}}
                    {{--});--}}
                    {{--$('#selectDefault2').val('');--}}
                    {{--dataTable.ajax.reload();--}}
                {{--}--}}
            {{--});--}}
        {{--}--}}

    </script>
@endsection

