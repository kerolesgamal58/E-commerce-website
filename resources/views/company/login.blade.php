<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{__('admin.login')}}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('adminpanel/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('adminpanel/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminpanel/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="{{route('company.dashboard')}}" class="h1"><b>Admin</b>LTE</a>
        </div>
        <div class="card-body">
            @include('company.layouts.message')
            <p class="login-box-msg">{{ __('admin.sign_in_message') }}</p>

            <form action="" method="post">
                @csrf

                <div class="input-group form-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="{{ __('admin.enter_email') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="{{ __('admin.enter_password') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" name="remember_me" value="1" id="remember">
                            <label for="remember">
                                {{ __('admin.remember_me') }}
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">{{ __('admin.sign_in') }}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <br>

            <p class="mb-1">
                <a href="{{ route('company.forgot_password') }}">{{ __('admin.i_forgot_pass') }}</a>
            </p>
            <p class="mb-0">
                <a href="{{ route('company.signin') }}" class="text-center">{{ __('admin.register_membership') }}</a>
            </p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('adminpanel/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('adminpanel/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminpanel/dist/js/adminlte.min.js')}}"></script>
</body>
</html>
