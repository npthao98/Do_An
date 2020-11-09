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

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('bower_components/bower_admin/dist/img/AdminLTELogo.png') }}" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">{{ trans('header.admin') }}</span>
    </a>
        <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block"><h5>{{-- name --}}</h5></a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>{{ trans('header.dashboard') }}<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ trans('header.dashboard') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-table"></i>
                        <p>{{ trans('header.tables') }}<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.categories.index') }}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ trans('text.category') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.products.index') }}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ trans('text.product') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.orders') }}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ trans('text.order') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.user.index') }}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ trans('text.user') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.list_notification') }}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ trans('text.notifications') }}</p>
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
