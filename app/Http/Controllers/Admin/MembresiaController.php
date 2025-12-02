<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Membresia;

class MembresiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $membresias = Membresia::all(); 
        return view('admin.membresias.index', compact('membresias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.membresias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // VALIDACIÓN — usando el nombre real de tu columna "name" según tu create.blade.php
        $validated = $request->validate([
        'name' => 'required|string|max:255|unique:membresias,name',
        'price' => 'required|numeric|min:0',
         'duration_months' => 'required|integer|min:1',
        'description' => 'nullable|string',
        'status' => 'required|in:active,inactive',]);


        // Crear la nueva membresía
        Membresia::create($validated);

        // Mensaje con WireUI
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Plan de Membresía creado correctamente',
            'text' => 'El nuevo plan ha sido creado exitosamente.'
        ]);

        return redirect()->route('admin.membresias.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Membresia $membresia)
    {
        return view('admin.membresias.edit', compact('membresia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Membresia $membresia)
    {
        // VALIDACIÓN
        $validated = $request->validate([
    'name' => 'required|string|max:255|unique:membresias,name,' . $membresia->id,
    'price' => 'required|numeric|min:0',
    'duration_months' => 'required|integer|min:1',
    'description' => 'nullable|string',
    'status' => 'required|in:active,inactive',
]);


        // Actualizar registro
        $membresia->update($validated);

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Plan de Membresía actualizado correctamente',
            'text'  => 'El plan ha sido actualizado exitosamente.'
        ]);

        return redirect()->route('admin.membresias.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Membresia $membresia)
    {
        $membresia->delete();
        
        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Plan de Membresía eliminado',
            'text'  => 'El plan ha sido eliminado exitosamente.'
        ]);
        
        return redirect()->route('admin.membresias.index');
    }

    public function show(string $id)
    {
        // Puedes eliminarlo si no lo usarás.
    }
}
