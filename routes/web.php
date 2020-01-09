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
Route::get('profile/index','ProfileController@index')->name('profile.index'); 

Route::post('profile/update','ProfileController@update')->name('profile.update');

Route::post('profile/password','ProfileController@password')->name('profile.password');

Route::post('profile/create', 'ProfileController@store')->name('profile.create'); 

// Route::post('profile/avatar', 'ProfileController@avatar')->name('avatar'); 
Route::get('profile/edit','ProfileController@edit')->name('show.avatar');
Route::post('profile/edit','ProfileController@AvatarUpload')->name('avatar');

Route::get('profile/edit', 'ProfileController@edit')->name('profile.edit');

Route::get('profile/ajustes', 'ProfileController@update')->name('profile.ajustes');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::group(['middleware' => ['auth']], function() {
//     Route::resource('roles','RoleController');
//     Route::resource('users','UserController');
//     Route::resource('products','ProductController');
// });

Route::namespace('Admin')->prefix('admin')->middleware(['auth','auth.admin'])->name('admin.')->group(function(){
    Route::resource('users', 'UserController');
});
//administrar roles
Route::namespace('Admin')->prefix('admin')->middleware(['auth','auth.admin'])->name('admin.')->group(function(){
    Route::resource('role', 'RoleController');
});

// Route::resource('role', 'RoleController');
Route::namespace('Admin')->prefix('admin')->middleware(['auth','auth.admin'])->name('admin.')->group(function(){
    Route::resource('permiso', 'PermissionController');
});

Route::namespace('Admin')->prefix('admin')->middleware(['auth','auth.admin'])->name('admin.')->group(function(){
    Route::resource('menu', 'MenuController');
});

Route::group(['prefix' => 'admin', 'namespace' => 'admin'], function(){
    
    // Rutas menu
    Route::get('menu', 'MenuController@index')->name('menu');
    Route::get('menu/crear', 'MenuController@create')->name('crear_menu');
    Route::post('menu', 'MenuController@store')->name('guardar_menu');
    Route::post('menu/guardar-orden', 'MenuController@guardarOrden')->name('guardar_orden');

    // Rutas rol
    Route::get('rol', 'RoleController@index')->name('rol');
    Route::get('rol/crear', 'RoleController@create')->name('crear_rol');
    Route::post('rol', 'RoleController@store')->name('guardar_rol');
    Route::get('rol/{id}/editar', 'RoleController@edit')->name('editar_rol');
    Route::put('rol/{id}', 'RoleController@update')->name('actualizar_rol');
    Route::delete('rol/{id}', 'RoleController@destroy')->name('eliminar_rol');

    // Rutas menu-rol
    Route::get('menu-rol', 'MenuRolController@index')->name('menu_rol');
    // Route::get('menu-role', 'MenuRolController@store')->name('menu_rol');
    Route::post('menu-rol', 'MenuRolController@store')->name('guardar_menu_rol');
});


