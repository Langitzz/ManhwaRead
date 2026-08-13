<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="{{ route('admin') }}" class="brand-link">
            <i class="bi bi-book-half fs-3 ms-3 me-2"></i>

            <span class="brand-text fw-bold">
                ManhwaRead
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

                <li class="nav-item">
                    <a href="{{ route('admin') }}" class="nav-link {{ request()->routeIs('admin') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('genre.*', 'manhwa.*', 'chapter.*') ? 'menu-open' : '' }}">
                    <a href="javascript:void(0)"
                        class="nav-link {{ request()->routeIs('genre.*', 'manhwa.*', 'chapter.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-folder"></i>
                        <p>
                            Master Data
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('manhwa.index') }}"
                                class="nav-link {{ request()->routeIs('manhwa.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-book"></i>
                                <p>Manhwa</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('genre.index') }}"
                                class="nav-link {{ request()->routeIs('genre.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-tags"></i>
                                <p>Genre</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('chapter.index') }}"
                                class="nav-link {{ request()->routeIs('chapter.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-journal-text"></i>
                                <p>Chapter</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li
                    class="nav-item {{ request()->routeIs('aktivitas.*', 'komentar.*', 'bookmark.*', 'riwayat.*') ? 'menu-open' : '' }}">
                    <a href="javascript:void(0)"
                        class="nav-link {{ request()->routeIs('aktivitas.*', 'komentar.*', 'bookmark.*', 'riwayat.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-arrow-left-right"></i>
                        <p>
                            Aktivitas
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('komentar.index') }}"
                                class="nav-link {{ request()->routeIs('komentar.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-chat-dots"></i>
                                <p>Komentar</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('bookmark.index') }}"
                                class="nav-link {{ request()->routeIs('bookmark.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-bookmark-heart"></i>
                                <p>Bookmark</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('riwayat.index') }}"
                                class="nav-link {{ request()->routeIs('riwayat.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-clock-history"></i>
                                <p>Riwayat Baca</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ request()->routeIs('user.*') ? 'menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link {{ request()->routeIs('user.*') ? 'active' : '' }}">
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

                <li
                    class="nav-item {{ request()->routeIs('admin.user.*', 'admin.access.*', 'admin.log.*') ? 'menu-open' : '' }}">
                    <a href="javascript:void(0)"
                        class="nav-link {{ request()->routeIs('admin.user.*', 'admin.access.*', 'admin.log.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-shield-lock"></i>
                        <p>
                            Admin
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.user.index') }}"
                                class="nav-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-person-gear"></i>
                                <p>Role User</p>
                            </a>
                        </li>

                        <li class="nav-item {{ request()->routeIs('admin.access.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.access.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-key"></i>
                                <p>Hak Akses</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.log.index') }}"
                                class="nav-link {{ request()->routeIs('admin.log.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-clock-history"></i>
                                <p>Log Aktivitas</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
            </li>

            </ul>
            <!--end::Sidebar Menu-->

        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
