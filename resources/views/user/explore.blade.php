@extends('layouts.user')

@section('title', 'Explore')

@section('content')

    <section class="section py-5">
        <div class="container">
            <div class="section-title mb-4">
                <h2>🔍 Explore</h2>
                <p>Jelajahi semua manhwa, filter sesuai selera kamu.</p>
            </div>

            {{-- Form Filter --}}
            <form method="GET" action="{{ route('explore') }}" class="row g-3 mb-4">
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
