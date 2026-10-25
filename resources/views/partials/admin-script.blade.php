<!--begin::Third Party Plugin(OverlayScrollbars)-->
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
    crossorigin="anonymous"></script>
<!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous">
</script>
<!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
<script src="{{ asset('assets/adminlte/dist/js/adminlte.js') }}"></script>
<!--end::Required Plugin(AdminLTE)-->
@vite(['resources/js/app.js'])
<!--begin::OverlayScrollbars Configure-->
<script>
    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
    };
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);

        // Dis able OverlayScrollbars on mobile devices to prevent touch interference
        const isMobile = window.innerWidth <= 992;

        if (
            sidebarWrapper &&
            OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined &&
            !isMobile
        ) {
            OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                scrollbars: {
                    theme: Default.scrollbarTheme,
                    autoHide: Default.scrollbarAutoHide,
                    clickScroll: Default.scrollbarClickScroll,
                },
            });
        }
    });
</script>
<!--end::OverlayScrollbars Configure-->

<!--begin::Color Mode Toggle-->
<!-- The light/dark/auto switcher ships in adminlte.js as the ColorMode
     module (since 4.1) — no page script needed. Only the no-flash snippet
     in <head> stays inline, because it must run before first paint. -->
<!--end::Color Mode Toggle-->

<!-- OPTIONAL SCRIPTS -->

<!-- sortablejs -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js" crossorigin="anonymous"></script>
<!-- sortablejs -->
<script>
    new Sortable(document.querySelector('.connectedSortable'), {
        group: 'shared',
        handle: '.card-header',
    });

    const cardHeaders = document.querySelectorAll('.connectedSortable .card-header');
    cardHeaders.forEach((cardHeader) => {
        cardHeader.style.cursor = 'move';
    });
</script>
<!-- apexcharts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
    integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js" crossorigin="anonymous"></script>
<!-- ChartJS -->
<script>
    // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
    // IT'S ALL JUST JUNK FOR DEMO
    // ++++++++++++++++++++++++++++++++++++++++++ tes

    const sales_chart_options = {
        series: [{
                name: 'Digital Goods',
                data: [28, 48, 40, 19, 86, 27, 90],
            },
            {
                name: 'Electronics',
                data: [65, 59, 80, 81, 56, 55, 40],
            },
        ],
        chart: {
            height: 300,
            type: 'area',
            toolbar: {
                show: false,
            },
        },
        legend: {
            show: false,
        },
        colors: ['#0d6efd', '#20c997'],
        dataLabels: {
            enabled: false,
        },
        stroke: {
            curve: 'smooth',
        },
        xaxis: {
            type: 'datetime',
            categories: [
                '2023-01-01',
                '2023-02-01',
                '2023-03-01',
                '2023-04-01',
                '2023-05-01',
                '2023-06-01',
                '2023-07-01',
            ],
        },
        tooltip: {
            x: {
                format: 'MMMM yyyy',
            },
        },
    };

    const sales_chart = new ApexCharts(
        document.querySelector('#revenue-chart'),
        sales_chart_options,
    );
    sales_chart.render();
</script>
<!-- jsvectormap -->
<script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js"
    integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js"
    integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY=" crossorigin="anonymous"></script>
<!-- jsvectormap -->
<script>
    // World map by jsVectorMap
    new jsVectorMap({
        selector: '#world-map',
        map: 'world',
    });

    // Sparkline charts
    const option_sparkline1 = {
        series: [{
            data: [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021],
        }, ],
        chart: {
            type: 'area',
            height: 50,
            sparkline: {
                enabled: true,
            },
        },
        stroke: {
            curve: 'straight',
        },
        fill: {
            opacity: 0.3,
        },
        yaxis: {
            min: 0,
        },
        colors: ['#DCE6EC'],
    };

    const sparkline1 = new ApexCharts(document.querySelector('#sparkline-1'), option_sparkline1);
    sparkline1.render();

    const option_sparkline2 = {
        series: [{
            data: [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921],
        }, ],
        chart: {
            type: 'area',
            height: 50,
            sparkline: {
                enabled: true,
            },
        },
        stroke: {
            curve: 'straight',
        },
        fill: {
            opacity: 0.3,
        },
        yaxis: {
            min: 0,
        },
        colors: ['#DCE6EC'],
    };

    const sparkline2 = new ApexCharts(document.querySelector('#sparkline-2'), option_sparkline2);
    sparkline2.render();

    const option_sparkline3 = {
        series: [{
            data: [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21],
        }, ],
        chart: {
            type: 'area',
            height: 50,
            sparkline: {
                enabled: true,
            },
        },
        stroke: {
            curve: 'straight',
        },
        fill: {
            opacity: 0.3,
        },
        yaxis: {
            min: 0,
        },
        colors: ['#DCE6EC'],
    };

    const sparkline3 = new ApexCharts(document.querySelector('#sparkline-3'), option_sparkline3);
    sparkline3.render();
