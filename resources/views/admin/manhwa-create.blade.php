@extends('layouts.admin')

@section('content')
    <main class="app-main">

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
                                <label class="form-label">
                                    Judul Manhwa
                                </label>

                                <input type="text" class="form-control" placeholder="Masukkan judul manhwa">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    Genre
                                </label>

                                <select class="form-select">
                                    <option selected disabled>
                                        Pilih Genre
                                    </option>
                                    <option>Action</option>
                                    <option>Romance</option>
                                    <option>Comedy</option>
                                    <option>Fantasy</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    Status
                                </label>

                                <select class="form-select">
                                    <option selected disabled>
                                        Pilih Status
                                    </option>
                                    <option>Ongoing</option>
                                    <option>Completed</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    Cover
                                </label>

                                <input type="file" class="form-control">
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">
                                    Sinopsis
                                </label>

                                <textarea class="form-control" rows="5" placeholder="Masukkan sinopsis manhwa"></textarea>
                            </div>

                        </div>

                    </div>

                    <div class="card-footer d-flex justify-content-end gap-2">

                        <a href="{{ route('manhwa.index') }}" class="btn btn-secondary">
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
