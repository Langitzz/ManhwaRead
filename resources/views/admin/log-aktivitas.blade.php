@extends('layouts.admin')

@section('title', 'Log Aktivitas')

@section('content')
    <main class="app-main">

        <div class="app-content-header">
            <div class="container-fluid">

                <div class="row">

                    <div class="col-sm-6">
                        <h1 class="mb-0">Log Aktivitas</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin') }}">Home</a>
                            </li>

                            <li class="breadcrumb-item active">
                                Log Aktivitas
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
                        <div class="d-flex justify-content-between align-items-center">

                            <h3 class="card-title">
                                <i class="bi bi-clock-history me-2"></i>
                                Riwayat Aktivitas Admin
                            </h3>

                        </div>
                    </div>

                    <div class="card-body">

                        <div class="row mb-3">

                            <div class="col-md-4">

                                <div class="input-group">

                                    <input type="text" class="form-control" placeholder="Cari aktivitas...">

                                    <button class="btn btn-outline-secondary">
                                        <i class="bi bi-search"></i>
                                    </button>

                                </div>

                            </div>

                        </div>

                        <div class="table-responsive">

                            <table class="table table-bordered table-hover align-middle">

                                <thead class="table-light">

                                    <tr>
                                        <th width="70">No</th>
                                        <th>Admin</th>
                                        <th>Aktivitas</th>
                                        <th>Detail</th>
                                        <th width="180">Tanggal</th>
                                    </tr>

                                </thead>

                                <tbody>

                                    <tr>

                                        <td colspan="5" class="text-center py-5">
                                            <i class="bi bi-inbox fs-1 text-secondary"></i>
                                            <p class="text-muted mt-3 mb-0">
                                                Belum ada data aktivitas.
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
