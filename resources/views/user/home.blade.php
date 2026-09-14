@extends('layouts.user')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <section class="hero section">
        <div class="container">
            <div class="row align-items-center gy-5">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold">
                        Baca Manhwa Favoritmu
                    </h1>
                    <p class="lead mt-3">
                        Temukan ribuan chapter terbaru, update setiap hari,
                        gratis dan mudah dibaca.
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('manhwa') }}" class="btn btn-primary me-2">
                            Mulai Membaca
                        </a>
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-outline-primary">
                                Login
                            </a>
                        @endguest
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="{{ asset('assets/blogy/assets/img/blog/blog-post-3.webp') }}"
                        class="img-fluid rounded-4 shadow" alt="Hero">
                </div>
            </div>
        </div>
    </section>

    <!-- Banner Carousel Section -->
    @if ($banners->isNotEmpty())
        <section class="section pt-0">
            <div class="container">
                <div id="bannerCarousel" class="carousel slide rounded-4 overflow-hidden shadow" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        @foreach ($banners as $banner)
                            <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="{{ $loop->index }}"
                                class="{{ $loop->first ? 'active' : '' }}"
                                aria-current="{{ $loop->first ? 'true' : 'false' }}"
                                aria-label="Slide {{ $loop->iteration }}"></button>
                        @endforeach
                    </div>

                    <div class="carousel-inner">
                        @foreach ($banners as $banner)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                @if ($banner->link_url)
                                    <a href="{{ $banner->link_url }}">
                                        <img src="{{ asset('storage/' . $banner->gambar) }}" class="d-block w-100"
                                            alt="{{ $banner->judul }}" style="max-height: 400px; object-fit: cover;">
                                    </a>
                                @else
                                    <img src="{{ asset('storage/' . $banner->gambar) }}" class="d-block w-100"
                                        alt="{{ $banner->judul }}" style="max-height: 400px; object-fit: cover;">
                                @endif
                            </div>
                        @endforeach
                    </div>

                    @if ($banners->count() > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @endif
                </div>
            </div>
        </section>
    @endif

    <!-- Popular Genres -->
    <section class="section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>
                    📚 Genre Populer
                </h2>
                <a href="{{ route('genre') }}" class="btn btn-outline-primary">
                    Lihat Semua
                </a>
            </div>
            <div class="d-flex flex-wrap gap-3 justify-content-center">
                @forelse ($genrePopuler as $genre)
                    <a href="{{ route('explore', ['genre' => $genre->id]) }}" class="btn btn-outline-primary rounded-pill">
                        {{ $genre->nama_genre }}
                    </a>
                @empty
                    <p class="text-muted">Belum ada genre.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Popular Manhwa -->
    <section class="section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>
                    🔥 Manhwa Populer
                </h2>
                <a href="{{ route('populer') }}" class="btn btn-outline-primary">
                    Lihat Semua
                </a>
            </div>
            <div class="row g-4">
                @forelse ($manhwaPopuler as $manhwa)
                    <div class="col-lg-2 col-md-4 col-6">
                        <x-manhwa-card :slug="$manhwa->slug"
                            image="{{ $manhwa->cover ? asset('storage/' . $manhwa->cover) : asset('assets/blogy/assets/img/blog/blog-post-3.webp') }}"
                            title="{{ $manhwa->judul }}" rating="{{ $manhwa->rating ?? '-' }}"
                            chapter="{{ $manhwa->chapters_max_nomor_chapter ? 'Chapter ' . $manhwa->chapters_max_nomor_chapter : 'Belum ada chapter' }}" />
                    </div>
                @empty
                    <p class="text-muted text-center">Belum ada manhwa.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Manhwa Terbaru -->
    <section class="section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>
                    Manhwa Terbaru
                </h2>
                <a href="{{ route('latest') }}" class="btn btn-outline-primary">
                    Lihat Semua
                </a>
            </div>
            <div class="row g-4">
                @forelse ($manhwaTerbaru as $manhwa)
                    <div class="col-lg-2 col-md-4 col-6">
                        <x-manhwa-card :slug="$manhwa->slug"
                            image="{{ $manhwa->cover ? asset('storage/' . $manhwa->cover) : asset('assets/blogy/assets/img/blog/blog-post-1.webp') }}"
                            title="{{ $manhwa->judul }}" rating="{{ $manhwa->rating ?? '-' }}"
                            chapter="{{ $manhwa->chapters_max_nomor_chapter ? 'Chapter ' . $manhwa->chapters_max_nomor_chapter : 'Belum ada chapter' }}"
                            time="{{ $manhwa->chapters_max_tanggal_rilis ? \Carbon\Carbon::parse($manhwa->chapters_max_tanggal_rilis)->diffForHumans() : '' }}" />
                    </div>
                @empty
                    <p class="text-muted text-center">Belum ada manhwa terbaru.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
