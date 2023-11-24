<?php
use App\Http\Controllers\AccessController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [AccessController::class, 'index']);
Route::get('/destino/{id}', [AccessController::class, 'destination'])->name('destination');
Route::get('/profile', [AccessController::class, 'profile'])->name('profile');
// Login    
Route::get('/login', [AccessController::class, 'login'])->name('login');
Route::post('/login', [AccessController::class, 'authenticate'])->name('auth.authenticate');

// Register
Route::get('/register', [AccessController::class, 'register'])->name('auth.register');
Route::post('/register', [AccessController::class, 'store'])->name('auth.store');

// Logout
Route::get('/logout', [AccessController::class, 'logout'])->name('auth.logout');

//compra
Route::get('/compra', [AccessController::class, 'compra'])->name('compra');

//Imagen de perfil

Route::get('/formulario-imagen', [ImagenController::class, 'mostrarFormulario'])->name('nombre_de_tu_ruta_para_mostrar_formulario');
Route::post('/guardar-imagen', [ImagenController::class, 'guardarImagen'])->name('guardar.imagen');

// routes/web.php


Route::get('/compra/{idCompra}', 'CompraController@mostrarCompra');
