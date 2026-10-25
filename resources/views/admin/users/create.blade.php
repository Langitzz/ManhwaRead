@extends('layouts.admin')

@section('title', 'Tambah User')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0">Tambah User</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('user.index') }}">Daftar User</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Tambah
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <form action="{{ route('user.store') }}" method="POST" autocomplete="off">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-person-plus me-2"></i>
                            Form Tambah User
                        </h3>
                    </div>

                    <div class="card-body">
                        @include('partials.user-form-fields', ['roles' => $roles])
                    </div>

                    <div class="card-footer d-flex justify-content-end gap-2">
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i>
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i>
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection