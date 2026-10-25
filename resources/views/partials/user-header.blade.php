<style>
    .notif-bell {
        position: relative;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(30, 41, 59, .75);
        border: 1px solid rgba(148, 163, 184, .2);
        color: #e2e8f0;
        font-size: 1.05rem;
        transition: border-color .15s;
    }

    .notif-bell:hover,
    .notif-bell:focus {
        color: #f8fafc;
        border-color: rgba(34, 211, 238, .45);
    }

    .notif-badge {
        position: absolute;
        top: -4px;
        right: -4px;
        min-width: 18px;
        height: 18px;
        padding: 0 5px;
        border-radius: 999px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e11d48;
        color: #fff;
        font-size: .68rem;
        font-weight: 800;
        border: 2px solid #0b1120;
    }

    .notif-menu {
        width: 340px;
        padding: 0;
        overflow: hidden;
        border-radius: 16px;
        background: #1e293b;
        border: 1px solid rgba(148, 163, 184, .15);
        box-shadow: 0 20px 45px rgba(0, 0, 0, .45);
    }

    .notif-menu-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 16px;
        border-bottom: 1px solid rgba(148, 163, 184, .12);
        color: #f8fafc;
        font-weight: 700;
    }

    .notif-item {
        display: block;
        width: 100%;
        padding: 12px 16px;
        border: none;
        background: transparent;
        text-align: left;
        color: #cbd5e1;
        border-bottom: 1px solid rgba(148, 163, 184, .08);
    }

    .notif-item:hover {
        background: rgba(99, 102, 241, .12);
        color: #f8fafc;
    }

    .notif-item.is-unread {
        background: rgba(34, 211, 238, .06);
    }

    .notif-item-title {
        font-size: .88rem;
        font-weight: 600;
        color: #f8fafc;
    }

    .notif-item-text {
        font-size: .82rem;
        color: #94a3b8;
        margin: 2px 0;
    }

    .notif-item-time {
        font-size: .72rem;
        color: #64748b;
    }

    .notif-empty {
        padding: 28px 16px;
        text-align: center;
        color: #64748b;
        font-size: .9rem;
    }

    .nav-profile-btn {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 4px 14px 4px 4px;
        border-radius: 999px;
        background: rgba(30, 41, 59, .75);
        border: 1px solid rgba(148, 163, 184, .2);
        color: #f8fafc;
        font-weight: 600;
        transition: border-color .15s, box-shadow .15s;
    }

    .nav-profile-btn:hover,
    .nav-profile-btn:focus {
        color: #f8fafc;
        border-color: rgba(34, 211, 238, .45);
        box-shadow: 0 0 0 .2rem rgba(34, 211, 238, .12);
    }

    .nav-profile-name {
        max-width: 140px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .nav-avatar-ring {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        padding: 2px;
        flex-shrink: 0;
        background: linear-gradient(135deg, #6366f1 0%, #22d3ee 100%);
    }

    .nav-avatar-ring>* {
        display: block;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        border: 2px solid #0f172a;
        object-fit: cover;
    }

    .nav-dropdown-menu {
        width: 260px;
        padding: 0;
        overflow: hidden;
        border-radius: 16px;
        background: #1e293b;
        border: 1px solid rgba(148, 163, 184, .15);
        box-shadow: 0 20px 45px rgba(0, 0, 0, .45);
    }

    .nav-dropdown-head {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 18px;
        background: linear-gradient(135deg, rgba(99, 102, 241, .35), rgba(34, 211, 238, .15));
        border-bottom: 1px solid rgba(148, 163, 184, .12);
    }

    .nav-dropdown-head .nav-avatar-ring {
        width: 52px;
        height: 52px;
    }

    .nav-dropdown-name {
        font-weight: 700;
        color: #f8fafc;
        line-height: 1.2;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .nav-dropdown-email {
        font-size: .8rem;
        color: #cbd5e1;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .nav-dropdown-menu .dropdown-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 18px;
        color: #cbd5e1;
        font-weight: 500;
    }

    .nav-dropdown-menu .dropdown-item i {
        color: #818cf8;
        font-size: 1rem;
    }

    .nav-dropdown-menu .dropdown-item:hover,
    .nav-dropdown-menu .dropdown-item:focus {
        background: rgba(99, 102, 241, .15);
        color: #f8fafc;
    }

    .nav-dropdown-menu .dropdown-item:hover i {
        color: #22d3ee;
    }

    .nav-dropdown-menu .dropdown-item.text-logout {
        color: #fca5a5;
    }

    .nav-dropdown-menu .dropdown-item.text-logout i {
        color: #f87171;
    }

    .nav-dropdown-menu .dropdown-item.text-logout:hover {
        background: rgba(248, 113, 113, .12);
        color: #fecaca;
    }

    .nav-dropdown-menu .dropdown-divider {
        border-color: rgba(148, 163, 184, .12);
        margin: 6px 0;
    }

    .nav-search {
        width: 240px;
    }

    .nav-search-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #64748b;
        font-size: .95rem;
        pointer-events: none;
        z-index: 2;
    }

    .nav-search-input {
        width: 100%;
        height: 40px;
        border-radius: 999px;
        background: rgba(15, 23, 42, .7);
        border: 1px solid rgba(148, 163, 184, .2);
        color: #f8fafc;
        padding: 0 64px 0 40px;
        font-size: .9rem;
        transition: border-color .15s, box-shadow .15s;
    }

    .nav-search-input::placeholder {
        color: #64748b;
    }

    .nav-search-input:focus {
        outline: none;
        background: rgba(15, 23, 42, .9);
        color: #f8fafc;
        border-color: #22d3ee;
        box-shadow: 0 0 0 .2rem rgba(34, 211, 238, .15);
    }

    .nav-search-kbd {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        font-size: .7rem;
        font-weight: 600;
        color: #94a3b8;
        background: rgba(148, 163, 184, .12);
        border: 1px solid rgba(148, 163, 184, .2);
        border-radius: 6px;
        padding: 2px 6px;
        pointer-events: none;
    }

    .landing-cta {
        display: inline-flex;
        align-items: center;
        border: none;
        border-radius: 14px;
        padding: 9px 20px;
        font-size: .95rem;
        font-weight: 700;
        color: #fff;
        text-decoration: none;
        background: linear-gradient(135deg, #6366f1 0%, #22d3ee 100%);
        box-shadow: 0 10px 25px rgba(34, 211, 238, .2);
        transition: transform .15s, box-shadow .15s;
    }

    .landing-cta:hover {
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 14px 30px rgba(34, 211, 238, .3);
    }

    /* Menu navbar: hover halus dan garis gradasi di bawah item aktif */
    .navmenu ul a {
        position: relative;
        transition: color .2s ease;
    }

    .navmenu ul a::after {
        content: "";
        position: absolute;
        left: 50%;
        bottom: -6px;
        width: 0;
        height: 2px;
        border-radius: 2px;
        background: linear-gradient(90deg, #6366f1, #22d3ee);
        transform: translateX(-50%);
        transition: width .25s ease;
    }

    .navmenu ul a:hover::after,
    .navmenu ul a.active::after {
        width: 60%;
    }

    .navmenu ul a.active {
        color: #67e8f9;
    }

    .sitename-accent {
        background: linear-gradient(90deg, #22d3ee 0%, #818cf8 100%);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    /* ===== Pagination (semua halaman publik) ===== */
    .pagination .page-link {
        background: #0f172a;
        border-color: #334155;
        color: #cbd5e1;
        border-radius: 10px !important;
        margin: 0 3px;
        min-width: 40px;
        text-align: center;
    }

    .pagination .page-link:hover {
        background: rgba(34, 211, 238, .1);
        border-color: #22d3ee;
        color: #f8fafc;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #6366f1 0%, #22d3ee 100%);
        border-color: transparent;
        color: #fff;
        box-shadow: 0 6px 16px rgba(34, 211, 238, .25);
    }

    .pagination .page-item.disabled .page-link {
        background: transparent;
        border-color: #1e293b;
        color: #475569;
    }
</style>

<header id="header" class="header"
    style="background-color: color-mix(in srgb, var(--default-color), transparent 96%); box-shadow: 0 1px 3px rgba(0,0,0,0.06);">
    <div class="container-fluid container-xl position-relative">
        <div class="top-row d-flex align-items-center justify-content-between">
            <a href="{{ route('home') }}" class="logo d-flex align-items-end text-decoration-none">
                @if ($siteSetting->logo)
                    <img src="{{ asset('storage/' . $siteSetting->logo) }}" alt="{{ $siteSetting->nama_situs }}"
                        style="height: 32px; margin-right: 8px;">
                @else
                    <h1 class="sitename">
                        {{ $siteSetting->nama_situs }}<span class="sitename-accent">.</span>
                    </h1>
                @endif
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li>
                        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('genre') }}" class="{{ request()->routeIs('genre') ? 'active' : '' }}">
                            Genre
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('populer') }}"
                            class="{{ request()->routeIs('explore') && request('sort') === 'populer' ? 'active' : '' }}">
                            Populer
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('latest') }}"
                            class="{{ request()->routeIs('explore') && request('sort') === 'terbaru' ? 'active' : '' }}">
                            Terbaru
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('library.index') }}"
                            class="{{ request()->routeIs('library.index') ? 'active' : '' }}">
                            Koleksi
                        </a>
                    </li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <div class="d-flex align-items-center gap-3">
                <form action="{{ route('search') }}" method="GET"
                    class="d-none d-md-flex align-items-center position-relative nav-search">
                    <i class="bi bi-search nav-search-icon"></i>
                    <input type="text" name="q" id="navbarSearchInput" value="{{ request('q') }}"
                        class="form-control nav-search-input" placeholder="Cari komik..." autocomplete="off">
                    <span class="nav-search-kbd">Ctrl+K</span>
                </form>

                <a href="{{ route('search') }}" class="d-md-none fs-5 text-decoration-none text-reset" title="Cari">
                    <i class="bi bi-search"></i>
                </a>

                @auth
                    <div class="dropdown">
                        <button type="button" class="notif-bell dropdown-toggle" data-bs-toggle="dropdown"
                            aria-expanded="false" title="Notifikasi">
                            <i class="bi bi-bell"></i>
                            @if ($notifikasiBelumDibaca > 0)
                                <span
                                    class="notif-badge">{{ $notifikasiBelumDibaca > 9 ? '9+' : $notifikasiBelumDibaca }}</span>
                            @endif
                        </button>

                        <div class="dropdown-menu dropdown-menu-end notif-menu p-0">
                            <div class="notif-menu-head">
                                <span>Notifikasi</span>
                                @if ($notifikasiBelumDibaca > 0)
                                    <form action="{{ route('notifikasi.baca-semua') }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="btn btn-link btn-sm p-0 text-info">Tandai
                                            semua</button>
                                    </form>
                                @endif
                            </div>

                            @forelse ($notifikasiTerbaru as $notif)
                                <form action="{{ route('notifikasi.baca', $notif->id) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="notif-item {{ $notif->read_at ? '' : 'is-unread' }}">
                                        <div class="notif-item-title">
                                            {{ $notif->data['pembalas'] ?? 'Seseorang' }} membalas komentarmu
                                        </div>
                                        <div class="notif-item-text">
                                            {{ $notif->data['isi'] ?? '' }}
                                        </div>
                                        <div class="notif-item-time">
                                            {{ $notif->data['manhwa_judul'] ?? '' }}
                                            &middot; {{ $notif->created_at->diffForHumans() }}
                                        </div>
                                    </button>
                                </form>
                            @empty
                                <div class="notif-empty">Belum ada notifikasi.</div>
                            @endforelse
                        </div>
                    </div>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="landing-cta" style="padding: 9px 20px; font-size: .95rem;">
                        <i class="bi bi-box-arrow-in-right me-1"></i>
                        Login
                    </a>
                @endguest

                @auth
                    <div class="dropdown">
                        <button class="nav-profile-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span class="nav-avatar-ring">
                                <x-foto-profil :user="Auth::user()" size="34" />
                            </span>
                            <span class="nav-profile-name d-none d-md-inline">{{ Auth::user()->name }}</span>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end nav-dropdown-menu">
                            <li class="nav-dropdown-head">
                                <span class="nav-avatar-ring">
                                    <x-foto-profil :user="Auth::user()" size="52" />
                                </span>
                                <div style="min-width: 0;">
                                    <div class="nav-dropdown-name">{{ Auth::user()->name }}</div>
                                    <div class="nav-dropdown-email">{{ Auth::user()->email }}</div>
                                </div>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ route('akun.edit') }}">
                                    <i class="bi bi-person-circle"></i>
                                    Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('akun.komentar') }}">
                                    <i class="bi bi-chat-left-text"></i>
                                    Komentar Saya
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('akun.statistik') }}">
                                    <i class="bi bi-bar-chart"></i>
                                    Statistik Baca
                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-logout" type="submit">
                                        <i class="bi bi-box-arrow-right"></i>
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</header>
@push('scripts')
    <script>
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
                e.preventDefault();
                document.getElementById('navbarSearchInput').focus();
            }
        });
    </script>
@endpush
