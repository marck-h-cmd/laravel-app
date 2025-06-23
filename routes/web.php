<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UnidadController;

Route::get('/',[UserController::class,'showLogin']);

Route::post('/identificacion', [UserController::class,'verificalogin'])->name('identificacion');
Route::get('/', [HomeController::class,'index'])->name('home');
// -----------------categorias
Route::get('/categorias', [CategoriaController::class,'index'])->name('categorias.index');
Route::post('/categorias', [CategoriaController::class,'store'])->name('categorias.store');
Route::get('/categorias/create', [CategoriaController::class,'create'])->name('categorias.create');
Route::get('/categorias/{id}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
Route::put('/categorias/{id}', [CategoriaController::class, 'update'])->name('categorias.update');
Route::get('/categorias/{id}/confirmar',[CategoriaController::class,'confirmar'])->name('categorias.confirmar');
Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
   
// ----------------- unidades
Route::get('/unidades', [UnidadController::class,'index'])->name('unidades.index');
Route::post('/unidades', [UnidadController::class,'store'])->name('unidades.store');
Route::get('/unidades/create', [UnidadController::class,'create'])->name('unidades.create');
Route::get('/unidades/{id}/edit', [UnidadController::class, 'edit'])->name('unidades.edit');
Route::put('/unidades/{id}', [UnidadController::class, 'update'])->name('unidades.update');
Route::get('/unidades/{id}/confirmar',[UnidadController::class,'confirmar'])->name('unidades.confirmar');
Route::delete('/unidades/{id}', [UnidadController::class, 'destroy'])->name('unidades.destroy');

Route::get('/cancelar-unidad',function(){
    return redirect()->route('unidades.index')->with('datos','Accion Terminada...!');
})->name('unidades.cancelar');

// user

Route::get('/users', [UserController::class,'index'])->name('users.index');
Route::post('/users', [UserController::class,'store'])->name('users.store');
Route::get('/users/create', [UserController::class,'create'])->name('users.create');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::get('/users/{id}/confirmar',[UserController::class,'confirmar'])->name('users.confirmar');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

Route::get('/cancelar-users',function(){
    return redirect()->route('users.index')->with('datos','Accion Terminada...!');
})->name('users.cancelar');



Route::resource('productos', ProductoController::class);
Route::get('/productos/{id}/confirmar',[ProductoController::class,'confirmar'])->name('users.confirmar');

Route::get('/cancelar1', function () {
return redirect()->route('productos.index')->with('datos', 'Acción Cancelada'); })->name('cancelar1');
Route::get('/productos/{producto_id}/confirmar', 'ProductoController@confirmar')->name('productos.confirmar');

// Route::get('/clientes', [ClienteController::class,'index'])->name('clientes.index');
  
Route::resource('clientes', ClienteController::class);
Route::get('/clientes/{id}/confirmar',[ClienteController::class,'confirmar'])->name('clientes.confirmar');

Route::get('/cancelar2', function () {
return redirect()->route('clientes.index')->with('datos', 'Acción Cancelada'); })->name('cancelar2');
Route::get('/cancelar',function(){
    return redirect()->route('categorias.index')->with('datos','Accion Terminada...!');
})->name('categorias.cancelar');


Route::resource('categoria',CategoriaController::class);

