<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AdminLTE 3 | Dashboard</title>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('adminpanel/plugins/fontawesome-free/css/all.min.css')}}">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{asset('adminpanel/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
<!-- iCheck -->
<link rel="stylesheet" href="{{asset('adminpanel/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<!-- JQVMap -->
<link rel="stylesheet" href="{{asset('adminpanel/plugins/jqvmap/jqvmap.min.css')}}">
<!-- Theme style -->
@if(LaravelLocalization::getCurrentLocale() == 'en')
    <link rel="stylesheet" href="{{asset('adminpanel/dist/css/adminlte.min.css')}}">
@elseif(LaravelLocalization::getCurrentLocale() == 'ar')
    <link rel="stylesheet" href="{{asset('adminpanel/dist/css/adminlte.min.css')}}">
{{--    <link rel="stylesheet" href="{{asset('adminpanel/dist/css/rtl/AdminLTE.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('adminpanel/dist/css/rtl/bootstrap-rtl.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('adminpanel/dist/css/rtl/rtl.css')}}">--}}
@endif
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{asset('adminpanel/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{asset('adminpanel/plugins/daterangepicker/daterangepicker.css')}}">
<!-- summernote -->
<link rel="stylesheet" href="{{asset('adminpanel/plugins/summernote/summernote-bs4.min.css')}}">
<!-- Bootstrap rtl -->
{{--<link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css" integrity="sha384-JvExCACAZcHNJEc7156QaHXTnQL3hQBixvj5RV5buE7vgnNEzzskDtx9NQ4p6BJe" crossorigin="anonymous">--}}

