<?php


Route::group(['middleware' => ['web']], function () {
        Route::get('/', function () {
            return view('welcome');
        });
        /*Redireccion a vistas*/
        Route::get('/ver_usuarios','invitadoController@vista_proyecto');
        Route::get('/inicio','invitadoController@vista_inicio');
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

         Route::get('/login_encargado','autenticarController@vista_loginEncargado');
         Route::post('/login_encargado','autenticarController@login_loginEncargado');
});

Route::group(['prefix' => 'institucion','middleware' => ['institucion']], function () {

        Route::get('/activarmicro', 'herramientasayudaController@actiar_microfono');
        Route::get('/desactivarmicro', 'herramientasayudaController@desactivar_microfono');
        Route::get('/activartext', 'herramientasayudaController@activar_texto');
        Route::get('/desactivartext','herramientasayudaController@desactivar_texto');

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
        Route::get('/perfil_ven/{iduser}', 'institucionController@vista_perfilVen');
        Route::get('/perfil_venInst/{iduser}','institucionController@vista_perfilVenInst');
        Route::get('/perfil_institucion/{idinstitucion}','institucionController@vista_perfilInst');
        Route::get('/datos', 'institucionController@vista_datos');
        Route::post('/actualizar_nombre','institucionController@actualizar_nombre');
        Route::post('/actualizar_rs','institucionController@actualizar_rs');
        Route::post('/actualizar_tel1','institucionController@actualizar_tel1');
        Route::post('/actualizar_tel2','institucionController@actualizar_tel2');
        Route::post('/actualizar_direccion','institucionController@actualizar_direccion');
        Route::post('/actualizar_correo','institucionController@actualizar_correo');
        Route::post('/actualizar_clave','institucionController@actualizar_clave');
        Route::get('/publicarProducto', 'institucionController@vista_publicarProducto');
        Route::get('/paginaweb', 'institucionController@vista_paginaweb');
        Route::post('/publicarProducto','institucionController@publicarproducto');
        Route::get('/grafico','institucionController@vista_grafico');

        Route::get('/my-chart', 'graficosAdminController@graficochart');
        Route::get('/grafico_productosAdmin', 'graficosAdminController@grafico_productosAdmin');

        Route::post('/ingresar_pagweb', 'institucionController@ingresar_pagweb');
        Route::post('/actualizar_nombreArea', 'institucionController@actualizar_nombreArea');
        Route::post('/actualizar_descripcionArea', 'institucionController@actualizar_descripcion');
        Route::get('/generarPassword', 'institucionController@vitsa_generarPassword');
        Route::get('/buscarUsuarioParaCambiarPassword/{buscar}', 'institucionController@buscarUsuarioParaCambiarPassword');
        Route::get('/detalleProducto/{id}', 'institucionController@ver_detalleProducto');
        Route::post('/eliminar_producto_institucion', 'institucionController@eliminar_producto_institucion');
        Route::post('/actualizar_producto_foto', 'institucionController@actualizar_producto_foto');
        Route::post('/actualizar_producto_nombre','institucionController@actualizar_producto_nombre');
        Route::post('/actualizar_producto_descripcion','institucionController@actualizar_producto_descripcion');
        Route::post('/actualizar_producto_cantidad','institucionController@actualizar_producto_cantidad');
        Route::post('/actualizar_producto_visibilidad','institucionController@actualizar_producto_visibilidad');
        Route::post('/actualizar_producto_categoria', 'institucionController@actualizar_producto_categoria');
        Route::post('/actualizar_producto_area', 'institucionController@actualizar_producto_area');
        Route::post('/actualizar_producto_precio', 'institucionController@actualizar_producto_precio');
        Route::post('/eliminar_alumno','alumnoController@eliminar_alumno');
        Route::get('/verDetalleAlumno/{id}', 'alumnoController@vista_detalleAlumno_inst');
        Route::get('/publicarServicio', 'institucionController@vista_publicarServicio'); 
        Route::post('/publicarServicio', 'institucionController@publicarservicio');


});

Route::group(['prefix' => 'userDependiente','middleware' => ['vendedorInstitucional']], function () {

        Route::get('/inicio', 'vendedorDependienteController@vista_inicio');
        Route::get('/logout','autenticarController@logout_venIns');
        Route::get('/cambiarFoto', 'vendedorDependienteController@vista_cambiarFoto');
        Route::post('/guardarFoto', 'vendedorDependienteController@guardar_foto');
        Route::get('/buscador','buscadorController@buscador_ven_inst');
        Route::post('/actualiza_clave', 'vendedorDependienteController@actualiza_clave');
        Route::get('/datos','vendedorDependienteController@vista_datos');
        Route::post('/actualizar_nombre', 'alumnoController@actualizar_nombre');
        Route::post('/actualizar_apellido', 'alumnoController@actualizar_apellido');
        Route::post('/actualizar_tel', 'alumnoController@actualizar_tel');
        Route::post('/actualizar_direccion', 'alumnoController@actualizar_direccion');
        Route::post('/actualizar_correo', 'alumnoController@actualizar_correo');
        Route::post('/actualizar_clave', 'alumnoController@actualizar_clave');
       
        
});
Route::group(['prefix' => 'userIndependiente','middleware'=>['md_vendedor']], function(){

        route::get('/inicio', 'vendedorIndependienteController@vista_inicio');
        Route::get('/cambiarFoto', 'vendedorIndependienteController@vista_cambiarFoto');
        Route::get('/logout','autenticarController@logout_venIns');
        Route::get('/buscador','buscadorController@buscador_ven');
        Route::post('/guardarFoto', 'vendedorIndependienteController@guardar_foto');
});

