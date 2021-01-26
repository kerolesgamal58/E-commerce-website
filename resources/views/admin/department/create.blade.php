@extends('admin.index')

@section('header')
    <link rel="stylesheet" href="{{ asset('adminpanel/jstree/dist/themes/default/style.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('admin.add_department') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('admin.add_department') }}</li>
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
                            <form method="post" action="{{ route('department.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group has-validation">
                                        <label for="exampleInputEmail1">{{ __('admin.arabic_name') }}</label>
                                        <input type="text" class="form-control" name="name_ar" value="{{ old('name_ar') }}">
                                        @error('name_ar')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group has-validation">
                                        <label>{{ __('admin.english_name') }}</label>
                                        <input type="text" class="form-control" name="name_en" value="{{ old('name_en') }}">
                                        @error('name_en')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __('admin.parent_department') }}</label>
                                        <div id="jstree"></div>
                                        <input type="hidden" class="parent_id" name="parent_id" value="{{ old('parent_id') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1" class="form-label">{{ __('admin.description') }}</label>
                                        <textarea class="form-control" rows="3" name="description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea2" class="form-label">{{ __('admin.keywords') }}</label>
                                        <textarea class="form-control" rows="3" name="keyword"></textarea>
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
                                    <button type="submit" class="btn btn-primary">{{ __('admin.add_department') }}</button>
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
    <!-- JsTree -->
    <script src="{{ asset('adminpanel/jstree/dist/jstree.min.js') }}"></script>
    <!-- Page specific script -->
    <script>
        $(function () {
            bsCustomFileInput.init();
        });
        $(document).ready(function(){
            $('#jstree').jstree({
                "core" : {
                    'data' : {!! \App\Helper\load_dep(old('parent_id')) !!},
                    "themes" : {
                        "variant" : "large"
                    }
                },
                "checkbox" : {
                    "keep_selected_style" : false
                },
                "plugins" : [ "wholerow" ]
            });
            $('#jstree').on("changed.jstree", function (e, data) {
                let i, j, r = [];
                for (i=0, j=data.selected.length; i<j; i++){
                    r.push(data.instance.get_node(data.selected[i]).id);
                }
                $('.parent_id').val(r.join(','));
            });
        });
    </script>
@endsection
