<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ $siteSetting->nama_situs }} | @yield('title')</title>
    <link rel="icon" href="{{ asset('assets/blogy/assets/img/favicon.png') }}">

    <!--begin::Theme Init (prevents flash of incorrect theme on load, #6043)-->
    <script>
        (() => {
            'use strict';
            const STORAGE_KEY = 'lte-theme';
            let stored = null;
            try {
                stored = localStorage.getItem(STORAGE_KEY);
            } catch {
                // localStorage may be unavailable (private mode, sandboxed iframe).
            }
            const prefersDark = globalThis.matchMedia('(prefers-color-scheme: dark)').matches;
            // Mirror the resolution in _scripts.astro: explicit "dark"/"light" win,
            // otherwise ("auto" or unset) fall back to the OS preference.
            let resolved = 'light';
            if (stored === 'dark' || stored === 'light') {
                resolved = stored;
            } else if (prefersDark) {
                resolved = 'dark';
            }
            document.documentElement.setAttribute('data-bs-theme', resolved);
            document.documentElement.style.colorScheme = resolved;
        })();
    </script>
    <!--end::Theme Init-->

    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->

    <!--begin::Primary Meta Tags-->
    <meta name="title" content="AdminLTE v4 | Dashboard" />
    <meta name="author" content="ColorlibHQ" />
    <meta name="description"
        content="AdminLTE is a free Bootstrap 5 admin dashboard template with almost 50 example pages, built with vanilla JS and designed with accessibility in mind." />
    <meta name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel" />
    <!--end::Primary Meta Tags-->

    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="{{ asset('assets/adminlte/dist/css/adminlte.css"') }}' as="style" />
    <!--end::Accessibility Features-->

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="print"
        onload="this.media = 'all'" />
    <!--end::Fonts-->

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->

    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(Bootstrap Icons)-->

    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('assets/adminlte/dist/css/adminlte.css') }}" />
    <!--end::Required Plugin(AdminLTE)-->

    <!-- apexcharts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
        integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous" />

    <!-- jsvectormap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
        integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous" />

    <style>
        /* Dropdown yang sedang terbuka */
        /* Dropdown aktif */
        .sidebar-menu .nav-item.menu-open>.nav-link {
            background: rgba(13, 110, 253, .12);
            border-left: 4px solid #0d6efd;
            border-radius: 8px;
            color: #fff !important;
        }

        /* Submenu aktif */
        .sidebar-menu .nav-treeview .nav-link.active {
            background: rgba(13, 110, 253, .18);
            border-left: 4px solid #0d6efd;
            border-radius: 8px;
            color: #fff !important;
            margin-left: 6px;
        }

        /* Hover */
        .sidebar-menu .nav-link:hover {
            background: rgba(255, 255, 255, .06);
            border-radius: 8px;
            transition: .2s ease;
        }

        /* ===== Global admin: kartu & tabel ===== */
        .card {
            border-radius: 16px;
            overflow: hidden;
        }

        .card-header {
            padding: 16px 20px;
            background: transparent;
            border-bottom: 1px solid rgba(148, 163, 184, .15);
        }

        .card-title {
            font-size: 1.05rem;
            font-weight: 700;
            margin: 0;
        }

        .card-header .card-title {
            float: none;
            margin: 0;
        }

        .card-body {
            padding: 20px;
        }

        [data-bs-theme="dark"] .card {
            border: 1px solid rgba(148, 163, 184, .12);
            box-shadow: 0 10px 28px rgba(0, 0, 0, .25);
        }

        [data-bs-theme="dark"] .table {
            --bs-table-bg: transparent;
            --bs-table-border-color: #334155;
            --bs-table-hover-bg: rgba(148, 163, 184, .06);
            --bs-table-color: #e2e8f0;
            color: #e2e8f0;
        }

        [data-bs-theme="dark"] .table> :not(caption)>*>* {
            border-color: #334155;
        }

        [data-bs-theme="dark"] .table>thead>tr>th {
            background: #0f172a;
            color: #94a3b8;
            font-size: .8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
            border-color: #334155;
        }

        /* ===== Leaderboard dashboard ===== */
        [data-bs-theme="dark"] .leaderboard tbody tr>td:first-child {
            width: 52px;
            white-space: nowrap;
            font-variant-numeric: tabular-nums;
            color: #94a3b8;
            font-weight: 600;
        }

        [data-bs-theme="dark"] .leaderboard tbody tr:nth-child(1)>td:first-child {
            background: linear-gradient(90deg, rgba(250, 204, 21, .22), transparent);
            color: #fde68a;
            font-weight: 800;
        }

        [data-bs-theme="dark"] .leaderboard tbody tr:nth-child(2)>td:first-child {
            background: linear-gradient(90deg, rgba(203, 213, 225, .18), transparent);
            color: #e2e8f0;
            font-weight: 800;
        }

        [data-bs-theme="dark"] .leaderboard tbody tr:nth-child(3)>td:first-child {
            background: linear-gradient(90deg, rgba(251, 146, 60, .2), transparent);
            color: #fdba74;
            font-weight: 800;
        }

        [data-bs-theme="dark"] .leaderboard tbody tr>td:first-child {
            width: 52px;
            font-variant-numeric: tabular-nums;
            color: #94a3b8;
            font-weight: 600;
        }

        [data-bs-theme="dark"] .leaderboard tbody tr>td:first-child::before {
            content: "";
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-right: 8px;
            vertical-align: middle;
            background: #334155;
        }

        [data-bs-theme="dark"] .leaderboard tbody tr:nth-child(1)>td:first-child {
            background: linear-gradient(90deg, rgba(250, 204, 21, .22), transparent);
            color: #fde68a;
            font-weight: 800;
        }

        [data-bs-theme="dark"] .leaderboard tbody tr:nth-child(1)>td:first-child::before {
            background: #facc15;
        }

        [data-bs-theme="dark"] .leaderboard tbody tr:nth-child(2)>td:first-child {
            background: linear-gradient(90deg, rgba(203, 213, 225, .18), transparent);
            color: #e2e8f0;
            font-weight: 800;
        }

        [data-bs-theme="dark"] .leaderboard tbody tr:nth-child(2)>td:first-child::before {
            background: #cbd5e1;
        }

        [data-bs-theme="dark"] .leaderboard tbody tr:nth-child(3)>td:first-child {
            background: linear-gradient(90deg, rgba(251, 146, 60, .2), transparent);
            color: #fdba74;
            font-weight: 800;
        }

        [data-bs-theme="dark"] .leaderboard tbody tr:nth-child(3)>td:first-child::before {
            background: #fb923c;
        }

        /* ===== Kartu ringkasan dashboard ===== */
        .small-box {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .25);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .small-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 34px rgba(0, 0, 0, .35);
        }

        .small-box .inner h3 {
            font-weight: 800;
        }

        .small-box.text-bg-primary {
            background: linear-gradient(135deg, #4f46e5 0%, #818cf8 100%) !important;
        }

        .small-box.text-bg-danger {
            background: linear-gradient(135deg, #e11d48 0%, #fb7185 100%) !important;
        }

        .small-box.text-bg-warning {
            background: linear-gradient(135deg, #d97706 0%, #fbbf24 100%) !important;
        }

        .small-box.text-bg-info {
            background: linear-gradient(135deg, #0891b2 0%, #22d3ee 100%) !important;
        }

        .small-box.text-bg-success {
            background: linear-gradient(135deg, #059669 0%, #34d399 100%) !important;
        }

        .small-box.text-bg-secondary {
            background: linear-gradient(135deg, #334155 0%, #64748b 100%) !important;
        }

        /* ===== Badge admin (tema gelap) ===== */
        [data-bs-theme="dark"] .badge {
            font-weight: 600;
            padding: .4em .75em;
            border-radius: 999px;
            border: 1px solid transparent;
        }

        [data-bs-theme="dark"] .badge.bg-success {
            background: rgba(34, 197, 94, .18) !important;
            color: #86efac !important;
            border-color: rgba(34, 197, 94, .3);
        }

        [data-bs-theme="dark"] .badge.bg-primary {
            background: rgba(99, 102, 241, .2) !important;
            color: #c7d2fe !important;
            border-color: rgba(99, 102, 241, .35);
        }

        [data-bs-theme="dark"] .badge.bg-warning {
            background: rgba(251, 191, 36, .16) !important;
            color: #fde68a !important;
            border-color: rgba(251, 191, 36, .3);
        }

        [data-bs-theme="dark"] .badge.bg-danger {
            background: rgba(248, 113, 113, .16) !important;
            color: #fca5a5 !important;
            border-color: rgba(248, 113, 113, .3);
        }

        [data-bs-theme="dark"] .badge.bg-secondary {
            background: rgba(148, 163, 184, .16) !important;
            color: #cbd5e1 !important;
            border-color: rgba(148, 163, 184, .25);
        }

        /* ===== Badge text-bg-* dan info (tema gelap) ===== */
        [data-bs-theme="dark"] .badge.text-bg-success {
            background: rgba(34, 197, 94, .18) !important;
            color: #86efac !important;
            border: 1px solid rgba(34, 197, 94, .3);
        }

        [data-bs-theme="dark"] .badge.text-bg-secondary {
            background: rgba(148, 163, 184, .16) !important;
            color: #cbd5e1 !important;
            border: 1px solid rgba(148, 163, 184, .25);
        }

        [data-bs-theme="dark"] .badge.text-bg-danger {
            background: rgba(248, 113, 113, .16) !important;
            color: #fca5a5 !important;
            border: 1px solid rgba(248, 113, 113, .3);
        }

        [data-bs-theme="dark"] .badge.text-bg-primary {
            background: rgba(99, 102, 241, .2) !important;
            color: #c7d2fe !important;
            border: 1px solid rgba(99, 102, 241, .35);
        }

        [data-bs-theme="dark"] .badge.bg-info {
            background: rgba(34, 211, 238, .16) !important;
            color: #a5f3fc !important;
            border: 1px solid rgba(34, 211, 238, .3);
        }

                /* ===== Logo sidebar saat mode mini ===== */
        .brand-icon-mini {
            display: none;
        }

        .sidebar-mini.sidebar-collapse .brand-logo-full {
            display: none;
        }

        .sidebar-mini.sidebar-collapse .brand-icon-mini {
            display: inline-block;
            margin: 0 auto;
        }

        .sidebar-mini.sidebar-collapse:not(.sidebar-without-hover) .app-sidebar:hover .brand-logo-full {
            display: inline-block;
        }

        .sidebar-mini.sidebar-collapse:not(.sidebar-without-hover) .app-sidebar:hover .brand-icon-mini {
            display: none;
        }
    </style>
</head>
