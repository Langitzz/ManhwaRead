@extends('layouts.user')

@section('title', 'Manhwa Populer')

@section('content')
    <section class="section py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1">
                        Manhwa Populer
                    </h2>
                    <p class="text-muted mb-0">
                        Manhwa dengan rating dan jumlah pembaca tertinggi.
                    </p>
                </div>
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
