<header id="header" class="header"
    style="background-color: color-mix(in srgb, var(--default-color), transparent 96%); box-shadow: 0 1px 3px rgba(0,0,0,0.06);">
    <div class="container-fluid container-xl position-relative">
        <div class="top-row d-flex align-items-center justify-content-between">
            <a href="{{ route('home') }}" class="logo d-flex align-items-end text-decoration-none">
                <h1 class="sitename">ManhwaRead</h1>
                <span>.</span>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li>
                        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('explore') }}" class="{{ request()->routeIs('explore') ? 'active' : '' }}">
                            Explore
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('library.index') }}"
                            class="{{ request()->routeIs('library.index') ? 'active' : '' }}">
                            Library
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('search') }}" class="{{ request()->routeIs('search') ? 'active' : '' }}">
                            Search
                        </a>
                    </li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <div class="d-flex align-items-center">
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
