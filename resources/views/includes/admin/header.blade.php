<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">{{ trans('header.home') }}</a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">

      <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                <i class="far fa-bell"></i>

                <span class="badge badge-warning navbar-badge">{{ $countNotification ?? '' }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">{{ $countNotification ?? '' }} {{ trans('text.notifications') }}</span>
                <div class="dropdown-divider"></div>
                @foreach ($notifications as $notification)
                    <a href="{{ route('admin.orders') }}" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i><p style="display: inline;">{{ $notification->data }}</p>
                        <span class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                    </a>
                @endforeach
                <div class="dropdown-divider"></div>
                <a href="{{ route('admin.list_notification') }}" class="dropdown-item dropdown-footer">{{ trans('text.see_all_notifications') }}</a>
            </div>
        </li>

    </ul>
</nav>

<aside class="main-sidebar sidebar-dark-primary elevation-4" style="position: fixed">
    <!-- Brand Logo -->
    <div class="user-panel d-flex justify-content-center" style="background-color: white;">
        <div class="info">
            <a href="{{ route('index') }}" class="d-block">
                <img src="{{ asset('bower_components/bower_fashi_shop/img/logo.png') }}" style="width: 100%"
                    class="mt-3 mb-2">
            </a>
        </div>
    </div>
    <div class="brand-link">
        <a href="#" class="nav-link">
            <img src="{{ asset('bower_components/bower_admin/dist/img/AdminLTELogo.png') }}" class="brand-image img-circle elevation-3">
            <span class="brand-text font-weight-light" style="color: rgba(255,255,255,.8);">
                {{ trans('header.admin') }}
            </span>
        </a>
    </div>
        <!-- Sidebar -->
    <div class="sidebar">

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item brand-link">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>{{ trans('header.dashboard') }}</p>
                    </a>
                </li>
                <li class="nav-item brand-link">
                    <a href="{{ route('admin.categories.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>{{ trans('text.category') }}</p>
                    </a>
                </li>
                <li class="nav-item brand-link">
                    <a href="{{ route('admin.products.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tshirt"></i>
                        <p>{{ trans('text.product') }}</p>
                    </a>
                </li>
                <li class="nav-item brand-link">
                    <a href="{{ route('admin.orders') }}" class="nav-link">
                        <i class="nav-icon fas fa-clipboard"></i>
                        <p>{{ trans('text.order') }}</p>
                    </a>
                </li>
                <li class="nav-item brand-link">
                    <a href="{{ route('admin.user.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>{{ trans('text.user') }}</p>
                    </a>
                </li>
{{--                <li class="nav-item menu-open">--}}
{{--                    <a href="#" class="nav-link active">--}}
{{--                        <i class="nav-icon fas fa-table"></i>--}}
{{--                        <p>{{ trans('header.tables') }}<i class="fas fa-angle-left right"></i></p>--}}
{{--                    </a>--}}
{{--                    <ul class="nav nav-treeview">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{ route('admin.categories.index') }}" class="nav-link active">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>{{ trans('text.category') }}</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{ route('admin.products.index') }}" class="nav-link active">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>{{ trans('text.product') }}</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{ route('admin.orders') }}" class="nav-link active">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>{{ trans('text.order') }}</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{ route('admin.user.index') }}" class="nav-link active">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>{{ trans('text.user') }}</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{ route('admin.list_notification') }}" class="nav-link active">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>{{ trans('text.notifications') }}</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
            </ul>
        </nav>
                <!-- /.sidebar-menu -->
    </div>
                <!-- /.sidebar -->
</aside>
