@extends('layouts.admin')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0">Edit Manhwa</h1>
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
                            Edit
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <form action="{{ route('manhwa.update', $manhwa) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-pencil-square me-2"></i>
                            Form Edit Manhwa
                        </h3>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Judul Manhwa</label>
                                <input type="text" name="judul" id="judul"
                                    class="form-control @error('judul') is-invalid @enderror"
                                    value="{{ old('judul', $manhwa->judul) }}" autocomplete="off">
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Judul Alternatif</label>
                                <textarea name="judul_alternatif" id="judul_alternatif" rows="2"
                                    class="form-control @error('judul_alternatif') is-invalid @enderror"
                                    placeholder="Satu judul per baris, misal judul bahasa Korea/Jepang/Inggris">{{ old('judul_alternatif', $manhwa->judul_alternatif) }}</textarea>
                                @error('judul_alternatif')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Genre</label>
                                <div class="border rounded p-2" style="max-height: 150px; overflow-y: auto;">
                                    @php
                                        $selectedGenres = old('genre_ids', $manhwa->genres->pluck('id')->toArray());
                                    @endphp
                                    @forelse ($genres as $genre)
                                        <div class="form-check">
                                            <input type="checkbox" name="genre_ids[]" id="genre_{{ $genre->id }}"
                                                class="form-check-input" value="{{ $genre->id }}"
                                                {{ in_array($genre->id, $selectedGenres) ? 'checked' : '' }}>
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
                                    value="{{ old('penulis', $manhwa->penulis) }}" autocomplete="off">
                                @error('penulis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Ilustrator</label>
                                <input type="text" name="ilustrator" id="ilustrator"
                                    class="form-control @error('ilustrator') is-invalid @enderror"
                                    value="{{ old('ilustrator', $manhwa->ilustrator) }}" autocomplete="off">
                                @error('ilustrator')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Tahun Terbit</label>
                                <input type="number" name="tahun_terbit" id="tahun_terbit"
                                    class="form-control @error('tahun_terbit') is-invalid @enderror"
                                    value="{{ old('tahun_terbit', $manhwa->tahun_terbit) }}">
                                @error('tahun_terbit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Rating</label>
                                <input type="number" name="rating" id="rating" step="0.1" min="0"
                                    max="10" class="form-control @error('rating') is-invalid @enderror"
                                    value="{{ old('rating', $manhwa->rating) }}" placeholder="Contoh: 9.9">
                                @error('rating')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" id="status"
                                    class="form-select @error('status') is-invalid @enderror">
                                    @foreach (['ongoing' => 'Ongoing', 'completed' => 'Completed', 'hiatus' => 'Hiatus'] as $value => $label)
                                        <option value="{{ $value }}"
                                            {{ old('status', $manhwa->status) == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Cover</label>
                                @if ($manhwa->cover)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $manhwa->cover) }}" alt="Cover saat ini"
                                            style="max-height: 100px;" class="rounded border">
                                    </div>
                                @endif
                                <input type="file" name="cover" id="cover"
                                    class="form-control @error('cover') is-invalid @enderror" accept="image/*">
                                <small class="text-muted">Kosongkan jika tidak ingin mengganti cover.</small>
                                @error('cover')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Sinopsis</label>
                                <textarea name="sinopsis" id="sinopsis" rows="5"
                                    class="form-control @error('sinopsis') is-invalid @enderror">{{ old('sinopsis', $manhwa->sinopsis) }}</textarea>
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
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
