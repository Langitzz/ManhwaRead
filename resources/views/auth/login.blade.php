<x-guest-layout>

    <div class="text-center mb-3">
        <h2 class="fw-bold mb-1" style="color:#f8fafc;">
            ManhwaRead
        </h2>
        <p class="mb-0" style="color:#94a3b8;">
            Selamat datang kembali
        </p>
    </div>

    <div class="card"
        style="border-radius:16px; border:none; background:#1f2937; box-shadow:0 8px 25px rgba(0,0,0,.25);">
        <div class="card-body p-4">

            <x-auth-session-status class="mb-3" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-3">
                    <x-input-label for="email" value="Email" class="text-light" />
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        autocomplete="username" class="form-control" placeholder="Masukkan email"
                        style="margin-top:8px; height:50px; border-radius:12px; background:#111827;
                            color:#f8fafc; border-color:#4b5563;">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <x-input-label for="password" value="Password" class="text-light" />
                    <div class="position-relative" style="margin-top:8px;">
                        <input id="password" type="password" name="password" required
                            autocomplete="current-password" class="form-control" placeholder="Masukkan password"
                            style="height:50px; border-radius:12px; background:#111827;
                                color:#f8fafc; border-color:#4b5563; padding-right:45px;">
                        <button type="button" id="toggle-password"
                            class="btn position-absolute top-50 end-0 translate-middle-y me-2 p-0 border-0"
                            style="background:none; color:#94a3b8; width:30px; height:30px;">
                            <i class="bi bi-eye" id="toggle-password-icon"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                {{-- Remember & Lupa Password sejajar --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                        <label class="form-check-label" for="remember_me" style="color:#e5e7eb;">
                            Ingat Saya
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-decoration-none"
                            style="color:#60a5fa; font-size:14px;">
                            Lupa Password?
                        </a>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary w-100"
                    style="border-radius:50px; height:50px; font-weight:600;">
                    <i class="bi bi-box-arrow-in-right me-1"></i>
                    Login
                </button>

                @if (Route::has('register'))
                    <div class="text-center mt-4" style="color:#94a3b8;">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="text-decoration-none fw-semibold"
                            style="color:#60a5fa;">
                            Daftar Sekarang
                        </a>
                    </div>
                @endif

            </form>

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
