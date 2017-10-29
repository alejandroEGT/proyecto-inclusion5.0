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
         Route::get('/recuperarPassword', 'invitadoController@vista_recuperarPassword');
         Route::post('/resetPass','invitadoController@resetPass');
         Route::get('/codigo_reset','invitadoController@vista_codigo_reset');
         Route::post('/resetPassGo','invitadoController@resetPassGo');
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
        Route::post('/actualizar_rut','institucionController@actualizar_rut');
        Route::post('/actualizar_nombre','institucionController@actualizar_nombre');
        Route::post('/actualizar_rs','institucionController@actualizar_rs');
        Route::post('/actualizar_tel1','institucionController@actualizar_tel1');
        Route::post('/actualizar_tel2','institucionController@actualizar_tel2');
        Route::post('/actualizar_direccion','institucionController@actualizar_direccion');
        Route::post('/actualizar_correo','institucionController@actualizar_correo');
        Route::post('/actualizar_clave','institucionController@actualizar_clave');
        Route::post('/actualizar_logo','institucionController@actualizar_logo');
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
        Route::get('/detalleServicio/{id}','institucionController@ver_detalleServicio');
        Route::get('/detalleServicio/{idServicio}/{idInstitucion}', 'institucionController@ver_detalleServicio_institucion_local');
        Route::get('/detalleProducto/{id}', 'institucionController@ver_detalleProducto');
        Route::get('/detalleProducto/{idProducto}/{idInstitucion}', 'institucionController@ver_detalleProducto_institucion_local');
         Route::get('/eliminar_producto_institucion/{idProducto}', 'institucionController@eliminar_producto_institucion');
        Route::get('/eliminar_servicio_institucion/{idServicio}', 'institucionController@eliminar_servicio_institucion');   
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
        Route::get('/filtrarProducto', 'institucionController@filtrarProducto');
        Route::get('/filtrarServicio', 'institucionController@filtrarServicio');
        Route::get('/productosOcultos','institucionController@productos_oclutos');
        Route::get('/serviciosOcultos', 'institucionController@servicios_ocultos');
        Route::post('/publicarNoticia', 'institucionController@publicarNoticia');
        Route::post('/actualizar_nombre_alumno', 'institucionController@actualizar_nombre_alumno');
        Route::post('/actualizar_apellido_alumno', 'institucionController@actualizar_apellido_alumno');
        Route::post('/actualizar_correo_alumno', 'institucionController@actualizar_correo_alumno');
        Route::post('/actualizar_area_alumno', 'institucionController@actualizar_area_alumno');
        Route::post('/actualizar_numero_alumno', 'institucionController@actualizar_numero_alumno');
        Route::post('/actualizar_foto_alumno', 'institucionController@actualizar_foto_alumno');
        Route::get('/verNoticiasLocales', 'institucionController@todas_noticias_locales');
        Route::get('/verNoticiasGenerales', 'institucionController@todas_noticias_generales');
        Route::post('/actualizar_titulo_noticia', 'institucionController@actualizar_titulo_noticia');
        Route::post('/actualizar_texto_noticia', 'institucionController@actualizar_texto_noticia');
        Route::post('/actualizar_estado_noticia', 'institucionController@actualizar_estado_noticia');
        Route::get('/traerProductoEnEspera','institucionController@traerProductoEnEspera');
        Route::get('/traerServicioEnEspera','institucionController@vista_serviciosEspera');
        Route::post('/actualizar_servicio_nombre','institucionController@actualizar_servicio_nombre');
        Route::post('/actualizar_servicio_descripcion','institucionController@actualizar_servicio_descripcion');
        Route::post('/actualizar_servicio_categoria','institucionController@actualizar_servicio_categoria');
        Route::post('/actualizar_servicio_visibilidad','institucionController@actualizar_servicio_visibilidad');
        Route::post('/actualizar_servicio_area','institucionController@actualizar_servicio_area');
        Route::post('/actualizar_servicio_foto','institucionController@actualizar_servicio_foto');
        Route::get('/ver_todo_producto','institucionController@ver_todo_producto');
        Route::get('/ver_todo_servicio','institucionController@ver_todo_servicio');
        Route::get('/detalleNoticia_general/{idNoticia}','institucionController@ver_detalleNoticia_general');
        Route::get('/detalleNoticia_local/{idNoticia}','institucionController@ver_detalleNoticia_local');
        Route::get('/areaExtern/{idInstitucion}/{idArea}', 'institucionController@vista_areaExterna');

});

