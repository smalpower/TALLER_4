<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EgresadoController;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Mostrar la lista de usuarios
Route::get('/home', [UserController::class, 'index'])->name('users.index');
Route::post('/home/{user}/assign-role', [UserController::class, 'assignRole'])->name('users.assignRole');
Route::delete('/home/{user}/remove-role/{role}', [UserController::class, 'removeRole'])->name('users.removeRole');
Route::resource('egresados', EgresadoController::class);

