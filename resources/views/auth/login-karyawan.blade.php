<x-guest-layout :centered="false">
    @include('auth.partials.login-styles')

    <style>
        .staff-badge {
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

        .staff-note {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            border-radius: 12px;
            padding: 12px 14px;
            font-size: .875rem;
            color: #a5b4fc;
            background: rgba(99, 102, 241, .1);
            border: 1px solid rgba(99, 102, 241, .25);
        }
    </style>

    <div class="auth-page d-flex align-items-center justify-content-center p-3"
        style="background:
            radial-gradient(circle at 15% 10%, rgba(99,102,241,.18), transparent 40%),
            radial-gradient(circle at 85% 90%, rgba(34,211,238,.12), transparent 40%),
            #0b1120;">

        <div style="width:100%; max-width:420px;">

            <div class="text-center mb-4">
                <div class="staff-badge mx-auto mb-3">
                    <i class="bi bi-shield-lock"></i>
                </div>
                <h2 class="fw-bold mb-1" style="color:#f8fafc;">{{ $siteSetting->nama_situs }}</h2>
                <p class="mb-0" style="color:#94a3b8;">Portal Karyawan</p>
            </div>

            <div class="auth-card p-4 p-md-5">

                <div class="staff-note mb-4">
                    <i class="bi bi-info-circle mt-1"></i>
                    <span>Halaman ini khusus untuk Admin, Editor, Owner, dan Supervisor.</span>
                </div>

                @if (session('status'))
                    <div class="auth-alert mb-3">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('login.staff.store') }}" autocomplete="off" novalidate>
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

                    <button type="submit" class="auth-btn">
                        <i class="bi bi-box-arrow-in-right me-1"></i>
                        Login
                    </button>
                </form>
            </div>

            <div class="text-center mt-4" style="color:#64748b; font-size:.9rem;">
                Bukan karyawan?
                <a href="{{ route('login') }}" class="auth-link">Login sebagai user</a>
            </div>

        </div>
    </div>

    <script>
        document.getElementById('toggle-password').addEventListener('click', function() {
            const input = document.getElementById('password');
            const icon = document.getElementById('toggle-password-icon');
            const isPassword = input.type === 'password';

            input.type = isPassword ? 'text' : 'password';
            icon.classList.toggle('bi-eye', !isPassword);
            icon.classList.toggle('bi-eye-slash', isPassword);
        });
    </script>

</x-guest-layout>
