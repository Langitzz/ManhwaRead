<section>
    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        {{-- Password Saat Ini --}}
        <div style="margin-bottom:20px;">
            <x-input-label for="update_password_current_password" value="Password Saat Ini" style="color:#e2e8f0;" />

            <x-text-input id="update_password_current_password" name="current_password" type="password"
                style="
                    width:100%;
                    margin-top:8px;
                    height:48px;
                    border-radius:10px;
                    background:#111827;
                    border:1px solid #374151;
                    color:#f8fafc;
                "
                autocomplete="current-password" />

            <x-input-error class="mt-2" :messages="$errors->updatePassword->get('current_password')" />
        </div>

        {{-- Password Baru --}}
        <div style="margin-bottom:20px;">
            <x-input-label for="update_password_password" value="Password Baru" style="color:#e2e8f0;" />

            <x-text-input id="update_password_password" name="password" type="password"
                style="
                    width:100%;
                    margin-top:8px;
                    height:48px;
                    border-radius:10px;
                    background:#111827;
                    border:1px solid #374151;
                    color:#f8fafc;
                "
                autocomplete="new-password" />

            <x-input-error class="mt-2" :messages="$errors->updatePassword->get('password')" />
        </div>

        {{-- Konfirmasi Password --}}
        <div style="margin-bottom:20px;">
            <x-input-label for="update_password_password_confirmation" value="Konfirmasi Password Baru"
                style="color:#e2e8f0;" />

            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
                style="
                    width:100%;
                    margin-top:8px;
                    height:48px;
                    border-radius:10px;
                    background:#111827;
                    border:1px solid #374151;
                    color:#f8fafc;
                "
                autocomplete="new-password" />

            <x-input-error class="mt-2" :messages="$errors->updatePassword->get('password_confirmation')" />
        </div>

        {{-- Tombol --}}
        <div style="
            display:flex;
            align-items:center;
            gap:15px;
        ">
            <x-primary-button>
                Ubah Password
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
</section>
