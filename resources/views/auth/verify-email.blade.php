<x-guest-layout>

    <div class="text-center mb-3">
        <h2 class="fw-bold mb-1" style="color:#f8fafc;">
            Verifikasi Email
        </h2>
        <p class="mb-0" style="color:#94a3b8;">
            Terima kasih sudah mendaftar! Sebelum mulai, tolong verifikasi alamat email kamu dengan
            klik link yang sudah kami kirimkan. Kalau belum dapat emailnya, kami akan kirimkan lagi.
        </p>
    </div>

    <div class="card"
        style="border-radius:16px; border:none; background:#1f2937; box-shadow:0 8px 25px rgba(0,0,0,.25);">
        <div class="card-body p-4">

            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success" role="alert">
                    Link verifikasi baru sudah dikirim ke alamat email yang kamu daftarkan.
                </div>
            @endif

            <div class="d-flex align-items-center justify-content-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary" style="border-radius:50px; font-weight:600;">
                        Kirim Ulang Email Verifikasi
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0" style="color:#94a3b8; text-decoration:underline;">
                        Keluar
                    </button>
                </form>
            </div>

        </div>
    </div>

</x-guest-layout>
