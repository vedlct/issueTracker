@extends('layouts.mainLayout')


@section('css')
    <style>
        .card{
            box-shadow: 1px 0 20px rgba(0, 0, 0, .09);
        }
        .changeMouse {
            cursor: pointer;
        }
    </style>
@endsection


@section('content')

    <div class="card">
        <div class="card-header bg-dark text-center" style="color: white">
            {{ $project->project_name }}
        </div>
        <div class="card-body p-1 mt-2 mb-3">
            <div id="backlog_panel"></div>
        </div>
    </div>

@endsection

@section('js')

    <script type="text/javascript" src="{{ url('/public/ck/ckeditor/ckeditor.js')}}"></script>

    <script>
        function openItem(x){

            id = $(x).data('backlog-id');
            console.log(id);

            $.ajax({
                type: 'POST',
                url: "{!! route('backlog.open.details') !!}",
                cache: false,
                data: {
                    _token: "{{csrf_token()}}",
                    'backlog_id': id
                },
                success: function (data) {
                    $('#backlog_details').html(data);
                    $('#exampleModal').modal();
                }
            });
        }

        function getallBacklog(){
            $.ajax({
                type: 'POST',
                url: "{!! route('backlog.dashboard.getAllBacklog') !!}",
                cache: false,
                data: {
                    _token: "{{csrf_token()}}",
                    'project_id': "{{ $project_id }}",
                },
                success: function (data) {
                    $('#backlog_panel').html(data);
                }
            });
        }

        $(document).ready(function() {
            getallBacklog();
        });

    </script>

    @yield('extra_js')

@endsection

