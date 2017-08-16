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
Route::group(['middleware' => ['web']], function () {
        Route::get('/', function () {
            return view('welcome');
        });
        /*Redireccion a vistas*/
        Route::get('/inicio','invitadoController@vista_proyecto');
        Route::get('/ayuda','invitadoController@vista_ayuda');
        Route::get('/registros','invitadoController@vista_registros');
        Route::get('/formUsuario','invitadoController@vista_formUser');
        Route::get('/formUsuarioInstitucion','invitadoController@vista_formUserInstituto');
        Route::get('formInstitucion','invitadoController@vista_formInstitucion');
        Route::post('/guardarInstitucion', 'crud_institucionController@insertar');

        Route::get('/login_institucion','autenticarController@vista_login');
        Route::post('/login_institucion','autenticarController@login');

        Route::get('/login_vendedorInst','autenticarController@vista_loginVenInst');
        Route::post('/login_vendedorInst','autenticarController@login_vendedorInst');

        route::get('/login_vendedor','autenticarController@vista_loginVendedor');
        route::post('/login_vendedor','autenticarController@login_vendedor');

         Route::post('/insertar', 'vendedorDependienteController@insertar');
         Route::post('/insertar_vendedor', 'vendedorIndependienteController@insertar_vendedorIndependiente');
});

Route::group(['prefix' => 'institucion','middleware' => ['institucion']], function () {

        Route::get('/activarmicro', 'herramientasayudaController@actiar_microfono');
        Route::get('/desactivarmicro', 'herramientasayudaController@desactivar_microfono');
        Route::get('/activartext', 'herramientasayudaController@activar_texto');
        Route::get('/desactivartext','herramientasayudaController@desactivar_texto');

        Route::get('/logout','autenticarController@logout');
        Route::get("/index", 'institucionController@vista_institucion');
        Route::get("/agregarAE", 'institucionController@vista_agregarAE');
        Route::get('/verArea/{id}','areaController@vista_area');
        Route::get('/correo','emailController@send');
        Route::get('/notificacio_vendedor', 'institucionController@vista_notificacio_vendedor');
});

Route::group(['prefix' => 'userDependiente','middleware' => ['vendedorInstitucional']], function () {

        Route::get('/index', 'vendedorDependienteController@vista_inicio');
        Route::get('/logout','autenticarController@logout_venIns');

        
});
Route::group(['prefix' => 'userIndependiente', 'middleware' => ['vendedor']], function(){

        route::get('/index', function(){

            return "hola mundo del vendedor";
        });
});



Route::get('/activarmicro', 'herramientasayudaController@actiar_microfono');
Route::get('/desactivarmicro', 'herramientasayudaController@desactivar_microfono');
Route::get('/activartext', 'herramientasayudaController@activar_texto');
Route::get('/desactivartext','herramientasayudaController@desactivar_texto');


/* Peticiones ajax mediante vue y vue-resource */

Route::get('/traerDatosInstitucion', 'institucionController@traerDatosInstitucion');
Route::post('/insertarDatosAreas','institucionController@insertarArea');
Route::get('/mostrarAreas', 'institucionController@traerAreas');
Route::get('/filtrarArea/{id}','invitadoController@filtroArea');
Route::post('/aceptarSolicitudUsuario','institucionController@aceptarSolicitudUsuario');
Route::get('/traerNotificaciones', 'institucionController@traerNotificaciones');
Route::get('/foto','vendedorDependienteController@fotoPerfil');




