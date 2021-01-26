@extends('admin.index')

@section('header')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="{{ asset('adminpanel/dist/css/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('adminpanel/jstree/dist/themes/default/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminpanel/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminpanel/dist/css/dropzone.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('admin.edit_product') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('admin.edit_product') }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 mx-auto">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('admin.info') }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="post" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data" id="main_form">
                                @csrf
                                <input type="hidden" name="id" value="{{$product->id}}">

                                <div class="card-body">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#product_info" role="tab" aria-controls="home" aria-selected="true">
                                                <i class="fa fa-info"></i> {{ __('admin.product_info') }}
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#department" role="tab" aria-controls="profile" aria-selected="false">
                                                <i class="fa fa-list"></i> {{ __('admin.department') }}
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#product_settings" role="tab" aria-controls="profile" aria-selected="false">
                                                <i class="fa fa-cog"></i> {{ __('admin.product_settings') }}
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#product_media" role="tab" aria-controls="contact" aria-selected="false">
                                                <i class="far fa-images"></i> {{ __('admin.product_media') }}
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#product_size_weight" role="tab" aria-controls="contact" aria-selected="false">
                                                <i class="fas fa-weight"></i> {{ __('admin.product_size_and_weight') }}
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#other_data" role="tab" aria-controls="contact" aria-selected="false">
                                                <i class="fa fa-database"></i> {{ __('admin.other_data') }}
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        @include('admin.product.taps_edit.product_info')
                                        @include('admin.product.taps_edit.department')
                                        @include('admin.product.taps_edit.product_settings')
                                        @include('admin.product.taps_edit.product_media')
                                        @include('admin.product.taps_edit.product_size_weight')
                                        @include('admin.product.taps_edit.other_data')
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button class="btn btn-primary mb-4 mr-1 save">{{ __('admin.save') }}</button>
                                    <button class="btn btn-success mb-4 mr-1 save_and_continue">{{ __('admin.save_and_continue') }}
                                        <div class="spinner-border d-none" role="status" style="width: 20px; height: 20px">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </button>
                                    <button class="btn btn-secondary mb-4 mr-1 copy_product">{{ __('admin.copy_product') }}
                                        <div class="spinner-border d-none" role="status" style="width: 20px; height: 20px">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </button>
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
    <!-- Custom js bootstrap &  select2 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="{{ asset('adminpanel/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('adminpanel/dist/js/bootstrap-datepicker.ar.min.js') }}"></script>
    <!-- JsTree -->
    <script src="{{ asset('adminpanel/jstree/dist/jstree.min.js') }}"></script>
    <script src="{{ asset('adminpanel/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('adminpanel/dist/js/dropzone.min.js') }}"></script>
    <!-- Page specific script -->
    <script>
        Dropzone.autoDiscover = false;

        $(function () {
            bsCustomFileInput.init();
        });
        $(document).ready(function() {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                // rtl: true,
                // language: ar,
                todayBtn: true,
                clearBtn: true,
            });

            $('#status').change(function(){
                if ( $('#status option:selected').val() == 'refused' ){
                    $('.reason').removeClass('d-none');
                }
                else {
                    $('.reason').addClass('d-none');
                }
            });

            let malls = @json($malls);
            $('#malls_select2').select2();
            $('#malls_select2').val( malls );
            $('#malls_select2').select2({
                placeholder: 'Choose Mall'
            });
            $('#malls_select2').trigger('change');

            $('#jstree').jstree({
                "core" : {
                    'data' : {!! \App\Helper\load_dep( $product->department_id ) !!},
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
                let department_id = r.join(',');
                $('.department_id').val(r.join(','));

                $.ajax({
                    type: 'post',
                    url: '{{ route('load.size.weight') }}',
                    dataType: 'html',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'dep_id': department_id,
                        'product_id': {!! $product->id !!},
                    },
                    success: function (data){
                        $('.choose_department_message').html(data);
                        $('.additional-data').removeClass('d-none');
                    }
                });
            });

            $(document).on('change', '#selectColor', function () {
                let color = $('#selectColor option:selected').attr('color');
                console.log(color);
                $('#colorField').css('background-color', color);
            });

            $(document).on('change', '#selectTrademark', function () {
                let imageSource = $('#selectTrademark option:selected').attr('trademark_logo');
                let imageAlt = $('#selectTrademark option:selected').attr('trademark_alt');
                $('#trademark_logo').attr('src', imageSource);
                $('#trademark_logo').attr('alt', imageAlt);
                if ($('#trademark_logo').attr('src') === '{{ asset('storage/')}}') {
                    $('#trademark_logo').addClass('d-none');
                }
                else
                    $('#trademark_logo').removeClass('d-none');
            });

            let max_inputs = 10;
            let num_of_inputs = 1;
            $(document).on('click', '.add_input', function(){
                if (num_of_inputs < max_inputs ) {
                    $('.row-inputs').append(`
                    <div class="contain row">
                        <div class="form-group col-md-4">
                            <label for="input_key">{{ __('admin.input_key') }}</label>
                            <input type="text" class="form-control" name="input_key[]">
                        </div>
                        <div class="form-group col-md-7">
                            <label for="input_value">{{ __('admin.input_value') }}</label>
                            <input type="text" class="form-control" name="input_value[]">
                        </div>
                        <div class="form-group col-md-1">
                            <button class="btn btn-primary mt-4 remove-input"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>
                    `);
                    num_of_inputs++;
                }
                return false;
            });
            $(document).on('click', '.remove-input', function(){
                $(this).parent().parent().remove();
                num_of_inputs--;
                return false;
            });

            $(document).on('click', '.save_and_continue', function(e){
                e.preventDefault();
                let x = document.getElementById('main_form');
                let formdata = new FormData( x );
                $.ajax({
                    type: 'post',
                    enctype: 'multipart/form-data',
                    url: '{{ route('product.save_and_continue', $product->id) }}',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: formdata,
                    beforeSend: function(){
                        $('.save_and_continue .spinner-border').removeClass('d-none');
                    },
                    success: function (data){
                        console.log(data);
                        $('.save_and_continue .spinner-border').addClass('d-none');
                    }
                });
                return false;
            });

            $(document).on('click', '.copy_product', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'post',
                    url: '{{ route('product.copy', $product->id) }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'product_id': '{{ $product->id }}',
                    },
                    beforeSend: function(){
                        $('.copy_product .spinner-border').removeClass('d-none');
                    },
                    success: function (data){
                        $('.copy_product .spinner-border').addClass('d-none');
                        window.location.href = data;
                    }
                });
            });

            $('#mainImageDropzone').dropzone({
                url: '{{ route('product.edit_main_image', $product->id) }}',
                paramName: 'main_image',
                uploadMultiple: false,
                maxFiles: 1,
                maxFilesize: 2,
                acceptedFiles: 'image/*',
                dictDefaultMessage: 'Drag and drop files',
                dictRemoveFile: 'Remove',
                addRemoveLinks: true,
                params: {
                    _token: '{{ csrf_token() }}',
                },
                removedfile: function(file){
                    return;
                },
                init: function(){
                    let mockfile = {name: '{{ basename($product->main_image) }}', size: 111111, id: '{{ $product->id }}'};
                    this.displayExistingFile(mockfile, '{{ asset('storage/' . $product->main_image) }}');
                }
            });
            // $('#subImagesDropzone').dropzone({
            var subimagedrop = new Dropzone('#subImagesDropzone',{
                url: '{{ route('product.edit_sub_images', $product->id) }}',
                paramName: 'image',
                uploadMultiple: false,
                maxFiles: 10,
                maxFilesize: 2,
                acceptedFiles: 'image/*',
                dictDefaultMessage: 'Drag and drop files',
                dictRemoveFile: 'Remove',
                addRemoveLinks: true,
                params: {
                    _token: '{{ csrf_token() }}',
                },
                removedfile: function(file){
                    $.ajax({
                        dataType: 'json',
                        type: 'post',
                        url: '{{ route('product.delete_sub_image') }}',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'id': file.id,
                        },
                    });

                    var _ref;
                    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                },
                init: function(){
                    let mockfile;
                    @foreach($product->files as $file)
                        mockfile = {name: '{{ $file->file_prev_name }}', size: {{ $file->size }}, id: '{{ $file->id }}'};
                        this.displayExistingFile(mockfile, '{{ asset('storage/' . $file->file) }}');
                    @endforeach

                    this.on('sending', function(file, xhr, formData){
                        formData.append('id', '');
                        file.id = '';
                    });

                    this.on('success', function (file, response) {
                        file.id = response.id;
                    })
                }
            });
        });
    </script>
@endsection
