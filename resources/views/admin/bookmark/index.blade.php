@extends('layouts.admin')

@section('title', 'Bookmark')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0">Bookmark</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Bookmark
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
                        <i class="bi bi-bookmark-heart me-2"></i>
                        Data Bookmark
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('bookmark.index') }}" method="GET" class="row mb-3" autocomplete="off">
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" name="cari" class="form-control" placeholder="Cari bookmark..."
                                    value="{{ request('cari') }}">
                                <button type="submit" class="btn btn-outline-secondary">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="70">No</th>
                                    <th>User</th>
                                    <th>Manhwa</th>
                                    <th width="200">Tanggal Bookmark</th>
                                    <th width="110">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bookmarks as $bookmark)
                                    <tr>
                                        <td>{{ $loop->iteration + ($bookmarks->currentPage() - 1) * $bookmarks->perPage() }}</td>
                                        <td class="fw-semibold">{{ $bookmark->user?->name ?? '-' }}</td>
                                        <td>{{ $bookmark->manhwa?->judul ?? '-' }}</td>
                                        <td>
                                            <span class="text-muted">
                                                <i class="bi bi-calendar3 me-1"></i>
                                                {{ $bookmark->created_at->format('d M Y, H:i') }}
                                            </span>
                                        </td>
                                        <td>
                                            <form action="{{ route('bookmark.destroy', $bookmark) }}" method="POST"
                                                data-confirm="Yakin ingin menghapus bookmark ini?">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus bookmark">
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
                                                Belum ada data bookmark.
                                            </p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3 d-flex justify-content-center">
                        {{ $bookmarks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection