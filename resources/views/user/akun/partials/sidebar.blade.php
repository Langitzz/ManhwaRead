@php
    $menuAkun = [
        ['key' => 'profile', 'label' => 'Profile', 'icon' => 'bi-person-circle', 'route' => 'akun.edit'],
        ['key' => 'komentar', 'label' => 'Komentar Saya', 'icon' => 'bi-chat-left-text', 'route' => 'akun.komentar'],
        ['key' => 'statistik', 'label' => 'Statistik Baca', 'icon' => 'bi-bar-chart', 'route' => 'akun.statistik'],
    ];
@endphp

<style>
    .akun-sidebar-card {
        background: rgba(30, 41, 59, .55);
        border: 1px solid rgba(148, 163, 184, .12);
        border-radius: 18px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, .25);
        overflow: hidden;
    }

    .akun-menu-item {
        background: transparent;
        color: #cbd5e1;
        border-color: rgba(148, 163, 184, .12);
        padding: 14px 18px;
        font-weight: 600;
    }

    .akun-menu-item:hover {
        color: #f8fafc;
        background: rgba(148, 163, 184, .08);
    }

    .akun-menu-item.is-active {
        color: #fff;
        background: linear-gradient(90deg, rgba(99, 102, 241, .35), rgba(34, 211, 238, .12));
        box-shadow: inset 3px 0 0 #22d3ee;
    }
</style>

<div class="col-lg-3">
    <div class="card akun-sidebar-card">
        <div class="list-group list-group-flush">
            @foreach ($menuAkun as $menu)
                <a href="{{ route($menu['route']) }}"
                    class="akun-menu-item list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ $active === $menu['key'] ? 'is-active' : '' }}">
                    <span>
                        <i class="bi {{ $menu['icon'] }} me-2"></i>
                        {{ $menu['label'] }}
                    </span>
                    <i class="bi bi-chevron-right"></i>
                </a>
            @endforeach
        </div>
    </div>
</div>