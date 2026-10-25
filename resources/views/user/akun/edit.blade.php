@extends('layouts.user')

@section('title', 'Akun Saya')

@push('styles')
    <style>
        .akun-card {
            border-radius: 18px;
            border: 1px solid rgba(148, 163, 184, .12);
            background: rgba(30, 41, 59, .55);
            box-shadow: 0 12px 30px rgba(0, 0, 0, .25);
        }

        .akun-section-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: #fff;
            background: linear-gradient(135deg, #6366f1 0%, #22d3ee 100%);
            flex-shrink: 0;
        }

        .akun-section-icon.is-danger {
            background: linear-gradient(135deg, #dc2626 0%, #f87171 100%);
        }

        .akun-label {
            display: block;
            font-size: .85rem;
            font-weight: 600;
            color: #cbd5e1;
            margin-bottom: 6px;
        }

        .akun-input {
            height: 46px;
            border-radius: 12px;
            background: #0f172a;
            border: 1px solid #334155;
            color: #f8fafc;
        }

        .akun-input.has-toggle {
            padding-right: 48px;
        }

        .akun-input:focus {
            background: #0f172a;
            color: #f8fafc;
            border-color: #22d3ee;
            box-shadow: 0 0 0 .2rem rgba(34, 211, 238, .15);
        }

        .akun-input.is-invalid {
            border-color: #f87171;
            background-image: none !important;
        }

        .akun-password-wrap {
            position: relative;
        }

        .akun-toggle {
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

        .akun-toggle:hover {
            color: #e2e8f0;
        }

        .akun-field-input {
            width: 100%;
            border: none;
            background: transparent;
            color: #f8fafc;
            padding: 0;
            font-size: 15px;
        }

        .akun-field-input:focus {
            outline: none;
        }

        .akun-field-input.is-editing {
            border: 1px solid #334155;
            background: #0f172a;
            border-radius: 12px;
            padding: 10px 14px;
            margin-top: 6px;
        }

        .akun-error {
            color: #f87171;
            font-size: .85rem;
            margin-top: 6px;
        }

        .akun-alert {
            border-radius: 12px;
            padding: 12px 14px;
            font-size: .9rem;
            margin-bottom: 20px;
            background: rgba(34, 197, 94, .12);
            color: #86efac;
            border: 1px solid rgba(34, 197, 94, .25);
        }

        .akun-btn {
            border: none;
            border-radius: 12px;
            padding: 10px 20px;
            font-weight: 600;
            color: #fff;
            background: linear-gradient(135deg, #6366f1 0%, #22d3ee 100%);
            box-shadow: 0 8px 20px rgba(34, 211, 238, .18);
        }

        .akun-btn:hover {
            color: #fff;
            box-shadow: 0 12px 26px rgba(34, 211, 238, .28);
        }

        .akun-danger-link {
            color: #f87171;
        }
    </style>
@endpush

@section('content')

    <section class="section py-5">
        <div class="container">

            @if (session('status') === 'profile-updated')
                <div class="akun-alert">Profil berhasil diperbarui.</div>
            @endif

            @if (session('status') === 'password-updated')
                <div class="akun-alert">Password berhasil diperbarui.</div>
            @endif

            <div class="row gy-4">
                @include('user.akun.partials.sidebar', ['active' => 'profile'])

                {{-- Main Content --}}
                <div class="col-lg-9">

                    {{-- Card: Informasi Akun --}}
                    <div class="card akun-card p-4 mb-4">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <span class="akun-section-icon"><i class="bi bi-person-lines-fill"></i></span>
                            <div>
                                <h3 class="fw-bold mb-0 h5" style="color:#f8fafc;">Informasi Akun</h3>
                                <p class="mb-0" style="color:#94a3b8; font-size:.9rem;">Klik Edit untuk mengubah username atau email.</p>
                            </div>
                        </div>

                        <form action="{{ route('akun.update') }}" method="POST" enctype="multipart/form-data" autocomplete="off"
                            id="akun-form">
                            @csrf
                            @method('patch')

                            {{-- Avatar --}}
                            <div class="d-flex align-items-center gap-3 mb-4 pb-4 border-bottom" style="border-color:#334155 !important;">
                                <x-foto-profil :user="$user" size="80" />

                                <div>
                                    <p class="fw-semibold mb-2" style="color:#f8fafc;">Foto Profil</p>
                                    <label for="foto_profil" class="btn btn-outline-light btn-sm mb-0">
                                        <i class="bi bi-upload me-1"></i>
                                        Ganti Foto
                                    </label>
                                    <input type="file" name="foto_profil" id="foto_profil" class="d-none"
                                        accept="image/*" onchange="document.getElementById('akun-form').submit()">
                                </div>
                            </div>
                            @error('foto_profil')
                                <div class="akun-error mb-3">{{ $message }}</div>
                            @enderror

                            {{-- Field rows --}}
                            @php
                                $fields = [
                                    ['name' => 'username', 'label' => 'Username', 'value' => $user->username],
                                    ['name' => 'email', 'label' => 'Email', 'value' => $user->email],
                                ];
                            @endphp

                            @foreach ($fields as $field)
                                <div class="py-3 border-bottom" style="border-color:#334155 !important;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-semibold" style="color:#cbd5e1;">{{ $field['label'] }}</span>
                                        <button type="button" class="btn btn-link btn-sm p-0 akun-edit-btn text-info"
                                            data-target="field-{{ $field['name'] }}">
                                            Edit
                                        </button>
                                    </div>
                                    <input type="text" name="{{ $field['name'] }}" id="field-{{ $field['name'] }}"
                                        value="{{ old($field['name'], $field['value']) }}" class="akun-field-input" readonly>
                                    @error($field['name'])
                                        <div class="akun-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endforeach

                            <div class="mt-4 d-none" id="akun-save-wrapper">
                                <button type="submit" class="akun-btn">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Card: Password --}}
                    <div class="card akun-card p-4 mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-3">
                                <span class="akun-section-icon"><i class="bi bi-key"></i></span>
                                <div>
                                    <h3 class="fw-bold mb-0 h5" style="color:#f8fafc;">Password</h3>
                                    <p class="mb-0" style="color:#64748b; letter-spacing:2px;">&bull;&bull;&bull;&bull;&bull;&bull;</p>
                                </div>
                            </div>
                            <button type="button" class="btn btn-link btn-sm text-info"
                                onclick="toggleSection('password-form-wrapper', this)">
                                Edit
                            </button>
                        </div>

                        <div class="d-none mt-4" id="password-form-wrapper">
                            <form method="post" action="{{ route('password.update') }}" autocomplete="off">
                                @csrf
                                @method('put')

                                <div class="mb-3">
                                    <label for="update_password_current_password" class="akun-label">Password Saat Ini</label>
                                    <div class="akun-password-wrap">
                                        <input id="update_password_current_password" name="current_password" type="password"
                                            autocomplete="current-password"
                                            class="form-control akun-input has-toggle {{ $errors->updatePassword->has('current_password') ? 'is-invalid' : '' }}">
                                        <button type="button" class="akun-toggle toggle-password-btn"
                                            data-target="update_password_current_password" aria-label="Tampilkan password">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    @error('current_password', 'updatePassword')
                                        <div class="akun-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="update_password_password" class="akun-label">Password Baru</label>
                                    <div class="akun-password-wrap">
                                        <input id="update_password_password" name="password" type="password"
                                            autocomplete="new-password"
                                            class="form-control akun-input has-toggle {{ $errors->updatePassword->has('password') ? 'is-invalid' : '' }}">
                                        <button type="button" class="akun-toggle toggle-password-btn"
                                            data-target="update_password_password" aria-label="Tampilkan password">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    @error('password', 'updatePassword')
                                        <div class="akun-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="update_password_password_confirmation" class="akun-label">Konfirmasi Password Baru</label>
                                    <div class="akun-password-wrap">
                                        <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                                            autocomplete="new-password"
                                            class="form-control akun-input has-toggle {{ $errors->updatePassword->has('password_confirmation') ? 'is-invalid' : '' }}">
                                        <button type="button" class="akun-toggle toggle-password-btn"
                                            data-target="update_password_password_confirmation" aria-label="Tampilkan password">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    @error('password_confirmation', 'updatePassword')
                                        <div class="akun-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="akun-btn">
                                    Simpan Perubahan
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Card: Hapus Akun --}}
                    <div class="card akun-card p-4" style="border-color:rgba(248,113,113,.35) !important;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-3">
                                <span class="akun-section-icon is-danger"><i class="bi bi-exclamation-triangle"></i></span>
                                <div>
                                    <h3 class="fw-bold mb-0 h5 akun-danger-link">Hapus Akun</h3>
                                    <p class="mb-0" style="color:#94a3b8;">Tindakan ini tidak dapat dibatalkan.</p>
                                </div>
                            </div>
                            <button type="button" class="btn btn-link btn-sm akun-danger-link" data-bs-toggle="modal"
                                data-bs-target="#deleteAccountModal">
                                Hapus Akun
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- Modal Konfirmasi Hapus Akun --}}
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background:#1e293b; color:#f8fafc; border:1px solid rgba(148,163,184,.15); border-radius:18px;">
                <form method="post" action="{{ route('akun.destroy') }}" autocomplete="off">
                    @csrf
                    @method('delete')

                    <div class="modal-header" style="border-color:#334155;">
                        <h5 class="modal-title">Hapus Akun?</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p style="color:#94a3b8;">
                            Apakah kamu yakin ingin menghapus akun ini?
                            Semua data akan dihapus secara permanen.
                        </p>
                        <label for="delete_password" class="akun-label">Password</label>
                        <input id="delete_password" name="password" type="password" placeholder="Masukkan password untuk konfirmasi"
                            class="form-control akun-input {{ $errors->userDeletion->has('password') ? 'is-invalid' : '' }}">
                        @error('password', 'userDeletion')
                            <div class="akun-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="modal-footer" style="border-color:#334155;">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-danger">
                            Hapus Akun
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
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

        // Tombol Edit pada username/email
        document.querySelectorAll('.akun-edit-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var input = document.getElementById(this.dataset.target);
                input.readOnly = false;
                input.classList.add('is-editing');
                input.focus();
                document.getElementById('akun-save-wrapper').classList.remove('d-none');
            });
        });

        function toggleSection(id, btn) {
            var el = document.getElementById(id);
            el.classList.toggle('d-none');
            btn.textContent = el.classList.contains('d-none') ? 'Edit' : 'Batal';
        }

        // Buka lagi modal hapus akun kalau ada error (misalnya password salah)
        @if ($errors->userDeletion->isNotEmpty())
            new bootstrap.Modal(document.getElementById('deleteAccountModal')).show();
        @endif
    </script>
@endpush