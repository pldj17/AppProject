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

use ProjectApp\Exports\UsersExport;

Auth::routes(['verify' => true]);

// offline PWA
Route::get('/offline', function () {    
    return view('modules/laravelpwa/offline');
});

Route::get('/', function () {
    return view('dashboard');
});



// Auth::routes();



//verificacion de correo ->middleware('verified');

Route::get('/', 'HomeController@index')->name('home');
Route::get('perfil/{id}', 'HomeController@show')->name('perfil_publico');

Route::group(['middleware' => ['auth', 'verified']], function(){

    Route::get('perfil/{id}','ProfileController@index')->name('perfil'); 
    Route::post('perfil/actualizar','ConfigController@update')->name('update_inf');
    Route::post('perfil/password','ProfileController@password')->name('update_password');

    Route::post('perfil/{user}', 'ProfileController@store')->name('guardar_perfil'); 
    Route::post('perfil/{user}/avatar','ProfileController@AvatarUpload')->name('avatar');
    Route::get('perfil/{user}/editar', 'ProfileController@edit')->name('editar_perfil');

    Route::get('perfil/ajustes', 'ProfileController@update')->name('profile.ajustes');  
    
    //informacion de contacto
    Route::get('perfil/contacto/{id}', 'ProfileController@contact')->name('perfil_contact');

    // posts
    Route::post('perfil/post/{user}', 'PhotoController@upload')->name('guardar_post');
    Route::delete('perfil/post/{id}', 'PhotoController@destroy')->name('eliminar_post');
    Route::get('perfil/post/{id}', 'PhotoController@index')->name('perfil_post');
    Route::get('perfil/post/{id}/editar', 'PhotoController@edit')->name('editar_post');

    // configuracion
    Route::post('perfil/{user}/configuracion', 'ConfigController@store')->name('config');
    Route::get('perfil/{user}/configuracion', 'ConfigController@index')->name('config');
    Route::post('perfil/{user}/active', 'ConfigController@active')->name('active');
    Route::get('config/{id}/editar', 'ConfigController@editName')->name('editar_config');
    Route::put('config/{id}', 'ConfigController@updateName')->name('upda_confName');
    Route::put('config/{id}/email', 'ConfigController@updateEmail')->name('update_email');
    Route::post('perfil/config/email','ConfigController@verificar_contrasena')->name('verificar_contrasena');


    // comentarios
    Route::post('perfil/comentarios/{user}', 'CommentsController@store')->name('guardar_comentario');
    Route::delete('perfil/comentario/{comment}', 'CommentsController@destroy')->name('eliminar_comentario');
    Route::get('perfil/comentarios/{id}{post}', 'CommentsController@show')->name('mostrar_comentarios');
    Route::get('/comentarios/{id}', 'CommentsController@comment')->name('noti_comment');
    Route::post('/comentarios/read', 'CommentsController@readComment')->name('read_comment');
    
    //favoritos
    Route::post('favorite/{perfil}/add','FavoritesController@add')->name('profile.favorite');
    Route::get('favoritos/{id}', 'FavoritesController@show')->name('mostrar_fav');

    //rating - puntuaciones de perfiles por servicios
    route::get('perfil/{id}/puntuar', 'RatingController@index')->name('rating');
    Route::post('rating/{id}/puntar','RatingController@store')->name('new_rating');
    Route::delete('perfil/{rating}/eliminar', 'RatingController@destroy')->name('eliminar_rating');
    Route::get('perfil/{id}/rating', 'RatingController@edit')->name('editar_rating');
    Route::put('perfil/{id}/rating', 'RatingController@update')->name('actualizar_rating');
    
});


Route::group(['prefix' => 'admin', 'namespace' => 'admin', 'middleware' => ['auth', 'verified']], function(){
    
    // Rutas usuario
    Route::get('usuario', 'UserController@index')->name('usuario');
    Route::get('usuario/crear', 'UserController@create')->name('crear_usuario');
    Route::post('usuario', 'UserController@store')->name('guardar_usuario');
    Route::get('usuario/{id}/editar', 'UserController@edit')->name('editar_usuario');
    Route::put('usuario/{id}', 'UserController@update')->name('actualizar_usuario');
    Route::delete('usuario/{id}', 'UserController@destroy')->name('eliminar_usuario');
    Route::get('user/report', 'UserController@report')->name('pdf');
    Route::get('user/reportExcel', 'UserController@reportExcel')->name('excel');
    Route::get('user/reportCsv', 'UserController@reportCvs')->name('csv');

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