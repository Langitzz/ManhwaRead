@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->
                <div class="col-lg-2 col-md-4 col-6">
                    <!--begin::Small Box Widget 1-->
                    <div class="small-box text-bg-primary">
                        <div class="inner">
                            <h3>{{ $totalManhwa }}</h3>

                            <p>Total Manhwa</p>
                        </div>
                        <i class="bi bi-book-half small-box-icon"></i>
                        <a href="{{ route('manhwa.index') }}"
                            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                    <!--end::Small Box Widget 1-->
                </div>
                <!--end::Col-->
                <div class="col-lg-2 col-md-4 col-6">
                    <!--begin::Small Box Widget 2-->
                    <div class="small-box text-bg-danger">
                        <div class="inner">
                            <h3>{{ $totalChapter }}</h3>

                            <p>Total Chapter</p>
                        </div>
                        <i class="bi bi-journal-text small-box-icon"></i>
                        <a href="{{ route('chapter.index') }}"
                            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                    <!--end::Small Box Widget 2-->
                </div>
                <!--end::Col-->
                <div class="col-lg-2 col-md-4 col-6">
                    <!--begin::Small Box Widget 3-->
                    <div class="small-box text-bg-warning">
                        <div class="inner">
                            <h3>{{ $totalUser }}</h3>

                            <p>Total User</p>
                        </div>
                        <i class="bi bi-people-fill small-box-icon"></i>
                        <a href="{{ route('user.index') }}"
                            class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                    <!--end::Small Box Widget 3-->
                </div>
                <!--end::Col-->
                <div class="col-lg-2 col-md-4 col-6">
                    <!--begin::Small Box Widget 4-->
                    <div class="small-box text-bg-info">
                        <div class="inner">
                            <h3>{{ $totalBookmark }}</h3>

                            <p>Total Bookmark</p>
                        </div>
                        <i class="bi bi-bookmark-heart small-box-icon"></i>
                        <a href="{{ route('bookmark.index') }}"
                            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                    <!--end::Small Box Widget 4-->
                </div>
                <!--end::Col-->
                <div class="col-lg-2 col-md-4 col-6">
                    <!--begin::Small Box Widget 5-->
                    <div class="small-box text-bg-success">
                        <div class="inner">
                            <h3>{{ $manhwaOngoing }}</h3>

                            <p>Manhwa Ongoing</p>
                        </div>
                        <i class="bi bi-play-circle small-box-icon"></i>
                        <a href="{{ route('manhwa.index') }}"
                            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                    <!--end::Small Box Widget 5-->
                </div>
                <!--end::Col-->
                <div class="col-lg-2 col-md-4 col-6">
                    <!--begin::Small Box Widget 6-->
                    <div class="small-box text-bg-secondary">
                        <div class="inner">
                            <h3>{{ $manhwaCompleted }}</h3>

                            <p>Manhwa Completed</p>
                        </div>
                        <i class="bi bi-check-circle small-box-icon"></i>
                        <a href="{{ route('manhwa.index') }}"
                            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                    <!--end::Small Box Widget 6-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row Leaderboard-->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="bi bi-trophy me-2"></i>
                                Manhwa Terpopuler
                            </h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover mb-0">
                                <tbody>
                                    @forelse ($manhwaPopuler as $i => $manhwa)
                                        <tr>
                                            <td width="30">{{ $i + 1 }}</td>
                                            <td>{{ $manhwa->judul }}</td>
                                            <td class="text-end text-muted">{{ number_format($manhwa->views) }} views</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center text-muted py-3">Belum ada data.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="bi bi-star me-2"></i>
                                Rating Tertinggi
                            </h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover mb-0">
                                <tbody>
                                    @forelse ($manhwaRatingTertinggi as $i => $manhwa)
                                        <tr>
                                            <td width="30">{{ $i + 1 }}</td>
                                            <td>{{ $manhwa->judul }}</td>
                                            <td class="text-end text-muted">{{ $manhwa->rating }} ★</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center text-muted py-3">Belum ada manhwa yang diberi rating.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="bi bi-bookmark-heart me-2"></i>
                                Paling Banyak Bookmark
                            </h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover mb-0">
                                <tbody>
                                    @forelse ($manhwaBookmarkTerbanyak as $i => $manhwa)
                                        <tr>
                                            <td width="30">{{ $i + 1 }}</td>
                                            <td>{{ $manhwa->judul }}</td>
                                            <td class="text-end text-muted">{{ $manhwa->bookmarks_count }} bookmark</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center text-muted py-3">Belum ada data.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="bi bi-tags me-2"></i>
                                Genre Terpopuler
                            </h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover mb-0">
                                <tbody>
                                    @forelse ($genreTerpopuler as $i => $genre)
                                        <tr>
                                            <td width="30">{{ $i + 1 }}</td>
                                            <td>{{ $genre->nama_genre }}</td>
                                            <td class="text-end text-muted">{{ $genre->manhwas_count }} manhwa</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center text-muted py-3">Belum ada data.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Row Leaderboard-->
            <!--begin::Row-->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="bi bi-book me-2"></i>
                                Manhwa Terbaru
                            </h3>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Judul</th>
                                            <th>Status</th>
                                            <th>Genre</th>
                                            <th>Chapter Terakhir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($manhwaTerbaru as $manhwa)
                                            <tr>
                                                <td>{{ $manhwa->judul }}</td>
                                                <td>
                                                    @php
                                                        $statusBadge = [
                                                            'ongoing' => 'bg-success',
                                                            'completed' => 'bg-primary',
                                                            'hiatus' => 'bg-warning text-dark',
                                                        ];
                                                    @endphp
                                                    <span class="badge {{ $statusBadge[$manhwa->status] }}">
                                                        {{ ucfirst($manhwa->status) }}
                                                    </span>
                                                </td>
                                                <td class="text-nowrap">
                                                    @forelse ($manhwa->genres->take(2) as $genre)
                                                        <span class="badge bg-secondary">{{ $genre->nama_genre }}</span>
                                                    @empty
                                                        -
                                                    @endforelse
                                                    @if ($manhwa->genres->count() > 2)
                                                        <span
                                                            class="badge bg-dark">+{{ $manhwa->genres->count() - 2 }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-nowrap">
                                                    @if ($manhwa->chapters_max_nomor_chapter)
                                                        Ch. {{ $manhwa->chapters_max_nomor_chapter }}
                                                    @else
                                                        <span class="text-muted">Belum ada chapter</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted py-4">
                                                    Belum ada data manhwa.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="bi bi-clock-history me-2"></i>
                                Aktivitas Terbaru
                            </h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Aktivitas</th>
                                            <th>Detail</th>
                                            <th>User</th>
                                            <th>Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($aktivitasTerbaru as $log)
                                            <tr>
                                                <td>{{ $log->aktivitas }}</td>
                                                <td class="text-truncate" style="max-width:180px;"
                                                    title="{{ $log->detail }}">{{ $log->detail ?? '-' }}</td>
                                                <td class="text-nowrap">{{ $log->user->name ?? 'Tidak diketahui' }}</td>
                                                <td class="text-nowrap">{{ $log->created_at->diffForHumans() }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted py-4">
                                                    Belum ada aktivitas.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--begin::Row Filter Periode-->
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h3 class="mb-0">
                                <i class="bi bi-bar-chart-line me-2"></i>
                                Statistik & Tren
                            </h3>
                            <small class="text-muted">Filter periode hanya berlaku untuk chart User Baru</small>
                        </div>
                        <form method="GET" action="{{ route('admin') }}" class="d-flex align-items-center gap-2">
                            <label for="periode" class="mb-0 text-muted">Periode:</label>
                            <select name="periode" id="periode" class="form-select form-select-sm" style="width:auto;"
                                onchange="this.form.submit()">
                                <option value="semua" {{ $periode === 'semua' ? 'selected' : '' }}>
                                    Semua Waktu
                                </option>
                                <option value="7hari" {{ $periode === '7hari' ? 'selected' : '' }}>
                                    7 Hari Terakhir
                                </option>
                                <option value="30hari" {{ $periode === '30hari' ? 'selected' : '' }}>
                                    30 Hari Terakhir
                                </option>
                                <option value="bulan_ini" {{ $periode === 'bulan_ini' ? 'selected' : '' }}>
                                    Bulan Ini
                                </option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
            <!--end::Row Filter Periode-->

            <!--begin::Row Chart-->
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="bi bi-pie-chart me-2"></i>
                                Status Manhwa
                            </h3>
                        </div>
                        <div class="card-body">
                            <div style="height: 260px;">
                                <canvas id="chartStatusManhwa"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="bi bi-bar-chart me-2"></i>
                                Genre Terpopuler
                            </h3>
                        </div>
                        <div class="card-body">
                            <div style="height: 260px;">
                                <canvas id="chartGenreTerpopuler"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="bi bi-person-plus me-2"></i>
                                User Baru
                            </h3>
                        </div>
                        <div class="card-body">
                            <div style="height: 260px;">
                                <canvas id="chartUserBaru"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Row Chart-->
        <!--end::Container-->
        </div>
        <!--end::App Content-->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Chart 1: Donut Status Manhwa
                new Chart(document.getElementById('chartStatusManhwa'), {
                    type: 'doughnut',
                    data: {
                        labels: ['Ongoing', 'Completed', 'Hiatus'],
                        datasets: [{
                            data: @json(array_values($chartStatusManhwa)),
                            backgroundColor: ['#198754', '#0d6efd', '#ffc107'],
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    boxWidth: 12,
                                    padding: 10,
                                    font: {
                                        size: 11,
                                    },
                                },
                            },
                        },
                    },
                });

                // Chart 2: Horizontal Bar Genre Terpopuler
                new Chart(document.getElementById('chartGenreTerpopuler'), {
                    type: 'bar',
                    data: {
                        labels: @json($chartGenreTerpopuler->pluck('nama_genre')),
                        datasets: [{
                            label: 'Jumlah Manhwa',
                            data: @json($chartGenreTerpopuler->pluck('manhwas_count')),
                            backgroundColor: '#0d6efd',
                        }],
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false,
                            },
                        },
                        scales: {
                            x: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1,
                                },
                            },
                        },
                    },
                });

                // Chart 3: Bar User Baru per hari
                new Chart(document.getElementById('chartUserBaru'), {
                    type: 'bar',
                    data: {
                        labels: @json($chartUserBaru->pluck('tanggal')),
                        datasets: [{
                            label: 'User Baru',
                            data: @json($chartUserBaru->pluck('jumlah')),
                            backgroundColor: '#20c997',
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false,
                            },
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1,
                                },
                            },
                        },
                    },
                });
            });
        </script>
    @endsection
