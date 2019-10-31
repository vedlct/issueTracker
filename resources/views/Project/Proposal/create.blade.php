@extends('layouts.mainLayout')

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4>Project Proposal</h4>
        </div>
        <div class="card-body">
            <form method="post" action="{{route('project.proposal.submit')}}">
                {{csrf_field()}}
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Project Name *</label>
                        <input type="text" class="form-control" placeholder="Project Name" value="" name="projectname" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Client Name</label>
                        <input type="text" class="form-control" placeholder="Enter Client Name" value="" name="clientname">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Duration</label>
                        <input type="text" class="form-control" placeholder="Enter Duration" value="" name="duration">
                    </div>

                    <div class="form-group col-md-1">
                            <label>Features - </label>
                        </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter Feature" name="feature[]">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter Feature" name="feature[]">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter Feature" name="feature[]">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter Feature" name="feature[]">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter Feature" name="feature[]">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter Feature" name="feature[]">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter Feature" name="feature[]">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter Feature" name="feature[]">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter Feature" name="feature[]">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter Feature" name="feature[]">
                        </div>
                        <fieldset id="buildyourform"></fieldset>
                        <div class="form-group">
                            <input type="button" value="Add a field" class="add" id="add" />
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success pull-right" style="color: #0a1832">Create</button>
                        </div>
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

        $("#add").click(function() {
            var lastField = $("#buildyourform div:last");
            var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
            var fieldWrapper = $("<div class=\"form-group\" id=\"field" + intId + "\"/>");
            fieldWrapper.data("idx", intId);
            var fName = $("<input type=\"text\" class=\"form-control\" placeholder=\"Enter Feature\" name=\"feature[]\" />");
            var removeButton = $("<input type=\"button\" class=\"remove\" value=\"-\" />");
            removeButton.click(function() {
                $(this).parent().remove();
            });
            fieldWrapper.append(fName);
            fieldWrapper.append(removeButton);
            $("#buildyourform").append(fieldWrapper);
        });

        function addField(){
            $('#fieldHolder').html('<div class="form-group"><input type="text" class="form-control" placeholder="Enter Feature" name="feature[]"></div>');
        }

        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
            $('.js-example-basic-single').select2();

            clientNamechk();

        });
        $(".datepicker").datepicker({
            orientation: "bottom" // <-- and add this
        });

        function changeProjectType() {
            if($('#projectType').val() == "Company Personal")
            {
                $('#client').hide();
                $('#setClientId').prop('required',false);
            }
            if($('#projectType').val() == "Company Client")
            {
                $('#client').show();
                $('#setClientId').prop('required',true);
            }
            clientNamechk();
        }

    </script>
@endsection
