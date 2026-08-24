@extends('layouts.admin')

@section('content')
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="mb-0">Edit Genre</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('genre.index') }}">Genre</a>
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
                <form action="{{ route('genre.update', $genre) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="bi bi-pencil-square me-2"></i>
                                Form Edit Genre
                            </h3>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="nama_genre" class="form-label">
                                        Nama Genre
                                    </label>
                                    <input type="text" name="nama_genre" id="nama_genre"
                                        class="form-control @error('nama_genre') is-invalid @enderror"
                                        value="{{ old('nama_genre', $genre->nama_genre) }}"
                                        autocomplete="off">
                                    @error('nama_genre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-8">
                                    <label for="deskripsi" class="form-label">
                                        Deskripsi
                                    </label>
                                    <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $genre->deskripsi) }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="status" class="form-label d-block">
                                        Status
                                    </label>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" name="status" id="status" class="form-check-input"
                                            value="1" {{ old('status', $genre->status) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status">
                                            Aktif
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-end gap-2">
                            <a href="{{ route('genre.index') }}" class="btn btn-secondary">
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
