@extends('layouts.mainLayout')

@section('css')

@endsection

@section('content')
    <div class="container-fluid">
        {{-- Ticket Basic Information --}}
        <div class="card">
            <div class="card-header bg-dark text-white custom-2">
                <h4 class="float-left font-weight-normal">Assign Team</h4>
            </div>

            <div class="card-body">
                <div class="">

                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    {{--<script type="text/javascript" src="{{ url('public/ck/ckeditor/ckeditor.js')}}"></script>--}}

    {{--<script>--}}
        {{--function editTicket(id) {--}}
            {{--$.ajax({--}}
                {{--type: 'POST',--}}
                {{--url: "{!! route('ticket.ckEditorView') !!}",--}}
                {{--cache: false,--}}
                {{--data: {--}}
                    {{--_token: "{{csrf_token()}}",--}}
                    {{--'id': id--}}
                {{--},--}}
                {{--success: function (data) {--}}
                    {{--$('#ticketInformation').html(data);--}}
                {{--}--}}
            {{--});--}}
        {{--}--}}
    {{--</script>--}}

@endsection
