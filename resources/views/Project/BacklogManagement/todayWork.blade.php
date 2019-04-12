@extends('layouts.mainLayout')


@section('css')
    <style>
        .card{
            box-shadow: 1px 0 20px rgba(0, 0, 0, .09);
        }
    </style>
@endsection


@section('content')

    <!-- Item Details Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    {{--<h5 class="modal-title" id="exampleModalLabel">Backlog Title</h5>--}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="backlog_details">



                </div>
            </div>
        </div>
    </div>



    <div id="backlog_panel">

        @foreach($mybacklogs as $mybacklog)
            <div class="card mb-2 ml-2" onclick="openItem(this)" data-backlog-id= {{ $mybacklog->backlog_id }}>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <b>Backlog : </b> {{ $mybacklog->backlog_title }}
                        </div>
                        <div class="col-md-3">
                            <b>Backlog State : </b> {{ $mybacklog->backlog_state }}
                        </div>
                        <div class="col-md-3">
                            <b>Backlog Start Date : </b> {{ $mybacklog->backlog_start_date }}
                        </div>
                        <div class="col-md-3">
                            <b>Backlog End Date : </b> {{ $mybacklog->backlog_end_date }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

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


    </script>


@endsection

