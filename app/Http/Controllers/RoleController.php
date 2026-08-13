<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::latest()->get();

        return view('admin.role-user', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_peran' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        Role::create($data);

        return redirect()
            ->route('admin.user.index')
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

        return redirect()
            ->route('admin.user.index')
            ->with('success', 'Peran pengguna berhasil diperbarui.');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()
            ->route('admin.user.index')
            ->with('success', 'Peran pengguna berhasil dihapus.');
    }
}
