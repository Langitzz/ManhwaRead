@extends('layouts.user')

@section('title', $manhwa->judul)

@section('content')
    <style>
        .chapter-card.sudah-dibaca {
            color: #0dcaf0 !important;
        }

        .detail-hero {
            min-height: 340px;
            overflow: hidden;
        }

        .detail-hero-bg {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            filter: blur(20px) brightness(.4);
            transform: scale(1.1);
        }

        .detail-hero-bg-empty {
            background: #000;
            filter: none;
            transform: none;
        }

        .detail-hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(11, 17, 32, .1) 0%, #0b1120 100%);
        }

        .detail-circle-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(15, 23, 42, .6);
            border: 1px solid rgba(148, 163, 184, .2);
            color: #e2e8f0;
            text-decoration: none;
            transition: border-color .15s, color .15s;
        }

        .detail-circle-btn:hover {
            border-color: #22d3ee;
            color: #f8fafc;
        }

        .detail-cover-wrap {
            padding: 3px;
            border-radius: 18px;
            background: linear-gradient(135deg, #6366f1 0%, #22d3ee 100%);
            box-shadow: 0 18px 40px rgba(0, 0, 0, .45);
        }

        .detail-cover {
            display: block;
            width: 140px;
            height: 200px;
            object-fit: cover;
            border-radius: 15px;
        }

        .detail-cover-empty {
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(160deg, #312e81 0%, #0f172a 100%);
            color: #818cf8;
            font-size: 2rem;
        }

        .detail-title {
            font-size: 2rem;
            font-weight: 800;
            color: #f8fafc;
            line-height: 1.2;
            margin-bottom: 6px;
        }

        .detail-alt {
            color: #94a3b8;
            font-size: .9rem;
            margin-bottom: 14px;
        }

        .detail-btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 18px;
            border-radius: 14px;
            border: 1px solid rgba(148, 163, 184, .3);
            background: rgba(15, 23, 42, .6);
            color: #e2e8f0;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: border-color .15s, color .15s, background .15s;
        }

        .detail-btn-outline:hover {
            border-color: #22d3ee;
            color: #f8fafc;
        }

        .detail-btn-outline.is-active {
            border-color: rgba(244, 63, 94, .5);
            background: rgba(244, 63, 94, .12);
            color: #fecaca;
        }

        .detail-btn-disabled {
            padding: 10px 18px;
            border: none;
            border-radius: 14px;
            background: #334155;
            color: #cbd5e1;
            font-weight: 600;
            opacity: .6;
        }

        .detail-stat {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 999px;
            background: rgba(15, 23, 42, .6);
            border: 1px solid rgba(148, 163, 184, .2);
            color: #e2e8f0;
            font-size: .85rem;
            font-weight: 600;
        }

                .chapter-head-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #f8fafc;
            margin: 0;
        }

        .chapter-count {
            padding: 6px 12px;
            border-radius: 999px;
            background: rgba(99, 102, 241, .2);
            border: 1px solid rgba(99, 102, 241, .35);
            color: #c7d2fe;
            font-size: .8rem;
            font-weight: 600;
        }

        .chapter-search {
            position: relative;
        }

        .chapter-search > i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            pointer-events: none;
            z-index: 2;
        }

        .chapter-search .form-control {
            height: 46px;
            padding-left: 42px;
            border-radius: 14px;
            background: rgba(15, 23, 42, .7);
            border: 1px solid rgba(148, 163, 184, .2);
            color: #f8fafc;
        }

        .chapter-search .form-control::placeholder {
            color: #64748b;
        }

        .chapter-search .form-control:focus {
            background: rgba(15, 23, 42, .9);
            color: #f8fafc;
            border-color: #22d3ee;
            box-shadow: 0 0 0 .2rem rgba(34, 211, 238, .15);
        }

        .chapter-card {
            padding: 10px !important;
            border-radius: 14px !important;
            border: 1px solid rgba(148, 163, 184, .12);
            background: rgba(30, 41, 59, .5);
            transition: transform .2s ease, border-color .2s ease, background .2s ease;
        }

        .chapter-card:hover {
            transform: translateY(-2px);
            border-color: rgba(34, 211, 238, .4);
            background: rgba(30, 41, 59, .85);
        }

        .chapter-thumb,
        .chapter-thumb-empty {
            width: 88px;
            height: 62px;
            border-radius: 10px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .chapter-thumb-empty {
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(160deg, #312e81 0%, #0f172a 100%);
            color: #818cf8;
        }

        .chapter-read-tag {
            padding: 2px 8px;
            border-radius: 999px;
            font-size: .7rem;
            font-weight: 600;
            color: #67e8f9;
            background: rgba(34, 211, 238, .12);
            border: 1px solid rgba(34, 211, 238, .3);
            white-space: nowrap;
        }

                .detail-meta h6 {
            color: #94a3b8;
            font-size: .75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .6px;
            margin-bottom: 10px;
        }

        .detail-meta .badge.bg-secondary {
            padding: 6px 12px;
            border-radius: 999px;
            font-weight: 600;
            background: rgba(99, 102, 241, .14) !important;
            color: #c7d2fe !important;
            border: 1px solid rgba(99, 102, 241, .3);
        }

                .komentar-card {
            background: rgba(30, 41, 59, .55);
            border: 1px solid rgba(148, 163, 184, .12);
            border-radius: 18px;
            padding: 24px;
            box-shadow: 0 10px 26px rgba(0, 0, 0, .2);
        }

        .komentar-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0 0 18px;
            font-size: 1.2rem;
            font-weight: 700;
            color: #f8fafc;
        }

        .komentar-title-icon {
            width: 36px;
            height: 36px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: #fff;
            background: linear-gradient(135deg, #6366f1 0%, #22d3ee 100%);
        }

        .komentar-form textarea {
            background: rgba(15, 23, 42, .7);
            border: 1px solid rgba(148, 163, 184, .2);
            border-radius: 14px;
            color: #f8fafc;
            padding: 12px 14px;
            resize: vertical;
        }

        .komentar-form textarea::placeholder {
            color: #64748b;
        }

        .komentar-form textarea:focus {
            background: rgba(15, 23, 42, .9);
            color: #f8fafc;
            border-color: #22d3ee;
            box-shadow: 0 0 0 .2rem rgba(34, 211, 238, .15);
        }

        .komentar-item {
            display: flex;
            gap: 14px;
            padding: 14px 0;
            border-top: 1px solid rgba(148, 163, 184, .1);
        }

        .komentar-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #fff;
            background: linear-gradient(135deg, #6366f1 0%, #22d3ee 100%);
        }

        .komentar-name {
            color: #f8fafc;
            font-weight: 600;
        }

        .komentar-time {
            color: #64748b;
            font-size: .8rem;
        }

        .komentar-body {
            margin: 6px 0 0;
            color: #cbd5e1;
            line-height: 1.6;
            white-space: pre-line;
            word-break: break-word;
        }

        .komentar-empty {
            text-align: center;
            color: #94a3b8;
            padding: 20px 0;
            margin: 0;
        }
    </style>

    {{-- Hero Banner (blur cover) --}}
    <section class="position-relative detail-hero">
        @if ($manhwa->cover)
            <div class="detail-hero-bg" style="background-image: url('{{ asset('storage/' . $manhwa->cover) }}');"></div>
        @else
            <div class="detail-hero-bg detail-hero-bg-empty"></div>
        @endif
        <div class="detail-hero-overlay"></div>

        <div class="position-relative container py-4" style="z-index: 1;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="javascript:history.back()" class="detail-circle-btn" title="Kembali">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <a href="{{ route('home') }}" class="detail-circle-btn" title="Beranda">
                    <i class="bi bi-house"></i>
                </a>
            </div>

            <div class="row align-items-end g-4">
                <div class="col-auto">
                    <div class="detail-cover-wrap">
                        @if ($manhwa->cover)
                            <img src="{{ asset('storage/' . $manhwa->cover) }}" class="detail-cover"
                                alt="{{ $manhwa->judul }}">
                        @else
                            <div class="detail-cover detail-cover-empty">
                                <i class="bi bi-image"></i>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col">
                    <h1 class="detail-title">{{ $manhwa->judul }}</h1>

                    @if ($manhwa->judul_alternatif)
                        <p class="detail-alt">
                            {{ str_replace("\n", ', ', $manhwa->judul_alternatif) }}
                        </p>
                    @endif

                    <div class="d-flex flex-wrap gap-2 mb-3">
                        @if ($chapterUntukBaca)
                            <a href="{{ route('chapter.read', [$manhwa->slug, $chapterUntukBaca->nomor_chapter]) }}"
                                class="landing-cta">
                                <i class="bi bi-play-fill me-1"></i>
                                Baca
                            </a>
                        @else
                            <button class="detail-btn-disabled" disabled>
                                <i class="bi bi-play-fill me-1"></i>
                                Belum Ada Chapter
                            </button>
                        @endif

                        @auth
                            <form action="{{ route('bookmark.toggle', $manhwa) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="detail-btn-outline {{ $sudahBookmark ? 'is-active' : '' }}">
                                    <i class="bi bi-bookmark{{ $sudahBookmark ? '-x' : '-plus' }}"></i>
                                    {{ $sudahBookmark ? 'Hapus Bookmark' : 'Bookmark' }}
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="detail-btn-outline">
                                <i class="bi bi-bookmark-plus"></i>
                                Bookmark
                            </a>
                        @endauth
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        @if ($manhwa->rating)
                            <span class="detail-stat">
                                <i class="bi bi-star-fill text-warning"></i>
                                {{ $manhwa->rating }}
                            </span>
                        @endif
                        <span class="detail-stat">
                            <i class="bi bi-bookmark-fill" style="color:#818cf8;"></i>
                            {{ number_format($jumlahBookmark) }}
                        </span>
                        <span class="detail-stat">
                            <i class="bi bi-eye-fill" style="color:#22d3ee;"></i>
                            {{ number_format($manhwa->views) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row">
                <div class="col-lg-12">
                    <h5 class="mb-2">Sinopsis</h5>
                    <p class="text-muted mb-1" id="sinopsis-text"
                        style="display:-webkit-box; -webkit-line-clamp:3; -webkit-box-orient:vertical; overflow:hidden;">
                        {{ $manhwa->sinopsis ?? 'Belum ada sinopsis.' }}
                    </p>
                    @if ($manhwa->sinopsis)
                        <a href="javascript:void(0)" id="toggle-sinopsis" class="small">
                            Read More
                        </a>
                    @endif
                </div>
            </div>

            <hr class="my-4">

            <div class="row g-4 detail-meta">
                <div class="col-md-4">
                    <h6 class="fw-bold">Genre</h6>
                    <div class="d-flex flex-wrap gap-1">
                        @forelse ($manhwa->genres as $genre)
                            <span class="badge bg-secondary">{{ $genre->nama_genre }}</span>
                        @empty
                            <span class="text-muted small">-</span>
                        @endforelse
                    </div>
                </div>

                <div class="col-md-4">
                    <h6 class="fw-bold">Author</h6>
                    <div class="d-flex flex-wrap gap-1">
                        @if ($manhwa->penulis)
                            <span class="badge bg-secondary">{{ $manhwa->penulis }}</span>
                        @else
                            <span class="text-muted small">-</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-4">
                    <h6 class="fw-bold">Artist</h6>
                    <div class="d-flex flex-wrap gap-1">
                        @if ($manhwa->ilustrator)
                            <span class="badge bg-secondary">{{ $manhwa->ilustrator }}</span>
                        @else
                            <span class="text-muted small">-</span>
                        @endif
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="chapter-head-title">Daftar Chapter</h5>
                <span class="chapter-count">{{ $manhwa->chapters->count() }} Chapter</span>
            </div>

            <div class="chapter-search mb-4">
                <i class="bi bi-search"></i>
                <input type="text" id="cari-chapter" class="form-control" placeholder="Cari chapter, contoh: 69 atau 76">
            </div>

            <div class="row g-3" id="daftar-chapter">
                @forelse ($manhwa->chapters as $chapter)
                    @php
                        $thumb = $chapter->thumbnail ?? $chapter->firstPage?->gambar;
                        $sudahDibaca = in_array($chapter->id, $chapterDibacaIds);
                    @endphp
                    <div class="col-md-4 chapter-item" data-nomor="{{ $chapter->nomor_chapter }}">
                        <a href="{{ route('chapter.read', [$manhwa->slug, $chapter->nomor_chapter]) }}"
                            class="d-flex align-items-center gap-3 text-decoration-none text-reset chapter-card {{ $sudahDibaca ? 'sudah-dibaca' : '' }}">
                            @if ($thumb)
                                <img src="{{ asset('storage/' . $thumb) }}" class="chapter-thumb"
                                    alt="Chapter {{ $chapter->nomor_chapter }}"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            @endif
                            <div class="chapter-thumb-empty" style="{{ $thumb ? 'display:none;' : '' }}">
                                <i class="bi bi-image"></i>
                            </div>

                            <div class="flex-grow-1" style="min-width: 0;">
                                <div class="d-flex align-items-center gap-2">
                                    <strong class="text-truncate">Chapter {{ $chapter->nomor_chapter }}</strong>
                                    @if ($sudahDibaca)
                                        <span class="chapter-read-tag">Dibaca</span>
                                    @endif
                                </div>
                                @if ($chapter->judul_chapter)
                                    <span class="d-block small text-truncate">{{ $chapter->judul_chapter }}</span>
                                @endif
                                <small class="text-muted">
                                    {{ $chapter->tanggal_rilis?->diffForHumans() ?? '-' }}
                                </small>
                            </div>
                        </a>
                    </div>
                @empty
                    <p class="text-muted mb-0">Belum ada chapter untuk manhwa ini.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Komentar --}}
    <section class="mt-4 pb-5">
        <div class="container">
            <div class="komentar-card">
                <h5 class="komentar-title">
                    <span class="komentar-title-icon">
                        <i class="bi bi-chat-dots"></i>
                    </span>
                    Komentar
                    <span class="chapter-count">{{ $komentar->count() }}</span>
                </h5>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @auth
                    <form action="{{ route('komentar.store', $manhwa->slug) }}" method="POST"
                        class="komentar-form mb-4" autocomplete="off">
                        @csrf
                        <textarea name="isi" class="form-control @error('isi') is-invalid @enderror"
                            rows="3" placeholder="Tulis komentar kamu...">{{ old('isi') }}</textarea>
                        @error('isi')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="landing-cta">
                                <i class="bi bi-send me-1"></i>
                                Kirim Komentar
                            </button>
                        </div>
                    </form>
                @else
                    <p class="mb-4" style="color:#94a3b8;">
                        <a href="{{ route('login') }}" class="fw-semibold" style="color:#67e8f9;">Login</a>
                        dulu untuk bisa berkomentar.
                    </p>
                @endauth

                @forelse ($komentar as $item)
                    @include('user.partials.komentar-node', [
                        'item' => $item,
                        'balasan' => $balasan,
                        'depth' => 0,
                        'formAction' => route('komentar.store', $manhwa->slug),
                    ])
                @empty
                    <p class="komentar-empty">Belum ada komentar. Jadilah yang pertama!</p>
                @endforelse 
            </div>
        </div>
    </section>

    <script>
        document.getElementById('toggle-sinopsis')?.addEventListener('click', function() {
            const el = document.getElementById('sinopsis-text');
            const expanded = el.style.webkitLineClamp === 'unset';
            el.style.webkitLineClamp = expanded ? '3' : 'unset';
            this.textContent = expanded ? 'Read More' : 'Read Less';
        });

        document.getElementById('cari-chapter')?.addEventListener('input', function() {
            const term = this.value.trim();
            document.querySelectorAll('.chapter-item').forEach(item => {
                const nomor = item.dataset.nomor;
                item.style.display = (term === '' || nomor.includes(term)) ? '' : 'none';
            });
        });
    </script>

@endsection
