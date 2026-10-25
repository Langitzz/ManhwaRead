@extends('layouts.supervisor')

@section('title', 'Detail Komentar')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <h3 class="mb-0" style="color:#7c3aed;">Detail Komentar</h3>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th width="200">User</th>
                            <td>{{ $comment->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Manhwa</th>
                            <td>{{ $comment->manhwa->judul }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td>{{ $comment->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if ($comment->status)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Isi Komentar</th>
                            <td>{{ $comment->isi }}</td>
                        </tr>
                    </table>
                </div>

                <div class="card-footer text-end">
                    <a href="{{ route('supervisor.komentar.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                    <form action="{{ route('supervisor.komentar.toggle-status', $comment) }}" method="POST"
                        class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn {{ $comment->status ? 'btn-warning' : 'btn-success' }}">
                            {{ $comment->status ? 'Nonaktifkan' : 'Aktifkan' }}
                        </button>
                    </form>
                    <form action="{{ route('supervisor.komentar.destroy', $comment) }}" method="POST"
                        class="d-inline" data-confirm="Yakin ingin menghapus komentar ini?">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection