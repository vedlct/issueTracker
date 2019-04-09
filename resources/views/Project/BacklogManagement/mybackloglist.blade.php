@extends('layouts.mainLayout')


@section('css')
    <style>
        .card{
            box-shadow: 1px 0 20px rgba(0, 0, 0, .09);
        }
    </style>
@endsection


@section('content')

    <div id="backlog_panel">

    </div>

@endsection

@section('js')


    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>--}}

    {{--<script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>--}}

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

