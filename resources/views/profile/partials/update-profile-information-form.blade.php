<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')
        <div class="row">
            {{-- Nama Lengkap --}}
            <div class="col-md-6 mb-3">
                <x-input-label for="name" value="Nama Lengkap" style="color:#e2e8f0; font-size:13px;" />
                <x-text-input id="name" name="name" type="text"
                    style="width:100%; margin-top:6px; height:38px; border-radius:10px;
                        padding:0 14px; font-size:13px;
                        background:#111827; border:1px solid #374151; color:#f8fafc;"
                    :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            {{-- Email --}}
            <div class="col-md-6 mb-3">
                <x-input-label for="email" value="Email" style="color:#e2e8f0; font-size:13px;" />
                <x-text-input id="email" name="email" type="email"
                    style="width:100%; margin-top:6px; height:38px; border-radius:10px;
                        padding:0 14px; font-size:13px;
                        background:#111827; border:1px solid #374151; color:#f8fafc;"
                    :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div style="margin-top:10px;">
                        <p style="color:#f59e0b; font-size:13px; margin:0;">
                            Alamat email Anda belum diverifikasi.
                        </p>
                        <button form="send-verification" type="submit"
                            style="margin-top:6px; background:none; border:none; padding:0;
                                color:#60a5fa; font-size:13px; cursor:pointer;">
                            Kirim ulang email verifikasi
                        </button>
                        @if (session('status') === 'verification-link-sent')
                            <p style="margin-top:8px; color:#22c55e; font-size:13px;">
                                Link verifikasi baru telah dikirim ke email Anda.
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            {{-- Role (read-only) --}}
            <div class="col-md-6 mb-3">
                <x-input-label value="Role" style="color:#e2e8f0; font-size:13px;" />
                <input type="text" value="{{ $user->userRole->nama_peran ?? '-' }}" disabled
                    style="width:100%; margin-top:6px; height:38px; border-radius:10px;
                        padding:0 14px; font-size:13px;
                        background:#0b1220; border:1px solid #374151; color:#94a3b8;">
            </div>

            {{-- Nomor Telepon --}}
            <div class="col-md-6 mb-3">
                <x-input-label for="phone" value="Nomor Telepon" style="color:#e2e8f0; font-size:13px;" />
                <x-text-input id="phone" name="phone" type="text"
                    style="width:100%; margin-top:6px; height:38px; border-radius:10px;
                        padding:0 14px; font-size:13px;
                        background:#111827; border:1px solid #374151; color:#f8fafc;"
                    :value="old('phone', $user->phone)" autocomplete="tel" placeholder="Contoh: 081234567890" />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>

            {{-- Alamat (full width) --}}
            <div class="col-12 mb-3">
                <x-input-label for="address" value="Alamat" style="color:#e2e8f0; font-size:13px;" />
                <textarea id="address" name="address" rows="3"
                    style="width:100%; margin-top:6px; border-radius:10px; background:#111827;
                        border:1px solid #374151; color:#f8fafc; padding:10px 14px; font-size:13px;"
                    placeholder="Masukkan alamat lengkap">{{ old('address', $user->address) }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('address')" />
            </div>
        </div>

        {{-- Tombol --}}
        <div class="d-flex justify-content-end align-items-center gap-2 mt-2">
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    style="margin:0; color:#22c55e; font-size:14px;">
                    Perubahan berhasil disimpan.
                </p>
            @endif
            <button type="reset" class="btn btn-secondary">
                <i class="bi bi-arrow-counterclockwise me-1"></i>
                Reset
            </button>
            <x-primary-button>
                Simpan Perubahan
            </x-primary-button>
        </div>
    </form>
</section>
