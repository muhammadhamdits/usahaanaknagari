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

// Route::get('/home', 'HomeController@index')->name('home');
Route::resource('owners', 'OwnerController');
Route::resource('usaha', 'UsahaController');