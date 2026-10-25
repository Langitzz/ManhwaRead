@extends('layouts.user')

@section('title', 'Home')

@section('content')
    <style>
        .lanjut-scroll {
            display: flex;
            gap: 16px;
            overflow-x: auto;
            padding: 4px 2px 12px;
            scroll-snap-type: x mandatory;
        }

        .lanjut-card {
            flex: 0 0 170px;
            scroll-snap-align: start;
            color: #f8fafc;
            text-decoration: none;
        }

        .lanjut-cover {
            position: relative;
            aspect-ratio: 2 / 3;
            border-radius: 14px;
            overflow: hidden;
            background: linear-gradient(160deg, #312e81 0%, #0f172a 100%);
            box-shadow: 0 10px 24px rgba(0, 0, 0, .35);
        }

        .lanjut-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .3s ease;
        }

        .lanjut-card:hover .lanjut-cover img {
            transform: scale(1.05);
        }

        .lanjut-play {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(11, 17, 32, .45);
            opacity: 0;
            transition: opacity .25s ease;
        }

        .lanjut-play i {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #6366f1 0%, #22d3ee 100%);
            color: #fff;
            font-size: 1.4rem;
        }

        .lanjut-card:hover .lanjut-play {
            opacity: 1;
        }

        .lanjut-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px;
            text-align: center;
            color: #c7d2fe;
            font-size: .8rem;
        }

        .lanjut-placeholder i {
            font-size: 1.8rem;
            color: #818cf8;
        }

        .lanjut-title {
            margin: 10px 0 2px;
            font-size: .95rem;
            font-weight: 600;
            color: #f8fafc;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .lanjut-meta {
            font-size: .82rem;
            color: #94a3b8;
        }

        .hero-collage-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px;
            text-align: center;
            background: linear-gradient(160deg, #312e81 0%, #0f172a 100%);
            color: #c7d2fe;
            font-size: 12px;
            font-weight: 600;
        }

        .hero-collage-placeholder i {
            font-size: 1.8rem;
            color: #818cf8;
        }

        .banner-caption {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            padding: 48px 28px 22px;
            background: linear-gradient(to top, rgba(11, 17, 32, .92), rgba(11, 17, 32, 0));
            pointer-events: none;
        }

        .banner-caption-title {
            margin: 0;
            color: #f8fafc;
            font-size: 1.4rem;
            font-weight: 700;
            text-shadow: 0 2px 8px rgba(0, 0, 0, .4);
        }

        @media (max-width: 576px) {
            .banner-caption {
                padding: 32px 16px 14px;
            }

            .banner-caption-title {
                font-size: 1.05rem;
            }
        }

        .landing-section-title {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }

        .landing-section-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: #fff;
            flex-shrink: 0;
            background: linear-gradient(135deg, #6366f1 0%, #22d3ee 100%);
        }

        .landing-title-accent {
            background: linear-gradient(90deg, #22d3ee 0%, #818cf8 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .landing-cta {
            border: none;
            border-radius: 14px;
            padding: 12px 26px;
            font-weight: 700;
            color: #fff;
            background: linear-gradient(135deg, #6366f1 0%, #22d3ee 100%);
            box-shadow: 0 10px 25px rgba(34, 211, 238, .2);
            transition: transform .15s, box-shadow .15s;
        }

        .landing-cta:hover {
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 14px 30px rgba(34, 211, 238, .3);
        }

        .landing-cta-outline {
            border: 1px solid #334155;
            border-radius: 14px;
            padding: 12px 26px;
            font-weight: 600;
            color: #cbd5e1;
            background: transparent;
        }

        .landing-cta-outline:hover {
            color: #f8fafc;
            background: rgba(148, 163, 184, .08);
        }

        .hero-collage {
            position: relative;
            height: 320px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-collage-item {
            --rotate: 0deg;
            --tx: 0px;
            --ty: 0px;
            --scale: 1;
            position: absolute;
            width: 160px;
            height: 226px;
            object-fit: cover;
            border-radius: 14px;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.45);
            transform: rotate(var(--rotate)) translate(var(--tx), var(--ty)) scale(var(--scale));
            transition: transform 0.3s ease;
            cursor: default;
        }

        .hero-collage-item:hover {
            --scale: 1.08;
            z-index: 10 !important;
        }

        .hero-collage-item-0 {
            --rotate: -10deg;
            --tx: -95px;
            --ty: 15px;
            z-index: 1;
        }

        .hero-collage-item-1 {
            --rotate: -3deg;
            --tx: -32px;
            --ty: -8px;
            z-index: 2;
        }

        .hero-collage-item-2 {
            --rotate: 4deg;
            --tx: 32px;
            --ty: -8px;
            z-index: 3;
        }

        .hero-collage-item-3 {
            --rotate: 11deg;
            --tx: 95px;
            --ty: 15px;
            z-index: 2;
        }

        .upd-card {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .upd-cover-link {
            display: block;
        }

        .upd-cover {
            position: relative;
            aspect-ratio: 2 / 3;
            border-radius: 14px;
            overflow: hidden;
            background: linear-gradient(160deg, #312e81 0%, #0f172a 100%);
            box-shadow: 0 10px 24px rgba(0, 0, 0, .35);
        }

        .upd-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .35s ease;
        }

        .upd-card:hover .upd-cover img {
            transform: scale(1.05);
        }

        .upd-cover-placeholder {
            position: absolute;
            inset: 0;
            display: none;
            align-items: center;
            justify-content: center;
            color: #818cf8;
            font-size: 1.8rem;
        }

        .upd-cover.is-missing .upd-cover-placeholder {
            display: flex;
        }

        .upd-cover.is-missing img {
            display: none;
        }

        .upd-badge-up {
            position: absolute;
            top: 8px;
            left: 8px;
            padding: 2px 7px;
            border-radius: 6px;
            background: #e11d48;
            color: #fff;
            font-size: .65rem;
            font-weight: 800;
            letter-spacing: .5px;
            box-shadow: 0 4px 10px rgba(225, 29, 72, .4);
        }

        .upd-title {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 2.6em;
            margin: 10px 2px 8px;
            color: #f8fafc;
            font-weight: 700;
            font-size: .92rem;
            line-height: 1.3;
            text-decoration: none;
        }

        .upd-title:hover {
            color: #67e8f9;
        }

        .upd-chapters {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-top: auto;
        }

        .upd-chapter {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
            padding: 7px 10px;
            border-radius: 10px;
            background: rgba(15, 23, 42, .7);
            border: 1px solid rgba(148, 163, 184, .12);
            color: #e2e8f0;
            text-decoration: none;
            font-size: .8rem;
            transition: border-color .15s, background .15s;
        }

        .upd-chapter:hover {
            border-color: #22d3ee;
            background: rgba(34, 211, 238, .08);
            color: #f8fafc;
        }

        .upd-chapter-no {
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .upd-chapter-time {
            color: #94a3b8;
            font-size: .72rem;
            white-space: nowrap;
        }

        .upd-empty {
            color: #64748b;
            font-size: .8rem;
            text-align: center;
            padding: 6px 0;
        }

        .pop-rank-wrap {
            position: relative;
        }

        .pop-rank {
            position: absolute;
            top: -6px;
            left: -6px;
            z-index: 3;
            min-width: 34px;
            height: 34px;
            padding: 0 8px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: .85rem;
            color: #cbd5e1;
            background: #1e293b;
            border: 1px solid #334155;
            box-shadow: 0 6px 16px rgba(0, 0, 0, .35);
        }

        .pop-rank-1 {
            color: #422006;
            background: linear-gradient(135deg, #fde68a 0%, #f59e0b 100%);
            border-color: transparent;
        }

        .pop-rank-2 {
            color: #1e293b;
            background: linear-gradient(135deg, #e2e8f0 0%, #94a3b8 100%);
            border-color: transparent;
        }

        .pop-rank-3 {
            color: #431407;
            background: linear-gradient(135deg, #fdba74 0%, #c2410c 100%);
            border-color: transparent;
        }

        .row.g-4>div:has(> .pop-rank-wrap) {
            display: flex;
        }

        .pop-rank-wrap {
            display: flex;
            width: 100%;
        }

        .pop-rank-wrap>a {
            display: flex;
            flex: 1;
            min-width: 0;
        }

        .pop-rank-wrap>a>.card {
            flex: 1;
        }

        .genre-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: center;
        }

        .genre-chip {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 16px 8px 8px;
            border-radius: 999px;
            background: rgba(30, 41, 59, .55);
            border: 1px solid rgba(148, 163, 184, .15);
            color: #e2e8f0;
            text-decoration: none;
            font-weight: 600;
            transition: transform .2s ease, border-color .2s ease, background .2s ease, box-shadow .2s ease;
        }

        .genre-chip:hover {
            color: #f8fafc;
            transform: translateY(-2px);
            border-color: rgba(34, 211, 238, .45);
            background: linear-gradient(135deg, rgba(99, 102, 241, .22), rgba(34, 211, 238, .1));
            box-shadow: 0 10px 22px rgba(0, 0, 0, .3);
        }

        .genre-chip-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: .85rem;
            color: #a5b4fc;
            background: rgba(99, 102, 241, .2);
            transition: background .2s ease, color .2s ease;
        }

        .genre-chip:hover .genre-chip-icon {
            color: #fff;
            background: linear-gradient(135deg, #6366f1 0%, #22d3ee 100%);
        }

        .genre-chip-count {
            padding: 2px 8px;
            border-radius: 999px;
            background: rgba(148, 163, 184, .12);
            color: #94a3b8;
            font-size: .72rem;
            font-weight: 700;
        }

        .genre-chip:hover .genre-chip-count {
            color: #67e8f9;
            background: rgba(34, 211, 238, .12);
        }

                .lk-scroll {
            display: flex;
            gap: 16px;
            overflow-x: auto;
            padding: 4px 2px 14px;
            scrollbar-width: thin;
        }

        .lk-card {
            flex: 0 0 170px;
            width: 170px;
            max-width: 170px;
            color: #f8fafc;
            text-decoration: none;
        }

        .lk-cover {
            position: relative;
            width: 100%;
            aspect-ratio: 2 / 3;
            border-radius: 14px;
            overflow: hidden;
            background: linear-gradient(160deg, #312e81 0%, #0f172a 100%);
            box-shadow: 0 10px 24px rgba(0, 0, 0, .35);
        }

        .lk-cover img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .3s ease;
        }

        .lk-card:hover .lk-cover img {
            transform: scale(1.05);
        }

        .lk-placeholder {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px;
            text-align: center;
            color: #c7d2fe;
            font-size: .8rem;
        }

        .lk-placeholder i {
            font-size: 1.8rem;
            color: #818cf8;
        }

        .lk-play {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(11, 17, 32, .45);
            opacity: 0;
            transition: opacity .25s ease;
        }

        .lk-play span {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #6366f1 0%, #22d3ee 100%);
            color: #fff;
            font-size: 1.4rem;
        }

        .lk-card:hover .lk-play {
            opacity: 1;
        }

        .lk-title {
            margin: 10px 0 2px;
            font-size: .95rem;
            font-weight: 600;
            color: #f8fafc;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .lk-meta {
            font-size: .82rem;
            color: #94a3b8;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
    <!-- Hero Section -->
    <section class="hero section">
        <div class="container">
            <div class="row align-items-center gy-5">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold">
                        Baca Manhwa <span class="landing-title-accent">Favoritmu</span>
                    </h1>
                    <p class="lead mt-3">
                        Temukan ribuan chapter terbaru, update setiap hari,
                        gratis dan mudah dibaca.
                    </p>
                    <div class="mt-4 d-flex flex-wrap gap-2">
                        <a href="{{ route('manhwa') }}" class="landing-cta">
                            Mulai Membaca
                        </a>
                        @guest
                            <a href="{{ route('login') }}" class="landing-cta-outline">
                                Login
                            </a>
                        @endguest
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    @forelse ($heroManhwa as $index => $manhwa)
                        @if ($loop->first)
                            <div class="hero-collage">
                        @endif

                        @if ($manhwa->cover)
                            <img src="{{ asset('storage/' . $manhwa->cover) }}"
                                class="hero-collage-item hero-collage-item-{{ $index }}" alt="{{ $manhwa->judul }}">
                        @else
                            <div class="hero-collage-item hero-collage-item-{{ $index }} hero-collage-placeholder">
                                <i class="bi bi-image"></i>
                                <span>{{ $manhwa->judul }}</span>
                            </div>
                        @endif

                        @if ($loop->last)
                </div>
                @endif
            @empty
                <div class="hero-collage-placeholder rounded-4 shadow mx-auto" style="width:260px; height:340px;">
                    <i class="bi bi-image"></i>
                    <span>{{ $siteSetting->nama_situs }}</span>
                </div>
                @endforelse
            </div>
        </div>
        </div>
    </section>

    <!-- Lanjutkan Membaca -->
    @if ($lanjutkanMembaca->isNotEmpty())
        <section class="section pt-0">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="landing-section-title">
                        <span class="landing-section-icon"><i class="bi bi-play-fill"></i></span>
                        Lanjutkan Membaca
                    </h2>
                    <a href="{{ route('library.index', ['tab' => 'riwayat']) }}" class="landing-cta-outline">
                        Lihat Semua
                    </a>
                </div>

                <div class="lk-scroll">
                    @foreach ($lanjutkanMembaca as $riwayat)
                        <a href="{{ route('chapter.read', [$riwayat->manhwa->slug, $riwayat->chapter->nomor_chapter]) }}"
                            class="lk-card">
                            <div class="lk-cover">
                                @if ($riwayat->manhwa->cover)
                                    <img src="{{ asset('storage/' . $riwayat->manhwa->cover) }}"
                                        alt="{{ $riwayat->manhwa->judul }}">
                                @else
                                    <div class="lk-placeholder">
                                        <i class="bi bi-image"></i>
                                        <span>{{ $riwayat->manhwa->judul }}</span>
                                    </div>
                                @endif
                                <div class="lk-play">
                                    <span><i class="bi bi-play-fill"></i></span>
                                </div>
                            </div>

                            <div class="lk-title">{{ $riwayat->manhwa->judul }}</div>
                            <div class="lk-meta">
                                Chapter {{ $riwayat->chapter->nomor_chapter }}
                                &middot; {{ $riwayat->updated_at->diffForHumans() }}
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

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

                                @if ($banner->judul)
                                    <div class="banner-caption">
                                        <h3 class="banner-caption-title">{{ $banner->judul }}</h3>
                                    </div>
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

    <!-- Genre Populer -->
    <section class="section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="landing-section-title">
                    <span class="landing-section-icon"><i class="bi bi-tags"></i></span>
                    Genre Populer
                </h2>
                <a href="{{ route('genre') }}" class="landing-cta-outline">
                    Lihat Semua
                </a>
            </div>

            <div class="genre-chips">
                @forelse ($genrePopuler as $genre)
                    <a href="{{ route('explore', ['genre' => $genre->id]) }}" class="genre-chip">
                        <span class="genre-chip-icon">
                            <i class="bi bi-tag"></i>
                        </span>
                        <span>{{ $genre->nama_genre }}</span>
                        <span class="genre-chip-count">{{ $genre->manhwas_count }}</span>
                    </a>
                @empty
                    <p class="text-muted mb-0">Belum ada genre.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Manhwa Populer -->
    <section class="section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="landing-section-title">
                    <span class="landing-section-icon"><i class="bi bi-fire"></i></span>
                    Manhwa Populer
                </h2>
                <a href="{{ route('populer') }}" class="landing-cta-outline">
                    Lihat Semua
                </a>
            </div>

            <div class="row g-4">
                @forelse ($manhwaPopuler as $manhwa)
                    <div class="col-lg-2 col-md-4 col-6">
                        <div class="pop-rank-wrap">
                            <span class="pop-rank pop-rank-{{ $loop->iteration }}">
                                #{{ $loop->iteration }}
                            </span>
                            <x-manhwa-card :slug="$manhwa->slug"
                                image="{{ $manhwa->cover ? asset('storage/' . $manhwa->cover) : asset('assets/blogy/assets/img/blog/blog-post-3.webp') }}"
                                title="{{ $manhwa->judul }}" rating="{{ $manhwa->rating ?? '-' }}"
                                chapter="{{ $manhwa->chapters_max_nomor_chapter ? 'Chapter ' . $manhwa->chapters_max_nomor_chapter : 'Belum ada chapter' }}" />
                        </div>
                    </div>
                @empty
                    <p class="text-muted text-center">Belum ada manhwa.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Manhwa Terbaru -->
    <section class="section" id="manhwa-terbaru">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="landing-section-title">
                    <span class="landing-section-icon"><i class="bi bi-clock-history"></i></span>
                    Manhwa Terbaru
                </h2>
                <a href="{{ route('latest') }}" class="landing-cta-outline">
                    Lihat Semua
                </a>
            </div>

            <div class="row row-cols-2 row-cols-md-3 row-cols-xl-6 g-3 g-lg-4">
                @forelse ($manhwaTerbaru as $manhwa)
                    @php
                        $chapterBaru = $manhwa->chapter_terbaru ?? collect();
                        $terbaruAt = $chapterBaru->first()?->created_at;
                        $sedangUpdate = $terbaruAt && $terbaruAt->gt(now()->subDays(3));
                    @endphp
                    <div class="col">
                        <div class="upd-card">
                            <a href="{{ route('manhwa.detail', $manhwa->slug) }}" class="upd-cover-link">
                                <div class="upd-cover {{ $manhwa->cover ? '' : 'is-missing' }}">
                                    @if ($manhwa->cover)
                                        <img src="{{ asset('storage/' . $manhwa->cover) }}" alt="{{ $manhwa->judul }}"
                                            onerror="this.closest('.upd-cover').classList.add('is-missing')">
                                    @endif
                                    <div class="upd-cover-placeholder">
                                        <i class="bi bi-image"></i>
                                    </div>
                                    @if ($sedangUpdate)
                                        <span class="upd-badge-up">UP</span>
                                    @endif
                                </div>
                            </a>

                            <a href="{{ route('manhwa.detail', $manhwa->slug) }}" class="upd-title">
                                {{ $manhwa->judul }}
                            </a>

                            <div class="upd-chapters">
                                @forelse ($chapterBaru as $chapter)
                                    @php
                                        $selisihJam = (int) $chapter->created_at->diffInHours(now());

                                        if ($selisihJam < 1) {
                                            $waktu = 'baru saja';
                                        } elseif ($selisihJam < 24) {
                                            $waktu = $selisihJam . ' jam';
                                        } elseif ($selisihJam < 24 * 7) {
                                            $waktu = intdiv($selisihJam, 24) . ' hari';
                                        } else {
                                            $waktu = $chapter->created_at->format('d M');
                                        }
                                    @endphp
                                    <a href="{{ route('chapter.read', [$manhwa->slug, $chapter->nomor_chapter]) }}"
                                        class="upd-chapter">
                                        <span class="upd-chapter-no">Chapter {{ $chapter->nomor_chapter }}</span>
                                        <span class="upd-chapter-time">{{ $waktu }}</span>
                                    </a>
                                @empty
                                    <span class="upd-empty">Belum ada chapter</span>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted py-5">
                        Belum ada manhwa terbaru.
                    </div>
                @endforelse
            </div>
            @if ($manhwaTerbaru->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $manhwaTerbaru->onEachSide(2)->fragment('manhwa-terbaru')->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
