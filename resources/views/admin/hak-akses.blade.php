@extends('layouts.admin')

@section('title', 'Hak Akses')

@section('content')
    <main class="app-main">

        <div class="app-content-header">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="mb-0">Hak Akses</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin') }}">Home</a>
                            </li>

                            <li class="breadcrumb-item active">
                                Hak Akses
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
                            <i class="bi bi-key me-2"></i>
                            Hak Akses Role
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-bordered table-hover align-middle">

                                <thead class="table-light">

                                    <tr>
                                        <th>Menu</th>
                                        <th width="120" class="text-center">Admin</th>
                                        <th width="120" class="text-center">User</th>
                                    </tr>

                                </thead>

                                <tbody>

                                    <tr>
                                        <td>Dashboard</td>
                                        <td class="text-center">
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                        </td>
                                        <td class="text-center">
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Master Data</td>
                                        <td class="text-center">
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                        </td>
                                        <td class="text-center">
                                            <i class="bi bi-x-circle-fill text-danger"></i>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Aktivitas</td>
                                        <td class="text-center">
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                        </td>
                                        <td class="text-center">
                                            <i class="bi bi-x-circle-fill text-danger"></i>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>User</td>
                                        <td class="text-center">
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                        </td>
                                        <td class="text-center">
                                            <i class="bi bi-x-circle-fill text-danger"></i>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Admin</td>
                                        <td class="text-center">
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                        </td>
                                        <td class="text-center">
                                            <i class="bi bi-x-circle-fill text-danger"></i>
                                        </td>
                                    </tr>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>
        </div>

    </main>
@endsection
