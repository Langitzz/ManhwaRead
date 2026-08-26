<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class HakAksesController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('nama_peran')->get();
        $permissions = Permission::orderBy('id')->get();

        $matrix = [];
        foreach ($roles as $role) {
            $matrix[$role->id] = $role->permissions()->pluck('permissions.id')->toArray();
        }

        return view('admin.hak-akses.index', compact('roles', 'permissions', 'matrix'));
    }

    public function update(Request $request, Role $role)
    {
        $permissionIds = $request->input('permission_ids', []);

        $role->permissions()->sync($permissionIds);

        ActivityLog::catat('Mengubah Hak Akses', "Role: {$role->nama_peran}");

        return redirect()
            ->route('admin.access.index')
            ->with('success', "Hak akses untuk Role \"{$role->nama_peran}\" berhasil diperbarui.");
    }
}
