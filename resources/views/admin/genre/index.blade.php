@extends('layouts.admin')

@section('title', 'Genre')

@section('content')
    {{-- Header --}}
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0">Genre</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Genre
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
                            <i class="bi bi-tags me-2"></i>
                            Data Genre
                        </h3>
                        <a href="{{ route('genre.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-lg me-1"></i>
                            Tambah Genre
                        </a>
                    </div>
                </div>

                {{-- Card Body --}}
                <div class="card-body">
                    {{-- Search --}}
                    <form action="{{ route('genre.index') }}" method="GET" class="row mb-3 g-2" autocomplete="off">
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" name="cari" class="form-control"
                                    placeholder="Cari nama genre..." value="{{ request('cari') }}">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    {{-- Table --}}
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="80">No</th>
                                    <th>Nama Genre</th>
                                    <th width="180">Jumlah Manhwa</th>
                                    <th width="130">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($genres as $genre)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <span class="fw-semibold">{{ $genre->nama_genre }}</span>
                                            @if (! $genre->status)
                                                <span class="badge bg-secondary ms-1">Nonaktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-primary">
                                                {{ $genre->manhwas_count }} manhwa
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('genre.edit', $genre) }}"
                                                class="btn btn-sm btn-warning" title="Edit genre">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('genre.destroy', $genre) }}" method="POST"
                                                class="d-inline"
                                                data-confirm="Yakin ingin menghapus genre ini?">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus genre">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5">
                                            <i class="bi bi-inbox fs-1 text-secondary"></i>
                                            <p class="text-muted mt-3 mb-0">
                                                {{ request('cari') ? 'Genre dengan nama tersebut tidak ditemukan.' : 'Belum ada data genre.' }}
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
@endsection