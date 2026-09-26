<x-guest-layout>

    <div class="text-center mb-3">
        <h2 class="fw-bold mb-1" style="color:#f8fafc;">
            Konfirmasi Password
        </h2>
        <p class="mb-0" style="color:#94a3b8;">
            Ini adalah area aman aplikasi. Mohon konfirmasi password kamu sebelum melanjutkan.
        </p>
    </div>

    <div class="card"
        style="border-radius:16px; border:none; background:#1f2937; box-shadow:0 8px 25px rgba(0,0,0,.25);">
        <div class="card-body p-4">

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div class="mb-3">
                    <x-input-label for="password" value="Password" class="text-light" />
                    <div class="position-relative" style="margin-top:8px;">
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="form-control" placeholder="Masukkan password"
                            style="height:50px; border-radius:12px; background:#111827;
                                color:#f8fafc; border-color:#4b5563; padding-right:45px;">
                        <button type="button" id="toggle-password"
                            style="position:absolute; top:50%; right:12px; transform:translateY(-50%);
                                background:none; border:none; padding:0; color:#94a3b8; cursor:pointer;">
                            <i class="bi bi-eye" id="toggle-password-icon"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <button type="submit" class="btn btn-primary w-100"
                    style="border-radius:50px; height:50px; font-weight:600;">
                    Konfirmasi
                </button>
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