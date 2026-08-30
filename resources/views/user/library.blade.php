@extends('layouts.user')

@section('title', 'Library')

@section('content')

    <section class="section py-5">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="section-title mb-4">
                <h2>📚 Library</h2>
                <p>Manhwa yang kamu simpan & riwayat bacaanmu.</p>
            </div>

            <ul class="nav nav-tabs mb-4" id="libraryTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="bookmark-tab" data-bs-toggle="tab" data-bs-target="#bookmark-pane"
                        type="button" role="tab">
                        <i class="bi bi-bookmark-fill"></i>
                        Bookmark ({{ $bookmarks->count() }})
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="history-tab" data-bs-toggle="tab" data-bs-target="#history-pane"
                        type="button" role="tab">
                        <i class="bi bi-clock-history"></i>
                        Riwayat Baca ({{ $histories->count() }})
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="libraryTabContent">
                {{-- Tab Bookmark --}}
                <div class="tab-pane fade show active" id="bookmark-pane" role="tabpanel">
                    <div class="row gy-4">
                        @forelse ($bookmarks as $bookmark)
                            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                                <x-manhwa-card slug="{{ $bookmark->manhwa->slug }}"
                                    image="{{ $bookmark->manhwa->cover ? asset('storage/' . $bookmark->manhwa->cover) : asset('assets/blogy/assets/img/blog/blog-post-1.webp') }}"
                                    title="{{ $bookmark->manhwa->judul }}" />
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <i class="bi bi-bookmark fs-1 text-secondary"></i>
                                <p class="text-muted mt-3 mb-0">
                                    Belum ada manhwa yang kamu bookmark.
                                </p>
                                <a href="{{ route('explore') }}" class="btn btn-primary mt-3">
                                    Jelajahi Manhwa
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Tab History --}}
                <div class="tab-pane fade" id="history-pane" role="tabpanel">
                    <div class="list-group">
                        @forelse ($histories as $history)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $history->manhwa->judul }}</strong>
                                    <br>
                                    <small class="text-muted">
                                        Chapter {{ $history->chapter->nomor_chapter }}
                                        &middot; {{ $history->updated_at->diffForHumans() }}
                                    </small>
                                </div>
                                <a href="{{ route('manhwa.detail', $history->manhwa->slug) }}"
                                    class="btn btn-sm btn-outline-primary">
                                    Lihat Manhwa
                                </a>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <i class="bi bi-clock-history fs-1 text-secondary"></i>
                                <p class="text-muted mt-3 mb-0">
                                    Belum ada riwayat baca.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
