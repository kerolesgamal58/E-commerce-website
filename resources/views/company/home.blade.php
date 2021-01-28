@extends('company.index')
@section('header')
    <style>
        #notificationPopUp{
            height: 100px;
            width: 300px;
            border-radius: 5px;
            padding: 5px;
            background-color: #8fdf82;
            position: absolute;
            bottom: 20px;
            right: 20px;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="container">
            @if( is_null($orders) || $orders->count() == 0 )
                <h3 class="text-center pt-5">
                    {{ __('admin.no_data') }}
                </h3>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('admin.name') }}</th>
                        <th scope="col">{{ __('admin.product_id') }}</th>
                        <th scope="col">{{ __('admin.country') }}</th>
                        <th scope="col">{{ __('admin.city') }}</th>
                        <th scope="col">{{ __('admin.address') }}</th>
                        <th scope="col">{{ __('admin.postcode') }}</th>
                        <th scope="col">{{ __('admin.email') }}</th>
                        <th scope="col">{{ __('admin.mobile') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <th scope="row">{{ $order->id }}</th>
                                <td>{{ $order->customer->first_name . ' ' . $order->customer->last_name }}</td>
                                <td>{{ $order->customer_product->product_id }}</td>
                                <td>{{ $order->country->name }}</td>
                                <td>{{ $order->city->name }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->postcode }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->mobile }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            {{ $orders->links() }}
            <div id="notificationPopUp" class="d-none">

            </div>
        </section>
    </div>
@endsection

@section('script')
    <!-- jQuery -->
    <script src="{{asset('adminpanel/plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('adminpanel/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('adminpanel/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{asset('adminpanel/plugins/chart.js/Chart.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{asset('adminpanel/plugins/sparklines/sparkline.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{asset('adminpanel/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('adminpanel/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('adminpanel/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('adminpanel/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('adminpanel/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('adminpanel/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('adminpanel/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('adminpanel/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('adminpanel/dist/js/adminlte.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('adminpanel/dist/js/demo.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('adminpanel/dist/js/pages/dashboard.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.notificationTap').on('click', function (e) {
                e.preventDefault();
                let element = $(this);
                let notification_no = element[0]['attributes'][1]['value'];
                console.log(element);
                $.ajax({
                    url: '{{ route('company.mark_notification_as_read') }}',
                    type: 'post',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: notification_no,
                    },
                    success: function (data) {
                        // console.log(data);
                        element.removeClass('active');

                    }
                })
            });
            window.setInterval(function () {
                $.ajax({
                    url: '{{ route('company.notification.check') }}',
                    method: 'post',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function (data) {
                        if (data.status === true){
                            // show and hide notification popup
                            $('#notificationPopUp').append(`
                                <p class="mx-2">${data.notification.title}</p>
                                <p class="mx-2 mt-2">${data.notification.content}</p>
                            `).removeClass('d-none');
                            setTimeout(function () {
                                $('#notificationPopUp').addClass('d-none').children().remove();
                            }, 8000);

                            // raise notification counter
                            let notificationCounter = $('#notificationCounter').text();
                            notificationCounter = parseInt(notificationCounter, 10);
                            notificationCounter += 1;
                            $('#notificationCounter').text(notificationCounter);

                            // add new notification to notification menu
                            $('#notificationMenu').append(`
                                <a href="" notificationNo="${data.notification.id}" class="notificationTap dropdown-item active">
                                    <i class="fas fa-users mr-2"></i> ${data.notification.title}
                                        <span class="float-right text-muted text-sm">${data.notification.created_at}</span>
                                    <P>${data.notification.content}<p/>
                                </a>
                                <div class="dropdown-divider"></div>
                            `);
                        }
                    }
                });
            }, 10000);
        });
    </script>
@endsection
