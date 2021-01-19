<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JogoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [UserController::class, 'formLogin'])->name('formLogin');
Route::post('/auth/login', [UserController::class, 'login'])->name('postLogin');
Route::get('login', [UserController::class, 'notAuthorized'])->name('login');
Route::get('/cadastro', [UserController::class, 'create'])->name('usuario.cadastro');
Route::post('/cadastro', [UserController::class, 'store'])->name('usuario.store');

Route::middleware('auth')->group(function(){
    Route::get('/auth/logout', [UserController::class, 'logout'])->name('logout');
    Route::prefix('restrita/')->group(function(){
        Route::get('', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::prefix('usuario/')->group(function(){
            Route::get('/{user}', [UserController::class, 'edit'])->name('usuario.edit');
            Route::put('/{user}', [UserController::class, 'update'])->name('usuario.update');
            Route::get('/delete/{user}', [UserController::class, 'delete'])->name('usuario.delete');
        });
        Route::prefix('jogo/')->group(function(){
            Route::get('', [JogoController::class, 'index'])->name('jogo.index');
            Route::get('cadastrar', [JogoController::class, 'create'])->name('jogo.create');
            Route::post('', [JogoController::class, 'store'])->name('jogo.store');
            Route::get('{jogo}', [JogoController::class, 'edit'])->name('jogo.edit');
            Route::put('{jogo}', [JogoController::class, 'update'])->name('jogo.update');
            Route::get('{jogo}/delete', [JogoController::class, 'delete'])->name('jogo.delete');
        });
        Route::get('galeria', [JogoController::class, 'galeria'])->name('galeria');
    });
});
