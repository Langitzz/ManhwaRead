@extends('layouts.admin')

@section('content')
    <main class="app-main">

        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="mb-0">Tambah Genre</h1>
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
                            Form Tambah Genre
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">

                                <label for="nama_genre" class="form-label">
                                    Nama Genre
                                </label>

                                <input type="text" id="nama_genre" class="form-control" placeholder="Contoh: Action">

                            </div>
                        </div>

                    </div>

                    <div class="card-footer d-flex justify-content-end gap-2">

                        <a href="{{ route('genre.index') }}" class="btn btn-secondary">
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
