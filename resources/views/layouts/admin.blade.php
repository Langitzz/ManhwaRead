<!doctype html>
<html lang="en">
<!--begin::Head-->
@include ('partials.admin-head')
<!--end::Head-->
<!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        @include('partials.admin-header')
        <!--end::Header-->
        <!--begin::Sidebar-->
        @include('partials.admin-sidebar')
        <!--end::Sidebar-->
        <!--begin::App Main-->
        @if (session('success'))
            <div class="app-content">
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
            <div class="app-content">
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
        <!--end::App Main-->
        <!--begin::Footer-->
        @include('partials.admin-footer')
        <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    @include('partials.admin-script')
</body>
<!--end::Body-->
</html>
