<x-guest-layout>

    <div class="text-center mb-3">
        <h2 class="fw-bold mb-1" style="color:#f8fafc;">
            Reset Password
        </h2>
        <p class="mb-0" style="color:#94a3b8;">
            Masukkan password baru kamu di bawah ini.
        </p>
    </div>

    <div class="card"
        style="border-radius:16px; border:none; background:#1f2937; box-shadow:0 8px 25px rgba(0,0,0,.25);">
        <div class="card-body p-4">

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="mb-3">
                    <x-input-label for="email" value="Email" class="text-light" />
                    <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required
                        autofocus autocomplete="username" class="form-control" placeholder="nama@email.com"
                        style="margin-top:8px; height:50px; border-radius:12px; background:#111827;
                            color:#f8fafc; border-color:#4b5563;">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-3">
                    <x-input-label for="password" value="Password Baru" class="text-light" />
                    <div class="position-relative" style="margin-top:8px;">
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            class="form-control" placeholder="Masukkan password baru"
                            style="height:50px; border-radius:12px; background:#111827;
                                color:#f8fafc; border-color:#4b5563; padding-right:45px;">
                        <button type="button" class="toggle-password" data-target="password"
                            style="position:absolute; top:50%; right:12px; transform:translateY(-50%);
                                background:none; border:none; padding:0; color:#94a3b8; cursor:pointer;">
                            <i class="bi bi-eye toggle-password-icon"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mb-3">
                    <x-input-label for="password_confirmation" value="Konfirmasi Password Baru" class="text-light" />
                    <div class="position-relative" style="margin-top:8px;">
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            autocomplete="new-password" class="form-control" placeholder="Ulangi password baru"
                            style="height:50px; border-radius:12px; background:#111827;
                                color:#f8fafc; border-color:#4b5563; padding-right:45px;">
                        <button type="button" class="toggle-password" data-target="password_confirmation"
                            style="position:absolute; top:50%; right:12px; transform:translateY(-50%);
                                background:none; border:none; padding:0; color:#94a3b8; cursor:pointer;">
                            <i class="bi bi-eye toggle-password-icon"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <button type="submit" class="btn btn-primary w-100"
                    style="border-radius:50px; height:50px; font-weight:600;">
                    Reset Password
                </button>
            </form>

        </div>
    </div>

    <script>
        document.querySelectorAll('.toggle-password').forEach(function(button) {
            button.addEventListener('click', function() {
                const input = document.getElementById(button.dataset.target);
                const icon = button.querySelector('.toggle-password-icon');
                const isPassword = input.type === 'password';

                input.type = isPassword ? 'text' : 'password';
                icon.classList.toggle('bi-eye', !isPassword);
                icon.classList.toggle('bi-eye-slash', isPassword);
            });
        });
    </script>

</x-guest-layout>