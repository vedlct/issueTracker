@extends('layouts.mainLayout')

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4>Create New Project </h4>
            <h5><small>Project Information</small></h5>

        </div>
        <div class="card-body">
            <form method="post">
                {{csrf_field()}}
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Project Name *</label>
                        <input type="text" class="form-control" placeholder="Project Name" value="" name="projectname" required>
                    </div>

                    {{--<div class="form-group col-md-4">--}}
                        {{--<label>Select Company</label>--}}
                        {{--<select class="form-control" name="companyId" required>--}}
                            {{--@foreach($companylist as $company)--}}
                                {{--<option value="{{ $company->companyId }}">{{ $company->companyName }}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</div>--}}

                    @if(Auth::user()->fk_userTypeId != 2)
                        <div class="form-group col-md-4">
                            <label>Project Type *</label>
                            <select class="form-control" name="projectType" id="projectType" required onchange="changeProjectType()">
                                <option value="">Select Project Type</option>
                                <option value="Company Personal">Company Personal</option>
                                <option value="Company Client">Company Client</option>
                            </select>
                        </div>
                    @endif

                    <div class="form-group col-md-4">
                        <label>Project Start Date</label>
                        <input type="text" autocomplete="off" class="form-control datepicker" placeholder="Start Date" name="projectStartDate">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Project Expected Duration</label>
                        <input type="text" class="form-control" placeholder="Enter Project Expected Duration" value="" name="duration">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Project Status *</label>
                        <select class="form-control" name="status" required>
                            @foreach($statusAll as $status)
                                <option value="{{ $status->statusId }}" @if($status->statusId == 2) selected @endif>{{ $status->statusData }}</option>
                            @endforeach
                        </select>
                    </div>

                    @if(Auth::user()->fk_userTypeId != 2)
                        <div class="form-group col-md-4" id="client">
                            <label>Select Client *</label>
                            <select class="form-control" name="client" id="setClientId">
                                <option value="">Select Client</option>
                                @foreach($clients as $c)
                                    <option value="{{$c->clientId}}" >{{$c->clientName}}</option>
                                @endforeach
                            </select>
                        </div>

                    @endif

                    <div class="form-group col-md-4" id="CompanyPartner">
                        <label>Select Partner</label>
                        <select class="form-control js-example-basic-multiple" name="fkPartnerCompanyId[]" multiple="multiple" id="setCompanyPartner">
                            <option value="">Select Partner</option>
                            @foreach($partnerCompany as $pC)
                                <option value="{{$pC->companyId}}" >{{$pC->companyName}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Project Summary</label>
                        <textarea class="form-control" placeholder="Project Summary" name="summary"></textarea>
                    </div>

                    {{--<span id="contact_person_space" class="col-md-12"></span>--}}

                    <div class="form-group col-md-12">
                        <button class="btn btn-success pull-right" style="color: #0a1832">Create Project</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection

@section('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
        $(".datepicker").datepicker({
            orientation: "bottom" // <-- and add this
        });

        // PROJECT TYPE CHANGE
        function changeProjectType() {
            if($('#projectType').val() == "Company Personal")
            {
                $('#client').hide();
            }
            if($('#projectType').val() == "Company Client")
            {
                $('#client').show();
                $('#setClientId').prop('required',true);
            }
        }

        // GET ALL CONTACT PERSON LIST
        {{--function getAllContactPersonList() {--}}
            {{--var clientId = $('#setClientId').val();--}}
            {{--console.log(clientId);--}}
            {{--$.ajax({--}}
                {{--type: 'POST',--}}
                {{--url: "{!! route('project.get.contactpersonlist') !!}",--}}
                {{--cache: false,--}}
                {{--data: {--}}
                    {{--_token: "{{csrf_token()}}",--}}
                    {{--'clientId': clientId,--}}
                {{--},--}}
                {{--success: function (data) {--}}
                    {{--$('#contact_person_space').html(data);--}}
                {{--}--}}
            {{--});--}}
        {{--}--}}

    </script>
@endsection
