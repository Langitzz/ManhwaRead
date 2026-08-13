<a href="{{ route('manhwa.detail') }}" class="text-decoration-none text-dark">
    <div class="card h-100 shadow-sm border-0">
        <img src="{{ $image }}" class="card-img-top" alt="{{ $title }}">
        <div class="card-body">
            <h6 class="fw-bold mb-2">
                {{ $title }}
            </h6>
            @isset($rating)
                <small class="text-warning">
                    ⭐ {{ $rating }}
                </small>
                <br>
            @endisset
            @isset($chapter)
                <small class="text-muted">
                    {{ $chapter }}
                </small>
                <br>
            @endisset
            @isset($time)
                <small class="text-muted">
                    {{ $time }}
                </small>
            @endisset
        </div>
    </div>
</a>