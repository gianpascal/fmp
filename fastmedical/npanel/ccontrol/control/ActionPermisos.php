<?php

include_once("../../clogica/LPermisos.php");
require_once("../../../pholivo/tablaDHTMLX.php");

class ActionPermisos {

    public function __construct() {
        
    }

//creado por Sandy 13 de Setiembre

    function aVerPermisosUsuarios() {

        require_once("../../cvista/permisos/vistaUsuariosPermisos.php");
        //require_once("../permisos/vistaUsuariosPermisos.php"); 
    }

    function aVeServiciosUsuario() {
        require_once("../../cvista/permisos/vistaServicioUsuario.php");
    }

    /* Clonar permisos por ususarios */

    function aVerClonarUsuarios() {
        require_once("../../cvista/permisos/vistaClonarUsuario.php");
    }

    /*                RESETEO DE CONTRASEÑA       */

    function aVerResetearClave() {
        require_once("../../cvista/usuarios/vistaResetearClave.php");
    }

    //-------------------------CANCELAR SESION------------------------------------
    function aVerCancelarSesion() {
        require_once("../../cvista/permisos/vistaCancelarSesion.php");
    }

    //-------------------------PERIODO DE ACCESO------------------------------------
    function aVerPeriodoDeAcceso() {
        require_once("../../cvista/permisos/vistaPeriodoDeAcceso.php");
    }

