@extends('layouts.admin')

@section('title', 'Manhwa')

@section('content')
    <main class="app-main">

        {{-- Header --}}
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="mb-0">Manhwa</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Manhwa
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="app-content">
            <div class="container-fluid">
                <div class="card">
                    {{-- Card Header --}}
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title">
                                <i class="bi bi-book me-2"></i>
                                Data Manhwa
                            </h3>
                            <a href="{{ route('manhwa.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-lg me-1"></i>
                                Tambah Manhwa
                            </a>
                        </div>
                    </div>


                    {{-- Card Body --}}
                    <div class="card-body">
                        {{-- Search --}}
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Cari judul manhwa...">
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Table --}}
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle">

                                <thead class="table-light">
                                    <tr>
                                        <th width="60">No</th>
                                        <th width="100">Cover</th>
                                        <th>Judul</th>
                                        <th>Genre</th>
                                        <th>Status</th>
                                        <th width="180">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <i class="bi bi-inbox fs-1 text-secondary"></i>
                                            <p class="text-muted mt-3 mb-0">
                                                Belum ada data manhwa.
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </main>
@endsection
