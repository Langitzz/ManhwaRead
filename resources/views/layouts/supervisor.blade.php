<!doctype html>
<html lang="en">
@include('partials.admin-head')

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        @include('partials.admin-header')
        @include('partials.supervisor-sidebar')
        <main class="app-main">
            @if (session('success'))
                <div class="app-content-header">
                    <div class="container-fluid">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    </div>
                </div>
            @endif
            @if (session('error'))
                <div class="app-content-header">
                    <div class="container-fluid">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-x-circle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    </div>
                </div>
            @endif
            @yield('content')
        </main>
        @include('partials.admin-footer')
    </div>
    @include('partials.admin-script')
</body>
</html>