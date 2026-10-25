@extends('layouts.supervisor')

@section('title', 'Daftar User')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <h3 class="mb-0" style="color:#7c3aed;">Daftar User</h3>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            @include('partials.users-table', ['users' => $users, 'roles' => $roles, 'routePrefix' => 'supervisor.users'])
        </div>
    </div>
@endsection