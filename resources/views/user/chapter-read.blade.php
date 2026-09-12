@extends('layouts.user')

@section('title', 'Baca ' . $manhwa->judul . ' Chapter ' . $chapter->nomor_chapter)

@section('content')

    <section class="section py-5">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('manhwa') }}">
                            Daftar Manhwa
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('manhwa.detail', $manhwa->slug) }}">
                            {{ $manhwa->judul }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        Chapter {{ $chapter->nomor_chapter }}
                    </li>
                </ol>
            </nav>
            <div class="mb-4">
                <a href="{{ route('manhwa.detail', $manhwa->slug) }}" class="btn btn-light border">
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>
            </div>
            <div class="text-center mb-5">
                <h2 class="fw-bold">
                    {{ $manhwa->judul }}
                </h2>
                <h5 class="text-muted">
                    Chapter {{ $chapter->nomor_chapter }}
                </h5>
            </div>
            <div class="d-flex justify-content-between mb-4">
                @if ($chapterSebelumnya)
                    <a href="{{ route('chapter.read', [$manhwa->slug, $chapterSebelumnya->nomor_chapter]) }}"
                        class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left"></i>
                        Chapter Sebelumnya
                    </a>
                @else
                    <button class="btn btn-outline-secondary" disabled>
                        <i class="bi bi-arrow-left"></i>
                        Chapter Sebelumnya
                    </button>
                @endif

                @if ($chapterSelanjutnya)
                    <a href="{{ route('chapter.read', [$manhwa->slug, $chapterSelanjutnya->nomor_chapter]) }}"
                        class="btn btn-outline-primary">
                        Chapter Selanjutnya
                        <i class="bi bi-arrow-right"></i>
                    </a>
                @else
                    <button class="btn btn-outline-secondary" disabled>
                        Chapter Selanjutnya
                        <i class="bi bi-arrow-right"></i>
                    </button>
                @endif
            </div>
            <div class="text-center">
                @foreach ($chapter->pages as $page)
                    <img src="{{ asset('storage/' . $page->gambar) }}" class="img-fluid mb-4 rounded shadow"
                        alt="Halaman {{ $page->nomor_halaman }}">
                @endforeach
            </div>
            <div class="d-flex justify-content-between mt-5">
                @if ($chapterSebelumnya)
                    <a href="{{ route('chapter.read', [$manhwa->slug, $chapterSebelumnya->nomor_chapter]) }}"
                        class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left"></i>
                        Chapter Sebelumnya
                    </a>
                @else
                    <button class="btn btn-outline-secondary" disabled>
                        <i class="bi bi-arrow-left"></i>
                        Chapter Sebelumnya
                    </button>
                @endif

                @if ($chapterSelanjutnya)
                    <a href="{{ route('chapter.read', [$manhwa->slug, $chapterSelanjutnya->nomor_chapter]) }}"
                        class="btn btn-outline-primary">
                        Chapter Selanjutnya
                        <i class="bi bi-arrow-right"></i>
                    </a>
                @else
                    <button class="btn btn-outline-secondary" disabled>
                        Chapter Selanjutnya
                        <i class="bi bi-arrow-right"></i>
                    </button>
                @endif
            </div>
        </div>
    </section>
@endsection
