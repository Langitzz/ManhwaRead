<header id="header" class="header sticky-top">

    <div class="container-fluid container-xl position-relative">

        <div class="top-row d-flex align-items-center justify-content-between">

            <a href="{{ route('home') }}" class="logo d-flex align-items-end text-decoration-none">
                <h1 class="sitename">ManhwaRead</h1>
                <span>.</span>
            </a>

            <div class="d-flex align-items-center">

                <form class="search-form me-3">
                    <input type="text" class="form-control" placeholder="Cari manhwa...">
                    <button type="submit" class="btn">
                        <i class="bi bi-search"></i>
                    </button>
                </form>

                @guest
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        <i class="bi bi-box-arrow-in-right"></i>
                        Login
                    </a>
                @endguest

                @auth
                    <div class="dropdown">

                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">

                            <i class="bi bi-person-circle"></i>
                            {{ Auth::user()->name }}

                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">

                            <li>
                                <a class="dropdown-item" href="#">
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

    <div class="nav-wrap">

        <div class="container d-flex justify-content-center position-relative">

            <nav id="navmenu" class="navmenu">

                <ul>

                    <li>
                        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                            Home
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('manhwa') }}" class="{{ request()->routeIs('manhwa') ? 'active' : '' }}">
                            Daftar Manhwa
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('genre') }}" class="{{ request()->routeIs('genre') ? 'active' : '' }}">
                            Genre
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('populer') }}" class="{{ request()->routeIs('populer') ? 'active' : '' }}">
                            Populer
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('latest') }}" class="{{ request()->routeIs('latest') ? 'active' : '' }}">
                            Terbaru
                        </a>
                    </li>

                </ul>

                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>

            </nav>

        </div>

    </div>

</header>
