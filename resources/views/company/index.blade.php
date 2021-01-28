<!DOCTYPE html>
<html lang="en">
<head>
    @include('company.layouts.header')
    @yield('header')
</head>

<body>
    @include('company.layouts.navbar')
    @include('company.layouts.sidebar')

    {{--    @include('admin.layouts.message')--}}
    @yield('content')

    @include('company.layouts.footer')

    @yield('script')
</body>
</html>
