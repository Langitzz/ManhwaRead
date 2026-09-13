@extends('layouts.admin')

@section('title', 'Backup Database')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0">Backup Database</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Backup Database
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
                        <i class="bi bi-hdd-network me-2"></i>
                        Backup Database
                    </h3>
                </div>

                <div class="card-body">
                    <p>
                        Klik tombol di bawah untuk mengunduh salinan (backup) seluruh isi database
                        saat ini dalam format file <code>.sql</code>.
                    </p>
                    <p class="text-muted">
                        File backup TIDAK disimpan permanen di server — begitu proses unduh
                        selesai, file sementara otomatis dihapus dari server.
                    </p>

                    <a href="{{ route('backup.download') }}" class="btn btn-primary">
                        <i class="bi bi-download me-1"></i>
                        Download Backup Database
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