</script>
<!--end::Script-->


{{-- Modal konfirmasi custom, dipakai bareng Admin/Owner/Supervisor --}}
<style>
    #confirmModal .modal-content {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(0, 0, 0, .35);
    }

    #confirmModal .modal-body {
        padding: 2.25rem 2rem 1.75rem;
        text-align: center;
    }

    #confirmModal .confirm-icon-wrap {
        width: 72px;
        height: 72px;
        margin: 0 auto 1.25rem;
        border-radius: 50%;
        background: rgba(220, 53, 69, .12);
        display: flex;
        align-items: center;
        justify-content: center;
        animation: confirmPulse 1.8s ease-in-out infinite;
    }

    #confirmModal .confirm-icon-wrap i {
        font-size: 2.1rem;
        color: #dc3545;
    }

    @keyframes confirmPulse {
        0% {
            box-shadow: 0 0 0 0 rgba(220, 53, 69, .25);
        }

        70% {
            box-shadow: 0 0 0 14px rgba(220, 53, 69, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(220, 53, 69, 0);
        }
    }

    #confirmModal h5 {
        font-weight: 700;
        margin-bottom: .5rem;
    }

    #confirmModal #confirmModalMessage {
        color: #9ca3af;
        margin-bottom: 1.75rem;
    }

    #confirmModal .modal-footer {
        border-top: none;
        padding: 0 2rem 2rem;
        justify-content: center;
        gap: .75rem;
    }

    #confirmModal .btn {
        border-radius: 50px;
        padding: .55rem 1.75rem;
        font-weight: 600;
        min-width: 110px;
        transition: transform .15s ease, box-shadow .15s ease;
    }

    #confirmModal .btn:hover {
        transform: translateY(-2px);
    }

    #confirmModal .btn-danger {
        box-shadow: 0 8px 18px rgba(220, 53, 69, .35);
    }

    #confirmModal .btn-danger:hover {
        box-shadow: 0 10px 22px rgba(220, 53, 69, .45);
    }
</style>

<div class="modal fade" id="confirmModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="confirm-icon-wrap">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <h5>Yakin Ingin Melanjutkan?</h5>
                <p id="confirmModalMessage" class="mb-0">Yakin ingin melakukan aksi ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmModalOkBtn">
                    <i class="bi bi-trash3 me-1"></i>
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    (function() {
        let formToSubmit = null;
        const modalEl = document.getElementById('confirmModal');
        const modal = new bootstrap.Modal(modalEl);
        const messageEl = document.getElementById('confirmModalMessage');
        const okBtn = document.getElementById('confirmModalOkBtn');

        document.querySelectorAll('form[data-confirm]').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                formToSubmit = form;
                messageEl.textContent = form.dataset.confirm;
                modal.show();
            });
        });

        okBtn.addEventListener('click', function() {
            modal.hide();
            if (formToSubmit) {
                formToSubmit.submit();
            }
        });
    })();
</script>

<script>
    document.querySelectorAll('input, textarea, select').forEach(function(field) {
        field.addEventListener('invalid', function() {
            if (field.validity.valueMissing) {
                field.setCustomValidity('Kolom ini wajib diisi.');
            } else if (field.validity.typeMismatch) {
                field.setCustomValidity(field.type === 'email' ?
                    'Masukkan alamat email yang valid.' :
                    'Format yang dimasukkan tidak valid.');
            } else if (field.validity.tooShort) {
                field.setCustomValidity('Terlalu pendek, minimal ' + field.minLength + ' karakter.');
            } else {
                field.setCustomValidity('Masukkan nilai yang valid.');
            }
        });
        field.addEventListener('input', function() {
            field.setCustomValidity('');
        });
    });
</script>