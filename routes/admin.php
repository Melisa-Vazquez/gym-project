<?php
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MembresiaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard'); // admin.dashboard

Route::middleware(['role:Administrador'])->group(function () {
    Route::resource('roles', RoleController::class); // admin.roles.*
});

Route::middleware(['role:Administrador,Staff'])->group(function () {
    Route::resource('usuarios', UserController::class); // admin.usuarios.*
    Route::patch('/usuarios/{usuario}/toggle', [UserController::class, 'toggle'])
        ->name('usuarios.toggle'); // admin.usuarios.toggle
});

Route::middleware(['role:Administrador,Staff'])->group(function () {
    Route::resource('membresias', MembresiaController::class); // admin.membresias.*
});
