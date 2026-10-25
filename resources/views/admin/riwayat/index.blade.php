@extends('layouts.admin')

@section('title', 'Riwayat Baca')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0">Riwayat Baca</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Riwayat Baca
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
                        <i class="bi bi-clock-history me-2"></i>
                        Data Riwayat Baca
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('riwayat.index') }}" method="GET" class="row mb-3" autocomplete="off">
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" name="cari" class="form-control" placeholder="Cari riwayat baca..."
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
                                    <th width="180">Chapter Terakhir</th>
                                    <th width="200">Terakhir Dibaca</th>
                                    <th width="110">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($riwayats as $riwayat)
                                    <tr>
                                        <td>{{ $loop->iteration + ($riwayats->currentPage() - 1) * $riwayats->perPage() }}</td>
                                        <td class="fw-semibold">{{ $riwayat->user?->name ?? '-' }}</td>
                                        <td>{{ $riwayat->manhwa?->judul ?? '-' }}</td>
                                        <td>
                                            @if ($riwayat->chapter)
                                                <span class="badge bg-primary">
                                                    Chapter {{ $riwayat->chapter->nomor_chapter }}
                                                </span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                <i class="bi bi-clock me-1"></i>
                                                {{ $riwayat->updated_at->format('d M Y, H:i') }}
                                            </span>
                                        </td>
                                        <td>
                                            <form action="{{ route('riwayat.destroy', $riwayat) }}" method="POST"
                                                data-confirm="Yakin ingin menghapus riwayat ini?">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus riwayat">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <i class="bi bi-inbox fs-1 text-secondary"></i>
                                            <p class="text-muted mt-3 mb-0">
                                                Belum ada riwayat baca.
                                            </p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3 d-flex justify-content-center">
                        {{ $riwayats->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection