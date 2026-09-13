@extends('layouts.admin')

@section('title', 'Edit Banner')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0">Edit Banner</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('banner.index') }}">Banner</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Edit
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <form action="{{ route('banner.update', $banner) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-pencil-square me-2"></i>
                            Form Edit Banner
                        </h3>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="judul" class="form-label">
                                    Judul
                                </label>
                                <input type="text" name="judul" id="judul"
                                    class="form-control @error('judul') is-invalid @enderror"
                                    value="{{ old('judul', $banner->judul) }}" autocomplete="off">
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="urutan" class="form-label">
                                    Urutan Tampil
                                </label>
                                <input type="number" name="urutan" id="urutan" min="0"
                                    class="form-control @error('urutan') is-invalid @enderror"
                                    value="{{ old('urutan', $banner->urutan) }}">
                                @error('urutan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="status" class="form-label d-block">
                                    Status
                                </label>
                                <div class="form-check form-switch">
                                    <input type="hidden" name="status" value="0">
                                    <input type="checkbox" name="status" id="status" class="form-check-input"
                                        value="1" {{ old('status', $banner->status) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status">
                                        Aktif
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-8">
                                <label for="link_url" class="form-label">
                                    Link Tujuan (opsional)
                                </label>
                                <input type="text" name="link_url" id="link_url"
                                    class="form-control @error('link_url') is-invalid @enderror"
                                    value="{{ old('link_url', $banner->link_url) }}" placeholder="https://...">
                                @error('link_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="gambar" class="form-label">
                                    Gambar Banner
                                </label>

                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $banner->gambar) }}" alt="{{ $banner->judul }}"
                                        style="max-height: 80px;" class="rounded">
                                </div>

                                <input type="file" name="gambar" id="gambar" accept="image/*"
                                    class="form-control @error('gambar') is-invalid @enderror">
                                <small class="text-muted">
                                    Biarkan kosong kalau tidak ingin mengganti gambar.
                                </small>
                                @error('gambar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end gap-2">
                        <a href="{{ route('banner.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i>
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i>
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
