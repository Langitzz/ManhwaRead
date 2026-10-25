@extends('layouts.supervisor')

@section('title', 'Dashboard')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <h3 class="mb-0" style="color:#7c3aed;">
                <i class="bi bi-binoculars-fill me-1"></i> Supervisor Dashboard
            </h3>
            <p class="text-muted">Ringkasan kondisi operasional.</p>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="card" style="border-left:4px solid #7c3aed;">
                        <div class="card-body">
                            <div class="text-muted small">Total Manhwa</div>
                            <div class="fs-3 fw-bold">{{ $totalManhwa }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="border-left:4px solid #7c3aed;">
                        <div class="card-body">
                            <div class="text-muted small">Total Chapter</div>
                            <div class="fs-3 fw-bold">{{ $totalChapter }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="border-left:4px solid #7c3aed;">
                        <div class="card-body">
                            <div class="text-muted small">Total Komentar</div>
                            <div class="fs-3 fw-bold">{{ $totalKomentar }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" style="background:#ede9fe; color:#4c1d95;">
                    <strong>Aktivitas Terbaru</strong>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Waktu</th>
                                    <th>User</th>
                                    <th>Aktivitas</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($aktivitasTerbaru as $log)
                                    <tr>
                                        <td>{{ $log->created_at->diffForHumans() }}</td>
                                        <td>{{ $log->user->name ?? 'User tidak diketahui' }}</td>
                                        <td>{{ $log->aktivitas }}</td>
                                        <td>{{ $log->detail }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">Belum ada aktivitas.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection