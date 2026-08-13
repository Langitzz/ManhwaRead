@extends('layouts.user')

@section('title', 'Detail Manhwa')

@section('content')

    <section class="section py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <img src="{{ asset('assets/blogy/assets/img/blog/blog-post-1.webp') }}" class="img-fluid rounded shadow"
                        alt="Cover">
                </div>
                <div class="col-lg-9">
                    <h2 class="fw-bold mb-3">
                        Solo Leveling
                    </h2>
                    <div class="mb-3">
                        <span class="badge bg-primary">
                            Action
                        </span>
                        <span class="badge bg-danger">
                            Fantasy
                        </span>
                        <span class="badge bg-success">
                            Ongoing
                        </span>
                    </div>
                    <table class="table table-borderless w-auto">
                        <tr>
                            <th>Author</th>
                            <td>: Chugong</td>
                        </tr>
                        <tr>
                            <th>Artist</th>
                            <td>: Dubu</td>
                        </tr>
                        <tr>
                            <th>Rating</th>
                            <td>: ⭐ 9.9 / 10</td>
                        </tr>
                    </table>
                    <a href="{{ route('chapter.read') }}" class="btn btn-primary">
                        <i class="bi bi-book-fill"></i>
                        Mulai Membaca
                    </a>
                </div>
            </div>
        </div>

        <hr class="my-5">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="mb-3">
                    Sinopsis
                </h3>
                <p class="text-muted">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Voluptatibus molestiae porro laboriosam. Adipisci doloremque
                    voluptatum culpa quaerat, maiores quasi quisquam aspernatur
                    molestias voluptas, repellendus nobis libero temporibus
                    necessitatibus ipsa perspiciatis.
                </p>
                <p class="text-muted">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Provident quibusdam, omnis magni aliquid laborum fugit
                    consectetur labore dolore ipsa molestiae.
                </p>
            </div>
        </div>

        <hr class="my-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0">
                        Daftar Chapter
                    </h3>
                    <span class="badge bg-primary">
                        125 Chapter
                    </span>
                </div>
                <div class="list-group">
                    <a href="#"
                        class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Chapter 125</strong>
                            <br>
                            <small class="text-muted">
                                2 jam yang lalu
                            </small>
                        </div>
                        <i class="bi bi-chevron-right"></i>
                    </a>
                    <a href="#"
                        class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Chapter 124</strong>
                            <br>
                            <small class="text-muted">
                                Kemarin
                            </small>
                        </div>
                        <i class="bi bi-chevron-right"></i>
                    </a>
                    <a href="#"
                        class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Chapter 123</strong>
                            <br>
                            <small class="text-muted">
                                3 hari yang lalu
                            </small>
                        </div>
                        <i class="bi bi-chevron-right"></i>
                    </a>
                    <a href="#"
                        class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Chapter 122</strong>
                            <br>
                            <small class="text-muted">
                                1 minggu yang lalu
                            </small>
                        </div>
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
