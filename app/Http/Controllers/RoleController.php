<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

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

        $role->update($data);

        ActivityLog::catat('Mengubah Role', "Role: {$role->nama_peran}");

        return redirect()
            ->route('admin.role.index')
            ->with('success', 'Peran pengguna berhasil diperbarui.');
    }

    public function destroy(Role $role)
    {
        $namaRole = $role->nama_peran;

        $role->delete();

        ActivityLog::catat('Menghapus Role', "Role: {$namaRole}");

        return redirect()
            ->route('admin.role.index')
            ->with('success', 'Peran pengguna berhasil dihapus.');
    }
}
