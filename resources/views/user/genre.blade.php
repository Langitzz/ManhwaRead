@extends('layouts.user')

@section('title', 'Genre')

@push('styles')
    <style>
        .genre-hero {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .genre-hero-icon {
            width: 64px;
            height: 64px;
            border-radius: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.7rem;
            color: #fff;
            background: linear-gradient(135deg, #6366f1 0%, #22d3ee 100%);
            box-shadow: 0 12px 26px rgba(99, 102, 241, .3);
        }

        .genre-hero-title {
            margin: 14px 0 6px;
            font-size: 1.8rem;
            font-weight: 800;
            color: #f8fafc;
        }

        .genre-hero-sub {
            margin: 0;
            color: #94a3b8;
        }

        .genre-tile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px 18px;
            border-radius: 16px;
            text-decoration: none;
            color: #e2e8f0;
            font-weight: 600;
            background: rgba(30, 41, 59, .55);
            border: 1px solid rgba(148, 163, 184, .14);
            transition: transform .2s ease, border-color .2s ease, box-shadow .2s ease, background .2s ease;
        }

        .genre-tile-icon {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            background: rgba(99, 102, 241, .18);
            color: #a5b4fc;
            transition: background .2s ease, color .2s ease;
        }

        .genre-tile-name {
            flex: 1;
            min-width: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .genre-tile-arrow {
            color: #64748b;
            transition: transform .2s ease, color .2s ease;
        }

        .genre-tile:hover,
        .genre-tile:focus {
            color: #f8fafc;
            transform: translateY(-3px);
            border-color: rgba(34, 211, 238, .45);
            background: linear-gradient(135deg, rgba(99, 102, 241, .22), rgba(34, 211, 238, .1));
            box-shadow: 0 14px 28px rgba(0, 0, 0, .3);
        }

        .genre-tile:hover .genre-tile-icon {
            background: linear-gradient(135deg, #6366f1 0%, #22d3ee 100%);
            color: #fff;
        }

        .genre-tile:hover .genre-tile-arrow {
            color: #22d3ee;
            transform: translateX(4px);
        }

        @media (prefers-reduced-motion: reduce) {
            .genre-tile,
            .genre-tile-icon,
            .genre-tile-arrow {
                transition: none !important;
            }
        }
    </style>
@endpush

@section('content')
    <section class="section py-5">
        <div class="container">
            <div class="genre-hero">
                <span class="genre-hero-icon">
                    <i class="bi bi-tags"></i>
                </span>
                <h2 class="genre-hero-title">Genre Manhwa</h2>
                <p class="genre-hero-sub">Pilih genre favoritmu.</p>
            </div>

            <div class="row g-3">
                @forelse ($genres as $genre)
                    <div class="col-lg-3 col-md-4 col-6">
                        <a href="{{ route('explore', ['genre' => $genre->id]) }}" class="genre-tile">
                            <span class="genre-tile-icon">
                                <i class="bi bi-tag"></i>
                            </span>
                            <span class="genre-tile-name">{{ $genre->nama_genre }}</span>
                            <i class="bi bi-arrow-right genre-tile-arrow"></i>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted py-5">
                        <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                        Belum ada genre yang tersedia.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection