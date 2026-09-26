<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index(Request $request)
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

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::where('status', true)->orderBy('nama_peran')->get();

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

        if ($user->userRole?->slug === 'owner') {
            if ($data['role_id'] != $user->role_id) {
                return redirect()
                    ->route('user.index')
                    ->with('error', 'Role Owner tidak bisa diganti.');
            }

            if (! $data['status']) {
                return redirect()
                    ->route('user.index')
                    ->with('error', 'User dengan role Owner tidak bisa dinonaktifkan.');
            }
        }

        if ($user->id === Auth::id()) {
            if ($data['role_id'] != $user->role_id) {
                return redirect()
                    ->route('user.index')
                    ->with('error', 'Kamu tidak bisa mengganti role akun sendiri.');
            }

            if (! $data['status']) {
                return redirect()
                    ->route('user.index')
                    ->with('error', 'Kamu tidak bisa menonaktifkan akun sendiri.');
            }
        }

        $user->update($data);

        ActivityLog::catat('Mengubah User', "User: {$user->name}");

        return redirect()
            ->route('user.index')
            ->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->userRole?->slug === 'owner') {
            return redirect()
                ->route('user.index')
                ->with('error', 'User dengan role Owner tidak bisa dihapus.');
        }

        if ($user->id === Auth::id()) {
            return redirect()
                ->route('user.index')
                ->with('error', 'Kamu tidak bisa menghapus akun sendiri.');
        }

        $namaUser = $user->name;

        $user->delete();

        ActivityLog::catat('Menghapus User', "User: {$namaUser}");

        return redirect()
            ->route('user.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
