@extends('layouts.admin')

@section('title', 'Banner')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0">Banner</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Banner
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
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">
                            <i class="bi bi-images me-2"></i>
                            Data Banner
                        </h3>
                        <a href="{{ route('banner.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-lg me-1"></i>
                            Tambah Banner
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="80">No</th>
                                    <th width="140">Gambar</th>
                                    <th>Judul</th>
                                    <th width="100">Urutan</th>
                                    <th width="120">Status</th>
                                    <th width="180">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($banners as $banner)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $banner->gambar) }}"
                                                alt="{{ $banner->judul }}" style="height: 50px;" class="rounded">
                                        </td>
                                        <td>
                                            {{ $banner->judul }}
                                            @if ($banner->link_url)
                                                <br>
                                                <small class="text-muted">{{ $banner->link_url }}</small>
                                            @endif
                                        </td>
                                        <td>{{ $banner->urutan }}</td>
                                        <td>
                                            @if ($banner->status)
                                                <span class="badge bg-success">Aktif</span>
                                            @else
                                                <span class="badge bg-secondary">Nonaktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('banner.edit', $banner) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('banner.destroy', $banner) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Yakin ingin menghapus banner ini?')">
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
                                        <td colspan="6" class="text-center py-5">
                                            <i class="bi bi-inbox fs-1 text-secondary"></i>
                                            <p class="text-muted mt-3 mb-0">
                                                Belum ada data banner.
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