Route::group(['prefix' => 'userDependiente','middleware' => ['vendedorInstitucional']], function () {

        Route::get('/inicio', 'vendedorDependienteController@vista_inicio');
        Route::get('/logout','autenticarController@logout_venIns');
        Route::get('/cambiarFoto', 'vendedorDependienteController@vista_cambiarFoto');
        Route::post('/guardarFoto', 'vendedorDependienteController@guardar_foto');
        Route::get('/buscador','buscadorController@buscador_ven_inst');
        Route::post('/actualiza_clave', 'vendedorDependienteController@actualiza_clave');
        Route::get('/datos','vendedorDependienteController@vista_datos');
        Route::post('/actualizar_foto','alumnoController@actualizar_foto');
        Route::post('/actualizar_nombre', 'alumnoController@actualizar_nombre');
        Route::post('/actualizar_apellido', 'alumnoController@actualizar_apellido');
        Route::post('/actualizar_tel', 'alumnoController@actualizar_tel');
        Route::post('/actualizar_direccion', 'alumnoController@actualizar_direccion');
        Route::post('/actualizar_fecha', 'alumnoController@actualizar_fecha');
        Route::post('/actualizar_correo', 'alumnoController@actualizar_correo');
        Route::post('/actualizar_clave', 'alumnoController@actualizar_clave');
        Route::get('/publicarProducto', 'alumnoController@vista_publicarProducto');
        Route::post('/guardarProducto', 'alumnoController@publicarproducto');
        Route::get('/publicarServicio', 'alumnoController@vista_publicarServicio');
        Route::post('/publicarServicio', 'alumnoController@publicarServicio');
        Route::get('/filtrarProducto', 'alumnoController@filtrarProducto');
        Route::get('/filtrarServicio', 'alumnoController@filtrarServicio');
        Route::get('/detalleProducto/{id}', 'alumnoController@ver_detalleProducto');
        Route::get('/detalleServicio/{id}','alumnoController@ver_detalleServicio');
        Route::post('/actualizar_producto_foto', 'institucionController@actualizar_producto_foto');
        Route::post('/actualizar_producto_nombre','institucionController@actualizar_producto_nombre');
        Route::post('/actualizar_producto_descripcion','institucionController@actualizar_producto_descripcion');
        Route::post('/actualizar_producto_categoria', 'institucionController@actualizar_producto_categoria');
        Route::get('/ver_todo_producto','alumnoController@ver_todo_producto');
        Route::get('/ver_todo_servicio','alumnoController@ver_todo_servicio');
        Route::get('/verNoticiasGenerales', 'alumnoController@todas_noticias_generales');
        Route::get('/verNoticiasLocales', 'alumnoController@todas_noticias_locales');
        Route::get('/detalleNoticia_general/{idNoticia}','alumnoController@ver_detalleNoticia_general');
        Route::get('/detalleNoticia_local/{idNoticia}','alumnoController@ver_detalleNoticia_local');
        Route::get('/perfil_venInst/{iduser}','alumnoController@vista_perfilVenInst');
        Route::get('/perfil_institucion/{idinstitucion}','alumnoController@vista_perfilInst');
        Route::get('/areaExtern/{idInstitucion}/{idArea}', 'alumnoController@vista_areaExterna');
        Route::get('/detalleProducto/{idProducto}/{idInstitucion}', 'alumnoController@ver_detalleProducto_institucion_local');
        Route::post('/actualizar_servicio_nombre','institucionController@actualizar_servicio_nombre');
        Route::post('/actualizar_servicio_descripcion','institucionController@actualizar_servicio_descripcion');
        Route::post('/actualizar_servicio_categoria','institucionController@actualizar_servicio_categoria');
        Route::post('/actualizar_servicio_foto','institucionController@actualizar_servicio_foto');

       
        
});
Route::group(['prefix' => 'userIndependiente','middleware'=>['md_vendedor']], function(){

        route::get('/inicio', 'vendedorIndependienteController@vista_inicio');
        Route::get('/cambiarFoto', 'vendedorIndependienteController@vista_cambiarFoto');
        Route::get('/logout','autenticarController@logout_venIns');
        Route::get('/buscador','buscadorController@buscador_ven');
        Route::post('/guardarFoto', 'vendedorIndependienteController@guardar_foto');

        //mis Rutas
        Route::get('/mis_datos' , 'vendedorIndependienteController@mis_datos'); 
        Route::get('/ingresar_productos' , 'vendedorIndependienteController@ingresar_productos');
        Route::get('/ingresar_servicios' , 'vendedorIndependienteController@ingresar_servicios');
        Route::get('/modificar_productos' , 'vendedorIndependienteController@modificar_productos');
        Route::get('/modificar_servicios' , 'vendedorIndependienteController@modificar_servicios');
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
        Route::get('/traerProductoEnEspera','encargadoController@traerProductoEnEspera');
        Route::get('/perfil_ven/{iduser}', 'encargadoController@vista_perfilVen');
        Route::get('/perfil_venInst/{iduser}','encargadoController@vista_perfilVenInst');
        Route::get('/perfil_institucion/{idinstitucion}','encargadoController@vista_perfilInst');
        Route::post('/publicarProducto','encargadoController@publicarProducto');
        Route::post('/actualizar_correo','encargadoController@actualizar_correo');
        Route::post('/actualizar_numero','encargadoController@actualizar_numero');
        Route::get('/detalleProducto/{id}', 'encargadoController@ver_detalleProducto');
        Route::get('/detalleServicio/{id}','encargadoController@ver_detalleServicio');
        Route::get('/eliminar_producto_institucion/{idProducto}', 'institucionController@eliminar_producto_institucion');
        Route::get('/eliminar_servicio_institucion/{idServicio}', 'institucionController@eliminar_servicio_institucion');
        Route::post('/actualizar_producto_foto', 'institucionController@actualizar_producto_foto');
        Route::post('/actualizar_producto_nombre','institucionController@actualizar_producto_nombre');
        Route::post('/actualizar_producto_descripcion','institucionController@actualizar_producto_descripcion');
        Route::post('/actualizar_producto_cantidad','institucionController@actualizar_producto_cantidad');
        Route::post('/actualizar_producto_visibilidad','institucionController@actualizar_producto_visibilidad');
        Route::post('/actualizar_producto_categoria', 'institucionController@actualizar_producto_categoria');
        Route::post('/actualizar_producto_area', 'institucionController@actualizar_producto_area');
        Route::post('/actualizar_producto_precio', 'institucionController@actualizar_producto_precio');
        Route::get('/verDetalleAlumno/{id}', 'alumnoController@vista_detalleAlumno_enc');
        Route::get('/publicarServicio', 'encargadoController@vista_publicarServicio');
        Route::post('/publicarServicio', 'encargadoController@publicarServicio');
        Route::get('/publicarNoticia', 'encargadoController@vista_publicarNoticia');
        Route::post('/publicarNoticia', 'encargadoController@publicarNoticia');
        Route::post('/actualizar_foto_alumno', 'institucionController@actualizar_foto_alumno');
        Route::post('/actualizar_fecha_alumno', 'institucionController@actualizar_fecha_alumno');
        Route::post('/actualizar_nombre_alumno', 'institucionController@actualizar_nombre_alumno');
        Route::post('/actualizar_apellido_alumno', 'institucionController@actualizar_apellido_alumno');
        Route::post('/actualizar_correo_alumno', 'institucionController@actualizar_correo_alumno');
        Route::post('/actualizar_area_alumno', 'institucionController@actualizar_area_alumno');
        Route::post('/actualizar_numero_alumno', 'institucionController@actualizar_numero_alumno');
        Route::get('/verNoticiasLocales', 'encargadoController@todas_noticias_locales');
        Route::get('/verNoticiasGenerales', 'encargadoController@todas_noticias_generales');
        Route::post('/actualizar_titulo_noticia', 'institucionController@actualizar_titulo_noticia');
        Route::post('/actualizar_texto_noticia', 'institucionController@actualizar_texto_noticia');
        Route::post('/actualizar_estado_noticia', 'institucionController@actualizar_estado_noticia');
        Route::get('/detalleServicio/{idServicio}/{idInstitucion}', 'encargadoController@ver_detalleServicio_institucion_local');
        Route::get('/detalleProducto/{idProducto}/{idInstitucion}', 'encargadoController@ver_detalleProducto_institucion_local');
        Route::get('/vista_serviciosEspera','institucionController@vista_serviciosEspera');
        Route::get('/filtrarProducto', 'encargadoController@filtrarProducto');
        Route::get('/filtrarServicio', 'encargadoController@filtrarServicio');
        Route::get('/traerProductoEnEspera','encargadoController@traerProductoEnEspera');
        Route::get('/traerServicioEnEspera','encargadoController@vista_serviciosEspera');
        Route::post('/actualizar_servicio_nombre','institucionController@actualizar_servicio_nombre');
        Route::post('/actualizar_servicio_descripcion','institucionController@actualizar_servicio_descripcion');
        Route::post('/actualizar_servicio_categoria','institucionController@actualizar_servicio_categoria');
        Route::post('/actualizar_servicio_visibilidad','institucionController@actualizar_servicio_visibilidad');
        Route::post('/actualizar_servicio_area','institucionController@actualizar_servicio_area');
        Route::post('/actualizar_servicio_foto','institucionController@actualizar_servicio_foto');
        Route::get('/ver_todo_producto','encargadoController@ver_todo_producto');
        Route::get('/ver_todo_servicio','encargadoController@ver_todo_servicio');
        Route::get('/detalleProducto/{id}', 'encargadoController@ver_detalleProducto');
        Route::get('/detalleServicio/{id}','encargadoController@ver_detalleServicio');
        Route::get('/productosOcultos','encargadoController@productos_oclutos');
        Route::get('/serviciosOcultos', 'encargadoController@servicios_ocultos');
        Route::get('/detalleNoticia_general/{idNoticia}','encargadoController@ver_detalleNoticia_general');
        Route::get('/detalleNoticia_local/{idNoticia}','encargadoController@ver_detalleNoticia_local');
        Route::get('/areaExtern/{idInstitucion}/{idArea}', 'encargadoController@vista_areaExterna');
        
       
});


