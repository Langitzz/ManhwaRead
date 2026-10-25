@extends('layouts.owner')

@section('title', 'Log Aktivitas')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <h3 class="mb-0" style="color:#d97706;">Log Aktivitas</h3>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('owner.log-aktivitas') }}" method="GET" class="mb-3" autocomplete="off">
                        <div class="input-group" style="max-width:400px;">
                            <input type="text" name="cari" class="form-control" placeholder="Cari aktivitas..."
                                value="{{ request('cari') }}">
                            <button type="submit" class="btn btn-outline-secondary">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Waktu</th>
                                    <th>User</th>
                                    <th>Aktivitas</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($logs as $log)
                                    <tr>
                                        <td>{{ $log->created_at->diffForHumans() }}</td>
                                        <td>{{ $log->user->name ?? 'User tidak diketahui' }}</td>
                                        <td>{{ $log->aktivitas }}</td>
                                        <td>{{ $log->detail }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">Belum ada aktivitas.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
