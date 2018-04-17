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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/registro','HomeController@registro_empresa')->name('registro_empresa');

Route::post('/solicitud-de-reserva','HomeController@solicitud_reserva')->name('solicitud_reserva');
