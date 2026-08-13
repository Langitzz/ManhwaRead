@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <main class="app-main">
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
                    <div class="col-lg-3 col-6">
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
                    <div class="col-lg-3 col-6">
                        <!--begin::Small Box Widget 2-->
                        <div class="small-box text-bg-success">
                            <div class="inner">
                                <h3>{{ $totalGenre }}</h3>

                                <p>Total Genre</p>
                            </div>
                            <i class="bi bi-tags small-box-icon"></i>
                            <a href="{{ route('genre.index') }}"
                                class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                More info <i class="bi bi-link-45deg"></i>
                            </a>
                        </div>
                        <!--end::Small Box Widget 2-->
                    </div>
                    <!--end::Col-->
                    <div class="col-lg-3 col-6">
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
                    <div class="col-lg-3 col-6">
                        <!--begin::Small Box Widget 4-->
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
                        <!--end::Small Box Widget 4-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="row">
                    <div class="col-lg-8">
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
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td colspan="3" class="text-center text-muted py-4">
                                                    Belum ada data manhwa.
                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
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
                                                <th>User</th>
                                                <th>Waktu</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td colspan="3" class="text-center text-muted py-4">
                                                    Belum ada aktivitas.
                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <!-- /.row (main row) -->
                <div class="row">

                    <div class="col-12">

                        <div class="card">

                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="bi bi-grid me-2"></i>
                                    Menu Cepat
                                </h3>
                            </div>

                            <div class="card-body">

                                <div class="row g-3">

                                    <div class="col-lg-2 col-md-4 col-6">
                                        <a href="{{ route('manhwa.index') }}" class="btn btn-outline-primary w-100">
                                            <i class="bi bi-book d-block fs-3 mb-2"></i>
                                            Manhwa
                                        </a>
                                    </div>

                                    <div class="col-lg-2 col-md-4 col-6">
                                        <a href="{{ route('genre.index') }}" class="btn btn-outline-success w-100">
                                            <i class="bi bi-tags d-block fs-3 mb-2"></i>
                                            Genre
                                        </a>
                                    </div>

                                    <div class="col-lg-2 col-md-4 col-6">
                                        <a href="{{ route('chapter.index') }}" class="btn btn-outline-warning w-100">
                                            <i class="bi bi-journal-text d-block fs-3 mb-2"></i>
                                            Chapter
                                        </a>
                                    </div>

                                    <div class="col-lg-2 col-md-4 col-6">
                                        <a href="{{ route('komentar.index') }}" class="btn btn-outline-info w-100">
                                            <i class="bi bi-chat-dots d-block fs-3 mb-2"></i>
                                            Komentar
                                        </a>
                                    </div>

                                    <div class="col-lg-2 col-md-4 col-6">
                                        <a href="{{ route('bookmark.index') }}" class="btn btn-outline-danger w-100">
                                            <i class="bi bi-bookmark-heart d-block fs-3 mb-2"></i>
                                            Bookmark
                                        </a>
                                    </div>

                                    <div class="col-lg-2 col-md-4 col-6">
                                        <a href="{{ route('user.index') }}" class="btn btn-outline-secondary w-100">
                                            <i class="bi bi-people d-block fs-3 mb-2"></i>
                                            User
                                        </a>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content-->
    </main>
@endsection
