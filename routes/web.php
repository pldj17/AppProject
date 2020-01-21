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

Auth::routes(['verify' => true]);

Auth::routes();

//verificacion de correo ->middleware('verified');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function(){

    Route::get('perfil','ProfileController@index')->name('profile.index'); 
    Route::post('perfil/actualizar','ProfileController@update')->name('profile.update');
    Route::post('perfil/password','ProfileController@password')->name('profile.password');
    Route::post('perfil/crear', 'ProfileController@store')->name('profile.create');   
    // Route::post('profile/avatar', 'ProfileController@avatar')->name('avatar'); 
    Route::get('perfil/editar','ProfileController@edit')->name('show.avatar');
    Route::post('perfil/editar','ProfileController@AvatarUpload')->name('avatar');
    Route::get('perfil/editar', 'ProfileController@edit')->name('profile.edit');
    Route::get('perfil/ajustes', 'ProfileController@update')->name('profile.ajustes');  
    Route::get('perfil/informacion', 'ProfileController@info')->name('profile.info');
    Route::get('perfil/contacto', 'ProfileController@contact')->name('profile.contact');

    //galeria
    // Route::get('image-gallery', 'GalleryController@index');
    Route::post('perfil/galeria', 'GalleryController@upload')->name('guardar_foto');
    Route::delete('perfil/galeria/{id}', 'GalleryController@destroy')->name('eliminar_foto');
    Route::get('perfil/galeria', 'GalleryController@index')->name('profile.gallery');
});




Route::group(['prefix' => 'admin', 'namespace' => 'admin', 'middleware' => ['auth', 'admin']], function(){
    
    // Rutas usuario
    Route::get('usuario', 'UserController@index')->name('usuario');
    Route::get('usuario/crear', 'UserController@create')->name('crear_usuario');
    Route::post('usuario', 'UserController@store')->name('guardar_usuario');
    Route::get('usuario/{id}/editar', 'UserController@edit')->name('editar_usuario');
    Route::put('usuario/{id}', 'UserController@update')->name('actualizar_usuario');
    Route::delete('usuario/{id}', 'UserController@destroy')->name('eliminar_usuario');

    // Rutas permisos
    Route::get('permiso', 'PermissionController@index')->name('permiso');
    Route::get('permiso/crear', 'PermissionController@create')->name('crear_permiso');
    Route::post('permiso', 'PermissionController@store')->name('guardar_permiso');
    Route::get('permiso/{id}/editar', 'PermissionController@edit')->name('editar_permiso');
    Route::put('permiso/{id}', 'PermissionController@update')->name('actualizar_permiso');
    Route::delete('permiso/{id}', 'PermissionController@destroy')->name('eliminar_permiso');

    // Rutas menu
    Route::get('menu', 'MenuController@index')->name('menu');
    Route::get('menu/crear', 'MenuController@crear')->name('crear_menu');
    Route::post('menu', 'MenuController@guardar')->name('guardar_menu');
    Route::get('menu/{id}/editar', 'MenuController@editar')->name('editar_menu');
    Route::put('menu/{id}', 'MenuController@actualizar')->name('actualizar_menu');
    Route::get('menu/{id}/eliminar', 'MenuController@eliminar')->name('eliminar_menu');
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
    Route::post('menu-rol', 'MenuRolController@store')->name('guardar_menu_rol');

    // Rutas permiso-rol
    Route::get('permiso-rol', 'PermissionRoleController@index')->name('permiso_rol');
    Route::post('permiso-rol', 'PermissionRoleController@store')->name('guardar_permiso_rol');

});

// Rutas especialidades
Route::get('especialidad', 'SpecialtyController@index')->name('especialidad');
Route::get('especialidad/crear', 'SpecialtyController@create')->name('crear_especialidad');
Route::post('especialidad', 'SpecialtyController@store')->name('guardar_especialidad');
Route::get('especialidad/{id}/editar', 'SpecialtyController@edit')->name('editar_especialidad');
Route::put('especialidad/{id}', 'SpecialtyController@update')->name('actualizar_especialidad');
Route::delete('especialidad/{id}', 'SpecialtyController@destroy')->name('eliminar_especialidad');

