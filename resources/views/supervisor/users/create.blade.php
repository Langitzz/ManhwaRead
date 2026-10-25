@extends('layouts.supervisor')

@section('title', 'Tambah User')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <h3 class="mb-0" style="color:#7c3aed;">Tambah User</h3>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <form action="{{ route('supervisor.users.store') }}" method="POST" autocomplete="off">
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
                        <a href="{{ route('supervisor.users.index') }}" class="btn btn-secondary">
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