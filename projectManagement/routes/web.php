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
    return view('auth/login');
});

Route::get('/createUser','Auth\RegisterController@registerNew');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/tes/{menu}', 'test@getMenu');
Route::get('/tes/{menu}', 'test@getMenu');
Route::get('/example',function () {
    return view('example');
});