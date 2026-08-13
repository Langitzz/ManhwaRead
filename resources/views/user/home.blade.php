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

    <!-- Latest Update Section -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>🔥 Update Chapter Terbaru</h2>
                <p>Manhwa yang baru saja diperbarui.</p>
            </div>
            <div class="row g-4">
                @for ($i = 1; $i <= 8; $i++)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card border-0 shadow-sm h-100">
                            <img src="{{ asset('assets/blogy/assets/img/blog/blog-post-3.webp') }}" class="card-img-top"
                                alt="Manhwa">
                            <div class="card-body">
                                <h5 class="card-title">
                                    Solo Leveling
                                </h5>
                                <p class="mb-1 text-muted">
                                    Chapter 201
                                </p>
                                <small class="text-secondary">
                                    Update 10 menit yang lalu
                                </small>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <!-- Popular Genres -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>📚 Genre Populer</h2>
                <p>Pilih genre favoritmu.</p>
            </div>
            <div class="d-flex flex-wrap gap-3 justify-content-center">
                <a href="#" class="btn btn-outline-primary rounded-pill">Action</a>
                <a href="#" class="btn btn-outline-primary rounded-pill">Adventure</a>
                <a href="#" class="btn btn-outline-primary rounded-pill">Comedy</a>
                <a href="#" class="btn btn-outline-primary rounded-pill">Drama</a>
                <a href="#" class="btn btn-outline-primary rounded-pill">Fantasy</a>
                <a href="#" class="btn btn-outline-primary rounded-pill">Isekai</a>
                <a href="#" class="btn btn-outline-primary rounded-pill">Martial Arts</a>
                <a href="#" class="btn btn-outline-primary rounded-pill">Romance</a>
                <a href="#" class="btn btn-outline-primary rounded-pill">School</a>
                <a href="#" class="btn btn-outline-primary rounded-pill">Shounen</a>
                <a href="#" class="btn btn-outline-primary rounded-pill">Supernatural</a>
                <a href="#" class="btn btn-outline-primary rounded-pill">Tragedy</a>
            </div>
        </div>
    </section>

    <!-- Popular Manhwa -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>🔥 Manhwa Populer</h2>
                <p>Manhwa yang paling banyak dibaca minggu ini.</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-2 col-md-4 col-6">
                    <x-manhwa-card image="{{ asset('assets/blogy/assets/img/blog/blog-post-3.webp') }}"
                        title="Solo Leveling" rating="9.9" chapter="Chapter 201" />
                </div>
            </div>
        </div>
    </section>

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
                @for ($i = 1; $i <= 8; $i++)
                    <div class="col-lg-3 col-md-4 col-6">
                        <x-manhwa-card image="{{ asset('assets/blogy/assets/img/blog/blog-post-1.webp') }}"
                            title="Solo Leveling" rating="9.9" chapter="Chapter 201" time="2 jam yang lalu" />
                    </div>
                @endfor
            </div>
        </div>
    </section>
@endsection
