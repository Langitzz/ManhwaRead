@extends('layouts.owner')

@section('title', 'Manajemen Pengguna')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <h3 class="mb-0" style="color:#d97706;">Manajemen Pengguna</h3>
            <p class="text-muted mb-0">Read-only — lihat data user, tidak bisa ubah/hapus dari sini.</p>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('owner.users.index') }}" method="GET" class="row mb-3 g-2" autocomplete="off">
                        <div class="col-md-5">
                            <div class="input-group">
                                <input type="text" name="cari" class="form-control"
                                    placeholder="Cari nama/email/username..." value="{{ request('cari') }}">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select name="role_id" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ request('role_id') == $role->id ? 'selected' : '' }}>
                                        {{ $role->nama_peran }}
                                    </option>
                                @endforeach
                            </select>
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
                                    <th width="50">No</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $user->userRole?->nama_peran }}</span>
                                        </td>
                                        <td>
                                            @if ($user->status)
                                                <span class="badge bg-success">Aktif</span>
                                            @else
                                                <span class="badge bg-danger">Nonaktif</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">Tidak ada data.</td>
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