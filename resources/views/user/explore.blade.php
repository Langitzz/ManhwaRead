@extends('layouts.user')

@section('title', 'Explore')

@push('styles')
    <style>
        .explore-heading {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .explore-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: #fff;
            flex-shrink: 0;
            background: linear-gradient(135deg, #6366f1 0%, #22d3ee 100%);
            box-shadow: 0 10px 22px rgba(99, 102, 241, .3);
        }

        .explore-title {
            margin: 0;
            font-size: 1.6rem;
            font-weight: 800;
            color: #f8fafc;
        }

        .explore-subtitle {
            margin: 2px 0 0;
            color: #94a3b8;
        }

        .explore-filter .form-select {
            height: 44px;
            border-radius: 12px;
            background-color: rgba(15, 23, 42, .7);
            border: 1px solid rgba(148, 163, 184, .2);
            color: #f8fafc;
            font-size: .9rem;
        }

        .explore-filter .form-select:focus {
            background-color: rgba(15, 23, 42, .9);
            color: #f8fafc;
            border-color: #22d3ee;
            box-shadow: 0 0 0 .2rem rgba(34, 211, 238, .15);
        }

        .explore-filter .form-select option {
            background: #0f172a;
            color: #f8fafc;
        }

        .explore-filter .btn-outline-secondary {
            height: 44px;
            border-radius: 12px;
            border-color: rgba(148, 163, 184, .3);
            color: #cbd5e1;
        }

        .explore-filter .btn-outline-secondary:hover {
            border-color: #22d3ee;
            color: #f8fafc;
            background: rgba(34, 211, 238, .08);
        }
    </style>
@endpush

@section('content')

    <section class="section py-5">
        <div class="container">
            <div class="explore-heading mb-4">
                <span class="explore-icon">
                    <i class="bi bi-compass"></i>
                </span>
                <div>
                    <h2 class="explore-title">Explore</h2>
                    <p class="explore-subtitle">Jelajahi semua manhwa, filter sesuai selera kamu.</p>
                </div>
            </div>

            {{-- Form Filter --}}
            <form method="GET" action="{{ route('explore') }}" class="row g-3 mb-4 explore-filter">
                <div class="col-md-3 col-6">
                    <select name="genre" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Genre</option>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}" @selected(request('genre') == $genre->id)>
                                {{ $genre->nama_genre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 col-6">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="ongoing" @selected(request('status') == 'ongoing')>Ongoing</option>
                        <option value="completed" @selected(request('status') == 'completed')>Completed</option>
                        <option value="hiatus" @selected(request('status') == 'hiatus')>Hiatus</option>
                    </select>
                </div>
                <div class="col-md-3 col-6">
                    <select name="sort" class="form-select" onchange="this.form.submit()">
                        <option value="terbaru" @selected(request('sort', 'terbaru') == 'terbaru')>Terbaru Update</option>
                        <option value="populer" @selected(request('sort') == 'populer')>Terpopuler</option>
                        <option value="judul" @selected(request('sort') == 'judul')>Judul (A-Z)</option>
                    </select>
                </div>
                @if (request('genre') || request('status') || request('sort'))
                    <div class="col-md-3 col-6">
                        <a href="{{ route('explore') }}" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-x-circle"></i> Reset Filter
                        </a>
                    </div>
                @endif
            </form>

            {{-- Grid Manhwa --}}
            <div class="row gy-4">
                @forelse ($manhwas as $manhwa)
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                        <x-manhwa-card slug="{{ $manhwa->slug }}"
                            image="{{ $manhwa->cover ? asset('storage/' . $manhwa->cover) : asset('assets/blogy/assets/img/blog/blog-post-1.webp') }}"
                            title="{{ $manhwa->judul }}" populer="{{ $manhwa->bookmarks_count }}"
                            chapter="{{ $manhwa->chapters_max_tanggal_rilis ? 'Update ' . \Carbon\Carbon::parse($manhwa->chapters_max_tanggal_rilis)->diffForHumans() : 'Belum ada chapter' }}" />
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-inbox fs-1 text-secondary"></i>
                        <p class="text-muted mt-3 mb-0">
                            Tidak ada manhwa yang cocok dengan filter ini.
                        </p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-5">
                {{ $manhwas->links() }}
            </div>

        </div>
    </section>
@endsection
