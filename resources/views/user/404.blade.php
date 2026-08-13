@extends('layouts.user')

@section('title', '404')

@section('content')

<section class="section py-5">
    <div class="container text-center">

        <h1 class="display-1 fw-bold">
            404
        </h1>

        <h3 class="mb-3">
            Halaman tidak ditemukan
        </h3>

        <p class="text-muted mb-4">
            Halaman yang kamu cari mungkin telah hilang ke dunia lain.
        </p>

        <a href="{{ route('home') }}" class="btn btn-primary">
            Kembali ke Home
        </a>

    </div>
</section>

@endsection