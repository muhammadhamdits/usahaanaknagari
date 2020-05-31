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
    return view('dashboard');
})->name('home');

Auth::routes();

Route::get('/logout', function(){
    Auth::guard('web')->logout();
    Auth::guard('admin')->logout();
    return redirect(route('home'));
})->name('logOut');

// Route for jenisusaha 

Route::resource('jenisusaha', 'JenisUsahaController');

// Route::get('jenisusaha', 'JenisUsahaController@index')->name('admin.jenisusaha.index');
// Route::get('jenisusaha/create', 'JenisUsahaController@create')->name('admin.jenisusaha.create');
// Route::post('jenisusaha/create', 'JenisUsahaController@store')->name('admin.jenisusaha.store');
// Route::get('jenisusaha/{id}/edit', 'JenisUsahaController@edit')->name('admin.jenisusaha.edit');
// Route::patch('jenisusaha/{id}', 'JenisUsahaController@update')->name('admin.jenisusaha.update');
// Route::delete('jenisusaha/{id}', 'JenisUsahaController@destroy')->name('admin.jenisusaha.destroy');

// Route::get('/home', 'HomeController@index')->name('home');

