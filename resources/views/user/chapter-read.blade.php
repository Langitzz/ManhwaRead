@extends('layouts.user')

@section('title', 'Baca Chapter')

@section('content')

    <section class="section py-5">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('manhwa') }}">
                            Daftar Manhwa
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">
                            Solo Leveling
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        Chapter 201
                    </li>
                </ol>
            </nav>
            <div class="mb-4">
                <a href="{{ route('manhwa') }}" class="btn btn-light border">
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>
            </div>
            <div class="text-center mb-5">
                <h2 class="fw-bold">
                    Solo Leveling
                </h2>
                <h5 class="text-muted">
                    Chapter 201
                </h5>
            </div>
            <div class="d-flex justify-content-between mb-4">
                <a href="#" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left"></i>
                    Chapter Sebelumnya
                </a>
                <a href="#" class="btn btn-outline-primary">
                    Chapter Selanjutnya
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="text-center">
                <img src="{{ asset('assets/blogy/assets/img/blog/blog-post-1.webp') }}"
                    class="img-fluid mb-4 rounded shadow" alt="Page 1">
                <img src="{{ asset('assets/blogy/assets/img/blog/blog-post-2.webp') }}"
                    class="img-fluid mb-4 rounded shadow" alt="Page 2">
                <img src="{{ asset('assets/blogy/assets/img/blog/blog-post-3.webp') }}"
                    class="img-fluid mb-4 rounded shadow" alt="Page 3">
            </div>
            <div class="d-flex justify-content-between mt-5">
                <a href="#" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left"></i>
                    Chapter Sebelumnya
                </a>
                <a href="#" class="btn btn-outline-primary">
                    Chapter Selanjutnya
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>
@endsection
