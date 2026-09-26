<x-guest-layout>

    <div class="text-center mb-3">
        <h2 class="fw-bold mb-1" style="color:#f8fafc;">
            Lupa Password?
        </h2>
        <p class="mb-0" style="color:#94a3b8;">
            Gak masalah. Masukkan alamat email kamu, kami akan kirimkan link buat reset password.
        </p>
    </div>

    <div class="card"
        style="border-radius:16px; border:none; background:#1f2937; box-shadow:0 8px 25px rgba(0,0,0,.25);">
        <div class="card-body p-4">

            <x-auth-session-status class="mb-3" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-3">
                    <x-input-label for="email" value="Email" class="text-light" />
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="form-control" placeholder="nama@email.com"
                        style="margin-top:8px; height:50px; border-radius:12px; background:#111827;
                            color:#f8fafc; border-color:#4b5563;">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <button type="submit" class="btn btn-primary w-100"
                    style="border-radius:50px; height:50px; font-weight:600;">
                    Kirim Link Reset Password
                </button>
            </form>

            <div class="text-center mt-3">
                <a href="{{ route('login') }}" style="color:#60a5fa; text-decoration:none;">
                    Kembali ke halaman Login
                </a>
            </div>

        </div>
    </div>

</x-guest-layout>