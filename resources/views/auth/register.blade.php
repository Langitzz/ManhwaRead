<x-guest-layout>
    @include('auth.partials.login-styles')

    <style>
        .register-wrap {
            background:
                radial-gradient(circle at 15% 10%, rgba(99, 102, 241, .18), transparent 40%),
                radial-gradient(circle at 85% 90%, rgba(34, 211, 238, .12), transparent 40%),
                #0b1120;

        }

        body {
            margin: 0;
            background: #0b1120;
        }

        .register-wrap {
            position: fixed;
            inset: 0;
            overflow-y: auto;
            display: flex;
            padding: 16px;
        }

        .register-wrap>div {
            margin: auto;
        }

        @keyframes reg-rise {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        .register-card {
            animation: reg-rise .6s ease both;
        }

        #register-btn .btn-spinner {
            display: none;
        }

        #register-btn.is-loading .btn-label {
            display: none;
        }

        #register-btn.is-loading .btn-spinner {
            display: inline-block;
        }

        @media (prefers-reduced-motion: reduce) {
            .register-card {
                animation: none;
            }
        }
    </style>

    <div class="auth-page register-wrap d-flex align-items-center justify-content-center p-3">
        <div style="width:100%; max-width:420px;">

            <div class="text-center mb-4">
                <h2 class="fw-bold mb-1" style="color:#f8fafc;">{{ $siteSetting->nama_situs }}</h2>
                <p class="mb-0" style="color:#94a3b8;">Buat akun baru</p>
            </div>

            <div class="auth-card register-card p-4 p-md-5">
                <h3 class="fw-bold mb-4" style="color:#f8fafc; font-size:1.4rem;">Daftar</h3>

                <form id="register-form" method="POST" action="{{ route('register') }}" autocomplete="off">
                    @csrf

                    {{-- Username --}}
                    <div class="mb-3">
                        <label for="username" class="auth-label">Username</label>
                        <div class="auth-field">
                            <i class="bi bi-person auth-icon"></i>
                            <input id="username" type="text" name="username" value="{{ old('username') }}" required
                                autofocus autocomplete="username"
                                class="form-control auth-input {{ $errors->has('username') ? 'is-invalid' : '' }}"
                                placeholder="Masukkan username">
                        </div>
                        @error('username')
                            <div class="auth-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="auth-label">Email</label>
                        <div class="auth-field">
                            <i class="bi bi-envelope auth-icon"></i>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                autocomplete="email"
                                class="form-control auth-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                placeholder="Masukkan email">
                        </div>
                        @error('email')
                            <div class="auth-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label for="password" class="auth-label">Password</label>
                        <div class="auth-field">
                            <i class="bi bi-lock auth-icon"></i>
                            <input id="password" type="password" name="password" required autocomplete="new-password"
                                class="form-control auth-input has-toggle {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                placeholder="Masukkan password">
                            <button type="button" class="auth-toggle toggle-password" data-target="password"
                                aria-label="Tampilkan password">
                                <i class="bi bi-eye toggle-password-icon"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="auth-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="mb-4">
                        <label for="password_confirmation" class="auth-label">Konfirmasi Password</label>
                        <div class="auth-field">
                            <i class="bi bi-shield-check auth-icon"></i>
                            <input id="password_confirmation" type="password" name="password_confirmation" required
                                autocomplete="new-password"
                                class="form-control auth-input has-toggle {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                placeholder="Ulangi password">
                            <button type="button" class="auth-toggle toggle-password"
                                data-target="password_confirmation" aria-label="Tampilkan password">
                                <i class="bi bi-eye toggle-password-icon"></i>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <div class="auth-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" id="register-btn" class="auth-btn">
                        <span class="btn-label">
                            <i class="bi bi-person-plus me-1"></i>
                            Daftar
                        </span>
                        <span class="btn-spinner spinner-border spinner-border-sm" role="status"
                            aria-hidden="true"></span>
                    </button>
                </form>
            </div>

            <div class="text-center mt-4" style="color:#94a3b8; font-size:.9rem;">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="auth-link">Masuk</a>
            </div>

        </div>
    </div>

    <script>
        // Lihat/sembunyikan password (dua field)
        document.querySelectorAll('.toggle-password').forEach(function(button) {
            button.addEventListener('click', function() {
                const input = document.getElementById(this.dataset.target);
                const icon = this.querySelector('.toggle-password-icon');
                const isPassword = input.type === 'password';

                input.type = isPassword ? 'text' : 'password';
                icon.classList.toggle('bi-eye', !isPassword);
                icon.classList.toggle('bi-eye-slash', isPassword);
            });
        });

        // Tombol Daftar berubah jadi spinner saat form dikirim
        const registerForm = document.getElementById('register-form');
        const registerBtn = document.getElementById('register-btn');

        registerForm.addEventListener('submit', function() {
            registerBtn.classList.add('is-loading');
            registerBtn.disabled = true;
        });

        window.addEventListener('pageshow', function() {
            registerBtn.classList.remove('is-loading');
            registerBtn.disabled = false;
        });
    </script>
</x-guest-layout>
