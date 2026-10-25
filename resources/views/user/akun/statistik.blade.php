@extends('layouts.user')

@section('title', 'Statistik Baca')

@push('styles')
    <style>
        .statistik-page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #f8fafc;
            margin: 0 0 20px;
        }

        .stat-card {
            background: rgba(30, 41, 59, .55);
            border: 1px solid rgba(148, 163, 184, .12);
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 8px 22px rgba(0, 0, 0, .2);
            height: 100%;
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #fff;
            background: linear-gradient(135deg, #6366f1 0%, #22d3ee 100%);
            margin-bottom: 14px;
        }

        .stat-value {
            font-size: 1.9rem;
            font-weight: 800;
            color: #f8fafc;
            line-height: 1;
        }

        .stat-label {
            color: #94a3b8;
            font-size: .9rem;
            margin-top: 6px;
        }

        .statistik-section {
            background: rgba(30, 41, 59, .55);
            border: 1px solid rgba(148, 163, 184, .12);
            border-radius: 16px;
            padding: 22px;
            box-shadow: 0 8px 22px rgba(0, 0, 0, .2);
        }

        .statistik-section-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: #f8fafc;
            margin: 0 0 14px;
        }

        .riwayat-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 0;
            border-top: 1px solid rgba(148, 163, 184, .12);
        }

        .riwayat-item:first-of-type {
            border-top: none;
        }

        .riwayat-cover {
            width: 44px;
            height: 62px;
            border-radius: 8px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .riwayat-cover-placeholder {
            width: 44px;
            height: 62px;
            border-radius: 8px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(160deg, #312e81 0%, #0f172a 100%);
            color: #818cf8;
        }

        .riwayat-judul {
            color: #f8fafc;
            font-weight: 600;
            text-decoration: none;
        }

        .riwayat-judul:hover {
            color: #67e8f9;
        }

        .riwayat-meta {
            color: #64748b;
            font-size: .85rem;
        }

        .statistik-empty {
            text-align: center;
            padding: 32px 16px;
            color: #94a3b8;
        }

        .statistik-empty i {
            font-size: 2rem;
            color: #818cf8;
        }
    </style>
@endpush

@section('content')

    <section class="section py-5">
        <div class="container">
            <div class="row gy-4">

                @include('user.akun.partials.sidebar', ['active' => 'statistik'])

                <div class="col-lg-9">
                    <h1 class="statistik-page-title">Statistik Baca</h1>

                    {{-- Kartu ringkasan --}}
                    <div class="row g-3 mb-4">
                        <div class="col-6 col-xl-3">
                            <div class="stat-card">
                                <span class="stat-icon"><i class="bi bi-book"></i></span>
                                <div class="stat-value">{{ $totalChapterDibaca }}</div>
                                <div class="stat-label">Chapter Dibaca</div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3">
                            <div class="stat-card">
                                <span class="stat-icon"><i class="bi bi-collection"></i></span>
                                <div class="stat-value">{{ $totalManhwaDibaca }}</div>
                                <div class="stat-label">Manhwa Dibaca</div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3">
                            <div class="stat-card">
                                <span class="stat-icon"><i class="bi bi-bookmark-fill"></i></span>
                                <div class="stat-value">{{ $totalBookmark }}</div>
                                <div class="stat-label">Bookmark</div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3">
                            <div class="stat-card">
                                <span class="stat-icon"><i class="bi bi-chat-left-text"></i></span>
                                <div class="stat-value">{{ $totalKomentar }}</div>
                                <div class="stat-label">Komentar</div>
                            </div>
                        </div>
                    </div>

                    {{-- Chapter terakhir dibaca --}}
                    <div class="statistik-section">
                        <h2 class="statistik-section-title">
                            <i class="bi bi-clock-history me-2" style="color:#22d3ee;"></i>
                            Terakhir Dibaca
                        </h2>

                        @forelse ($terakhirDibaca as $riwayat)
                            @if ($riwayat->chapter && $riwayat->chapter->manhwa)
                                <div class="riwayat-item">
                                    @if ($riwayat->chapter->manhwa->cover)
                                        <img src="{{ asset('storage/' . $riwayat->chapter->manhwa->cover) }}"
                                            alt="{{ $riwayat->chapter->manhwa->judul }}" class="riwayat-cover">
                                    @else
                                        <div class="riwayat-cover-placeholder">
                                            <i class="bi bi-image"></i>
                                        </div>
                                    @endif

                                    <div class="flex-grow-1">
                                        <a href="{{ route('manhwa.detail', $riwayat->chapter->manhwa->slug) }}"
                                            class="riwayat-judul">
                                            {{ $riwayat->chapter->manhwa->judul }}
                                        </a>
                                        <div class="riwayat-meta">
                                            Chapter {{ $riwayat->chapter->nomor_chapter }}
                                            &middot; {{ $riwayat->updated_at->diffForHumans() }}
                                        </div>
                                    </div>

                                    <a href="{{ route('chapter.read', [$riwayat->chapter->manhwa->slug, $riwayat->chapter->nomor_chapter]) }}"
                                        class="btn btn-outline-primary btn-sm">
                                        Baca Lagi
                                    </a>
                                </div>
                            @endif
                        @empty
                            <div class="statistik-empty">
                                <i class="bi bi-journal-x d-block mb-2"></i>
                                <p class="mb-0">Belum ada chapter yang kamu baca.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection