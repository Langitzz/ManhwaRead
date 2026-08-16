<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        {{-- Nama --}}
        <div style="margin-bottom:20px;">
            <x-input-label
                for="name"
                value="Nama"
                style="color:#e2e8f0;"
            />

            <x-text-input
                id="name"
                name="name"
                type="text"
                style="
                    width:100%;
                    margin-top:8px;
                    height:48px;
                    border-radius:10px;
                    background:#111827;
                    border:1px solid #374151;
                    color:#f8fafc;
                "
                :value="old('name', $user->name)"
                required
                autofocus
                autocomplete="name"
            />

            <x-input-error
                class="mt-2"
                :messages="$errors->get('name')"
            />
        </div>

        {{-- Email --}}
        <div style="margin-bottom:20px;">
            <x-input-label
                for="email"
                value="Email"
                style="color:#e2e8f0;"
            />

            <x-text-input
                id="email"
                name="email"
                type="email"
                style="
                    width:100%;
                    margin-top:8px;
                    height:48px;
                    border-radius:10px;
                    background:#111827;
                    border:1px solid #374151;
                    color:#f8fafc;
                "
                :value="old('email', $user->email)"
                required
                autocomplete="username"
            />

            <x-input-error
                class="mt-2"
                :messages="$errors->get('email')"
            />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div style="margin-top:10px;">
                    <p style="
                        color:#f59e0b;
                        font-size:13px;
                        margin:0;
                    ">
                        Alamat email Anda belum diverifikasi.
                    </p>

                    <button
                        form="send-verification"
                        type="submit"
                        style="
                            margin-top:6px;
                            background:none;
                            border:none;
                            padding:0;
                            color:#60a5fa;
                            font-size:13px;
                            cursor:pointer;
                        "
                    >
                        Kirim ulang email verifikasi
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p style="
                            margin-top:8px;
                            color:#22c55e;
                            font-size:13px;
                        ">
                            Link verifikasi baru telah dikirim ke email Anda.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Tombol Simpan --}}
        <div style="
            display:flex;
            align-items:center;
            gap:15px;
        ">
            <x-primary-button>
                Simpan Perubahan
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    style="
                        margin:0;
                        color:#22c55e;
                        font-size:14px;
                    "
                >
                    Perubahan berhasil disimpan.
                </p>
            @endif
        </div>
    </form>
</section>