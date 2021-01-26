<div class="mainmenu-area">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="{{ Route::currentRouteNamed('homepage') ? 'active' : '' }}"><a href="{{ route('homepage') }}">{{ __('admin.home') }}</a></li>
                    <li class="{{ Route::currentRouteNamed('customer.shop_page') ? 'active' : '' }}"><a href="{{ route('customer.shop_page') }}">{{ __('admin.shop_page') }}</a></li>
{{--                    <li><a href="single-product.html">Single product</a></li>--}}
                    <li class="{{ Route::currentRouteNamed('customer.get_cart') ? 'active' : '' }}">
                        <a href="{{ route('customer.get_cart') }}">{{ __('admin.cart') }}</a>
                    </li>
                    <li class="{{ Route::currentRouteNamed('customer.get_checkout') ? 'active' : '' }}">
                        <a href="{{ route('customer.get_checkout') }}">{{ __('admin.checkout') }}</a>
                    </li>
                    <li class="{{ Route::currentRouteNamed('customer.get_orders') ? 'active' : '' }}">
                        <a href="{{ route('customer.get_orders') }}">{{ __('admin.orders') }}</a>
                    </li>
{{--                    <li><a href="#">Category</a></li>--}}
{{--                    <li><a href="#">Others</a></li>--}}
{{--                    <li><a href="#">Contact</a></li>--}}
                </ul>
            </div>
        </div>
    </div>
</div> <!-- End mainmenu area -->
