@extends('layouts.admin')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0">Tambah Manhwa</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('manhwa.index') }}">Manhwa</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Tambah
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            <form action="{{ route('manhwa.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-plus-circle me-2"></i>
                            Form Tambah Manhwa
                        </h3>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Judul Manhwa</label>
                                <input type="text" name="judul" id="judul"
                                    class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}"
                                    placeholder="Masukkan judul manhwa" autocomplete="off">
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Judul Alternatif</label>
                                <textarea name="judul_alternatif" id="judul_alternatif" rows="2"
                                    class="form-control @error('judul_alternatif') is-invalid @enderror"
                                    placeholder="Satu judul per baris, misal judul bahasa Korea/Jepang/Inggris">{{ old('judul_alternatif') }}</textarea>
                                @error('judul_alternatif')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Genre</label>
                                <div class="border rounded p-2" style="max-height: 150px; overflow-y: auto;">
                                    @forelse ($genres as $genre)
                                        <div class="form-check">
                                            <input type="checkbox" name="genre_ids[]" id="genre_{{ $genre->id }}"
                                                class="form-check-input" value="{{ $genre->id }}"
                                                {{ in_array($genre->id, old('genre_ids', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="genre_{{ $genre->id }}">
                                                {{ $genre->nama_genre }}
                                            </label>
                                        </div>
                                    @empty
                                        <p class="text-muted mb-0">Belum ada data genre.</p>
                                    @endforelse
                                </div>
                                @error('genre_ids')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Penulis</label>
                                <input type="text" name="penulis" id="penulis"
                                    class="form-control @error('penulis') is-invalid @enderror"
                                    value="{{ old('penulis') }}" autocomplete="off">
                                @error('penulis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Ilustrator</label>
                                <input type="text" name="ilustrator" id="ilustrator"
                                    class="form-control @error('ilustrator') is-invalid @enderror"
                                    value="{{ old('ilustrator') }}" autocomplete="off">
                                @error('ilustrator')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Tahun Terbit</label>
                                <input type="number" name="tahun_terbit" id="tahun_terbit"
                                    class="form-control @error('tahun_terbit') is-invalid @enderror"
                                    value="{{ old('tahun_terbit') }}" placeholder="Contoh: 2024">
                                @error('tahun_terbit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Rating</label>
                                <input type="number" name="rating" id="rating" step="0.1" min="0"
                                    max="10" class="form-control @error('rating') is-invalid @enderror"
                                    value="{{ old('rating') }}" placeholder="Contoh: 9.9">
                                @error('rating')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" id="status"
                                    class="form-select @error('status') is-invalid @enderror">
                                    <option value="ongoing" {{ old('status') == 'ongoing' ? 'selected' : '' }}>
                                        Ongoing
                                    </option>
                                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>
                                        Completed
                                    </option>
                                    <option value="hiatus" {{ old('status') == 'hiatus' ? 'selected' : '' }}>
                                        Hiatus
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Cover</label>
                                <input type="file" name="cover" id="cover"
                                    class="form-control @error('cover') is-invalid @enderror" accept="image/*">
                                @error('cover')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Sinopsis</label>
                                <textarea name="sinopsis" id="sinopsis" rows="5" class="form-control @error('sinopsis') is-invalid @enderror"
                                    placeholder="Masukkan sinopsis manhwa">{{ old('sinopsis') }}</textarea>
                                @error('sinopsis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end gap-2">
                        <a href="{{ route('manhwa.index') }}" class="btn btn-secondary">
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
