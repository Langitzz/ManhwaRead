@extends('layouts.admin')

@section('title', 'Kelola Halaman')

@section('content')
    {{-- Header --}}
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0">Kelola Halaman</h1>
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
                            Kelola Halaman
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Content --}}
    <div class="app-content">
        <div class="container-fluid">

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Info Chapter --}}
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="mb-1">{{ $chapter->manhwa->judul }}</h5>
                    <p class="text-muted mb-0">
                        Chapter {{ $chapter->nomor_chapter }}
                        @if ($chapter->judul_chapter)
                            - {{ $chapter->judul_chapter }}
                        @endif
                        &middot; {{ $chapter->pages->count() }} halaman
                    </p>
                </div>
            </div>

            {{-- Form Upload --}}
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="bi bi-cloud-upload me-2"></i>
                        Tambah Halaman
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('chapter.pages.store', $chapter) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <input type="file" name="gambar[]" class="form-control @error('gambar') is-invalid @enderror"
                                multiple accept="image/*" required>
                            <small class="text-muted">
                                Pilih beberapa gambar sekaligus. Urutan halaman mengikuti urutan file yang dipilih,
                                dan otomatis lanjut dari nomor halaman terakhir.
                            </small>
                            @error('gambar')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            @error('gambar.*')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-upload me-1"></i>
                            Upload
                        </button>
                    </form>
                </div>
            </div>

            {{-- Daftar Halaman --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="bi bi-images me-2"></i>
                        Daftar Halaman
                    </h3>
                </div>
                <div class="card-body">
                    @forelse ($chapter->pages as $page)
                        <div class="col-6 col-md-3 col-lg-2 d-inline-block align-top mb-3 me-2" style="width: 160px;">
                            <div class="card h-100">
                                <img src="{{ asset('storage/' . $page->gambar) }}" class="card-img-top"
                                    style="height:200px; object-fit:cover;" alt="Halaman {{ $page->nomor_halaman }}">
                                <div class="card-body p-2 text-center">
                                    <small class="d-block mb-2">Halaman {{ $page->nomor_halaman }}</small>
                                    <form action="{{ route('chapter.pages.destroy', $page) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus halaman ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger w-100">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="bi bi-inbox fs-1 text-secondary"></i>
                            <p class="text-muted mt-3 mb-0">
                                Belum ada halaman untuk chapter ini.
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    </main>
@endsection
