<section x-data="{ editing: {{ $errors->updatePassword->isNotEmpty() ? 'true' : 'false' }} }">
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
            padding: 0 48px 0 14px;
            font-size: .95rem;
            transition: border-color .15s, box-shadow .15s;
        }

        .pf-input:focus {
            outline: none;
            border-color: #22d3ee;
            box-shadow: 0 0 0 .2rem rgba(34, 211, 238, .15);
        }

        .pf-input.is-invalid {
            border-color: #f87171;
            background-image: none !important;
        }

        .pf-password-wrap {
            position: relative;
        }

        .pf-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            padding: 0;
            color: #94a3b8;
            line-height: 1;
            z-index: 2;
        }

        .pf-toggle:hover {
            color: #e2e8f0;
        }

        .pf-error {
            color: #f87171;
            font-size: .85rem;
            margin-top: 6px;
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

        .pf-success {
            color: #86efac;
            font-size: .9rem;
            margin: 0;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>

    {{-- Baris ringkas: judul + titik-titik + tombol Edit/Batal --}}
    <div class="d-flex justify-content-between align-items-start">
        <div>
            <h3 class="fw-bold mb-1 h5" style="color:#f8fafc;">Password</h3>
            <p class="mb-0" x-show="!editing" style="color:#64748b; letter-spacing:2px;">
                &bull;&bull;&bull;&bull;&bull;&bull;
            </p>
            <p class="mb-0" x-show="editing" x-cloak style="color:#94a3b8; font-size:.9rem;">
                Pastikan akun kamu menggunakan password yang kuat.
            </p>
        </div>

        <button type="button" class="pf-link-btn" @click="editing = !editing">
            <span x-show="!editing">Edit</span>
            <span x-show="editing" x-cloak>Batal</span>
        </button>
    </div>

    {{-- Form (muncul saat editing) --}}
    <div x-show="editing" x-cloak x-transition class="mt-4">
        <form method="post" action="{{ route('password.update') }}" autocomplete="off">
            @csrf
            @method('put')

            {{-- Password saat ini --}}
            <div class="mb-3">
                <label for="update_password_current_password" class="pf-label">Password Saat Ini</label>
                <div class="pf-password-wrap">
                    <input id="update_password_current_password" name="current_password" type="password"
                        autocomplete="current-password"
                        class="pf-input {{ $errors->updatePassword->has('current_password') ? 'is-invalid' : '' }}">
                    <button type="button" class="pf-toggle toggle-password-btn"
                        data-target="update_password_current_password" aria-label="Tampilkan password">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                @error('current_password', 'updatePassword')
                    <div class="pf-error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password baru --}}
            <div class="mb-3">
                <label for="update_password_password" class="pf-label">Password Baru</label>
                <div class="pf-password-wrap">
                    <input id="update_password_password" name="password" type="password"
                        autocomplete="new-password"
                        class="pf-input {{ $errors->updatePassword->has('password') ? 'is-invalid' : '' }}">
                    <button type="button" class="pf-toggle toggle-password-btn"
                        data-target="update_password_password" aria-label="Tampilkan password">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                @error('password', 'updatePassword')
                    <div class="pf-error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Konfirmasi password baru --}}
            <div class="mb-4">
                <label for="update_password_password_confirmation" class="pf-label">Konfirmasi Password Baru</label>
                <div class="pf-password-wrap">
                    <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                        autocomplete="new-password"
                        class="pf-input {{ $errors->updatePassword->has('password_confirmation') ? 'is-invalid' : '' }}">
                    <button type="button" class="pf-toggle toggle-password-btn"
                        data-target="update_password_password_confirmation" aria-label="Tampilkan password">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                @error('password_confirmation', 'updatePassword')
                    <div class="pf-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex align-items-center gap-3 flex-wrap">
                <button type="submit" class="pf-btn-primary">
                    Simpan Perubahan
                </button>

                @if (session('status') === 'password-updated')
                    <p class="pf-success" x-data="{ show: true }" x-show="show" x-transition
                        x-init="setTimeout(() => show = false, 2000)">
                        Password berhasil diperbarui.
                    </p>
                @endif
            </div>
        </form>
    </div>

    <script>
        // Lihat/sembunyikan password
        document.querySelectorAll('.toggle-password-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var input = document.getElementById(this.dataset.target);
                var icon = this.querySelector('i');
                var isPassword = input.type === 'password';

                input.type = isPassword ? 'text' : 'password';
                icon.classList.toggle('bi-eye', !isPassword);
                icon.classList.toggle('bi-eye-slash', isPassword);
            });
        });
    </script>
</section>