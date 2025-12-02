<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }
        /**
     * edit
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validar que se cree bien
        $request->validate(['name' => 'required|unique:roles,name']);
        //Si pasa la validacion creara la tabla
        
        
        Role::create(['name'=>$request->name]);
        //Variable de un solo uso para la alerta
        
        session()->flash('swal',
        [
            
            'icon'=>'success',
            'title'=>'Rol creado correctamente',
            'text'=>'El rol ha sido creado exitosamente'
        ]);


        //redireccionara a la tabla principal
        
        return redirect()->route('admin.roles.index')
        
        ->with('success','Role created succesfully');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {//
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( Role $role)
    
    {

 //restringir la accion para los primeros 4 roles fijos
        if($role->id <=3){
            //variable de un solo uso para la alerta
            session()->flash('swal',
            [
            'icon'  => 'error',
            'title' => 'Error',
            'text'  => 'No se puede editar este rol. '

        ]);
                //redireccionar al mismo lugar
            return redirect()->route('admin.roles.index');
        }

        return view('admin.roles.edit', compact('role'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
{
    $request->validate([
        'name' => 'required|unique:roles,name,' . $role->id,
    ]);
    //Si el campo no cambio, no actualices
    if($role->name === $request->name){
        session()->flash('swal', [
        'icon'  => 'info',
        'title' => 'Sin cambios',
        'text'  => 'No se detectaron modificaciones'
       
    ]);
     return redirect()->route('admin.roles.edit', $role);
    }



//
    $role->update(['name' => $request->name]);

    session()->flash('swal', [
        'icon'  => 'success',
        'title' => 'Rol actualizado correctamente',
        'text'  => 'El rol ha sido actualizado exitosamente'
    ]);

    return redirect()->route('admin.roles.index');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {

        //restringir la accion para los primeros 3 roles fijos
        if($role->id <=3){
            //variable de un solo uso para la alerta
            session()->flash('swal',
            [
            'icon'  => 'error',
            'title' => 'Error',
            'text'  => 'No se puede eliminar este rol. '

        ]);
                //redireccionar al mismo lugar
            return redirect()->route('admin.roles.index');
        }

        //      borrar el elemento
        $role->delete();
        //ALERTA
        session()->flash('swal',
        [
        'icon'  => 'success',
        'title' => 'Rol eliminado correctamente',
        'text'  => 'El rol ha sido eliminado exitosamente'

    ]);
            //redireccionar al mismo lugar
        return redirect()->route('admin.roles.index');
    }
}