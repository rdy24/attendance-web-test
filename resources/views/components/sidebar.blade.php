<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard.attendances.clock-in') }}">Simple Attendance</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard.attendances.clock-in') }}">SA</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Attendance</li>
            <li class="{{ request()->routeIs('dashboard.attendances.clock-in') ? 'active' : '' }}"><a href="{{ route('dashboard.attendances.clock-in') }}" class="nav-link"><i class="fas fa-box-open"></i><span>Attendance</span></a>
            </li>
            <li class="{{ request()->routeIs('dashboard.attendances.my-attendance') ? 'active' : '' }}"><a href="{{ route('dashboard.attendances.my-attendance') }}" class="nav-link"><i class="fas fa-box-open"></i><span>My Attendance</span></a>
            </li>

            @role('admin')
                <li class="menu-header">Master</li>
                <li class="{{ request()->routeIs('dashboard.employees.*') ? 'active' : '' }}"><a href="{{ route('dashboard.employees.index') }}" class="nav-link"><i class="fas fa-box-open"></i><span>Employee</span></a>
                <li class="{{ request()->routeIs('dashboard.users.*') ? 'active' : '' }}"><a href="{{ route('dashboard.users.index') }}" class="nav-link"><i class="fas fa-box-open"></i><span>User</span></a>
                </li>
            @endrole

            {{-- @can('hasRole', 'admin')

            <li class="menu-header">Master</li>
            <li class="{{ request()->routeIs('dashboard.mines.*') ? 'active' : '' }}"><a
                    href="{{ route('dashboard.mines.index') }}" class="nav-link"><i
                        class="fas fa-box-open"></i><span>Tambang</span></a>
            </li>
            <li class="{{ request()->routeIs('dashboard.companies.*') ? 'active' : '' }}"><a
                    href="{{ route('dashboard.companies.index') }}" class="nav-link"><i
                        class="fas fa-box-open"></i><span>Perusahaan</span></a>
            </li>
            <li class="{{ request()->routeIs('dashboard.drivers.*') ? 'active' : '' }}"><a
                    href="{{ route('dashboard.drivers.index') }}" class="nav-link"><i
                        class="fas fa-box-open"></i><span>Driver</span></a>
            </li>
            <li class="{{ request()->routeIs('dashboard.vehicles.*') ? 'active' : '' }}"><a
                    href="{{ route('dashboard.vehicles.index') }}" class="nav-link"><i
                        class="fas fa-box-open"></i><span>Kendaraan</span></a>
            </li>
            @endcan --}}
            {{-- <li class="menu-header">Orders</li>
            <li class="{{ request()->routeIs('dashboard.orders.*') ? 'active' : '' }}"><a
                    href="{{ route('dashboard.orders.index') }}" class="nav-link"><i
                        class="fas fa-box-open"></i><span>Pemesanan Kendaraan</span></a>
            </li> --}}
        </ul>
    </aside>
</div>