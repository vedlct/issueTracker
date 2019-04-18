@extends('layouts.mainLayout')


@section('css')
    <style>
        .card{
            box-shadow: 1px 0 20px rgba(0, 0, 0, .09);
        }
    </style>
@endsection


@section('content')

    <div class="row ml-3">
        @foreach($projects as $project)

            <div class="card m-4" style="width: 20rem;">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $project->project_name }}</h5>

                    @foreach($allStatus as $status)
                        @if($project->project_status == $status->statusId)
                            <h6 class="card-subtitle mb-2 text-muted">Project Status : {{ $status->statusData }}</h6>

                            @if(Auth::user()->fk_userTypeId == 1)
                                <h6 style="font-weight: 300;" class="card-subtitle mt-4"> <b>Company :</b> {{ $project->companyName }}</h6>
                            @endif

                        @endif
                    @endforeach

                    <div class="mt-4" style="margin-right: 11px;">
                        <a href="{{ route('project.features', $project->projectId) }}" class="card-link">Summary</a>
                        <a href="{{ route('backlog.dashboard', $project->projectId) }}" class="card-link">Backlog</a>
                        <a href="{{ route('backlog.ganttChart', $project->projectId) }}" class="card-link">Timeline</a>
                    </div>

                </div>
            </div>

        @endforeach
    </div>

@endsection

@section('js')
    <script>

    </script>
@endsection

