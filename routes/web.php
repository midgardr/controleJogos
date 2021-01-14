<?php

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

Route::get('/', ['as'=>'formLogin', 'uses'=> function () {
    return view('login');
}]);
Route::post('/auth/login', ['as'=>'postLogin', 'uses'=>'UserController@login']);
Route::get('login', ['as'=>'login', 'uses'=>'UserController@notAuthorized']);
Route::get('/auth/logout', ['as'=>'logout', 'uses'=>'UserController@logout']);
Route::get('/usuario', ['as'=>'usuario.cadastro', 'uses'=>'UserController@create']);
Route::post('/usuario', ['as'=>'usuario.store', 'uses'=>'UserController@store']);

Route::group(['middleware'=>'auth'], function() {
    Route::group(['prefix'=>'restrita/'], function(){
        Route::get('', ['as'=>'dashboard', 'uses'=>'UserController@dashboard']);
        Route::group(['prefix'=>'usuario/'], function(){
            Route::get('/{user}', ['as'=>'usuario.edit', 'uses'=>'UserController@edit']);
            Route::put('/{user}', ['as'=>'usuario.update', 'uses'=>'UserController@update']);
            Route::get('/delete/{user}', ['as'=>'usuario.delete', 'uses'=>'UserController@delete']);
        });
        Route::group(['prefix'=>'jogos/'], function(){
            Route::get('', ['as'=>'jogo.create', 'uses'=>'JogoController@create']);
            Route::post('', ['as'=>'jogo.store', 'uses'=>'JogoController@store']);
            Route::get('/{jogo}', ['as'=>'jogo.edit', 'uses'=>'JogoController@edit']);
            Route::put('/{jogo}', ['as'=>'jogo.update', 'uses'=>'JogoController@update']);
            Route::get('/delete/{jogo}', ['as'=>'jogo.delete', 'uses'=>'JogoController@delete']);
        });
    });
});
