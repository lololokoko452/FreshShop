<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link">
        <img src="{{ asset("backend/dist/img/AdminLTELogo.png") }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset("backend/dist/img/user2-160x160.jpg") }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview {{request()->is('admin') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{request()->is('admin') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.home') }}" class="nav-link {{request()->is('admin') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v1</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{request()->is('admin/category/index') || request()->is('admin/category/form') ? 'menu-open' : ''}}">
                    <a href="" class="nav-link {{request()->is('admin/category/index') || request()->is('admin/category/form') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Categories
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.category.new') }}" class="nav-link {{request()->is('admin/category/form') ? 'active' : ''}}">
                                <i class="far fa-file nav-icon"></i>
                                <p>Add category</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.category.index') }}" class="nav-link {{ request()->is('admin/category/index') ? 'active' : ''}}">
                                <i class="far fa-file nav-icon"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{request()->is('admin/slider/index') || request()->is('admin/slider/new') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{request()->is('admin/slider/index') || request()->is('admin/slider/new') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Sliders
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.slider.new') }}" class="nav-link {{request()->is('admin/slider/new') ? 'active' : ''}}">
                                <i class="far fa-file nav-icon"></i>
                                <p>Add slider</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.slider.index') }}" class="nav-link {{request()->is('admin/slider/index') ? 'active' : ''}}">
                                <i class="far fa-file nav-icon"></i>
                                <p>Sliders</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{request()->is('admin/product/index') || request()->is('admin/product/new') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{request()->is('admin/product/index') || request()->is('admin/product/new') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Products
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.product.new') }}" class="nav-link {{request()->is('admin/product/new') ? 'active' : ''}}">
                                <i class="far fa-file nav-icon"></i>
                                <p>Add product</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.product.index') }}" class="nav-link {{request()->is('admin/product/index') ? 'active' : ''}}">
                                <i class="far fa-file nav-icon"></i>
                                <p>Products</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{request()->is('admin/order/index') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{request()->is('admin/order/index') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Orders
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.order.index') }}" class="nav-link {{request()->is('admin/order/index') ? 'active' : ''}}">
                                <i class="far fa-file nav-icon"></i>
                                <p>Orders</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header">MISCELLANEOUS</li>
                <li class="nav-item">
                    <a href="https://adminlte.io/docs/3.0/" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Documentation</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
