<a href="{{ isset($slug) ? route('manhwa.detail', $slug) : '#' }}" class="text-decoration-none text-dark">
    <div class="card h-100 shadow-sm border-0">
        <div class="position-relative">
            <img src="{{ $image }}" class="card-img-top" alt="{{ $title }}"
                style="aspect-ratio: 2/3; object-fit: cover;">
            @isset($time)
                <span class="badge bg-dark bg-opacity-75 position-absolute top-0 start-0 m-1" style="font-size:10px;">
                    <i class="bi bi-clock"></i> {{ $time }}
                </span>
            @endisset
        </div>
        <div class="card-body p-2">
            <h6 class="fw-bold mb-1"
                style="font-size:12px; line-height:1.3; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
                {{ $title }}
            </h6>
            @isset($rating)
                <small class="text-warning d-block" style="font-size:11px;">
                    ⭐ {{ $rating }}
                </small>
            @endisset
            @isset($populer)
                <small class="text-primary d-block" style="font-size:11px;">
                    <i class="bi bi-bookmark-fill"></i> {{ $populer }}
                </small>
            @endisset
            @isset($chapter)
                <small class="text-muted d-block" style="font-size:11px;">
                    {{ $chapter }}
                </small>
            @endisset
        </div>
    </div>
</a>
