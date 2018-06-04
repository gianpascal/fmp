<?php

if (!isset($_SESSION)) {
    session_start();
}


require_once("ActionLogin.php");

//require_once("ActionCita.php");
require_once("ActionFormulario.php");

require_once("ActionPermisos.php");
//include_once("../../../pholivo/Html.php");
//include_once("../../../pholivo/Calendario.php");

require_once("../../../pholivo/Html.php");

require_once("../../../pholivo/Calendario.php");

//require_once('../../ccontrol/control/loadsession.php');

if ($_GET) {
    $parametros = $_GET;
    $action = $parametros["p1"];
} else if ($_POST) {
    $parametros = $_POST;
    $action = $parametros["p1"];
}

$resultado = '';

switch (trim($action)) {
///////////****LOGIN****////////////////		
    case 'valida_usuario': {
        $_SESSION=null;
        
            $oActionLogin = new ActionLogin();
            $oActionLogin->validaUsuario($parametros);
            break;
        }
    case 'permiso_usuario': {
       
            $oActionLogin = new ActionLogin();
            $oActionLogin->getUsuarioOficina();
            $oActionLogin->getDatosInstitucion();
            $oActionLogin->getUsuarioPermiso();
            break;
        }
////////////////////////////////////////
/////////////// CITAS ///////////////////
    case "arbol_oficina": {
            $oActionCita = new ActionCita();
            $jsOficinas = $oActionCita->getArbolOficinas();
            $resultado = $jsOficinas;
            break;
        }
////////////////////// FIN CITAS ///////////////
////////////////////// BUSCADOR ////////////////
    case 'buscar_Pacientes': {
            $o_ActionFormulario = new ActionFormulario();
            $opcion = $parametros["p2"];
            $valor = $parametros["p3"];
            $id_sistema = $parametros["id_sistema"];
            $resultado = $o_ActionFormulario->getArrayPacientesLab($opcion, $valor);
            break;
        }

    case 'buscarEmpleados': {//Busca empleados que no son usuarios
            $o_ActionFormulario = new ActionFormulario();
            $id_sistema = $parametros["p2"];
            $opcion = $parametros["p3"];
            $valor = $parametros["p4"];
            $resultado = $o_ActionFormulario->listaEmpleadosNoUsuarios($opcion, $valor, $id_sistema);
            break;
        }

    case 'buscarUsuarios': {//Busca usuarios
            $o_ActionFormulario = new ActionFormulario();
            $id_sistema = $parametros["p2"];
            $opcion = $parametros["p3"];
            $valor = $parametros["p4"];
            $resultado = $o_ActionFormulario->listaUsuarios($opcion, $valor, $id_sistema);
            break;
        }

    case 'MostrarPersona': {//Carga datos de empleado que no es usuario también permite editar usuario
            $o_ActionFormulario = new ActionFormulario();
            $cadena = $parametros["c"];
            $f = $parametros["idformula"]; //id del formulario que se tiene permiso o no
            $e = $parametros["estado"]; //estado puede ser nuevo o editar
            $resultado = $o_ActionFormulario->MostrarPersona($cadena, $f, $e);
            break;
        }
    case 'usu_des_hab': {//Esto carga los datos de usuarios habilitados
            $o_ActionFormulario = new ActionFormulario();
            $resultado = $o_ActionFormulario->fun_pn_usuarios_habilitados($parametros);
            break;
        }

////////////////////// FIN BUSCADOR ////////////////
////////////////////// BUSCADOR ////////////////
    case 'GuardaNuevoUsuario': {//Guarda nuevo usuario del buscador antiguo
            $o_ActionFormulario = new ActionFormulario();
            $resultado = $o_ActionFormulario->GuardaNuevoUsuario($parametros);
            break;
        }
////////////////////// FIN BUSCADOR ////////////////	
////////////////////// HABILITA USUARIO ////////////////
    case 'HabUsuario': {//Deshabilita un usuario de la lista de usuarios habilitados
            $o_ActionFormulario = new ActionFormulario();
            $resultado = $o_ActionFormulario->fn_habilitar_usuario($parametros);
            break;
        }
    case 'editaUsuario': {
            $o_ActionFormulario = new ActionFormulario();
            $resultado = $o_ActionFormulario->fn_habilitar_usuario($parametros);
            break;
        }
////////////////////// HABILITA USUARIO ////////////////
////////////////////// PERMISOS ////////////////////////
    case 'listaDetallePerfil': {//Dibuja tabla de un perfil
            $o_ActionFormulario = new ActionFormulario();
            $activo = $parametros["activo"];
            $idSis = $parametros["idsistema"];
            $idPerf = $parametros["idperfil"];
            $patron = $parametros["patron"];
            $resultado = $o_ActionFormulario->listaDetallePerfil($activo, $idSis, $idPerf, $patron);
            break;
        }

    case 'listaDetallePermiso': {//Dibuja tabla de permiso
            $o_ActionFormulario = new ActionFormulario();
            $idSis = $parametros["p2"];
            $idPers = $parametros["p3"];
            $patron = $parametros["patron"];
            $resultado = $o_ActionFormulario->listaDetallePermiso($idSis, $idPers, $patron);
            break;
        }

    case 'listaPerfFormServ': {//Dibuja tabla de servicios de un formulario de perfil
            $o_ActionFormulario = new ActionFormulario();
            $idSis = $parametros["p2"];
            $idPerf = $parametros["p3"];
            $idFor = $parametros["p4"];
            $resultado = $o_ActionFormulario->listaPerfFormServ($idSis, $idPerf, $idFor);
            break;
        }

    case 'listaPermisoFormServ': {//Dibuja tabla de servicios de un formulario de permiso
            $o_ActionFormulario = new ActionFormulario();
            $idSis = $parametros["p2"];
            $idFor = $parametros["p3"];
            $idPers = $parametros["p4"];
            $resultado = $o_ActionFormulario->listaPermisoFormServ($idSis, $idFor, $idPers);
            break;
        }
////////////////////////////////////////////////////////
////////////////////// ARBOL ////////////////
    case 'listFormTree': {//Lista el arbol con las opciones de menu del HMLO
            $o_ActionFormulario = new ActionFormulario();
            $resultado = $o_ActionFormulario->getArbolMenu($parametros["idsistema"]);
            break;
        }
    case 'datosMenuItem': {//Carga los datos del menu seleccionado
            $o_ActionFormulario = new ActionFormulario();
            $resultado = $o_ActionFormulario->datosMenuItem($parametros);
            break;
        }
    case 'datosSubMenuItem': {//Nuevo Submenu
            $o_ActionFormulario = new ActionFormulario();
            $resultado = $o_ActionFormulario->datosSubMenuItem($parametros);
            break;
        }
    case 'nuevoMenuItem': {//Para grabar nuevo menu
            $o_ActionFormulario = new ActionFormulario();
            $resultado = $o_ActionFormulario->nuevoMenuItem($parametros);
            break;
        }
////////////////////// FIN ARBOL ////////////////

    case 'habFormDePerfil': {//Habilita-Deshabilita formulario de perfil
            $o_ActionFormulario = new ActionFormulario();
            $resultado = $o_ActionFormulario->spHabFormDePerfil($parametros);
            break;
        }

    case 'habFormDePermiso': {//Habilita-Deshabilita formulario de permiso
            $o_ActionFormulario = new ActionFormulario();
            $resultado = $o_ActionFormulario->spHabFormDePermiso($parametros);
            break;
        }

    case 'habServDePerfil': {//Habilita-Deshabilita servicio de formulario de perfil
            $o_ActionFormulario = new ActionFormulario();
            $resultado = $o_ActionFormulario->spHabServDePerfil($parametros);
            break;
        }

    case 'habServDePermiso': {//Habilita-Deshabilita servicio de formulario de permiso
            $o_ActionFormulario = new ActionFormulario();
            $resultado = $o_ActionFormulario->spHabServDePermiso($parametros);
            break;
        }

    /*     * ******************************************Perfiles************************************************* */
    case 'mantePerfil': {//Guarda o edita perfil
            $o_ActionFormulario = new ActionFormulario();
            $resultado = $o_ActionFormulario->mantePerfil($parametros);
            break;
        }
    //Arbol de puestos de trabajo por centro de costo
    case 'agregarPuestoEmpleado': {
            $o_ActionFormulario = new ActionFormulario();
            $resultado = $o_ActionFormulario->agregarPuestoEmpleado();
            break;
        }

    case 'puestosxCCostos': {
            $o_ActionFormulario = new ActionFormulario();

            $datos = array();
            $datos["idCCostos"] = $parametros['p2'];
            $datos["puesto"] = $parametros['p3'];
            $datos["categoria"] = $parametros['p4'];
            $datos["estado"] = $parametros['p5'];
            $datos["funcion"] = $parametros['p6'];
            $resultado = $o_ActionFormulario->aPuestosXCCostos($datos);
            break;
        }

    case 'getNombrePerfil': {
            $o_ActionFormulario = new ActionFormulario();
            $resultado = $o_ActionFormulario->getNombrePerfil($parametros);
            break;
        }

    /*     * ****************************************Formularios************************************************ */
    case 'listaDetalleFormulario': {//Dibuja tabla de formularios
            $o_ActionFormulario = new ActionFormulario();
            $idSis = $parametros["p2"];
            $nomForm = $parametros["patron"];
            $resultado = $o_ActionFormulario->listaDetalleFormulario($idSis, $nomForm);
            break;
        }

    case 'manteFormulario': {//Guarda nuevo formulario
            $o_ActionFormulario = new ActionFormulario();
            $resultado = $o_ActionFormulario->manteFormulario($parametros);
            break;
        }

    case 'listaFormServ': {//Dibuja tabla de servicios de formulario
            $o_ActionFormulario = new ActionFormulario();
            $idSis = $parametros["p2"];
            $idForm = $parametros["p3"];
            $nomServ = '%';
            $resultado = $o_ActionFormulario->listaFormServ($idSis, $idForm, $nomServ);
            break;
        }

    case 'habServDeForm': {//Habilita-Deshabilita servicio de formulario
            $o_ActionFormulario = new ActionFormulario();
            $resultado = $o_ActionFormulario->spHabServDeForm($parametros);
            break;
        }

    /*     * *****************************************Servicios************************************************* */
    case 'listaDetalleServicio': {//Dibuja tabla de servicios de acuerdo a los parametros de busqueda
            $o_ActionFormulario = new ActionFormulario();
            $resultado = $o_ActionFormulario->listaDetalleServicio($parametros["p2"]);
            break;
        }

    case 'manteServicio': {//Guarda nuevo servicio
            $o_ActionFormulario = new ActionFormulario();
            $resultado = $o_ActionFormulario->manteServicio($parametros);
            break;
        }


    ///////////////////------------------------------USUARIO POR FORMULARIO-----------------------------//////////////////////////                               

    case 'verPermisosUsuarios': {//vista del usuarios por permisos
            $o_ActionPermisos = new ActionPermisos();
            $resultado = $o_ActionPermisos->aVerPermisosUsuarios($parametros);
            //  $resultado = 'sandy';
            break;
        }

    case 'cargarFormulario': {//Carga por defecto la lista de formularios
            header("Content-type: text/xml");
            $o_ActionPermisos = new ActionPermisos();
            $resultado = $o_ActionPermisos->aCargarFormulario();
            break;
        }
//cargarUsuarios
    case 'cargarUsuarios': {//carga en una nueva tabla los usarios activos por formularios, en una nueva tabla a la derecha
            header("Content-type: text/xml");
            $o_ActionPermisos = new ActionPermisos();
            //$resultado = $o_ActionPermisos->aVerPermisosUsuarios($parametros);
            $idFormulario = $parametros["p2"];
            $resultado = $o_ActionPermisos->aCargarUusuario($idFormulario);
            break;
        }

    case 'cargarUsuariosInac': {//carga en una nueva tabla los usarios inactivos por formularios
            header("Content-type: text/xml");
            $o_ActionPermisos = new ActionPermisos();
            //$resultado = $o_ActionPermisos->aVerPermisosUsuarios($parametros);
            $idFormulario = $parametros["p2"];
            $resultado = $o_ActionPermisos->acargarUsuariosInac($idFormulario);
            break;
        }

    case 'QuitarPermiso': {
            $o_ActionPermisos = new ActionPermisos();
            $datos['idSistema'] = $parametros['p2'];
            $datos['CodFormulario'] = $parametros['p3'];
            $datos['idPersona'] = $parametros['p4'];
            $resultado = $o_ActionPermisos->aQuitarPermiso($datos);
            break;
        }

    case 'AsignarPermiso': {
            $o_ActionPermisos = new ActionPermisos();
            $datos['idSistema'] = $parametros['p2'];
            $datos['CodFormulario'] = $parametros['p3'];
            $datos['idPersona'] = $parametros['p4'];
            $resultado = $o_ActionPermisos->aAsignarPermiso($datos);
            break;
        }


    //----------------------------------------------------------------
    ////////////////////// USUARIOS POR SERVICIOS ////////////////
    ///////////////////////////////////// ////////////////////////

    case 'cargarFormularioServicios': {
            header("Content-type: text/xml");
            $o_ActionPermisos = new ActionPermisos();
            $resultado = $o_ActionPermisos->acargarFormularioServicios();
            break;
        }

    case 'verServiciosUsuarios': {
            $o_ActionPermisos = new ActionPermisos();
            $resultado = $o_ActionPermisos->aVeServiciosUsuario($parametros);
            break;
        }

    case 'cargarServicioUsuariose': {//carga los ususarios por servicios en una nueva tabla
            header("Content-type: text/xml");
            $o_ActionPermisos = new ActionPermisos();
            $datos['CodSistema'] = $parametros['p2'];
            $datos['CodFormulario'] = $parametros['p3'];
            $datos['CodServicio'] = $parametros['p4'];
            $resultado = $o_ActionPermisos->aCargarServicioUsuarios($datos);
            break;
        }

    case 'cargarUsuariosActivos': {//Carga los usuarios por servicios en la nueva tabla
            header("Content-type: text/xml");
            $o_ActionPermisos = new ActionPermisos();
            //$resultado = $o_ActionPermisos->aVerPermisosUsuarios($parametros);
            $idServicio = $parametros["p2"];
            $idSistema = $parametros["p3"];
            $idFormulario = $parametros["p4"];
            $bEstado = $parametros["p5"];
            $resultado = $o_ActionPermisos->aCargarUsuariosActivos($idServicio, $idSistema, $idFormulario, $bEstado);
            break;
        }

    case 'cargarServicioUsuariosInactivos': {//Carga los usuarios inactivos por servicios en la nueva tabla
            header("Content-type: text/xml");
            $o_ActionPermisos = new ActionPermisos();
            //$resultado = $o_ActionPermisos->aVerPermisosUsuarios($parametros);
            $idServicio = $parametros["p2"];
            $idSistema = $parametros["p3"];
            $idFormulario = $parametros["p4"];
            $idServicio = $parametros["p5"];
            $resultado = $o_ActionPermisos->acargarUsuariosInactivos($idServicio, $idSistema, $idFormulario);
            break;
        }

    case 'QuitarPermisoServicioUsuarios': {//quita el permiso del servicio
            $o_ActionPermisos = new ActionPermisos();
            $datos['idSistema'] = $parametros['p2'];
            $datos['CodFormulario'] = $parametros['p3'];
            $datos['idPersona'] = $parametros['p4'];
            $datos['idServicio'] = $parametros ['p5'];
            $resultado = $o_ActionPermisos->aQuitarPermisoServicioUsuarios($datos);
            break;
        }

    case 'AsignarPermisoServicioUsuarios': { //asigna el permiso del servicio
            $o_ActionPermisos = new ActionPermisos();
            $datos['idSistema'] = $parametros['p2'];
            $datos['CodFormulario'] = $parametros['p3'];
            $datos['idPersona'] = $parametros['p4'];
            $datos['idServicio'] = $parametros ['p5'];
            $resultado = $o_ActionPermisos->aAsignarPermisoServicioUsuarios($datos);
            break;
        }



    /* ////////////////////////////Clonar permisos por ususarios */

    case 'verClonarUsuarios': {
            $o_ActionPermisos = new ActionPermisos();
            $resultado = $o_ActionPermisos->aVerClonarUsuarios($parametros);
            break;
        }

    case 'podpadbuscarUsuariosClonarUsuario': {//Busca usuarios
            $o_ActionPermisos = new ActionPermisos();
            $resultado = $o_ActionPermisos->podpadbuscarUsuariosClonarUsuario();
            break;
        }

    //busqueda de usuario a clonar
    case 'buscarUsuariosClonarUsuario': {
            header("Content-type: text/xml");
            $o_ActionPermisos = new ActionPermisos();
            $datos['usuario'] = $parametros['p2'];
            $datos['apellidoPaterno'] = $parametros['p3'];
            $datos['apellidoMaterno'] = $parametros['p4'];
            $datos['nombres'] = $parametros ['p5'];
            $resultado = $o_ActionPermisos->buscarUsuariosClonarUsuario($datos);
            break;
        };

    case 'CargarPuestosClonarUsuario': {//Carga los usuarios por servicios en la nueva tabla
            header("Content-type: text/xml");
            $o_ActionPermisos = new ActionPermisos();
            $datos['idPuestoEmpleado'] = $parametros['p2'];
            $datos['bEstados'] = $parametros['p3'];
            $datos['vNombrePuesto'] = $parametros['p4'];
            $datos['iCodigoEmpleado'] = $parametros['p5'];
            $resultado = $o_ActionPermisos->aCargarPuestosClonarUsuario($datos);
            break;
        }


    //---------------------------------USUARIOS COPIA-------------------------xD
    case 'podpadbuscarUsuariosCopia': {//Busca usuarios
            $o_ActionPermisos = new ActionPermisos();
            $resultado = $o_ActionPermisos->podpadbuscarUsuariosCopia();
            break;
        }


    case 'ClonarUsuario': {//Busca usuarios
            $o_ActionPermisos = new ActionPermisos();
            $datos['codPerOriginal'] = $parametros['p2'];
            $datos['codigoPerCopia'] = $parametros['p3'];
            $resultado = $o_ActionPermisos->aClonarUsuario($datos);
            break;
        }

// ---------------------------RESETEAR CONTRASEÑA ----------------------------

    case 'resetearClave': {//resetea contra
            $o_ActionPermisos = new ActionPermisos();
            $resultado = $o_ActionPermisos->aVerResetearClave($parametros);
            break;
        }

    case 'realizarResetearClave': {//Guarda nuevo usuario del buscador antiguo
            $o_ActionPermisos = new ActionPermisos();
            $datos['c_cod_per'] = $parametros['p2'];
            $resultado = $o_ActionPermisos->aResetearClave($datos);
            break;
        }


//-----------------------------------------------------------------------------------------
//---------------------------------CANCELAR SESION INDIVIDUAL------------------------------
//-----------------------------------------------------------------------------------------

    case 'verCancelarSesion': {
            $o_ActionPermisos = new ActionPermisos();
            $resultado = $o_ActionPermisos->aVerCancelarSesion($parametros);
            break;
        }

    case 'realizarCancelarSesion': {
            $o_ActionPermisos = new ActionPermisos();
            $datos['idSession'] = $parametros['p2'];
            $datos['idInt'] = $parametros['p3'];
            $datos['idusuario'] = $parametros['p4'];
            $resultado = $o_ActionPermisos->aCancelarSesion($datos);
            // $resultado = 'sandy';
            break;
        }

    case 'podpadbuscarUsuariosCancelarSesion': {//Busca usuario para cancelar su sesion
            $o_ActionPermisos = new ActionPermisos();
            $resultado = $o_ActionPermisos->podpadbuscarUsuariosCancelarSesion();
            break;
        }


    //busqueda de usuario para cerrar su sesion
    case 'buscarUsuariosCancelarSesion': {
            header("Content-type: text/xml");
            $o_ActionPermisos = new ActionPermisos();
            $datos['usuario'] = $parametros['p2'];
            $datos['apellidoPaterno'] = $parametros['p3'];
            $datos['apellidoMaterno'] = $parametros['p4'];
            $datos['nombres'] = $parametros ['p5'];
            $resultado = $o_ActionPermisos->abuscarUsuariosCancelarSesion($datos);
            break;
        };


//-----------------------------------------------------------------------------------------
//---------------------------------CANCELAR SESION TOTAL-----------------------------------
//-----------------------------------------------------------------------------------------

    case 'realizarCancelarSesionTotal': {
            $o_ActionPermisos = new ActionPermisos();
            $resultado = $o_ActionPermisos->aCancelarSesionTotal($datos);
            // $resultado = 'sandy';
            break;
        }

//-----------------------------------------------------------------------------------------
//-------------------------------CANCELAR SESION X PERFIL----------------------------------
//-----------------------------------------------------------------------------------------

    case 'funcionArbolPopad': {
            header("Content-type: text/xml");
            $o_ActionPermisos = new ActionPermisos();
            $datos['idCentroConstos'] = $parametros['p2'];
            $resultado = $o_ActionPermisos->funcionArbolPopad($datos);
            break;
        };
    case 'cargarArrayIdSesiones': {
            $o_ActionPermisos = new ActionPermisos();
            $datos['idCentroConstos'] = $parametros['p2'];
            $resultado = $o_ActionPermisos->cargarArrayIdSesiones($datos);
            break;
        };
    case 'eliminarSesionesSegunPerfil': {
            $o_ActionPermisos = new ActionPermisos();
            $datos['cadena'] = $parametros['p2'];
            $resultado = $o_ActionPermisos->eliminarSesionesSegunPerfil($datos);
            break;
        };



    case 'podpadseleccionarPerfilCancelarSesion': {//Busca usuario para cancelar su sesion
            $o_ActionPermisos = new ActionPermisos();
            $resultado = $o_ActionPermisos->podpadseleccionarPerfilCancelarSesion();
            break;
        }


    case 'funtionCerrarSesionPerfil': {
            header("Content-type: text/xml");
            $o_ActionPermisos = new ActionPermisos();
            $datos['idCentroConstos'] = $parametros['p2'];
            $resultado = $o_ActionPermisos->funcionArbolPopad($datos);
            break;
        };


//-----------------------------------------------------------------------------------------
//---------------------------------PERIODO DE ACCESO---------------------------------------
//-----------------------------------------------------------------------------------------

    case 'verPeriodoDeAcceso': {
            $o_ActionPermisos = new ActionPermisos();
            $resultado = $o_ActionPermisos->aVerPeriodoDeAcceso($parametros);
            break;
        }
}


echo $resultado;
?>







