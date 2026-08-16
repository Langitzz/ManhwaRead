<x-app-layout>
    <x-slot name="header">
        <div style="
        background:#111827;
        margin:-24px -24px;
        padding:24px;
    ">
            <h2
                style="
            font-size:24px;
            font-weight:700;
            color:#f8fafc;
            margin:0;
        ">
                Profil Saya
            </h2>
            <p style="
            margin:5px 0 0;
            color:#94a3b8;
            font-size:14px;
        ">
                Kelola informasi akun dan keamanan akun Anda.
            </p>
        </div>
    </x-slot>

    <style>
        .profile-page {
            background: #111827;
            min-height: calc(100vh - 65px);
            padding: 40px 20px;
        }

        .profile-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .profile-card {
            background: #1f2937;
            border: 1px solid #374151;
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 24px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .25);
        }

        .profile-title {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            color: #f8fafc;
        }

        .profile-description {
            margin: 6px 0 0;
            color: #94a3b8;
            font-size: 14px;
        }

        .profile-info {
            text-align: center;
        }

        .profile-photo {
            width: 120px;
            height: 120px;
            margin: 0 auto 18px;
            border-radius: 50%;
            object-fit: cover;
            display: block;
            border: 4px solid #374151;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .35);
        }

        .profile-name {
            margin: 0;
            font-size: 21px;
            font-weight: 700;
            color: #f8fafc;
        }

        .profile-email {
            margin: 6px 0 0;
            color: #94a3b8;
            font-size: 14px;
        }

        /* Form Breeze */
        .profile-card label {
            color: #e5e7eb !important;
        }

        .profile-card input {
            background: #111827 !important;
            color: #f8fafc !important;
            border-color: #4b5563 !important;
        }

        .profile-card input:focus {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, .2);
        }

        .profile-card button {
            border-radius: 8px;
        }
    </style>
    <div class="profile-page">
        <div class="profile-container">

            {{-- Foto & Identitas --}}
            <div class="profile-card profile-info">
                <img src="{{ asset('images/admin/mbg.jpeg') }}" alt="Foto Profil" class="profile-photo">
                <h3 class="profile-name">
                    {{ Auth::user()->name }}
                </h3>
                <p class="profile-email">
                    {{ Auth::user()->email }}
                </p>
            </div>

            {{-- Informasi Profil --}}
            <div class="profile-card">
                <div style="margin-bottom:25px;">
                    <h3 class="profile-title">
                        Informasi Profil
                    </h3>
                    <p class="profile-description">
                        Perbarui nama dan alamat email akun Anda.
                    </p>
                </div>
                @include('profile.partials.update-profile-information-form')
            </div>

            {{-- Password --}}
            <div class="profile-card">
                <div style="margin-bottom:25px;">
                    <h3 class="profile-title">
                        Ubah Password
                    </h3>
                    <p class="profile-description">
                        Pastikan akun Anda menggunakan password yang kuat.
                    </p>
                </div>
                @include('profile.partials.update-password-form')
            </div>

            {{-- Hapus Akun --}}
            <div class="profile-card">
                <div style="margin-bottom:25px;">
                    <h3
                        style="
                        margin:0;
                        font-size:20px;
                        font-weight:700;
                        color:#f87171;
                    ">
                        Hapus Akun
                    </h3>
                    <p class="profile-description">
                        Hapus akun Anda secara permanen beserta seluruh datanya.
                    </p>
                </div>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
