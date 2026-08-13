@extends('layouts.user')

@section('title', 'Daftar Manhwa')

@section('content')

    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>📚 Daftar Manhwa</h2>
                <p>Temukan manhwa favoritmu.</p>
            </div>
            <div class="row g-4">
                @for ($i = 1; $i <= 12; $i++)
                    <div class="col-lg-3 col-md-4 col-6">
                        <x-manhwa-card image="{{ asset('assets/blogy/assets/img/blog/blog-post-1.webp') }}"
                            title="Solo Leveling" rating="9.9" chapter="Chapter 201" time="2 jam yang lalu" />
                    </div>
                @endfor
            </div>
        </div>
    </section>
@endsection
