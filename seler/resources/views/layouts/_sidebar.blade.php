<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
        <img src="{{asset('assets/images/logo.png')}}" alt="logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Beauty</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (auth()->user()->avatar != null)
                    <img src="{{ asset('assets/images/'.auth()->user()->avatar) }}" class="img-circle elevation-2" alt="{{ auth()->user()->first_name }}">
                @else
                    <img src="{{ asset('assets/images/woman.png') }}" class="img-circle elevation-2" alt="{{ auth()->user()->first_name }}">
                @endif
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->first_name }}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                <a href="/dashboard" class="nav-link {{$currentAdminMenu == 'dashboard' ? 'active':''}}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
                </li>
                <li class="nav-item has-treeview {{$currentAdminSubMenu1 == 'products' ? 'menu-open':''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cubes"></i>
                        <p>
                            Products
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/category')}}" class="nav-link {{$currentAdminMenu == 'category' ? 'active':''}}">
                                <i class="nav-icon fas fa-layer-group"></i>
                                <p>Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/product/attribute')}}" class="nav-link {{$currentAdminMenu == 'attribute' ? 'active':''}}">
                                <i class="nav-icon fas fa-list"></i>
                                <p>Attribute</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/product')}}" class="nav-link {{$currentAdminMenu == 'product' ? 'active':''}}">
                                <i class="nav-icon fas fa-archive"></i>
                                <p>Product</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{$currentAdminSubMenu1 == 'orders' ? 'menu-open':''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Orders
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/orders')}}" class="nav-link {{$currentAdminMenu == 'order' ? 'active':''}}">
                                <i class="nav-icon fas fa-truck-loading"></i>
                                <p>Order</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/orders/trashed')}}" class="nav-link {{$currentAdminMenu == 'trash' ? 'active':''}}">
                                <i class="nav-icon fas fa-trash"></i>
                                <p>Trash</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('shipments')}}" class="nav-link {{$currentAdminMenu == 'shipment' ? 'active':''}}">
                                <i class="nav-icon fas fa-truck-moving"></i>
                                <p>Shipment</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{$currentAdminSubMenu1 == 'reports' ? 'menu-open':''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Reports
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/reports/revenue')}}" class="nav-link {{$currentAdminMenu == 'reports-revenue' ? 'active':''}}">
                                <i class="nav-icon fas fa-dollar-sign"></i>
                                <p>Revenue</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/reports/product')}}" class="nav-link {{$currentAdminMenu == 'reports-product' ? 'active':''}}">
                                <i class="nav-icon fas fa-cubes"></i>
                                <p>Product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/reports/inventory')}}" class="nav-link {{$currentAdminMenu == 'reports-inventory' ? 'active':''}}">
                                <i class="nav-icon fas fa-dolly-flatbed"></i>
                                <p>Inventory</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/reports/payment')}}" class="nav-link {{$currentAdminMenu == 'reports-payment' ? 'active':''}}">
                                <i class="nav-icon fas fa-money-bill-wave"></i>
                                <p>Payment</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{$currentAdminSubMenu1 == 'settings' ? 'menu-open':''}}">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-cogs"></i>
                      <p>
                        Settings
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item has-treeview {{$currentAdminSubMenu2 == 'generals' ? 'menu-open':''}}">
                            <a href="#" class="nav-link">
                                <i class="fas fa-sliders-h nav-icon"></i>
                                <p>
                                    Generals
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            {{-- <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{url('/slides')}}" class="nav-link {{$currentAdminMenu == 'slide' ? 'active':''}}">
                                        <i class="fas fa-images nav-icon"></i>
                                        <p>Slide</p>
                                    </a>
                                </li>
                            </ul> --}}
                        </li>
                    </ul>
                  </li>
                <li class="nav-item">
                    <a
                        class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
                    >
                        <i class="nav-icon fas fa-power-off"></i>
                        <p>
                        {{ __('Logout') }}
                        </p>
                    </a>
                    <form id="logout-form"
                        action="{{ route('logout') }}"
                        method="POST"
                        style="display: none;"
                    >
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>

    </div>

</aside>
