<?php

use App\Http\Controllers\RecursoController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('/Recurso', RecursoController::class)->names('recurso');
});



Route::get('/login/google', [AuthController::class, 'redirectToGoogle']);
Route::get('/login/google/callback', [AuthController::class, 'handleGoogleCallback']);

//falta aregar funcionalidad de fotos en foto de perfil(corregir)