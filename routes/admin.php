<?php
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MembresiaController;
use Illuminate\Support\Facades\Route;

// Ruta base del Dashboard
Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard');

// --- GRUPOS DE RUTAS PROTEGIDAS POR AUTORIZACIÓN (GATES) ---

// GESTIÓN DE ROLES
Route::middleware(['can:manage-roles'])->group(function () {
    Route::resource('roles', RoleController::class);
});

// 🔑 GESTIÓN DE USUARIOS (CORREGIDO)
Route::middleware(['can:manage-users'])->group(function () {
    // 1. Rutas CRUD estándar
    Route::resource('usuarios', UserController::class);

    Route::patch('/admin/usuarios/{usuario}/toggle', [UserController::class, 'toggle'])
    ->name('admin.usuarios.toggle');

});
// GESTIÓN DE MEMBRESIAS
Route::middleware(['can:manage-membresias'])->group(function () {
    Route::resource('membresias', MembresiaController::class);
});