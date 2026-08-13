@extends('layouts.admin')

@section('content')
    <main class="app-main">

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
                                <label for="manhwa" class="form-label">
                                    Manhwa
                                </label>

                                <select id="manhwa" class="form-select">
                                    <option selected disabled>
                                        Pilih Manhwa
                                    </option>
                                    <option>Contoh Manhwa 1</option>
                                    <option>Contoh Manhwa 2</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="chapter" class="form-label">
                                    Nomor Chapter
                                </label>

                                <input type="number" id="chapter" class="form-control" placeholder="Contoh: 1">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="judul" class="form-label">
                                    Judul Chapter
                                </label>

                                <input type="text" id="judul" class="form-control"
                                    placeholder="Masukkan judul chapter">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="tanggal" class="form-label">
                                    Tanggal Rilis
                                </label>

                                <input type="date" id="tanggal" class="form-control">
                            </div>

                            <div class="col-12 mb-3">
                                <label for="isi" class="form-label">
                                    Isi / Link Chapter
                                </label>

                                <textarea id="isi" class="form-control" rows="5" placeholder="Masukkan isi atau link chapter"></textarea>
                            </div>

                        </div>

                    </div>

                    <div class="card-footer d-flex justify-content-end gap-2">

                        <a href="{{ route('chapter.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i>
                            Kembali
                        </a>

                        <button type="button" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i>
                            Simpan
                        </button>

                    </div>

                </div>

            </div>
        </div>

    </main>
@endsection
