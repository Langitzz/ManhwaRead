@props(['centered' => false])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $siteSetting->nama_situs }} | @yield('title', 'Login')</title>

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,600,700">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/blogy/assets/img/favicon.png') }}">

    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition @if ($centered) login-page @endif">
    @if ($centered)
        <div class="login-box" style="width:420px; max-width: 95%">
            {{ $slot }}
        </div>
    @else
        {{ $slot }}
    @endif

    <script src="{{ asset('assets/adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/adminlte/dist/js/adminlte.min.js') }}"></script>

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
</body>

</html>