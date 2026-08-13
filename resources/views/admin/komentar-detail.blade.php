@extends('layouts.admin')

@section('content')
    <main class="app-main">

        <div class="app-content-header">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="mb-0">Detail Komentar</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin') }}">Home</a>
                            </li>

                            <li class="breadcrumb-item">
                                <a href="{{ route('komentar.index') }}">
                                    Komentar
                                </a>
                            </li>

                            <li class="breadcrumb-item active">
                                Detail
                            </li>
                        </ol>
                    </div>
                </div>

            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">
                            Detail Komentar
                        </h3>
                    </div>

                    <div class="card-body">

                        <table class="table">

                            <tr>
                                <th width="200">User</th>
                                <td>Ahmad</td>
                            </tr>

                            <tr>
                                <th>Manhwa</th>
                                <td>Solo Leveling</td>
                            </tr>

                            <tr>
                                <th>Tanggal</th>
                                <td>03 Agustus 2026</td>
                            </tr>

                            <tr>
                                <th>Status</th>
                                <td>
                                    <span class="badge text-bg-success">
                                        Aktif
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <th>Isi Komentar</th>
                                <td>
                                    Manhwa ini keren banget, alurnya seru dan gambar
                                    sangat bagus.
                                </td>
                            </tr>

                        </table>

                    </div>

                    <div class="card-footer text-end">

                        <a href="{{ route('komentar.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>

                        <button class="btn btn-danger">
                            Hapus
                        </button>

                    </div>

                </div>

            </div>
        </div>

    </main>
@endsection
