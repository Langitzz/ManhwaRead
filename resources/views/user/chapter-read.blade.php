@extends('layouts.user')

@section('title', 'Chapter ' . $chapter->nomor_chapter . ' - ' . $manhwa->judul)

@push('styles')
    <style>
        /* Mode baca: sembunyikan navbar situs */
        #header,
        header.header {
            display: none !important;
        }

        body {
            background: #0b1120;
        }

        /* ===== Bar progres ===== */
        .rd-progress {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            z-index: 1050;
            background: rgba(148, 163, 184, .1);
        }

        .rd-progress-bar {
            height: 100%;
            width: 0;
            background: linear-gradient(90deg, #6366f1 0%, #22d3ee 100%);
            box-shadow: 0 0 10px rgba(34, 211, 238, .5);
        }

        /* ===== Bar atas ===== */
        .rd-topbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            box-sizing: border-box;
            z-index: 1040;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 10px 16px;
            background: rgba(11, 17, 32, .85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(148, 163, 184, .1);
            transition: transform .25s ease;
        }

        .rd-topbar.is-hidden {
            transform: translateY(-100%);
        }

        .rd-icon-btn {
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(30, 41, 59, .7);
            border: 1px solid rgba(148, 163, 184, .18);
            color: #e2e8f0;
            text-decoration: none;
            transition: border-color .15s, color .15s;
        }

        .rd-icon-btn:hover {
            color: #f8fafc;
            border-color: #22d3ee;
        }

        .rd-crumb {
            min-width: 0;
            flex: 1;
            text-align: center;
            font-size: .9rem;
            font-weight: 600;
            color: #cbd5e1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .rd-crumb a {
            color: #cbd5e1;
            text-decoration: none;
        }

        .rd-crumb a:hover {
            color: #67e8f9;
        }

        .rd-crumb-sep {
            color: #475569;
            margin: 0 6px;
        }

        .rd-crumb-current {
            color: #67e8f9;
        }

        /* ===== Area baca ===== */
        .rd-stage {
            margin: 0 auto;
            max-width: 860px;
            padding-top: 60px;
            transition: max-width .3s ease;
        }

        .rd-stage.rd-w-sm {
            max-width: 620px;
        }

        .rd-stage.rd-w-lg {
            max-width: 1080px;
        }

        .rd-header {
            padding: 28px 16px 18px;
            text-align: center;
        }

        .rd-header-chapter {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 999px;
            background: rgba(99, 102, 241, .16);
            border: 1px solid rgba(99, 102, 241, .35);
            color: #c7d2fe;
            font-size: .8rem;
            font-weight: 700;
        }

        .rd-header-title {
            margin: 10px 0 0;
            font-size: 1.3rem;
            font-weight: 700;
            color: #f8fafc;
        }

        .rd-pages img {
            display: block;
            width: 100%;
            height: auto;
            margin: 0;
        }

        .rd-empty {
            padding: 80px 16px;
            text-align: center;
            color: #64748b;
        }

        .rd-end {
            padding: 28px 16px 12px;
            text-align: center;
            color: #94a3b8;
            font-size: .9rem;
        }

        /* ===== Dock melayang ===== */
        .rd-dock {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1040;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 10px;
            border-radius: 999px;
            background: rgba(15, 23, 42, .88);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(148, 163, 184, .18);
            box-shadow: 0 16px 40px rgba(0, 0, 0, .5);
        }

        .rd-dock-btn {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            background: rgba(148, 163, 184, .1);
            color: #e2e8f0;
            font-size: 1.05rem;
            text-decoration: none;
            transition: background .15s, color .15s, transform .15s;
        }

        .rd-dock-btn:hover {
            background: rgba(34, 211, 238, .15);
            color: #67e8f9;
        }

        .rd-dock-btn.is-main {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #6366f1 0%, #22d3ee 100%);
            color: #fff;
            box-shadow: 0 8px 20px rgba(34, 211, 238, .3);
        }

        .rd-dock-btn.is-main:hover {
            color: #fff;
            background: linear-gradient(135deg, #6366f1 0%, #22d3ee 100%);
            transform: scale(1.05);
        }

        .rd-dock-btn.is-active {
            background: rgba(34, 211, 238, .2);
            color: #67e8f9;
        }

        .rd-dock-btn.is-disabled {
            opacity: .35;
            pointer-events: none;
        }

        /* ===== Pengaturan ===== */
        .rd-settings {
            position: fixed;
            bottom: 84px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1041;
            display: none;
            padding: 14px 16px;
            border-radius: 16px;
            background: rgba(15, 23, 42, .95);
            border: 1px solid rgba(148, 163, 184, .18);
            box-shadow: 0 16px 40px rgba(0, 0, 0, .5);
            min-width: 240px;
        }

        .rd-settings.is-open {
            display: block;
        }

        .rd-settings-label {
            font-size: .72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .6px;
            color: #64748b;
            margin-bottom: 8px;
        }

        .rd-seg {
            display: flex;
            gap: 6px;
        }

        .rd-seg button {
            flex: 1;
            padding: 6px 8px;
            border-radius: 10px;
            border: 1px solid rgba(148, 163, 184, .2);
            background: transparent;
            color: #cbd5e1;
            font-size: .8rem;
            font-weight: 600;
        }

        .rd-seg button.is-active {
            border-color: transparent;
            background: linear-gradient(135deg, #6366f1 0%, #22d3ee 100%);
            color: #fff;
        }

        /* ===== Tombol ke atas ===== */
        .rd-totop {
            position: fixed;
            right: 20px;
            bottom: 96px;
            z-index: 1039;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: none;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(148, 163, 184, .2);
            background: rgba(15, 23, 42, .9);
            color: #e2e8f0;
        }

        .rd-totop.is-visible {
            display: inline-flex;
        }

        .rd-totop:hover {
            border-color: #22d3ee;
            color: #67e8f9;
        }

        /* ===== Modal daftar chapter ===== */
        .rd-modal .modal-content {
            background: #1e293b;
            color: #f8fafc;
            border: 1px solid rgba(148, 163, 184, .15);
            border-radius: 18px;
        }

        .rd-modal .modal-header {
            border-color: #334155;
        }

        .rd-search-row {
            display: flex;
            gap: 8px;
            margin-bottom: 14px;
        }

        .rd-search-row .form-control {
            height: 42px;
            border-radius: 12px;
            background: rgba(15, 23, 42, .7);
            border: 1px solid rgba(148, 163, 184, .2);
            color: #f8fafc;
        }

        .rd-search-row .form-control::placeholder {
            color: #64748b;
        }

        .rd-search-row .form-control:focus {
            background: rgba(15, 23, 42, .9);
            color: #f8fafc;
            border-color: #22d3ee;
            box-shadow: 0 0 0 .2rem rgba(34, 211, 238, .15);
        }

        .rd-sort-btn {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            border-radius: 12px;
            border: 1px solid rgba(148, 163, 184, .2);
            background: rgba(15, 23, 42, .7);
            color: #cbd5e1;
        }

        .rd-list {
            max-height: 58vh;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 8px;
            padding-right: 4px;
        }

        .rd-list-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            padding: 12px 14px;
            border-radius: 12px;
            background: rgba(15, 23, 42, .6);
            border: 1px solid rgba(148, 163, 184, .1);
            color: #e2e8f0;
            text-decoration: none;
            font-weight: 600;
            transition: border-color .15s, background .15s;
        }

        .rd-list-item small {
            color: #64748b;
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 50%;
        }

        .rd-list-item:hover {
            border-color: rgba(34, 211, 238, .4);
            background: rgba(34, 211, 238, .06);
            color: #f8fafc;
        }

        .rd-list-item.is-active {
            border-color: #22d3ee;
            background: rgba(34, 211, 238, .12);
            color: #67e8f9;
        }

        .rd-list-empty {
            text-align: center;
            color: #64748b;
            padding: 20px 0;
        }

        /* ===== Komentar chapter ===== */
        .rd-comments {
            max-width: 860px;
            margin: 24px auto 0;
            padding: 0 16px 120px;
        }

        .komentar-card {
            background: rgba(30, 41, 59, .55);
            border: 1px solid rgba(148, 163, 184, .12);
            border-radius: 18px;
            padding: 24px;
            box-shadow: 0 10px 26px rgba(0, 0, 0, .2);
        }

        .komentar-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0 0 18px;
            font-size: 1.2rem;
            font-weight: 700;
            color: #f8fafc;
        }

        .komentar-title-icon {
            width: 36px;
            height: 36px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: #fff;
            background: linear-gradient(135deg, #6366f1 0%, #22d3ee 100%);
        }

        .komentar-count {
            padding: 4px 10px;
            border-radius: 999px;
            background: rgba(99, 102, 241, .2);
            border: 1px solid rgba(99, 102, 241, .35);
            color: #c7d2fe;
            font-size: .75rem;
            font-weight: 600;
        }

        .komentar-form textarea {
            background: rgba(15, 23, 42, .7);
            border: 1px solid rgba(148, 163, 184, .2);
            border-radius: 14px;
            color: #f8fafc;
            padding: 12px 14px;
            resize: vertical;
        }

        .komentar-form textarea::placeholder {
            color: #64748b;
        }

        .komentar-form textarea:focus {
            background: rgba(15, 23, 42, .9);
            color: #f8fafc;
            border-color: #22d3ee;
            box-shadow: 0 0 0 .2rem rgba(34, 211, 238, .15);
        }

        .komentar-empty {
            text-align: center;
            color: #94a3b8;
            padding: 20px 0;
            margin: 0;
        }

        @media (max-width: 576px) {
            .rd-dock {
                gap: 4px;
                padding: 6px 8px;
            }

            .rd-dock-btn {
                width: 38px;
                height: 38px;
            }

            .rd-dock-btn.is-main {
                width: 44px;
                height: 44px;
            }

            .rd-crumb-sep,
            .rd-crumb-judul {
                display: none;
            }
        }
    </style>
@endpush

@section('content')
    <div class="rd-progress">
        <div class="rd-progress-bar" id="rd-progress-bar"></div>
    </div>

    {{-- Bar atas --}}
    <div class="rd-topbar">
        <button type="button" class="rd-icon-btn" onclick="history.back()" title="Kembali">
            <i class="bi bi-arrow-left"></i>
        </button>

        <div class="rd-crumb">
            <a href="{{ route('manhwa.detail', $manhwa->slug) }}" class="rd-crumb-judul">{{ $manhwa->judul }}</a>
            <span class="rd-crumb-sep"><i class="bi bi-chevron-right"></i></span>
            <span class="rd-crumb-current">Chapter {{ $chapter->nomor_chapter }}</span>
        </div>

        <a href="{{ route('home') }}" class="rd-icon-btn" title="Beranda">
            <i class="bi bi-house"></i>
        </a>
    </div>

    <div class="rd-stage" id="rd-stage">
        {{-- Judul chapter --}}
        <div class="rd-header">
            <span class="rd-header-chapter">Chapter {{ $chapter->nomor_chapter }}</span>
            @if ($chapter->judul_chapter)
                <h1 class="rd-header-title">{{ $chapter->judul_chapter }}</h1>
            @endif
        </div>

        {{-- Halaman --}}
        <div class="rd-pages">
            @forelse ($chapter->pages as $page)
                <img src="{{ asset('storage/' . $page->gambar) }}" alt="Halaman {{ $loop->iteration }}" loading="lazy">
            @empty
                <div class="rd-empty">
                    <i class="bi bi-images fs-1 d-block mb-3"></i>
                    Halaman untuk chapter ini belum tersedia.
                </div>
            @endforelse
        </div>

        <div class="rd-end">
            Sudah sampai akhir chapter.
            @if ($chapterSelanjutnya)
                <br>Lanjut ke <strong>Chapter {{ $chapterSelanjutnya->nomor_chapter }}</strong> di bawah atau pakai tombol
                di dock.
            @else
                <br>Ini chapter terbaru untuk saat ini.
            @endif
        </div>
    </div>

    {{-- Dock melayang --}}
    <div class="rd-dock">
        @if ($chapterSebelumnya)
            <a href="{{ route('chapter.read', [$manhwa->slug, $chapterSebelumnya->nomor_chapter]) }}" class="rd-dock-btn"
                title="Chapter sebelumnya">
                <i class="bi bi-chevron-left"></i>
            </a>
        @else
            <span class="rd-dock-btn is-disabled" title="Tidak ada chapter sebelumnya">
                <i class="bi bi-chevron-left"></i>
            </span>
        @endif

        <button type="button" class="rd-dock-btn" id="rd-btn-settings" title="Pengaturan">
            <i class="bi bi-gear"></i>
        </button>

        <button type="button" class="rd-dock-btn" id="rd-btn-auto" title="Auto scroll">
            <i class="bi bi-play-fill" id="rd-auto-icon"></i>
        </button>

        <button type="button" class="rd-dock-btn is-main" data-bs-toggle="modal" data-bs-target="#rdModalChapter"
            title="Daftar chapter">
            <i class="bi bi-list-ul"></i>
        </button>

        @if ($chapterSelanjutnya)
            <a href="{{ route('chapter.read', [$manhwa->slug, $chapterSelanjutnya->nomor_chapter]) }}" class="rd-dock-btn"
                title="Chapter selanjutnya">
                <i class="bi bi-chevron-right"></i>
            </a>
        @else
            <span class="rd-dock-btn is-disabled" title="Tidak ada chapter selanjutnya">
                <i class="bi bi-chevron-right"></i>
            </span>
        @endif
    </div>

    {{-- Panel pengaturan --}}
    <div class="rd-settings" id="rd-settings">
        <div class="rd-settings-label">Lebar halaman</div>
        <div class="rd-seg" id="rd-width-seg">
            <button type="button" data-width="sm">Sempit</button>
            <button type="button" data-width="md">Sedang</button>
            <button type="button" data-width="lg">Lebar</button>
        </div>
    </div>

    {{-- Tombol ke atas --}}
    <button type="button" class="rd-totop" id="rd-totop" title="Ke atas">
        <i class="bi bi-arrow-up"></i>
    </button>

    {{-- Modal daftar chapter --}}
    <div class="modal fade rd-modal" id="rdModalChapter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Daftar Chapter</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="rd-search-row">
                        <input type="text" id="rd-cari-chapter" class="form-control"
                            placeholder="Cari nomor atau judul chapter...">
                        <button type="button" class="rd-sort-btn" id="rd-sort" title="Urutkan">
                            <i class="bi bi-arrow-down"></i>
                        </button>
                    </div>

                    <div class="rd-list" id="rd-list">
                        @foreach ($daftarChapter as $item)
                            <a href="{{ route('chapter.read', [$manhwa->slug, $item->nomor_chapter]) }}"
                                class="rd-list-item {{ $item->id === $chapter->id ? 'is-active' : '' }}"
                                data-cari="{{ strtolower('chapter ' . $item->nomor_chapter . ' ' . ($item->judul_chapter ?? '')) }}">
                                <span>Chapter {{ $item->nomor_chapter }}</span>
                                @if ($item->judul_chapter)
                                    <small>{{ $item->judul_chapter }}</small>
                                @endif
                            </a>
                        @endforeach
                        <div class="rd-list-empty d-none" id="rd-list-kosong">Chapter tidak ditemukan.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Komentar chapter --}}
    <div class="rd-comments">
        <div class="komentar-card">
            <h5 class="komentar-title">
                <span class="komentar-title-icon">
                    <i class="bi bi-chat-dots"></i>
                </span>
                Komentar Chapter {{ $chapter->nomor_chapter }}
                <span class="komentar-count">{{ $komentar->count() }}</span>
            </h5>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @auth
                <form action="{{ route('komentar.store.chapter', [$manhwa->slug, $chapter->nomor_chapter]) }}" method="POST"
                    class="komentar-form mb-4" autocomplete="off">
                    @csrf
                    <textarea name="isi" class="form-control @error('isi') is-invalid @enderror" rows="3"
                        placeholder="Tulis komentar untuk chapter ini...">{{ old('isi') }}</textarea>
                    @error('isi')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="landing-cta">
                            <i class="bi bi-send me-1"></i>
                            Kirim Komentar
                        </button>
                    </div>
                </form>
            @else
                <p class="mb-4" style="color:#94a3b8;">
                    <a href="{{ route('login') }}" class="fw-semibold" style="color:#67e8f9;">Login</a>
                    dulu untuk bisa berkomentar.
                </p>
            @endauth

            @forelse ($komentar as $item)
                @include('user.partials.komentar-node', [
                    'item' => $item,
                    'balasan' => $balasan,
                    'depth' => 0,
                    'formAction' => route('komentar.store.chapter', [$manhwa->slug, $chapter->nomor_chapter]),
                ])
            @empty
                <p class="komentar-empty">Belum ada komentar di chapter ini. Jadilah yang pertama!</p>
            @endforelse
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (function() {
            const urlTemplate = @json(route('chapter.read', [$manhwa->slug, '__NOMOR__']));
            const prevUrl = @json($chapterSebelumnya ? route('chapter.read', [$manhwa->slug, $chapterSebelumnya->nomor_chapter]) : null);
            const nextUrl = @json($chapterSelanjutnya ? route('chapter.read', [$manhwa->slug, $chapterSelanjutnya->nomor_chapter]) : null);
            const detailUrl = @json(route('manhwa.detail', $manhwa->slug));

            // ----- Bar progres & tombol ke atas -----
            const bar = document.getElementById('rd-progress-bar');
            const totop = document.getElementById('rd-totop');
            const topbar = document.querySelector('.rd-topbar');
            let lastScroll = window.scrollY;

            function updateScroll() {
                const max = document.documentElement.scrollHeight - window.innerHeight;
                const persen = max > 0 ? (window.scrollY / max) * 100 : 0;
                bar.style.width = Math.min(persen, 100) + '%';
                totop.classList.toggle('is-visible', window.scrollY > 600);

                // Bar atas sembunyi saat scroll ke bawah, muncul lagi saat scroll ke atas
                const sekarang = window.scrollY;
                if (sekarang > lastScroll && sekarang > 80) {
                    topbar.classList.add('is-hidden');
                } else if (sekarang < lastScroll) {
                    topbar.classList.remove('is-hidden');
                }
                lastScroll = sekarang;
            }
            window.addEventListener('scroll', updateScroll, { passive: true });
            updateScroll();

            totop.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // ----- Lebar halaman (disimpan di browser) -----
            const stage = document.getElementById('rd-stage');
            const seg = document.getElementById('rd-width-seg');

            function setWidth(ukuran) {
                stage.classList.remove('rd-w-sm', 'rd-w-lg');
                if (ukuran === 'sm') stage.classList.add('rd-w-sm');
                if (ukuran === 'lg') stage.classList.add('rd-w-lg');
                seg.querySelectorAll('button').forEach(b => {
                    b.classList.toggle('is-active', b.dataset.width === ukuran);
                });
                try {
                    localStorage.setItem('rd-lebar', ukuran);
                } catch (e) {}
            }
            seg.querySelectorAll('button').forEach(b => {
                b.addEventListener('click', () => setWidth(b.dataset.width));
            });
            let lebarAwal = 'md';
            try {
                lebarAwal = localStorage.getItem('rd-lebar') || 'md';
            } catch (e) {}
            setWidth(lebarAwal);

            // ----- Panel pengaturan -----
            const settings = document.getElementById('rd-settings');
            document.getElementById('rd-btn-settings').addEventListener('click', function() {
                settings.classList.toggle('is-open');
            });
            document.addEventListener('click', function(e) {
                if (!settings.contains(e.target) && !e.target.closest('#rd-btn-settings')) {
                    settings.classList.remove('is-open');
                }
            });

            // ----- Auto scroll -----
            let autoTimer = null;
            const autoBtn = document.getElementById('rd-btn-auto');
            const autoIcon = document.getElementById('rd-auto-icon');

            autoBtn.addEventListener('click', function() {
                if (autoTimer) {
                    clearInterval(autoTimer);
                    autoTimer = null;
                    autoBtn.classList.remove('is-active');
                    autoIcon.className = 'bi bi-play-fill';
                } else {
                    autoTimer = setInterval(() => window.scrollBy(0, 1), 30);
                    autoBtn.classList.add('is-active');
                    autoIcon.className = 'bi bi-pause-fill';
                }
            });

            // ----- Daftar chapter: cari & urutkan -----
            const cari = document.getElementById('rd-cari-chapter');
            const list = document.getElementById('rd-list');
            const kosong = document.getElementById('rd-list-kosong');
            const sortBtn = document.getElementById('rd-sort');

            cari.addEventListener('input', function() {
                const kata = this.value.trim().toLowerCase();
                let ada = 0;
                list.querySelectorAll('.rd-list-item').forEach(item => {
                    const cocok = item.dataset.cari.includes(kata);
                    item.classList.toggle('d-none', !cocok);
                    if (cocok) ada++;
                });
                kosong.classList.toggle('d-none', ada > 0);
            });

            let urutTurun = true;
            sortBtn.addEventListener('click', function() {
                urutTurun = !urutTurun;
                const items = Array.from(list.querySelectorAll('.rd-list-item'));
                items.reverse().forEach(item => list.insertBefore(item, kosong));
                sortBtn.querySelector('i').className = urutTurun ? 'bi bi-arrow-down' : 'bi bi-arrow-up';
            });

            // ----- Pintasan keyboard: panah kiri & kanan -----
            document.addEventListener('keydown', function(e) {
                const sedangMengetik = e.target.closest('input, textarea, select, [contenteditable]');
                if (sedangMengetik) return;

                if (e.key === 'ArrowLeft') {
                    window.location.href = prevUrl ?? detailUrl;
                }
                if (e.key === 'ArrowRight') {
                    window.location.href = nextUrl ?? detailUrl;
                }
            });
        })();
    </script>
@endpush
