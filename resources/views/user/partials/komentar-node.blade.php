@once
    <style>
        .kn {
            display: flex;
            gap: 12px;
            padding: 12px 0;
        }

        .kn-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #fff;
            background: linear-gradient(135deg, #6366f1 0%, #22d3ee 100%);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, .15);
        }

        .kn-avatar--sm {
            width: 30px;
            height: 30px;
            font-size: .75rem;
            box-shadow: none;
        }

        .kn-head {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .kn-name {
            color: #f8fafc;
            font-weight: 600;
            font-size: .92rem;
        }

        .kn-time {
            color: #64748b;
            font-size: .76rem;
        }

        .kn-body {
            margin: 6px 0 0;
            color: #cbd5e1;
            line-height: 1.65;
            white-space: normal;
            word-break: break-word;
        }

        .kn-text {
            white-space: pre-line;
        }

        .kn-mention {
            display: inline-block;
            margin-right: 6px;
            padding: 1px 9px;
            border-radius: 999px;
            background: rgba(99, 102, 241, .16);
            border: 1px solid rgba(99, 102, 241, .35);
            color: #c7d2fe;
            font-size: .8rem;
            font-weight: 600;
            vertical-align: 1px;
        }

        .kn-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 8px;
        }

        .kn-action {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            border-radius: 999px;
            border: 1px solid rgba(148, 163, 184, .18);
            background: transparent;
            color: #94a3b8;
            font-size: .78rem;
            font-weight: 600;
            transition: color .15s, border-color .15s, background .15s;
        }

        .kn-action:hover {
            color: #67e8f9;
            border-color: rgba(34, 211, 238, .4);
            background: rgba(34, 211, 238, .06);
        }

        .kn-action.kn-toggle {
            color: #a5b4fc;
            border-color: rgba(99, 102, 241, .3);
        }

        .kn-replies {
            position: relative;
            margin: 8px 0 0 20px;
            padding-left: 22px;
        }

        .kn-replies::before {
            content: "";
            position: absolute;
            left: 0;
            top: 4px;
            bottom: 12px;
            width: 2px;
            border-radius: 2px;
            background: linear-gradient(180deg, rgba(99, 102, 241, .6), rgba(34, 211, 238, .08));
        }

        .kn-replies.is-collapsed {
            display: none;
        }

        .kn-reply {
            position: relative;
            margin-bottom: 8px;
            padding: 10px 12px;
            border-radius: 14px;
            background: rgba(15, 23, 42, .45);
            border: 1px solid rgba(148, 163, 184, .08);
        }

        .kn-reply .kn-avatar {
            box-shadow: none;
        }

        .komentar-reply-form {
            display: none;
            margin-top: 10px;
        }

        .komentar-reply-form.is-open {
            display: block;
        }

        .komentar-reply-form textarea {
            background: rgba(15, 23, 42, .7);
            border: 1px solid rgba(148, 163, 184, .2);
            border-radius: 12px;
            color: #f8fafc;
            resize: vertical;
        }

        .komentar-reply-form textarea::placeholder {
            color: #64748b;
        }

        .komentar-reply-form textarea:focus {
            background: rgba(15, 23, 42, .9);
            color: #f8fafc;
            border-color: #22d3ee;
            box-shadow: 0 0 0 .2rem rgba(34, 211, 238, .15);
        }
    </style>

    <script>
        document.addEventListener('click', function(e) {
            const replyBtn = e.target.closest('[data-reply-toggle]');
            if (replyBtn) {
                const form = document.getElementById(replyBtn.dataset.replyToggle);
                form.classList.toggle('is-open');
                if (form.classList.contains('is-open')) {
                    form.querySelector('textarea').focus();
                }
                return;
            }

            const cancelBtn = e.target.closest('[data-reply-cancel]');
            if (cancelBtn) {
                cancelBtn.closest('.komentar-reply-form').classList.remove('is-open');
                return;
            }

            const repliesBtn = e.target.closest('[data-replies-toggle]');
            if (repliesBtn) {
                const box = document.getElementById(repliesBtn.dataset.repliesToggle);
                const collapsed = box.classList.toggle('is-collapsed');
                repliesBtn.querySelector('span').textContent = collapsed
                    ? repliesBtn.dataset.labelOpen
                    : repliesBtn.dataset.labelClose;
            }
        });
    </script>
@endonce

