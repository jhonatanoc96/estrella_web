<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

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
    return redirect('/home');
});

Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/session/{route}/{token}/{uid}/{name}/{lastname}/{email}/{phone_number}/{state}/{id_user_type}', 'App\Http\Controllers\SessionController@session')->name('session');
Route::get('/session/{route}/{token}/{uid}/{name}/{lastname}/{email}/{phone_number}/{state}/{id_user_type}', 'App\Http\Controllers\SessionController@session')->name('session');
Route::get('/images', 'App\Http\Controllers\EventoController@images')->name('images');
Route::post('/store-files', 'App\Http\Controllers\EventoController@storeImages')->name('store-files');
Route::post('/store-main-photo', 'App\Http\Controllers\EventoController@storeMainPhoto')->name('store-main-photo');
Route::post('/update-event', 'App\Http\Controllers\EventoController@updateEvent')->name('update-event');

Route::group(['middleware' => 'mongo'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::get('profileCreate', ['as' => 'profile.create', 'uses' => 'App\Http\Controllers\ProfileController@create']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('eventos', ['as' => 'eventos.index', 'uses' => 'App\Http\Controllers\EventoController@index']);
	Route::get('eventosCreate', ['as' => 'eventos.create', 'uses' => 'App\Http\Controllers\EventoController@create']);
	Route::get('eventosEdit/{id}', ['as' => 'eventos.edit', 'uses' => 'App\Http\Controllers\EventoController@edit']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	 Route::get('map', function () {return view('pages.maps');})->name('map');
	 Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	 Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

