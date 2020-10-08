@extends('layouts.mainLayout')

@section('css')
    <style>
        .table-condensed > thead > tr > th, .table-condensed > tbody > tr > th, .table-condensed > tfoot > tr > th, .table-condensed > thead > tr > td, .table-condensed > tfoot > tr > td {
            padding: 2px;
            line-height: 2.5;
        }
    </style>
@endsection

@section('content')
    <style>
        @media only screen and (max-width: 400px) {
            .left {
                margin-left: 10%;
            }

            .top {
                margin-top: 5%;
            }

            .top1 {
                margin-top: 90%;
            }
        }

        @media only screen and (min-width: 400px) and (max-width: 460px) {
            .top {
                margin-top: 5%;
            }

        }
    </style>
    <style>
        @media only screen and (min-width: 338px) and (max-width: 379px) {
            .top2 {
                margin-top: 20%;
            }

        }

        @media only screen and (max-width: 337px) {
            .top3 {
                margin-top: 60%;
            }

        }
    </style>

    <div class="container-fluid row top2 top3">
        {{-- view for client personal --}}
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="float-left">Tickets</h4>
                    @if(Auth::user()->fk_userTypeId != 1)
                        <a href="{{ route('ticket.create') }}" class="btn btn-success float-right" name="button">Create Ticket</a>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table id="ticketTable" class="table-bordered table-condensed text-center table-hover"
                               style="width:100% ">
                            <thead>
                            <tr>
                                <th><input type="checkbox" id="selectall" onClick="selectAll(this)"/></th>
                                <th>Number</th>
                                <th>Subject</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Create Date</th>
                                <th>Last Updated</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')

    <script>
        var letter = "";
        var dueTicket = "";
        var allTicket = "";
        var currentDate = Date.now();
        var currentUserType = "{{ Auth::user()->fk_userTypeId }}";

        $(document).ready(function () {

            dataTable = $('#ticketTable').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(0)'
                },
                responsive: true,
                processing: true,
                serverSide: true,
                Filter: true,
                stateSave: true,
                orderable: true,
                type: "POST",
                "ajax": {
                    "url": "{!! route('ticket.getMyAllTicket') !!}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{csrf_token()}}";
                        d.startDate = $('#startDate').val();
                        d.endDate = $('#endDate').val();
                        d.ticketStatus = $('#ticketStatus2').val();
                        d.ticketType = letter;
                        d.overDue = dueTicket;
                        d.allTicket = allTicket;
                    },
                },
                columns: [
                    {
                        "data": function (data) {
                            return '<input type="checkbox" class="checkboxvar" name="checkboxvar[]" value="' + data.ticketId + '">';
                        },
                        "orderable": false, "searchable": false, "name": "selected_rows"
                    },

                    {data: 'ticket_number', name: 'ticket_number'},
                    {
                        "data": function (data) {
                            return '<a href="#" style="float: left" data-panel-id="' + data.ticketId + '" onclick="openTicket(this)">' + data.ticketTopic + '</a>';
                        },
                        "orderable": true, "searchable": true, "name": "ticketTopic"
                    },

                    {data: 'ticketPriority', name: 'ticketPriority'},
                    {
                        "data": function (data) {
                            var d1 = Date.parse(data.exp_end_date);

                            if (d1 <= currentDate && data.ticketStatus != 'Close' && data.ticketStatus != 'Pending') {
                                return "Overdue";
                            } else {
                                return data.ticketStatus;
                            }
                        },
                        "orderable": true, "searchable": true, "name": "ticketStatus"
                    },
                    {data: 'created_at', name: 'created_at'},
                    {data: 'lastUpdated', name: 'lastUpdated'},

                    {
                        "data": function (data) {

                            if (currentUserType == 1 || currentUserType == 4 || currentUserType == 3 || currentUserType == 5) {
                                return '<button class="btn btn-success btn-xs m-1" data-panel-id="' + data.ticketId + '" onclick="openTicket(this)"><i class="fa fa-envelope-open-o"></i></button>' +
                                    '<button class="btn btn-primary btn-xs m-1" data-panel-id="' + data.ticketId + '" onclick="editTicket(this)"><i class="fa fa-cog"></i></button>';
                            } else {
                                return '<button class="btn btn-success btn-xs m-1" data-panel-id="' + data.ticketId + '" onclick="openTicket(this)"><i class="fa fa-envelope-open-o"></i></button>';
                            }
                        },

                        "orderable": false, "searchable": false, "name": "selected_rows"
                    },
                ]
            });
        });

        // view ticket details
        function editTicket(x) {
            btn = $(x).data('panel-id');
            var url = '{{ route("ticket.edit", ":id") }}';
            var newUrl = url.replace(':id', btn);
            window.location.href = newUrl;
        }


        // Select All Checkbox
        function selectAll(source) {
            checkboxes = document.getElementsByName('checkboxvar[]');
            for (var i in checkboxes)
                checkboxes[i].checked = source.checked;
        }

        // view ticket details
        function openTicket(x) {
            btn = $(x).data('panel-id');
            var url = '{{ route("ticket.view", ":id") }}';
            var newUrl = url.replace(':id', btn);
            window.location.href = newUrl;
        }

        // view ticket details
        function editTicket(x) {
            id = $(x).data('panel-id');

            $.ajax({
                type: 'POST',
                url: "{!! route('ticket.edit') !!}",
                cache: false,
                data: {
                    _token: "{{csrf_token()}}",
                    'id': id
                },
                success: function (data) {
                    // console.log(data);
                    $('#editTicket').html(data);
                    $('#exampleModal').modal('show');

                }
            });
        }

        function changeType(x) {
            if ($(x).val() == 'single') {
                $('#assignTypeTeam').hide();
                $('#assignTypeSingle').show();
            }
            if ($(x).val() == 'team') {
                $('#assignTypeSingle').hide();
                $('#assignTypeTeam').show();
            }
        }

        function setRequiredOnClose(x) {
            if ($(x).val() == 'Close') {
                $("#modalWorkedHour").prop('required', true);
            } else {
                $("#modalWorkedHour").prop('required', false);
            }
        }

        function applyFilter() {
            dataTable.ajax.reload();
        }

        // filter tab
        function ticketTypeChange1(val) {
            letter = val;
            dueTicket = "";
            allTicket = "";

            $(".c1").addClass("active");
            $(".c3").removeClass("active");
            $(".c4").removeClass("active");
            $(".c5").removeClass("active");
            $(".c2").removeClass("active");
            $(".cC").removeClass("active");
            $(".cP").removeClass("active");
            $(".cO").removeClass("active");
            dataTable.ajax.reload();
        }


        function ticketTypeChange2(val) {
            letter = val;
            dueTicket = "";
            allTicket = "all";

            // change active class
            $(".c2").addClass("active");
            $(".c1").removeClass("active");
            $(".c3").removeClass("active");
            $(".c4").removeClass("active");
            $(".c5").removeClass("active");
            $(".cC").removeClass("active");
            $(".cP").removeClass("active");
            $(".cO").removeClass("active");
            dataTable.ajax.reload();
        }

        function ticketTypeChange3(val) {
            letter = val;
            dueTicket = "overdue";
            allTicket = "";

            // change active class
            $(".c3").addClass("active");
            $(".c1").removeClass("active");
            $(".c2").removeClass("active");
            $(".c4").removeClass("active");
            $(".c5").removeClass("active");
            $(".cC").removeClass("active");
            $(".cP").removeClass("active");
            $(".cO").removeClass("active");
            dataTable.ajax.reload();
        }

        function ticketTypeChange4(val) {
            letter = val;
            dueTicket = "";
            allTicket = "";

            // change active class
            $(".c4").addClass("active");
            $(".c1").removeClass("active");
            $(".c2").removeClass("active");
            $(".c3").removeClass("active");
            $(".c5").removeClass("active");
            $(".cC").removeClass("active");
            $(".cP").removeClass("active");
            $(".cO").removeClass("active");
            dataTable.ajax.reload();
        }

        function ticketTypeChange5(val) {
            letter = val;
            dueTicket = "";
            allTicket = "";

            // change active class
            $(".c5").addClass("active");
            $(".c1").removeClass("active");
            $(".c2").removeClass("active");
            $(".c3").removeClass("active");
            $(".c4").removeClass("active");
            $(".cC").removeClass("active");
            $(".cP").removeClass("active");
            $(".cO").removeClass("active");
            dataTable.ajax.reload();
        }

        function ticketTypeChangeP(val) {
            letter = val;
            dueTicket = "";
            allTicket = "pending";

            // change active class
            $(".cP").addClass("active");
            $(".cO").removeClass("active");
            $(".cC").removeClass("active");
            $(".c5").removeClass("active");
            $(".c1").removeClass("active");
            $(".c2").removeClass("active");
            $(".c3").removeClass("active");
            $(".c4").removeClass("active");

            dataTable.ajax.reload();
        }

        function ticketTypeChangeO(val) {
            letter = val;
            dueTicket = "";
            allTicket = "open";

            // change active class
            $(".cO").addClass("active");
            $(".cP").removeClass("active");
            $(".cC").removeClass("active");
            $(".c3").removeClass("active");
            $(".c1").removeClass("active");
            $(".c2").removeClass("active");
            $(".c4").removeClass("active");
            $(".c5").removeClass("active");

            dataTable.ajax.reload();
        }

        function ticketTypeChangeC(val) {
            letter = val;
            dueTicket = "";
            allTicket = "close";

            // change active class
            $(".cC").addClass("active");
            $(".cP").removeClass("active");
            $(".cO").removeClass("active");
            $(".c1").removeClass("active");
            $(".c3").removeClass("active");
            $(".c2").removeClass("active");
            $(".c4").removeClass("active");
            $(".c5").removeClass("active");

            dataTable.ajax.reload();
        }


        // filter end


        // generate report
        function generateReport() {

            var chkArray = [];

            $('.checkboxvar:checked').each(function (i) {
                chkArray[i] = $(this).val();
            });

            $.ajax({
                type: 'post',
                url: '{{route('ticket.report.generate')}}',
                data: {
                    _token: "{{csrf_token()}}",
                    'allCheckedTicket': chkArray,
                },
                success: function (data) {
                    var link = document.createElement("a");
                    link.download = "tickets.xlsx";
                    var uri = '{{url("storage/app")}}' + "/" + "tickets.xlsx";
                    link.href = uri;
                    link.click();
                }
            });

        }

        // mass change ticket status
        function changeTicketStatus(val) {
            var chkArray = [];
            var ticketStatus = val.value;


            $('.checkboxvar:checked').each(function (i) {
                chkArray[i] = $(this).val();
            });

            if (chkArray.length == 0) {
                $.alert({
                    animationBounce: 2,
                    type: 'red',
                    title: 'Error!',
                    content: 'Please select at least one ticket.',
                });
                $('#selectDefault').val('');
                return false
            }


            // Send Request
            $.ajax({
                type: 'post',
                url: '{{route('ticket.massChangeTicketStatus')}}',
                data: {
                    _token: "{{csrf_token()}}",
                    'allCheckedTicket': chkArray,
                    'ticketStatus': ticketStatus,
                },
                success: function (data) {
                    $.alert({
                        animationBounce: 2,
                        title: 'Success!',
                        type: 'green',
                        content: 'All Selected Ticket Status Type Changed',
                        buttons: {
                            ok: function () {
                                location.reload();
                            },
                        }
                    });

                    $('#selectDefault').val('');
                }
            });
        }


        // mass change ticket status
        function changeTicketAssignment(val) {

            var chkArray = [];
            var assignType = val.value;

            $('.checkboxvar:checked').each(function (i) {
                chkArray[i] = $(this).val();
            });

            if (chkArray.length == 0) {
                $.alert({
                    animationBounce: 2,
                    type: 'red',
                    title: 'Error!',
                    content: 'Please select at least one ticket.',
                });
                $('#selectDefault2').val('');
                return false
            }

            if (assignType == "team") {
                $('#teamModal').modal();
            } else if (assignType == "none") {
                var chkArray = [];
                $('.checkboxvar:checked').each(function (i) {
                    chkArray[i] = $(this).val();
                });
                // send request
                $.ajax({
                    type: 'post',
                    url: '{{route('ticket.massAssignTicket.none')}}',
                    data: {
                        _token: "{{csrf_token()}}",
                        'allCheckedTicket': chkArray,
                    },
                    success: function (data) {
                        $.alert({
                            animationBounce: 2,
                            type: 'green',
                            title: 'Success!',
                            content: 'Assignment Removed.',
                        });
                        $('#selectDefault2').val('');
                        dataTable.ajax.reload();
                    }
                });
            } else {
                $('#individualModal').modal();
            }
        }

        // assign team
        function assignTeam() {

            // get all checked ticket id
            var chkArray = [];
            $('.checkboxvar:checked').each(function (i) {
                chkArray[i] = $(this).val();
            });

            // get team id
            var teamid = team.value;

            // console.log(chkArray);

            // Send Request
            $.ajax({
                type: 'post',
                url: '{{route('ticket.massAssignTicket.team')}}',
                data: {
                    _token: "{{csrf_token()}}",
                    'allCheckedTicket': chkArray,
                    'teamid': teamid,
                },
                success: function (data) {
                    // console.log(data);
                    $.alert({
                        animationBounce: 2,
                        type: 'green',
                        title: 'Success!',
                        content: 'Selected Team Assigned.',
                    });
                    $('#selectDefault2').val('');
                    dataTable.ajax.reload();
                }
            });
        }

        // assign individual
        function assignIndividual() {

            // get all checked ticket id
            var chkArray = [];
            $('.checkboxvar:checked').each(function (i) {
                chkArray[i] = $(this).val();
            });

            if (chkArray.length == 0) {
                $.alert({
                    animationBounce: 2,
                    type: 'red',
                    title: 'Error!',
                    content: 'Please select at least one ticket.',
                });
                return false
            }

            // get team id
            var empId = empId1.value;

            // Send Request
            $.ajax({
                type: 'post',
                url: '{{route('ticket.massAssignTicket.individual')}}',
                data: {
                    _token: "{{csrf_token()}}",
                    'allCheckedTicket': chkArray,
                    'empId': empId,
                },
                success: function (data) {
                    $.alert({
                        animationBounce: 2,
                        title: 'Success!',
                        type: 'green',
                        content: 'Selected Team Assigned.',
                    });
                    $('#selectDefault2').val('');
                    dataTable.ajax.reload();
                }
            });
        }

        // call from dashboard
        $(document).ready(function () {

            @if (Session::has('call_ticket_type'))

            @if( Session::get('call_ticket_type') == 'allticket')
            ticketTypeChange2('All Ticket')
            @endif


            @if( Session::get('call_ticket_type') == 'open')
            ticketTypeChange1('Open')
            @endif


            @if( Session::get('call_ticket_type') == 'close')
            ticketTypeChange4('Close')
            @endif


            @if( Session::get('call_ticket_type') == 'overdue')
            ticketTypeChange3('Overdue')
            @endif


            @if( Session::get('call_ticket_type') == 'pending')
            ticketTypeChange5('Pending')
            @endif

            @endif

        });


    </script>

@endsection
