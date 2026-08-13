@extends('layouts.user')

@section('title', 'Genre')

@section('content')
    <section class="section py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">
                    Genre Manhwa
                </h2>
                <p class="text-muted">
                    Pilih genre favoritmu.
                </p>
            </div>
            <div class="row g-3">
                @php
                    $genres = [
                        'Action',
                        'Adventure',
                        'Comedy',
                        'Drama',
                        'Fantasy',
                        'Martial Arts',
                        'Romance',
                        'School Life',
                        'Shounen',
                        'Supernatural',
                        'Murim',
                        'Reincarnation',
                    ];
                @endphp
                @foreach ($genres as $genre)
                    <div class="col-lg-3 col-md-4 col-6">
                        <a href="#" class="btn btn-outline-primary w-100 py-3">
                            {{ $genre }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
