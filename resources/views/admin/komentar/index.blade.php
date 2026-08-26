@extends('layouts.admin')

@section('title', 'Komentar')

@section('content')

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
                    <form action="{{ route('komentar.index') }}" method="GET" class="row mb-3">
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" name="cari" class="form-control"
                                    placeholder="Cari komentar..." value="{{ request('cari') }}">
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
                                    <th>Komentar</th>
                                    <th width="170">Tanggal</th>
                                    <th width="120">Status</th>
                                    <th width="150">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($comments as $comment)
                                    <tr>
                                        <td>{{ $loop->iteration + ($comments->currentPage() - 1) * $comments->perPage() }}</td>
                                        <td>{{ $comment->user->name }}</td>
                                        <td>{{ $comment->manhwa->judul }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($comment->isi, 60) }}</td>
                                        <td>{{ $comment->created_at->format('d M Y') }}</td>
                                        <td>
                                            @if ($comment->status)
                                                <span class="badge text-bg-success">Aktif</span>
                                            @else
                                                <span class="badge text-bg-secondary">Nonaktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('komentar.detail', $comment) }}" class="btn btn-info btn-sm">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <i class="bi bi-inbox fs-1 text-secondary"></i>
                                            <p class="text-muted mt-3 mb-0">
                                                Belum ada data komentar.
                                            </p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $comments->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection