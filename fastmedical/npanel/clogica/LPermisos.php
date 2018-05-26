<?php

session_start();
include_once("../../cdatos/DPermisos.php");

class LPermisos {

//Hecho por Sandi
    public function LCargarFormulario() {
        $oDPermisos = new DPermisos();
        $rs = $oDPermisos->DCargarFormulario();
        return $rs;
    }

    public function lCargarUsuarios($idFormulario) {
        $oDPermisos = new DPermisos();
        $rs = $oDPermisos->dCargarUsuarios($idFormulario);
        foreach ($rs as $key => $value) {
            array_push($rs[$key], "../../../../fastmedical_front/imagen/icono/eliminar.gif ^ ...");
        }
        return $rs;
    }

    public function lCargarUsuariosInac($idFormulario) {
        $oDPermisos = new DPermisos();
        $rs = $oDPermisos->dCargarUsuariosInac($idFormulario);
        foreach ($rs as $key => $value) {
            array_push($rs[$key], "../../../../fastmedical_front/imagen/icono/good.gif ^ ...");
        }
        return $rs;
    }

    function lQuitarPermiso($datos) {
        $oDPermisos = new DPermisos();
        $resultado = $oDPermisos->dQuitarPermiso($datos);
        return $resultado;
    }

    function lAsignarPermiso($datos) {
        $oDPermisos = new DPermisos();
        $resultado = $oDPermisos->dAsignarPermiso($datos);
        return $resultado;
    }

    //----------------------------------------------USUARIOS POR SERVICIO------------------------------------------------------------------

    public function lcargarFormularioServicios() {
        $oDPermisos = new DPermisos();
        $rs = $oDPermisos->DCargarFormularioServicioUsuario();
        return $rs;
    }

    public function LCargarServicioUsuarioUsuarios($datos) {
        $oDPermisos = new DPermisos();
        $rs = $oDPermisos->dCargarServicioUsuarios($datos);
        return $rs;
    }

    public function lCargarUsuariosActivos($idServicio, $idSistema, $idFormulario, $bEstado) {//carga usuarios activos por servicios
        $oDPermisos = new DPermisos();
        $rs = $oDPermisos->dCargarUsuariosActivos($idServicio, $idSistema, $idFormulario, $bEstado);
        foreach ($rs as $key => $value) {
            array_push($rs[$key], "../../../../fastmedical_front/imagen/icono/eliminar.gif ^ ...");
        }
        return $rs;
    }

    public function lCargarUsuariosInactivos($idServicio, $idSistema, $idFormulario) {//carga usuarios inactivos por servicios
        $oDPermisos = new DPermisos();
        $rs = $oDPermisos->dCargarUsuariosInactivos($idServicio, $idSistema, $idFormulario);
        foreach ($rs as $key => $value) {
            array_push($rs[$key], "../../../../fastmedical_front/imagen/icono/good.gif ^ ...");
        }
        return $rs;
    }

    function lQuitarPermisosUsuarioServi($datos) {
        $oDPermisos = new DPermisos();
        $resultado = $oDPermisos->dQuitarPermisosUsuarioServi($datos);
        return $resultado;
    }

    function lAsignarPermisosUsuarioServi($datos) {
        $oDPermisos = new DPermisos();
        $resultado = $oDPermisos->dAsignarPermisosUsuarioServi($datos);
        return $resultado;
    }

    /* Clonar permisos por ususarios */

    function lbuscarUsuariosClonarUsuario($datos) {
        $oDPermisos = new DPermisos();
        if ($datos['usuario'] != '') {
            $rs = $oDPermisos->dbuscarUsuariosClonarXusuario($datos);
        }
        if ($datos['apellidoPaterno'] != '' || $datos['apellidoMaterno'] != '' || $datos['nombres'] != '') {
            $rs = $oDPermisos->dbuscarUsuariosClonarXnombre($datos);
        }
        return $rs;
    }

    public function lCargarPuestosClonarUsuario($datos) {
        $oDPermisos = new DPermisos();
        $rs = $oDPermisos->dCargarPuestosClonarUsuario($datos);
        return $rs;
    }

    //----------
    function lClonarUsuario($datos) {
        $oDPermisos = new DPermisos();
        $resultado = $oDPermisos->dClonarUsuario($datos);
        return $resultado;
    }

    ////////////////////////////////////////////////////////////////////////
    ///////RESETEAR CONTRASEÑA---------------------------------------
    function lResetearClave($datos) {
        $oDPermisos = new DPermisos();
        $resultado = $oDPermisos->dResetearClave($datos);
        return $resultado;
    }

//-----------------------------------------------------------------------------------------
//---------------------------------CANCELAR SESION INDIVIDUAL------------------------------
//-----------------------------------------------------------------------------------------

    function lCancelarSesion($datos) {
        $oDPermisos = new DPermisos();
        $resultado = $oDPermisos->dCancelarSesion($datos);
        return $resultado;
    }

    function lbuscarUsuariosCancelarSesion($datos) {
        $oDPermisos = new DPermisos();
        if ($datos['usuario'] != '') {
            $rs = $oDPermisos->dbuscarUsuariosCancelarSesionXusuario($datos);
        }
        if ($datos['apellidoPaterno'] != '' || $datos['apellidoMaterno'] != '' || $datos['nombres'] != '') {
            $rs = $oDPermisos->dbuscarUsuariosCancelarSesionSesionXnombre($datos);
        }
        return $rs;
    }

//-----------------------------------------------------------------------------------------
//---------------------------------CANCELAR SESION TOTAL-----------------------------------
//-----------------------------------------------------------------------------------------
    
    public function lCancelarSesionTotal($datos) {
          $oDPermisos = new DPermisos();
        $resultado = $oDPermisos->dCancelarSesionTotal($datos);
        return $resultado;
    }

//-----------------------------------------------------------------------------------------
//---------------------------------CANCELAR SESION X PERFIL--------------------------------
//-----------------------------------------------------------------------------------------

    public function funcionArbolPopad($datos) {
        $oDPermisos = new DPermisos();
        $rs = $oDPermisos->funcionArbolPopad($datos);
        foreach ($rs as $key => $value) {
            array_push($rs[$key], "../../../../fastmedical_front/imagen/icono/eliminar.gif ^ ...");
        }
        return $rs;
    }

    public function cargarArrayIdSesiones($datos) {
        $oDPermisos = new DPermisos();
        $rs = $oDPermisos->cargarArrayIdSesiones($datos);
        return $rs;
    }

    public function eliminarSesionesSegunPerfil($datos) {
        $oDPermisos = new DPermisos();
        $rs = $oDPermisos->eliminarSesionesSegunPerfil($datos);
        return $rs;
    }

}

?>