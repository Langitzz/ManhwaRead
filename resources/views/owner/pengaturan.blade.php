@extends('layouts.owner')

@section('title', 'Pengaturan Situs')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <h3 class="mb-0" style="color:#d97706;">Pengaturan Situs</h3>
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
                <div class="card-header" style="background:#fef3c7; color:#78350f;">
                    <strong><i class="bi bi-gear me-2"></i>Pengaturan Situs</strong>
                </div>

                <form action="{{ route('pengaturan.update.owner') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
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
                                        style="height:60px;">
                                </div>
                            @endif
                            <input type="file" name="logo" id="logo" class="form-control">
                            <x-input-error :messages="$errors->get('logo')" class="mt-1" />
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $siteSetting->deskripsi) }}</textarea>
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
                        <button type="submit" class="btn" style="background:#d97706; color:#1f2937; font-weight:600;">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection