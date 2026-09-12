<section x-data="{ editing: false }">

    {{-- Baris ringkas: Password + titik-titik + tombol Edit/Batal --}}
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <div>
            <h3 class="profile-title">Password</h3>
            <p class="profile-description" x-show="!editing" style="letter-spacing:2px;">
                &bull;&bull;&bull;&bull;&bull;&bull;
            </p>
            <p class="profile-description" x-show="editing" x-cloak>
                Pastikan akun Anda menggunakan password yang kuat.
            </p>
        </div>

        <button type="button" @click="editing = !editing"
            style="background:none; border:none; padding:0; cursor:pointer;
                color:#60a5fa; font-size:14px; font-weight:600;">
            <span x-show="!editing">Edit</span>
            <span x-show="editing" x-cloak>Batal</span>
        </button>
    </div>

    {{-- Form (muncul saat editing) --}}
    <div x-show="editing" x-cloak x-transition style="margin-top:20px;">
        <form method="post" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            {{-- Password Saat Ini --}}
            <div style="margin-bottom:14px;">
                <div style="position:relative;">
                    <x-text-input id="update_password_current_password" name="current_password" type="password"
                        style="
                width:100%;
                height:42px;
                border-radius:10px;
                background:#111827;
                border:1px solid #374151;
                color:#f8fafc;
                font-size:13px;
                padding-right:45px;
            "
                        placeholder="Password Saat Ini" autocomplete="current-password" />
                    <button type="button" class="toggle-password-btn" data-target="update_password_current_password"
                        style="position:absolute; top:50%; right:12px; transform:translateY(-50%);
                background:none; border:none; padding:0; color:#94a3b8; cursor:pointer;">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>

                <x-input-error class="mt-2" :messages="$errors->updatePassword->get('current_password')" />
            </div>

            <div style="margin-bottom:14px;">
                <div style="position:relative;">
                    <x-text-input id="update_password_password" name="password" type="password"
                        style="
                width:100%;
                height:42px;
                border-radius:10px;
                background:#111827;
                border:1px solid #374151;
                color:#f8fafc;
                font-size:13px;
                padding-right:45px;
            "
                        placeholder="Password Baru" autocomplete="new-password" />
                    <button type="button" class="toggle-password-btn" data-target="update_password_password"
                        style="position:absolute; top:50%; right:12px; transform:translateY(-50%);
                background:none; border:none; padding:0; color:#94a3b8; cursor:pointer;">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>

                <x-input-error class="mt-2" :messages="$errors->updatePassword->get('password')" />
            </div>

            <div style="margin-bottom:14px;">
                <div style="position:relative;">
                    <x-text-input id="update_password_password_confirmation" name="password_confirmation"
                        type="password"
                        style="
                width:100%;
                height:42px;
                border-radius:10px;
                background:#111827;
                border:1px solid #374151;
                color:#f8fafc;
                font-size:13px;
                padding-right:45px;
            "
                        placeholder="Konfirmasi Password Baru" autocomplete="new-password" />
                    <button type="button" class="toggle-password-btn"
                        data-target="update_password_password_confirmation"
                        style="position:absolute; top:50%; right:12px; transform:translateY(-50%);
                background:none; border:none; padding:0; color:#94a3b8; cursor:pointer;">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>

                <x-input-error class="mt-2" :messages="$errors->updatePassword->get('password_confirmation')" />
            </div>

            {{-- Tombol --}}
            <div
                style="
                display:flex;
                align-items:center;
                gap:15px;
            ">
                <x-primary-button>
                    Simpan Perubahan
                </x-primary-button>

                @if (session('status') === 'password-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        style="
                            margin:0;
                            color:#22c55e;
                            font-size:14px;
                        ">
                        Password berhasil diperbarui.
                    </p>
                @endif
            </div>
        </form>
    </div>
</section>

<script>
    document.querySelectorAll('.toggle-password-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var input = document.getElementById(this.dataset.target);
            var icon = btn.querySelector('i');
            var isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            icon.classList.toggle('bi-eye', !isPassword);
            icon.classList.toggle('bi-eye-slash', isPassword);
        });
    });
</script>
