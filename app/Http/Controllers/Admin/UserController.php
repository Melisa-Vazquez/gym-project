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
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
            'role'      => ['required', Rule::in(Role::pluck('name')->toArray())],
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
        // Protección
        if ($usuario->roles->contains('id', 1)) {
            session()->flash('swal', [
                'icon'  => 'error',
                'title' => 'Acceso denegado',
                'text'  => 'No se puede editar un usuario con un rol protegido.'
            ]);
            return redirect()->route('admin.usuarios.index');
        }

        $roles = Role::all();
        // Obtiene el nombre del primer rol para precargar en el formulario
        $roleName = $usuario->roles->first()?->name; 
        
        return view('admin.usuarios.edit', [
            'user' => $usuario,
            'roles' => $roles,
            'roleName' => $roleName
        ]);
    }

    public function update(Request $request, User $usuario)
    {
        // PROTECCIÓN
        if ($usuario->roles->contains('id', 1)) {
            session()->flash('swal', [
                'icon'  => 'error',
                'title' => 'Acceso denegado',
                'text'  => 'No se puede actualizar un usuario con un rol protegido.'
            ]);
            return redirect()->route('admin.usuarios.index');
        }

        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($usuario->id),
            ],
            
            'password'  => ['nullable', 'string', 'min:8', 'confirmed'],
            'role'      => ['required', Rule::in(Role::pluck('name')->toArray())],
            'id_number' => ['nullable', 'string', 'max:50'],
            'phone'     => ['nullable', 'string', 'max:20'],
            'address'   => ['nullable', 'string', 'max:255'],
        ]);

        $data = $request->only('name', 'email', 'id_number', 'phone', 'address');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $usuario->update($data);

        // Sincroniza los roles
        $usuario->syncRoles([$request->role]);

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Usuario actualizado correctamente',
            'text'  => 'Los datos del usuario han sido actualizados.'
        ]);

        return redirect()->route('admin.usuarios.index');
    }

    /**
     * Alterna el estado (is_active) de un usuario específico (Método principal de cambio de estado).
     */
    public function activate(User $usuario)
    {
        // 1. Protección de Rol: No permitir la modificación si tiene el rol 'Administrador'
        if ($usuario->hasRole('Administrador')) {
            session()->flash('swal', [
                'icon'  => 'error',
                'title' => 'Acceso denegado',
                'text'  => 'No se puede modificar el estado de un usuario Administrador.'
            ]);
            return redirect()->route('admin.usuarios.index');
        }

        // 2. 🔑 PROTECCIÓN CLAVE: Evitar que el usuario logueado se modifique a sí mismo.
        if (auth()->id() === $usuario->id) {
            session()->flash('swal', [
                'icon'  => 'error',
                'title' => 'Error',
                'text'  => 'No puedes modificar el estado de tu propia cuenta.'
            ]);
            return redirect()->route('admin.usuarios.index');
        }

        // 3. Alternar el estado
        $newStatus = !$usuario->is_active;
        $usuario->update(['is_active' => $newStatus]);
        
        $message = $newStatus ? 'activado' : 'desactivado';

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Estado actualizado',
            'text'  => "El usuario ha sido $message exitosamente."
        ]);

        return redirect()->route('admin.usuarios.index');
    }
    
    public function destroy(User $usuario)
    {
        // 1. Protección de Rol: No permitir la modificación si tiene el rol 'Administrador'
        if ($usuario->hasRole('Administrador')) {
            session()->flash('swal', [
                'icon'  => 'error',
                'title' => 'Acceso denegado',
                'text'  => 'No se puede desactivar ni eliminar el usuario Administrador.'
            ]);
            return redirect()->route('admin.usuarios.index');
        }

        // 2. 🔑 PROTECCIÓN CLAVE: Evitar que el usuario logueado se desactive a sí mismo.
        if (auth()->id() === $usuario->id) {
            session()->flash('swal', [
                'icon'  => 'error',
                'title' => 'Error',
                'text'  => 'No puedes desactivar tu propia cuenta.'
            ]);
            return redirect()->route('admin.usuarios.index');
        }

        // 3. Desactivar el usuario (is_active = false)
        $usuario->update(['is_active' => false]);

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Usuario desactivado correctamente',
            'text'  => 'El usuario ha sido desactivado del sistema.'
        ]);

        return redirect()->route('admin.usuarios.index');
    }
}