Route::group(['prefix' => 'encargadoArea', 'middleware' => ['encargadoArea']], function(){

        route::get('/inicio','encargadoController@vista_inicio');
        Route::get('/logout','autenticarController@logout_encargado');
        Route::post('/actualiza_clave', 'encargadoController@actializar_clave');
        Route::get('/datosAreas', 'encargadoController@vista_datosArea');
        Route::get('/equipo', 'encargadoController@vista_equipo');
        Route::get('/publicarProducto','encargadoController@vista_publicarproducto');
        Route::post('/guardarProducto', 'encargadoController@publicarproducto');
        Route::post('/guardarIcono', 'encargadoController@guardarIcono');
        Route::post('/insertarAlumno', 'encargadoController@agregar_alumno');
        Route::get('/clave','encargadoController@vista_clave');
        Route::get('/agregarAlumno', 'encargadoController@vista_agregarAlumno');
        Route::get('/buscador','buscadorController@buscador_encargado');
        Route::get('/perfil_ven/{iduser}', 'encargadoController@vista_perfilVen');
        Route::get('/perfil_venInst/{iduser}','encargadoController@vista_perfilVenInst');
        Route::get('/perfil_institucion/{idinstitucion}','encargadoController@vista_perfilInst');
        Route::post('/publicarProducto','encargadoController@publicarProducto');
        Route::post('/actualizar_correo','encargadoController@actualizar_correo');
        Route::post('/actualizar_numero','encargadoController@actualizar_numero');
        Route::get('/detalleProducto/{id}', 'encargadoController@ver_detalleProducto');
        Route::get('/eliminar_producto_institucion', 'encargadoAreaController@eliminar_producto_institucion');
        Route::post('/actualizar_producto_foto', 'institucionController@actualizar_producto_foto');
        Route::post('/actualizar_producto_nombre','institucionController@actualizar_producto_nombre');
        Route::post('/actualizar_producto_descripcion','institucionController@actualizar_producto_descripcion');
        Route::post('/actualizar_producto_cantidad','institucionController@actualizar_producto_cantidad');
        Route::post('/actualizar_producto_visibilidad','institucionController@actualizar_producto_visibilidad');
        Route::post('/actualizar_producto_categoria', 'institucionController@actualizar_producto_categoria');
        Route::post('/actualizar_producto_area', 'institucionController@actualizar_producto_area');
        Route::post('/actualizar_producto_precio', 'institucionController@actualizar_producto_precio');
        Route::get('/verDetalleAlumno/{id}', 'alumnoController@vista_detalleAlumno_enc');
       
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
Route::get('/foto-encargado', 'encargadoController@traerFotoVendedor');
Route::get('/eliminarEncargado/{id}','institucionController@eliminarEncargado');
Route::get('/traerNombre', 'encargadoController@traerNombre');
Route::get('/estadoClaveAlumno', 'vendedorDependienteController@traerEstadoClave');
Route::get('/estadoClaveEncargado', 'encargadoController@traerEstadoClave');
Route::get('generarClave/{id}', 'alumnoController@generarClave');


/*inicio de usuarios*/



 Route::get('/inicio_cliente', 'clienteController@inicio_cliente');

 Route::get('/sesion_cliente', 'clienteController@sesion_cliente');
 Route::post('/sesion_cliente', 'loginClienteController@authCliente');

 Route::get('/registro_cliente' , 'clienteController@registro_cliente');
 Route::post('/registro_cliente' , 'clienteController@guardar_cliente');
  

 Route::get('/prueba_cliente' , 'clienteController@prueba_cliente');

 Route::get('/vista_productos/{id}' , 'clienteController@vista_productos');


//Socialite Login
Route::post('login/{service}', 'loginClienteController@redirectToProvider');
Route::get('login/{service}/callback', 'loginClienteController@handleProviderCallback');


Route::group(['prefix' => 'cliente', 'middleware' => ['cliente']], function(){

     Route::get('/perfil_cliente' , 'clienteController@perfil_cliente');
     Route::get('/logoutCliente','loginClienteController@logout');
     Route::post('/updCorreo', 'clienteController@updCorreo');
     Route::post('/updTelefono', 'clienteController@updTelefono');
     Route::post('/updClave', 'clienteController@updClave');
     Route::get('/carro_cliente' , 'clienteController@carro_cliente');

});
