<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{asset('adminpanel/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">E-commerce</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('adminpanel/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('admin.dashboard') }}" class="d-block">
                    {{\Illuminate\Support\Facades\Auth::guard('admin')->user()->name}}
                </a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::currentRouteNamed('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        <p>{{ __('admin.dashboard') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.settings') }}" class="nav-link {{ Route::currentRouteNamed('admin.settings') ? 'active' : '' }}">
                        <i class="fas fa-cog nav-icon"></i>
                        <p>{{ __('admin.settings') }}</p>
                    </a>
                </li>
                <li class="nav-item
                    {{ Route::currentRouteNamed('admin.showadmins') ? 'menu-open' : '' }}
                    {{ Route::currentRouteNamed('admin.create') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            {{ __('admin.admin_account') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{ route('admin.showadmins') }}" class="nav-link {{ Route::currentRouteNamed('admin.showadmins') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('admin.all') }}</p>
                                <span class="badge badge-info right">
                                    {{ \App\Models\Admin::count() }}
                                </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.create') }}" class="nav-link {{ Route::currentRouteNamed('admin.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('admin.add') }}</p>
                                <span class="badge badge-info right"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item
                    {{ Route::currentRouteNamed('user.showusers') ? 'menu-open' : '' }}
                    {{ Route::currentRouteNamed('user.showlevel.user') ? 'menu-open' : '' }}
                    {{ Route::currentRouteNamed('user.showlevel.company') ? 'menu-open' : '' }}
                    {{ Route::currentRouteNamed('user.showlevel.vendor') ? 'menu-open' : '' }}
                    ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            {{ __('admin.user_account') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.showusers') }}" class="nav-link {{ Route::currentRouteNamed('user.showusers') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('admin.all') }}</p>
                                <span class="badge badge-info right">
                                    {{ \App\Models\User::count() }}
                                </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('user.showlevel.user') }}" class="nav-link {{ Route::currentRouteNamed('user.showlevel.user') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('admin.users') }}</p>
                                <span class="badge badge-info right">
                                    {{ \App\Models\User::where('level', 'user')->count() }}
                                </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('user.showlevel.company') }}" class="nav-link {{ Route::currentRouteNamed('user.showlevel.company') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('admin.companies') }}</p>
                                <span class="badge badge-info right">
                                    {{ \App\Models\User::where('level', 'company')->count() }}
                                </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('user.showlevel.vendor') }}" class="nav-link {{ Route::currentRouteNamed('user.showlevel.vendor') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('admin.vendors') }}</p>
                                <span class="badge badge-info right">
                                    {{ \App\Models\User::where('level', 'vendor')->count() }}
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item
                    {{ Route::currentRouteNamed('country.showcountries') ? 'menu-open' : '' }}
                    {{ Route::currentRouteNamed('country.create') ? 'menu-open' : '' }}
                    ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-flag"></i>
                        <p>
                            {{ __('admin.countries') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('country.showcountries') }}" class="nav-link {{ Route::currentRouteNamed('country.showcountries') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('admin.all') }}</p>
                                <span class="badge badge-info right">
                                    {{ \App\Models\Country::count() }}
                            </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('country.create') }}" class="nav-link {{ Route::currentRouteNamed('country.create') ? 'active' : '' }}">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>{{ __('admin.add') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item
                    {{ Route::currentRouteNamed('city.showcities') ? 'menu-open' : '' }}
                    {{ Route::currentRouteNamed('city.create') ? 'menu-open' : '' }}
                    ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-city"></i>
                        <p>
                            {{ __('admin.cities') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('city.showcities') }}" class="nav-link {{ Route::currentRouteNamed('city.showcities') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('admin.all') }}</p>
                                <span class="badge badge-info right">
                                    {{ \App\Models\City::count() }}
                            </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('city.create') }}" class="nav-link {{ Route::currentRouteNamed('city.create') ? 'active' : '' }}">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>{{ __('admin.add') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item
                    {{ Route::currentRouteNamed('state.showstates') ? 'menu-open' : '' }}
                    {{ Route::currentRouteNamed('state.create') ? 'menu-open' : '' }}
                    ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chess-rook"></i>
                        <p>
                            {{ __('admin.states') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('state.showstates') }}" class="nav-link {{ Route::currentRouteNamed('state.showstates') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('admin.all') }}</p>
                                <span class="badge badge-info right">
                                    {{ \App\Models\State::count() }}
                            </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('state.create') }}" class="nav-link {{ Route::currentRouteNamed('state.create') ? 'active' : '' }}">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>{{ __('admin.add') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item
                    {{ Route::currentRouteNamed('department.showdepartments') ? 'menu-open' : '' }}
                    {{ Route::currentRouteNamed('department.create') ? 'menu-open' : '' }}
                    ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chess-rook"></i>
                        <p>
                            {{ __('admin.departments') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('department.showdepartments') }}" class="nav-link {{ Route::currentRouteNamed('department.showdepartments') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('admin.all') }}</p>
                                <span class="badge badge-info right">
                                    {{ \App\Models\Department::count() }}
                            </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('department.create') }}" class="nav-link {{ Route::currentRouteNamed('department.create') ? 'active' : '' }}">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>{{ __('admin.add') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item
                    {{ Route::currentRouteNamed('trademark.showtrademarks') ? 'menu-open' : '' }}
                    {{ Route::currentRouteNamed('trademark.create') ? 'menu-open' : '' }}
                    ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cube"></i>
                        <p>
                            {{ __('admin.trademark') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('trademark.showtrademarks') }}" class="nav-link {{ Route::currentRouteNamed('trademark.showtrademarks') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('admin.all') }}</p>
                                <span class="badge badge-info right">
                                    {{ \App\Models\TradeMark::count() }}
                            </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('trademark.create') }}" class="nav-link {{ Route::currentRouteNamed('trademark.create') ? 'active' : '' }}">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>{{ __('admin.add') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item
                    {{ Route::currentRouteNamed('manufacture.showmanufactures') ? 'menu-open' : '' }}
                    {{ Route::currentRouteNamed('manufacture.create') ? 'menu-open' : '' }}
                    ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-industry"></i>
                        <p>
                            {{ __('admin.manufacture') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('manufacture.showmanufactures') }}" class="nav-link {{ Route::currentRouteNamed('manufacture.showmanufactures') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('admin.all') }}</p>
                                <span class="badge badge-info right">
                                    {{ \App\Models\Manufact::count() }}
                            </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('manufacture.create') }}" class="nav-link {{ Route::currentRouteNamed('manufacture.create') ? 'active' : '' }}">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>{{ __('admin.add') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item
                    {{ Route::currentRouteNamed('shipping.showshippings') ? 'menu-open' : '' }}
                    {{ Route::currentRouteNamed('shipping.create') ? 'menu-open' : '' }}
                    ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>
                            {{ __('admin.shipping') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('shipping.showshippings') }}" class="nav-link {{ Route::currentRouteNamed('shipping.showshippings') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('admin.all') }}</p>
                                <span class="badge badge-info right">
                                    {{ \App\Models\Shipping::count() }}
                            </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('shipping.create') }}" class="nav-link {{ Route::currentRouteNamed('shipping.create') ? 'active' : '' }}">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>{{ __('admin.add') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item
                    {{ Route::currentRouteNamed('mall.showmalls') ? 'menu-open' : '' }}
                    {{ Route::currentRouteNamed('mall.create') ? 'menu-open' : '' }}
                    ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            {{ __('admin.malls') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('mall.showmalls') }}" class="nav-link {{ Route::currentRouteNamed('mall.showmalls') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('admin.all') }}</p>
                                <span class="badge badge-info right">
                                    {{ \App\Models\Mall::count() }}
                            </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('mall.create') }}" class="nav-link {{ Route::currentRouteNamed('mall.create') ? 'active' : '' }}">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>{{ __('admin.add') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item
                    {{ Route::currentRouteNamed('color.showcolors') ? 'menu-open' : '' }}
                    {{ Route::currentRouteNamed('color.create') ? 'menu-open' : '' }}
                    ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-palette"></i>
                        <p>
                            {{ __('admin.colors') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('color.showcolors') }}" class="nav-link {{ Route::currentRouteNamed('color.showcolors') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('admin.all') }}</p>
                                <span class="badge badge-info right">
                                    {{ \App\Models\Color::count() }}
                            </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('color.create') }}" class="nav-link {{ Route::currentRouteNamed('color.create') ? 'active' : '' }}">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>{{ __('admin.add') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item
                    {{ Route::currentRouteNamed('size.showsizes') ? 'menu-open' : '' }}
                    {{ Route::currentRouteNamed('size.create') ? 'menu-open' : '' }}
                    ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-info-circle"></i>
                        <p>
                            {{ __('admin.sizes') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('size.showsizes') }}" class="nav-link {{ Route::currentRouteNamed('size.showsizes') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('admin.all') }}</p>
                                <span class="badge badge-info right">
                                    {{ \App\Models\Size::count() }}
                            </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('size.create') }}" class="nav-link {{ Route::currentRouteNamed('size.create') ? 'active' : '' }}">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>{{ __('admin.add') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item
                    {{ Route::currentRouteNamed('weight.showweights') ? 'menu-open' : '' }}
                    {{ Route::currentRouteNamed('weight.create') ? 'menu-open' : '' }}
                    ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-info-circle"></i>
                        <p>
                            {{ __('admin.weights') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('weight.showweights') }}" class="nav-link {{ Route::currentRouteNamed('weight.showweights') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('admin.all') }}</p>
                                <span class="badge badge-info right">
                                    {{ \App\Models\Weight::count() }}
                            </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('weight.create') }}" class="nav-link {{ Route::currentRouteNamed('weight.create') ? 'active' : '' }}">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>{{ __('admin.add') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item
                    {{ Route::currentRouteNamed('product.showproducts') ? 'menu-open' : '' }}
                    {{ Route::currentRouteNamed('product.create') ? 'menu-open' : '' }}
                    ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tshirt"></i>
                        <p>
                            {{ __('admin.products') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('product.showproducts') }}" class="nav-link {{ Route::currentRouteNamed('product.showproducts') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('admin.all') }}</p>
                                <span class="badge badge-info right">
                                    {{ \App\Models\Product::count() }}
                            </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('product.create') }}" class="nav-link {{ Route::currentRouteNamed('product.create') ? 'active' : '' }}">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>{{ __('admin.add') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
