<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\AdminUserController;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends AdminUserController
{
    public function index(Request $request): View
    {
        $users = User::with('userRole')
            ->when($request->filled('cari'), function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->cari . '%')
                        ->orWhere('email', 'like', '%' . $request->cari . '%')
                        ->orWhere('username', 'like', '%' . $request->cari . '%');
                });
            })
            ->when($request->filled('role_id'), function ($query) use ($request) {
                $query->where('role_id', $request->role_id);
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->orderBy('name')
            ->get();

        $roles = Role::orderBy('nama_peran')->get();

        return view('supervisor.users.index', compact('users', 'roles'));
    }

    public function create(): View
    {
        $roles = Role::where('status', true)->orderBy('nama_peran')->get();

        return view('supervisor.users.create', compact('roles'));
    }
}