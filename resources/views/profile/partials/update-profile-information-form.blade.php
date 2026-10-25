<section>
    <style>
        .pf-label {
            display: block;
            font-size: .85rem;
            font-weight: 600;
            color: #cbd5e1;
            margin-bottom: 6px;
        }

        .pf-input {
            width: 100%;
            height: 46px;
            border-radius: 12px;
            background: #0f172a;
            border: 1px solid #334155;
            color: #f8fafc;
            padding: 0 14px;
            font-size: .95rem;
            transition: border-color .15s, box-shadow .15s;
        }

        .pf-input:focus {
            outline: none;
            border-color: #22d3ee;
            box-shadow: 0 0 0 .2rem rgba(34, 211, 238, .15);
        }

        .pf-input:disabled {
            color: #64748b;
            background: #0b1220;
        }

        .pf-input.is-invalid {
            border-color: #f87171;
        }

        textarea.pf-input {
            height: auto;
            padding: 12px 14px;
        }

        .pf-file::file-selector-button {
            border: 1px solid #334155;
            background: #0f172a;
            color: #e2e8f0;
            border-radius: 10px;
            padding: 6px 12px;
            margin-right: 10px;
            cursor: pointer;
        }

        .pf-error {
            color: #f87171;
            font-size: .85rem;
            margin-top: 6px;
        }

        .pf-warn {
            color: #fbbf24;
            font-size: .9rem;
            margin: 10px 0 0;
        }

        .pf-link-btn {
            background: none;
            border: none;
            padding: 0;
            color: #67e8f9;
            font-size: .9rem;
            font-weight: 600;
        }

        .pf-link-btn:hover {
            color: #a5f3fc;
        }

        .pf-btn-primary {
            height: 44px;
            padding: 0 22px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            color: #fff;
            background: linear-gradient(135deg, #6366f1 0%, #22d3ee 100%);
            box-shadow: 0 8px 20px rgba(34, 211, 238, .18);
        }

        .pf-btn-primary:hover {
            color: #fff;
            box-shadow: 0 12px 26px rgba(34, 211, 238, .28);
        }

        .pf-btn-ghost {
            height: 44px;
            padding: 0 20px;
            border-radius: 12px;
            border: 1px solid #334155;
            background: transparent;
            color: #cbd5e1;
            font-weight: 600;
        }

        .pf-btn-ghost:hover {
            background: rgba(148, 163, 184, .08);
            color: #f8fafc;
        }

        .pf-success {
            color: #86efac;
            font-size: .9rem;
            margin: 0;
        }
    </style>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" autocomplete="off">
        @csrf
        @method('patch')

        {{-- Foto Profil --}}
        <div class="d-flex align-items-center gap-3 mb-4 pb-4" style="border-bottom:1px solid #334155;">
            <x-foto-profil :user="$user" size="64" />
            <div class="flex-grow-1">
                <label for="foto_profil" class="pf-label mb-2">Foto Profil</label>
                <input id="foto_profil" name="foto_profil" type="file" accept="image/*"
                    class="pf-file w-100" style="color:#cbd5e1; font-size:.85rem;">
                @error('foto_profil')
                    <div class="pf-error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            {{-- Nama Lengkap --}}
            <div class="col-md-6 mb-3">
                <label for="name" class="pf-label">Nama Lengkap</label>
                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus
                    autocomplete="name" class="pf-input {{ $errors->has('name') ? 'is-invalid' : '' }}">
                @error('name')
                    <div class="pf-error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Username --}}
            <div class="col-md-6 mb-3">
                <label for="username" class="pf-label">Username</label>
                <input id="username" name="username" type="text" value="{{ old('username', $user->username) }}"
                    autocomplete="username" placeholder="Opsional, contoh: budi123"
                    class="pf-input {{ $errors->has('username') ? 'is-invalid' : '' }}">
                @error('username')
                    <div class="pf-error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="col-md-6 mb-3">
                <label for="email" class="pf-label">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                    autocomplete="email" class="pf-input {{ $errors->has('email') ? 'is-invalid' : '' }}">
                @error('email')
                    <div class="pf-error">{{ $message }}</div>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-2">
                        <p class="pf-warn">Alamat email kamu belum diverifikasi.</p>
                        <button form="send-verification" type="submit" class="pf-link-btn">
                            Kirim ulang email verifikasi
                        </button>
                        @if (session('status') === 'verification-link-sent')
                            <p class="pf-success mt-2">Link verifikasi baru telah dikirim ke email kamu.</p>
                        @endif
                    </div>
                @endif
            </div>

            {{-- Role (read-only) --}}
            <div class="col-md-6 mb-3">
                <label class="pf-label">Role</label>
                <input type="text" value="{{ $user->userRole->nama_peran ?? '-' }}" disabled class="pf-input">
            </div>

            {{-- Nomor Telepon --}}
            <div class="col-md-6 mb-3">
                <label for="phone" class="pf-label">Nomor Telepon</label>
                <input id="phone" name="phone" type="text" value="{{ old('phone', $user->phone) }}"
                    autocomplete="tel" placeholder="Contoh: 081234567890"
                    class="pf-input {{ $errors->has('phone') ? 'is-invalid' : '' }}">
                @error('phone')
                    <div class="pf-error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Alamat --}}
            <div class="col-12 mb-3">
                <label for="address" class="pf-label">Alamat</label>
                <textarea id="address" name="address" rows="3" placeholder="Masukkan alamat lengkap"
                    class="pf-input {{ $errors->has('address') ? 'is-invalid' : '' }}">{{ old('address', $user->address) }}</textarea>
                @error('address')
                    <div class="pf-error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Tombol --}}
        <div class="d-flex justify-content-end align-items-center gap-2 mt-2 flex-wrap">
            @if (session('status') === 'profile-updated')
                <p class="pf-success me-auto" x-data="{ show: true }" x-show="show" x-transition
                    x-init="setTimeout(() => show = false, 2000)">
                    Perubahan berhasil disimpan.
                </p>
            @endif
            <button type="reset" class="pf-btn-ghost">
                <i class="bi bi-arrow-counterclockwise me-1"></i>
                Reset
            </button>
            <button type="submit" class="pf-btn-primary">
                Simpan Perubahan
            </button>
        </div>
    </form>
</section>