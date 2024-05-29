<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link d-flex">
        <img src="{{ asset('dist/img/logo.png') }}" alt="AdminLTE Logo" class="brand-image">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->username }}</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @can('dashboard_access')
                <li class="nav-item">
                    <a href="{{ route('admin.home') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @endcan

                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
                @can('role_access')
                <li class="nav-item">
                    <a href="{{ route('admin.roles.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>
                            Roles
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.permissions.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-lock"></i>
                        <p>
                            Permissions
                        </p>
                    </a>
                </li>
                @endcan
                @can('subscription_access')
                <li class="nav-item">
                    <a href="{{ route('admin.transactions.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-plus"></i>
                        <p>
                            Subscriptions
                        </p>
                    </a>
                </li>
                @endcan
                @can('transaction_access')
                <li class="nav-item">
                    <a href="{{ route('admin.transactions.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>
                            Transactions
                        </p>
                    </a>
                </li>
                @endcan
                @can('dashboard_access')
                <li class="nav-item {{ request()->is('admin/subscriptionStatuses*') ? 'menu-open' : '' }} {{ request()->is('admin/subscriptionTypes*') ? 'menu-open' : '' }} {{ request()->is('admin/transactionTypes*') ? 'menu-open' : '' }} {{ request()->is('admin/paymentMethodTypes*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Settings
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" >
                        <li class="nav-item">
                            <a href="{{ route('admin.subscriptionStatuses.index') }}" class="nav-link {{ request()->is('admin/subscriptionStatuses') || request()->is('admin/subscriptionStatuses/*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Subscription Statuses</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.subscriptionTypes.index') }}" class="nav-link {{ request()->is('admin/subscriptionTypes') || request()->is('admin/subscriptionTypes/*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Subscription Types</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.transactionTypes.index') }}" class="nav-link {{ request()->is('admin/transactionTypes') || request()->is('admin/transactionTypes/*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Transaction Types</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.paymentMethodTypes.index')}}" class="nav-link {{ request()->is('admin/paymentMethodTypes') || request()->is('admin/paymentMethodTypes/*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Payment Method Types</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i> {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
