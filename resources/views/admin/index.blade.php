<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.layouts.header')
    @yield('header')
</head>

<body>
    @include('admin.layouts.navbar')
    @include('admin.layouts.sidebar')

    {{--    @include('admin.layouts.message')--}}
    @yield('content')

    @include('admin.layouts.footer')

    @yield('script')
</body>
</html>
