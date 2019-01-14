
@extends('layouts.mainLayout')

@section('content')
    <h1>BEST OF LUCK</h1>
@endsection
@section('js')
    <script>
    {{--$(document).ready( function () {--}}

        {{--$.ajax({--}}
            {{--type: 'GET',--}}
            {{--url: "{!! route('dashboard.duepayment') !!}",--}}
            {{--cache: false,--}}
            {{--data: {_token: "{{csrf_token()}}"},--}}
            {{--success: function (data) {--}}
                {{--$("#duepayment").html(data);--}}
                {{--// console.log(data);--}}
            {{--}--}}
        {{--});--}}

    {{--});--}}

    {{--$(document).ready( function () {--}}
        {{--$.ajax({--}}
            {{--type: 'GET',--}}
            {{--url: "{!! route('dashboard.insertbillformonth') !!}",--}}
            {{--cache: false,--}}
            {{--data: {_token: "{{csrf_token()}}"},--}}
            {{--success: function (data) {--}}


              {{--//  $("#duepayment").html(data);--}}
                 {{--console.log(data);--}}
            {{--}--}}
        {{--});--}}

    {{--});--}}
    </script>
    }
    @endsection