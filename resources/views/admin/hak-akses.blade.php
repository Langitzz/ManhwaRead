@extends('layouts.admin')

@section('title', 'Hak Akses')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0">Hak Akses</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Hak Akses
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
                        <i class="bi bi-key me-2"></i>
                        Hak Akses Role
                    </h3>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Role</th>
                                    @foreach ($permissions as $permission)
                                        <th width="120" class="text-center">{{ $permission->label }}</th>
                                    @endforeach
                                    <th width="100" class="text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($roles as $role)
                                    <tr>
                                        <form action="{{ route('admin.access.update', $role) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <td class="fw-semibold">{{ $role->nama_peran }}</td>
                                            @foreach ($permissions as $permission)
                                                <td class="text-center">
                                                    <input type="checkbox" name="permission_ids[]"
                                                        value="{{ $permission->id }}"
                                                        {{ in_array($permission->id, $matrix[$role->id]) ? 'checked' : '' }}>
                                                </td>
                                            @endforeach
                                            <td class="text-center">
                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    <i class="bi bi-save"></i>
                                                </button>
                                            </td>
                                        </form>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ count($permissions) + 2 }}" class="text-center py-5">
                                            <i class="bi bi-inbox fs-1 text-secondary"></i>
                                            <p class="text-muted mt-3 mb-0">
                                                Belum ada data Role.
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