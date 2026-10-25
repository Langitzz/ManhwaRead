@extends('layouts.user')

@section('title', 'Search')

@section('content')

    <style>
        .search-toolbar .form-control:focus,
        .search-toolbar .form-select:focus {
            border-color: #0dcaf0;
            box-shadow: 0 0 0 .2rem rgba(13, 202, 240, .25);
        }

        #filter-badge {
            font-size: 10px;
            transform: translate(-4px, -4px);
        }

        .search-card-col .card {
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .search-card-col .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 .75rem 1.5rem rgba(0, 0, 0, .45) !important;
        }

        .search-list-item {
            transition: box-shadow .2s ease, transform .15s ease;
        }

        .search-list-item:hover {
            transform: translateX(4px);
            box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .35);
        }

        /* ===== Toolbar pencarian ===== */
        .search-toolbar .form-control,
        .search-toolbar .form-select {
            background-color: rgba(15, 23, 42, .7);
            border: 1px solid rgba(148, 163, 184, .2);
            color: #f8fafc;
            border-radius: 999px;
        }

        .search-toolbar .form-control {
            height: 42px;
            font-size: .95rem;
        }

        .search-toolbar .form-select {
            height: 42px;
            font-size: .9rem;
        }

        .search-toolbar .form-control::placeholder {
            color: #64748b;
        }

        .search-toolbar .form-control:focus,
        .search-toolbar .form-select:focus {
            background-color: rgba(15, 23, 42, .9);
            color: #f8fafc;
            border-color: #22d3ee;
            box-shadow: 0 0 0 .2rem rgba(34, 211, 238, .15);
        }

        .search-toolbar .form-select option {
            background: #0f172a;
            color: #f8fafc;
        }

        .search-toolbar .btn-outline-info {
            border-radius: 999px;
            border-color: rgba(34, 211, 238, .4);
            color: #67e8f9;
        }

        .search-toolbar .btn-outline-info:hover {
            background: rgba(34, 211, 238, .12);
            border-color: #22d3ee;
            color: #a5f3fc;
        }

        .search-toolbar .btn-info {
            border: none;
            color: #fff;
            background: linear-gradient(135deg, #6366f1 0%, #22d3ee 100%);
        }

        .search-toolbar .btn-group .btn {
            min-width: 42px;
        }

        /* ===== Chip filter (genre, status, dll) ===== */
        .filter-chip {
            border-radius: 999px;
            padding: 4px 12px;
            font-size: .85rem;
            transition: transform .15s ease, box-shadow .15s ease;
        }

        .filter-chip.btn-outline-secondary {
            color: #cbd5e1;
            border-color: rgba(148, 163, 184, .3);
            background: transparent;
        }

        .filter-chip.btn-outline-secondary:hover {
            color: #f8fafc;
            border-color: #22d3ee;
            background: rgba(34, 211, 238, .08);
        }

        .filter-chip.btn-info {
            border: none;
            color: #fff;
            background: linear-gradient(135deg, #6366f1 0%, #22d3ee 100%);
            box-shadow: 0 6px 16px rgba(34, 211, 238, .25);
        }

        .filter-chip:active {
            transform: scale(.96);
        }

        /* ===== Pagination pencarian ===== */
        .pagination .page-link {
            background: #0f172a;
            border-color: #334155;
            color: #cbd5e1;
            border-radius: 10px !important;
            margin: 0 3px;
            min-width: 40px;
            text-align: center;
        }

        .pagination .page-link:hover {
            background: rgba(34, 211, 238, .1);
            border-color: #22d3ee;
            color: #f8fafc;
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #6366f1 0%, #22d3ee 100%);
            border-color: transparent;
            color: #fff;
            box-shadow: 0 6px 16px rgba(34, 211, 238, .25);
        }

        .pagination .page-item.disabled .page-link {
            background: transparent;
            border-color: #1e293b;
            color: #475569;
        }
    </style>

    <section class="py-4">
        <div class="container-fluid">

            <form method="GET" action="{{ route('search') }}" id="search-form">
                <input type="hidden" name="view" id="hidden-view" value="{{ $viewMode }}">
            </form>

            {{-- Toolbar --}}
            <div class="search-toolbar d-flex flex-wrap gap-2 align-items-center mb-3">
                <div class="position-relative flex-grow-1" style="min-width:200px;">
                    <i class="bi bi-search position-absolute" style="left:12px; top:10px; opacity:.5;"></i>
                    <input type="text" id="search-q" name="q" form="search-form" value="{{ request('q') }}"
                        class="form-control ps-5" placeholder="Cari judul manhwa...">
                </div>

                <button type="button" class="btn btn-outline-info position-relative" data-bs-toggle="offcanvas"
                    data-bs-target="#filterOffcanvas">
                    <i class="bi bi-funnel"></i> Filter
                    <span id="filter-badge" class="badge rounded-pill bg-info text-dark position-absolute top-0 start-100"
                        style="display:none;">0</span>
                </button>

                <div class="btn-group">
                    <button type="button" id="btn-grid"
                        class="btn btn-sm {{ $viewMode === 'list' ? 'btn-outline-info' : 'btn-info' }}">
                        <i class="bi bi-grid-3x3-gap"></i>
                    </button>
                    <button type="button" id="btn-list"
                        class="btn btn-sm {{ $viewMode === 'list' ? 'btn-info' : 'btn-outline-info' }}">
                        <i class="bi bi-list-ul"></i>
                    </button>
                </div>

                <select id="sort-select" name="sort" form="search-form" class="form-select form-select-sm"
                    style="width:auto;">
                    <option value="terbaru" @selected(request('sort', 'terbaru') == 'terbaru')>Terbaru Update
                    </option>
                    <option value="populer" @selected(request('sort') == 'populer')>Terpopuler</option>
                    <option value="judul" @selected(request('sort') == 'judul')>Judul (A-Z)</option>
                </select>
            </div>

            {{-- Active filter pills --}}
            <div id="active-filters" class="d-flex flex-wrap align-items-center gap-2 mb-3" style="display:none;"></div>

            {{-- Hasil pencarian --}}
            <div id="search-results">
                @include('user.partials.search-results')
            </div>
        </div>
    </section>

    {{-- Offcanvas Filter --}}
    <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="filterOffcanvas">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title"><i class="bi bi-funnel"></i> Filter</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <div class="accordion" id="filterAccordion">
                <div class="accordion-item bg-transparent text-white">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed bg-transparent text-white" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseGenre">
                            Genre
                        </button>
                    </h2>
                    <div id="collapseGenre" class="accordion-collapse collapse" data-bs-parent="#filterAccordion">
                        <div class="accordion-body">
                            <input type="text" id="genre-search" class="form-control form-control-sm mb-2"
                                placeholder="Cari genre...">
                            <div class="d-flex flex-wrap gap-1" style="max-height:220px; overflow-y:auto;">
                                @foreach ($genres as $genre)
                                    <button type="button"
                                        class="btn btn-sm filter-chip genre-chip {{ in_array($genre->id, request('genre', [])) ? 'btn-info' : 'btn-outline-secondary' }}"
                                        data-name="genre[]" data-value="{{ $genre->id }}"
                                        data-selected="{{ in_array($genre->id, request('genre', [])) ? '1' : '0' }}">
                                        {{ $genre->nama_genre }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion-item bg-transparent text-white">
                    <h2 class="accordion-header">
                        <button class="accordion-button bg-transparent text-white" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseStatus">
                            Status
                        </button>
                    </h2>
                    <div id="collapseStatus" class="accordion-collapse collapse show" data-bs-parent="#filterAccordion">
                        <div class="accordion-body d-flex flex-wrap gap-1">
                            @foreach (['ongoing' => 'Ongoing', 'completed' => 'Completed', 'hiatus' => 'Hiatus'] as $value => $label)
                                <button type="button"
                                    class="btn btn-sm filter-chip {{ in_array($value, request('status', [])) ? 'btn-info' : 'btn-outline-secondary' }}"
                                    data-name="status[]" data-value="{{ $value }}"
                                    data-selected="{{ in_array($value, request('status', [])) ? '1' : '0' }}">
                                    {{ $label }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="accordion-item bg-transparent text-white">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed bg-transparent text-white" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseAuthor">
                            Author
                        </button>
                    </h2>
                    <div id="collapseAuthor" class="accordion-collapse collapse" data-bs-parent="#filterAccordion">
                        <div class="accordion-body">
                            <div class="d-flex flex-wrap gap-1" style="max-height:180px; overflow-y:auto;">
                                @foreach ($authors as $author)
                                    <button type="button"
                                        class="btn btn-sm filter-chip {{ in_array($author, request('penulis', [])) ? 'btn-info' : 'btn-outline-secondary' }}"
                                        data-name="penulis[]" data-value="{{ $author }}"
                                        data-selected="{{ in_array($author, request('penulis', [])) ? '1' : '0' }}">
                                        {{ $author }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion-item bg-transparent text-white">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed bg-transparent text-white" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseArtist">
                            Artist
                        </button>
                    </h2>
                    <div id="collapseArtist" class="accordion-collapse collapse" data-bs-parent="#filterAccordion">
                        <div class="accordion-body">
                            <div class="d-flex flex-wrap gap-1" style="max-height:180px; overflow-y:auto;">
                                @foreach ($artists as $artist)
                                    <button type="button"
                                        class="btn btn-sm filter-chip {{ in_array($artist, request('ilustrator', [])) ? 'btn-info' : 'btn-outline-secondary' }}"
                                        data-name="ilustrator[]" data-value="{{ $artist }}"
                                        data-selected="{{ in_array($artist, request('ilustrator', [])) ? '1' : '0' }}">
                                        {{ $artist }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-grid gap-2 mt-4">
                <button type="button" id="reset-filter-btn" class="btn btn-outline-light btn-sm">
                    Reset Filter
                </button>
            </div>
        </div>
    </div>

    <script>
        const searchForm = document.getElementById('search-form');
        const activeFiltersBar = document.getElementById('active-filters');
        const searchResultsEl = document.getElementById('search-results');
        const filterBadge = document.getElementById('filter-badge');

        // ==================== AJAX CORE ====================
        function buildQueryString() {
            const formData = new FormData(searchForm);
            return new URLSearchParams(formData).toString();
        }

        function runSearch() {
            const url = searchForm.action + '?' + buildQueryString();
            fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.text())
                .then(html => {
                    searchResultsEl.innerHTML = html;
                    window.history.pushState({}, '', url);
                    attachPaginationHandlers();
                });
        }

        function attachPaginationHandlers() {
            searchResultsEl.querySelectorAll('.pagination a').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const url = this.href;
                    fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(res => res.text())
                        .then(html => {
                            searchResultsEl.innerHTML = html;
                            window.history.pushState({}, '', url);
                            attachPaginationHandlers();
                        });
                });
            });
        }
        attachPaginationHandlers();

        window.addEventListener('popstate', () => location.reload());

        // ==================== FILTER CHIP (generik: Genre, Status, Author, Artist) ====================
        const filterChips = document.querySelectorAll('.filter-chip');

        function setChipVisual(chip) {
            const selected = chip.dataset.selected === '1';
            chip.classList.toggle('btn-info', selected);
            chip.classList.toggle('btn-outline-secondary', !selected);
        }

        function rebuildFilterHiddenInputs() {
            let container = document.getElementById('filter-hidden-inputs');
            if (!container) {
                container = document.createElement('div');
                container.id = 'filter-hidden-inputs';
                searchForm.appendChild(container);
            }
            container.innerHTML = '';
            filterChips.forEach(chip => {
                if (chip.dataset.selected === '1') {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = chip.dataset.name;
                    input.value = chip.dataset.value;
                    container.appendChild(input);
                }
            });
        }

        function updateFilterBadge() {
            const count = document.querySelectorAll('.filter-chip[data-selected="1"]').length;
            filterBadge.textContent = count;
            filterBadge.style.display = count > 0 ? '' : 'none';
        }

        function bindChip(chip) {
            chip.addEventListener('click', () => {
                chip.dataset.selected = chip.dataset.selected === '1' ? '0' : '1';
                setChipVisual(chip);
                rebuildFilterHiddenInputs();
                buildActiveFiltersBar();
                updateFilterBadge();
                runSearch();
            });
        }
        filterChips.forEach(bindChip);
        rebuildFilterHiddenInputs();
        updateFilterBadge();

        document.getElementById('genre-search').addEventListener('input', function() {
            const term = this.value.toLowerCase();
            document.querySelectorAll('.genre-chip').forEach(chip => {
                chip.style.display = chip.textContent.toLowerCase().includes(term) ? '' : 'none';
            });
        });

        // ==================== ACTIVE FILTER PILLS ====================
        function createPill(label, onRemove) {
            const pill = document.createElement('span');
            pill.className = 'badge rounded-pill bg-info text-dark d-inline-flex align-items-center gap-1';
            pill.innerHTML = `<span>${label}</span>`;

            const closeBtn = document.createElement('button');
            closeBtn.type = 'button';
            closeBtn.className = 'btn-close';
            closeBtn.style.fontSize = '10px';
            closeBtn.setAttribute('aria-label', 'Hapus filter');
            closeBtn.addEventListener('click', onRemove);

            pill.appendChild(closeBtn);
            return pill;
        }

        function buildActiveFiltersBar() {
            activeFiltersBar.innerHTML = '';
            let hasAny = false;

            filterChips.forEach(chip => {
                if (chip.dataset.selected === '1') {
                    hasAny = true;
                    const pill = createPill(chip.textContent.trim(), () => {
                        chip.dataset.selected = '0';
                        setChipVisual(chip);
                        rebuildFilterHiddenInputs();
                        buildActiveFiltersBar();
                        updateFilterBadge();
                        runSearch();
                    });
                    activeFiltersBar.appendChild(pill);
                }
            });

            if (hasAny) {
                const clearAll = document.createElement('a');
                clearAll.href = '#';
                clearAll.textContent = 'Clear All';
                clearAll.className = 'small text-info text-decoration-none';
                clearAll.addEventListener('click', (e) => {
                    e.preventDefault();
                    resetAllFilters();
                });
                activeFiltersBar.appendChild(clearAll);
            }

            activeFiltersBar.style.display = hasAny ? 'flex' : 'none';
        }

        function resetAllFilters() {
            filterChips.forEach(chip => {
                chip.dataset.selected = '0';
                setChipVisual(chip);
            });
            rebuildFilterHiddenInputs();
            buildActiveFiltersBar();
            updateFilterBadge();
        }

        buildActiveFiltersBar();

        // ==================== SEARCH JUDUL (live, debounce) ====================
        let searchDebounceTimer;
        document.getElementById('search-q').addEventListener('input', () => {
            clearTimeout(searchDebounceTimer);
            searchDebounceTimer = setTimeout(runSearch, 400);
        });

        // ==================== GRID / LIST TOGGLE ====================
        function updateGridListVisual(mode) {
            document.getElementById('btn-grid').classList.toggle('btn-info', mode !== 'list');
            document.getElementById('btn-grid').classList.toggle('btn-outline-info', mode === 'list');
            document.getElementById('btn-list').classList.toggle('btn-info', mode === 'list');
            document.getElementById('btn-list').classList.toggle('btn-outline-info', mode !== 'list');
        }

        document.getElementById('btn-grid').addEventListener('click', () => {
            document.getElementById('hidden-view').value = 'grid';
            updateGridListVisual('grid');
            runSearch();
        });
        document.getElementById('btn-list').addEventListener('click', () => {
            document.getElementById('hidden-view').value = 'list';
            updateGridListVisual('list');
            runSearch();
        });

        // ==================== SORT ====================
        document.getElementById('sort-select').addEventListener('change', runSearch);

        // ==================== RESET FILTER (offcanvas) ====================
        document.getElementById('reset-filter-btn').addEventListener('click', () => {
            document.getElementById('search-q').value = '';
            document.getElementById('sort-select').value = 'terbaru';
            document.getElementById('hidden-view').value = 'grid';
            updateGridListVisual('grid');
            resetAllFilters();
            runSearch();
        });
    </script>
@endsection
