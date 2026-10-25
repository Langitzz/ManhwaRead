<style>
    .app-sidebar[data-bs-theme="dark"] {
        --lte-sidebar-hover-bg: rgba(124, 58, 237, 0.15);
        --lte-sidebar-hover-color: #7c3aed;
        --lte-sidebar-menu-active-bg: rgba(124, 58, 237, 0.22);
        --lte-sidebar-menu-active-color: #7c3aed;
        --lte-sidebar-submenu-color: #7c3aed;
        --lte-sidebar-submenu-hover-color: #7c3aed;
        --lte-sidebar-submenu-hover-bg: rgba(124, 58, 237, 0.15);
        --lte-sidebar-submenu-active-color: #7c3aed;
        --lte-sidebar-submenu-active-bg: rgba(124, 58, 237, 0.22);
    }
</style>
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{ route('supervisor.dashboard') }}" class="brand-link">
            @if ($siteSetting->logo)
                <img src="{{ asset('storage/' . $siteSetting->logo) }}" alt="{{ $siteSetting->nama_situs }}"
                    class="ms-3 me-2" style="height: 24px;">
            @else
                <i class="bi bi-binoculars-fill fs-3 ms-3 me-2" style="color:#7c3aed;"></i>
                <span class="brand-text fw-bold">
                    {{ $siteSetting->nama_situs }}
                </span>
            @endif
        </a>
    </div>
    <div class="px-3 pb-2">
        <span class="badge" style="background:#7c3aed; color:#fff; font-weight:700; letter-spacing:.5px;">
            SUPERVISOR PANEL
        </span>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2" aria-label="Main navigation">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu">
                <li class="nav-item">
                    <a href="{{ route('supervisor.dashboard') }}"
                        class="nav-link {{ request()->routeIs('supervisor.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('supervisor.users.index') }}"
                        class="nav-link {{ request()->routeIs('supervisor.users.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-people"></i>
                        <p>Daftar User</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('supervisor.manhwa.index') }}"
                        class="nav-link {{ request()->routeIs('supervisor.manhwa.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-book"></i>
                        <p>Monitoring Konten</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('supervisor.komentar.index') }}"
                        class="nav-link {{ request()->routeIs('supervisor.komentar.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-chat-dots"></i>
                        <p>Komentar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('supervisor.log-aktivitas') }}"
                        class="nav-link {{ request()->routeIs('supervisor.log-aktivitas') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-clock-history"></i>
                        <p>Log Aktivitas</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>