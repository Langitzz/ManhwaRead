<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::with('userRole')->orderBy('name')->get();
        $roles = Role::orderBy('nama_peran')->get();

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::orderBy('nama_peran')->get();

        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'username' => 'required|string|max:255|alpha_dash|unique:users,username',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);

        $data['status'] = $request->boolean('status', true);

        $user = User::create($data);

        ActivityLog::catat('Menambahkan User', "User: {$user->name}");

        return redirect()
            ->route('user.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $data['status'] = $request->boolean('status');

        $user->update($data);

        ActivityLog::catat('Mengubah User', "User: {$user->name}");

        return redirect()
            ->route('user.index')
            ->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $namaUser = $user->name;

        $user->delete();

        ActivityLog::catat('Menghapus User', "User: {$namaUser}");

        return redirect()
            ->route('user.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
