<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>ManhwaRead | @yield('title')</title>

    <meta name="description" content="@yield('description', 'Baca Manhwa Gratis')">
    <meta name="keywords" content="Manhwa, Manga, Webtoon">

    <!-- Favicons -->
    <link rel="icon" href="{{ asset('assets/blogy/assets/img/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/blogy/assets/img/apple-touch-icon.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@300;400;500;600;700&family=Nunito:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS -->
    <link href="{{ asset('assets/blogy/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/blogy/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/blogy/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/blogy/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/blogy/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

    <!-- Main CSS -->
    <link href="{{ asset('assets/blogy/assets/css/main.css') }}" rel="stylesheet">

    @stack('styles')
</head>
