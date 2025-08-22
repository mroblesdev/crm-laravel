<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth',
            new Middleware('permission:usuarios', only: ['index']),
            new Middleware('permission:usuarios-crear', only: ['create', 'store']),
            new Middleware('permission:usuarios-editar', only: ['edit', 'update']),
            new Middleware('permission:usuarios-eliminar', only: ['destroy']),
            new Middleware('permission:usuarios-permisos', only: ['editPermissions', 'updatePermissions']),
        ];
    }

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create($request->all());
        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($request->all());
        return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente.');
    }

    public function editPassword(User $user)
    {
        return view('users.password', compact('user'));
    }

    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->update(['password' => bcrypt($request->password)]);
        return redirect()->route('users.index')->with('success', 'Contraseña actualizada exitosamente.');
    }

    public function editPermissions(User $user)
    {
        $permissions = Permission::all();
        $userPermissions = $user->permissions->pluck('id')->toArray();

        return view('users.permissions', compact('user', 'permissions', 'userPermissions'));
    }

    /**
     * Guarda los cambios de asignación de permisos.
     */
    public function updatePermissions(Request $request, User $user)
    {
        $permissionIds = $request->input('permissions', []);
        $user->permissions()->sync($permissionIds);

        return redirect()->route('users.permissions.edit', $user)
            ->with('success', 'Permisos actualizados correctamente.');
    }
}
