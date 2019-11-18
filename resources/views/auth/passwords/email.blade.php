<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from themesdesign.in/drixo/vertical/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Nov 2018 08:39:22 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <title>Myject</title>
    <meta content="Admin Dashboard" name="description">
    <meta content="ThemeDesign" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="{{url('public/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('public/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('public/css/style.css')}}" rel="stylesheet" type="text/css">

</head>

<body class="fixed-left">
<div class="accountbg">
    <div class="content-center">
        <div class="content-desc-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-muted text-center font-18"><b>{{ __('Reset Password') }}</b></h4>
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <div class="p-2">
                                    <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group text-center row m-t-20">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Send Password Reset Link') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
    </div>
</div>
<!-- jQuery  -->
<script src="{{url('public/js/jquery.min.js')}}"></script>
<script src="{{url('public/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('public/js/modernizr.min.js')}}"></script>
<script src="{{url('public/js/detect.js')}}"></script>
<script src="{{url('public/js/fastclick.js')}}"></script>
<script src="{{url('public/js/jquery.slimscroll.js')}}"></script>
<script src="{{url('public/js/jquery.blockUI.js')}}"></script>
</body>

</html>
