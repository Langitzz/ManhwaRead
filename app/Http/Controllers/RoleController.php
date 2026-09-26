<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::latest()->get();

        return view('admin.role.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_peran' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        $data['slug'] = Str::slug($data['nama_peran']);

        $role = Role::create($data);

        ActivityLog::catat('Menambahkan Role', "Role: {$role->nama_peran}");

        return redirect()
            ->route('admin.role.index')
            ->with('success', 'Peran pengguna berhasil ditambahkan.');
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'nama_peran' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        $data['status'] = $request->boolean('status');

        if ($role->slug === 'owner' && ! $data['status']) {
            return redirect()
                ->route('admin.role.index')
                ->with('error', 'Role Owner tidak bisa dinonaktifkan.');
        }

        $role->update($data);

        ActivityLog::catat('Mengubah Role', "Role: {$role->nama_peran}");

        return redirect()
            ->route('admin.role.index')
            ->with('success', 'Peran pengguna berhasil diperbarui.');
    }

    public function destroy(Role $role)
    {
        if ($role->slug === 'owner') {
            return redirect()
                ->route('admin.role.index')
                ->with('error', 'Role Owner tidak bisa dihapus.');
        }

        $jumlahUser = $role->users()->count();

        if ($jumlahUser > 0) {
            return redirect()
                ->route('admin.role.index')
                ->with('error', "Role ini masih dipakai oleh {$jumlahUser} user, tidak bisa dihapus.");
        }

        $namaRole = $role->nama_peran;

        $role->delete();

        ActivityLog::catat('Menghapus Role', "Role: {$namaRole}");

        return redirect()
            ->route('admin.role.index')
            ->with('success', 'Peran pengguna berhasil dihapus.');
    }
}
