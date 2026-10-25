@extends('layouts.owner')

@section('title', 'Manajemen Konten')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <h3 class="mb-0" style="color:#d97706;">Manajemen Konten</h3>
            <p class="text-muted mb-0">Read-only — pantau daftar manhwa, edit konten tetap lewat Admin/Editor.</p>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('owner.manhwa.index') }}" method="GET" class="row mb-3 g-2" autocomplete="off">
                        <div class="col-md-5">
                            <div class="input-group">
                                <input type="text" name="cari" class="form-control"
                                    placeholder="Cari judul manhwa..." value="{{ request('cari') }}">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select name="genre_id" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua Genre</option>
                                @foreach ($genres as $genre)
                                    <option value="{{ $genre->id }}"
                                        {{ request('genre_id') == $genre->id ? 'selected' : '' }}>
                                        {{ $genre->nama_genre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="50">No</th>
                                    <th>Judul</th>
                                    <th>Genre</th>
                                    <th>Jumlah Chapter</th>
                                    <th>Views</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($manhwas as $manhwa)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $manhwa->judul }}</td>
                                        <td>
                                            @foreach ($manhwa->genres as $genre)
                                                <span class="badge bg-secondary">{{ $genre->nama_genre }}</span>
                                            @endforeach
                                        </td>
                                        <td>{{ $manhwa->chapters_count }}</td>
                                        <td>{{ number_format($manhwa->views) }}</td>
                                        <td>
                                            @if ($manhwa->status === 'ongoing')
                                                <span class="badge bg-primary">Ongoing</span>
                                            @elseif ($manhwa->status === 'completed')
                                                <span class="badge bg-success">Completed</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Hiatus</span>
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