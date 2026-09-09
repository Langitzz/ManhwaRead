@extends('layouts.admin')

@section('title', 'Profil Saya')

@section('content')

    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0">Profil Saya</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">Pengaturan</li>
                        <li class="breadcrumb-item active">Profil</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <style>
        .profile-card {
            background: #1f2937;
            border: 1px solid #374151;
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 24px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .25);
            height: 100%;
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

        .profile-photo {
            width: 110px;
            height: 110px;
            margin: 0 auto 16px;
            border-radius: 50%;
            object-fit: cover;
            display: block;
            border: 4px solid #374151;
        }

        .profile-name {
            margin: 0;
            font-size: 19px;
            font-weight: 700;
            color: #f8fafc;
        }

        .profile-role {
            margin: 4px 0 12px;
            color: #94a3b8;
            font-size: 14px;
        }

        .profile-info-list {
            border-top: 1px solid #374151;
            margin-top: 18px;
            padding-top: 18px;
            text-align: left;
        }

        .profile-info-list dt {
            color: #94a3b8;
            font-size: 13px;
            font-weight: 500;
        }

        .profile-info-list dd {
            color: #f8fafc;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .profile-card label {
            color: #e5e7eb !important;
        }

        .profile-card input,
        .profile-card textarea {
            background: #111827 !important;
            color: #f8fafc !important;
            border-color: #4b5563 !important;
        }

        .profile-card input:focus,
        .profile-card textarea:focus {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, .2);
        }

        [x-cloak] {
            display: none !important;
        }
    </style>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                {{-- Kolom Kiri: Foto & Ringkasan --}}
                <div class="col-lg-4">
                    <div class="profile-card text-center">
                        <x-foto-profil :user="Auth::user()" size="120" />
                        <h3 class="profile-name">{{ Auth::user()->name }}</h3>
                        <p class="profile-role">
                            {{ Auth::user()->userRole->nama_peran ?? '-' }}
                        </p>

                        @if (Auth::user()->status)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-secondary">Nonaktif</span>
                        @endif

                        <dl class="profile-info-list">
                            <dt>Email</dt>
                            <dd>{{ Auth::user()->email }}</dd>
                            <dt>Role</dt>
                            <dd>{{ Auth::user()->userRole->nama_peran ?? '-' }}</dd>
                            <dt>Bergabung</dt>
                            <dd>{{ Auth::user()->created_at->translatedFormat('F Y') }}</dd>
                        </dl>
                    </div>
                </div>

                {{-- Kolom Kanan: Form (1 kartu, 3 bagian) --}}
                <div class="col-lg-8">
                    <div class="profile-card">
                        {{-- Bagian: Informasi Profil --}}
                        <div style="margin-bottom:25px;">
                            <h3 class="profile-title">Informasi Profil</h3>
                            <p class="profile-description">
                                Perbarui nama, email, nomor telepon, dan alamat Anda.
                            </p>
                        </div>
                        @include('profile.partials.update-profile-information-form')
                        <hr style="border-color:#374151; margin:28px 0;">
                        {{-- Bagian: Ubah Password --}}
                        @include('profile.partials.update-password-form')
                        <hr style="border-color:#374151; margin:28px 0;">
                        {{-- Bagian: Hapus Akun --}}
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
