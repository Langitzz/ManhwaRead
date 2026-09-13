<x-guest-layout>
    <div class="text-center mb-4 mt-2">
        <h2 class="fw-bold mt-3 mb-1 text-white">
            {{ $siteSetting->nama_situs }}
        </h2>
        <p class="text-light mb-0" style="opacity:.8;">
            Buat akun baru
        </p>
    </div>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Username -->
        <div style="margin-bottom:20px;">
            <x-input-label for="username" value="Username" />
            <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus
                autocomplete="username" class="form-control" placeholder="Masukkan username"
                style="
                margin-top:8px;
                height:50px;
                border-radius:12px;
            ">
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
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
            <div class="position-relative" style="margin-top:8px;">
                <input id="password" type="password" name="password" required autocomplete="new-password"
                    class="form-control" placeholder="Masukkan password"
                    style="
                    height:50px;
                    border-radius:12px;
                    padding-right:45px;
                ">
                <button type="button" class="toggle-password" data-target="password"
                    style="position:absolute; top:50%; right:12px; transform:translateY(-50%);
                        background:none; border:none; padding:0; color:#94a3b8; cursor:pointer;">
                    <i class="bi bi-eye toggle-password-icon"></i>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div style="margin-bottom:20px;">
            <x-input-label for="password_confirmation" value="Konfirmasi Password" />
            <div class="position-relative" style="margin-top:8px;">
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    autocomplete="new-password" class="form-control" placeholder="Ulangi password"
                    style="
                    height:50px;
                    border-radius:12px;
                    padding-right:45px;
                ">
                <button type="button" class="toggle-password" data-target="password_confirmation"
                    style="position:absolute; top:50%; right:12px; transform:translateY(-50%);
                        background:none; border:none; padding:0; color:#94a3b8; cursor:pointer;">
                    <i class="bi bi-eye toggle-password-icon"></i>
            </div>
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

    <script>
        document.querySelectorAll('.toggle-password').forEach(function(button) {
            button.addEventListener('click', function() {
                const targetId = this.dataset.target;
                const input = document.getElementById(targetId);
                const icon = this.querySelector('.toggle-password-icon');
                const isPassword = input.type === 'password';

                input.type = isPassword ? 'text' : 'password';
                icon.classList.toggle('bi-eye', !isPassword);
                icon.classList.toggle('bi-eye-slash', isPassword);
            });
        });
    </script>
</x-guest-layout>
