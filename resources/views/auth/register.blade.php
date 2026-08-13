<x-guest-layout>
    <div class="text-center mb-4 mt-2">
        <h2 class="fw-bold mt-3 mb-1 text-white">
            ManhwaRead
        </h2>
        <p class="text-light mb-0" style="opacity:.8;">
            Buat akun baru
        </p>
    </div>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div style="margin-bottom:20px;">
            <x-input-label for="name" value="Nama" />
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                autocomplete="name" class="form-control" placeholder="Masukkan nama"
                style="
                margin-top:8px;
                height:50px;
                border-radius:12px;
            ">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div style="margin-bottom:20px;">
            <x-input-label for="email" value="Email" />
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                autocomplete="username" class="form-control" placeholder="Masukkan email"
                style="
                margin-top:8px;
                height:50px;
                border-radius:12px;
            ">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div style="margin-bottom:20px;">
            <x-input-label for="password" value="Password" />
            <input id="password" type="password" name="password" required autocomplete="new-password"
                class="form-control" placeholder="Masukkan password"
                style="
                margin-top:8px;
                height:50px;
                border-radius:12px;
            ">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div style="margin-bottom:20px;">
            <x-input-label for="password_confirmation" value="Konfirmasi Password" />
            <input id="password_confirmation" type="password" name="password_confirmation" required
                autocomplete="new-password" class="form-control" placeholder="Ulangi password"
                style="
                margin-top:8px;
                height:50px;
                border-radius:12px;
            ">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary w-100">
                Daftar
            </button>
            <div class="mt-3">
                <span>Sudah punya akun?</span>
                <a href="{{ route('login') }}" class="text-decoration-none">
                    Masuk
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>
