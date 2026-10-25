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
            background: rgba(30, 41, 59, .72);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(148, 163, 184, .12);
            border-radius: 18px;
            padding: 30px;
            margin-bottom: 24px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, .25);
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

        .profile-avatar-ring {
            width: 128px;
            height: 128px;
            margin: 0 auto 16px;
            padding: 4px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1 0%, #22d3ee 100%);
            box-shadow: 0 10px 25px rgba(99, 102, 241, .3);
        }

        .profile-avatar-ring>* {
            display: block;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 3px solid #1e293b;
            object-fit: cover;
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
            border-top: 1px solid #334155;
            margin-top: 18px;
            padding-top: 18px;
            text-align: left;
        }

        .profile-info-list dt {
            color: #64748b;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .profile-info-list dd {
            color: #f8fafc;
            font-size: 14px;
            margin-bottom: 14px;
        }

        .profile-divider {
            border: 0;
            border-top: 1px solid #334155;
            margin: 28px 0;
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
                        <div class="profile-avatar-ring">
                            <x-foto-profil :user="Auth::user()" size="120" />
                        </div>

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

                        <hr class="profile-divider">

                        {{-- Bagian: Ubah Password --}}
                        @include('profile.partials.update-password-form')

                        <hr class="profile-divider">

                        {{-- Bagian: Hapus Akun --}}
                        @include('profile.partials.delete-user-form')

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
