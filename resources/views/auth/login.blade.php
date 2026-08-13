<x-guest-layout>
    <div class="text-center mb-4 mt-2">
        <h2 class="fw-bold mt-3 mb-1 text-white">
            ManhwaRead
        </h2>
        <p class="text-light mb-0" style="opocity: .8;">
            Selamat datang kembali
        </p>
    </div>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <div style="margin-bottom:20px;">
            <x-input-label for="email" value="Email" />
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                autocomplete="username" class="form-control" placeholder="Masukkan email"
                style="
                margin-top:8px;
                height:50px;
                border-radius:12px;
            ">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Password --}}
        <div style="margin-bottom:20px;">
            <x-input-label for="password" value="Password" />

            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="form-control" placeholder="Masukkan password"
                style="
                margin-top:8px;
                height:50px;
                border-radius:12px;
            ">

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Remember --}}
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
            <label class="form-check-label" for="remember_me">
                Ingat saya
            </label>
        </div>

        <button type="submit" class="btn btn-primary w-100">
            <i class="fas fa-sign-in-alt me-1"></i>
            Masuk
        </button>

        <div class="text-center mt-3">
            @if (Route::has('register'))
                <span>Belum punya akun?</span>
                <a href="{{ route('register') }}" class="text-decoration-none">
                    Daftar
                </a>
            @endif
        </div>
        <hr class="my-3">
        @if (Route::has('password.request'))
            <div class="text-center">
                <a href="{{ route('password.request') }}" class="text-decoration-none">
                    Lupa password?
                </a>
            </div>
        @endif

    </form>

</x-guest-layout>
