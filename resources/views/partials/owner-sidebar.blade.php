<style>
    .app-sidebar[data-bs-theme="dark"] {
        --lte-sidebar-hover-bg: rgba(217, 119, 6, 0.15);
        --lte-sidebar-hover-color: #d97706;
        --lte-sidebar-menu-active-bg: rgba(217, 119, 6, 0.22);
        --lte-sidebar-menu-active-color: #d97706;
        --lte-sidebar-submenu-color: #d97706;
        --lte-sidebar-submenu-hover-color: #d97706;
        --lte-sidebar-submenu-hover-bg: rgba(217, 119, 6, 0.15);
        --lte-sidebar-submenu-active-color: #d97706;
        --lte-sidebar-submenu-active-bg: rgba(217, 119, 6, 0.22);
    }
</style>
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{ route('owner.dashboard') }}" class="brand-link">
            @if ($siteSetting->logo)
                <img src="{{ asset('storage/' . $siteSetting->logo) }}" alt="{{ $siteSetting->nama_situs }}"
                    class="ms-3 me-2" style="height: 24px;">
            @else
                <i class="bi bi-award-fill fs-3 ms-3 me-2" style="color:#d97706;"></i>
                <span class="brand-text fw-bold">
                    {{ $siteSetting->nama_situs }}
                </span>
            @endif
        </a>
    </div>
    <div class="px-3 pb-2">
        <span class="badge" style="background:#d97706; color:#1f2937; font-weight:700; letter-spacing:.5px;">
            OWNER PANEL
        </span>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2" aria-label="Main navigation">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu">
                <li class="nav-item">
                    <a href="{{ route('owner.dashboard') }}"
                        class="nav-link {{ request()->routeIs('owner.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('owner.users.index') }}"
                        class="nav-link {{ request()->routeIs('owner.users.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-people"></i>
                        <p>Manajemen Pengguna</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('owner.manhwa.index') }}"
                        class="nav-link {{ request()->routeIs('owner.manhwa.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-book"></i>
                        <p>Manajemen Konten</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('owner.pengaturan') }}"
                        class="nav-link {{ request()->routeIs('owner.pengaturan') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-gear"></i>
                        <p>Pengaturan Situs</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('owner.log-aktivitas') }}"
                        class="nav-link {{ request()->routeIs('owner.log-aktivitas') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-clock-history"></i>
                        <p>Log Aktivitas</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>