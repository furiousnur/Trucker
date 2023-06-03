<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <ul class="app-menu">
        {{--@can('dashboard-sidebar')
            <li>
                <a class="app-menu__item {{ Request::segment(1) == 'dashboard'  ? 'active' : ''}}" href="{{route('dashboard')}}">
                    <i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span>
                </a>
            </li>
        @endcan
        @can('products-sidebar')
            <li><a class="app-menu__item {{ Request::segment(2) == 'products'  ? 'active' : ''}}" href="{{route('products')}}"><i class="app-menu__icon fa fa-hdd-o"></i><span class="app-menu__label">Products</span></a></li>
            <li><a class="app-menu__item {{ Request::segment(2) == 'add-product'  ? 'active' : ''}}" href="{{route('add.product')}}"><i class="app-menu__icon fa fa-plus"></i><span class="app-menu__label">Add Product</span></a></li>
        @endcan
        @can('customer-sidebar')
            <li><a class="app-menu__item {{ Request::segment(2) == 'customers'  ? 'active' : ''}}" href="{{route('customers')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Customer</span></a></li>
        @endcan
        @can('invoice-sidebar')
            <li><a class="app-menu__item {{ Request::segment(2) == 'add-invoice'  ? 'active' : ''}}" href="{{route('add.invoice')}}"><i class="app-menu__icon fa fa-print"></i><span class="app-menu__label">Invoice</span></a></li>
        @endcan
        @can('invoice-report-sidebar')
            <li><a class="app-menu__item {{ Request::segment(2) == 'invoice-report'  ? 'active' : ''}}" href="{{route('invoice.report')}}"><i class="app-menu__icon fa fa-history"></i><span class="app-menu__label">Invoice Report</span></a></li>
        @endcan--}}
        <li>
            <a class="app-menu__item {{ Request::segment(1) == 'dashboard'  ? 'active' : ''}}" href="{{route('dashboard')}}">
                <i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span>
            </a>
        </li>
        @can('location-sidebar')
            <li><a class="app-menu__item {{ Request::segment(1) == 'location'  ? 'active' : ''}}" href="{{route('location.index')}}"><i class="app-menu__icon fa fa-history"></i><span class="app-menu__label">Locations</span></a></li>
        @endcan
        @can('location-price-sidebar')
            <li><a class="app-menu__item {{ Request::segment(1) == 'location-price'  ? 'active' : ''}}" href="{{route('location-price.index')}}"><i class="app-menu__icon fa fa-history"></i><span class="app-menu__label">Location Price</span></a></li>
        @endcan
        @can('user-sidebar')
            <li><a class="app-menu__item {{ Request::segment(1) == 'users'  ? 'active' : ''}}" href="{{route('users.index')}}"><i class="app-menu__icon fa fa-history"></i><span class="app-menu__label">Users</span></a></li>
        @endcan
        @can('role-sidebar')
            <li><a class="app-menu__item {{ Request::segment(1) == 'roles'  ? 'active' : ''}}" href="{{route('roles.index')}}"><i class="app-menu__icon fa fa-history"></i><span class="app-menu__label">Roles</span></a></li>
        @endcan

    </ul>
</aside>
