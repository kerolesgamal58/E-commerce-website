<div class="header-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="user-menu">
                    <ul>
                        @if(\Illuminate\Support\Facades\Auth::guard('customer')->check())
                            <li><a href="#"><i class="fa fa-user"></i>{{ __('admin.my_account') }}</a></li>
                            <li><a href="#"><i class="fa fa-heart"></i>{{ __('admin.wishlist') }}</a></li>
                            <li><a href="{{ route('customer.get_cart') }}"><i class="fa fa-user"></i>{{ __('admin.my_cart') }}</a></li>
                            <li><a href="{{ route('customer.get_checkout') }}"><i class="fa fa-user"></i>{{ __('admin.checkout') }}</a></li>
                            <li><a href="{{ route('customer.logout') }}"><i class="fa fa-user"></i>{{ __('admin.logout') }}</a></li>
                        @else
                        <li><a href="{{ route('customer.login') }}"><i class="fa fa-user"></i>{{ __('admin.login') }}</a></li>
                        <li><a href="{{ route('customer.signin') }}"><i class="fa fa-user"></i>{{ __('admin.signin') }}</a></li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="header-right">
                    <ul class="list-unstyled list-inline">
                        <li class="dropdown dropdown-small">
                            <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#">@if(LaravelLocalization::getCurrentLocale() == 'ar')اللغة @elseif(LaravelLocalization::getCurrentLocale() == 'en') Language @endif</a>
                            <ul class="dropdown-menu">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <li>
                                        <a rel="alternate" class="nav-link" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                            {{ $properties['native'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End header area -->

<div class="site-branding-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="logo">
                    <h1><a href="./"><img src="{{ asset('storage/images/logo/logo.png') }}"></a></h1>
                </div>
            </div>

            @if(\Illuminate\Support\Facades\Auth::guard('customer')->check())
                <div class="col-sm-6">
                    <div class="shopping-item">
                        <a href="{{ route('customer.get_cart') }}">{{ __('admin.cart') }} - <span class="cart-amunt">${!! App\Helper\calcCartCach() !!}</span> <i class="fa fa-shopping-cart"></i> <span class="product-count">{!! App\Helper\getNoProductsInCart() !!}</span></a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div> <!-- End site branding area -->
