<header id="header" class="header"
    style="background-color: color-mix(in srgb, var(--default-color), transparent 96%); box-shadow: 0 1px 3px rgba(0,0,0,0.06);">
    <div class="container-fluid container-xl position-relative">
        <div class="top-row d-flex align-items-center justify-content-between">
            <a href="{{ route('home') }}" class="logo d-flex align-items-end text-decoration-none">
                @if ($siteSetting->logo)
                    <img src="{{ asset('storage/' . $siteSetting->logo) }}" alt="{{ $siteSetting->nama_situs }}"
                        style="height: 32px; margin-right: 8px;">
                @endif
                <h1 class="sitename">{{ $siteSetting->nama_situs }}</h1>
                <span>.</span>
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
                    class="d-none d-md-flex align-items-center position-relative">
                    <input type="text" name="q" id="navbarSearchInput" value="{{ request('q') }}"
                        class="form-control form-control-sm bg-dark text-light border-secondary"
                        placeholder="Cari komik..." style="width: 200px; padding-right: 55px;" autocomplete="off">
                    <span class="badge bg-secondary position-absolute end-0 me-2"
                        style="pointer-events: none; font-size: 10px;">
                        Ctrl+K
                    </span>
                </form>

                <a href="{{ route('search') }}" class="d-md-none fs-5 text-decoration-none text-reset" title="Cari">
                    <i class="bi bi-search"></i>
                </a>

                @guest
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        <i class="bi bi-box-arrow-in-right"></i>
                        Login
                    </a>
                @endguest

                @auth
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle d-flex align-items-center gap-2" type="button"
                            data-bs-toggle="dropdown">
                            <x-foto-profil :user="Auth::user()" size="28" />
                            {{ Auth::user()->name }}
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('akun.edit') }}">
                                    Profile
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item" type="submit">
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