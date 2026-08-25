<section x-data="{ editing: false }">

    {{-- Baris ringkas: Hapus Akun + tombol Edit/Batal (merah) --}}
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <div>
            <h3 style="margin:0; font-size:20px; font-weight:700; color:#f87171;">
                Hapus Akun
            </h3>
            <p class="profile-description" x-show="!editing">
                Tindakan ini tidak dapat dibatalkan.
            </p>
            <p class="profile-description" x-show="editing" x-cloak>
                Jika akun dihapus, seluruh data akun akan dihapus secara permanen.
                Tindakan ini tidak dapat dibatalkan.
            </p>
        </div>

        <button type="button" @click="editing = !editing"
            style="background:none; border:none; padding:0; cursor:pointer;
                color:#f87171; font-size:14px; font-weight:600;">
            <span x-show="!editing">Edit</span>
            <span x-show="editing" x-cloak>Batal</span>
        </button>
    </div>

    {{-- Tombol Hapus Akun + modal (muncul saat editing) --}}
    <div x-show="editing" x-cloak x-transition style="margin-top:20px;">
        <x-danger-button x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
            Hapus Akun
        </x-danger-button>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}"
            style="
                padding:30px;
                background:#1e293b;
                color:#f8fafc;
            ">
            @csrf
            @method('delete')

            <h2
                style="
                margin:0;
                font-size:20px;
                font-weight:700;
                color:#f8fafc;
            ">
                Hapus Akun?
            </h2>

            <p
                style="
                margin:8px 0 0;
                color:#94a3b8;
                font-size:14px;
                line-height:1.6;
            ">
                Apakah Anda yakin ingin menghapus akun ini?
                Semua data akun akan dihapus secara permanen.
            </p>

            <div style="margin-top:20px;">
                <x-input-label for="password" value="Password" style="color:#e2e8f0;" />
                <x-text-input id="password" name="password" type="password"
                    style="
                        width:100%;
                        margin-top:8px;
                        height:48px;
                        border-radius:10px;
                        background:#111827;
                        border:1px solid #374151;
                        color:#f8fafc;
                    "
                    placeholder="Masukkan password untuk konfirmasi" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div
                style="
                margin-top:25px;
                display:flex;
                justify-content:flex-end;
                gap:10px;
            ">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Batal
                </x-secondary-button>
                <x-danger-button>
                    Hapus Akun
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