@php
    // Kumpulkan semua balasan (termasuk balasan dari balasan) jadi satu daftar datar
    $daftarBalasan = collect();
    $kumpulkanBalasan = function ($induk) use (&$kumpulkanBalasan, $balasan, $daftarBalasan) {
        foreach ($balasan->get($induk->id, collect()) as $balas) {
            $daftarBalasan->push($balas);
            $kumpulkanBalasan($balas);
        }
    };
    $kumpulkanBalasan($item);
    $jumlahBalasan = $daftarBalasan->count();
@endphp

<div class="kn" id="komentar-{{ $item->id }}">
    <div class="kn-avatar">
        {{ strtoupper(substr($item->user->name ?? '?', 0, 1)) }}
    </div>

    <div class="flex-grow-1" style="min-width: 0;">
        <div class="kn-head">
            <span class="kn-name">{{ $item->user->name ?? 'User' }}</span>
            <span class="kn-time">{{ $item->created_at->translatedFormat('d M Y, H:i') }}</span>
        </div>

        <p class="kn-body"><span class="kn-text">{{ $item->isi }}</span></p>

        <div class="kn-actions">
            @auth
                <button type="button" class="kn-action" data-reply-toggle="reply-form-{{ $item->id }}">
                    <i class="bi bi-reply"></i>
                    Balas
                </button>
            @endauth

            @if ($jumlahBalasan > 0)
                <button type="button" class="kn-action kn-toggle" data-replies-toggle="replies-{{ $item->id }}"
                    data-label-open="{{ $jumlahBalasan }} balasan" data-label-close="Sembunyikan balasan">
                    <i class="bi bi-chevron-up"></i>
                    <span>{{ $jumlahBalasan }} balasan</span>
                </button>
            @endif
        </div>

        @auth
            <div class="komentar-reply-form" id="reply-form-{{ $item->id }}">
                <form action="{{ $formAction }}" method="POST" autocomplete="off">
                    @csrf
                    <input type="hidden" name="parent_id" value="{{ $item->id }}">
                    <textarea name="isi" class="form-control" rows="2" maxlength="1000" required
                        placeholder="Balas {{ $item->user->name ?? 'user' }}..."></textarea>
                    <div class="d-flex justify-content-end gap-2 mt-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-reply-cancel>
                            Batal
                        </button>
                        <button type="submit" class="landing-cta" style="padding: 6px 14px; font-size: .85rem;">
                            Kirim Balasan
                        </button>
                    </div>
                </form>
            </div>
        @endauth

        @if ($jumlahBalasan > 0)
            <div class="kn-replies" id="replies-{{ $item->id }}">
                @foreach ($daftarBalasan as $balas)
                    <div class="kn-reply" id="komentar-{{ $balas->id }}">
                        <div class="kn d-flex gap-2 p-0">
                            <div class="kn-avatar kn-avatar--sm">
                                {{ strtoupper(substr($balas->user->name ?? '?', 0, 1)) }}
                            </div>

                            <div class="flex-grow-1" style="min-width: 0;">
                                <div class="kn-head">
                                    <span class="kn-name">{{ $balas->user->name ?? 'User' }}</span>
                                    <span class="kn-time">{{ $balas->created_at->translatedFormat('d M Y, H:i') }}</span>
                                </div>

                                <p class="kn-body"><span class="kn-mention">{{ '@' . ($balas->parent?->user?->name ?? 'user') }}</span><span class="kn-text">{{ $balas->isi }}</span></p>

                                <div class="kn-actions">
                                    @auth
                                        <button type="button" class="kn-action" data-reply-toggle="reply-form-{{ $balas->id }}">
                                            <i class="bi bi-reply"></i>
                                            Balas
                                        </button>
                                    @endauth
                                </div>

                                @auth
                                    <div class="komentar-reply-form" id="reply-form-{{ $balas->id }}">
                                        <form action="{{ $formAction }}" method="POST" autocomplete="off">
                                            @csrf
                                            <input type="hidden" name="parent_id" value="{{ $balas->id }}">
                                            <textarea name="isi" class="form-control" rows="2" maxlength="1000" required
                                                placeholder="Balas {{ $balas->user->name ?? 'user' }}..."></textarea>
                                            <div class="d-flex justify-content-end gap-2 mt-2">
                                                <button type="button" class="btn btn-sm btn-outline-secondary" data-reply-cancel>
                                                    Batal
                                                </button>
                                                <button type="submit" class="landing-cta" style="padding: 6px 14px; font-size: .85rem;">
                                                    Kirim Balasan
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>