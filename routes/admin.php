<?php
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard');

//GESTIÓN DE ROLES
Route::resource('roles', RoleController::class);

//GESTIÓN DE USUARIOS
Route::resource('usuarios', UserController::class);
