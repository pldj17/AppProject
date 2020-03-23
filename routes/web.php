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
});

Auth::routes(['verify' => true]);

Auth::routes();

//verificacion de correo ->middleware('verified');

Route::get('/', 'HomeController@index')->name('home');
Route::get('perfil/{id}', 'HomeController@show')->name('perfil_publico');

Route::group(['middleware' => ['auth']], function(){

    Route::get('perfil/{id}','ProfileController@index')->name('perfil'); 
    Route::post('perfil/actualizar','ProfileController@update')->name('update_inf');
    Route::post('perfil/password','ProfileController@password')->name('update_password');

    Route::post('perfil/{user}', 'ProfileController@store')->name('guardar_perfil'); 
    Route::post('perfil/{user}/avatar','ProfileController@AvatarUpload')->name('avatar');
    Route::get('perfil/{user}/editar', 'ProfileController@edit')->name('editar_perfil');

    Route::get('perfil/ajustes', 'ProfileController@update')->name('profile.ajustes');  
    
    // posts
    Route::post('perfil/post/{user}', 'PhotoController@upload')->name('guardar_post');
    Route::delete('perfil/post/{id}', 'PhotoController@destroy')->name('eliminar_post');
    Route::get('perfil/post/{id}', 'PhotoController@index')->name('perfil_post');
    Route::get('perfil/post/{id}/editar', 'PhotoController@edit')->name('editar_post');

    // configuracion
    Route::post('perfil/{user}/configuracion', 'ConfigController@store')->name('config');
    Route::get('perfil/{user}/configuracion', 'ConfigController@index')->name('config');

    // comentarios
    Route::post('perfil/comentarios/{user}', 'CommentsController@store')->name('guardar_comentario');
    Route::delete('perfil/comentario/{comment}', 'CommentsController@destroy')->name('eliminar_comentario');
    Route::get('perfil/comentarios/{comment}', 'CommentsController@show')->name('mostrar_comentarios');
    
    //favoritos
    Route::post('favorite/{post}/add','FavoritesController@add')->name('profile.favorite');
    Route::get('favoritos/{id}', 'FavoritesController@show')->name('mostrar_fav');
    
});




Route::group(['prefix' => 'admin', 'namespace' => 'admin', 'middleware' => ['auth']], function(){
    
    // Rutas usuario
    Route::get('usuario', 'UserController@index')->name('usuario');
    Route::get('usuario/crear', 'UserController@create')->name('crear_usuario');
    Route::post('usuario', 'UserController@store')->name('guardar_usuario');
    Route::get('usuario/{id}/editar', 'UserController@edit')->name('editar_usuario');
    Route::put('usuario/{id}', 'UserController@update')->name('actualizar_usuario');
    Route::delete('usuario/{id}', 'UserController@destroy')->name('eliminar_usuario');
    // Route::get('usuario/{id}/ver', 'UserController@show')->name('ver_perfil');

    // Rutas permisos
    Route::get('permiso', 'PermissionController@index')->name('permiso');
    Route::get('permiso/crear', 'PermissionController@create')->name('crear_permiso');
    Route::post('permiso', 'PermissionController@store')->name('guardar_permiso');
    Route::get('permiso/{id}/editar', 'PermissionController@edit')->name('editar_permiso');
    Route::put('permiso/{id}', 'PermissionController@update')->name('actualizar_permiso');
    Route::delete('permiso/{id}', 'PermissionController@destroy')->name('eliminar_permiso');

    // Rutas menu
    Route::get('menu', 'MenuController@index')->name('menu');
    Route::get('menu/crear', 'MenuController@create')->name('crear_menu');
    Route::post('menu', 'MenuController@store')->name('guardar_menu');
    Route::get('menu/{id}/editar', 'MenuController@edit')->name('editar_menu');
    Route::put('menu/{id}', 'MenuController@update')->name('actualizar_menu');
    Route::get('menu/{id}/eliminar', 'MenuController@destroy')->name('eliminar_menu');
    Route::post('menu/guardar-orden', 'MenuController@storeOrder')->name('guardar_orden');

    // Rutas rol
    Route::get('rol', 'RoleController@index')->name('rol');
    Route::get('rol/crear', 'RoleController@create')->name('crear_rol');
    Route::post('rol', 'RoleController@store')->name('guardar_rol');
    Route::get('rol/{id}/editar', 'RoleController@edit')->name('editar_rol');
    Route::put('rol/{id}', 'RoleController@update')->name('actualizar_rol');
    Route::delete('rol/{id}', 'RoleController@destroy')->name('eliminar_rol');

    // Rutas menu-rol
    Route::get('menu-rol', 'MenuRolController@index')->name('menu_rol');
    Route::post('menu-rol', 'MenuRolController@store')->name('guardar_menu_rol');

    // Rutas permiso-rol
    Route::get('permiso-rol', 'PermissionRoleController@index')->name('permiso_rol');
    Route::post('permiso-rol', 'PermissionRoleController@store')->name('guardar_permiso_rol');

    // Rutas especialidad
    Route::get('especialidad', 'SpecialtyController@index')->name('especialidad');
    Route::get('especialidad/crear', 'SpecialtyController@create')->name('crear_especialidad');
    Route::post('especialidad', 'SpecialtyController@store')->name('guardar_especialidad');
    Route::get('especialidad/{id}/editar', 'SpecialtyController@edit')->name('editar_especialidad');
    Route::put('especialidad/{id}', 'SpecialtyController@update')->name('actualizar_especialidad');
    Route::delete('especialidad/{id}', 'SpecialtyController@destroy')->name('eliminar_especialidad');

});

// // Rutas especialidades
// Route::get('especialidad', 'SpecialtyController@index')->name('especialidad');
// Route::get('especialidad/crear', 'SpecialtyController@create')->name('crear_especialidad');
// Route::post('especialidad', 'SpecialtyController@store')->name('guardar_especialidad');
// Route::get('especialidad/{id}/editar', 'SpecialtyController@edit')->name('editar_especialidad');
// Route::put('especialidad/{id}', 'SpecialtyController@update')->name('actualizar_especialidad');
// Route::delete('especialidad/{id}', 'SpecialtyController@destroy')->name('eliminar_especialidad');

