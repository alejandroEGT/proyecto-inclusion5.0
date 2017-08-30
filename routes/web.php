<?php


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

        /*Route::get('/activarmicro', 'herramientasayudaController@actiar_microfono');
        Route::get('/desactivarmicro', 'herramientasayudaController@desactivar_microfono');
        Route::get('/activartext', 'herramientasayudaController@activar_texto');
        Route::get('/desactivartext','herramientasayudaController@desactivar_texto');*/

        Route::get('/logout','autenticarController@logout');
        Route::get("/inicio", 'institucionController@vista_institucion');
        Route::get("/agregarAE", 'institucionController@vista_agregarAE');
        Route::get('/agregarAlumno','institucionController@vista_agregarAlumno');
        Route::post('/agregarAlumno_insert','institucionController@agregar_alumno');
        Route::post('/agregarUsuario', 'areaController@agregarUsuario');
        Route::get('/verArea/{id}','areaController@vista_area');
        Route::get('/correo','emailController@send');
        Route::get('/notificacio_vendedor', 'institucionController@vista_notificacio_vendedor');
        Route::get('/misionyvision', 'institucionController@vista_misionyvision');
        Route::get('/noticia', 'institucionController@vista_noticia');
        Route::get('/buscador','buscadorController@buscador_inst');
        Route::get('/datos', 'institucionController@vista_datos');
});

Route::group(['prefix' => 'userDependiente','middleware' => ['vendedorInstitucional']], function () {

        Route::get('/inicio', 'vendedorDependienteController@vista_inicio');
        Route::get('/logout','autenticarController@logout_venIns');
        Route::get('/cambiarFoto', 'vendedorDependienteController@vista_cambiarFoto');
        Route::post('/guardarFoto', 'vendedorDependienteController@guardar_foto');
        Route::get('/buscador','buscadorController@buscador_ven_inst');
        
});
Route::group(['prefix' => 'userIndependiente', 'middleware' => ['vendedor']], function(){

        route::get('/inicio', 'vendedorIndependienteController@vista_inicio');
        Route::get('/cambiarFoto', 'vendedorIndependienteController@vista_cambiarFoto');
        Route::get('/logout','autenticarController@logout_venIns');
        Route::get('/buscador','buscadorController@buscador_ven');
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
Route::post('/agregar_mision', 'institucionController@agregar_mision');
Route::post('/agregar_vision', 'institucionController@agregar_vision');
Route::get('/traer_mision', 'institucionController@traer_mision');
Route::get('/traer_vision', 'institucionController@traer_vision');
Route::post('/traerEncargado', 'areaController@traer_encargado');
Route::get('/foto-vendedorIns', 'vendedorDependienteController@traerFotoVendedor');
Route::get('/foto-vendedor', 'vendedorIndependienteController@traerFotoVendedor');