Route::get('/activarmicro', 'herramientasayudaController@actiar_microfono');
Route::get('/desactivarmicro', 'herramientasayudaController@desactivar_microfono');
Route::get('/activartext', 'herramientasayudaController@activar_texto');
Route::get('/desactivartext','herramientasayudaController@desactivar_texto');



/* Peticiones ajax mediante vue y vue-resource */
Route::get('/eliminar_alumno/{id}','alumnoController@eliminar_alumno');
Route::get('/traerDatosInstitucion', 'institucionController@traerDatosInstitucion');
Route::post('/insertarDatosAreas','institucionController@insertarArea');
Route::get('/mostrarAreas', 'institucionController@traerAreas');
Route::get('/filtrarArea/{id}','invitadoController@filtroArea');
Route::post('/aceptarSolicitudUsuario','institucionController@aceptarSolicitudUsuario');
Route::get('/traerNotificaciones', 'institucionController@traerNotificaciones');
Route::get('/traerNotificaciones_prod','institucionController@traerNotificaciones_prod');
Route::get('/traerNotificaciones_serv','institucionController@traerNotificaciones_serv');
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
Route::get('/aceptarSolicitudProducto/{id}', 'institucionController@aceptarProducto');
Route::get('/aceptarSolicitudServicio/{id}','institucionController@aceptarSolicitudServicio');

/*inicio de usuarios*/



         Route::get('/inicio_cliente', 'clienteController@inicio_cliente');
         Route::get('/inicio_cliente_mas','clienteController@ver_mas_producto');

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



