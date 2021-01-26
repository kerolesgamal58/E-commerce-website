@extends('admin.index')

@section('header')

@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('admin.add_state') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('admin.add_state') }}</li>
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
                            <form method="post" action="{{ route('state.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group has-validation">
                                        <label for="exampleInputEmail1">{{ __('admin.name') }}</label>
                                        <input type="text" class="form-control" name="name">
                                        @error('name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="country_id">{{ __('admin.country') }}</label>
                                        <select class="form-control" aria-label="Default select example" id="country" name="country_id">
                                            @foreach(\App\Models\Country::all() as $country)
                                                <option value="{{ $country->id }}">{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('country_id')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group" >
                                        <label>{{ __('admin.city') }}</label>
                                        <select class="form-control" aria-label="Default select example" id="cities" name="city_id">
                                            @foreach(\App\Models\Country::first()->cities as $city)
                                                <option value="{{ $city->id }}">{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('city_id')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">{{ __('admin.add_state') }}</button>
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
