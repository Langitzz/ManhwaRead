<section x-data="{ editing: {{ $errors->userDeletion->isNotEmpty() ? 'true' : 'false' }} }">
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
            border-color: #f87171;
            box-shadow: 0 0 0 .2rem rgba(248, 113, 113, .15);
        }

        .pf-input.is-invalid {
            border-color: #f87171;
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

        .pf-danger-title {
            color: #f87171;
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

        .pf-btn-danger {
            height: 44px;
            padding: 0 22px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            color: #fff;
            background: linear-gradient(135deg, #dc2626 0%, #f87171 100%);
            box-shadow: 0 8px 20px rgba(248, 113, 113, .2);
        }

        .pf-btn-danger:hover {
            color: #fff;
            box-shadow: 0 12px 26px rgba(248, 113, 113, .3);
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

        .pf-modal {
            background: #1e293b;
            color: #f8fafc;
            border: 1px solid rgba(148, 163, 184, .15);
            border-radius: 18px;
        }

        .pf-modal-section {
            border-color: #334155 !important;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>

    {{-- Baris ringkas: judul + tombol Edit/Batal --}}
    <div class="d-flex justify-content-between align-items-start">
        <div>
            <h3 class="fw-bold mb-1 h5 pf-danger-title">Hapus Akun</h3>
            <p class="mb-0" x-show="!editing" style="color:#94a3b8;">
                Tindakan ini tidak dapat dibatalkan.
            </p>
            <p class="mb-0" x-show="editing" x-cloak style="color:#94a3b8;">
                Jika akun dihapus, seluruh data akun akan dihapus secara permanen.
                Tindakan ini tidak dapat dibatalkan.
            </p>
        </div>

        <button type="button" class="pf-link-btn" @click="editing = !editing">
            <span x-show="!editing">Edit</span>
            <span x-show="editing" x-cloak>Batal</span>
        </button>
    </div>

    {{-- Tombol hapus (muncul saat Edit) --}}
    <div x-show="editing" x-cloak x-transition class="mt-4">
        <button type="button" class="pf-btn-danger" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
            <i class="bi bi-trash3 me-1"></i>
            Hapus Akun
        </button>
    </div>

    {{-- Modal konfirmasi --}}
    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content pf-modal">
                <form method="post" action="{{ route('profile.destroy') }}" autocomplete="off">
                    @csrf
                    @method('delete')

                    <div class="modal-header pf-modal-section">
                        <h5 class="modal-title">Hapus Akun?</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>

                    <div class="modal-body">
                        <p style="color:#94a3b8; line-height:1.6;">
                            Apakah kamu yakin ingin menghapus akun ini?
                            Semua data akun akan dihapus secara permanen.
                        </p>

                        <label for="delete_password" class="pf-label">Password</label>
                        <div class="pf-password-wrap">
                            <input id="delete_password" name="password" type="password"
                                autocomplete="current-password" placeholder="Masukkan password untuk konfirmasi"
                                class="pf-input {{ $errors->userDeletion->has('password') ? 'is-invalid' : '' }}">
                            <button type="button" class="pf-toggle" id="toggle-delete-password"
                                aria-label="Tampilkan password">
                                <i class="bi bi-eye" id="toggle-delete-password-icon"></i>
                            </button>
                        </div>
                        @error('password', 'userDeletion')
                            <div class="pf-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="modal-footer pf-modal-section">
                        <button type="button" class="pf-btn-ghost" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="pf-btn-danger">Hapus Akun</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Lihat/sembunyikan password di modal
        document.getElementById('toggle-delete-password')?.addEventListener('click', function() {
            const input = document.getElementById('delete_password');
            const icon = document.getElementById('toggle-delete-password-icon');
            const isPassword = input.type === 'password';

            input.type = isPassword ? 'text' : 'password';
            icon.classList.toggle('bi-eye', !isPassword);
            icon.classList.toggle('bi-eye-slash', isPassword);
        });

        // Buka lagi modal kalau ada error (misalnya password salah).
        // Pakai event load karena Bootstrap dimuat di bagian bawah layout.
        window.addEventListener('load', function() {
            @if ($errors->userDeletion->isNotEmpty())
                new bootstrap.Modal(document.getElementById('confirmUserDeletionModal')).show();
            @endif
        });
    </script>
</section>