<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRoleRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(): View
    {
        $roles = Role::where('guard_name', 'web')->paginate(10);
        return view('admin.roles.index', compact('roles'));
    }

    public function create(): View
    {
        return view('admin.roles.create');
    }

    public function store(StoreRoleRequest $request): RedirectResponse
    {
        Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        return redirect()->route('admin.roles.index')->with('success', 'Role berhasil ditambahkan.');
    }

    public function edit(Role $role): View
    {
        return view('admin.roles.edit', compact('role'));
    }

    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        // Jangan izinkan ubah role 'superadmin' (opsional tapi aman)
        if ($role->name === 'superadmin') {
            return back()->withErrors('Role superadmin tidak boleh diubah.');
        }

        $role->update(['name' => $request->name]);

        return redirect()->route('admin.roles.index')->with('success', 'Role berhasil diperbarui.');
    }

    public function destroy(Role $role): RedirectResponse
    {
        if ($role->name === 'superadmin') {
            return back()->withErrors('Role superadmin tidak boleh dihapus.');
        }

        // Cek apakah role sedang dipakai
        if ($role->users()->count() > 0) {
            return back()->withErrors('Role ini sedang digunakan oleh user. Nonaktifkan user terlebih dahulu.');
        }

        $role->delete();
        return back()->with('success', 'Role berhasil dihapus.');
    }
}
