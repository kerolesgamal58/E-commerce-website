<!doctype html>
<html lang="en">
<head>
    @include('frontend.layouts.header')
    <title>
        @yield('title')
    </title>
    @yield('head')
</head>
<body>
@include('frontend.layouts.navbar')
@include('frontend.layouts.menu')
@yield('content')
@include('frontend.layouts.footer')
@yield('scripts')
</body>
</html>
