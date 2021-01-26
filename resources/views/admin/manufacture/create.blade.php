@extends('admin.index')

@section('header')

@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('admin.add_manufacture') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('admin.add_manufacture') }}</li>
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
                            <form method="post" action="{{ route('manufacture.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group has-validation">
                                        <label for="exampleInputEmail1">{{ __('admin.arabic_name') }}</label>
                                        <input type="text" class="form-control" name="name_ar">
                                        @error('name_ar')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group has-validation">
                                        <label for="exampleInputEmail1">{{ __('admin.english_name') }}</label>
                                        <input type="text" class="form-control" name="name_en">
                                        @error('name_en')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group has-validation">
                                        <label for="exampleInputEmail1">{{ __('admin.email') }}</label>
                                        <input type="text" class="form-control" name="email">
                                        @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group has-validation">
                                        <label for="exampleInputEmail1">{{ __('admin.mobile') }}</label>
                                        <input type="text" class="form-control" name="mobile">
                                        @error('mobile')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div id="us1" style="width: 500px; height: 400px;"></div>
                                    </div>
                                    <div class="form-group has-validation">
                                        <label for="exampleInputEmail1">{{ __('admin.facebook') }}</label>
                                        <input type="text" class="form-control" name="facebook">
                                        @error('facebook')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group has-validation">
                                        <label for="exampleInputEmail1">{{ __('admin.twitter') }}</label>
                                        <input type="text" class="form-control" name="twitter">
                                        @error('twitter')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group has-validation">
                                        <label for="exampleInputEmail1">{{ __('admin.website') }}</label>
                                        <input type="text" class="form-control" name="website">
                                        @error('website')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group has-validation">
                                        <label for="exampleInputEmail1">{{ __('admin.contact_name') }}</label>
                                        <input type="text" class="form-control" name="contact_name">
                                        @error('contact_name')
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
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">{{ __('admin.add_manufacture') }}</button>
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
    <!-- jquert location picker -->
    <script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyC6ynMlXOVt0B-p1WK8V1aQymdlbWHz360'></script>
    <script type="text/javascript" src='{{ asset('adminpanel/dist/js/locationpicker.jquery.min.js') }}'></script>
    <!-- Page specific script -->
    <script>
        $('#us1').locationpicker({
            location: {
                latitude: 46.15242437752303,
                longitude: 2.7470703125
            },
            radius: 300,
            markerIcon: 'http://www.iconsdb.com/icons/preview/tropical-blue/map-marker-2-xl.png',
            inputBinding: {
                latitudeInput: $('#lat'),
                longitudeInput: $('#lng'),
                // radiusInput: $('#us2-radius'),
                // locationNameInput: $('#us2-address')
            }
        });
        $(function () {
            bsCustomFileInput.init();
        });
        $(document).ready(function(){
            $('#country').change(function(){
                $.ajax({
                    method: 'post',
                    url: '{{ route('state.get_cities') }}',
                    data: {
                        'country_id': $(this).val(),
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function(data){
                        if(data.status == true){
                            $('#cities').children().remove();
                            for(let i = 0; i < data.cities.length; i++){
                                $('#cities').append('<option value="'+data.cities[i].id+'">'+data.cities[i].name+'</option>');
                            }
                        }
                    }
                });
            })
        });
    </script>
@endsection
