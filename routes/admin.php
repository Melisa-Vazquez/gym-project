<?php
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MembresiaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard');

//GESTIÓN DE ROLES
Route::resource('roles', RoleController::class);

//GESTIÓN DE USUARIOS
Route::resource('usuarios', UserController::class);

//GESTIÓN DE MEMBRESIAS
Route::resource('membresias', MembresiaController::class);
