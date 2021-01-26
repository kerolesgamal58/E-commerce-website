@extends('admin.index')

@section('header')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminpanel/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminpanel/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminpanel/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminpanel/jstree/dist/themes/default/style.min.css') }}">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('admin.dashboard') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('admin.department') }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div class="container-fluid">
            @include('admin.layouts.message')
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('admin.department_control') }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <a href="" class="btn btn-info edit_dep showbtn-control d-none mb-3"><i class="fa fa-edit"></i></a>
                                <a href="" class="btn btn-danger delete_dep showbtn-control d-none mb-3"><i class="fa fa-trash"></i></a>
                                <div id="jstree"></div>
                                <input type="hidden" class="parent_id" name="parent_id" value="{{ old('parent_id') }}">
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('script')
    <!-- jQuery -->
    <script src="{{ asset('adminpanel/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminpanel/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('adminpanel/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminpanel/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminpanel/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('adminpanel/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminpanel/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('adminpanel/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminpanel/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('adminpanel/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('adminpanel/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('adminpanel/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('adminpanel/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('adminpanel/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('adminpanel/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('adminpanel/dist/js/demo.js')}}"></script>
    <!-- JsTree -->
    <script src="{{ asset('adminpanel/jstree/dist/jstree.min.js') }}"></script>
    <!-- Page specific script -->
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
        $(document).ready(function(){
            $('#jstree').jstree({
                "core" : {
                    'data' : {!! $departments !!},
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
                    console.log(data.instance.get_node(data.selected[i]).id);
                    r.push(data.instance.get_node(data.selected[i]).id);
                }
                $('.parent_id').val(r.join(','));
                if (r.join(',') != ''){
                    $('.showbtn-control').removeClass('d-none');
                    $('.edit_dep').attr('href', '{{ url('admin/departments/edit/') }}'+'/'+r.join(','))
                    $('.delete_dep').attr('href', '{{ url('admin/departments/delete/') }}'+'/'+r.join(','))
                }
                else{
                    $('.showbtn-control').addClass('d-none');
                }
            });
        });
    </script>
@endsection
