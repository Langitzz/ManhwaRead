@extends('layouts.admin')

@section('title', 'Komentar')

@section('content')
    <main class="app-main">

        {{-- Header --}}
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="mb-0">Komentar</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Komentar
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
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-chat-dots me-2"></i>
                            Data Komentar
                        </h3>
                    </div>
                    <div class="card-body">
                        {{-- Search --}}
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Cari komentar...">
                                    <button class="btn btn-outline-secondary">
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
                                        <th width="70">No</th>
                                        <th>User</th>
                                        <th>Manhwa</th>
                                        <th>Komentar</th>
                                        <th width="170">Tanggal</th>
                                        <th width="150">Status</th>
                                        <th width="150">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Ahmad</td>
                                        <td>Solo Leveling</td>
                                        <td>Manhwa ini keren banget!</td>
                                        <td>03 Agustus 2026</td>
                                        <td>
                                            <span class="badge text-bg-success">
                                                Aktif
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('komentar.detail') }}" class="btn btn-info btn-sm">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
