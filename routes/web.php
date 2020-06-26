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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/logout', function(){
    Auth::guard('web')->logout();
    Auth::guard('admin')->logout();
    return redirect(route('home'));
})->name('logOut');

// Route for jenisusaha 

Route::resource('jenisUsaha', 'JenisUsahaController');

// Route::get('jenisusaha', 'JenisUsahaController@index')->name('admin.jenisusaha.index');
// Route::get('jenisusaha/create', 'JenisUsahaController@create')->name('admin.jenisusaha.create');
// Route::post('jenisusaha/create', 'JenisUsahaController@store')->name('admin.jenisusaha.store');
// Route::get('jenisusaha/{id}/edit', 'JenisUsahaController@edit')->name('admin.jenisusaha.edit');
// Route::patch('jenisusaha/{id}', 'JenisUsahaController@update')->name('admin.jenisusaha.update');
// Route::delete('jenisusaha/{id}', 'JenisUsahaController@destroy')->name('admin.jenisusaha.destroy');

// Route::get('/home', 'HomeController@index')->name('home');
Route::resource('pemilik', 'OwnerController');
Route::resource('usaha', 'UsahaController');

// Route Profile
Route::get('/profile', 'ProfileController@show')->name('owner.profile.show');
Route::get('/profile', 'ProfileController@show')->name('profile.index');
Route::get('/profile/{id}/edit', 'ProfileController@edit')->name('owner.profile.edit');
Route::put('/profile/{id}', 'ProfileController@update');

Route::get('/usulanUsaha', 'HomeController@create')->name('usulanUsaha');
Route::post('/usulanUsaha', 'HomeController@store')->name('usulanUsaha.store');
Route::get('/usaha/{id}/usulan', 'UsahaController@detail')->name('usulanUsaha.detail');
Route::get('/usulanUsaha/{id}/edit', 'UsahaController@ubah')->name('usulanUsaha.ubah');
Route::post('/usulanUsaha/{id}/update', 'UsahaController@perbarui')->name('usulanUsaha.perbarui');

Route::get('/json/usaha', 'HomeController@usahaJson')->name('usaha.json');

Route::post('/usulanUsaha/confirm', 'UsahaController@confirm')->name('usulanUsaha.confirm');
Route::post('/usulanUpdate/confirm', 'UsahaController@konfirmasiUsulan')->name('usulanUsaha.konfirm');
Route::post('/usulanPemilik/confirm', 'OwnerController@confirm')->name('usulanPemilik.confirm');
