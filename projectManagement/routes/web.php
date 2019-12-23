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
    return redirect('login');
});

Route::get('/createUser','Auth\RegisterController@registerNew');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/tes/{menu}', 'test@getMenu');
Route::get('/tes aja',function () {
    return view('example');
});
Route::get('/example',function () {
    return view('example');
});

Route::get('/example2',function () {
    return view('example2');
});
Route::get('/example3',function () {
    return view('example3');
});

Route::prefix('user')->group(function (){
    
    Route::get('/','UserController@index');
    Route::get('/view user','UserController@index');
    Route::get('/create user','UserController@registerNew');
    Route::get('/detail user/{id}','UserController@detail');
    Route::get('/edit user/{id}','UserController@viewEdit');
    Route::post('/edit user','UserController@editUser');
    Route::post('/add user','UserController@addUser');
});

Route::prefix('division')->group(function(){
    Route::get('/','DivisionController@index');
    Route::get('/view division','DivisionController@index');
    Route::get('/create division','DivisionController@registerNew');
    Route::get('/detail division/{id}','DivisionController@detail');
    Route::get('/edit division/{id}','DivisionController@viewEdit');
    Route::post('/edit division','DivisionController@editDivision');
});

Route::prefix('admin')->group(function(){
    Route::get('/',function () {return redirect('user');});
});

Route::prefix('hoa')->group(function(){
    Route::get('/','HoaController@index');
    Route::get('/detail/{id}','HoaController@detail');
    Route::post('/user/approve','HoaController@userApprove');
    Route::post('/user/disapprove','HoaController@userDisapprove');
});