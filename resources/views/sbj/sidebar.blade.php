<aside class="main-sidebar elevation-4 sidebar-primary">

    <a href="/home" class="brand-link">
        <img src="{{ URL::asset('assets/dist/img/sbjback.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">SBJ Ekspedisi</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @hasanyrole('Admin')
                <li class="nav-item">
                    <a href="{{ route('Typebarang.index') }}" class="nav-link {{ request()->routeIs('Typebarang.*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-truck-front text-info"></i>
                        <p>
                            Master Type
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('angsuran.index') }}" class="nav-link {{ request()->routeIs('angsuran.*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-solid fa-credit-card text-warning"></i>
                        <p>
                            Angsuran
                        </p>
                    </a>
                </li>
                 <li class="nav-item">
                    <a href="{{ route('finance.index') }}" class="nav-link {{ request()->routeIs('finance.*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-solid fa-credit-card text-Success"></i>
                        <p>
                            Finance
                        </p>
                    </a>
                </li>
                @endhasanyrole
                @hasanyrole('Admin|ekspedisi')
                <li class="nav-header">Ekpedisi</li>
                <li class="nav-item">
                    <a href="{{ route('ekspedisi.create') }}" class="nav-link">
                        <i class="nav-icon fas fa-copy text-warning"></i>
                        <p>
                            Create
                            {{-- <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">6</span> --}}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a  href="{{ route('tujuan.index') }}" class="nav-link">
                       <i class="nav-icon fas fa-location-dot text-danger"></i>
                        <p>
                            Tujuan
                            <span class="badge badge-info right"></span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a  href="{{ route('ekspedisi.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>
                            Laporan
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                </li>
                @endhasanyrole
                @hasanyrole('Admin|service')
                <li class="nav-header">Service</li>
                <li class="nav-item">
                    <a href="{{ route('serviced.create') }}" class="nav-link">
                        <i class="nav-icon fas fa-copy text-warning"></i>
                        <p>
                            Create
                            {{-- <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">6</span> --}}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a  href="{{ route('serviced.laporanServiced') }}" class="nav-link">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>
                            Laporan
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                </li>
                @endhasanyrole
                @hasanyrole('Admin')
                <li class="nav-header">Admin</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Data User
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="/users" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/roles" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/products" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Produk</p>
                            </a>
                        </li>
                    </ul>
                    
                </li>
                @endhasanyrole
            
            </ul>
       
        </nav>
        
    </div>

</aside>
