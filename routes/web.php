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


Route::get('/inicio', function () {
    return view('welcome');
})->name('inicio');
   
Route::resource('/home', 'PersonasController');
Route::post('/formulario', 'PersonasController@store');


//Auth::routes();
;

//Route::post('/', 'HomeController@store')->name('home');
//Route::post('/', 'PersonasController@store');
//Route::get('/', 'PersonasController@index');
//Route::get('/', 'HomeController@index');
//Route::post('/', 'DenunciaController@store');

//Route::get('/home', function() {
    //return view('home');
//})->name('home')->middleware('auth');

//Auth::routes();

/*Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');
