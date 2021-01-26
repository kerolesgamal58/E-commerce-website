@extends('admin.index')

@section('header')

@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('admin.edit_manufacture') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('admin.edit_manufacture') }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

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
                            <form method="post" action="{{ route('manufacture.update', $manufacture->id) }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $manufacture->id }}">

                                <div class="card-body">
                                    <div class="form-group has-validation">
                                        <label for="exampleInputEmail1">{{ __('admin.arabic_name') }}</label>
                                        <input type="text" class="form-control" name="name_ar"
                                            value="{{ $manufacture->name_ar }}">
                                        @error('name_ar')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group has-validation">
                                        <label for="exampleInputEmail1">{{ __('admin.english_name') }}</label>
                                        <input type="text" class="form-control" name="name_en"
                                               value="{{ $manufacture->name_en }}">
                                        @error('name_en')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group has-validation">
                                        <label for="exampleInputEmail1">{{ __('admin.email') }}</label>
                                        <input type="text" class="form-control" name="email"
                                        value="{{ $manufacture->email }}">
                                        @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group has-validation">
                                        <label for="exampleInputEmail1">{{ __('admin.mobile') }}</label>
                                        <input type="text" class="form-control" name="mobile"
                                        value="{{ $manufacture->mobile }}">
                                        @error('mobile')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group has-validation">
                                        <label for="exampleInputEmail1">{{ __('admin.facebook') }}</label>
                                        <input type="text" class="form-control" name="facebook"
                                        value="{{ $manufacture->facebook }}">
                                        @error('facebook')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group has-validation">
                                        <label for="exampleInputEmail1">{{ __('admin.twitter') }}</label>
                                        <input type="text" class="form-control" name="twitter"
                                         value="{{ $manufacture->twitter }}">
                                        @error('twitter')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group has-validation">
                                        <label for="exampleInputEmail1">{{ __('admin.wensite') }}</label>
                                        <input type="text" class="form-control" name="website"
                                        value="{{ $manufacture->website }}">
                                        @error('website')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group has-validation">
                                        <label for="exampleInputEmail1">{{ __('admin.contact_name') }}</label>
                                        <input type="text" class="form-control" name="contact_name"
                                        value="{{ $manufacture->contact_name }}">
                                        @error('contact_name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">{{ __('admin.add_manufacture') }}</label>
                                        @if(!is_null($manufacture->logo))
                                            <img src="{{ asset('storage/' . $manufacture->logo) }}" alt="{{ $manufacture->logo }}" style="height: 50px; height: 50px; margin-bottom: 5px">
                                        @endif
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile" name="logo">
                                            <label class="custom-file-label" for="exampleInputFile">{{ __('admin.choose_file') }}</label>
                                        </div>
                                        @error('logo')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">{{ __('admin.edit_manufacture') }}</button>
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
    </script>
@endsection
