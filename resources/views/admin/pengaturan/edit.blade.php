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
                <div class="alert alert-success d-flex align-items-center">
                    <i class="bi bi-check-circle me-2"></i>
                    Pengaturan situs berhasil diperbarui.
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="bi bi-gear me-2"></i>
                        Identitas Situs
                    </h3>
                </div>

                <form action="{{ route('pengaturan.update') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('patch')

                    <div class="card-body">
                        {{-- Nama Situs --}}
                        <div class="mb-4">
                            <label for="nama_situs" class="form-label fw-semibold">Nama Situs</label>
                            <input type="text" name="nama_situs" id="nama_situs"
                                class="form-control {{ $errors->has('nama_situs') ? 'is-invalid' : '' }}"
                                value="{{ old('nama_situs', $siteSetting->nama_situs) }}">
                            @error('nama_situs')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Logo --}}
                        <div class="mb-4">
                            <label for="logo" class="form-label fw-semibold">Logo</label>

                            <div class="d-flex align-items-center gap-3 mb-2">
                                @if ($siteSetting->logo)
                                    <img src="{{ asset('storage/' . $siteSetting->logo) }}" alt="Logo saat ini"
                                        class="rounded border" style="max-height: 60px; max-width: 160px; object-fit: contain; padding: 6px;">
                                @else
                                    <div class="rounded border d-flex align-items-center justify-content-center"
                                        style="width: 120px; height: 60px; background: linear-gradient(135deg, #312e81 0%, #0f172a 100%); color: #818cf8;">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif

                                <img id="logo-preview" alt="Preview logo baru" class="rounded border d-none"
                                    style="max-height: 60px; max-width: 160px; object-fit: contain; padding: 6px;">
                            </div>

                            @if ($siteSetting->logo)
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="hapus_logo" id="hapus_logo" value="1">
                                    <label class="form-check-label" for="hapus_logo">
                                        Hapus logo saat ini
                                    </label>
                                </div>
                            @endif

                            <input type="file" name="logo" id="logo" accept="image/*"
                                class="form-control {{ $errors->has('logo') ? 'is-invalid' : '' }}">
                            <div class="form-text">Format gambar, misalnya PNG atau JPG.</div>
                            @error('logo')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-4">
                            <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="3"
                                class="form-control {{ $errors->has('deskripsi') ? 'is-invalid' : '' }}">{{ old('deskripsi', $siteSetting->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email Kontak --}}
                        <div class="mb-2">
                            <label for="email_kontak" class="form-label fw-semibold">Email Kontak</label>
                            <input type="email" name="email_kontak" id="email_kontak"
                                class="form-control {{ $errors->has('email_kontak') ? 'is-invalid' : '' }}"
                                value="{{ old('email_kontak', $siteSetting->email_kontak) }}">
                            @error('email_kontak')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Preview logo baru sebelum disimpan
        document.getElementById('logo').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('logo-preview');

            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('d-none');
            } else {
                preview.src = '';
                preview.classList.add('d-none');
            }
        });
    </script>
@endsection