    function aCargarFormulario() {
        $oLPermisos = new LPermisos();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLPermisos->LCargarFormulario();

        $arrayCabecera = array(0 => "Id", 1 => "Nombre Sistema", 2 => "Id Sistema", 3 => "Nombre Formulario");
        $arrayTamano = array(0 => "40", 1 => "*", 2 => "40", 3 => "110");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "true", 3 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function aCargarUusuario($idFormulario) {
        $oLPermisos = new LPermisos();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLPermisos->lCargarUsuarios($idFormulario);

        $arrayCabecera = array(0 => "Id", 1 => "Nombre de Usuario", 2 => "ID Formulario", 3 => "Id Sistema", 4 => "Id Persona", 5 => "Acción");
        $arrayTamano = array(0 => "50", 1 => "*", 2 => "40", 3 => "110", 4 => "110", 5 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "true", 3 => "true", 4 => "true", 5 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function acargarUsuariosInac($idFormulario) {
        $oLPermisos = new LPermisos();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLPermisos->lcargarUsuariosInac($idFormulario);

        $arrayCabecera = array(0 => "Id", 1 => "Nombre de Usuario", 2 => "ID Formulario", 3 => "Id Sistema", 4 => "Id Persona", 5 => "Acción");
        $arrayTamano = array(0 => "50", 1 => "*", 2 => "40", 3 => "110", 4 => "110", 5 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "true", 3 => "true", 4 => "true", 5 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function aQuitarPermiso($datos) {
        $oLPermisos = new LPermisos();
        $respuesta = $oLPermisos->lQuitarPermiso($datos);
        return $respuesta;
    }

    function aAsignarPermiso($datos) {
        $oLPermisos = new LPermisos();
        $respuesta = $oLPermisos->lAsignarPermiso($datos);
        return $respuesta;
    }

// ------------------------------------------------------------------USUARIOS POR SERVICIO----------------------------------------------------
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function acargarFormularioServicios() {
        $oLPermisos = new LPermisos();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLPermisos->lcargarFormularioServicios();
        $arrayCabecera = array(0 => "vnombre_sistema", 1 => "iid_sistema", 2 => "vnom_formulario", 3 => "iid_formulario", 4 => "vnom_servicio", 5 => "iid_servicio");
        $arrayTamano = array(0 => "100", 1 => "40", 2 => "150", 3 => "40", 4 => "165", 5 => "40");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default");
        $arrayHidden = array(0 => "false", 1 => "true", 2 => "false", 3 => "true", 4 => "false", 5 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function aCargarServicioUsuarios($datos) {
        $oLPermisos = new LPermisos();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLPermisos->LCargarServicioUsuarioUsuarios($datos);

        $arrayCabecera = array(0 => "codigoPersona", 1 => "Nombre de Usuario", 2 => "ID Formulario", 3 => "Id Sistema", 4 => "Id servicio", 5 => "Acción");
        $arrayTamano = array(0 => "50", 1 => "*", 2 => "40", 3 => "110", 4 => "110", 5 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false", 4 => "false", 5 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    //ususarios activos por servicio***
    function aCargarUsuariosActivos($idServicio, $idSistema, $idFormulario, $bEstado) {//carga los usurios activos por servicios
        $oLPermisos = new LPermisos();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLPermisos->lCargarUsuariosActivos($idServicio, $idSistema, $idFormulario, $bEstado);

        $arrayCabecera = array(0 => "Id", 1 => "Nombre de Usuario", 2 => "ID Formulario", 3 => "Id Sistema", 4 => "Id Persona", 5 => "Acción");
        $arrayTamano = array(0 => "50", 1 => "*", 2 => "40", 3 => "110", 4 => "110", 5 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "true", 3 => "true", 4 => "true", 5 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function acargarUsuariosInactivos($idServicio, $idSistema, $idFormulario) {//carga ussuarios inactivos por servicios
        $oLPermisos = new LPermisos();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLPermisos->lcargarUsuariosInactivos($idServicio, $idSistema, $idFormulario);

        $arrayCabecera = array(0 => "Id", 1 => "Nombre de Usuario", 2 => "ID Formulario", 3 => "Id Sistema", 4 => "Id Persona", 5 => "Acción");
        $arrayTamano = array(0 => "50", 1 => "*", 2 => "40", 3 => "110", 4 => "110", 5 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "true", 3 => "true", 4 => "true", 5 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function aQuitarPermisoServicioUsuarios($datos) {
        $oLPermisos = new LPermisos();
        $respuesta = $oLPermisos->lQuitarPermisosUsuarioServi($datos);
        return $respuesta;
    }

    function aAsignarPermisoServicioUsuarios($datos) {
        $oLPermisos = new LPermisos();
        $respuesta = $oLPermisos->lAsignarPermisosUsuarioServi($datos);
        return $respuesta;
    }

    //--------------------------------------------*   clonar permisos de ususarios */

    public function podpadbuscarUsuariosClonarUsuario() {
        $oLPermisos = new LPermisos();
        require_once("../../cvista/permisos/BusquedaClonarUsuario.php");
    }

    // BUSCAR USUARIOS A CLONAR
    public function buscarUsuariosClonarUsuario($datos) {
        $oLPermisos = new LPermisos();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLPermisos->lbuscarUsuariosClonarUsuario($datos);
        $arrayCabecera = array(0 => "codigo Persona", 1 => "loginUsuario", 2 => "Nombre de Usuario", 3 => "perfil", 4 => "Nombre sistema", 5 => "id sistema", 6 => "iCodigoEmpleado", 7 => "bEstado", 8 => "idPuestoEmpleado", 9 => "NombrePuesto");
        $arrayTamano = array(0 => "50", 1 => "80", 2 => "200", 3 => "50", 4 => "100", 5 => "30", 6 => "80", 7 => "80", 8 => "80", 9 => "250");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro", 8 => "ro", 9 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 8 => "default", 9 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "true", 4 => "false", 5 => "true", 6 => "true", 7 => "true", 8 => "true", 9 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left", 6 => "left", 7 => "left", 8 => "left", 9 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function aCargarPuestosClonarUsuario($datos) {//carga los usurios activos por servicios
        $oLPermisos = new LPermisos();
        $o_TablaHtmlx = new tablaDHTMLX();

        /*  $arrayFilas[0][0] = $datos['idPuestoEmpleado']; //para cargar la informacion que ya se tiene en la tabla en un nuevo array para pasarlo a la nueva tabla del mismo formulario
          $arrayFilas[0][1] = $datos['vNombrePuesto'];
          $arrayFilas[0][2] = $datos['bEstados'];
          $arrayFilas[0][3] = $datos['iCodigoEmpleado']; */
        //  d.iCodigoEmpleado, e.bEstado,e.iidPuestoEmpleado,f.vNombrePuesto

        $arrayFilas = $oLPermisos->lCargarPuestosClonarUsuario($datos);

        $arrayCabecera = array(0 => "Codigo de empleado", 1 => "Estado", 2 => "Estado", 3 => "Puesto del empleado", 4 => "codigo Persona", 5 => "Nombre sistema");
        $arrayTamano = array(0 => "80", 1 => "200", 2 => "50", 3 => "271", 4 => "50", 5 => "100");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default");
        $arrayHidden = array(0 => "false", 1 => "true", 2 => "true", 3 => "false", 4 => "true", 5 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    //--------------------------------------  USUARIOS COPIA------------------------

    public function podpadbuscarUsuariosCopia() {
        $oLPermisos = new LPermisos();
        require_once("../../cvista/permisos/BusquedaUsuarioCopia.php");
    }

    public function aClonarUsuario($datos) {
        $oLPermisos = new LPermisos();
        $oLPermisos->lClonarUsuario($datos);
    }

    //----------------------------------RESETEAR CLAVE---------------------------------************************

    public function aResetearClave($datos) {
        $oLPermisos = new LPermisos();
        $oLPermisos->lResetearClave($datos);
    }

//-----------------------------------------------------------------------------------------
//---------------------------------CANCELAR SESION INDIVIDUAL------------------------------

    public function abuscarUsuariosCancelarSesion($datos) {
        $oLPermisos = new LPermisos();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLPermisos->lbuscarUsuariosCancelarSesion($datos);
        $arrayCabecera = array(0 => "estado", 1 => "codigo persona", 2 => "nombre", 3 => "login", 4 => "horaInicio", 5 => "horaFin", 6 => "dusuario", 7 => "id", 8 => "idInt", 9 => "idSession");
        $arrayTamano = array(0 => "50", 1 => "80", 2 => "270", 3 => "100", 4 => "100", 5 => "30", 6 => "20", 7 => "20", 8 => "50", 9 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro", 8 => "ro", 9 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 8 => "default", 9 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false", 4 => "false", 5 => "true", 6 => "true", 7 => "true", 8 => "true", 9 => "true");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left", 6 => "left", 7 => "left", 8 => "lef", 9 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function aCancelarSesion($datos) {
        $oLPermisos = new LPermisos();
        $oLPermisos->lCancelarSesion($datos);
    }

    public function podpadbuscarUsuariosCancelarSesion() {
        $oLPermisos = new LPermisos();
        require_once("../../cvista/permisos/BusquedaCancelarSesion.php");
    }

//-----------------------------------------------------------------------------------------
//---------------------------------CANCELAR SESION TOTAL-----------------------------------
//-----------------------------------------------------------------------------------------
    public function aCancelarSesionTotal($datos) {
        $oLPermisos = new LPermisos();
        $oLPermisos->lCancelarSesionTotal($datos);
    }

//-----------------------------------------------------------------------------------------
//---------------------------------CANCELAR SESION X PERFIL--------------------------------
//----------------------------------------------------------------------------------------- 


    public function podpadseleccionarPerfilCancelarSesion() {
        $oLPermisos = new LPermisos();
        require_once("../../cvista/permisos/seleccionarPerfilCancelarSesion.php");
    }

    function funcionArbolPopad($datos) {
        $oLPermisos = new LPermisos();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLPermisos->funcionArbolPopad($datos);

        $arrayCabecera = array(0 => "Id", 1 => "vNombrePuesto", 2 => "vDescripcionCcosto", 3 => "vDescripcion", 4 => "Estado", 5 => "bEstado", 6 => "...");
        $arrayTamano = array(0 => "40", 1 => "*", 2 => "120", 3 => "*", 4 => "*", 5 => "*", 6 => "30");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 5 => "pointer");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "true", 3 => "false", 4 => "false", 5 => "true", 6 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left", 5 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function cargarArrayIdSesiones($datos) {
        $oLPermisos = new LPermisos();
        $respuesta = $oLPermisos->cargarArrayIdSesiones($datos);
        $contador = count($respuesta);
        $cadena = "";
        for ($x = 0; $x <= $contador - 1; $x++) {
            if ($x < $contador - 1) {
                $cadena.=$respuesta[$x][0] . "|";
            } else {
                $cadena.=$respuesta[$x][0];
            }
        }
        return $cadena;
    }

    function eliminarSesionesSegunPerfil($datos) {
        $oLPermisos = new LPermisos();
        $respuesta = $oLPermisos->eliminarSesionesSegunPerfil($datos);
        return $respuesta;
    }

}

?>