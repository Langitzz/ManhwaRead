@extends('layouts.user')

@section('title', $manhwa->judul)

@section('content')
    <style>
        .chapter-card.sudah-dibaca {
            color: #0dcaf0 !important;
        }
    </style>

    {{-- Hero Banner (blur cover) --}}
    <section class="position-relative" style="min-height:340px; overflow:hidden;">
        @if ($manhwa->cover)
            <div
                style="
                position:absolute; inset:0;
                background-image:url('{{ asset('storage/' . $manhwa->cover) }}');
                background-size:cover; background-position:center;
                filter:blur(20px) brightness(0.4);
                transform:scale(1.1);
            ">
            </div>
        @else
            <div style="position:absolute; inset:0; background:#000;"></div>
        @endif

        <div class="position-relative container py-4" style="z-index:1;">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="javascript:history.back()" class="btn btn-dark btn-sm rounded-circle"
                    style="width:40px; height:40px;">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <a href="{{ route('home') }}" class="btn btn-dark btn-sm rounded-circle" style="width:40px; height:40px;">
                    <i class="bi bi-house"></i>
                </a>
            </div>

            <div class="row align-items-end">
                <div class="col-auto">
                    @if ($manhwa->cover)
                        <img src="{{ asset('storage/' . $manhwa->cover) }}" class="rounded shadow"
                            style="width:140px; height:200px; object-fit:cover;" alt="{{ $manhwa->judul }}">
                    @else
                        <div class="rounded shadow bg-secondary d-flex align-items-center justify-content-center"
                            style="width:140px; height:200px;">
                            <i class="bi bi-image fs-1"></i>
                        </div>
                    @endif
                </div>

                <div class="col">
                    <h1 class="fw-bold mb-2 text-white">
                        {{ $manhwa->judul }}
                    </h1>

                    @if ($manhwa->judul_alternatif)
                        <p class="text-white-50 mb-3 small">
                            {{ str_replace("\n", ', ', $manhwa->judul_alternatif) }}
                        </p>
                    @endif

                    <div class="d-flex flex-wrap gap-2 mb-3">
                        @if ($chapterUntukBaca)
                            <a href="{{ route('chapter.read', [$manhwa->slug, $chapterUntukBaca->nomor_chapter]) }}"
                                class="btn btn-primary">
                                <i class="bi bi-play-fill"></i>
                                Baca
                            </a>
                        @else
                            <button class="btn btn-primary" disabled>
                                <i class="bi bi-play-fill"></i>
                                Belum Ada Chapter
                            </button>
                        @endif

                        @auth
                            <form action="{{ route('bookmark.toggle', $manhwa) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn {{ $sudahBookmark ? 'btn-danger' : 'btn-dark' }}">
                                    <i class="bi bi-bookmark{{ $sudahBookmark ? '-x' : '-plus' }}"></i>
                                    {{ $sudahBookmark ? 'Hapus Bookmark' : 'Bookmark' }}
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-dark">
                                <i class="bi bi-bookmark-plus"></i>
                                Bookmark
                            </a>
                        @endauth
                    </div>

                    <div class="d-flex flex-wrap gap-3 text-white-50 small">
                        @if ($manhwa->rating)
                            <span><i class="bi bi-star-fill text-warning"></i> {{ $manhwa->rating }}</span>
                        @endif
                        <span><i class="bi bi-bookmark-fill text-primary"></i> {{ number_format($jumlahBookmark) }}</span>
                        <span><i class="bi bi-eye-fill"></i> {{ number_format($manhwa->views) }}</span>
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

            <div class="row g-4">
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
                <h5 class="mb-0">Daftar Chapter</h5>
                <span class="badge bg-primary">
                    {{ $manhwa->chapters->count() }} Chapter
                </span>
            </div>

            <div class="mb-3">
                <input type="text" id="cari-chapter" class="form-control" placeholder="Cari Chapter, Contoh: 69 atau 76">
            </div>

            <div class="row g-3" id="daftar-chapter">
                @forelse ($manhwa->chapters as $chapter)
                    @php
                        $thumb = $chapter->thumbnail ?? $chapter->firstPage?->gambar;
                        $sudahDibaca = in_array($chapter->id, $chapterDibacaIds);
                    @endphp
                    <div class="col-md-4 chapter-item" data-nomor="{{ $chapter->nomor_chapter }}">
                        <a href="{{ route('chapter.read', [$manhwa->slug, $chapter->nomor_chapter]) }}"
                            class="d-flex align-items-center gap-3 p-2 rounded text-decoration-none text-reset chapter-card {{ $sudahDibaca ? 'sudah-dibaca' : '' }}">
                            @if ($thumb)
                                <img src="{{ asset('storage/' . $thumb) }}"
                                    style="width:80px; height:60px; object-fit:cover;" class="rounded"
                                    alt="Chapter {{ $chapter->nomor_chapter }}">
                            @else
                                <div class="rounded bg-secondary d-flex align-items-center justify-content-center"
                                    style="width:80px; height:60px;">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif
                            <div>
                                <strong class="d-block">
                                    Chapter {{ $chapter->nomor_chapter }}
                                </strong>
                                @if ($chapter->judul_chapter)
                                    <span class="d-block small">
                                        {{ $chapter->judul_chapter }}
                                    </span>
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
