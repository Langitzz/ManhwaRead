@extends('layouts.admin')

@section('title', 'Chapter')

@section('content')
    {{-- Header --}}
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0">Chapter</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Chapter
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
                            <i class="bi bi-journal-text me-2"></i>
                            Data Chapter
                        </h3>
                        <a href="{{ route('chapter.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-lg me-1"></i>
                            Tambah Chapter
                        </a>
                    </div>
                </div>

                {{-- Card Body --}}
                <div class="card-body">
                    {{-- Filter --}}
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari chapter...">
                                <button class="btn btn-outline-secondary" type="button">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <form action="{{ route('chapter.index') }}" method="GET">
                                <select name="manhwa_id" class="form-select" onchange="this.form.submit()">
                                    <option value="" {{ request('manhwa_id') == '' ? 'selected' : '' }}>
                                        Semua Manhwa
                                    </option>
                                    @foreach ($manhwas as $manhwa)
                                        <option value="{{ $manhwa->id }}"
                                            {{ request('manhwa_id') == $manhwa->id ? 'selected' : '' }}>
                                            {{ $manhwa->judul }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>

                    {{-- Table --}}
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="70">No</th>
                                    <th>Manhwa</th>
                                    <th width="140">Chapter</th>
                                    <th width="180">Tanggal Rilis</th>
                                    <th width="180">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($chapters as $chapter)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $chapter->manhwa->judul }}</td>
                                        <td>
                                            Chapter {{ $chapter->nomor_chapter }}
                                            @if ($chapter->judul_chapter)
                                                <br><small class="text-muted">{{ $chapter->judul_chapter }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $chapter->tanggal_rilis?->format('d M Y') ?? '-' }}
                                        </td>
                                        <td>
                                            <a href="{{ route('chapter.pages.index', $chapter) }}"
                                                class="btn btn-sm btn-info" title="Kelola Halaman">
                                                <i class="bi bi-images"></i>
                                            </a>
                                            <a href="{{ route('chapter.edit', $chapter) }}" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('chapter.destroy', $chapter) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Yakin ingin menghapus chapter ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <i class="bi bi-inbox fs-1 text-secondary"></i>
                                            <p class="text-muted mt-3 mb-0">
                                                Belum ada data chapter.
                                            </p>
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
    </main>
@endsection
