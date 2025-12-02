<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.usuarios.index'); 
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role'     => ['required', Rule::in(Role::pluck('name')->toArray())],

            'id_number' => ['nullable', 'string', 'max:50'],
            'phone'     => ['nullable', 'string', 'max:20'],
            'address'   => ['nullable', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'id_number' => $request->id_number,
            'phone'     => $request->phone,
            'address'   => $request->address,
        ]);

        $user->assignRole($request->role);

        session()->flash('swal', [
            'icon'=>'success',
            'title'=>'Usuario creado correctamente',
            'text'=>'El usuario ha sido creado y el rol asignado exitosamente.'
        ]);
        
        return redirect()->route('admin.usuarios.index');
    }

    public function edit(User $usuario)
    {
        // 🔒 BLOQUEO: No permitir editar usuarios con rol ID = 1
        if ($usuario->roles->contains('id', 1)) {
            session()->flash('swal', [
                'icon'  => 'error',
                'title' => 'Acceso denegado',
                'text'  => 'No se puede editar un usuario con un rol protegido.'
            ]);
            return redirect()->route('admin.usuarios.index');
        }

        $roles = Role::all();

        return view('admin.usuarios.edit', [
            'user' => $usuario,
            'roles' => $roles
        ]);
    }

    public function update(Request $request, User $usuario)
    {
        // 🔒 BLOQUEO: No permitir actualizar usuarios con rol ID = 1
        if ($usuario->roles->contains('id', 1)) {
            session()->flash('swal', [
                'icon'  => 'error',
                'title' => 'Acceso denegado',
                'text'  => 'No se puede actualizar un usuario con un rol protegido.'
            ]);
            return redirect()->route('admin.usuarios.index');
        }

        $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($usuario->id),
            ],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],

            'roles' => ['nullable', 'array'],
            'roles.*' => [Rule::in(Role::pluck('name')->toArray())],

            'id_number' => ['nullable', 'string', 'max:50'],
            'phone'     => ['nullable', 'string', 'max:20'],
            'address'   => ['nullable', 'string', 'max:255'],
        ]);

        $data = $request->only('name', 'email', 'id_number', 'phone', 'address');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $usuario->update($data);

        $usuario->syncRoles($request->roles ?? []);

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Usuario actualizado correctamente',
            'text'  => 'Los datos del usuario han sido actualizados.'
        ]);

        return redirect()->route('admin.usuarios.index');
    }

    public function destroy(User $usuario)
    {
        // 🔒 Impedir eliminar usuarios con rol protegido
        if ($usuario->roles->contains('id', 1)) {
            session()->flash('swal', [
                'icon'  => 'error',
                'title' => 'Acceso denegado',
                'text'  => 'No se puede eliminar un usuario con un rol protegido.'
            ]);
            return redirect()->route('admin.usuarios.index');
        }

        // Evitar que el usuario se elimine a sí mismo
        if (auth()->id() === $usuario->id) {
            session()->flash('swal', [
                'icon'  => 'error',
                'title' => 'Error',
                'text'  => 'No puedes eliminar tu propia cuenta.'
            ]);

            return redirect()->route('admin.usuarios.index');
        }

        $usuario->delete();

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Usuario eliminado correctamente',
            'text'  => 'El usuario ha sido eliminado del sistema.'
        ]);

        return redirect()->route('admin.usuarios.index');
    }
}
