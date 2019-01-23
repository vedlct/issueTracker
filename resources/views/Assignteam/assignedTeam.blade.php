@extends('layouts.mainLayout')

@section('css')

@endsection

@section('content')
    <div class="container-fluid">
        {{-- Add Team Button trigger modal --}}
        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
            Create new team
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create new team</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form method="post" action="{{ route('team.insert') }}">
                            @csrf
                            <div class="form-group">
                                <label for="teamname">Team Name</label>
                                <input type="text" name="teamName" class="form-control" id="teamname" required placeholder="Enter team name">
                            </div>

                            <div class="form-group">
                                <label for="company">Select Company</label>
                                <select class="form-control" id="company" name="companyId" required>
                                    <option value="">Select Company</option>
                                    @foreach($companylist as $company)
                                        <option value="{{ $company->companyId }}">{{ $company->companyName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                    </div>
                </div>
            </div>
        </div>

        {{-- Ticket Basic Information --}}
        <div class="card">
            <div class="card-header bg-dark text-white custom-2">
                <h4 class="float-left font-weight-normal">Free Employee</h4>
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
