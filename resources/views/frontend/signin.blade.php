<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{__('admin.signin')}}</title>

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
            <a href="{{route('homepage')}}" class="h1"><b>Kero</b>les</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">{{ __('admin.sign_in_message') }}</p>

            <form action="" method="post">
                @csrf

                @include('admin.layouts.message')

                <div class="input-group form-group mb-3">
                    <input type="text" name="first_name" class="form-control" placeholder="{{ __('admin.enter_firstname') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    @error('first_name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group form-group mb-3">
                    <input type="text" name="last_name" class="form-control" placeholder="{{ __('admin.enter_lastname') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    @error('last_name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group form-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="{{ __('admin.enter_email') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="{{ __('admin.enter_password') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="text" name="phone_number" class="form-control" placeholder="{{ __('admin.enter_phone_number') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-phone"></span>
                        </div>
                    </div>
                    @error('phone_number')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="text" name="visa_number" class="form-control" placeholder="{{ __('admin.enter_visa_number') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fab fa-cc-visa"></span>
                        </div>
                    </div>
                    @error('visa_number')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="center">
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">{{ __('admin.signin') }}</button>
                    </div>
                </div>
            </form>
            <br>

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
