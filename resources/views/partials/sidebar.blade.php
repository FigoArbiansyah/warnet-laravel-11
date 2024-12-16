@php
    $menus = [
        'admin' => [ // admin
            (object) [
                'title' => 'Dashboard',
                'path' => '/',
                'icon' => 'fas fa-th',
            ],
            (object) [
                'title' => 'Komputer',
                'path' => 'computers',
                'icon' => 'fas fa-laptop',
            ],
            (object) [
                'title' => 'Harga Per Jam',
                'path' => 'billing-rates',
                'icon' => 'fas fa-clock',
            ],
        ],
    ];

    function _getPathUrl($strPath)
    {
        if ($strPath[0] === '/') {
            return $strPath;
        }
        return '/' . $strPath;
    }
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="https://img.icons8.com/?size=100&id=9913&format=png&color=686BFD" alt="Logo" class="brand-image"
            style="opacity: .8">
        <span class="brand-text font-weight-light">WarnetIn</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        @auth
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                {{-- <div class="image">
                    <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div> --}}
                <div class="info">
                    <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                </div>
            </div>
        @endauth

        <!-- SidebarSearch Form -->
        <div class="form-inline pt-2">
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
                {{-- <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Starter Pages
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Active Page</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inactive Page</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                @foreach ($menus['admin'] as $menu)
                <li class="nav-item">
                    <a href="{{ _getPathUrl($menu->path) }}" class="nav-link {{ request()->is($menu->path . '*') ? 'active' : '' }}">
                        <i class="nav-icon {{ $menu->icon }}"></i>
                        <p>
                            {{ $menu->title }}
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
