<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::with('userRole')->orderBy('name')->get();
        $roles = Role::orderBy('nama_peran')->get();

        return view('admin.users.index', compact('users', 'roles'));
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
