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
                @forelse ($genres as $genre)
                    <div class="col-lg-3 col-md-4 col-6">
                        <a href="{{ route('explore', ['genre' => $genre->id]) }}" class="btn btn-outline-primary w-100 py-3">
                            {{ $genre->nama_genre }}
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">
                        Belum ada genre yang tersedia.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
