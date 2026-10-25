@extends('layouts.supervisor')

@section('title', 'Komentar')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <h3 class="mb-0" style="color:#7c3aed;">Komentar</h3>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('supervisor.komentar.index') }}" method="GET" class="row mb-3" autocomplete="off">
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" name="cari" class="form-control"
                                    placeholder="Cari komentar..." value="{{ request('cari') }}">
                                <button type="submit" class="btn btn-outline-secondary">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select name="status" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua Status</option>
                                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="70">No</th>
                                    <th>User</th>
                                    <th>Manhwa</th>
                                    <th>Komentar</th>
                                    <th width="170">Tanggal</th>
                                    <th width="120">Status</th>
                                    <th width="100">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($comments as $comment)
                                    <tr>
                                        <td>{{ $loop->iteration + ($comments->currentPage() - 1) * $comments->perPage() }}</td>
                                        <td>{{ $comment->user->name }}</td>
                                        <td>
                                            {{ $comment->manhwa->judul }}
                                            @if ($comment->chapter)
                                                <span class="badge bg-info text-dark">
                                                    Ch. {{ $comment->chapter->nomor_chapter }}
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">Umum</span>
                                            @endif
                                        </td>
                                        <td>{{ \Illuminate\Support\Str::limit($comment->isi, 60) }}</td>
                                        <td>{{ $comment->created_at->format('d M Y') }}</td>
                                        <td>
                                            @if ($comment->status)
                                                <span class="badge bg-success">Aktif</span>
                                            @else
                                                <span class="badge bg-secondary">Nonaktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('supervisor.komentar.detail', $comment) }}"
                                                class="btn btn-sm" style="background:#7c3aed; color:#fff;">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">Belum ada data komentar.</td>
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