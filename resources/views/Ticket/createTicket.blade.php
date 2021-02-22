  @extends('layouts.mainLayout')
@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4>Open Ticket</h4>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Select Project</label>
                        <select class="form-control" name="project" required>
                            @foreach($projectlist as $project)
                                <option value="{{ $project->projectId }}">{{ $project->project_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Ticket Type</label>
                        <select class="form-control" name="tickettype" required>
                            @foreach($tickettype as $tickettype)
                                <option value="{{ $tickettype->id }}">{{ $tickettype->typeName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Ticket Priroty</label>
                        <select class="form-control" name="priroty" required>
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </div>
                    @if (Auth::user()->fk_userTypeId == 2)
                    <div class="form-group col-md-12">
                        <label>Ticket Topic *</label>
                        <input type="text" class="form-control" placeholder="Ticket Topic" value="" name="topic" required>
                    </div>
                    @endif
                    {{--<div class="form-group col-md-3">
                        <label>Ticket Create Date *</label>
                        <input type="text" autocomplete="off" class="form-control datepicker" placeholder="Select Ticket Create Date" name="create_date" required>
                    </div>--}}

                    @if (Auth::user()->fk_userTypeId != 2)
                        <div class="form-group col-md-8">
                            <label>Ticket Topic *</label>
                            <input type="text" class="form-control" placeholder="Ticket Topic" value="" name="topic" required>
                        </div>
                    <div class="form-group col-md-4">
                        <label>Expected End Date</label>
                        <input type="text" autocomplete="off" class="form-control datepicker" placeholder="Select Expected End Date" name="exp_end_date">
                    </div>
                    @endif
                    <div class="form-group col-md-12">
                        <label>Ticket Details *</label>
                        <textarea id="myTextarea" class="form-control ckeditor" placeholder="Ticket Details" name="details" rows="5" required></textarea>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleFormControlFile1">Choose file <small>(max size 16MB and no .exe file)</small></label>
                        <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>

                    <div class="form-group col-md-12">
                        <button class="btn btn-success pull-right ml-1" >Create Ticket</button>
                        <button type="reset" class="btn btn-warning pull-right" onclick="clearInputs()">Reset</button>
                        <a href="{{ route('ticket.showAllCTicket') }}" class="btn btn-primary pull-left">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script type="text/javascript" src="{{ url('/public/ck/ckeditor/ckeditor.js')}}"></script>
    <script>
        $('.datepicker').datepicker();
    </script>

    <script>
        function clearInputs() {
            $('iframe').contents().find('body').empty();
        }
    </script>

@endsection
