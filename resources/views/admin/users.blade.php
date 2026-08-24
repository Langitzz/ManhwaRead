@extends('layouts.admin')

@section('title', 'Daftar User')

@section('content')
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="mb-0">Daftar User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Daftar User
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
                            <i class="bi bi-people me-2"></i>
                            Data User
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th width="70">No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th width="120">Role</th>
                                        <th width="120">Status</th>
                                        <th width="150">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <span class="badge bg-secondary">
                                                    {{ $user->userRole->nama_peran ?? 'Belum ada' }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($user->status)
                                                    <span class="badge bg-success">Aktif</span>
                                                @else
                                                    <span class="badge bg-danger">Nonaktif</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editUserModal{{ $user->id }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <form action="{{ route('user.destroy', $user) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('user.update', $user) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">
                                                                Edit User: {{ $user->name }}
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label">Role</label>
                                                                <select name="role_id" class="form-select">
                                                                    @foreach ($roles as $role)
                                                                        <option value="{{ $role->id }}"
                                                                            {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                                            {{ $role->nama_peran }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label d-block">Status</label>
                                                                <div class="form-check form-switch">
                                                                    <input type="checkbox" name="status"
                                                                        class="form-check-input" value="1"
                                                                        {{ $user->status ? 'checked' : '' }}>
                                                                    <label class="form-check-label">
                                                                        Aktif
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">
                                                                Batal
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">
                                                                Simpan
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-5">
                                                <i class="bi bi-inbox fs-1 text-secondary"></i>
                                                <p class="text-muted mt-3 mb-0">
                                                    Belum ada data user.
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