<?php

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

Route::get('/', 'CuboController@index');

Route::post('/configurar', 'CuboController@configurar');

Route::post('/actualizar', 'CuboController@actualizar');

Route::post('/consultar', 'CuboController@consultar');