<x-guest-layout>
    @include('auth.partials.login-styles')

    <style>
        body {
            margin: 0;
            background: #0b1120;
        }

        .reset-wrap {
            position: fixed;
            inset: 0;
            overflow-y: auto;
            display: flex;
            padding: 16px;
            background:
                radial-gradient(circle at 15% 10%, rgba(99,102,241,.18), transparent 40%),
                radial-gradient(circle at 85% 90%, rgba(34,211,238,.12), transparent 40%),
                #0b1120;
        }

        .reset-wrap > div {
            margin: auto;
        }

        @keyframes reset-rise {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: none; }
        }

        .reset-card {
            animation: reset-rise .6s ease both;
        }

        .reset-icon {
            width: 68px;
            height: 68px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.9rem;
            color: #fff;
            background: linear-gradient(135deg, #6366f1 0%, #22d3ee 100%);
            box-shadow: 0 12px 30px rgba(99, 102, 241, .35);
        }

        #reset-btn .btn-spinner {
            display: none;
        }

        #reset-btn.is-loading .btn-label {
            display: none;
        }

        #reset-btn.is-loading .btn-spinner {
            display: inline-block;
        }

        @media (prefers-reduced-motion: reduce) {
            .reset-card {
                animation: none;
            }
        }
    </style>

    <div class="reset-wrap">
        <div style="width:100%; max-width:420px;">

            <div class="text-center mb-4">
                <div class="reset-icon mx-auto mb-3">
                    <i class="bi bi-shield-check"></i>
                </div>
                <h2 class="fw-bold mb-1" style="color:#f8fafc;">Reset Password</h2>
                <p class="mb-0" style="color:#94a3b8;">Masukkan password baru kamu di bawah ini.</p>
            </div>

            <div class="auth-card reset-card p-4 p-md-5">

                <form id="reset-form" method="POST" action="{{ route('password.store') }}" autocomplete="off">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="auth-label">Email</label>
                        <div class="auth-field">
                            <i class="bi bi-envelope auth-icon"></i>
                            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}"
                                required autofocus autocomplete="username"
                                class="form-control auth-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                placeholder="nama@email.com">
                        </div>
                        @error('email')
                            <div class="auth-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password baru --}}
                    <div class="mb-3">
                        <label for="password" class="auth-label">Password Baru</label>
                        <div class="auth-field">
                            <i class="bi bi-lock auth-icon"></i>
                            <input id="password" type="password" name="password" required autocomplete="new-password"
                                class="form-control auth-input has-toggle {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                placeholder="Masukkan password baru">
                            <button type="button" class="auth-toggle toggle-password" data-target="password" aria-label="Tampilkan password">
                                <i class="bi bi-eye toggle-password-icon"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="auth-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Konfirmasi password baru --}}
                    <div class="mb-4">
                        <label for="password_confirmation" class="auth-label">Konfirmasi Password Baru</label>
                        <div class="auth-field">
                            <i class="bi bi-shield-check auth-icon"></i>
                            <input id="password_confirmation" type="password" name="password_confirmation" required
                                autocomplete="new-password"
                                class="form-control auth-input has-toggle {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                placeholder="Ulangi password baru">
                            <button type="button" class="auth-toggle toggle-password" data-target="password_confirmation" aria-label="Tampilkan password">
                                <i class="bi bi-eye toggle-password-icon"></i>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <div class="auth-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" id="reset-btn" class="auth-btn">
                        <span class="btn-label">
                            <i class="bi bi-check2-circle me-1"></i>
                            Reset Password
                        </span>
                        <span class="btn-spinner spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    </button>
                </form>
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

        // Tombol Reset Password berubah jadi spinner saat form dikirim
        const resetForm = document.getElementById('reset-form');
        const resetBtn = document.getElementById('reset-btn');

        resetForm.addEventListener('submit', function() {
            resetBtn.classList.add('is-loading');
            resetBtn.disabled = true;
        });

        window.addEventListener('pageshow', function() {
            resetBtn.classList.remove('is-loading');
            resetBtn.disabled = false;
        });
    </script>
</x-guest-layout>