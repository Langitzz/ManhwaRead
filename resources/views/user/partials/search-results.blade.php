@if ($viewMode === 'list')
    <div class="list-group">
        @forelse ($manhwas as $manhwa)
            <a href="{{ route('manhwa.detail', $manhwa->slug) }}"
                class="list-group-item list-group-item-action d-flex align-items-center gap-3">
                <img src="{{ $manhwa->cover ? asset('storage/' . $manhwa->cover) : asset('assets/blogy/assets/img/blog/blog-post-1.webp') }}"
                    style="width:50px; height:70px; object-fit:cover;" class="rounded">
                <div class="flex-grow-1">
                    <strong>{{ $manhwa->judul }}</strong>
                    <br>
                    <small class="text-muted">
                        {{ $manhwa->penulis ?? '-' }}
                        &middot; {{ ucfirst($manhwa->status) }}
                        &middot; <i class="bi bi-bookmark-fill"></i> {{ $manhwa->bookmarks_count }}
                    </small>
                </div>
            </a>
        @empty
            <div class="text-center py-5">
                <i class="bi bi-inbox fs-1 text-secondary"></i>
                <p class="text-muted mt-3 mb-0">
                    Tidak ada manhwa yang cocok.
                </p>
            </div>
        @endforelse
    </div>
@else
    <div class="row gy-4">
        @forelse ($manhwas as $manhwa)
            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                <x-manhwa-card slug="{{ $manhwa->slug }}"
                    image="{{ $manhwa->cover ? asset('storage/' . $manhwa->cover) : asset('assets/blogy/assets/img/blog/blog-post-1.webp') }}"
                    title="{{ $manhwa->judul }}" populer="{{ $manhwa->bookmarks_count }}" />
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-inbox fs-1 text-secondary"></i>
                <p class="text-muted mt-3 mb-0">
                    Tidak ada manhwa yang cocok.
                </p>
            </div>
        @endforelse
    </div>
@endif

<div class="mt-4">
    {{ $manhwas->links() }}
</div>
