@extends('layouts.user')

@section('title', 'Search')

@section('content')

    <section class="py-4">
        <div class="container-fluid">
            <div class="row">
                {{-- Sidebar Filter --}}
                <div class="col-lg-3 mb-4">
                    <form method="GET" action="{{ route('search') }}" id="search-form">
                        <input type="hidden" name="view" id="hidden-view" value="{{ $viewMode }}">
                        <div id="genre-hidden-inputs"></div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="fw-bold mb-3">Genre</h6>
                                <input type="text" id="genre-search" class="form-control form-control-sm mb-2"
                                    placeholder="Cari genre...">
                                <div class="d-flex flex-wrap gap-1 mb-3" style="max-height:220px; overflow-y:auto;">
                                    @foreach ($genres as $genre)
                                        @php
                                            $state = 'none';
                                            if (in_array($genre->id, request('genre_in', []))) {
                                                $state = 'include';
                                            }
                                            if (in_array($genre->id, request('genre_ex', []))) {
                                                $state = 'exclude';
                                            }
                                            $btnClass = match ($state) {
                                                'include' => 'btn-primary',
                                                'exclude' => 'btn-danger',
                                                default => 'btn-outline-secondary',
                                            };
                                        @endphp
                                        <button type="button" class="btn btn-sm {{ $btnClass }} genre-chip"
                                            data-id="{{ $genre->id }}" data-state="{{ $state }}">
                                            {{ $genre->nama_genre }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="accordion" id="filterAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseStatus">
                                        Status
                                    </button>
                                </h2>
                                <div id="collapseStatus" class="accordion-collapse collapse show"
                                    data-bs-parent="#filterAccordion">
                                    <div class="accordion-body d-flex flex-wrap gap-1">
                                        @foreach (['ongoing' => 'Ongoing', 'completed' => 'Completed', 'hiatus' => 'Hiatus'] as $value => $label)
                                            <button type="button"
                                                class="btn btn-sm status-chip {{ in_array($value, request('status', [])) ? 'btn-primary' : 'btn-outline-secondary' }}"
                                                data-value="{{ $value }}"
                                                data-selected="{{ in_array($value, request('status', [])) ? '1' : '0' }}">
                                                {{ $label }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseAuthor">
                                        Author
                                    </button>
                                </h2>
                                <div id="collapseAuthor" class="accordion-collapse collapse"
                                    data-bs-parent="#filterAccordion">
                                    <div class="accordion-body">
                                        <div class="d-flex flex-wrap gap-1" style="max-height:180px; overflow-y:auto;">
                                            @foreach ($authors as $author)
                                                <button type="button"
                                                    class="btn btn-sm author-chip {{ in_array($author, request('penulis', [])) ? 'btn-primary' : 'btn-outline-secondary' }}"
                                                    data-value="{{ $author }}"
                                                    data-selected="{{ in_array($author, request('penulis', [])) ? '1' : '0' }}">
                                                    {{ $author }}
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseArtist">
                                        Artist
                                    </button>
                                </h2>
                                <div id="collapseArtist" class="accordion-collapse collapse"
                                    data-bs-parent="#filterAccordion">
                                    <div class="accordion-body">
                                        <div class="d-flex flex-wrap gap-1" style="max-height:180px; overflow-y:auto;">
                                            @foreach ($artists as $artist)
                                                <button type="button"
                                                    class="btn btn-sm artist-chip {{ in_array($artist, request('ilustrator', [])) ? 'btn-primary' : 'btn-outline-secondary' }}"
                                                    data-value="{{ $artist }}"
                                                    data-selected="{{ in_array($artist, request('ilustrator', [])) ? '1' : '0' }}">
                                                    {{ $artist }}
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-3">
                            <button type="button" id="reset-filter-btn" class="btn btn-outline-secondary btn-sm">
                                Reset Filter
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Main Content --}}
                <div class="col-lg-9">
                    <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
                        <div class="position-relative flex-grow-1" style="min-width:200px;">
                            <i class="bi bi-search position-absolute" style="left:12px; top:10px; opacity:.5;"></i>
                            <input type="text" id="search-q" name="q" form="search-form"
                                value="{{ request('q') }}" class="form-control ps-5" placeholder="Cari judul manhwa...">
                        </div>

                        <div class="btn-group">
                            <button type="button" id="btn-grid"
                                class="btn btn-sm {{ $viewMode === 'list' ? 'btn-outline-primary' : 'btn-primary' }}">
                                <i class="bi bi-grid-3x3-gap"></i>
                            </button>
                            <button type="button" id="btn-list"
                                class="btn btn-sm {{ $viewMode === 'list' ? 'btn-primary' : 'btn-outline-primary' }}">
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

                    <div id="active-filters" class="d-flex flex-wrap align-items-center gap-2 mb-3"
                        style="display:none;"></div>
                    <div id="search-results">
                        @include('user.partials.search-results')
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        const genreChips = document.querySelectorAll('.genre-chip');
        const genreHiddenInputs = document.getElementById('genre-hidden-inputs');
        const searchForm = document.getElementById('search-form');
        const activeFiltersBar = document.getElementById('active-filters');
        const searchResultsEl = document.getElementById('search-results');

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

        // ==================== GENRE CHIP (3 state) ====================
        function rebuildGenreHiddenInputs() {
            genreHiddenInputs.innerHTML = '';
            genreChips.forEach(chip => {
                const state = chip.dataset.state;
                const id = chip.dataset.id;
                if (state === 'include' || state === 'exclude') {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = state === 'include' ? 'genre_in[]' : 'genre_ex[]';
                    input.value = id;
                    genreHiddenInputs.appendChild(input);
                }
            });
        }

        function setGenreChipVisual(chip) {
            chip.classList.remove('btn-primary', 'btn-danger', 'btn-outline-secondary');
            if (chip.dataset.state === 'include') chip.classList.add('btn-primary');
            else if (chip.dataset.state === 'exclude') chip.classList.add('btn-danger');
            else chip.classList.add('btn-outline-secondary');
        }

        genreChips.forEach(chip => {
            chip.addEventListener('click', () => {
                let state = chip.dataset.state || 'none';
                state = state === 'none' ? 'include' : (state === 'include' ? 'exclude' : 'none');
                chip.dataset.state = state;
                setGenreChipVisual(chip);
                rebuildGenreHiddenInputs();
                buildActiveFiltersBar();
                runSearch();
            });
        });

        document.getElementById('genre-search').addEventListener('input', function() {
            const term = this.value.toLowerCase();
            genreChips.forEach(chip => {
                chip.style.display = chip.textContent.toLowerCase().includes(term) ? '' : 'none';
            });
        });

        // ==================== CHIP SEDERHANA: Status, Author, Artist ====================
        const simpleChipGroups = {
            status: {
                selector: '.status-chip',
                hiddenId: 'status-hidden-inputs',
                name: 'status[]'
            },
            author: {
                selector: '.author-chip',
                hiddenId: 'author-hidden-inputs',
                name: 'penulis[]'
            },
            artist: {
                selector: '.artist-chip',
                hiddenId: 'artist-hidden-inputs',
                name: 'ilustrator[]'
            },
        };

        function rebuildSimpleChipGroup(key) {
            const group = simpleChipGroups[key];
            const chips = document.querySelectorAll(group.selector);
            let hiddenContainer = document.getElementById(group.hiddenId);
            if (!hiddenContainer) {
                hiddenContainer = document.createElement('div');
                hiddenContainer.id = group.hiddenId;
                searchForm.appendChild(hiddenContainer);
            }
            hiddenContainer.innerHTML = '';
            chips.forEach(chip => {
                if (chip.dataset.selected === '1') {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = group.name;
                    input.value = chip.dataset.value;
                    hiddenContainer.appendChild(input);
                }
            });
        }

        function setSimpleChipVisual(chip) {
            const selected = chip.dataset.selected === '1';
            chip.classList.toggle('btn-primary', selected);
            chip.classList.toggle('btn-outline-secondary', !selected);
        }

        Object.keys(simpleChipGroups).forEach(key => {
            const group = simpleChipGroups[key];
            document.querySelectorAll(group.selector).forEach(chip => {
                chip.addEventListener('click', () => {
                    chip.dataset.selected = chip.dataset.selected === '1' ? '0' : '1';
                    setSimpleChipVisual(chip);
                    rebuildSimpleChipGroup(key);
                    buildActiveFiltersBar();
                    runSearch();
                });
            });
            rebuildSimpleChipGroup(key);
        });

        // ==================== ACTIVE FILTER PILLS ====================
        function createPill(label, isExclude, onRemove) {
            const pill = document.createElement('span');
            pill.className = 'badge rounded-pill d-inline-flex align-items-center gap-1 ' +
                (isExclude ? 'bg-danger' : 'bg-primary');
            pill.innerHTML = `<span>${label}</span>`;

            const closeBtn = document.createElement('button');
            closeBtn.type = 'button';
            closeBtn.className = 'btn-close btn-close-white';
            closeBtn.style.fontSize = '10px';
            closeBtn.setAttribute('aria-label', 'Hapus filter');
            closeBtn.addEventListener('click', onRemove);

            pill.appendChild(closeBtn);
            return pill;
        }

        function buildActiveFiltersBar() {
            activeFiltersBar.innerHTML = '';
            let hasAny = false;

            genreChips.forEach(chip => {
                if (chip.dataset.state === 'include' || chip.dataset.state === 'exclude') {
                    hasAny = true;
                    const pill = createPill(chip.textContent.trim(), chip.dataset.state === 'exclude', () => {
                        chip.dataset.state = 'none';
                        setGenreChipVisual(chip);
                        rebuildGenreHiddenInputs();
                        buildActiveFiltersBar();
                        runSearch();
                    });
                    activeFiltersBar.appendChild(pill);
                }
            });

            Object.keys(simpleChipGroups).forEach(key => {
                const group = simpleChipGroups[key];
                document.querySelectorAll(group.selector).forEach(chip => {
                    if (chip.dataset.selected === '1') {
                        hasAny = true;
                        const pill = createPill(chip.textContent.trim(), false, () => {
                            chip.dataset.selected = '0';
                            setSimpleChipVisual(chip);
                            rebuildSimpleChipGroup(key);
                            buildActiveFiltersBar();
                            runSearch();
                        });
                        activeFiltersBar.appendChild(pill);
                    }
                });
            });

            if (hasAny) {
                const clearAll = document.createElement('a');
                clearAll.href = '#';
                clearAll.textContent = 'Clear All';
                clearAll.className = 'small text-decoration-none';
                clearAll.addEventListener('click', (e) => {
                    e.preventDefault();
                    resetAllFilters();
                });
                activeFiltersBar.appendChild(clearAll);
            }

            activeFiltersBar.style.display = hasAny ? 'flex' : 'none';
        }

        function resetAllFilters() {
            genreChips.forEach(chip => {
                chip.dataset.state = 'none';
                setGenreChipVisual(chip);
            });
            Object.keys(simpleChipGroups).forEach(key => {
                document.querySelectorAll(simpleChipGroups[key].selector).forEach(chip => {
                    chip.dataset.selected = '0';
                    setSimpleChipVisual(chip);
                });
                rebuildSimpleChipGroup(key);
            });
            rebuildGenreHiddenInputs();
            buildActiveFiltersBar();
        }

        rebuildGenreHiddenInputs();
        buildActiveFiltersBar();

        // ==================== SEARCH JUDUL (live, debounce) ====================
        let searchDebounceTimer;
        document.getElementById('search-q').addEventListener('input', () => {
            clearTimeout(searchDebounceTimer);
            searchDebounceTimer = setTimeout(runSearch, 400);
        });

        // ==================== GRID / LIST TOGGLE ====================
        function updateGridListVisual(mode) {
            document.getElementById('btn-grid').classList.toggle('btn-primary', mode !== 'list');
            document.getElementById('btn-grid').classList.toggle('btn-outline-primary', mode === 'list');
            document.getElementById('btn-list').classList.toggle('btn-primary', mode === 'list');
            document.getElementById('btn-list').classList.toggle('btn-outline-primary', mode !== 'list');
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

        // ==================== RESET FILTER (sidebar) ====================
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
