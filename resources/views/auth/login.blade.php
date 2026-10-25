<x-guest-layout :centered="false">
    @include('auth.partials.login-styles')

    <style>
        /* ===== Animasi halaman login user ===== */
        @keyframes auth-rise {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        @keyframes auth-slide-in {
            from {
                opacity: 0;
                transform: translateX(-16px);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        @keyframes auth-float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-12px);
            }
        }

        .hero-text {
            animation: auth-slide-in .7s ease both;
        }

        .login-card {
            animation: auth-rise .6s ease .15s both;
        }

        .collage-item {
            position: absolute;
            width: 160px;
            height: 220px;
            transition: scale .35s ease;
        }

        .collage-item:hover {
            scale: 1.06;
        }

        .collage-img,
        .collage-placeholder {
            width: 100%;
            height: 100%;
            border-radius: 16px;
            border: 3px solid #1e293b;
            box-shadow: 0 15px 35px rgba(0, 0, 0, .45);
        }

        .collage-img {
            object-fit: cover;
            animation: auth-float 6s ease-in-out infinite;
            animation-delay: var(--float-delay, 0s);
            transition: box-shadow .35s ease;
        }

        .collage-item:hover .collage-img {
            box-shadow: 0 22px 45px rgba(34, 211, 238, .25);
        }

        .collage-placeholder {
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px;
            text-align: center;
            color: #c7d2fe;
            font-size: .8rem;
            background: linear-gradient(160deg, #312e81 0%, #0f172a 100%);
            animation: auth-float 6s ease-in-out infinite;
            animation-delay: var(--float-delay, 0s);
        }

        .collage-placeholder i {
            font-size: 1.8rem;
            color: #818cf8;
        }

        .collage-item.is-missing .collage-img {
            display: none;
        }

        .collage-item.is-missing .collage-placeholder {
            display: flex;
        }

        #login-btn .btn-spinner {
            display: none;
        }

        #login-btn.is-loading .btn-label {
            display: none;
        }

        #login-btn.is-loading .btn-spinner {
            display: inline-block;
        }

        @media (prefers-reduced-motion: reduce) {

            .hero-text,
            .login-card,
            .collage-img,
            .collage-placeholder {
                animation: none !important;
            }

            .collage-item,
            .collage-item:hover .collage-img {
                transition: none !important;
            }
        }
    </style>

    @php
        $posisiCollage = [
            'top:0; left:20px; transform:rotate(-8deg); z-index:1;',
            'top:40px; left:150px; transform:rotate(6deg); z-index:2;',
            'top:120px; left:0px; transform:rotate(4deg); z-index:1;',
            'top:100px; left:180px; transform:rotate(-5deg); z-index:3;',
        ];
    @endphp

    <div class="auth-page d-flex flex-column flex-lg-row">

        {{-- Kiri: branding + kolase cover manhwa populer --}}
        <div class="d-none d-lg-flex flex-column justify-content-center align-items-center position-relative overflow-hidden"
            style="flex:1; padding:60px;
                background:
                    radial-gradient(circle at 20% 20%, rgba(99,102,241,.25), transparent 45%),
                    radial-gradient(circle at 80% 80%, rgba(34,211,238,.18), transparent 45%),
                    linear-gradient(160deg, #0f172a 0%, #1e1b4b 100%);">

            <div class="hero-text" style="max-width:480px;">
                <span class="badge rounded-pill mb-3"
                    style="background:rgba(34,211,238,.12); color:#67e8f9; font-weight:600; padding:8px 14px; letter-spacing:.3px;">
                    {{ $siteSetting->nama_situs }}
                </span>
                <h1 style="color:#f8fafc; font-size:2.4rem; font-weight:800; line-height:1.25;">
                    Baca ribuan manhwa favoritmu,
                    <span
                        style="background:linear-gradient(90deg,#22d3ee,#818cf8); -webkit-background-clip:text; background-clip:text; color:transparent;">kapan
                        aja.</span>
                </h1>
                <p class="mt-3 mb-0" style="color:#94a3b8; font-size:1.05rem; line-height:1.6;">
                    Lanjutkan dari chapter terakhir yang kamu baca, simpan judul favoritmu, dan pantau riwayat bacamu.
                </p>
            </div>

            @if ($heroManhwa->isNotEmpty())
                <div style="position:relative; width:340px; height:340px; margin-top:50px;">
                    @foreach ($heroManhwa as $i => $manhwa)
                        <div class="collage-item"
                            style="{{ $posisiCollage[$i] ?? '' }} --float-delay: {{ $i * 0.8 }}s;">
                            <img class="collage-img" src="{{ asset('storage/' . $manhwa->cover) }}"
                                alt="{{ $manhwa->judul }}"
                                onerror="this.closest('.collage-item').classList.add('is-missing')">
                            <div class="collage-placeholder">
                                <i class="bi bi-image"></i>
                                <span>{{ $manhwa->judul }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Kanan: form login --}}
        <div class="d-flex flex-column justify-content-center align-items-center flex-grow-1 p-4">
            <div style="width:100%; max-width:400px;">

                <div class="text-center mb-4 d-lg-none">
                    <h2 class="fw-bold mb-0" style="color:#f8fafc;">{{ $siteSetting->nama_situs }}</h2>
                </div>

                <div class="auth-card login-card p-4 p-md-5">
                    <h3 class="fw-bold mb-1" style="color:#f8fafc;">Selamat datang kembali</h3>
                    <p class="mb-4" style="color:#94a3b8;">Masuk untuk melanjutkan membaca.</p>

                    @if (session('status'))
                        <div class="auth-alert mb-3">{{ session('status') }}</div>
                    @endif

                    <form id="login-form" method="POST" action="{{ route('login') }}" autocomplete="off" novalidate>
                        @csrf

                        {{-- Email / Username --}}
                        <div class="mb-3">
                            <label for="login" class="auth-label">Email atau Username</label>
                            <div class="auth-field">
                                <i class="bi bi-person auth-icon"></i>
                                <input id="login" type="text" name="login" value="{{ old('login') }}" required
                                    autofocus autocomplete="username"
                                    class="form-control auth-input {{ $errors->has('login') ? 'is-invalid' : '' }}"
                                    placeholder="Masukkan email atau username">
                            </div>
                            @error('login')
                                <div class="auth-error">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label for="password" class="auth-label">Password</label>
                            <div class="auth-field">
                                <i class="bi bi-lock auth-icon"></i>
                                <input id="password" type="password" name="password" required
                                    autocomplete="current-password"
                                    class="form-control auth-input has-toggle {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                    placeholder="Masukkan password">
                                <button type="button" id="toggle-password" class="auth-toggle"
                                    aria-label="Tampilkan password">
                                    <i class="bi bi-eye" id="toggle-password-icon"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="auth-error">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Ingat saya --}}
                        <div class="form-check auth-check mb-4">
                            <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                            <label class="form-check-label" for="remember_me">Ingat Saya</label>
                        </div>

                        <button type="submit" id="login-btn" class="auth-btn">
                            <span class="btn-label">
                                <i class="bi bi-box-arrow-in-right me-1"></i>
                                Login
                            </span>
                            <span class="btn-spinner spinner-border spinner-border-sm" role="status"
                                aria-hidden="true"></span>
                        </button>

                        @if (Route::has('register'))
                            <div class="text-center mt-4" style="color:#94a3b8;">
                                Belum punya akun?
                                <a href="{{ route('register') }}" class="auth-link">Daftar Sekarang</a>
                            </div>
                        @endif
                    </form>
                </div>

                <div class="text-center mt-4" style="color:#64748b; font-size:.9rem;">
                    Anda karyawan?
                    <a href="{{ route('login.staff') }}" class="auth-link">Login di sini</a>
                </div>

            </div>
        </div>

    </div>

    <script>
        // Toggle lihat/sembunyikan password
        document.getElementById('toggle-password').addEventListener('click', function() {
            const input = document.getElementById('password');
            const icon = document.getElementById('toggle-password-icon');
            const isPassword = input.type === 'password';

            input.type = isPassword ? 'text' : 'password';
            icon.classList.toggle('bi-eye', !isPassword);
            icon.classList.toggle('bi-eye-slash', isPassword);
        });

        // Tombol Login berubah jadi spinner saat form dikirim
        const loginForm = document.getElementById('login-form');
        const loginBtn = document.getElementById('login-btn');

        loginForm.addEventListener('submit', function() {
            loginBtn.classList.add('is-loading');
            loginBtn.disabled = true;
        });

        // Kalau user kembali ke halaman ini lewat tombol back, reset tombolnya
        window.addEventListener('pageshow', function() {
            loginBtn.classList.remove('is-loading');
            loginBtn.disabled = false;
        });
    </script>

</x-guest-layout>
