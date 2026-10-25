<x-guest-layout>
    @include('auth.partials.login-styles')

    <style>
        body {
            margin: 0;
            background: #0b1120;
        }

        .confirm-wrap {
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

        .confirm-wrap > div {
            margin: auto;
        }

        @keyframes confirm-rise {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: none; }
        }

        .confirm-card {
            animation: confirm-rise .6s ease both;
        }

        .confirm-icon {
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

        #confirm-btn .btn-spinner {
            display: none;
        }

        #confirm-btn.is-loading .btn-label {
            display: none;
        }

        #confirm-btn.is-loading .btn-spinner {
            display: inline-block;
        }

        @media (prefers-reduced-motion: reduce) {
            .confirm-card {
                animation: none;
            }
        }
    </style>

    <div class="confirm-wrap">
        <div style="width:100%; max-width:420px;">

            <div class="text-center mb-4">
                <div class="confirm-icon mx-auto mb-3">
                    <i class="bi bi-shield-lock"></i>
                </div>
                <h2 class="fw-bold mb-1" style="color:#f8fafc;">Konfirmasi Password</h2>
                <p class="mb-0" style="color:#94a3b8;">
                    Ini area aman aplikasi. Mohon konfirmasi password kamu sebelum melanjutkan.
                </p>
            </div>

            <div class="auth-card confirm-card p-4 p-md-5">

                <form id="confirm-form" method="POST" action="{{ route('password.confirm') }}" autocomplete="off">
                    @csrf

                    {{-- Password --}}
                    <div class="mb-4">
                        <label for="password" class="auth-label">Password</label>
                        <div class="auth-field">
                            <i class="bi bi-lock auth-icon"></i>
                            <input id="password" type="password" name="password" required autofocus
                                autocomplete="current-password"
                                class="form-control auth-input has-toggle {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                placeholder="Masukkan password">
                            <button type="button" id="toggle-password" class="auth-toggle" aria-label="Tampilkan password">
                                <i class="bi bi-eye" id="toggle-password-icon"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="auth-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" id="confirm-btn" class="auth-btn">
                        <span class="btn-label">
                            <i class="bi bi-check2-circle me-1"></i>
                            Konfirmasi
                        </span>
                        <span class="btn-spinner spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    </button>
                </form>
            </div>

        </div>
    </div>

    <script>
        // Lihat/sembunyikan password
        document.getElementById('toggle-password').addEventListener('click', function() {
            const input = document.getElementById('password');
            const icon = document.getElementById('toggle-password-icon');
            const isPassword = input.type === 'password';

            input.type = isPassword ? 'text' : 'password';
            icon.classList.toggle('bi-eye', !isPassword);
            icon.classList.toggle('bi-eye-slash', isPassword);
        });

        // Tombol Konfirmasi berubah jadi spinner saat form dikirim
        const confirmForm = document.getElementById('confirm-form');
        const confirmBtn = document.getElementById('confirm-btn');

        confirmForm.addEventListener('submit', function() {
            confirmBtn.classList.add('is-loading');
            confirmBtn.disabled = true;
        });

        window.addEventListener('pageshow', function() {
            confirmBtn.classList.remove('is-loading');
            confirmBtn.disabled = false;
        });
    </script>
</x-guest-layout>