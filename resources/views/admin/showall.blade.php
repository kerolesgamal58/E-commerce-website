@extends('admin.index')

@section('header')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminpanel/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminpanel/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminpanel/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
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
                            <li class="breadcrumb-item active">{{ __('admin.admins') }}</li>
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
                                <h3 class="card-title">{{ __('admin.admin_control') }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <a href="{{ route('admin.create') }}" class="btn btn-primary mb-4">
                                    {{ __('admin.add_new_admin') }}
                                    <i class="fas fa-user-plus"></i>
                                </a>
                                <button id="delete_selected" class="btn btn-danger mb-4">
                                    {{ __('admin.delete_selected') }}
                                    <i class="fas fa-user-minus"></i>
                                </button>
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox" id="check_all"></th>
                                        <th>{{ __('admin.id') }}</th>
                                        <th>{{ __('admin.name') }}</th>
                                        <th>{{ __('admin.email') }}</th>
                                        <th>{{ __('admin.created_at') }}</th>
                                        <th>{{ __('admin.updated_at') }}</th>
                                        <th>{{ __('admin.edit') }}</th>
                                        <th>{{ __('admin.delete') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($admins as $admin)
                                        <tr>
                                            <td><input type="checkbox" class="selected"></td>
                                            <td class="id">{{ $admin->id }}</td>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>{{ $admin->created_at }}</td>
                                            <td>{{ $admin->updated_at }}</td>
                                            <td>
                                                <a href="{{ route('admin.edit', $admin->id) }}">
                                                    <i class="fa fa-user-edit"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.delete', $admin->id) }}">
                                                    <i class="fas fa-user-minus"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>{{ __('admin.id') }}</th>
                                        <th>{{ __('admin.name') }}</th>
                                        <th>{{ __('admin.email') }}</th>
                                        <th>{{ __('admin.created_at') }}</th>
                                        <th>{{ __('admin.updated_at') }}</th>
                                        <th>{{ __('admin.edit') }}</th>
                                        <th>{{ __('admin.delete') }}</th>
                                    </tr>
                                    </tfoot>
                                </table>
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
        $(document).ready(
            $('#check_all').click(function(){
                $('input:checkbox').not(this).prop('checked', this.checked)
            }),
            $('#delete_selected').click(function(){
                let id = [];
                let raws_of_selected_items = [];
                $('.selected').each(function(){
                    if( $(this).is(':checked') ){
                        raws_of_selected_items.push( $(this).parent().parent() );
                        let adminId = $(this).parent().siblings('.id').text();
                        id.push(adminId);
                    }
                });
                $.ajax({
                    method: 'post',
                    url: '{{ route('admin.delete.post') }}',
                    data: {
                        'ids': id,
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function(data){
                        if(data.status == true){
                            raws_of_selected_items.forEach(function (item) {
                                $(item).remove();
                            })
                        }
                    }
                })
            })
        );
    </script>
@endsection
