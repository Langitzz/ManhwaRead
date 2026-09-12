@extends('layouts.user')

@section('title', 'Akun Saya')

@push('styles')
    <style>
        .akun-field-input {
            width: 100%;
            border: none;
            background: transparent;
            color: var(--default-color);
            padding: 0;
            font-size: 15px;
        }

        .akun-field-input:focus {
            outline: none;
        }

        .akun-field-input.is-editing {
            border: 1px solid #374151;
            background: #111827;
            border-radius: 8px;
            padding: 8px 12px;
            margin-top: 6px;
        }
    </style>
@endpush

@section('content')

    <section class="section py-5">
        <div class="container">

            @if (session('status') === 'profile-updated')
                <div class="alert alert-success">
                    Profil berhasil diperbarui.
                </div>
            @endif

            @if (session('status') === 'password-updated')
                <div class="alert alert-success">
                    Password berhasil diperbarui.
                </div>
            @endif

            <div class="row gy-4">
                {{-- Sidebar --}}
                <div class="col-lg-3">
                    <div class="card">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('akun.edit') }}"
                                class="list-group-item list-group-item-action active d-flex justify-content-between align-items-center">
                                <span>
                                    <i class="bi bi-person-circle me-2"></i>
                                    Profile
                                </span>
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Main Content --}}
                <div class="col-lg-9">

                    {{-- Card: Informasi Akun --}}
                    <div class="card p-4 mb-4">
                        <form action="{{ route('akun.update') }}" method="POST" enctype="multipart/form-data"
                            id="akun-form">
                            @csrf
                            @method('patch')

                            {{-- Avatar --}}
                            <div class="d-flex align-items-center gap-3 mb-4 pb-4 border-bottom">
                                <x-foto-profil :user="$user" size="80" />

                                <div>
                                    <label for="foto_profil" class="btn btn-outline-light btn-sm mb-0">
                                        <i class="bi bi-upload me-1"></i>
                                        Upload Photo
                                    </label>
                                    <input type="file" name="foto_profil" id="foto_profil" class="d-none"
                                        accept="image/*" onchange="document.getElementById('akun-form').submit()">
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('foto_profil')" class="mb-3" />

                            {{-- Field rows --}}
                            @php
                                $fields = [
                                    ['name' => 'username', 'label' => 'Username', 'value' => $user->username],
                                    ['name' => 'email', 'label' => 'Email', 'value' => $user->email],
                                ];
                            @endphp

                            @foreach ($fields as $field)
                                <div class="py-3 border-bottom">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label class="fw-bold mb-0">{{ $field['label'] }}</label>
                                        <button type="button" class="btn btn-link btn-sm p-0 akun-edit-btn"
                                            data-target="field-{{ $field['name'] }}">
                                            Edit
                                        </button>
                                    </div>
                                    <input type="text" name="{{ $field['name'] }}" id="field-{{ $field['name'] }}"
                                        value="{{ old($field['name'], $field['value']) }}" class="akun-field-input"
                                        readonly>
                                    <x-input-error :messages="$errors->get($field['name'])" class="mt-1" />
                                </div>
                            @endforeach

                            <div class="mt-4 d-none" id="akun-save-wrapper">
                                <button type="submit" class="btn btn-primary">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Card: Password --}}
                    <div class="card p-4 mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="fw-bold mb-1">Password</h3>
                                <p class="text-secondary mb-0" style="letter-spacing:2px;">
                                    &bull;&bull;&bull;&bull;&bull;&bull;
                                </p>
                            </div>
                            <button type="button" class="btn btn-link btn-sm"
                                onclick="toggleSection('password-form-wrapper', this)">
                                Edit
                            </button>
                        </div>

                        <div class="d-none mt-3" id="password-form-wrapper">
                            <form method="post" action="{{ route('password.update') }}">
                                @csrf
                                @method('put')

                                <div class="mb-3">
                                    <x-input-label for="update_password_current_password" value="Password Saat Ini" />
                                    <div class="position-relative mt-1">
                                        <input id="update_password_current_password" name="current_password" type="password"
                                            class="form-control" autocomplete="current-password"
                                            style="padding-right:45px;">
                                        <button type="button"
                                            class="toggle-password-btn position-absolute top-50 end-0 translate-middle-y me-2 p-0 border-0"
                                            data-target="update_password_current_password"
                                            style="background:none; color:#94a3b8; width:30px; height:30px;">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    <x-input-error class="mt-2" :messages="$errors->updatePassword->get('current_password')" />
                                </div>

                                <div class="mb-3">
                                    <x-input-label for="update_password_password" value="Password Baru" />
                                    <div class="position-relative mt-1">
                                        <input id="update_password_password" name="password" type="password"
                                            class="form-control" autocomplete="new-password" style="padding-right:45px;">
                                        <button type="button"
                                            class="toggle-password-btn position-absolute top-50 end-0 translate-middle-y me-2 p-0 border-0"
                                            data-target="update_password_password"
                                            style="background:none; color:#94a3b8; width:30px; height:30px;">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    <x-input-error class="mt-2" :messages="$errors->updatePassword->get('password')" />
                                </div>

                                <div class="mb-3">
                                    <x-input-label for="update_password_password_confirmation"
                                        value="Konfirmasi Password Baru" />
                                    <div class="position-relative mt-1">
                                        <input id="update_password_password_confirmation" name="password_confirmation"
                                            type="password" class="form-control" autocomplete="new-password"
                                            style="padding-right:45px;">
                                        <button type="button"
                                            class="toggle-password-btn position-absolute top-50 end-0 translate-middle-y me-2 p-0 border-0"
                                            data-target="update_password_password_confirmation"
                                            style="background:none; color:#94a3b8; width:30px; height:30px;">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    <x-input-error class="mt-2" :messages="$errors->updatePassword->get('password_confirmation')" />
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    Simpan Perubahan
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Card: Hapus Akun --}}
                    <div class="card p-4 border-danger">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="fw-bold text-danger mb-1">Hapus Akun</h3>
                                <p class="text-secondary mb-0">
                                    Tindakan ini tidak dapat dibatalkan.
                                </p>
                            </div>
                            <button type="button" class="btn btn-link btn-sm text-danger" data-bs-toggle="modal"
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
            <div class="modal-content">
                <form method="post" action="{{ route('akun.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Akun?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>
                            Apakah kamu yakin ingin menghapus akun ini?
                            Semua data akan dihapus secara permanen.
                        </p>
                        <x-input-label for="delete_password" value="Password" />
                        <x-text-input id="delete_password" name="password" type="password" class="form-control mt-1"
                            placeholder="Masukkan password untuk konfirmasi" />
                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                    </div>
                    <div class="modal-footer">
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
    </script>
@endpush
