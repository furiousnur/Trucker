<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <ul class="app-menu">
        <li><a class="app-menu__item" href="{{route('front.home')}}" target="_blank"><i class="app-menu__icon fa fa-home"></i><span class="app-menu__label">Home Page</span></a></li>
        @can('dashboard-sidebar')
            <li>
                <a class="app-menu__item {{ Request::segment(1) == 'dashboard'  ? 'active' : ''}}" href="{{route('dashboard')}}">
                    <i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span>
                </a>
            </li>
        @endcan
        @can('location-sidebar')
            <li><a class="app-menu__item {{ Request::segment(1) == 'location'  ? 'active' : ''}}" href="{{route('location.index')}}"><i class="app-menu__icon fa fa-location-arrow"></i><span class="app-menu__label">Locations</span></a></li>
        @endcan
        @can('location-price-sidebar')
            <li><a class="app-menu__item {{ Request::segment(1) == 'location-price'  ? 'active' : ''}}" href="{{route('location-price.index')}}"><i class="app-menu__icon fa fa-money"></i><span class="app-menu__label">Location Price</span></a></li>
        @endcan
        @can('booking-sidebar')
            <li><a class="app-menu__item {{ Request::segment(1) == 'booking'  ? 'active' : ''}}" href="{{route('booking.index')}}"><i class="app-menu__icon fa fa-save"></i><span class="app-menu__label">Booking List</span></a></li>
        @endcan
        @can('payment-sidebar')
            <li><a class="app-menu__item {{ Request::segment(1) == 'payment-list'  ? 'active' : ''}}" href="{{route('payment.list')}}"><i class="app-menu__icon fa fa-paypal"></i><span class="app-menu__label">Payment List</span></a></li>
        @endcan
        @can('passenger-sidebar')
            <li><a class="app-menu__item {{ Request::segment(1) == 'passenger'  ? 'active' : ''}}" href="{{route('passenger.list')}}"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Passengers</span></a></li>
        @endcan
        @can('driver-sidebar')
            <li><a class="app-menu__item {{ Request::segment(1) == 'driver-list'  ? 'active' : ''}}" href="{{route('driver.list')}}"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Drivers</span></a></li>
        @endcan
        @can('user-sidebar')
            <li><a class="app-menu__item {{ Request::segment(1) == 'users'  ? 'active' : ''}}" href="{{route('users.index')}}"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">All Users</span></a></li>
        @endcan
        @can('role-sidebar')
            <li><a class="app-menu__item {{ Request::segment(1) == 'roles'  ? 'active' : ''}}" href="{{route('roles.index')}}"><i class="app-menu__icon fa fa-assistive-listening-systems"></i><span class="app-menu__label">Roles</span></a></li>
        @endcan

    </ul>
</aside>
