@if ($viewMode === 'list')
    <div class="list-group">
        @forelse ($manhwas as $manhwa)
            <a href="{{ route('manhwa.detail', $manhwa->slug) }}"
                class="list-group-item list-group-item-action search-list-item d-flex align-items-center gap-3">
                @if ($manhwa->cover)
                    <img src="{{ asset('storage/' . $manhwa->cover) }}" alt="{{ $manhwa->judul }}"
                        style="width:50px; height:70px; object-fit:cover;" class="rounded flex-shrink-0"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                @endif

                <div class="rounded flex-shrink-0 text-center"
                    style="width:50px; height:70px; display: {{ $manhwa->cover ? 'none' : 'flex' }};
                        align-items:center; justify-content:center;
                        background: linear-gradient(160deg, #312e81 0%, #0f172a 100%); color:#818cf8; font-size:1.1rem;">
                    <i class="bi bi-image"></i>
                </div>
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
                <i class="bi bi-search fs-1 text-secondary"></i>
                <p class="mt-3 mb-1 fw-semibold" style="color:#e2e8f0;">Tidak ada manhwa yang cocok.</p>
                <p class="text-muted mb-3">Coba kata kunci lain, atau hapus filter yang sedang aktif.</p>
                @if (request()->except('view'))
                    <a href="{{ route('search') }}" class="btn btn-outline-info rounded-pill px-4">
                        <i class="bi bi-arrow-counterclockwise me-1"></i>
                        Reset Filter
                    </a>
                @endif
            </div>
        @endforelse
    </div>
@else
    <div class="row gy-4">
        @forelse ($manhwas as $manhwa)
            <div class="col-lg-2 col-md-3 col-sm-4 col-6 search-card-col">
                <x-manhwa-card slug="{{ $manhwa->slug }}"
                    image="{{ $manhwa->cover ? asset('storage/' . $manhwa->cover) : asset('assets/blogy/assets/img/blog/blog-post-1.webp') }}"
                    title="{{ $manhwa->judul }}" populer="{{ $manhwa->bookmarks_count }}" />
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-search fs-1 text-secondary"></i>
                <p class="mt-3 mb-1 fw-semibold" style="color:#e2e8f0;">Tidak ada manhwa yang cocok.</p>
                <p class="text-muted mb-3">Coba kata kunci lain, atau hapus filter yang sedang aktif.</p>
                @if (request()->except('view'))
                    <a href="{{ route('search') }}" class="btn btn-outline-info rounded-pill px-4">
                        <i class="bi bi-arrow-counterclockwise me-1"></i>
                        Reset Filter
                    </a>
                @endif
            </div>
        @endforelse
    </div>
@endif

<div class="mt-4">
    {{ $manhwas->links() }}
</div>
