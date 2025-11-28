<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::with('roles')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create(): View
    {
        $roles = Role::where('guard_name', 'web')->pluck('name', 'name');
        return view('admin.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Assign role
        $user->assignRole($request->role);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user): View
    {
        $roles = Role::where('guard_name', 'web')->pluck('name', 'name');
        $userRole = $user->roles->first()?->name;
        return view('admin.users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            // Jangan update password jika tidak diisi
        ]);

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
            $user->save();
        }

        // Ganti role: hapus dulu, lalu assign baru
        $user->syncRoles([$request->role]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === auth()->id()) {
            return back()->withErrors('Anda tidak bisa menghapus diri sendiri.');
        }
        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }
}
