<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'InicioController@index')->name('inicio');
// para cachear las rutas, siempre esta es la manera de realizarlo
//Route::get('admin/permiso', 'Admin\PermisoController@index')->name('permiso');

Route::get('seguridad/login', 'Seguridad\LoginController@index')->name('login');
Route::post('seguridad/login', 'Seguridad\LoginController@login')->name('login_post');
Route::get('seguridad/logout', 'Seguridad\LoginController@logout')->name('logout');

/**
 * Estamos aplicando el middleware auth para indicar que solo los usuarios autenticados
 * puedan acceder a las rutas del grupo admin.
 * Cuando el usuario no esta autenticado e intente ingresar a una ruta protegida como las
 * las rutas del grupo admin, el middleware va a intervenir y validara el acceso o no, en caso
 * que invalide el acceso por motivos de falta de acreditacion o autenticacion, el middleware
 * hara una redireccion hacia la ruta login( route('login') ) dicha ruta esta indicada en la ruta
 * seguridad/login del Controlador LoginController@index
 */
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'superadmin']], function () {

    Route::get('/', 'AdminController@index');

    // Permiso
    Route::get('permiso', 'PermisoController@index')->name('permiso');
    Route::get('permiso/crear', 'PermisoController@crear')->name('permiso_crear');

    // Menu
    Route::get('menu','MenuController@index')->name('menu'); // lista de menus
    Route::get('menu/crear', 'MenuController@crear')->name('crear_menu'); // formulario de crear
    Route::post('menu', 'MenuController@guardar')->name('guardar_menu'); // guardar datos de menu en la bd
    Route::post('menu/guardar-orden', 'MenuController@guardarOrden')->name('guardar-orden');

    // Rol
    Route::get('rol', 'RolController@index')->name('rol');
    Route::get('rol/crear', 'RolController@crear')->name('crear_rol');
    Route::get('rol/{id}/editar', 'RolController@editar')->name('editar_rol');
    Route::post('rol', 'RolController@guardar')->name('guardar_rol');
    Route::put('rol/{id}/actualizar', 'RolController@actualizar')->name('actualizar_rol');
    Route::delete('rol/{id}/eliminar', 'RolController@eliminar')->name('eliminar_rol');
    //Menu-rol
    Route::get('menu-rol','MenuRolController@index')->name('menu_rol');
    Route::post('menu-rol', 'MenuRolController@guardar')->name('guardar_menu_rol');
});
