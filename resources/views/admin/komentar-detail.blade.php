@extends('layouts.admin')

@section('title', 'Detail Komentar')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0">Detail Komentar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('komentar.index') }}">
                                Komentar
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Detail
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
                        Detail Komentar
                    </h3>
                </div>

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
                                    <span class="badge text-bg-success">Aktif</span>
                                @else
                                    <span class="badge text-bg-secondary">Nonaktif</span>
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
                    <a href="{{ route('komentar.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                    <form action="{{ route('komentar.toggle-status', $comment) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn {{ $comment->status ? 'btn-warning' : 'btn-success' }}">
                            {{ $comment->status ? 'Nonaktifkan' : 'Aktifkan' }}
                        </button>
                    </form>
                    <form action="{{ route('komentar.destroy', $comment) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
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
