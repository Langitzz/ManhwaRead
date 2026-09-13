@extends('layouts.admin')

@section('title', 'Pengaturan Situs')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0">Pengaturan Situs</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Pengaturan Situs
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            @if (session('status') === 'pengaturan-updated')
                <div class="alert alert-success">
                    Pengaturan situs berhasil diperbarui.
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="bi bi-gear me-2"></i>
                        Pengaturan Situs
                    </h3>
                </div>

                <form action="{{ route('pengaturan.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    <div class="card-body">
                        <div class="mb-3">
                            <label for="nama_situs" class="form-label">Nama Situs</label>
                            <input type="text" name="nama_situs" id="nama_situs" class="form-control"
                                value="{{ old('nama_situs', $siteSetting->nama_situs) }}">
                            <x-input-error :messages="$errors->get('nama_situs')" class="mt-1" />
                        </div>

                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo</label>

                            @if ($siteSetting->logo)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $siteSetting->logo) }}" alt="Logo"
                                        style="max-height: 60px;">
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="hapus_logo" id="hapus_logo"
                                        value="1">
                                    <label class="form-check-label" for="hapus_logo">
                                        Hapus logo saat ini
                                    </label>
                                </div>
                            @endif

                            <input type="file" name="logo" id="logo" class="form-control" accept="image/*">
                            <x-input-error :messages="$errors->get('logo')" class="mt-1" />
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control">{{ old('deskripsi', $siteSetting->deskripsi) }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-1" />
                        </div>

                        <div class="mb-3">
                            <label for="email_kontak" class="form-label">Email Kontak</label>
                            <input type="email" name="email_kontak" id="email_kontak" class="form-control"
                                value="{{ old('email_kontak', $siteSetting->email_kontak) }}">
                            <x-input-error :messages="$errors->get('email_kontak')" class="mt-1" />
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
