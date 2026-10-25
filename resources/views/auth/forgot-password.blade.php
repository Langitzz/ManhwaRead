<x-guest-layout>
    @include('auth.partials.login-styles')

    <style>
        body {
            margin: 0;
            background: #0b1120;
        }

        .forgot-wrap {
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

        .forgot-wrap > div {
            margin: auto;
        }

        @keyframes forgot-rise {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: none; }
        }

        .forgot-card {
            animation: forgot-rise .6s ease both;
        }

        .forgot-icon {
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

        #forgot-btn .btn-spinner {
            display: none;
        }

        #forgot-btn.is-loading .btn-label {
            display: none;
        }

        #forgot-btn.is-loading .btn-spinner {
            display: inline-block;
        }

        @media (prefers-reduced-motion: reduce) {
            .forgot-card {
                animation: none;
            }
        }
    </style>

    <div class="forgot-wrap">
        <div style="width:100%; max-width:420px;">

            <div class="text-center mb-4">
                <div class="forgot-icon mx-auto mb-3">
                    <i class="bi bi-key"></i>
                </div>
                <h2 class="fw-bold mb-1" style="color:#f8fafc;">Lupa Password?</h2>
                <p class="mb-0" style="color:#94a3b8;">
                    Tenang, masukkan alamat email kamu. Kami akan kirimkan link untuk reset password.
                </p>
            </div>

            <div class="auth-card forgot-card p-4 p-md-5">

                @if (session('status'))
                    <div class="auth-alert mb-3">{{ session('status') }}</div>
                @endif

                <form id="forgot-form" method="POST" action="{{ route('password.email') }}" autocomplete="off">
                    @csrf

                    {{-- Email --}}
                    <div class="mb-4">
                        <label for="email" class="auth-label">Email</label>
                        <div class="auth-field">
                            <i class="bi bi-envelope auth-icon"></i>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                autocomplete="email"
                                class="form-control auth-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                placeholder="nama@email.com">
                        </div>
                        @error('email')
                            <div class="auth-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" id="forgot-btn" class="auth-btn">
                        <span class="btn-label">
                            <i class="bi bi-send me-1"></i>
                            Kirim Link Reset Password
                        </span>
                        <span class="btn-spinner spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    </button>
                </form>
            </div>

            <div class="text-center mt-4" style="color:#94a3b8; font-size:.9rem;">
                <a href="{{ route('login') }}" class="auth-link">Kembali ke halaman Login</a>
            </div>

        </div>
    </div>

    <script>
        const forgotForm = document.getElementById('forgot-form');
        const forgotBtn = document.getElementById('forgot-btn');

        forgotForm.addEventListener('submit', function() {
            forgotBtn.classList.add('is-loading');
            forgotBtn.disabled = true;
        });

        window.addEventListener('pageshow', function() {
            forgotBtn.classList.remove('is-loading');
            forgotBtn.disabled = false;
        });
    </script>
</x-guest-layout>