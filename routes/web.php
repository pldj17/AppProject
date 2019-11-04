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
    return view('auth.login');
});
Route::get('user/index','ProfileController@index')->name('user.index'); 

Route::get('profile/update','ProfileController@update')->name('profile.update');

Route::put('profile/password','ProfileController@password')->name('profile.password');

Route::get('profile/edit', 'ProfileController@edit')->name('profile.edit');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
