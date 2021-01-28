@extends('admin.index')

@section('header')

@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('admin.settings') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('admin.settings') }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        @include('admin.layouts.message')

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('admin.info') }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="post" action="" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group has-validation">
                                        <label for="exampleInputEmail1">{{ __('admin.sitename') }}</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name" name="sitename" value="{{ $settings->sitename }}">
                                        @error('sitename')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">{{ __('admin.logo') }}</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile" name="logo">
                                            <label class="custom-file-label" for="exampleInputFile">{{ __('admin.choose_file') }}</label>
                                        </div>
                                        @error('logo')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">{{ __('admin.icon') }}</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile" name="icon">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                        @error('icon')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{ __('admin.email') }}</label>
                                        <input type="email" class="form-control" placeholder="{{ __('admin.enter_email') }}" name="email" value="{{ $settings->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1" class="form-label">{{ __('admin.description') }}</label>
                                        <textarea class="form-control" rows="3" name="description">
                                            {{ $settings->description }}
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1" class="form-label">{{ __('admin.keywords') }}</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="keywords">
                                            {{ $settings->keywords }}
                                        </textarea>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="status" @if($settings->status == 'open') checked @endif>
                                        <label class="form-check-label" for="flexSwitchCheckChecked" id="ststusLabel">
                                        @if($settings->status == 'open')
                                            {{ __('admin.open') }}
                                        @else
                                            {{ __('admin.closed') }}
                                        @endif
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1" class="form-label">{{ __('admin.maintenance_message') }}</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message_maintenance">
                                            {{ $settings->message_maintenance }}
                                        </textarea>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">{{ __('admin.save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <!-- jQuery -->
    <script src="{{asset('adminpanel/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('adminpanel/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{asset('adminpanel/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('adminpanel/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('adminpanel/dist/js/demo.js')}}"></script>
    <!-- Page specific script -->
    <script>
        $(function () {
            bsCustomFileInput.init();
        });

        $(document).ready(function(){
            $('#flexSwitchCheckChecked').click(function () {
                if ( $(this).is(':checked') ){
                    $('#ststusLabel').text('Open');
                }
                else{
                    $('#ststusLabel').text('Closed');
                }
            })
        });
    </script>
@endsection
