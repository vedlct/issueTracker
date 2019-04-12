@extends('layouts.mainLayout')
@section('content')




    <div id="app">



            {{--<router-view></router-view>--}}
            {{--<posts></posts>--}}
            <example-component></example-component>


    </div>


@endsection

@section('js')
    <script>Window.Laravel={csrfToken:'{{csrf_token()}}'}</script>

    <script src="{{url('public/js/app.js')}}"></script>



@endsection


{{--<!doctype html>--}}
{{--<html lang="{{ app()->getLocale() }}">--}}
{{--<head>--}}
    {{--<meta charset="utf-8">--}}
    {{--<meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
    {{--<meta name="viewport" content="width=device-width, initial-scale=1">--}}
    {{--<meta name="csrf-token" content="{{csrf_token()}}">--}}

    {{--<title>Vuejs App</title>--}}
    {{--<!-- Latest compiled and minified CSS -->--}}
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}
    {{--<script>Window.Laravel={csrfToken:'{{csrf_token()}}'}</script>--}}
    {{--<!-- jQuery library -->--}}
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}

    {{--<!-- Latest compiled JavaScript -->--}}
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}
    {{--<!-- Fonts -->--}}
    {{--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">--}}

    {{--<!-- Styles -->--}}
{{--</head>--}}
{{--<body>--}}
{{--<div id="app">--}}


    {{--<div class="container">--}}
        {{--<router-view></router-view>--}}
        {{--<posts></posts>--}}
        {{--<example-component></example-component>--}}

    {{--</div>--}}
{{--</div>--}}

{{--<script src="{{url('public/js/app.js')}}"></script>--}}
{{--</body>--}}
{{--</html>--}}