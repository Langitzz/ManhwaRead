@extends('layouts.user')

@section('title', 'Komentar Saya')

@push('styles')
    <style>
        .komentar-card {
            background: rgba(30, 41, 59, .55);
            border: 1px solid rgba(148, 163, 184, .12);
            border-radius: 16px;
            padding: 18px 20px;
            box-shadow: 0 8px 22px rgba(0, 0, 0, .2);
            transition: border-color .15s, transform .15s;
        }

        .komentar-card:hover {
            border-color: rgba(34, 211, 238, .3);
            transform: translateY(-1px);
        }

        .komentar-target {
            color: #f8fafc;
            font-weight: 600;
            text-decoration: none;
        }

        .komentar-target:hover {
            color: #67e8f9;
        }

        .komentar-isi {
            color: #cbd5e1;
            white-space: pre-line;
            margin: 10px 0 0;
            line-height: 1.6;
        }

        .komentar-meta {
            color: #64748b;
            font-size: .85rem;
        }

        .komentar-badge-tampil {
            background: rgba(34, 197, 94, .15);
            color: #86efac;
            border: 1px solid rgba(34, 197, 94, .3);
        }

        .komentar-badge-hidden {
            background: rgba(248, 113, 113, .12);
            color: #fca5a5;
            border: 1px solid rgba(248, 113, 113, .3);
        }

        .komentar-badge-tampil,
        .komentar-badge-hidden {
            font-size: .75rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 999px;
        }

        .komentar-empty {
            text-align: center;
            padding: 48px 20px;
            color: #94a3b8;
            background: rgba(30, 41, 59, .55);
            border: 1px dashed rgba(148, 163, 184, .25);
            border-radius: 16px;
        }

        .komentar-empty i {
            font-size: 2.2rem;
            color: #818cf8;
        }

        .komentar-page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #f8fafc;
            margin: 0;
        }

        .komentar-page-title .badge {
            font-size: .8rem;
            vertical-align: middle;
        }

        .pagination .page-link {
            background: #0f172a;
            border-color: #334155;
            color: #cbd5e1;
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #6366f1 0%, #22d3ee 100%);
            border-color: transparent;
            color: #fff;
        }
    </style>
@endpush

@section('content')

    <section class="section py-5">
        <div class="container">
            <div class="row gy-4">

                @include('user.akun.partials.sidebar', ['active' => 'komentar'])

                <div class="col-lg-9">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h1 class="komentar-page-title">
                            Komentar Saya
                            <span class="badge bg-secondary ms-1">{{ $comments->total() }}</span>
                        </h1>
                    </div>

                    @forelse ($comments as $comment)
                        <div class="komentar-card mb-3">
                            <div class="d-flex justify-content-between align-items-start gap-3 flex-wrap">
                                <div>
                                    <a href="{{ route('manhwa.detail', $comment->manhwa->slug) }}" class="komentar-target">
                                        {{ $comment->manhwa->judul }}
                                    </a>

                                    @if ($comment->chapter)
                                        <span class="komentar-meta ms-1">
                                            &middot;
                                            <a href="{{ route('chapter.read', [$comment->manhwa->slug, $comment->chapter->nomor_chapter]) }}"
                                                class="komentar-target">
                                                Chapter {{ $comment->chapter->nomor_chapter }}
                                            </a>
                                        </span>
                                    @endif
                                </div>

                                @if ($comment->status)
                                    <span class="komentar-badge-tampil">
                                        <i class="bi bi-check-circle me-1"></i>Tampil
                                    </span>
                                @else
                                    <span class="komentar-badge-hidden">
                                        <i class="bi bi-eye-slash me-1"></i>Disembunyikan moderator
                                    </span>
                                @endif
                            </div>

                            <p class="komentar-isi">{{ $comment->isi }}</p>

                            <div class="komentar-meta mt-2">
                                <i class="bi bi-clock me-1"></i>{{ $comment->created_at->diffForHumans() }}
                            </div>
                        </div>
                    @empty
                        <div class="komentar-empty">
                            <i class="bi bi-chat-left-dots d-block mb-3"></i>
                            <p class="mb-2 fw-semibold" style="color:#e2e8f0;">Kamu belum pernah berkomentar.</p>
                            <p class="mb-3">Tulis pendapatmu di halaman manhwa atau chapter yang kamu baca.</p>
                            <a href="{{ route('explore') }}" class="btn btn-outline-primary">Jelajahi Manhwa</a>
                        </div>
                    @endforelse

                    @if ($comments->hasPages())
                        <div class="mt-4 d-flex justify-content-center">
                            {{ $comments->links() }}
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </section>

@endsection