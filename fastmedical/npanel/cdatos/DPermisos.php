<?php

include_once("../../../pholivo/Conexion.php");
include_once("../../../pholivo/adophp/Adophp.class.php");

class DPermisos extends Adophp {

    private $dsn;
    private $oRecord;

    public function __construct($dsn = '') {
        $this->dsn = empty($dsn) ? Conexion::getInitDsnMSSQLAuditoriaWeb() : $dsn;
        parent::__construct('Spanish', $this->dsn);
    }

//Hecho por Sandi
    public function DCargarFormulario() {
        parent::ConnectionOpen("pnsCargarFormulario", "permisos");
        parent::SetParameterSP("@accion", '1');
        parent::SetParameterSP("@idsistema", '');
        parent::SetParameterSP("@idFormulario", '');
        parent::SetParameterSP("@idPersona", '');
        parent::SetParameterSP("@idServicio", '');
        parent::SetParameterSP("@idServicioUsuario", '');
        parent::SetParameterSP("@idPerfil", '');
        parent::SetParameterSP("@usuario", '');
        parent::SetParameterSP("@apPat", '');
        parent::SetParameterSP("@apMat", '');
        parent::SetParameterSP("@nombre", '');
        parent::SetParameterSP("@idPuesto", '');
        parent::SetParameterSP("@codigoEmpleado", '');
        parent::SetParameterSP("@idInt", '');
        parent::SetParameterSP("@idusuario", '');
        parent::SetParameterSP("@id_session", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function dCargarUsuarios($idFormulario) {
        parent::ConnectionOpen("pnsCargarFormulario", "permisos");
        parent::SetParameterSP("@accion", '2');
        parent::SetParameterSP("@idsistema", '');
        parent::SetParameterSP("@idFormulario", $idFormulario);
        parent::SetParameterSP("@idPersona", '');
        parent::SetParameterSP("@idServicio", '');
        parent::SetParameterSP("@idServicioUsuario", '');
        parent::SetParameterSP("@idPerfil", '');
        parent::SetParameterSP("@usuario", '');
        parent::SetParameterSP("@apPat", '');
        parent::SetParameterSP("@apMat", '');
        parent::SetParameterSP("@nombre", '');
        parent::SetParameterSP("@idPuesto", '');
        parent::SetParameterSP("@codigoEmpleado", '');
        parent::SetParameterSP("@idInt", '');
        parent::SetParameterSP("@idusuario", '');
        parent::SetParameterSP("@id_session", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function dCargarUsuariosInac($idFormulario) {
        parent::ConnectionOpen("pnsCargarFormulario", "permisos");
        parent::SetParameterSP("@accion", '4');
        parent::SetParameterSP("@idsistema", '');
        parent::SetParameterSP("@idFormulario", $idFormulario);
        parent::SetParameterSP("@idPersona", '');
        parent::SetParameterSP("@idServicio", '');
        parent::SetParameterSP("@idServicioUsuario", '');
        parent::SetParameterSP("@idPerfil", '');
        parent::SetParameterSP("@usuario", '');
        parent::SetParameterSP("@apPat", '');
        parent::SetParameterSP("@apMat", '');
        parent::SetParameterSP("@nombre", '');
        parent::SetParameterSP("@idPuesto", '');
        parent::SetParameterSP("@codigoEmpleado", '');
        parent::SetParameterSP("@idInt", '');
        parent::SetParameterSP("@idusuario", '');
        parent::SetParameterSP("@id_session", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function dQuitarPermiso($datos) {
        parent::ConnectionOpen("pnsCargarFormulario", "permisos");
        parent::SetParameterSP("@accion", '3');
        parent::SetParameterSP("@idsistema", $datos['idSistema']);
        parent::SetParameterSP("@idFormulario", $datos['CodFormulario']);
        parent::SetParameterSP("@idPersona", $datos['idPersona']);
        parent::SetParameterSP("@idServicio", "");
        parent::SetParameterSP("@idServicioUsuario", '');
        parent::SetParameterSP("@idPerfil", '');
        parent::SetParameterSP("@usuario", '');
        parent::SetParameterSP("@apPat", '');
        parent::SetParameterSP("@apMat", '');
        parent::SetParameterSP("@nombre", '');
        parent::SetParameterSP("@idPuesto", '');
        parent::SetParameterSP("@codigoEmpleado", '');
        parent::SetParameterSP("@idInt", '');
        parent::SetParameterSP("@idusuario", '');
        parent::SetParameterSP("@id_session", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function dAsignarPermiso($datos) {
        parent::ConnectionOpen("pnsCargarFormulario", "permisos");
        parent::SetParameterSP("@accion", '5');
        parent::SetParameterSP("@idsistema", $datos['idSistema']);
        parent::SetParameterSP("@idFormulario", $datos['CodFormulario']);
        parent::SetParameterSP("@idPersona", $datos['idPersona']);
        parent::SetParameterSP("@idServicio", "");
        parent::SetParameterSP("@idServicioUsuario", '');
        parent::SetParameterSP("@idPerfil", '');
        parent::SetParameterSP("@usuario", '');
        parent::SetParameterSP("@apPat", '');
        parent::SetParameterSP("@apMat", '');
        parent::SetParameterSP("@nombre", '');
        parent::SetParameterSP("@idPuesto", '');
        parent::SetParameterSP("@codigoEmpleado", '');
        parent::SetParameterSP("@idInt", '');
        parent::SetParameterSP("@idusuario", '');
        parent::SetParameterSP("@id_session", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//-----------------------------------------------------------------USUARIOS POR SERVICIO--------------------------------------------


    public function DCargarFormularioServicioUsuario() {
        parent::ConnectionOpen("pnsCargarFormulario", "permisos");
        parent::SetParameterSP("@accion", '6');
        parent::SetParameterSP("@idServicio", '');
        parent::SetParameterSP("@idsistema", '');
        parent::SetParameterSP("@idPersona", '');
        parent::SetParameterSP("@idFormulario", '');
        parent::SetParameterSP("@idServicioUsuario", '');
        parent::SetParameterSP("@idPerfil", '');
        parent::SetParameterSP("@usuario", '');
        parent::SetParameterSP("@apPat", '');
        parent::SetParameterSP("@apMat", '');
        parent::SetParameterSP("@nombre", '');
        parent::SetParameterSP("@idPuesto", '');
        parent::SetParameterSP("@codigoEmpleado", '');
        parent::SetParameterSP("@idInt", '');
        parent::SetParameterSP("@idusuario", '');
        parent::SetParameterSP("@id_session", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function dCargarServicioUsuarios($datos) {//carga los usuarios por servicios
        parent::ConnectionOpen("pnsCargarFormulario", "permisos");
        parent::SetParameterSP("@accion", '7');
        parent::SetParameterSP("@idsistema", $datos['CodSistema']);
        parent::SetParameterSP("@idFormulario", $datos['CodFormulario']);
        parent::SetParameterSP("@idPersona", '');
        parent::SetParameterSP("@idServicio", $datos['CodServicio']);
        parent::SetParameterSP("@idServicioUsuario", '');
        parent::SetParameterSP("@idPerfil", '');
        parent::SetParameterSP("@usuario", '');
        parent::SetParameterSP("@apPat", '');
        parent::SetParameterSP("@apMat", '');
        parent::SetParameterSP("@nombre", '');
        parent::SetParameterSP("@idPuesto", '');
        parent::SetParameterSP("@codigoEmpleado", '');
        parent::SetParameterSP("@idInt", '');
        parent::SetParameterSP("@idusuario", '');
        parent::SetParameterSP("@id_session", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function dCargarUsuariosActivos($idServicio, $idSistema, $idFormulario, $bEstado) {//carga ususarios activos por servicios
        parent::ConnectionOpen("pnsCargarFormulario", "permisos");
        parent::SetParameterSP("@accion", '7');
        parent::SetParameterSP("@idsistema", $idSistema);
        parent::SetParameterSP("@idFormulario", $idFormulario);
        parent::SetParameterSP("@idPersona", '');
        parent::SetParameterSP("@idServicio", $idServicio);
        parent::SetParameterSP("@idServicioUsuario", $bEstado);
        parent::SetParameterSP("@idPerfil", '');
        parent::SetParameterSP("@usuario", '');
        parent::SetParameterSP("@apPat", '');
        parent::SetParameterSP("@apMat", '');
        parent::SetParameterSP("@nombre", '');
        parent::SetParameterSP("@idPuesto", '');
        parent::SetParameterSP("@codigoEmpleado", '');
        parent::SetParameterSP("@idInt", '');
        parent::SetParameterSP("@idusuario", '');
        parent::SetParameterSP("@id_session", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function dCargarUsuariosInactivos($idServicio, $idSistema, $idFormulario) {//carga los usuarios inactivos por servicios
        parent::ConnectionOpen("pnsCargarFormulario", "permisos");
        parent::SetParameterSP("@accion", '8');
        parent::SetParameterSP("@idsistema", $idSistema);
        parent::SetParameterSP("@idFormulario", $idFormulario);
        parent::SetParameterSP("@idPersona", '');
        parent::SetParameterSP("@idServicio", $idServicio);
        parent::SetParameterSP("@idServicioUsuario", '');
        parent::SetParameterSP("@idPerfil", '');
        parent::SetParameterSP("@usuario", '');
        parent::SetParameterSP("@apPat", '');
        parent::SetParameterSP("@apMat", '');
        parent::SetParameterSP("@nombre", '');
        parent::SetParameterSP("@idPuesto", '');
        parent::SetParameterSP("@codigoEmpleado", '');
        parent::SetParameterSP("@idInt", '');
        parent::SetParameterSP("@idusuario", '');
        parent::SetParameterSP("@id_session", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function dQuitarPermisosUsuarioServi($datos) {
        parent::ConnectionOpen("pnsCargarFormulario", "permisos");
        parent::SetParameterSP("@accion", '9');
        parent::SetParameterSP("@idsistema", $datos['idSistema']);
        parent::SetParameterSP("@idFormulario", $datos['CodFormulario']);
        parent::SetParameterSP("@idPersona", $datos['idPersona']);
        parent::SetParameterSP("@idServicio", $datos['idServicio']);
        parent::SetParameterSP("@idServicioUsuario", '');
        parent::SetParameterSP("@idPerfil", '');
        parent::SetParameterSP("@usuario", '');
        parent::SetParameterSP("@apPat", '');
        parent::SetParameterSP("@apMat", '');
        parent::SetParameterSP("@nombre", '');
        parent::SetParameterSP("@idPuesto", '');
        parent::SetParameterSP("@codigoEmpleado", '');
        parent::SetParameterSP("@idInt", '');
        parent::SetParameterSP("@idusuario", '');
        parent::SetParameterSP("@id_session", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function dAsignarPermisosUsuarioServi($datos) {
        parent::ConnectionOpen("pnsCargarFormulario", "permisos");
        parent::SetParameterSP("@accion", '10');
        parent::SetParameterSP("@idsistema", $datos['idSistema']);
        parent::SetParameterSP("@idFormulario", $datos['CodFormulario']);
        parent::SetParameterSP("@idPersona", $datos['idPersona']);
        parent::SetParameterSP("@idServicio", $datos['idServicio']);
        parent::SetParameterSP("@idServicioUsuario", '');
        parent::SetParameterSP("@idPerfil", '');
        parent::SetParameterSP("@usuario", '');
        parent::SetParameterSP("@apPat", '');
        parent::SetParameterSP("@apMat", '');
        parent::SetParameterSP("@nombre", '');
        parent::SetParameterSP("@idPuesto", '');
        parent::SetParameterSP("@codigoEmpleado", '');
        parent::SetParameterSP("@idInt", '');
        parent::SetParameterSP("@idusuario", '');
        parent::SetParameterSP("@id_session", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    // lista a los usuarios a clonar-----------------------------------------------------


    function dbuscarUsuariosClonarXusuario($datos) {
        parent::ConnectionOpen("pnsCargarFormulario", "permisos");
        parent::SetParameterSP("@accion", '11');
        parent::SetParameterSP("@idsistema", '');
        parent::SetParameterSP("@idFormulario", '');
        parent::SetParameterSP("@idPersona", '');
        parent::SetParameterSP("@idServicio", '');
        parent::SetParameterSP("@idServicioUsuario", '');
        parent::SetParameterSP("@idPerfil", '');
        parent::SetParameterSP("@usuario", $datos['usuario']);
        parent::SetParameterSP("@apPat", '');
        parent::SetParameterSP("@apMat", '');
        parent::SetParameterSP("@nombre", '');
        parent::SetParameterSP("@idPuesto", '');
        parent::SetParameterSP("@codigoEmpleado", '');
        parent::SetParameterSP("@idInt", '');
        parent::SetParameterSP("@idusuario", '');
        parent::SetParameterSP("@id_session", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    /* $idPersona,$usuario, $apPat, $apMat, $nombre, $perfil */

    function dbuscarUsuariosClonarXnombre($datos) {
        parent::ConnectionOpen("pnsCargarFormulario", "permisos");
        parent::SetParameterSP("@accion", '11');
        parent::SetParameterSP("@idsistema", '');
        parent::SetParameterSP("@idFormulario", '');
        parent::SetParameterSP("@idPersona", '');
        parent::SetParameterSP("@idServicio", '');
        parent::SetParameterSP("@idServicioUsuario", '');
        parent::SetParameterSP("@idPerfil", '');
        parent::SetParameterSP("@usuario", '');
        parent::SetParameterSP("@apPat", $datos['apellidoPaterno']);
        parent::SetParameterSP("@apMat", $datos['apellidoMaterno']);
        parent::SetParameterSP("@nombre", $datos['nombres']);
        parent::SetParameterSP("@idPuesto", '');
        parent::SetParameterSP("@codigoEmpleado", '');
        parent::SetParameterSP("@idInt", '');
        parent::SetParameterSP("@idusuario", '');
        parent::SetParameterSP("@id_session", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function dCargarPuestosClonarUsuario($datos) {
        parent::ConnectionOpen("pnsCargarFormulario", "permisos");
        parent::SetParameterSP("@accion", '12');
        parent::SetParameterSP("@idsistema", '');
        parent::SetParameterSP("@idFormulario", '');
        parent::SetParameterSP("@idPersona", '');
        parent::SetParameterSP("@idServicio", '');
        parent::SetParameterSP("@idServicioUsuario", '');
        parent::SetParameterSP("@idPerfil", '');
        parent::SetParameterSP("@usuario", '');
        parent::SetParameterSP("@apPat", '');
        parent::SetParameterSP("@apMat", '');
        parent::SetParameterSP("@nombre", '');
        parent::SetParameterSP("@idPuesto", '');
        parent::SetParameterSP("@codigoEmpleado", $datos['iCodigoEmpleado']);
        parent::SetParameterSP("@idInt", '');
        parent::SetParameterSP("@idusuario", '');
        parent::SetParameterSP("@id_session", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function dClonarUsuario($datos) {
        parent::ConnectionOpen("sp_permisos_inserta_permisos", "permisos");
        parent::SetParameterSP("@accion", '4');
        parent::SetParameterSP("@codPer", $datos['codigoPerCopia']);
        parent::SetParameterSP("@codPerCopiar", $datos['codPerOriginal']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    // *********************************RESETEO DE CLAVES*****************************************************
    function dResetearClave($datos) {
        parent::ConnectionOpen("pnsCargarFormulario", "permisos");
        parent::SetParameterSP("@accion", '13');
        parent::SetParameterSP("@idsistema", '');
        parent::SetParameterSP("@idFormulario", '');
        parent::SetParameterSP("@idPersona", $datos['c_cod_per']);
        parent::SetParameterSP("@idServicio", '');
        parent::SetParameterSP("@idServicioUsuario", '');
        parent::SetParameterSP("@idPerfil", '');
        parent::SetParameterSP("@usuario", '');
        parent::SetParameterSP("@apPat", '');
        parent::SetParameterSP("@apMat", '');
        parent::SetParameterSP("@nombre", '');
        parent::SetParameterSP("@idPuesto", '');
        parent::SetParameterSP("@codigoEmpleado", '');
        parent::SetParameterSP("@idInt", '');
        parent::SetParameterSP("@idusuario", '');
        parent::SetParameterSP("@id_session", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//-----------------------------------------------------------------------------------------
//-------------------------------CANCELAR SESION INDIVIDUAL--------------------------------
//-----------------------------------------------------------------------------------------

    function dCancelarSesion($datos) {
        parent::ConnectionOpen("pnsCargarFormulario", "permisos");
        parent::SetParameterSP("@accion", '15');
        parent::SetParameterSP("@idsistema", '');
        parent::SetParameterSP("@idFormulario", '');
        parent::SetParameterSP("@idPersona", '');
        parent::SetParameterSP("@idServicio", '');
        parent::SetParameterSP("@idServicioUsuario", '');
        parent::SetParameterSP("@idPerfil", '');
        parent::SetParameterSP("@usuario", '');
        parent::SetParameterSP("@apPat", '');
        parent::SetParameterSP("@apMat", '');
        parent::SetParameterSP("@nombre", '');
        parent::SetParameterSP("@idPuesto", '');
        parent::SetParameterSP("@codigoEmpleado", '');
        parent::SetParameterSP("@idInt", $datos['idInt']);
        parent::SetParameterSP("@idusuario", $datos['idusuario']);
        parent::SetParameterSP("@id_session", $datos['idSession']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function dbuscarUsuariosCancelarSesionXusuario($datos) {
        parent::ConnectionOpen("pnsCargarFormulario", "permisos");
        parent::SetParameterSP("@accion", '14');
        parent::SetParameterSP("@idsistema", '');
        parent::SetParameterSP("@idFormulario", '');
        parent::SetParameterSP("@idPersona", '');
        parent::SetParameterSP("@idServicio", '');
        parent::SetParameterSP("@idServicioUsuario", '');
        parent::SetParameterSP("@idPerfil", '');
        parent::SetParameterSP("@usuario", $datos['usuario']);
        parent::SetParameterSP("@apPat", '');
        parent::SetParameterSP("@apMat", '');
        parent::SetParameterSP("@nombre", '');
        parent::SetParameterSP("@idPuesto", '');
        parent::SetParameterSP("@codigoEmpleado", '');
        parent::SetParameterSP("@idInt", '');
        parent::SetParameterSP("@idusuario", '');
        parent::SetParameterSP("@id_session", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function dbuscarUsuariosCancelarSesionSesionXnombre($datos) {
        parent::ConnectionOpen("pnsCargarFormulario", "permisos");
        parent::SetParameterSP("@accion", '14');
        parent::SetParameterSP("@idsistema", '');
        parent::SetParameterSP("@idFormulario", '');
        parent::SetParameterSP("@idPersona", '');
        parent::SetParameterSP("@idServicio", '');
        parent::SetParameterSP("@idServicioUsuario", '');
        parent::SetParameterSP("@idPerfil", '');
        parent::SetParameterSP("@usuario", '');
        parent::SetParameterSP("@apPat", $datos['apellidoPaterno']);
        parent::SetParameterSP("@apMat", $datos['apellidoMaterno']);
        parent::SetParameterSP("@nombre", $datos['nombres']);
        parent::SetParameterSP("@idPuesto", '');
        parent::SetParameterSP("@codigoEmpleado", '');
        parent::SetParameterSP("@idInt", '');
        parent::SetParameterSP("@idusuario", '');
        parent::SetParameterSP("@id_session", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//-----------------------------------------------------------------------------------------
//---------------------------------CANCELAR SESION TOTAL-----------------------------------
//-----------------------------------------------------------------------------------------

    function dCancelarSesionTotal($datos) {
        parent::ConnectionOpen("pnsCargarFormulario", "permisos");
        parent::SetParameterSP("@accion", '16');
        parent::SetParameterSP("@idsistema", '');
        parent::SetParameterSP("@idFormulario", '');
        parent::SetParameterSP("@idPersona", '');
        parent::SetParameterSP("@idServicio", '');
        parent::SetParameterSP("@idServicioUsuario", '');
        parent::SetParameterSP("@idPerfil", '');
        parent::SetParameterSP("@usuario", '');
        parent::SetParameterSP("@apPat", '');
        parent::SetParameterSP("@apMat", '');
        parent::SetParameterSP("@nombre", '');
        parent::SetParameterSP("@idPuesto", '');
        parent::SetParameterSP("@codigoEmpleado", '');
        parent::SetParameterSP("@idInt", '');
        parent::SetParameterSP("@idusuario", '');
        parent::SetParameterSP("@id_session", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//-----------------------------------------------------------------------------------------
//---------------------------------CANCELAR SESION X PERFIL--------------------------------
//-----------------------------------------------------------------------------------------

    function funcionArbolPopad($datos) {

        parent::ConnectionOpen("pnsCargarFormulario", "permisos");
        parent::SetParameterSP("@accion", '17');
        parent::SetParameterSP("@idsistema", $datos['idCentroConstos']);
        parent::SetParameterSP("@idFormulario", '');
        parent::SetParameterSP("@idPersona", '');
        parent::SetParameterSP("@idServicio", '');
        parent::SetParameterSP("@idServicioUsuario", '');
        parent::SetParameterSP("@idPerfil", '');
        parent::SetParameterSP("@usuario", '');
        parent::SetParameterSP("@apPat", '');
        parent::SetParameterSP("@apMat", '');
        parent::SetParameterSP("@nombre", '');
        parent::SetParameterSP("@idPuesto", '');
        parent::SetParameterSP("@codigoEmpleado", '');
        parent::SetParameterSP("@idInt", '');
        parent::SetParameterSP("@idusuario", '');
        parent::SetParameterSP("@id_session", '');
        $resultado = parent::executeSPArrayX();

        return $resultado;
    }

    function cargarArrayIdSesiones($datos) {

        parent::ConnectionOpen("pnsCargarFormulario", "permisos");
        parent::SetParameterSP("@accion", '18');
        parent::SetParameterSP("@idsistema", $datos['idCentroConstos']);
        parent::SetParameterSP("@idFormulario", '');
        parent::SetParameterSP("@idPersona", '');
        parent::SetParameterSP("@idServicio", '');
        parent::SetParameterSP("@idServicioUsuario", '');
        parent::SetParameterSP("@idPerfil", '');
        parent::SetParameterSP("@usuario", '');
        parent::SetParameterSP("@apPat", '');
        parent::SetParameterSP("@apMat", '');
        parent::SetParameterSP("@nombre", '');
        parent::SetParameterSP("@idPuesto", '');
        parent::SetParameterSP("@codigoEmpleado", '');
        parent::SetParameterSP("@idInt", '');
        parent::SetParameterSP("@idusuario", '');
        parent::SetParameterSP("@id_session", '');
        $resultado = parent::executeSPArrayX();

        return $resultado;
    }

    function eliminarSesionesSegunPerfil($datos) {
        $array = explode("|", $datos['cadena']);
        $contador = count($array);
        for ($y = 0; $y <= $contador - 1; $y++) {
            parent::Liberar_Parametros();
            parent::ConnectionOpen("pnsCargarFormulario", "permisos");
            parent::SetParameterSP("@accion", '19');
            parent::SetParameterSP("@idsistema", $array[$y]);
            parent::SetParameterSP("@idFormulario", '');
            parent::SetParameterSP("@idPersona", '');
            parent::SetParameterSP("@idServicio", '');
            parent::SetParameterSP("@idServicioUsuario", '');
            parent::SetParameterSP("@idPerfil", '');
            parent::SetParameterSP("@usuario", '');
            parent::SetParameterSP("@apPat", '');
            parent::SetParameterSP("@apMat", '');
            parent::SetParameterSP("@nombre", '');
            parent::SetParameterSP("@idPuesto", '');
            parent::SetParameterSP("@codigoEmpleado", '');
            parent::SetParameterSP("@idInt", '');
            parent::SetParameterSP("@idusuario", '');
            parent::SetParameterSP("@id_session", '');
            $resultado = parent::executeSPArrayX();
        }
        return $resultado;
    }

    /*
      function dbusquedaEmpleadosCentroCostosFiltradoCS($puesto, $estado) {
      parent::ConnectionOpen("PuestosxCentroDeCostos", "dbweb");
      parent::SetParameterSP("$1", '5');
      parent::SetParameterSP("$2", $puesto);
      parent::SetParameterSP("$3", $estado);
      parent::SetParameterSP("$4", '');
      $resultado = parent::executeSPArrayX();
      return $resultado;
      }

      function dGeneraArbolCentroCostosCS() {
      parent::ConnectionOpen("PuestosxCentroDeCostos", "dbweb");
      parent::SetParameterSP("accion", '2');
      parent::SetParameterSP("p1", '');
      parent::SetParameterSP("p2", '');
      parent::SetParameterSP("p3", '');
      $resultadoArray = parent::executeSPArrayX();
      parent::ConnectionClose();
      return $resultadoArray;
      } */
}

?>
