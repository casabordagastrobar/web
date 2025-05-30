<?php

use App\Http\Controllers\Auth\EntradasController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Auth\HomeController;
use App\Http\Controllers\Auth\PerfilController;
use App\Http\Controllers\Auth\ProductoController;
use App\Http\Middleware\JefeMiddleware;
use App\Http\Controllers\Auth\SalidaController;

// Página de inicio / login
Route::get('/', [LoginController::class, 'index']);
Route::post('/', [LoginController::class, 'iniciarSesion'])->name('login');

// Rutas protegidas para cualquier usuario autenticado (admin u operador)
Route::middleware(['auth'])->group(function () {
    // Dashboard según rol
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/operador/dashboard', function () {
        return view('operador.dashboard');
    })->name('operador.dashboard');

    // Logout
    Route::post('/logout', function () {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Has cerrado sesión correctamente.');
    })->name('logout');
});

// Rutas exclusivas para el admin
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    // Gestión de usuarios
    Route::get('/usuarios/crear', [HomeController::class, 'crearUsuario'])->name('usuarios.crear');
    Route::post('/usuarios', [HomeController::class, 'guardarUsuario'])->name('usuarios.guardar');

    Route::delete('/usuarios/{id}', [HomeController::class, 'eliminarUsuario'])->name('usuarios.eliminar');
    Route::get('/usuarios/{id}/editar', [HomeController::class, 'modificarUsuario'])->name('usuarios.editar');
    Route::post('/usuarios/{id}/actualizar', [HomeController::class, 'actualizarUsuario'])->name('usuarios.actualizar');
});


Route::get('/usuarios', [HomeController::class, 'listarUsuarios'])->name('usuarios.index');




Route::post('/perfil/actualizar', [PerfilController::class, 'actualizar'])->name('perfil.actualizar');
Route::get('/usuarios/{id}/editar', [HomeController::class, 'modificarUsuario'])->name('usuarios.editar');
Route::post('/usuarios/{id}/actualizar', [HomeController::class, 'actualizarUsuario'])->name('usuarios.actualizar');
Route::delete('/usuarios/{id}', [HomeController::class, 'eliminarUsuario'])->name('usuarios.eliminar');

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/productos/crear', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/productos/{id}/editar', [ProductoController::class, 'edit'])->name('productos.editar');
    Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('productos.actualizar');
    Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.eliminar');
});


Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/entradas', [EntradasController::class, 'index'])->name('entradas.index');
    Route::get('/entradas/crear', [EntradasController::class, 'create'])->name('entradas.create');
    Route::post('/entradas', [EntradasController::class, 'store'])->name('entradas.store');
    Route::get('/entradas/{id}/editar', [EntradasController::class, 'edit'])->name('entradas.edit');
    Route::put('/entradas/{id}', [EntradasController::class, 'update'])->name('entradas.update');
    Route::delete('/entradas/{id}', [EntradasController::class, 'destroy'])->name('entradas.destroy');
});


Route::middleware(['auth', JefeMiddleware::class])->group(function () {
    Route::get('/bodega/dashboard', function () {
        return view('bodega.dashboard');
    })->name('bodega.dashboard');
});


Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/salidas', [SalidaController::class, 'index'])->name('salidas.index');
    Route::get('/salidas/crear', [SalidaController::class, 'create'])->name('salidas.create');
    Route::post('/salidas', [SalidaController::class, 'store'])->name('salidas.store');
    Route::get('/salidas/{id}/editar', [SalidaController::class, 'edit'])->name('salidas.edit');
    Route::put('/salidas/{id}', [SalidaController::class, 'update'])->name('salidas.update');
    Route::delete('/salidas/{id}', [SalidaController::class, 'destroy'])->name('salidas.destroy');
});


