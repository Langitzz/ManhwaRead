@extends('layouts.admin')

@section('content')
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="mb-0">Tambah Chapter</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('chapter.index') }}">Chapter</a>
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
                <form action="{{ route('chapter.store') }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="bi bi-plus-circle me-2"></i>
                                Form Tambah Chapter
                            </h3>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="manhwa_id" class="form-label">
                                        Manhwa
                                    </label>
                                    <select name="manhwa_id" id="manhwa_id"
                                        class="form-select @error('manhwa_id') is-invalid @enderror">
                                        <option value="" selected disabled>
                                            Pilih Manhwa
                                        </option>
                                        @foreach ($manhwas as $manhwa)
                                            <option value="{{ $manhwa->id }}"
                                                {{ old('manhwa_id') == $manhwa->id ? 'selected' : '' }}>
                                                {{ $manhwa->judul }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('manhwa_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="nomor_chapter" class="form-label">
                                        Nomor Chapter
                                    </label>
                                    <input type="number" name="nomor_chapter" id="nomor_chapter"
                                        class="form-control @error('nomor_chapter') is-invalid @enderror"
                                        value="{{ old('nomor_chapter') }}"
                                        placeholder="Contoh: 1" min="1"
                                        autocomplete="off">
                                    @error('nomor_chapter')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="judul_chapter" class="form-label">
                                        Judul Chapter
                                    </label>
                                    <input type="text" name="judul_chapter" id="judul_chapter"
                                        class="form-control @error('judul_chapter') is-invalid @enderror"
                                        value="{{ old('judul_chapter') }}"
                                        placeholder="Opsional"
                                        autocomplete="off">
                                    @error('judul_chapter')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="tanggal_rilis" class="form-label">
                                        Tanggal Rilis
                                    </label>
                                    <input type="date" name="tanggal_rilis" id="tanggal_rilis"
                                        class="form-control @error('tanggal_rilis') is-invalid @enderror"
                                        value="{{ old('tanggal_rilis') }}">
                                    @error('tanggal_rilis')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-end gap-2">
                            <a href="{{ route('chapter.index') }}" class="btn btn-secondary">
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