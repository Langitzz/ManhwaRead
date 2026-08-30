<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('partials.user-head')

<body class="index-page">

    @include('partials.user-header')

    <main class="main">
        @yield('content')
    </main>

    @include('partials.user-footer')

    @include('partials.user-script')

</body>

</html>