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
    return view('home');
});

Auth::routes();
Route::match(['get', 'post'], 'register', function(){ return redirect('/'); }); // Anula las rutas para registrar  y mostrar formulario
                                                                                    // predeterminados para creación de usuarios.

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {        //Agrupa a las rutas donde es obligatorio loguearse
    Route::get('roles', 'RolController@getRoles')->name('rol');

    Route::get('pedidos', 'ProductoController@index');
    Route::post('cargar', 'ProductoController@cargar');
    Route::get('getproductos', 'ProductoController@getproductos');
    Route::post('comprarSuministros', 'ProductoController@comprarSuministros');

    Route::post('comprar', 'VentaController@comprar')->middleware('rol:0,0,0');
    Route::get('ventas', 'VentaController@index')->middleware('rol:3,2,1');
    Route::get('factura/{id}', 'VentaController@factura');

    Route::get('FormualarioUsuario','UsuarioController@formulario')->name('formulario')->middleware('rol:1,2');        //Muestra la vista del formulario para crear usuario
    Route::post('registrarUsuario','UsuarioController@crearUsuario')->name('register')->middleware('rol:1,2');          //Función del controlador que recibe datos del formulario y crea el nuevo usuario.

});