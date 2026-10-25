<style>
    .admin-user-toggle {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 4px 12px 4px 4px;
        border-radius: 999px;
        border: 1px solid rgba(148, 163, 184, .2);
        background: rgba(30, 41, 59, .6);
        transition: border-color .15s;
    }

    .admin-user-toggle:hover {
        border-color: rgba(34, 211, 238, .45);
    }

    .admin-avatar-ring {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        padding: 2px;
        flex-shrink: 0;
        background: linear-gradient(135deg, #6366f1 0%, #22d3ee 100%);
    }

    .admin-avatar-ring > * {
        display: block;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        border: 2px solid #0f172a;
        object-fit: cover;
    }

    .admin-user-menu-panel {
        width: 280px;
        padding: 0;
        overflow: hidden;
        border-radius: 16px;
        background: #1e293b;
        border: 1px solid rgba(148, 163, 184, .15);
        box-shadow: 0 20px 45px rgba(0, 0, 0, .45);
    }

    .admin-user-head {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 18px;
        background: linear-gradient(135deg, rgba(99, 102, 241, .35), rgba(34, 211, 238, .15));
        border-bottom: 1px solid rgba(148, 163, 184, .12);
    }

    .admin-user-head .admin-avatar-ring {
        width: 56px;
        height: 56px;
    }

    .admin-user-name {
        font-weight: 700;
        color: #f8fafc;
        line-height: 1.2;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .admin-user-email {
        font-size: .8rem;
        color: #cbd5e1;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .admin-user-role {
        display: inline-block;
        margin-top: 6px;
        padding: 2px 10px;
        border-radius: 999px;
        font-size: .72rem;
        font-weight: 600;
        color: #a5f3fc;
        background: rgba(15, 23, 42, .5);
        border: 1px solid rgba(34, 211, 238, .3);
    }

    .admin-user-menu-panel .dropdown-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 18px;
        color: #cbd5e1;
        font-weight: 500;
    }

    .admin-user-menu-panel .dropdown-item i {
        color: #818cf8;
    }

    .admin-user-menu-panel .dropdown-item:hover,
    .admin-user-menu-panel .dropdown-item:focus {
        background: rgba(99, 102, 241, .15);
        color: #f8fafc;
    }

    .admin-user-menu-panel .dropdown-item.text-logout {
        color: #fca5a5;
    }

    .admin-user-menu-panel .dropdown-item.text-logout i {
        color: #f87171;
    }

    .admin-user-menu-panel .dropdown-item.text-logout:hover {
        background: rgba(248, 113, 113, .12);
        color: #fecaca;
    }

    .admin-user-menu-panel .dropdown-divider {
        border-color: rgba(148, 163, 184, .12);
        margin: 6px 0;
    }
</style>

<nav class="app-header navbar navbar-expand bg-body">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button" aria-label="Toggle sidebar">
                    <i class="bi bi-list"></i>
                </a>
            </li>
        </ul>
        <!--end::Start Navbar Links-->

        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto">
            <!--begin::Messages Dropdown Menu-->

            <!--end::Messages Dropdown Menu-->

            <!--begin::Notifications Dropdown Menu-->

            <!--end::Notifications Dropdown Menu-->

            <!--begin::Fullscreen Toggle-->

            <!--end::Fullscreen Toggle-->

            <!--begin::Color Mode Toggle (#6010)-->
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="bd-theme" aria-label="Toggle color scheme"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-sun-fill" data-lte-theme-icon="light"></i>
                    <i class="bi bi-moon-fill d-none" data-lte-theme-icon="dark"></i>
                    <i class="bi bi-circle-half d-none" data-lte-theme-icon="auto"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme"
                    style="--bs-dropdown-min-width: 8rem">
                    <li>
                        <button type="button" class="dropdown-item d-flex align-items-center"
                            data-bs-theme-value="light" aria-pressed="false">
                            <i class="bi bi-sun-fill me-2"></i>
                            Light
                            <i class="bi bi-check-lg ms-auto d-none"></i>
                        </button>
                    </li>
                    <li>
                        <button type="button" class="dropdown-item d-flex align-items-center"
                            data-bs-theme-value="dark" aria-pressed="false">
                            <i class="bi bi-moon-fill me-2"></i>
                            Dark
                            <i class="bi bi-check-lg ms-auto d-none"></i>
                        </button>
                    </li>
                    <li>
                        <button type="button" class="dropdown-item d-flex align-items-center active"
                            data-bs-theme-value="auto" aria-pressed="true">
                            <i class="bi bi-circle-half me-2"></i>
                            Auto
                            <i class="bi bi-check-lg ms-auto d-none"></i>
                        </button>
                    </li>
                </ul>
            </li>
            <!--end::Color Mode Toggle-->

            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle admin-user-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <span class="admin-avatar-ring">
                        <x-foto-profil :user="Auth::user()" size="32" />
                    </span>
                    <span class="d-none d-md-inline fw-semibold">{{ Auth::user()->name }}</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end admin-user-menu-panel">
                    <li class="admin-user-head">
                        <span class="admin-avatar-ring">
                            <x-foto-profil :user="Auth::user()" size="56" />
                        </span>
                        <div style="min-width: 0;">
                            <div class="admin-user-name">{{ Auth::user()->name }}</div>
                            <div class="admin-user-email">{{ Auth::user()->email }}</div>
                            <span class="admin-user-role">{{ Auth::user()->userRole?->nama_peran ?? '-' }}</span>
                        </div>
                    </li>

                    <li>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="bi bi-person-circle"></i>
                            Profil Saya
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-logout">
                                <i class="bi bi-box-arrow-right"></i>
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
            <!--end::User Menu Dropdown-->
        </ul>
        <!--end::End Navbar Links-->
    </div>
    <!--end::Container-->
</nav>
