@extends('layouts.admin')

@section('title', 'Role User')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0">Role User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Role User
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center px-4">
                    <h3 class="card-title">
                        <i class="bi bi-person-gear me-2"></i>
                        Manajemen Role User
                    </h3>
                    <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal"
                        data-bs-target="#modalTambahRole">
                        <i class="bi bi-plus-lg me-1"></i>
                        Tambah Role
                    </button>
                </div>

                <div class="card-body">
                    {{-- Search --}}
                    <form action="{{ route('admin.role.index') }}" method="GET" class="row mb-3 g-2" autocomplete="off">
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" name="cari" class="form-control" placeholder="Cari nama peran..."
                                    value="{{ request('cari') }}">
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
                                    <th width="70">No</th>
                                    <th>Nama Peran</th>
                                    <th>Deskripsi</th>
                                    <th width="120">Status</th>
                                    <th width="170">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($roles as $role)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="fw-semibold">{{ $role->nama_peran }}</td>
                                        <td class="text-muted">{{ $role->deskripsi ?? '-' }}</td>
                                        <td>
                                            @if ($role->status)
                                                <span class="badge bg-success">Aktif</span>
                                            @else
                                                <span class="badge bg-secondary">Nonaktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-warning" title="Ubah role"
                                                data-bs-toggle="modal" data-bs-target="#modalEditRole{{ $role->id }}">
                                                <i class="bi bi-pencil me-1"></i>Ubah
                                            </button>
                                            <form action="{{ route('admin.role.destroy', $role->id) }}" method="POST"
                                                class="d-inline" data-confirm="Yakin ingin menghapus role ini?">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus role">
                                                    <i class="bi bi-trash me-1"></i>Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <i class="bi bi-inbox fs-1 text-secondary"></i>
                                            <p class="text-muted mt-3 mb-0">
                                                {{ request('cari') ? 'Role dengan nama tersebut tidak ditemukan.' : 'Belum ada data role.' }}
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

    {{-- Modal Tambah Role --}}
    <div class="modal fade" id="modalTambahRole" tabindex="-1" aria-labelledby="modalTambahRoleLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.role.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahRoleLabel">
                            Tambah Role
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_peran" class="form-label">Nama Peran</label>
                            <input type="text" class="form-control" id="nama_peran" name="nama_peran" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                        </div>
                        <div class="form-check">
                            <input type="hidden" name="status" value="0">
                            <input class="form-check-input" type="checkbox" id="status" name="status"
                                value="1" checked>
                            <label class="form-check-label" for="status">
                                Aktif
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Edit Role (satu per role) --}}
    @foreach ($roles as $role)
        <div class="modal fade" id="modalEditRole{{ $role->id }}" tabindex="-1"
            aria-labelledby="modalEditRoleLabel{{ $role->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('admin.role.update', $role->id) }}" method="POST" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditRoleLabel{{ $role->id }}">
                                Ubah Role
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nama_peran_edit_{{ $role->id }}" class="form-label">Nama Peran</label>
                                <input type="text" class="form-control" id="nama_peran_edit_{{ $role->id }}"
                                    name="nama_peran" value="{{ $role->nama_peran }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi_edit_{{ $role->id }}" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi_edit_{{ $role->id }}" name="deskripsi" rows="3">{{ $role->deskripsi }}</textarea>
                            </div>
                            <div class="form-check">
                                <input type="hidden" name="status" value="0">
                                <input class="form-check-input" type="checkbox" id="status_edit_{{ $role->id }}"
                                    name="status" value="1" {{ $role->status ? 'checked' : '' }}>
                                <label class="form-check-label" for="status_edit_{{ $role->id }}">
                                    Aktif
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-save me-1"></i>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
