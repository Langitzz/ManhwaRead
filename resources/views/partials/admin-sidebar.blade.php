<style>
    .app-sidebar[data-bs-theme="dark"] {
        --lte-sidebar-hover-bg: rgba(13, 202, 240, 0.12);
        --lte-sidebar-hover-color: #0dcaf0;
        --lte-sidebar-menu-active-bg: rgba(13, 202, 240, 0.18);
        --lte-sidebar-menu-active-color: #0dcaf0;
        --lte-sidebar-submenu-color: #0dcaf0;
        --lte-sidebar-submenu-hover-color: #0dcaf0;
        --lte-sidebar-submenu-hover-bg: rgba(13, 202, 240, 0.12);
        --lte-sidebar-submenu-active-color: #0dcaf0;
        --lte-sidebar-submenu-active-bg: rgba(13, 202, 240, 0.18);
    }
</style>
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="{{ route('admin') }}" class="brand-link">
            @if ($siteSetting->logo)
                <img src="{{ asset('storage/' . $siteSetting->logo) }}" alt="{{ $siteSetting->nama_situs }}"
                    class="ms-3 me-2" style="height: 24px;">
            @else
                <i class="bi bi-book-half fs-3 ms-3 me-2"></i>
            @endif

            <span class="brand-text fw-bold">
                {{ $siteSetting->nama_situs }}
            </span>
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2" aria-label="Main navigation">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" data-accordion="true">
                @php
                    $userPermissions = auth()->user()->userRole?->permissions()->pluck('key')->toArray() ?? [];
                    $adaMasterData =
                        in_array('manhwa', $userPermissions) ||
                        in_array('genre', $userPermissions) ||
                        in_array('chapter', $userPermissions) ||
                        in_array('banner', $userPermissions);
                    $adaAktivitas =
                        in_array('komentar', $userPermissions) ||
                        in_array('bookmark', $userPermissions) ||
                        in_array('riwayat', $userPermissions);
                    $adaAdmin =
                        in_array('role_user', $userPermissions) ||
                        in_array('hak_akses', $userPermissions) ||
                        in_array('log_aktivitas', $userPermissions);
                @endphp

                @if (in_array('dashboard', $userPermissions))
                    <li class="nav-item">
                        <a href="{{ route('admin') }}"
                            class="nav-link {{ request()->routeIs('admin') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-speedometer2"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                @endif

                @if ($adaMasterData)
                    <li
                        class="nav-item {{ request()->routeIs('genre.*', 'manhwa.*', 'chapter.*', 'banner.*') ? 'menu-open' : '' }}">
                        <a href="javascript:void(0)"
                            class="nav-link {{ request()->routeIs('genre.*', 'manhwa.*', 'chapter.*', 'banner.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-folder"></i>
                            <p>
                                Master Data
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            @if (in_array('manhwa', $userPermissions))
                                <li class="nav-item">
                                    <a href="{{ route('manhwa.index') }}"
                                        class="nav-link {{ request()->routeIs('manhwa.*') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-book"></i>
                                        <p>Manhwa</p>
                                    </a>
                                </li>
                            @endif

                            @if (in_array('genre', $userPermissions))
                                <li class="nav-item">
                                    <a href="{{ route('genre.index') }}"
                                        class="nav-link {{ request()->routeIs('genre.*') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-tags"></i>
                                        <p>Genre</p>
                                    </a>
                                </li>
                            @endif

                            @if (in_array('chapter', $userPermissions))
                                <li class="nav-item">
                                    <a href="{{ route('chapter.index') }}"
                                        class="nav-link {{ request()->routeIs('chapter.*') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-journal-text"></i>
                                        <p>Chapter</p>
                                    </a>
                                </li>
                            @endif

                            @if (in_array('banner', $userPermissions))
                                <li class="nav-item">
                                    <a href="{{ route('banner.index') }}"
                                        class="nav-link {{ request()->routeIs('banner.*') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-images"></i>
                                        <p>Banner</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if ($adaAktivitas)
                    <li
                        class="nav-item {{ request()->routeIs('komentar.*', 'bookmark.*', 'riwayat.*') ? 'menu-open' : '' }}">
                        <a href="javascript:void(0)"
                            class="nav-link {{ request()->routeIs('komentar.*', 'bookmark.*', 'riwayat.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-arrow-left-right"></i>
                            <p>
                                Aktivitas
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            @if (in_array('komentar', $userPermissions))
                                <li class="nav-item">
                                    <a href="{{ route('komentar.index') }}"
                                        class="nav-link {{ request()->routeIs('komentar.*') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-chat-dots"></i>
                                        <p>Komentar</p>
                                    </a>
                                </li>
                            @endif

                            @if (in_array('bookmark', $userPermissions))
                                <li class="nav-item">
                                    <a href="{{ route('bookmark.index') }}"
                                        class="nav-link {{ request()->routeIs('bookmark.*') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-bookmark-heart"></i>
                                        <p>Bookmark</p>
                                    </a>
                                </li>
                            @endif

                            @if (in_array('riwayat', $userPermissions))
                                <li class="nav-item">
                                    <a href="{{ route('riwayat.index') }}"
                                        class="nav-link {{ request()->routeIs('riwayat.*') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-clock-history"></i>
                                        <p>Riwayat Baca</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (in_array('user', $userPermissions))
                    <li class="nav-item {{ request()->routeIs('user.*') ? 'menu-open' : '' }}">
                        <a href="javascript:void(0)"
                            class="nav-link {{ request()->routeIs('user.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-people"></i>
                            <p>
                                User
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('user.index') }}"
                                    class="nav-link {{ request()->routeIs('user.*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-person-lines-fill"></i>
                                    <p>Daftar User</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if ($adaAdmin)
                    <li
                        class="nav-item {{ request()->routeIs('admin.role.*', 'admin.access.*', 'admin.log.*') ? 'menu-open' : '' }}">
                        <a href="javascript:void(0)"
                            class="nav-link {{ request()->routeIs('admin.role.*', 'admin.access.*', 'admin.log.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-shield-lock"></i>
                            <p>
                                Admin
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            @if (in_array('role_user', $userPermissions))
                                <li class="nav-item">
                                    <a href="{{ route('admin.role.index') }}"
                                        class="nav-link {{ request()->routeIs('admin.role.*') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-person-gear"></i>
                                        <p>Role User</p>
                                    </a>
                                </li>
                            @endif

                            @if (in_array('hak_akses', $userPermissions))
                                <li class="nav-item {{ request()->routeIs('admin.access.*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.access.index') }}" class="nav-link">
                                        <i class="nav-icon bi bi-key"></i>
                                        <p>Hak Akses</p>
                                    </a>
                                </li>
                            @endif

                            @if (in_array('log_aktivitas', $userPermissions))
                                <li class="nav-item">
                                    <a href="{{ route('admin.log.index') }}"
                                        class="nav-link {{ request()->routeIs('admin.log.*') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-clock-history"></i>
                                        <p>Log Aktivitas</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (in_array('backup', $userPermissions))
                    <li class="nav-item">
                        <a href="{{ route('backup.index') }}"
                            class="nav-link {{ request()->routeIs('backup.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-hdd-network"></i>
                            <p>Backup Database</p>
                        </a>
                    </li>
                @endif

                @if (in_array('pengaturan', $userPermissions))
                    <li class="nav-item">
                        <a href="{{ route('pengaturan.edit') }}"
                            class="nav-link {{ request()->routeIs('pengaturan.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-gear"></i>
                            <p>Pengaturan Situs</p>
                        </a>
                    </li>
                @endif
            </ul>
            <!--end::Sidebar Menu-->

        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
