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
                    <img src="{{ asset('assets/images/'.auth()->user()->avatar) }}" class="img-circle elevation-2" alt="{{ auth()->user()->name }}">
                @else
                    <img src="{{ asset('assets/images/woman.png') }}" class="img-circle elevation-2" alt="{{ auth()->user()->name }}">
                @endif
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
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
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{url('/slides')}}" class="nav-link {{$currentAdminMenu == 'slide' ? 'active':''}}">
                                        <i class="fas fa-images nav-icon"></i>
                                        <p>Slide</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview {{$currentAdminSubMenu2 == 'users' ? 'menu-open':''}}">
                            <a href="#" class="nav-link">
                                <i class="fas fa-users-cog nav-icon"></i>
                                <p>
                                    Users
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{url('/user')}}" class="nav-link {{$currentAdminMenu == 'user' ? 'active':''}}">
                                        <i class="fas fa-user-plus nav-icon"></i>
                                        <p>User</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('/role')}}" class="nav-link {{$currentAdminMenu == 'role' ? 'active':''}}">
                                        <i class="fas fa-users nav-icon"></i>
                                        <p>Role</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link {{$currentAdminMenu == 'user' ? 'permission':''}}">
                                        <i class="fas fa-user-shield nav-icon"></i>
                                        <p>Permission</p>
                                    </a>
                                </li>
                            </ul>
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
